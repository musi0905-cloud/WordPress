<?php
/**
 * AI 글쓰기 패널 설정 화면.
 * 옵션 하나(maiw_settings)에 엔진 선택, 각 엔진의 API 키/모델명, 기본 말투/분량을 저장한다.
 * API 키는 이 화면 밖으로(예: 에디터 스크립트) 절대 전달되지 않는다.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MAIW_OPTION_KEY', 'maiw_settings' );

/**
 * 기본값이 채워진 설정 배열을 반환한다.
 */
function maiw_get_settings() {
	$defaults = array(
		'default_engine'    => 'claude',
		'claude_api_key'    => '',
		'claude_model'      => 'claude-sonnet-5',
		'openai_api_key'    => '',
		'openai_model'      => 'gpt-4o',
		'openai_image_model' => 'gpt-image-1',
		'gemini_api_key'    => '',
		'gemini_model'      => 'gemini-1.5-pro',
		'gemini_image_model' => 'gemini-2.5-flash-image',
		'default_tone'      => '친근하게',
		'default_words'     => 900,
	);

	$saved = get_option( MAIW_OPTION_KEY, array() );
	if ( ! is_array( $saved ) ) {
		$saved = array();
	}

	return wp_parse_args( $saved, $defaults );
}

/**
 * 관리자 메뉴에 설정 페이지를 등록한다.
 */
function maiw_add_settings_page() {
	add_options_page(
		'AI 글쓰기 패널 설정',
		'AI 글쓰기 패널',
		'manage_options',
		'my-ai-writer',
		'maiw_render_settings_page'
	);
}
add_action( 'admin_menu', 'maiw_add_settings_page' );

/**
 * 설정 저장 시 각 필드를 정화한다.
 */
function maiw_sanitize_settings( $input ) {
	$defaults = maiw_get_settings();
	$output   = array();

	$allowed_engines = array( 'claude', 'openai', 'gemini' );
	$output['default_engine'] = in_array( $input['default_engine'] ?? '', $allowed_engines, true )
		? $input['default_engine']
		: $defaults['default_engine'];

	$output['claude_api_key'] = isset( $input['claude_api_key'] ) ? sanitize_text_field( $input['claude_api_key'] ) : '';
	$output['claude_model']   = isset( $input['claude_model'] ) && '' !== trim( $input['claude_model'] )
		? sanitize_text_field( $input['claude_model'] )
		: $defaults['claude_model'];

	$output['openai_api_key']    = isset( $input['openai_api_key'] ) ? sanitize_text_field( $input['openai_api_key'] ) : '';
	$output['openai_model']      = isset( $input['openai_model'] ) && '' !== trim( $input['openai_model'] )
		? sanitize_text_field( $input['openai_model'] )
		: $defaults['openai_model'];
	$output['openai_image_model'] = isset( $input['openai_image_model'] ) && '' !== trim( $input['openai_image_model'] )
		? sanitize_text_field( $input['openai_image_model'] )
		: $defaults['openai_image_model'];

	$output['gemini_api_key']    = isset( $input['gemini_api_key'] ) ? sanitize_text_field( $input['gemini_api_key'] ) : '';
	$output['gemini_model']      = isset( $input['gemini_model'] ) && '' !== trim( $input['gemini_model'] )
		? sanitize_text_field( $input['gemini_model'] )
		: $defaults['gemini_model'];
	$output['gemini_image_model'] = isset( $input['gemini_image_model'] ) && '' !== trim( $input['gemini_image_model'] )
		? sanitize_text_field( $input['gemini_image_model'] )
		: $defaults['gemini_image_model'];

	$output['default_tone']  = isset( $input['default_tone'] ) && '' !== trim( $input['default_tone'] )
		? sanitize_text_field( $input['default_tone'] )
		: $defaults['default_tone'];
	$output['default_words'] = isset( $input['default_words'] ) ? absint( $input['default_words'] ) : $defaults['default_words'];
	if ( $output['default_words'] < 1 ) {
		$output['default_words'] = $defaults['default_words'];
	}

	return $output;
}

function maiw_register_settings() {
	register_setting(
		'maiw_settings_group',
		MAIW_OPTION_KEY,
		array(
			'type'              => 'array',
			'sanitize_callback' => 'maiw_sanitize_settings',
		)
	);
}
add_action( 'admin_init', 'maiw_register_settings' );

/**
 * 설정 화면을 렌더링한다.
 */
