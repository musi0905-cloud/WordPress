<?php
/**
 * Plugin Name: AI 글쓰기 패널 (My AI Writer)
 * Plugin URI: https://example.com/my-ai-writer
 * Description: 구텐베르크 편집기에 AI 글쓰기 사이드바 패널을 추가합니다. 주제만 입력하면 SEO 블로그 글과 썸네일 이미지를 생성해 편집기에 바로 삽입할 수 있습니다. Claude / OpenAI / Gemini 중 선택해 사용합니다.
 * Version: 1.0.0
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author: Content OS
 * Text Domain: my-ai-writer
 */

// 워드프레스 외부에서 직접 접근하는 것을 막는다.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MAIW_VERSION', '1.0.0' );
define( 'MAIW_PLUGIN_FILE', __FILE__ );
define( 'MAIW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'MAIW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once MAIW_PLUGIN_DIR . 'admin-settings.php';

/**
 * 글 편집 화면(구텐베르크)에서만 사이드바 패널 스크립트를 로드한다.
 */
function maiw_enqueue_block_editor_assets() {
	$screen = get_current_screen();
	if ( ! $screen || ! $screen->is_block_editor() ) {
		return;
	}

	wp_enqueue_script(
		'maiw-editor',
		MAIW_PLUGIN_URL . 'assets/editor.js',
		array( 'wp-plugins', 'wp-edit-post', 'wp-element', 'wp-components', 'wp-data', 'wp-api-fetch', 'wp-block-editor', 'wp-blocks', 'wp-i18n' ),
		MAIW_VERSION,
		true
	);

	wp_enqueue_style(
		'maiw-editor',
		MAIW_PLUGIN_URL . 'assets/editor.css',
		array( 'wp-components' ),
		MAIW_VERSION
	);
}
add_action( 'enqueue_block_editor_assets', 'maiw_enqueue_block_editor_assets' );

/**
 * REST 라우트를 등록한다. 외부 AI 호출은 전부 이 서버측 콜백 안에서만 이뤄진다.
 */
function maiw_register_rest_routes() {
	register_rest_route(
		'maiw/v1',
		'/generate',
		array(
			'methods'             => 'POST',
			'callback'            => 'maiw_handle_generate_request',
			'permission_callback' => function () {
				return current_user_can( 'edit_posts' );
			},
			'args'                => array(
				'topic'       => array( 'type' => 'string', 'required' => true ),
				'keywords'    => array( 'type' => 'string', 'required' => false ),
				'tone'        => array( 'type' => 'string', 'required' => false ),
				'words'       => array( 'type' => 'integer', 'required' => false ),
				'provider'    => array( 'type' => 'string', 'required' => false ),
				'contentType' => array( 'type' => 'string', 'required' => false ),
				'language'    => array( 'type' => 'string', 'required' => false ),
			),
		)
	);

	register_rest_route(
		'maiw/v1',
		'/generate-schema',
		array(
			'methods'             => 'POST',
			'callback'            => 'maiw_handle_generate_schema_request',
			'permission_callback' => function ( $request ) {
				$post_id = (int) $request->get_param( 'postId' );
				return $post_id ? current_user_can( 'edit_post', $post_id ) : current_user_can( 'edit_posts' );
			},
			'args'                => array(
				'postId'       => array( 'type' => 'integer', 'required' => true ),
				'schemaType'   => array( 'type' => 'string', 'required' => true ),
				'focusKeyword' => array( 'type' => 'string', 'required' => false ),
			),
		)
	);

	register_rest_route(
		'maiw/v1',
		'/generate-thumbnail',
		array(
			'methods'             => 'POST',
			'callback'            => 'maiw_handle_generate_thumbnail_request',
			'permission_callback' => function () {
				return current_user_can( 'edit_posts' );
			},
			'args'                => array(
				'topic'      => array( 'type' => 'string', 'required' => true ),
				'bannerText' => array( 'type' => 'string', 'required' => false ),
				'style'      => array( 'type' => 'string', 'required' => true ),
				'provider'   => array( 'type' => 'string', 'required' => true ),
			),
		)
	);
}
add_action( 'rest_api_init', 'maiw_register_rest_routes' );

/**
 * 실패 응답을 { "error": "..." } 형태의 JSON으로 통일해서 만든다.
 *
 * @return WP_REST_Response
 */
function maiw_error_response( $message, $status = 400 ) {
	$response = new WP_REST_Response( array( 'error' => $message ), $status );
	return $response;
}

/**
 * /maiw/v1/generate 요청을 처리한다.
 *
 * @param WP_REST_Request $request
 * @return WP_REST_Response
 */
function maiw_handle_generate_request( WP_REST_Request $request ) {
	$topic        = sanitize_text_field( (string) $request->get_param( 'topic' ) );
	$keywords     = sanitize_text_field( (string) $request->get_param( 'keywords' ) );
	$tone         = sanitize_text_field( (string) $request->get_param( 'tone' ) );
	$words        = absint( $request->get_param( 'words' ) );
	$content_type = sanitize_text_field( (string) $request->get_param( 'contentType' ) );
	$language     = sanitize_text_field( (string) $request->get_param( 'language' ) );

	if ( '' === $topic ) {
		return maiw_error_response( '주제를 입력해 주세요.', 400 );
	}

	$settings = maiw_get_settings();
	$provider = sanitize_text_field( (string) $request->get_param( 'provider' ) );
	if ( '' === $provider ) {
		$provider = $settings['default_engine'];
	}
	if ( '' === $tone ) {
		$tone = $settings['default_tone'];
	}
	if ( ! $words ) {
		$words = (int) $settings['default_words'];
	}

	$api_key = '';
	$model   = '';
	switch ( $provider ) {
		case 'claude':
			$api_key = $settings['claude_api_key'];
			$model   = $settings['claude_model'];
			break;
		case 'openai':
			$api_key = $settings['openai_api_key'];
			$model   = $settings['openai_model'];
			break;
		case 'gemini':
			$api_key = $settings['gemini_api_key'];
			$model   = $settings['gemini_model'];
			break;
		default:
			return maiw_error_response( '알 수 없는 AI 엔진입니다.', 400 );
	}

	if ( '' === $api_key || '' === $model ) {
		return maiw_error_response(
			'API 키를 설정에서 먼저 입력하세요. (설정 > AI 글쓰기 패널)',
			400
		);
	}

	$system_prompt = maiw_build_system_prompt( $tone, $words, $content_type, $language );
	$user_prompt   = maiw_build_user_prompt( $topic, $keywords, $tone, $words );

	switch ( $provider ) {
		case 'claude':
			$raw_text = maiw_call_claude( $api_key, $model, $system_prompt, $user_prompt );
			break;
		case 'openai':
			$raw_text = maiw_call_openai( $api_key, $model, $system_prompt, $user_prompt );
			break;
		case 'gemini':
			$raw_text = maiw_call_gemini( $api_key, $model, $system_prompt, $user_prompt );
			break;
	}

	if ( $raw_text instanceof WP_REST_Response ) {
		return $raw_text;
	}

	$parsed = maiw_parse_ai_json( $raw_text );
	if ( $parsed instanceof WP_REST_Response ) {
		return $parsed;
	}

	return new WP_REST_Response(
		array(
			'title' => sanitize_text_field( $parsed['title'] ),
			'html'  => wp_kses_post( $parsed['html'] ),
		),
		200
	);
}

/**
 * "글 유형" 선택지와 각 유형의 글 구조 가이드.
 */
function maiw_get_content_types() {
	return array(
		'info_guide' => array(
			'label'    => '정보/가이드',
			'guidance' => '개념을 먼저 설명하고 실용적인 정보를 단계적으로 안내하는 가이드 형식',
		),
		'utility'    => array(
			'label'    => '유틸리티',
			'guidance' => '실생활에 바로 쓸 수 있는 방법이나 도구·서비스 활용법을 안내하는 유틸리티 형식',
		),
		'policy'     => array(
			'label'    => '정책/안내',
			'guidance' => '제도나 정책, 신청 절차를 대상·조건·절차 중심으로 안내하는 공지형 형식',
		),
		'review'     => array(
			'label'    => '리뷰',
			'guidance' => '장단점을 비교하며 실사용 관점에서 설명하는 리뷰 형식',
		),
		'list'       => array(
			'label'    => '목록형',
			'guidance' => '번호를 매긴 항목을 나열하며 각 항목을 짧게 설명하는 리스트형 형식',
		),
		'news'       => array(
			'label'    => '뉴스/트렌드',
			'guidance' => '최신 동향이나 이슈를 배경과 핵심 포인트 중심으로 정리하는 뉴스형 형식',
		),
	);
}

/**
 * "언어 선택" 선택지.
 */
function maiw_get_languages() {
	return array(
		'ko' => '한국어',
		'en' => 'English',
		'ja' => '日本語',
		'zh' => '中文',
	);
}

/**
 * AI에게 보낼 시스템 프롬프트를 구성한다.
 */
function maiw_build_system_prompt( $tone, $words, $content_type = '', $language = '' ) {
	$languages     = maiw_get_languages();
	$lang_label    = isset( $languages[ $language ] ) ? $languages[ $language ] : $languages['ko'];
	$content_types = maiw_get_content_types();

	$prompt = "당신은 SEO 블로그 작가입니다. 사용자가 준 주제로 정확하고 독창적인 글을 {$lang_label}로 작성합니다. "
		. "말투는 '{$tone}'으로, 분량은 약 {$words}자로 작성합니다. ";

	if ( isset( $content_types[ $content_type ] ) ) {
		$type = $content_types[ $content_type ];
		$prompt .= "글 유형은 '{$type['label']}'이며, {$type['guidance']}으로 작성합니다. ";
	}

	$prompt .= "본문은 h2, h3, p, ul, li, table 태그만 사용한 HTML로 작성하고, 확인되지 않은 사실이나 가짜 후기/경험/통계는 만들지 않습니다. "
		. '반드시 다음 JSON 형식으로만 응답하십시오. 다른 설명이나 코드블록 표시 없이 순수 JSON 객체 하나만 출력하십시오: '
		. '{"title":"<50자 이내 제목>","html":"<본문 HTML>"}';

	return $prompt;
}

/**
 * AI에게 보낼 유저 프롬프트를 구성한다.
 */
function maiw_build_user_prompt( $topic, $keywords, $tone, $words ) {
	$prompt = "주제: {$topic}\n";
	if ( '' !== $keywords ) {
		$prompt .= "키워드: {$keywords}\n";
	}
	$prompt .= "말투: {$tone}\n분량: 약 {$words}자\n";
	$prompt .= '위 조건에 맞는 블로그 글의 제목과 본문 HTML을 JSON으로만 응답하세요.';
	return $prompt;
}

/**
 * Claude(Anthropic) Messages API를 호출한다.
 *
 * @return string|WP_REST_Response
 */
function maiw_call_claude( $api_key, $model, $system_prompt, $user_prompt ) {
	$response = wp_remote_post(
		'https://api.anthropic.com/v1/messages',
		array(
			'timeout' => 90,
			'headers' => array(
				'x-api-key'         => $api_key,
				'anthropic-version' => '2023-06-01',
				'content-type'      => 'application/json',
			),
			'body'    => wp_json_encode(
				array(
					'model'      => $model,
					'max_tokens' => 4000,
					'system'     => $system_prompt,
					'messages'   => array(
						array( 'role' => 'user', 'content' => $user_prompt ),
					),
				)
			),
		)
	);

	if ( is_wp_error( $response ) ) {
		return maiw_error_response( 'Claude API 요청에 실패했습니다: ' . $response->get_error_message(), 502 );
	}

	$raw_body = wp_remote_retrieve_body( $response );
	$body     = json_decode( $raw_body, true );
	$code     = wp_remote_retrieve_response_code( $response );

	if ( isset( $body['error'] ) ) {
		$message = isset( $body['error']['message'] ) ? $body['error']['message'] : '알 수 없는 오류';
		return maiw_error_response( 'Claude API 오류: ' . $message, $code ? $code : 502 );
	}

	if ( null === $body ) {
		// 서버가 JSON이 아닌 응답을 보냈다 — 호스팅사 방화벽/프록시가 외부 API 호출을 가로챘을 가능성이 높다.
		return maiw_error_response(
			"Claude API 응답을 해석할 수 없습니다 (HTTP {$code}, JSON 아님). 호스팅사 방화벽이 api.anthropic.com 접속을 막고 있을 수 있습니다. 응답 일부: " . mb_substr( wp_strip_all_tags( $raw_body ), 0, 200 ),
			502
		);
	}

	// content는 여러 블록으로 올 수 있다(예: 확장 사고 모델의 thinking 블록이 먼저 오는 경우) —
	// text 타입 블록만 찾아서 이어붙인다. content[0]만 가정하지 않는다.
	$text_parts = array();
	if ( ! empty( $body['content'] ) && is_array( $body['content'] ) ) {
		foreach ( $body['content'] as $block ) {
			if ( isset( $block['type'] ) && 'text' === $block['type'] && isset( $block['text'] ) ) {
				$text_parts[] = $block['text'];
			}
		}
	}

	if ( empty( $text_parts ) ) {
		$stop_reason = isset( $body['stop_reason'] ) ? $body['stop_reason'] : '알 수 없음';
		return maiw_error_response(
			"Claude API 응답에 텍스트가 없습니다 (모델: {$model}, stop_reason: {$stop_reason}). 모델명이 올바른지 설정에서 확인하세요.",
			502
		);
	}

	return implode( '', $text_parts );
}

/**
 * OpenAI Chat Completions API를 호출한다.
 *
 * @return string|WP_REST_Response
 */
function maiw_call_openai( $api_key, $model, $system_prompt, $user_prompt ) {
	$response = wp_remote_post(
		'https://api.openai.com/v1/chat/completions',
		array(
			'timeout' => 90,
			'headers' => array(
				'Authorization' => 'Bearer ' . $api_key,
				'Content-Type'  => 'application/json',
			),
			'body'    => wp_json_encode(
				array(
					'model'    => $model,
					'messages' => array(
						array( 'role' => 'system', 'content' => $system_prompt ),
						array( 'role' => 'user', 'content' => $user_prompt ),
					),
				)
			),
		)
	);

	if ( is_wp_error( $response ) ) {
		return maiw_error_response( 'OpenAI API 요청에 실패했습니다: ' . $response->get_error_message(), 502 );
	}

	$raw_body = wp_remote_retrieve_body( $response );
	$body     = json_decode( $raw_body, true );
	$code     = wp_remote_retrieve_response_code( $response );

	if ( isset( $body['error'] ) ) {
		$message = isset( $body['error']['message'] ) ? $body['error']['message'] : '알 수 없는 오류';
		return maiw_error_response( 'OpenAI API 오류: ' . $message, $code ? $code : 502 );
	}

	if ( null === $body ) {
		return maiw_error_response(
			"OpenAI API 응답을 해석할 수 없습니다 (HTTP {$code}, JSON 아님). 응답 일부: " . mb_substr( wp_strip_all_tags( $raw_body ), 0, 200 ),
			502
		);
	}

	if ( empty( $body['choices'][0]['message']['content'] ) ) {
		$finish_reason = isset( $body['choices'][0]['finish_reason'] ) ? $body['choices'][0]['finish_reason'] : '알 수 없음';
		return maiw_error_response(
			"OpenAI API 응답에 텍스트가 없습니다 (모델: {$model}, finish_reason: {$finish_reason}). 모델명이 올바른지 설정에서 확인하세요.",
			502
		);
	}

	return $body['choices'][0]['message']['content'];
}

/**
 * Google Gemini generateContent API를 호출한다.
 *
 * @return string|WP_REST_Response
 */
function maiw_call_gemini( $api_key, $model, $system_prompt, $user_prompt ) {
	$url = sprintf(
		'https://generativelanguage.googleapis.com/v1beta/models/%s:generateContent?key=%s',
		rawurlencode( $model ),
		rawurlencode( $api_key )
	);

	$response = wp_remote_post(
		$url,
		array(
			'timeout' => 90,
			'headers' => array(
				'Content-Type' => 'application/json',
			),
			'body'    => wp_json_encode(
				array(
					'systemInstruction' => array(
						'parts' => array( array( 'text' => $system_prompt ) ),
					),
					'contents'          => array(
						array( 'parts' => array( array( 'text' => $user_prompt ) ) ),
					),
				)
			),
		)
	);

	if ( is_wp_error( $response ) ) {
		return maiw_error_response( 'Gemini API 요청에 실패했습니다: ' . $response->get_error_message(), 502 );
	}

	$raw_body = wp_remote_retrieve_body( $response );
	$body     = json_decode( $raw_body, true );
	$code     = wp_remote_retrieve_response_code( $response );

	if ( isset( $body['error'] ) ) {
		$message = isset( $body['error']['message'] ) ? $body['error']['message'] : '알 수 없는 오류';
		return maiw_error_response( 'Gemini API 오류: ' . $message, $code ? $code : 502 );
	}

	if ( null === $body ) {
		return maiw_error_response(
			"Gemini API 응답을 해석할 수 없습니다 (HTTP {$code}, JSON 아님). 응답 일부: " . mb_substr( wp_strip_all_tags( $raw_body ), 0, 200 ),
			502
		);
	}

	// parts에는 "thought" 파트(사고 과정)가 섞여 올 수 있다 — thought가 아닌 text만 이어붙인다.
	$text_parts = array();
	$parts      = isset( $body['candidates'][0]['content']['parts'] ) ? $body['candidates'][0]['content']['parts'] : array();
	foreach ( $parts as $part ) {
		if ( ! empty( $part['thought'] ) ) {
			continue;
		}
		if ( isset( $part['text'] ) ) {
			$text_parts[] = $part['text'];
		}
	}

	if ( empty( $text_parts ) ) {
		$finish_reason = isset( $body['candidates'][0]['finishReason'] ) ? $body['candidates'][0]['finishReason'] : '알 수 없음';
		return maiw_error_response(
			"Gemini API 응답에 텍스트가 없습니다 (모델: {$model}, finishReason: {$finish_reason}). 모델명이 올바른지 설정에서 확인하세요.",
			502
		);
	}

	return implode( '', $text_parts );
}

/**
 * AI 응답 텍스트에서 {"title":...,"html":...} JSON을 방어적으로 파싱한다.
 * 코드블록(```json ... ```)이나 앞뒤 잡텍스트가 섞여 와도 처리한다.
 *
 * @return array|WP_REST_Response
 */
/**
 * AI 응답 텍스트에서 JSON 객체를 방어적으로 추출한다. 코드블록 표시나
 * 앞뒤 잡텍스트가 섞여 와도 처리한다. 실패하면 null을 반환한다.
 */
function maiw_extract_json_object( $raw_text ) {
	$text = trim( (string) $raw_text );

	$decoded = json_decode( $text, true );

	if ( ! is_array( $decoded ) ) {
		// 코드블록 표시를 제거해 본다.
		$stripped = preg_replace( '/^```(?:json)?\s*|\s*```$/m', '', $text );
		$decoded  = json_decode( trim( $stripped ), true );
	}

	if ( ! is_array( $decoded ) ) {
		// 텍스트 중간에 섞인 JSON 객체만 추출해 본다.
		if ( preg_match( '/\{.*\}/s', $text, $matches ) ) {
			$decoded = json_decode( $matches[0], true );
		}
	}

	return is_array( $decoded ) ? $decoded : null;
}

function maiw_parse_ai_json( $raw_text ) {
	$decoded = maiw_extract_json_object( $raw_text );

	if ( ! is_array( $decoded ) || ! isset( $decoded['title'], $decoded['html'] ) ) {
		return maiw_error_response(
			'AI 응답을 해석할 수 없습니다. 잠시 후 다시 시도해 주세요.',
			502
		);
	}

	return array(
		'title' => (string) $decoded['title'],
		'html'  => (string) $decoded['html'],
	);
}

/**
 * 썸네일 스타일별 이미지 생성 프롬프트 문구. 실제 문구는 한글 렌더링 대신
 * "텍스트 없는 배경"을 만들도록 지시하고, 한글 제목은 클라이언트 캔버스에서
 * 오버레이한다(하이브리드 방식 유지 — AI가 한글을 직접 그리게 하지 않는다).
 */
function maiw_get_thumbnail_styles() {
	return array(
		'poster'       => 'a bold dramatic movie-poster style illustration, high contrast lighting, cinematic composition',
		'magazine'     => 'a clean editorial magazine cover style background, soft studio lighting, minimal elegant composition',
		'infographic'  => 'a flat infographic style background with simple geometric icons and shapes, pastel color palette',
		'illustration' => 'a friendly flat vector illustration background with simple characters and objects, warm color palette',
		'typography'   => 'a minimal abstract background with soft color blocks and large empty negative space',
		'gradient'     => 'a smooth abstract gradient background with soft blurred organic shapes, vibrant modern colors',
		'branding'     => 'a clean corporate brand style background with a bold color block on one side and subtle geometric shapes',
	);
}

/**
 * AI 이미지 생성 프롬프트를 구성한다. 텍스트를 그리지 말라고 명시해 한글 깨짐을 방지한다.
 */
function maiw_build_image_prompt( $style, $topic, $banner_text ) {
	$styles      = maiw_get_thumbnail_styles();
	$style_desc  = isset( $styles[ $style ] ) ? $styles[ $style ] : $styles['gradient'];
	$subject     = '' !== $banner_text ? $banner_text : $topic;

	return "Create a wide 1200x630 blog thumbnail background image about: {$subject}. "
		. "Visual style: {$style_desc}. "
		. 'IMPORTANT: Do not render any text, letters, numbers, or words anywhere in the image — '
		. 'leave clean open space for a title to be overlaid afterwards. No watermark, no logo, no borders.';
}

/**
 * /maiw/v1/generate-thumbnail 요청을 처리한다. Claude는 이미지 생성 API가 없어 지원하지 않는다.
 *
 * @return WP_REST_Response
 */
function maiw_handle_generate_thumbnail_request( WP_REST_Request $request ) {
	$topic       = sanitize_text_field( (string) $request->get_param( 'topic' ) );
	$banner_text = sanitize_text_field( (string) $request->get_param( 'bannerText' ) );
	$style       = sanitize_text_field( (string) $request->get_param( 'style' ) );
	$provider    = sanitize_text_field( (string) $request->get_param( 'provider' ) );

	if ( '' === $topic ) {
		return maiw_error_response( '주제를 입력해 주세요.', 400 );
	}

	$allowed_styles = array_keys( maiw_get_thumbnail_styles() );
	if ( ! in_array( $style, $allowed_styles, true ) ) {
		return maiw_error_response( '알 수 없는 썸네일 스타일입니다.', 400 );
	}

	if ( ! in_array( $provider, array( 'openai', 'gemini' ), true ) ) {
		return maiw_error_response( 'Claude는 이미지 생성을 지원하지 않습니다. OpenAI 또는 Gemini를 선택하세요.', 400 );
	}

	$settings = maiw_get_settings();
	$prompt   = maiw_build_image_prompt( $style, $topic, $banner_text );

	if ( 'openai' === $provider ) {
		$api_key = $settings['openai_api_key'];
		$model   = $settings['openai_image_model'];
		if ( '' === $api_key || '' === $model ) {
			return maiw_error_response( 'OpenAI API 키를 설정에서 먼저 입력하세요. (설정 > AI 글쓰기 패널)', 400 );
		}
		$image = maiw_call_openai_image( $api_key, $model, $prompt );
	} else {
		$api_key = $settings['gemini_api_key'];
		$model   = $settings['gemini_image_model'];
		if ( '' === $api_key || '' === $model ) {
			return maiw_error_response( 'Gemini API 키를 설정에서 먼저 입력하세요. (설정 > AI 글쓰기 패널)', 400 );
		}
		$image = maiw_call_gemini_image( $api_key, $model, $prompt );
	}

	if ( $image instanceof WP_REST_Response ) {
		return $image;
	}

	return new WP_REST_Response( array( 'image' => $image ), 200 );
}

/**
 * OpenAI 이미지 생성 API(Images API)를 호출하고 data: URI를 반환한다.
 * 캔버스에서 바로 그리고 toDataURL/toBlob으로 내보낼 수 있도록 항상 base64 data URI로 반환한다
 * (원격 URL을 그대로 넘기면 캔버스가 cross-origin으로 오염되어 내보내기가 막힌다).
 *
 * @return string|WP_REST_Response
 */
function maiw_call_openai_image( $api_key, $model, $prompt ) {
	$is_dalle = false !== stripos( $model, 'dall-e' );

	$body = array(
		'model'  => $model,
		'prompt' => $prompt,
		'n'      => 1,
		'size'   => $is_dalle ? '1792x1024' : '1536x1024',
	);
	if ( $is_dalle ) {
		$body['response_format'] = 'b64_json';
	}

	$response = wp_remote_post(
		'https://api.openai.com/v1/images/generations',
		array(
			'timeout' => 90,
			'headers' => array(
				'Authorization' => 'Bearer ' . $api_key,
				'Content-Type'  => 'application/json',
			),
			'body'    => wp_json_encode( $body ),
		)
	);

	if ( is_wp_error( $response ) ) {
		return maiw_error_response( 'OpenAI 이미지 생성 요청에 실패했습니다: ' . $response->get_error_message(), 502 );
	}

	$decoded = json_decode( wp_remote_retrieve_body( $response ), true );
	$code    = wp_remote_retrieve_response_code( $response );

	if ( isset( $decoded['error'] ) ) {
		$message = isset( $decoded['error']['message'] ) ? $decoded['error']['message'] : '알 수 없는 오류';
		return maiw_error_response( 'OpenAI 이미지 생성 오류: ' . $message, $code ? $code : 502 );
	}

	if ( ! empty( $decoded['data'][0]['b64_json'] ) ) {
		return 'data:image/png;base64,' . $decoded['data'][0]['b64_json'];
	}

	// b64_json이 없으면 url로 온 것 — 서버에서 다시 받아와 base64로 변환한다.
	if ( ! empty( $decoded['data'][0]['url'] ) ) {
		$image_response = wp_remote_get( $decoded['data'][0]['url'], array( 'timeout' => 90 ) );
		if ( is_wp_error( $image_response ) ) {
			return maiw_error_response( '생성된 이미지를 가져오지 못했습니다: ' . $image_response->get_error_message(), 502 );
		}
		$bytes = wp_remote_retrieve_body( $image_response );
		if ( '' === $bytes ) {
			return maiw_error_response( '생성된 이미지가 비어 있습니다.', 502 );
		}
		return 'data:image/png;base64,' . base64_encode( $bytes );
	}

	return maiw_error_response( 'OpenAI 이미지 생성 응답이 비어 있습니다.', 502 );
}

/**
 * Gemini 이미지 생성 모델(generateContent, 이미지 출력 모델)을 호출하고 data: URI를 반환한다.
 *
 * @return string|WP_REST_Response
 */
function maiw_call_gemini_image( $api_key, $model, $prompt ) {
	$url = sprintf(
		'https://generativelanguage.googleapis.com/v1beta/models/%s:generateContent?key=%s',
		rawurlencode( $model ),
		rawurlencode( $api_key )
	);

	$response = wp_remote_post(
		$url,
		array(
			'timeout' => 90,
			'headers' => array(
				'Content-Type' => 'application/json',
			),
			'body'    => wp_json_encode(
				array(
					'contents'         => array(
						array( 'parts' => array( array( 'text' => $prompt ) ) ),
					),
					'generationConfig' => array(
						'responseModalities' => array( 'IMAGE' ),
					),
				)
			),
		)
	);

	if ( is_wp_error( $response ) ) {
		return maiw_error_response( 'Gemini 이미지 생성 요청에 실패했습니다: ' . $response->get_error_message(), 502 );
	}

	$decoded = json_decode( wp_remote_retrieve_body( $response ), true );
	$code    = wp_remote_retrieve_response_code( $response );

	if ( isset( $decoded['error'] ) ) {
		$message = isset( $decoded['error']['message'] ) ? $decoded['error']['message'] : '알 수 없는 오류';
		return maiw_error_response( 'Gemini 이미지 생성 오류: ' . $message, $code ? $code : 502 );
	}

	$parts = isset( $decoded['candidates'][0]['content']['parts'] ) ? $decoded['candidates'][0]['content']['parts'] : array();
	foreach ( $parts as $part ) {
		if ( ! empty( $part['inlineData']['data'] ) ) {
			$mime = ! empty( $part['inlineData']['mimeType'] ) ? $part['inlineData']['mimeType'] : 'image/png';
			return 'data:' . $mime . ';base64,' . $part['inlineData']['data'];
		}
	}

	return maiw_error_response( 'Gemini 이미지 생성 응답이 비어 있습니다.', 502 );
}

/**
 * provider 이름에 맞는 (API 키, 모델명) 쌍을 돌려준다. 이미지가 아닌 텍스트 생성용 모델이다.
 */
function maiw_resolve_text_credentials( $provider, $settings ) {
	switch ( $provider ) {
		case 'claude':
			return array( $settings['claude_api_key'], $settings['claude_model'] );
		case 'openai':
			return array( $settings['openai_api_key'], $settings['openai_model'] );
		case 'gemini':
			return array( $settings['gemini_api_key'], $settings['gemini_model'] );
	}
	return array( '', '' );
}

/**
 * "AI 스키마 마크업" 타입별 schema.org @type 매핑.
 */
function maiw_get_schema_type_map() {
	return array(
		'article'        => 'Article',
		'product_review' => 'Review',
		'faq'            => 'FAQPage',
	);
}

/**
 * 본문 내용으로 schema.org JSON-LD를 만들도록 AI에게 보낼 프롬프트를 구성한다.
 * 본문에 없는 사실(평점, 질문 등)은 지어내지 말라고 명시한다.
 */
function maiw_build_schema_prompt( $schema_type, $title, $content_text, $focus_keyword ) {
	$type_map        = maiw_get_schema_type_map();
	$schema_org_type = isset( $type_map[ $schema_type ] ) ? $type_map[ $schema_type ] : 'Article';

	$prompt = "다음은 블로그 글의 제목과 본문입니다.\n제목: {$title}\n";
	if ( '' !== $focus_keyword ) {
		$prompt .= "포커스 키워드: {$focus_keyword}\n";
	}
	$prompt .= "본문:\n{$content_text}\n\n";
	$prompt .= "위 글 내용을 바탕으로 schema.org의 \"{$schema_org_type}\" 타입 JSON-LD를 만드세요. "
		. '@context는 "https://schema.org", @type은 "' . $schema_org_type . '"로 설정합니다. ';

	switch ( $schema_type ) {
		case 'article':
			$prompt .= 'headline(60자 이내), description(150자 이내 요약), keywords 필드를 포함하세요.';
			break;
		case 'product_review':
			$prompt .= 'itemReviewed(name 포함), reviewBody(요약), author(name) 필드를 포함하세요. '
				. '본문에 실제 평점 정보가 없다면 reviewRating은 만들어내지 말고 아예 생략하세요.';
			break;
		case 'faq':
			$prompt .= '본문에서 실제로 다루는 질문과 답변만 3~6개 뽑아 mainEntity 배열에 '
				. '{"@type":"Question","name":"...","acceptedAnswer":{"@type":"Answer","text":"..."}} 형태로 담으세요. '
				. '본문에 없는 질문을 지어내지 마세요.';
			break;
	}

	$prompt .= ' 반드시 순수 JSON 객체 하나만 출력하고, 다른 설명이나 코드블록 표시는 쓰지 마세요.';

	return $prompt;
}

/**
 * /maiw/v1/generate-schema 요청을 처리한다. 현재 글의 본문을 읽어 AI로 JSON-LD를 만들고
 * 포스트 메타에 저장한다. 실제 출력은 maiw_output_schema_markup()이 wp_head에서 담당한다.
 *
 * @return WP_REST_Response
 */
function maiw_handle_generate_schema_request( WP_REST_Request $request ) {
	$post_id       = absint( $request->get_param( 'postId' ) );
	$schema_type   = sanitize_text_field( (string) $request->get_param( 'schemaType' ) );
	$focus_keyword = sanitize_text_field( (string) $request->get_param( 'focusKeyword' ) );

	$type_map = maiw_get_schema_type_map();
	if ( ! isset( $type_map[ $schema_type ] ) ) {
		return maiw_error_response( '알 수 없는 스키마 타입입니다.', 400 );
	}

	$post = get_post( $post_id );
	if ( ! $post ) {
		return maiw_error_response( '글을 찾을 수 없습니다. 먼저 임시저장 후 다시 시도하세요.', 404 );
	}

	$content_text = wp_strip_all_tags( $post->post_content );
	if ( '' === trim( $content_text ) ) {
		return maiw_error_response( '본문 내용이 비어 있습니다. 먼저 글을 작성하세요.', 400 );
	}
	if ( mb_strlen( $content_text ) > 6000 ) {
		$content_text = mb_substr( $content_text, 0, 6000 );
	}

	$settings = maiw_get_settings();
	$provider = $settings['default_engine'];
	list( $api_key, $model ) = maiw_resolve_text_credentials( $provider, $settings );

	if ( '' === $api_key || '' === $model ) {
		return maiw_error_response( 'API 키를 설정에서 먼저 입력하세요. (설정 > AI 글쓰기 패널)', 400 );
	}

	$title  = $post->post_title ? $post->post_title : '(제목 없음)';
	$prompt = maiw_build_schema_prompt( $schema_type, $title, $content_text, $focus_keyword );
	$system = '당신은 schema.org JSON-LD를 정확하게 작성하는 SEO 전문가입니다. 본문에 없는 사실을 지어내지 않습니다.';

	switch ( $provider ) {
		case 'claude':
			$raw_text = maiw_call_claude( $api_key, $model, $system, $prompt );
			break;
		case 'openai':
			$raw_text = maiw_call_openai( $api_key, $model, $system, $prompt );
			break;
		case 'gemini':
			$raw_text = maiw_call_gemini( $api_key, $model, $system, $prompt );
			break;
		default:
			return maiw_error_response( '알 수 없는 AI 엔진입니다.', 400 );
	}

	if ( $raw_text instanceof WP_REST_Response ) {
		return $raw_text;
	}

	$decoded = maiw_extract_json_object( $raw_text );
	if ( ! is_array( $decoded ) ) {
		return maiw_error_response( 'AI 응답을 해석할 수 없습니다. 잠시 후 다시 시도해 주세요.', 502 );
	}

	// 신뢰할 수 있는 필드는 AI 대신 실제 글 데이터로 채운다.
	$decoded['@context']         = 'https://schema.org';
	$decoded['@type']            = $type_map[ $schema_type ];
	$decoded['mainEntityOfPage'] = array(
		'@type' => 'WebPage',
		'@id'   => get_permalink( $post_id ),
	);

	if ( in_array( $schema_type, array( 'article', 'product_review' ), true ) ) {
		$decoded['datePublished'] = get_the_date( 'c', $post_id );
		$decoded['dateModified']  = get_the_modified_date( 'c', $post_id );
		$decoded['author']        = array(
			'@type' => 'Person',
			'name'  => get_the_author_meta( 'display_name', $post->post_author ),
		);
		if ( has_post_thumbnail( $post_id ) ) {
			$decoded['image'] = get_the_post_thumbnail_url( $post_id, 'full' );
		}
	}

	$json = wp_json_encode( $decoded, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
	if ( false === $json ) {
		return maiw_error_response( '스키마 데이터를 JSON으로 변환하지 못했습니다.', 500 );
	}

	update_post_meta( $post_id, '_maiw_schema_json', $json );
	update_post_meta( $post_id, '_maiw_schema_type', $schema_type );

	return new WP_REST_Response( array( 'schema' => $decoded ), 200 );
}

/**
 * 저장된 스키마 마크업을 실제 글 페이지 <head>에 출력한다 (Rank Math/Yoast와 동일한 방식).
 * 편집기 본문에는 삽입하지 않는다 — 사용자가 설정에서 이 방식을 선택했다.
 */
function maiw_output_schema_markup() {
	if ( ! is_singular() ) {
		return;
	}
	$post_id = get_queried_object_id();
	if ( ! $post_id ) {
		return;
	}
	$json = get_post_meta( $post_id, '_maiw_schema_json', true );
	if ( '' === $json ) {
		return;
	}
	echo '<script type="application/ld+json">' . str_replace( '</script>', '<\/script>', $json ) . '</script>' . "\n";
}
add_action( 'wp_head', 'maiw_output_schema_markup' );
