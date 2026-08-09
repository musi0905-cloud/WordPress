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
	var Spinner = wp.components.Spinner;
	var Notice = wp.components.Notice;
	var apiFetch = wp.apiFetch;
	var dispatch = wp.data.dispatch;

	var TONE_OPTIONS = [ '친근하게', '전문적으로', '간결하게' ];
	var WORDS_OPTIONS = [
		{ label: '짧게', value: 500 },
		{ label: '보통', value: 900 },
		{ label: '길게', value: 1500 },
	];
	var COLOR_THEMES = [
		{ key: 'blue', label: '블루', from: '#2271b1', to: '#3858e9' },
		{ key: 'orange', label: '오렌지', from: '#e8590c', to: '#f2c94c' },
		{ key: 'green', label: '그린', from: '#0b7a5b', to: '#38ef7d' },
		{ key: 'purple', label: '퍼플', from: '#5b21b6', to: '#a855f7' },
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
	 * ✍️ 글쓰기 탭.
	 */
	function WriteTab() {
		var topicState = useState( '' );
		var topic = topicState[ 0 ];
		var setTopic = topicState[ 1 ];

		var keywordsState = useState( '' );
		var keywords = keywordsState[ 0 ];
		var setKeywords = keywordsState[ 1 ];

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

		var resultState = useState( null );
		var result = resultState[ 0 ];
		var setResult = resultState[ 1 ];

		function generate() {
			if ( ! topic.trim() ) {
				setError( '주제를 입력해 주세요.' );
				return;
			}
			setError( '' );
			setLoading( true );
			apiFetch( {
				path: '/maiw/v1/generate',
				method: 'POST',
				data: { topic: topic, keywords: keywords, tone: tone, words: words },
			} )
				.then( function ( res ) {
					setResult( res );
					setLoading( false );
				} )
				.catch( function ( err ) {
					setError( errorMessage( err ) );
					setLoading( false );
				} );
		}

		function insertIntoEditor() {
			if ( ! result ) {
				return;
			}
			dispatch( 'core/editor' ).editPost( { title: result.title } );
			var blocks = wp.blocks.rawHandler( { HTML: result.html } );
			dispatch( 'core/block-editor' ).insertBlocks( blocks );
		}

		return el(
			'div',
			{ className: 'maiw-tab-panel' },
			el( TextControl, {
				label: '주제',
				value: topic,
				onChange: setTopic,
				placeholder: '예: 여름철 냉방비 절약 방법',
			} ),
			el( TextControl, {
				label: '키워드 (선택)',
				value: keywords,
				onChange: setKeywords,
				placeholder: '쉼표로 구분',
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
				loading ? el( Spinner, null ) : '✍️ 글 생성하기'
			),
			error &&
				el( Notice, { status: 'error', isDismissible: false }, error ),
			result &&
				el(
					'div',
					{ className: 'maiw-result' },
					el( 'div', { className: 'maiw-result-title' }, result.title ),
					el( 'div', {
						className: 'maiw-result-preview',
						dangerouslySetInnerHTML: { __html: result.html },
					} ),
					el(
						'div',
						{ className: 'maiw-result-actions' },
						el(
							Button,
							{ variant: 'primary', onClick: insertIntoEditor },
							'본문에 삽입'
						),
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

	function drawThumbnail( canvas, text, theme ) {
		var ctx = canvas.getContext( '2d' );
		var w = canvas.width;
		var h = canvas.height;

		var gradient = ctx.createLinearGradient( 0, 0, w, h );
		gradient.addColorStop( 0, theme.from );
		gradient.addColorStop( 1, theme.to );
		ctx.fillStyle = gradient;
		ctx.fillRect( 0, 0, w, h );

		// 반투명 장식 도형.
		ctx.save();
		ctx.globalAlpha = 0.15;
		ctx.fillStyle = '#ffffff';
		ctx.beginPath();
		ctx.arc( w * 0.85, h * 0.15, 160, 0, Math.PI * 2 );
		ctx.fill();
		ctx.beginPath();
		ctx.arc( w * 0.1, h * 0.9, 120, 0, Math.PI * 2 );
		ctx.fill();
		ctx.restore();

		// 상단 배지.
		ctx.fillStyle = 'rgba(255,255,255,0.9)';
		ctx.fillRect( 60, 60, 120, 40 );
		ctx.fillStyle = theme.to;
		ctx.font = 'bold 20px sans-serif';
		ctx.textBaseline = 'middle';
		ctx.fillText( 'GUIDE', 84, 81 );

		// 제목.
		ctx.fillStyle = '#ffffff';
		ctx.font = 'bold 64px sans-serif';
		ctx.textBaseline = 'alphabetic';
		ctx.shadowColor = 'rgba(0,0,0,0.35)';
		ctx.shadowBlur = 12;
		ctx.shadowOffsetY = 4;

		var lines = wrapText( ctx, text || '제목을 입력하세요', w - 160 );
		var lineHeight = 76;
		var startY = h / 2 - ( ( lines.length - 1 ) * lineHeight ) / 2;
		lines.forEach( function ( line, idx ) {
			ctx.fillText( line, 80, startY + idx * lineHeight );
		} );

		ctx.shadowColor = 'transparent';
		ctx.shadowBlur = 0;
		ctx.shadowOffsetY = 0;

		// 하단 CTA.
		ctx.fillStyle = 'rgba(255,255,255,0.85)';
		ctx.font = '28px sans-serif';
		ctx.fillText( '클릭해서 자세히 보기 →', 80, h - 60 );
	}

	/**
	 * 🖼️ 썸네일 탭.
	 */
	function ThumbnailTab() {
		var canvasRef = useRef( null );

		var bannerState = useState( '' );
		var bannerText = bannerState[ 0 ];
		var setBannerText = bannerState[ 1 ];

		var themeState = useState( COLOR_THEMES[ 0 ].key );
		var themeKey = themeState[ 0 ];
		var setThemeKey = themeState[ 1 ];

		var hasImageState = useState( false );
		var hasImage = hasImageState[ 0 ];
		var setHasImage = hasImageState[ 1 ];

		var uploadingState = useState( false );
		var uploading = uploadingState[ 0 ];
		var setUploading = uploadingState[ 1 ];

		var errorState = useState( '' );
		var error = errorState[ 0 ];
		var setError = errorState[ 1 ];

		function getTheme() {
			var found = null;
			COLOR_THEMES.forEach( function ( t ) {
				if ( t.key === themeKey ) {
					found = t;
				}
			} );
			return found || COLOR_THEMES[ 0 ];
		}

		function generate() {
			setError( '' );
			var canvas = canvasRef.current;
			if ( ! canvas ) {
				return;
			}
			var titleValue = wp.data.select( 'core/editor' )
				? wp.data.select( 'core/editor' ).getEditedPostAttribute( 'title' )
				: '';
			var text = bannerText.trim() || titleValue || '제목을 입력하세요';
			drawThumbnail( canvas, text, getTheme() );
			setHasImage( true );
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

		return el(
			'div',
			{ className: 'maiw-tab-panel' },
			el( TextControl, {
				label: '배너 문구',
				value: bannerText,
				onChange: setBannerText,
				placeholder: '비어 있으면 글 제목을 사용합니다',
			} ),
			el( 'div', { className: 'maiw-field-label' }, '색상 테마' ),
			el(
				'div',
				{ className: 'maiw-chip-group' },
				COLOR_THEMES.map( function ( t ) {
					return el(
						'button',
						{
							type: 'button',
							key: t.key,
							className:
								'maiw-chip maiw-theme-chip' +
								( t.key === themeKey ? ' is-active' : '' ),
							style: {
								background: 'linear-gradient(135deg,' + t.from + ',' + t.to + ')',
							},
							onClick: function () {
								setThemeKey( t.key );
							},
						},
						t.label
					);
				} )
			),
			el(
				Button,
				{ variant: 'primary', className: 'maiw-run-button', onClick: generate },
				'🖼️ 썸네일 만들기'
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
				)
		);
	}

	function App() {
		var tabState = useState( 'write' );
		var tab = tabState[ 0 ];
		var setTab = tabState[ 1 ];

		return el(
			'div',
			{ className: 'maiw-panel' },
			el( 'div', { className: 'maiw-panel-title' }, 'AI 글쓰기 도우미' ),
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
					'✍️ 글쓰기'
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
					'🖼️ 썸네일'
				)
			),
			tab === 'write' ? el( WriteTab, null ) : el( ThumbnailTab, null )
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