function maiw_render_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$settings = maiw_get_settings();
	?>
	<div class="wrap">
		<h1>AI 글쓰기 패널 설정</h1>
		<p>글 편집기 사이드바에서 사용할 AI 엔진과 API 키를 설정합니다. API 키는 서버에만 저장되며 브라우저로 전송되지 않습니다.</p>
		<p><strong>썸네일 이미지 생성은 OpenAI 또는 Gemini만 지원합니다.</strong> Claude는 이미지 생성 API를 제공하지 않아 썸네일 탭의 생성 엔진으로 선택할 수 없습니다.</p>
		<form method="post" action="options.php">
			<?php settings_fields( 'maiw_settings_group' ); ?>
			<table class="form-table" role="presentation">
				<tr>
					<th scope="row"><label for="maiw_default_engine">기본 엔진</label></th>
					<td>
						<select name="<?php echo esc_attr( MAIW_OPTION_KEY ); ?>[default_engine]" id="maiw_default_engine">
							<option value="claude" <?php selected( $settings['default_engine'], 'claude' ); ?>>Claude</option>
							<option value="openai" <?php selected( $settings['default_engine'], 'openai' ); ?>>OpenAI</option>
							<option value="gemini" <?php selected( $settings['default_engine'], 'gemini' ); ?>>Gemini</option>
						</select>
					</td>
				</tr>

				<tr><th colspan="2"><h2>Claude</h2></th></tr>
				<tr>
					<th scope="row"><label for="maiw_claude_api_key">API 키</label></th>
					<td><input type="password" autocomplete="off" id="maiw_claude_api_key" name="<?php echo esc_attr( MAIW_OPTION_KEY ); ?>[claude_api_key]" value="<?php echo esc_attr( $settings['claude_api_key'] ); ?>" class="regular-text" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="maiw_claude_model">모델명</label></th>
					<td>
						<input type="text" id="maiw_claude_model" name="<?php echo esc_attr( MAIW_OPTION_KEY ); ?>[claude_model]" value="<?php echo esc_attr( $settings['claude_model'] ); ?>" class="regular-text" placeholder="claude-sonnet-5" />
						<p class="description">예: claude-sonnet-5. 모델명이 바뀌면 여기서 직접 수정하세요.</p>
					</td>
				</tr>

				<tr><th colspan="2"><h2>OpenAI</h2></th></tr>
				<tr>
					<th scope="row"><label for="maiw_openai_api_key">API 키</label></th>
					<td><input type="password" autocomplete="off" id="maiw_openai_api_key" name="<?php echo esc_attr( MAIW_OPTION_KEY ); ?>[openai_api_key]" value="<?php echo esc_attr( $settings['openai_api_key'] ); ?>" class="regular-text" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="maiw_openai_model">모델명 (글쓰기)</label></th>
					<td>
						<input type="text" id="maiw_openai_model" name="<?php echo esc_attr( MAIW_OPTION_KEY ); ?>[openai_model]" value="<?php echo esc_attr( $settings['openai_model'] ); ?>" class="regular-text" placeholder="gpt-4o" />
						<p class="description">예: gpt-4o.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="maiw_openai_image_model">모델명 (썸네일 이미지)</label></th>
					<td>
						<input type="text" id="maiw_openai_image_model" name="<?php echo esc_attr( MAIW_OPTION_KEY ); ?>[openai_image_model]" value="<?php echo esc_attr( $settings['openai_image_model'] ); ?>" class="regular-text" placeholder="gpt-image-1" />
						<p class="description">예: gpt-image-1, dall-e-3.</p>
					</td>
				</tr>

				<tr><th colspan="2"><h2>Gemini</h2></th></tr>
				<tr>
					<th scope="row"><label for="maiw_gemini_api_key">API 키</label></th>
					<td><input type="password" autocomplete="off" id="maiw_gemini_api_key" name="<?php echo esc_attr( MAIW_OPTION_KEY ); ?>[gemini_api_key]" value="<?php echo esc_attr( $settings['gemini_api_key'] ); ?>" class="regular-text" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="maiw_gemini_model">모델명 (글쓰기)</label></th>
					<td>
						<input type="text" id="maiw_gemini_model" name="<?php echo esc_attr( MAIW_OPTION_KEY ); ?>[gemini_model]" value="<?php echo esc_attr( $settings['gemini_model'] ); ?>" class="regular-text" placeholder="gemini-1.5-pro" />
						<p class="description">예: gemini-1.5-pro.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="maiw_gemini_image_model">모델명 (썸네일 이미지)</label></th>
					<td>
						<input type="text" id="maiw_gemini_image_model" name="<?php echo esc_attr( MAIW_OPTION_KEY ); ?>[gemini_image_model]" value="<?php echo esc_attr( $settings['gemini_image_model'] ); ?>" class="regular-text" placeholder="gemini-2.5-flash-image" />
						<p class="description">예: gemini-2.5-flash-image.</p>
					</td>
				</tr>

				<tr><th colspan="2"><h2>기본값</h2></th></tr>
				<tr>
					<th scope="row"><label for="maiw_default_tone">기본 말투</label></th>
					<td><input type="text" id="maiw_default_tone" name="<?php echo esc_attr( MAIW_OPTION_KEY ); ?>[default_tone]" value="<?php echo esc_attr( $settings['default_tone'] ); ?>" class="regular-text" /></td>
				</tr>
				<tr>
					<th scope="row"><label for="maiw_default_words">기본 분량 (자)</label></th>
					<td><input type="number" min="1" id="maiw_default_words" name="<?php echo esc_attr( MAIW_OPTION_KEY ); ?>[default_words]" value="<?php echo esc_attr( $settings['default_words'] ); ?>" class="small-text" /></td>
				</tr>
			</table>
			<?php submit_button( '설정 저장' ); ?>
		</form>
	</div>
	<?php
}
