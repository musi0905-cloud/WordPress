/**
 * AI 글쓰기 도우미 - 구텐베르크 사이드바 패널.
 * 빌드(webpack/babel) 없이 워드프레스가 기본 제공하는 wp.* 전역 API만으로 작성됐다.
 * 모든 AI 호출은 wp.apiFetch를 통해 서버(/maiw/v1/generate)에서만 이뤄진다.
 */
( function () {
	var el = wp.element.createElement;
	var useState = wp.element.useState;
	var useRef = wp.element.useRef;
	var Fragment = wp.element.Fragment;
	var registerPlugin = wp.plugins.registerPlugin;
	var PluginSidebar = wp.editPost.PluginSidebar;
	var PluginSidebarMoreMenuItem = wp.editPost.PluginSidebarMoreMenuItem;
	var Button = wp.components.Button;
	var TextControl = wp.components.TextControl;
	var SelectControl = wp.components.SelectControl;
	var Spinner = wp.components.Spinner;
	var Notice = wp.components.Notice;
	var apiFetch = wp.apiFetch;
	var dispatch = wp.data.dispatch;
	var select = wp.data.select;

	var TONE_OPTIONS = [ '친근하게', '전문적으로', '간결하게' ];
	var WORDS_OPTIONS = [
		{ label: '짧게', value: 500 },
		{ label: '보통', value: 900 },
		{ label: '길게', value: 1500 },
	];

	// 썸네일 이미지는 실제 AI 이미지 생성(OpenAI/Gemini)으로 배경을 만들고,
	// 그 위에 한글 제목을 캔버스로 오버레이한다(한글이 깨지지 않도록 AI에게는
	// "텍스트를 그리지 말라"고 지시한다 — 서버의 maiw_build_image_prompt 참고).
	var THUMBNAIL_STYLES = [
		{ key: 'poster', label: '포스터' },
		{ key: 'magazine', label: '매거진' },
		{ key: 'infographic', label: '인포그래픽' },
		{ key: 'illustration', label: '일러스트' },
		{ key: 'typography', label: '타이포그래피' },
		{ key: 'gradient', label: '그라데이션' },
		{ key: 'branding', label: '브랜딩' },
	];

	// Claude는 이미지 생성 API가 없어 썸네일 생성 방식에서 제외한다. Gamma 등 외부 서비스는
	// 이 플러그인이 연동하는 대상이 아니다(OpenAI/Gemini만 지원).
	var IMAGE_ENGINE_OPTIONS = [
		{ label: 'OpenAI', value: 'openai' },
		{ label: 'Gemini', value: 'gemini' },
	];

	var CONTENT_TYPE_OPTIONS = [
		{ label: '정보/가이드', value: 'info_guide' },
		{ label: '유틸리티', value: 'utility' },
		{ label: '정책/안내', value: 'policy' },
		{ label: '리뷰', value: 'review' },
		{ label: '목록형', value: 'list' },
		{ label: '뉴스/트렌드', value: 'news' },
	];

	var LANGUAGE_OPTIONS = [
		{ label: '한국어', value: 'ko' },
		{ label: 'English', value: 'en' },
		{ label: '日本語', value: 'ja' },
		{ label: '中文', value: 'zh' },
	];

	var SCHEMA_TYPE_OPTIONS = [
		{ key: 'article', label: '기사' },
		{ key: 'product_review', label: '상품리뷰' },
		{ key: 'faq', label: '자주 묻는 질문' },
	];

	function errorMessage( err ) {
		if ( ! err ) {
			return '알 수 없는 오류가 발생했습니다.';
		}
		if ( typeof err === 'string' ) {
			return err;
		}
		// /maiw/v1/generate 는 실패 시 { "error": "..." } 형태로 응답한다.
		if ( err.error ) {
			return err.error;
		}
		if ( err.message ) {
			return err.message;
		}
		return '요청을 처리하는 중 오류가 발생했습니다.';
	}

	/**
	 * 단일 선택 칩 그룹.
	 */
	function ChipGroup( props ) {
		return el(
			'div',
			{ className: 'maiw-chip-group' },
			props.options.map( function ( opt ) {
				var value = opt.value !== undefined ? opt.value : opt;
				var label = opt.label !== undefined ? opt.label : opt;
				var isActive = value === props.value;
				return el(
					'button',
					{
						type: 'button',
						key: String( value ),
						className: 'maiw-chip' + ( isActive ? ' is-active' : '' ),
						onClick: function () {
							props.onChange( value );
						},
					},
					label
				);
			} )
		);
	}

	/**
	 * ✍️ AI 글쓰기 탭. 생성 버튼을 누르면 미리보기 없이 바로 편집기에 삽입된다
	 * (다시 생성하면 편집기 내용을 새 결과로 덮어쓴다).
	 */
	function WriteTab( props ) {
		var topicState = useState( '' );
		var topic = topicState[ 0 ];
		var setTopic = topicState[ 1 ];

		var contentTypeState = useState( CONTENT_TYPE_OPTIONS[ 0 ].value );
		var contentType = contentTypeState[ 0 ];
		var setContentType = contentTypeState[ 1 ];

		var languageState = useState( LANGUAGE_OPTIONS[ 0 ].value );
		var language = languageState[ 0 ];
		var setLanguage = languageState[ 1 ];

		var toneState = useState( TONE_OPTIONS[ 0 ] );
		var tone = toneState[ 0 ];
		var setTone = toneState[ 1 ];

		var wordsState = useState( 900 );
		var words = wordsState[ 0 ];
		var setWords = wordsState[ 1 ];

		var loadingState = useState( false );
		var loading = loadingState[ 0 ];
		var setLoading = loadingState[ 1 ];

		var errorState = useState( '' );
		var error = errorState[ 0 ];
		var setError = errorState[ 1 ];

		var insertedTitleState = useState( '' );
		var insertedTitle = insertedTitleState[ 0 ];
		var setInsertedTitle = insertedTitleState[ 1 ];

		function generate() {
			var subject = topic.trim() || props.focusKeyword.trim();
			if ( ! subject ) {
				setError( '주제 키워드나 포커스 키워드를 입력해 주세요.' );
				return;
			}
			setError( '' );
			setLoading( true );
			apiFetch( {
				path: '/maiw/v1/generate',
				method: 'POST',
				data: {
					topic: subject,
					keywords: props.focusKeyword,
					tone: tone,
					words: words,
					contentType: contentType,
					language: language,
				},
			} )
				.then( function ( res ) {
					// 미리보기 없이 바로 편집기에 반영한다 — 다시 생성하면 기존 블록을 새 결과로 덮어쓴다.
					dispatch( 'core/editor' ).editPost( { title: res.title } );
					var blocks = wp.blocks.rawHandler( { HTML: res.html } );
					dispatch( 'core/block-editor' ).resetBlocks( blocks );
					setInsertedTitle( res.title );
					setLoading( false );
				} )
				.catch( function ( err ) {
					setError( errorMessage( err ) );
					setLoading( false );
				} );
		}

		return el(
			'div',
			{ className: 'maiw-tab-panel' },
			el( TextControl, {
				label: '주제 키워드',
				value: topic,
				onChange: setTopic,
				placeholder: props.focusKeyword || '예: 여름철 냉방비 절약 방법',
			} ),
			el( SelectControl, {
				label: '글 유형',
				value: contentType,
				options: CONTENT_TYPE_OPTIONS,
				onChange: setContentType,
			} ),
			el( SelectControl, {
				label: '언어 선택',
				value: language,
				options: LANGUAGE_OPTIONS,
				onChange: setLanguage,
			} ),
			el( 'div', { className: 'maiw-field-label' }, '말투' ),
			el( ChipGroup, { options: TONE_OPTIONS, value: tone, onChange: setTone } ),
			el( 'div', { className: 'maiw-field-label' }, '분량' ),
			el( ChipGroup, { options: WORDS_OPTIONS, value: words, onChange: setWords } ),
			el(
				Button,
				{
					variant: 'primary',
					className: 'maiw-run-button',
					onClick: generate,
					disabled: loading,
				},
				loading ? el( Spinner, null ) : '✍️ AI 콘텐츠 생성'
			),
			error &&
				el( Notice, { status: 'error', isDismissible: false }, error ),
			insertedTitle &&
				! loading &&
				el(
					'div',
					{ className: 'maiw-result' },
					el(
						Notice,
						{ status: 'success', isDismissible: false },
						'편집기에 삽입되었습니다: ' + insertedTitle
					),
					el(
						'div',
						{ className: 'maiw-result-actions' },
						el(
							Button,
							{ variant: 'secondary', onClick: generate, disabled: loading },
							'다시 생성'
						)
					)
				)
		);
	}

	/**
	 * 한글 대응 줄바꿈: 글자 단위로 measureText를 검사해 maxWidth를 넘기지 않는 라인 배열을 만든다.
	 */
	function wrapText( ctx, text, maxWidth ) {
		var lines = [];
		var current = '';
		for ( var i = 0; i < text.length; i++ ) {
			var next = current + text.charAt( i );
			if ( ctx.measureText( next ).width > maxWidth && current !== '' ) {
				lines.push( current );
				current = text.charAt( i );
			} else {
				current = next;
			}
		}
		if ( current !== '' ) {
			lines.push( current );
		}
		return lines;
	}

	/**
	 * data: URI 이미지를 로드한다 (AI가 생성한 배경 이미지를 캔버스에 그리기 전에 필요).
	 */
	function loadImage( src ) {
		return new Promise( function ( resolve, reject ) {
			var img = new Image();
			img.onload = function () {
				resolve( img );
			};
			img.onerror = function () {
				reject( new Error( '생성된 이미지를 불러오지 못했습니다.' ) );
			};
			img.src = src;
		} );
	}

	/**
	 * 캔버스를 이미지로 꽉 채운다 (object-fit: cover와 동일하게 중앙 크롭).
	 */
	function drawImageCover( ctx, img, w, h ) {
		var scale = Math.max( w / img.width, h / img.height );
		var dw = img.width * scale;
		var dh = img.height * scale;
		var dx = ( w - dw ) / 2;
		var dy = ( h - dh ) / 2;
		ctx.drawImage( img, dx, dy, dw, dh );
	}

	function roundRect( ctx, x, y, w, h, r ) {
		ctx.beginPath();
		ctx.moveTo( x + r, y );
		ctx.arcTo( x + w, y, x + w, y + h, r );
		ctx.arcTo( x + w, y + h, x, y + h, r );
		ctx.arcTo( x, y + h, x, y, r );
		ctx.arcTo( x, y, x + w, y, r );
		ctx.closePath();
	}

	function drawBadge( ctx, x, y, text, bg, fg ) {
		ctx.font = 'bold 20px sans-serif';
		var padding = 14;
		var boxW = ctx.measureText( text ).width + padding * 2;
		var boxH = 40;
		ctx.fillStyle = bg;
		ctx.fillRect( x, y, boxW, boxH );
		ctx.fillStyle = fg;
		ctx.textBaseline = 'middle';
		ctx.fillText( text, x + padding, y + boxH / 2 + 1 );
		ctx.textBaseline = 'alphabetic';
	}

	/* ---- 썸네일 스타일별 레이아웃. 배경은 AI 생성 이미지, 텍스트는 캔버스 오버레이. ---- */

	function drawPoster( ctx, w, h, text ) {
		var scrim = ctx.createLinearGradient( 0, h * 0.35, 0, h );
		scrim.addColorStop( 0, 'rgba(0,0,0,0)' );
		scrim.addColorStop( 1, 'rgba(0,0,0,0.75)' );
		ctx.fillStyle = scrim;
		ctx.fillRect( 0, 0, w, h );

		drawBadge( ctx, 60, 60, 'GUIDE', '#e63946', '#ffffff' );

		ctx.font = 'bold 60px sans-serif';
		var lines = wrapText( ctx, text, w - 160 );
		var lineHeight = 70;
		var titleTopY = h - 110 - ( lines.length - 1 ) * lineHeight;
		ctx.fillStyle = '#ffffff';
		ctx.shadowColor = 'rgba(0,0,0,0.5)';
		ctx.shadowBlur = 14;
		ctx.shadowOffsetY = 4;
		lines.forEach( function ( line, idx ) {
			ctx.fillText( line, 80, titleTopY + idx * lineHeight );
		} );
		ctx.shadowColor = 'transparent';
		ctx.shadowBlur = 0;
		ctx.shadowOffsetY = 0;

		ctx.font = '28px sans-serif';
		ctx.fillStyle = 'rgba(255,255,255,0.85)';
		ctx.fillText( '클릭해서 자세히 보기 →', 80, h - 50 );
	}

	function drawMagazine( ctx, w, h, text ) {
		var bandH = h * 0.36;
		ctx.fillStyle = '#1e1e1e';
		ctx.fillRect( 0, h - bandH, w, bandH );

		ctx.font = 'bold 16px sans-serif';
		ctx.fillStyle = '#f2c94c';
		ctx.fillText( 'ISSUE', 80, h - bandH + 40 );

		ctx.font = 'bold 46px sans-serif';
		var lines = wrapText( ctx, text, w - 160 );
		var lineHeight = 56;
		var startY = h - bandH + 90;
		ctx.fillStyle = '#ffffff';
		lines.forEach( function ( line, idx ) {
			ctx.fillText( line, 80, startY + idx * lineHeight );
		} );
	}

	function drawInfographic( ctx, w, h, text ) {
		var panelW = w * 0.42;
		ctx.fillStyle = '#0b7a5b';
		ctx.fillRect( 0, 0, panelW, h );

		drawBadge( ctx, 50, 50, 'GUIDE', 'rgba(255,255,255,0.18)', '#ffffff' );

		ctx.font = 'bold 40px sans-serif';
		var lines = wrapText( ctx, text, panelW - 100 );
		var lineHeight = 52;
		var startY = h / 2 - ( ( lines.length - 1 ) * lineHeight ) / 2;
		ctx.fillStyle = '#ffffff';
		lines.forEach( function ( line, idx ) {
			ctx.fillText( line, 50, startY + idx * lineHeight );
		} );

		ctx.font = '22px sans-serif';
		ctx.fillStyle = 'rgba(255,255,255,0.8)';
		ctx.fillText( '클릭해서 자세히 보기 →', 50, h - 50 );
	}

	function drawIllustration( ctx, w, h, text ) {
		ctx.beginPath();
		ctx.fillStyle = '#ff7a59';
		ctx.arc( w - 110, 110, 60, 0, Math.PI * 2 );
		ctx.fill();
		ctx.fillStyle = '#ffffff';
		ctx.font = 'bold 18px sans-serif';
		ctx.textAlign = 'center';
		ctx.textBaseline = 'middle';
		ctx.fillText( 'GUIDE', w - 110, 110 );

		var ribbonH = 170;
		var ribbonY = h - ribbonH - 50;
		var ribbonX = 60;
		var ribbonW = w - 120;
		ctx.fillStyle = 'rgba(255,255,255,0.92)';
		roundRect( ctx, ribbonX, ribbonY, ribbonW, ribbonH, 20 );
		ctx.fill();

		ctx.font = 'bold 42px sans-serif';
		ctx.fillStyle = '#1e1e1e';
		ctx.textBaseline = 'alphabetic';
		var lines = wrapText( ctx, text, ribbonW - 80 );
		var lineHeight = 50;
		var startY = ribbonY + ribbonH / 2 - ( ( lines.length - 1 ) * lineHeight ) / 2 + 14;
		lines.forEach( function ( line, idx ) {
			ctx.fillText( line, w / 2, startY + idx * lineHeight );
		} );
		ctx.textAlign = 'left';
	}

	function drawTypography( ctx, w, h, text ) {
		ctx.fillStyle = 'rgba(0,0,0,0.55)';
		ctx.fillRect( 0, 0, w, h );

		ctx.font = 'bold 68px sans-serif';
		ctx.textAlign = 'center';
		var lines = wrapText( ctx, text, w - 200 );
		var lineHeight = 82;
		var startY = h / 2 - ( ( lines.length - 1 ) * lineHeight ) / 2;
		ctx.fillStyle = '#ffffff';
		lines.forEach( function ( line, idx ) {
			ctx.fillText( line, w / 2, startY + idx * lineHeight );
		} );

		var ruleY = startY + lines.length * lineHeight - 10;
		ctx.strokeStyle = 'rgba(255,255,255,0.6)';
		ctx.lineWidth = 3;
		ctx.beginPath();
		ctx.moveTo( w / 2 - 80, ruleY );
		ctx.lineTo( w / 2 + 80, ruleY );
		ctx.stroke();
		ctx.textAlign = 'left';
	}

	function drawGradientStyle( ctx, w, h, text ) {
		var tint = ctx.createLinearGradient( 0, 0, w, h );
		tint.addColorStop( 0, 'rgba(56,88,233,0.35)' );
		tint.addColorStop( 1, 'rgba(34,113,177,0.55)' );
		ctx.fillStyle = tint;
		ctx.fillRect( 0, 0, w, h );

		drawBadge( ctx, 60, 60, 'GUIDE', 'rgba(255,255,255,0.92)', '#3858e9' );

		ctx.font = 'bold 58px sans-serif';
		var lines = wrapText( ctx, text, w - 160 );
		var lineHeight = 68;
		var titleTopY = h - 110 - ( lines.length - 1 ) * lineHeight;
		ctx.fillStyle = '#ffffff';
		ctx.shadowColor = 'rgba(0,0,0,0.35)';
		ctx.shadowBlur = 12;
		ctx.shadowOffsetY = 4;
		lines.forEach( function ( line, idx ) {
			ctx.fillText( line, 80, titleTopY + idx * lineHeight );
		} );
		ctx.shadowColor = 'transparent';
		ctx.shadowBlur = 0;
		ctx.shadowOffsetY = 0;

		ctx.font = '26px sans-serif';
		ctx.fillStyle = 'rgba(255,255,255,0.85)';
		ctx.fillText( '클릭해서 자세히 보기 →', 80, h - 50 );
	}

	function drawBranding( ctx, w, h, text ) {
		var bandH = h * 0.28;
		ctx.fillStyle = '#12294f';
		ctx.fillRect( 0, h - bandH, w, bandH );

		ctx.fillStyle = '#f2c94c';
		ctx.fillRect( 60, h - bandH + ( bandH / 2 - 30 ), 60, 60 );

		ctx.font = 'bold 42px sans-serif';
		ctx.fillStyle = '#ffffff';
		var lines = wrapText( ctx, text, w - 260 );
		var lineHeight = 50;
		var startY = h - bandH + bandH / 2 - ( ( lines.length - 1 ) * lineHeight ) / 2 + 14;
		lines.forEach( function ( line, idx ) {
			ctx.fillText( line, 150, startY + idx * lineHeight );
		} );
	}

	var STYLE_RENDERERS = {
		poster: drawPoster,
		magazine: drawMagazine,
		infographic: drawInfographic,
		illustration: drawIllustration,
		typography: drawTypography,
		gradient: drawGradientStyle,
		branding: drawBranding,
	};

	/**
	 * AI가 생성한 배경 이미지를 캔버스에 채운 뒤, 선택한 스타일의 텍스트 레이아웃을 오버레이한다.
	 */
	function renderThumbnail( canvas, img, text, styleKey ) {
		var ctx = canvas.getContext( '2d' );
		var w = canvas.width;
		var h = canvas.height;
		ctx.clearRect( 0, 0, w, h );
		drawImageCover( ctx, img, w, h );
		var renderer = STYLE_RENDERERS[ styleKey ] || drawGradientStyle;
		renderer( ctx, w, h, text || '제목을 입력하세요' );
	}

	/**
	 * 🖼️ AI 썸네일 탭. 실제 AI 이미지 생성(OpenAI/Gemini) 배경 + 캔버스 한글 텍스트 오버레이.
	 * 하단에 AI 스키마 마크업(JSON-LD) 생성 섹션을 포함한다.
	 */
	function ThumbnailTab( props ) {
		var canvasRef = useRef( null );

		var topicState = useState( '' );
		var topic = topicState[ 0 ];
		var setTopic = topicState[ 1 ];

		var styleState = useState( THUMBNAIL_STYLES[ 0 ].key );
		var styleKey = styleState[ 0 ];
		var setStyleKey = styleState[ 1 ];

		var engineState = useState( IMAGE_ENGINE_OPTIONS[ 0 ].value );
		var engine = engineState[ 0 ];
		var setEngine = engineState[ 1 ];

		var loadingState = useState( false );
		var loading = loadingState[ 0 ];
		var setLoading = loadingState[ 1 ];

		var progressState = useState( 0 );
		var progress = progressState[ 0 ];
		var setProgress = progressState[ 1 ];

		var hasImageState = useState( false );
		var hasImage = hasImageState[ 0 ];
		var setHasImage = hasImageState[ 1 ];

		var uploadingState = useState( false );
		var uploading = uploadingState[ 0 ];
		var setUploading = uploadingState[ 1 ];

		var errorState = useState( '' );
		var error = errorState[ 0 ];
		var setError = errorState[ 1 ];

		var schemaTypeState = useState( SCHEMA_TYPE_OPTIONS[ 0 ].key );
		var schemaType = schemaTypeState[ 0 ];
		var setSchemaType = schemaTypeState[ 1 ];

		var schemaLoadingState = useState( false );
		var schemaLoading = schemaLoadingState[ 0 ];
		var setSchemaLoading = schemaLoadingState[ 1 ];

		var schemaErrorState = useState( '' );
		var schemaError = schemaErrorState[ 0 ];
		var setSchemaError = schemaErrorState[ 1 ];

		var schemaSuccessState = useState( '' );
		var schemaSuccess = schemaSuccessState[ 0 ];
		var setSchemaSuccess = schemaSuccessState[ 1 ];

		function resolveSubject() {
			var editor = select( 'core/editor' );
			var titleValue = editor ? editor.getEditedPostAttribute( 'title' ) : '';
			return topic.trim() || props.focusKeyword.trim() || titleValue || '';
		}

		function generate() {
			setError( '' );
			var subject = resolveSubject();
			if ( ! subject ) {
				setError( '주제 키워드나 포커스 키워드, 글 제목 중 하나는 입력해 주세요.' );
				return;
			}

			setLoading( true );
			setProgress( 8 );
			// 실제 생성 진행률은 서버가 알려주지 않으므로(단일 요청-응답), 대기 중임을 보여주는
			// 시각적 진행 표시만 흉내낸다. 응답이 오면 즉시 100%로 맞추고 캔버스를 그린다.
			var progressTimer = setInterval( function () {
				setProgress( function ( p ) {
					return p < 90 ? p + Math.random() * 10 : p;
				} );
			}, 400 );

			apiFetch( {
				path: '/maiw/v1/generate-thumbnail',
				method: 'POST',
				data: { topic: subject, bannerText: topic.trim(), style: styleKey, provider: engine },
			} )
				.then( function ( res ) {
					return loadImage( res.image );
				} )
				.then( function ( img ) {
					clearInterval( progressTimer );
					setProgress( 100 );
					var canvas = canvasRef.current;
					if ( canvas ) {
						renderThumbnail( canvas, img, subject, styleKey );
						setHasImage( true );
					}
					setTimeout( function () {
						setLoading( false );
						setProgress( 0 );
					}, 400 );
				} )
				.catch( function ( err ) {
					clearInterval( progressTimer );
					setLoading( false );
					setProgress( 0 );
					setError( errorMessage( err ) );
				} );
		}

		function download() {
			var canvas = canvasRef.current;
			if ( ! canvas ) {
				return;
			}
			var link = document.createElement( 'a' );
			link.download = 'thumbnail.png';
			link.href = canvas.toDataURL( 'image/png' );
			link.click();
		}

		function insertIntoEditor() {
			var canvas = canvasRef.current;
			if ( ! canvas ) {
				return;
			}
			setUploading( true );
			setError( '' );
			canvas.toBlob( function ( blob ) {
				if ( ! blob ) {
					setUploading( false );
					setError( '이미지를 생성하지 못했습니다.' );
					return;
				}
				apiFetch( {
					path: '/wp/v2/media',
					method: 'POST',
					body: blob,
					headers: {
						'Content-Type': 'image/png',
						'Content-Disposition': 'attachment; filename="thumbnail.png"',
					},
				} )
					.then( function ( media ) {
						setUploading( false );
						var block = wp.blocks.createBlock( 'core/image', {
							url: media.source_url,
							id: media.id,
						} );
						dispatch( 'core/block-editor' ).insertBlocks( block );
					} )
					.catch( function ( err ) {
						setUploading( false );
						// 업로드 실패 시 최소한 data-URL 이미지 블록으로라도 삽입한다.
						var block = wp.blocks.createBlock( 'core/image', {
							url: canvas.toDataURL( 'image/png' ),
						} );
						dispatch( 'core/block-editor' ).insertBlocks( block );
						setError(
							'미디어 라이브러리 업로드에 실패해 이미지를 임시로 삽입했습니다: ' +
								errorMessage( err )
						);
					} );
			}, 'image/png' );
		}

		function generateSchema() {
			setSchemaError( '' );
			setSchemaSuccess( '' );
			var editor = select( 'core/editor' );
			var postId = editor ? editor.getCurrentPostId() : null;
			if ( ! postId ) {
				setSchemaError( '먼저 글을 저장(임시 저장)한 뒤 다시 시도하세요.' );
				return;
			}
			setSchemaLoading( true );
			apiFetch( {
				path: '/maiw/v1/generate-schema',
				method: 'POST',
				data: { postId: postId, schemaType: schemaType, focusKeyword: props.focusKeyword },
			} )
				.then( function () {
					setSchemaLoading( false );
					setSchemaSuccess( '스키마 마크업이 저장되었습니다. 게시된 페이지의 <head>에 자동으로 출력됩니다.' );
				} )
				.catch( function ( err ) {
					setSchemaLoading( false );
					setSchemaError( errorMessage( err ) );
				} );
		}

		return el(
			'div',
			{ className: 'maiw-tab-panel' },
			el( TextControl, {
				label: '주제 키워드',
				value: topic,
				onChange: setTopic,
				placeholder: props.focusKeyword || '비어 있으면 글 제목을 사용합니다',
			} ),
			el( SelectControl, {
				label: '생성 방식',
				value: engine,
				options: IMAGE_ENGINE_OPTIONS,
				onChange: setEngine,
				help: 'Claude는 이미지 생성을 지원하지 않아 목록에서 제외됩니다.',
			} ),
			el( 'div', { className: 'maiw-field-label' }, '썸네일 스타일' ),
			el(
				'div',
				{ className: 'maiw-chip-group' },
				THUMBNAIL_STYLES.map( function ( s ) {
					return el(
						'button',
						{
							type: 'button',
							key: s.key,
							className: 'maiw-chip' + ( s.key === styleKey ? ' is-active' : '' ),
							onClick: function () {
								setStyleKey( s.key );
							},
						},
						s.label
					);
				} )
			),
			el(
				Button,
				{
					variant: 'primary',
					className: 'maiw-run-button',
					onClick: generate,
					disabled: loading,
				},
				loading ? el( Spinner, null ) : '🖼️ 썸네일 생성'
			),
			loading &&
				el(
					'div',
					{ className: 'maiw-progress' },
					el(
						'div',
						{ className: 'maiw-progress-track' },
						el( 'div', {
							className: 'maiw-progress-bar',
							style: { width: Math.min( progress, 100 ) + '%' },
						} )
					),
					el( 'div', { className: 'maiw-progress-label' }, '이미지 생성 중… ' + Math.round( Math.min( progress, 100 ) ) + '%' )
				),
			error && el( Notice, { status: 'error', isDismissible: false }, error ),
			el( 'div', { className: 'maiw-canvas-wrap' },
				el( 'canvas', { ref: canvasRef, width: 1200, height: 630, className: 'maiw-canvas' } )
			),
			hasImage &&
				el(
					'div',
					{ className: 'maiw-result-actions' },
					el( Button, { variant: 'secondary', onClick: download }, '다운로드' ),
					el(
						Button,
						{ variant: 'primary', onClick: insertIntoEditor, disabled: uploading },
						uploading ? el( Spinner, null ) : '본문에 삽입'
					)
				),
			el( 'hr', { className: 'maiw-divider' } ),
			el( 'div', { className: 'maiw-panel-subtitle' }, 'AI 스키마 마크업' ),
			el( 'div', { className: 'maiw-field-label' }, '스키마 타입 선택' ),
			el(
				'div',
				{ className: 'maiw-chip-group' },
				SCHEMA_TYPE_OPTIONS.map( function ( s ) {
					return el(
						'button',
						{
							type: 'button',
							key: s.key,
							className: 'maiw-chip' + ( s.key === schemaType ? ' is-active' : '' ),
							onClick: function () {
								setSchemaType( s.key );
							},
						},
						s.label
					);
				} )
			),
			el(
				Button,
				{
					variant: 'secondary',
					className: 'maiw-run-button',
					onClick: generateSchema,
					disabled: schemaLoading,
				},
				schemaLoading ? el( Spinner, null ) : '본문 내용으로 생성하기'
			),
			schemaError && el( Notice, { status: 'error', isDismissible: false }, schemaError ),
			schemaSuccess && el( Notice, { status: 'success', isDismissible: false }, schemaSuccess )
		);
	}

	function App() {
		var tabState = useState( 'write' );
		var tab = tabState[ 0 ];
		var setTab = tabState[ 1 ];

		var focusKeywordState = useState( '' );
		var focusKeyword = focusKeywordState[ 0 ];
		var setFocusKeyword = focusKeywordState[ 1 ];

		return el(
			'div',
			{ className: 'maiw-panel' },
			el( 'div', { className: 'maiw-panel-title' }, 'AI 글쓰기 도우미' ),
			el( TextControl, {
				label: '포커스 키워드',
				value: focusKeyword,
				onChange: setFocusKeyword,
				placeholder: 'SEO 대상 키워드 (예: 여름철 냉방비 절약)',
			} ),
			el(
				'div',
				{ className: 'maiw-tabs' },
				el(
					'button',
					{
						type: 'button',
						className: 'maiw-tab' + ( tab === 'write' ? ' is-active' : '' ),
						onClick: function () {
							setTab( 'write' );
						},
					},
					'✍️ AI 글쓰기'
				),
				el(
					'button',
					{
						type: 'button',
						className: 'maiw-tab' + ( tab === 'thumbnail' ? ' is-active' : '' ),
						onClick: function () {
							setTab( 'thumbnail' );
						},
					},
					'🖼️ AI 썸네일'
				)
			),
			tab === 'write'
				? el( WriteTab, { focusKeyword: focusKeyword } )
				: el( ThumbnailTab, { focusKeyword: focusKeyword } )
		);
	}

	registerPlugin( 'maiw-sidebar', {
		icon: 'edit-page',
		render: function () {
			return el(
				Fragment,
				null,
				el(
					PluginSidebarMoreMenuItem,
					{ target: 'maiw-sidebar', icon: 'edit-page' },
					'AI 글쓰기 도우미'
				),
				el(
					PluginSidebar,
					{ name: 'maiw-sidebar', icon: 'edit-page', title: 'AI 글쓰기 도우미' },
					el( App, null )
				)
			);
		},
	} );
} )();
