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
				'topic'    => array( 'type' => 'string', 'required' => true ),
				'keywords' => array( 'type' => 'string', 'required' => false ),
				'tone'     => array( 'type' => 'string', 'required' => false ),
				'words'    => array( 'type' => 'integer', 'required' => false ),
				'provider' => array( 'type' => 'string', 'required' => false ),
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
	$topic    = sanitize_text_field( (string) $request->get_param( 'topic' ) );
	$keywords = sanitize_text_field( (string) $request->get_param( 'keywords' ) );
	$tone     = sanitize_text_field( (string) $request->get_param( 'tone' ) );
	$words    = absint( $request->get_param( 'words' ) );

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

	$system_prompt = maiw_build_system_prompt( $tone, $words );
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
 * AI에게 보낼 시스템 프롬프트를 구성한다.
 */
function maiw_build_system_prompt( $tone, $words ) {
	return "당신은 한국어 SEO 블로그 작가입니다. 사용자가 준 주제로 정확하고 독창적인 글을 작성합니다. "
		. "말투는 '{$tone}'으로, 분량은 약 {$words}자로 작성합니다. "
		. "본문은 h2, h3, p, ul, li, table 태그만 사용한 HTML로 작성하고, 확인되지 않은 사실이나 가짜 후기/경험/통계는 만들지 않습니다. "
		. '반드시 다음 JSON 형식으로만 응답하십시오. 다른 설명이나 코드블록 표시 없이 순수 JSON 객체 하나만 출력하십시오: '
		. '{"title":"<50자 이내 제목>","html":"<본문 HTML>"}';
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

	$body = json_decode( wp_remote_retrieve_body( $response ), true );
	$code = wp_remote_retrieve_response_code( $response );

	if ( isset( $body['error'] ) ) {
		$message = isset( $body['error']['message'] ) ? $body['error']['message'] : '알 수 없는 오류';
		return maiw_error_response( 'Claude API 오류: ' . $message, $code ? $code : 502 );
	}

	if ( empty( $body['content'][0]['text'] ) ) {
		return maiw_error_response( 'Claude API 응답이 비어 있습니다.', 502 );
	}

	return $body['content'][0]['text'];
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

	$body = json_decode( wp_remote_retrieve_body( $response ), true );
	$code = wp_remote_retrieve_response_code( $response );

	if ( isset( $body['error'] ) ) {
		$message = isset( $body['error']['message'] ) ? $body['error']['message'] : '알 수 없는 오류';
		return maiw_error_response( 'OpenAI API 오류: ' . $message, $code ? $code : 502 );
	}

	if ( empty( $body['choices'][0]['message']['content'] ) ) {
		return maiw_error_response( 'OpenAI API 응답이 비어 있습니다.', 502 );
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

	$body = json_decode( wp_remote_retrieve_body( $response ), true );
	$code = wp_remote_retrieve_response_code( $response );

	if ( isset( $body['error'] ) ) {
		$message = isset( $body['error']['message'] ) ? $body['error']['message'] : '알 수 없는 오류';
		return maiw_error_response( 'Gemini API 오류: ' . $message, $code ? $code : 502 );
	}

	if ( empty( $body['candidates'][0]['content']['parts'][0]['text'] ) ) {
		return maiw_error_response( 'Gemini API 응답이 비어 있습니다.', 502 );
	}

	return $body['candidates'][0]['content']['parts'][0]['text'];
}

/**
 * AI 응답 텍스트에서 {"title":...,"html":...} JSON을 방어적으로 파싱한다.
 * 코드블록(```json ... ```)이나 앞뒤 잡텍스트가 섞여 와도 처리한다.
 *
 * @return array|WP_REST_Response
 */
function maiw_parse_ai_json( $raw_text ) {
	$text = trim( (string) $raw_text );

	$decoded = json_decode( $text, true );

	if ( ! is_array( $decoded ) || ! isset( $decoded['title'], $decoded['html'] ) ) {
		// 코드블록 표시를 제거해 본다.
		$stripped = preg_replace( '/^```(?:json)?\s*|\s*```$/m', '', $text );
		$decoded  = json_decode( trim( $stripped ), true );
	}

	if ( ! is_array( $decoded ) || ! isset( $decoded['title'], $decoded['html'] ) ) {
		// 텍스트 중간에 섞인 JSON 객체만 추출해 본다.
		if ( preg_match( '/\{.*\}/s', $text, $matches ) ) {
			$decoded = json_decode( $matches[0], true );
		}
	}

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
