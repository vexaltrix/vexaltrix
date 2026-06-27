<?php
/**
 * Common Settings.
 *
 * @package uag
 */

namespace Vexaltrix\Ajax;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Vexaltrix\Core\Base\AjaxController;
use Vexaltrix\Admin\AdminHelper;

use ZipAI\Classes\Helper as Zip_Ai_Helper;
use ZipAI\Classes\Module as Zip_Ai_Module;

/**
 * Class \Vexaltrix\Ajax\CommonSettings.
 */
class CommonSettings extends \Vexaltrix\Core\Base\AjaxController {

	/**
	 * Instance
	 *
	 * @access private
	 * @var object Class object.
	 *
	 * @since 2.0.0
	 */
	private static $instance;

	/**
	 * Initiator
	 *
	 * @return object initialized object of class.
	 *
	 * @since 2.0.0
	 */
	public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

	/**
	 * Register_ajax_events.
	 *
	 * @return void
	 */
	public function registerAjaxEvents() {

		$ajaxEvents = [
			'enableBetaUpdates',
			'checkBetaUpdateAvailable',
			'forceCheckPluginUpdates',
			'updateBetaPlugin',
			'enableFileGeneration',
			'regenerateAssets',
			'enableTemplatesButton',
			'enableOnPageCssButton',
			'enableBlockCondition',
			'enableMasonryGallery',
			'enableQuickActionSidebar',
			'enableBlockResponsive',
			'enableDynamicContent',
			'enableAnimationsExtension',
			'enableGbsExtension',
			'blocksActivationAndDeactivation',
			'loadSelectFontGlobally',
			'loadFseFontGlobally',
			'fseFontGlobally',
			'fseFontGloballyDelete',
			'selectFontGlobally',
			'loadGfontsLocally',
			'preloadLocalFonts',
			'collapsePanels',
			'copyPaste',
			'social',
			'dynamicContentMode',
			'contentWidth',
			'containerGlobalPadding',
			'containerGlobalElementsGap',
			'blocksEditorSpacing',
			'recaptchaSiteKeyV2',
			'recaptchaSecretKeyV2',
			'recaptchaSiteKeyV3',
			'recaptchaSecretKeyV3',
			'visibilityMode',
			'visibilityPage',
			'fetchPages',
			'loadFontAwesome5',
			'autoBlockRecovery',
			'enableLegacyBlocks',
			'proActivate',
			'instaLinkedAccounts',
			'instaAllUsersMedia',
			'instaRefreshAllTokens',
			'btnInheritFromTheme',
			'zipAiModuleStatus',
			'zipAiVerifyAuthenticity',
			'enableBsfAnalyticsOption',
		];

		$this->initAjaxEvents( $ajaxEvents );
	}

	/**
	 * Save global option of button to inherit from theme.
	 *
	 * @since 2.6.2
	 * @return void
	 */
	public function btnInheritFromTheme() {

		$this->checkPermissionNonce( 'uag_btn_inherit_from_theme' );
		if ( false !== get_option( 'uag_btn_inherit_from_theme_fallback' ) ) {
			\Vexaltrix\Admin\AdminSettings::deleteAdminSettingsOption( 'uag_btn_inherit_from_theme_fallback' );
		};
		
		$value = $this->checkPostValue();
		$this->deleteAllAssets(); // We need to regenerate assets when user changes this setting to regenerate the dynamic CSS according to it.
		$this->saveAdminSettings( 'uag_btn_inherit_from_theme', sanitize_text_field( $value ) );
	}

	/**
	 * Checks if the user has the permission to perform the requested action and verifies the nonce.
	 *
	 * @param string $option The name of the option to check the nonce against.
	 * @param string $scope The capability required to perform the action. Default is 'manage_options'.
	 * @param string $security The security to check the nonce against. Default is 'security'.
	 * @return void
	 *
	 * @since 2.5.0
	 */
	private function checkPermissionNonce( $option, $scope = 'manage_options', $security = 'security' ) {

		if ( ! current_user_can( $scope ) ) {
			wp_send_json_error( [ 'messsage' => $this->getErrorMsg( 'permission' ) ] );
		}

		/**
		 * Nonce verification
		 */
		$legacyOption = 0 === strpos( $option, 'ugb_' )
			? 'uag_' . substr( $option, 4 )
			: 'ugb_' . substr( $option, 4 );

		if (
			! check_ajax_referer( $option, $security, false ) &&
			! check_ajax_referer( $legacyOption, $security, false )
		) {
			wp_send_json_error( [ 'messsage' => $this->getErrorMsg( 'nonce' ) ] );
		}
	}

	/**
	 * Saves the success message after successfully updating admin settings option.
	 *
	 * @param string $option The name of the option to update.
	 * @param mixed  $value The value to be updated.
	 * @return void
	 *
	 * @since 2.5.0
	 */
	private function saveAdminSettings( $option, $value ) {
		\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( $option, $value );


		$responseData = [
			'messsage' => __( 'Successfully saved data!', 'vexaltrix' ),
		];
		wp_send_json_success( $responseData );
	}

	/**
	 * Checks if the specified key exists in the $_POST array and returns the corresponding value.
	 *
	 * @param string $key The key to check in the $_POST array. Default value is 'value'.
	 * @return mixed The value of the specified key in the $_POST array if it exists, otherwise sends a JSON error response.
	 *
	 *  @since 2.5.0
	 */
	private function checkPostValue( $key = 'value' ) {
		// nonce verification done in function check_permission_nonce.
		if ( ! isset( $_POST[ $key ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			wp_send_json_error( [ 'messsage' => __( 'No post data found!', 'vexaltrix' ) ] );
		}
		return sanitize_text_field( wp_unslash( $_POST[ $key ] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
	}

	/**
	 * Returns raw POST value for JSON fields that need json_decode().
	 * Callers MUST sanitize individual elements after decoding.
	 *
	 * @param string $key The POST key to retrieve.
	 * @return string Raw unslashed POST value.
	 */
	private function checkPostValueJson( $key = 'value' ) {
		// nonce verification done in function check_permission_nonce.
		if ( ! isset( $_POST[ $key ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			wp_send_json_error( [ 'messsage' => __( 'No post data found!', 'vexaltrix' ) ] );
		}
		return wp_unslash( $_POST[ $key ] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	}

	/**
	 * Required Vexaltrix Pro Plugin Activate
	 *
	 * @return void
	 */
	public function proActivate() {
		wp_clean_plugins_cache();
		$value = $this->checkPostValue();
		$value = sanitize_text_field( wp_unslash( $value ) );
		$this->checkPermissionNonce( 'uag_pro_activate', 'activate_plugins' );

		if ( empty( $value ) ) {
			$responseData = [ 'messsage' => $this->getErrorMsg( 'default' ) ];
			wp_send_json_error( $responseData );
		}

		$activate = activate_plugin( 'vexaltrix-pro/vexaltrix-pro.php' );

		if ( is_wp_error( $activate ) ) {
			wp_send_json_error(
				[
					'success' => false,
					'message' => $activate->get_error_message(),
				]
			);
		}

		wp_send_json_success(
			[
				'success' => true,
				'message' => __( 'Plugin Successfully Activated', 'vexaltrix' ),
			]
		);
	}

	/**
	 * Save settings - Saves google recaptcha v3 secret key.
	 *
	 * @return void
	 */
	public function recaptchaSecretKeyV3() {
		$this->checkPermissionNonce( 'uag_recaptcha_secret_key_v3' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_recaptcha_secret_key_v3', sanitize_text_field( $value ) );
	}

	/**
	 * Save settings - Saves google recaptcha v2 secret key.
	 *
	 * @return void
	 */
	public function recaptchaSecretKeyV2() {
		$this->checkPermissionNonce( 'uag_recaptcha_secret_key_v2' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_recaptcha_secret_key_v2', sanitize_text_field( $value ) );
	}

	/**
	 * Save settings - Saves google recaptcha v2 site key.
	 *
	 * @return void
	 */
	public function recaptchaSiteKeyV2() {
		$this->checkPermissionNonce( 'uag_recaptcha_site_key_v2' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_recaptcha_site_key_v2', sanitize_text_field( $value ) );
	}

	/**
	 * Save settings - Saves google recaptcha v3 site key.
	 *
	 * @return void
	 */
	public function recaptchaSiteKeyV3() {
		$this->checkPermissionNonce( 'uag_recaptcha_site_key_v3' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_recaptcha_site_key_v3', sanitize_text_field( $value ) );
	}

	/**
	 * Save settings - Saves fetch_pages.
	 *
	 * @return void
	 */
	public function fetchPages() {
		$this->checkPermissionNonce( 'uag_fetch_pages' );

		$args = [
			'post_type'      => 'page',
			'posts_per_page' => 5,
		];
		// nonce verification is done in above function check_permission_nonce.
		$keyword = ( isset( $_POST['keyword'] ) ? sanitize_text_field( $_POST['keyword'] ) : '' ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		if ( ! empty( $keyword ) ) {
			$args['s'] = $keyword;
		}

		$results = [];
		$pages   = get_posts( $args );
		if ( is_array( $pages ) ) {
			foreach ( $pages as $page ) {
				$results[] = [
					'label' => $page->post_title,
					'value' => $page->ID,
				];
			}
		}

		wp_send_json_success( $results );
	}

	/**
	 * Save settings - Saves visibility_page.
	 *
	 * @return void
	 */
	public function visibilityPage() {
		$this->checkPermissionNonce( 'uag_visibility_page' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_visibility_page', intval( $value ) );
	}

	/**
	 * Save settings - Saves visibility_mode.
	 *
	 * @return void
	 */
	public function visibilityMode() {
		$this->checkPermissionNonce( 'uag_visibility_mode' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_visibility_mode', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Saves content_width.
	 *
	 * @return void
	 */
	public function contentWidth() {
		$this->checkPermissionNonce( 'uag_content_width' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_content_width', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Saves container global padding.
	 *
	 * @return void
	 */
	public function containerGlobalPadding() {
		$this->checkPermissionNonce( 'uag_container_global_padding' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_container_global_padding', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Saves container global elements gap.
	 *
	 * @return void
	 */
	public function containerGlobalElementsGap() {
		$this->checkPermissionNonce( 'uag_container_global_elements_gap' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_container_global_elements_gap', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Saves blocks editor spacing.
	 *
	 * @return void
	 */
	public function blocksEditorSpacing() {
		$this->checkPermissionNonce( 'uag_blocks_editor_spacing' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_blocks_editor_spacing', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Loads selected font globally.
	 *
	 * @return void
	 */
	public function loadSelectFontGlobally() {
		$this->checkPermissionNonce( 'uag_load_select_font_globally' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_load_select_font_globally', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Loads selected font globally.
	 *
	 * @since 2.5.1
	 * @return void
	 */
	public function loadFseFontGlobally() {
		$this->checkPermissionNonce( 'uag_load_fse_font_globally' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_load_fse_font_globally', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Saves selected font globally.
	 *
	 * @since 2.5.1
	 * @return void
	 */
	public function selectFontGlobally() {
		$this->checkPermissionNonce( 'uag_select_font_globally' );
		$value = $this->checkPostValueJson();
		$value = json_decode( $value, true );

		// SECURITY: Validate JSON decode was successful.
		if ( null === $value && JSON_ERROR_NONE !== json_last_error() ) {
			wp_send_json_error( [ 'messsage' => __( 'Invalid JSON data received.', 'vexaltrix' ) ] );
		}

		$this->saveAdminSettings( 'uag_select_font_globally', $this->sanitizeFormInputs( $value ) );
	}

	/**
	 * Save setting - Saves selected font globally.
	 *
	 * @since 2.5.1
	 * @return void
	 */
	public function fseFontGloballyDelete() {
		$this->checkPermissionNonce( 'uag_fse_font_globally_delete' );
		$value = $this->checkPostValueJson();
		$value = json_decode( $value, true );

		// SECURITY: Validate JSON decode was successful.
		if ( null === $value && JSON_ERROR_NONE !== json_last_error() ) {
			wp_send_json_error( [ 'messsage' => __( 'Invalid JSON data received.', 'vexaltrix' ) ] );
		}

		\Vexaltrix\Compatibility\FseFontsCompatibility::deleteThemeFontFamily( $value );
	}

	/**
	 * Save setting - Saves selected font globally.
	 *
	 * @since 2.5.1
	 * @return void
	 */
	public function fseFontGlobally() {
		$this->checkPermissionNonce( 'uag_fse_font_globally' );
		$value = $this->checkPostValueJson();
		$value = json_decode( $value, true );

		// SECURITY: Validate JSON decode was successful.
		if ( null === $value && JSON_ERROR_NONE !== json_last_error() ) {
			wp_send_json_error( [ 'messsage' => __( 'Invalid JSON data received.', 'vexaltrix' ) ] );
		}

		$vexaltrixGlobalFseFonts = \Vexaltrix\Admin\AdminSettings::get( 'vexaltrix_global_fse_fonts', [] );

		if ( ! is_array( $vexaltrixGlobalFseFonts ) ) {
			$vexaltrixGlobalFseFonts = [];
		}

		$vexaltrixGlobalFseFonts[] = $value;

		$this->saveAdminSettings( 'vexaltrix_global_fse_fonts', $this->sanitizeFormInputs( $vexaltrixGlobalFseFonts ) );
	}

	/**
	 * Save setting - Enables masonry gallery.
	 *
	 * @return void
	 */
	public function enableMasonryGallery() {
		$this->checkPermissionNonce( 'uag_enable_masonry_gallery' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_enable_masonry_gallery', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Enables quick action sidebar.
	 *
	 * @since 2.12.0
	 * @return void
	 */
	public function enableQuickActionSidebar() {
		$this->checkPermissionNonce( 'uag_enable_quick_action_sidebar' );
		$value = $this->checkPostValue();
		$value = 'disabled' === $value ? 'disabled' : 'enabled';
		$this->saveAdminSettings( 'uag_enable_quick_action_sidebar', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Loads gfonts locally.
	 *
	 * @return void
	 */
	public function loadGfontsLocally() {
		$this->checkPermissionNonce( 'uag_load_gfonts_locally' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_load_gfonts_locally', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Collapses panels.
	 *
	 * @return void
	 */
	public function collapsePanels() {
		$this->checkPermissionNonce( 'uag_collapse_panels' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_collapse_panels', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Enables copy paste.
	 *
	 * @return void
	 */
	public function copyPaste() {
		$this->checkPermissionNonce( 'uag_copy_paste' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_copy_paste', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Saves social settings.
	 *
	 * @return void
	 *
	 * @since 2.1.0
	 */
	public function social() {
		$this->checkPermissionNonce( 'uag_social' );

		$social = \Vexaltrix\Admin\AdminSettings::get(
			'uag_social',
			[
				'socialRegister'    => false,
				'googleClientId'    => '',
				'facebookAppId'     => '',
				'facebookAppSecret' => '',
			]
		);
		// nonce verification is done in above function check_permission_nonce.
		if ( isset( $_POST['socialRegister'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			$social['socialRegister'] = rest_sanitize_boolean( sanitize_text_field( wp_unslash( $_POST['socialRegister'] ) ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
		if ( isset( $_POST['googleClientId'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			$social['googleClientId'] = sanitize_text_field( wp_unslash( $_POST['googleClientId'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
		if ( isset( $_POST['facebookAppId'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			$social['facebookAppId'] = sanitize_text_field( wp_unslash( $_POST['facebookAppId'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}
		if ( isset( $_POST['facebookAppSecret'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			$social['facebookAppSecret'] = sanitize_text_field( wp_unslash( $_POST['facebookAppSecret'] ) ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
		}

		$this->saveAdminSettings( 'uag_social', $social );
	}

	/**
	 * Save setting - Enables dynamic content mode.
	 *
	 * @return void
	 *
	 * @since 2.1.0
	 */
	public function dynamicContentMode() {
		$this->checkPermissionNonce( 'uag_dynamic_content_mode' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_dynamic_content_mode', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Preloads local fonts.
	 *
	 * @return void
	 */
	public function preloadLocalFonts() {
		$this->checkPermissionNonce( 'uag_preload_local_fonts' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_preload_local_fonts', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Enables block conditions.
	 *
	 * @return void
	 *
	 * @since 2.4.0
	 */
	public function enableBlockCondition() {
		$this->checkPermissionNonce( 'uag_enable_block_condition' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_enable_block_condition', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Enables block responsiveness.
	 *
	 * @return void
	 */
	public function enableBlockResponsive() {
		$this->checkPermissionNonce( 'uag_enable_block_responsive' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_enable_block_responsive', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Enables dynamic content.
	 *
	 * @return void
	 *
	 * @since 2.1.0
	 */
	public function enableDynamicContent() {
		$this->checkPermissionNonce( 'uag_enable_dynamic_content' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_enable_dynamic_content', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Enables animation extension.
	 *
	 * @return void
	 *
	 * @since 2.6.0
	 */
	public function enableAnimationsExtension() {
		$this->checkPermissionNonce( 'uag_enable_animations_extension' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_enable_animations_extension', sanitize_text_field( $value ) );
	}

	/**
	 * Save settings - Enables templates button.
	 *
	 * @return void
	 */
	public function enableTemplatesButton() {
		$this->checkPermissionNonce( 'uag_enable_templates_button' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_enable_templates_button', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Enables the on-page CSS button .
	 *
	 * @return void
	 */
	public function enableOnPageCssButton() {
		$this->checkPermissionNonce( 'uag_enable_on_page_css_button' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_enable_on_page_css_button', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Activates and deactivates blocks .
	 *
	 * @return void
	 */
	public function blocksActivationAndDeactivation() {
		$this->checkPermissionNonce( 'uag_blocks_activation_and_deactivation' );
		$value  = $this->checkPostValueJson();
		$status = $this->checkPostValue( 'status' );
		if ( '' !== $status ) {
			$statusValue = 'disabled' === $status ? 'disabled' : 'enabled';
		}
		// will sanitize $value in later stage.
		$value = json_decode( $value, true );

		// SECURITY: Validate JSON decode was successful.
		if ( null === $value && JSON_ERROR_NONE !== json_last_error() ) {
			wp_send_json_error( [ 'messsage' => __( 'Invalid JSON data received.', 'vexaltrix' ) ] );
		}

		if ( 'disabled' === \Vexaltrix\Support\Helper::$fileGeneration ) {
			\Vexaltrix\Admin\AdminSettings::createSpecificStylesheet(); // Get Specific Stylesheet.
		}
		if ( '' !== $status ) {
			// Update all extensions.
			$updateAllExtensions = [
				'uag_enable_animations_extension',
				'uag_enable_dynamic_content',
				'uag_enable_block_condition',
				'uag_enable_block_responsive',
				'uag_enable_masonry_gallery',
				'uag_enable_gbs_extension',
				'_vxt_ultimate_gutenberg_blocks_blocks',
			];
			// Create an array with the new status for each extension.
			$changeExtension = [];
			// Iterate over the array and set the new status for each item.
			foreach ( $updateAllExtensions as $item ) {
				if ( '_vxt_ultimate_gutenberg_blocks_blocks' === $item ) {
					$changeExtension[ $item ] = $value;
					continue;
				}
				$changeExtension[ $item ] = $statusValue;
			}
			// Iterate over the array and call save_admin_settings for each item.
			foreach ( $changeExtension as $key => $val ) {
				if ( '_vxt_ultimate_gutenberg_blocks_blocks' === $key ) {
					\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( '_vxt_ultimate_gutenberg_blocks_blocks', $val );
					continue;
				}
				// Update all extensions.
				\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( $key, $val );
			}
		} else {
			$this->saveAdminSettings( '_vxt_ultimate_gutenberg_blocks_blocks', $this->sanitizeFormInputs( $value ) );
		}
	}

	/**
	 * Save setting - Enables beta updates.
	 *
	 * @return void
	 */
	public function enableBetaUpdates() {
		$this->checkPermissionNonce( 'ugb_enable_beta_updates' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'vxt_ultimate_gutenberg_blocks_beta', sanitize_text_field( $value ) );

		// If enabling beta updates, clear update transients to force a fresh check.
		if ( 'yes' === $value ) {
			delete_site_transient( 'update_plugins' );
			delete_transient( 'update_plugins' );

			// Delete the beta version transient.
			$transientKey = md5( 'vxt_ultimate_gutenberg_blocks_beta_testers_response_key' );
			delete_site_transient( $transientKey );

			// Trigger WordPress to check for updates.
			wp_update_plugins();
		}
	}

	/**
	 * Check if beta update is available.
	 *
	 * @since 2.19.16
	 * @return void
	 */
	public function checkBetaUpdateAvailable() {
		$this->checkPermissionNonce( 'ugb_check_beta_update_available' );

		// Validate required constants exist.
		if ( ! defined( 'VXT_VER' ) ) {
			wp_send_json_error(
				[
					'messsage' => __( 'Plugin version not defined.', 'vexaltrix' ),
				]
			);
		}

		// Note: Removed beta enabled check to allow dashboard notice to show.
		// Users can check for beta updates even if not enabled yet.

		// Get the beta version from WordPress.org with timeout.
		$response = wp_remote_get(
			'https://plugins.svn.wordpress.org/vexaltrix/trunk/readme.txt',
			[
				'timeout'   => 15, //phpcs:ignore WordPressVIPMinimum.Performance.RemoteRequestTimeout.timeout_timeout
				'sslverify' => true,
			]
		);

		if ( is_wp_error( $response ) ) {
			wp_send_json_error(
				[
					'messsage' => __( 'Unable to check for beta updates.', 'vexaltrix' ),
				]
			);
		}

		// Validate response status code.
		$responseCode = wp_remote_retrieve_response_code( $response );
		if ( 200 !== $responseCode ) {
			wp_send_json_error(
				[
					'messsage' => __( 'Unable to check for beta updates.', 'vexaltrix' ),
				]
			);
		}

		$betaVersion = 'false';
		$body         = wp_remote_retrieve_body( $response );

		if ( ! empty( $body ) && is_string( $body ) ) {
			preg_match( '/Beta tag:\s*([0-9.]+)/i', $body, $matches );
			if ( isset( $matches[1] ) ) {
				$betaVersion = sanitize_text_field( trim( $matches[1] ) );
				// Validate version format (x.x.x or x.x.x-beta.x).
				if ( ! preg_match( '/^[0-9]+\.[0-9]+(\.[0-9]+)?(-[a-z0-9.]+)?$/i', $betaVersion ) ) {
					$betaVersion = 'false';
				}
			}
		}

		$currentVersion = sanitize_text_field( VXT_VER );

		// Compare with current version.
		if ( 'false' !== $betaVersion && version_compare( $betaVersion, $currentVersion, '>' ) ) {
			wp_send_json_success(
				[
					'has_update'      => true,
					'beta_version'    => $betaVersion,
					'current_version' => $currentVersion,
					'messsage'        => sprintf(
						// Translators: %1$s is the beta version number, %2$s is the current version.
						__( 'Beta version %1$s is available (current: %2$s).', 'vexaltrix' ),
						esc_html( $betaVersion ),
						esc_html( $currentVersion )
					),
				]
			);
		} else {
			wp_send_json_success(
				[
					'has_update'      => false,
					'current_version' => $currentVersion,
					'messsage'        => __( 'You are running the latest version.', 'vexaltrix' ),
				]
			);
		}
	}

	/**
	 * Force check for plugin updates.
	 *
	 * @since 2.19.16
	 * @return void
	 */
	public function forceCheckPluginUpdates() {
		$this->checkPermissionNonce( 'ugb_force_check_plugin_updates' );

		// Validate required constants exist.
		if ( ! defined( 'VXT_BASE' ) ) {
			wp_send_json_error(
				[
					'messsage' => __( 'Plugin identifier not defined.', 'vexaltrix' ),
				]
			);
		}

		// Delete the update transients to force a fresh check.
		delete_site_transient( 'update_plugins' );
		delete_transient( 'update_plugins' );

		// Delete the beta version transient.
		$transientKey = md5( 'vxt_ultimate_gutenberg_blocks_beta_testers_response_key' );
		delete_site_transient( $transientKey );

		// Trigger WordPress to check for updates.
		wp_update_plugins();

		// Get the update information.
		$updatePlugins = get_site_transient( 'update_plugins' );
		$pluginSlug    = VXT_BASE;

		// Validate transient structure.
		if ( ! is_object( $updatePlugins ) || ! isset( $updatePlugins->response ) || ! is_array( $updatePlugins->response ) ) {
			wp_send_json_success(
				[
					'has_update' => false,
					'messsage'   => __( 'No updates available.', 'vexaltrix' ),
				]
			);
			return;
		}

		if ( isset( $updatePlugins->response[ $pluginSlug ] ) && is_object( $updatePlugins->response[ $pluginSlug ] ) ) {
			$updateInfo = $updatePlugins->response[ $pluginSlug ];

			// Validate update info has required properties.
			$newVersion = isset( $updateInfo->new_version ) ? sanitize_text_field( $updateInfo->new_version ) : '';
			$package     = isset( $updateInfo->package ) ? esc_url_raw( $updateInfo->package ) : '';

			if ( empty( $newVersion ) ) {
				wp_send_json_success(
					[
						'has_update' => false,
						'messsage'   => __( 'No updates available.', 'vexaltrix' ),
					]
				);
				return;
			}

			wp_send_json_success(
				[
					'has_update'  => true,
					'new_version' => $newVersion,
					'package'     => $package,
					'update_url'  => esc_url( admin_url( 'plugins.php' ) ),
					'messsage'    => sprintf(
						// Translators: %s is the new version number.
						__( 'Update available: %s', 'vexaltrix' ),
						esc_html( $newVersion )
					),
				]
			);
		} else {
			wp_send_json_success(
				[
					'has_update' => false,
					'messsage'   => __( 'No updates available.', 'vexaltrix' ),
				]
			);
		}
	}

	/**
	 * Update the beta plugin automatically.
	 *
	 * @since 2.19.16
	 * @return void
	 */
	public function updateBetaPlugin() {
		$this->checkPermissionNonce( 'ugb_update_beta_plugin' );

		// Validate required constants and user capabilities.
		if ( ! defined( 'VXT_BASE' ) ) {
			wp_send_json_error(
				[
					'messsage' => __( 'Plugin identifier not defined.', 'vexaltrix' ),
				]
			);
		}

		// Check if user has permission to update plugins.
		if ( ! current_user_can( 'update_plugins' ) ) {
			wp_send_json_error(
				[
					'messsage' => __( 'You do not have permission to update plugins.', 'vexaltrix' ),
				]
			);
		}

		// Delete the update transients to force a fresh check.
		delete_site_transient( 'update_plugins' );
		delete_transient( 'update_plugins' );

		// Delete the beta version transient.
		$transientKey = md5( 'vxt_ultimate_gutenberg_blocks_beta_testers_response_key' );
		delete_site_transient( $transientKey );

		// Trigger WordPress to check for updates.
		wp_update_plugins();

		// Get the update information.
		$updatePlugins = get_site_transient( 'update_plugins' );
		$pluginSlug    = VXT_BASE;

		// Validate transient structure.
		if ( ! is_object( $updatePlugins ) || ! isset( $updatePlugins->response ) || ! is_array( $updatePlugins->response ) ) {
			wp_send_json_error(
				[
					'messsage' => __( 'No updates available to install.', 'vexaltrix' ),
				]
			);
		}

		// Check if update is available.
		if ( ! is_object( $updatePlugins ) || ! isset( $updatePlugins->response[ $pluginSlug ] ) ) {
			wp_send_json_error(
				[
					'messsage' => __( 'No updates available to install.', 'vexaltrix' ),
				]
			);
		}

		// Check if plugin is currently active.
		$wasActive = is_plugin_active( $pluginSlug );

		// Include required WordPress files for plugin update.
		require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/misc.php';

		// Create a custom skin to suppress output.
		$skin = new \WP_Ajax_Upgrader_Skin();

		// Create the upgrader instance.
		$upgrader = new \Plugin_Upgrader( $skin );

		// Perform the plugin update.
		$result = $upgrader->upgrade( $pluginSlug );

		// Check if update was successful.
		if ( is_wp_error( $result ) ) {
			wp_send_json_error(
				[
					'messsage' => sprintf(
						// Translators: %s is the error message.
						__( 'Update failed: %s', 'vexaltrix' ),
						$result->get_error_message()
					),
				]
			);
		} elseif ( false === $result ) {
			wp_send_json_error(
				[
					'messsage' => __( 'Update failed. Please try again or update manually from the plugins page.', 'vexaltrix' ),
				]
			);
		}

		// Reactivate the plugin if it was active before.
		if ( $wasActive ) {
			$activateResult = activate_plugin( $pluginSlug );
			if ( is_wp_error( $activateResult ) ) {
				wp_send_json_error(
					[
						'messsage' => sprintf(
							// Translators: %s is the error message.
							__( 'Plugin updated but reactivation failed: %s', 'vexaltrix' ),
							$activateResult->get_error_message()
						),
					]
				);
			}
		}

		// Get the new version after update.
		$pluginData = get_plugin_data( WP_PLUGIN_DIR . '/' . $pluginSlug );
		$newVersion = isset( $pluginData['Version'] ) ? $pluginData['Version'] : '';

		wp_send_json_success(
			[
				'messsage'    => sprintf(
					// Translators: %s is the new version number.
					__( 'Successfully updated to version %s!', 'vexaltrix' ),
					esc_html( $newVersion )
				),
				'new_version' => $newVersion,
				'reload'      => true,
			]
		);
	}

	/**
	 * Save setting - Enables legacy blocks.
	 *
	 * @return void
	 */
	public function enableLegacyBlocks() {
		$this->checkPermissionNonce( 'uag_enable_legacy_blocks' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_enable_legacy_blocks', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Enables file generation.
	 *
	 * @return void
	 */
	public function enableFileGeneration() {
		$this->checkPermissionNonce( 'uag_enable_file_generation' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( '_vxt_ultimate_gutenberg_blocks_allow_file_generation', sanitize_text_field( $value ) );
	}

	/**
	 * Delete all Assets.
	 *
	 * @since 2.6.2
	 * @return void
	 */
	public function deleteAllAssets() {

		$value = $this->checkPostValue();

		$wpUploadDir = \Vexaltrix\Support\Helper::getUagUploadDirPath();

		if ( file_exists( $wpUploadDir . 'custom-style-blocks.css' ) ) {
			wp_delete_file( $wpUploadDir . 'custom-style-blocks.css' );
		}

		if ( ! empty( $value ) ) {

			$fileGeneration = \Vexaltrix\Support\Helper::allowFileGeneration();

			if ( 'enabled' === $fileGeneration ) {

				\Vexaltrix\Support\Helper::deleteUagAssetDir();
			}

			\Vexaltrix\Admin\AdminSettings::createSpecificStylesheet();

			/* Update the asset version */
			\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( '__vxt_ultimate_gutenberg_blocks_asset_version', time() );

		}
	}
	/**
	 * Save setting - Regenerates assets.
	 *
	 * @return void
	 */
	public function regenerateAssets() {
		$this->checkPermissionNonce( 'uag_regenerate_assets' );
		
		/* Update the asset version */
		\Vexaltrix\Admin\AdminSettings::createSpecificStylesheet();
		\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( '__vxt_ultimate_gutenberg_blocks_asset_version', time() );

		$responseData = [
			'messsage' => __( 'Successfully saved data!', 'vexaltrix' ),
		];
		wp_send_json_success( $responseData );
	}

	/**
	 * Save setting - Sanitizes form inputs.
	 *
	 * @param array $inputSettings setting data.
	 * @return array    The sanitized form inputs.
	 */
	public function sanitizeFormInputs( $inputSettings = [] ) {
		$newSettings = [];

		if ( ! empty( $inputSettings ) ) {
			foreach ( $inputSettings as $key => $value ) {

				$newKey = sanitize_text_field( $key );

				if ( is_array( $value ) ) {
					$newSettings[ $newKey ] = $this->sanitizeFormInputs( $value );
				} else {
					$newSettings[ $newKey ] = sanitize_text_field( $value );
				}
			}
		}

		return $newSettings;
	}

	/**
	 * Save setting - Loads font awesome 5.
	 *
	 * @return void
	 */
	public function loadFontAwesome5() {
		$this->checkPermissionNonce( 'uag_load_font_awesome_5' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_load_font_awesome_5', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - Auto recovers the block.
	 *
	 * @return void
	 */
	public function autoBlockRecovery() {
		$this->checkPermissionNonce( 'uag_auto_block_recovery' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'uag_auto_block_recovery', sanitize_text_field( $value ) );
	}

	/**
	 * Save setting - All Linked Instagram Accounts.
	 *
	 * @return void
	 *
	 * @since 2.4.1
	 */
	public function instaLinkedAccounts() {
		$this->checkPermissionNonce( 'uag_insta_linked_accounts' );
		$value = $this->checkPostValueJson();
		$value = json_decode( $value, true );

		// SECURITY: Validate JSON decode was successful.
		if ( null === $value && JSON_ERROR_NONE !== json_last_error() ) {
			wp_send_json_error( [ 'messsage' => __( 'Invalid JSON data received.', 'vexaltrix' ) ] );
		}

		// The previous $value is not sanitized, as the array sanitization is handled in the class method used below.
		$this->saveAdminSettings( 'uag_insta_linked_accounts', $this->sanitizeFormInputs( $value ) );
	}

	/**
	 * Save setting - All Instagram Users' Media.
	 *
	 * @return void
	 *
	 * @since 2.4.1
	 */
	public function instaAllUsersMedia() {
		$this->checkPermissionNonce( 'uag_insta_all_users_media' );
		$value = $this->checkPostValueJson();
		$value = json_decode( $value, true );

		// SECURITY: Validate JSON decode was successful.
		if ( null === $value && JSON_ERROR_NONE !== json_last_error() ) {
			wp_send_json_error( [ 'messsage' => __( 'Invalid JSON data received.', 'vexaltrix' ) ] );
		}
		// The previous $value is not sanitized, as the array sanitization is handled in the class method used below.
		$this->saveAdminSettings( 'uag_insta_all_users_media', $this->sanitizeFormInputs( $value ) );
	}

	/**
	 * Ajax Request - Refresh All Instagram Tokens.
	 *
	 * @return void
	 *
	 * @since 2.4.1
	 */
	public function instaRefreshAllTokens() {
		// nonce verification is done in above function check_permission_nonce.
		$this->checkPermissionNonce( 'uag_insta_refresh_all_tokens' );
		if ( ! empty( $_POST['value'] ) && class_exists( '\VexaltrixPro\BlocksConfig\InstagramFeed\Block' ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Missing
			\VexaltrixPro\BlocksConfig\InstagramFeed\Block::refresh_all_instagram_users();
			wp_send_json_success( [ 'messsage' => __( 'Successfully refreshed tokens!', 'vexaltrix' ) ] );
		}
		wp_send_json_error( [ 'messsage' => __( 'Failed to refresh tokens', 'vexaltrix' ) ] );
	}

	/**
	 * Save setting - Enables GBS extension.
	 *
	 * @since 2.9.0
	 * @return void
	 */
	public function enableGbsExtension() {
		$this->checkPermissionNonce( 'uag_enable_gbs_extension' );
		$value = $this->checkPostValue();

		$value = 'enabled' === $value ? 'enabled' : 'disabled';
		$this->saveGbsDefaultInUploadFolder( $value );

		$this->saveAdminSettings( 'uag_enable_gbs_extension', $value );
	}

	/**
	 * Generate or delete default block css files.
	 * These generated files will be used in frontend.
	 * when user will disable GBS extension.
	 *
	 * @param string $value value will be enabled or disabled.
	 * @since 2.9.0
	 * @return void
	 */
	public function saveGbsDefaultInUploadFolder( $value ) {
		$vexaltrixGlobalBlockStyles = get_option( 'vexaltrix_global_block_styles', [] );

		if ( empty( $vexaltrixGlobalBlockStyles ) || ! is_array( $vexaltrixGlobalBlockStyles ) ) {
			return;
		}

		$createBlockArray = [];

		foreach ( $vexaltrixGlobalBlockStyles as $styles ) {
			if ( empty( $styles['blockName'] ) || ! is_string( $styles['blockName'] ) ) {
				continue;
			}

			$createBlockArray[ $styles['blockName'] ] = true;
		}

		// Remove assets if css available.
		if ( 'enabled' === $value ) {
			// Store all post ids in array.
			$postIds = [];

			foreach ( $vexaltrixGlobalBlockStyles as $stylesGet ) {
				if ( empty( $stylesGet['post_ids'] ) ) {
					continue;
				}

				foreach ( $stylesGet['post_ids'] as $postId ) {
					if ( ! $postId || in_array( $postId, $postIds ) ) {
						continue;
					}

					delete_post_meta( $postId, '_uag_page_assets' );
					delete_post_meta( $postId, '_uag_css_file_name' );
					delete_post_meta( $postId, '_uag_js_file_name' );

					$postIds[] = $postId;
				}
			}

			update_option( '__vxt_ultimate_gutenberg_blocks_asset_version', time() );
		}

		foreach ( $createBlockArray as $blockName => $index ) {
			// Check if uagb string exist in $blockName or not.
			if ( ! is_string( $blockName ) || 0 !== strpos( $blockName, 'vexaltrix/' ) ) {
				continue;
			}

			$blockSlug = str_replace( 'vexaltrix/', '', $blockName );

			// This is class name and file name.
			$className = 'vxt-gbs-default-' . $blockSlug;

			$wpUploadDir = \Vexaltrix\Support\Helper::getUagUploadDirPath();

			$pathAndFileName = $wpUploadDir . $className . '.css';

			// If $value is enabled then only remove css default files.
			if ( 'enabled' === $value ) {
				\Vexaltrix\Support\Helper::removeFile( $pathAndFileName );
				continue;
			}

			// For default GBS id we are assigning default GBS id attr globalBlockStyleId = $className.
			$dummyAttr = [ 'globalBlockStyleId' => $className ];

			$blockCss = \Vexaltrix\Core\Blocks\BlockModule::getFrontendCss( $blockSlug, $dummyAttr, '', true );

			$tabStylingCss = '';
			$mobStylingCss = '';
			$desktop         = $blockCss['desktop'];

			if ( ! empty( $blockCss['tablet'] ) ) {
				$tabStylingCss .= '@media only screen and (max-width: ' . VXT_TABLET_BREAKPOINT . 'px) {';
				$tabStylingCss .= $blockCss['tablet'];
				$tabStylingCss .= '}';
			}

			if ( ! empty( $blockCss['mobile'] ) ) {
				$mobStylingCss .= '@media only screen and (max-width: ' . VXT_MOBILE_BREAKPOINT . 'px) {';
				$mobStylingCss .= $blockCss['mobile'];
				$mobStylingCss .= '}';
			}
			$blockCss = $desktop . $tabStylingCss . $mobStylingCss;

			$wp_filesystem = vxt_ultimate_gutenberg_blocks_filesystem();
			$wp_filesystem->put_contents( $pathAndFileName, $blockCss, FS_CHMOD_FILE );
		}
	}

	/**
	 * Save setting - Enables or Disables the given Zip AI Module.
	 *
	 * @since 2.10.2
	 * @return void
	 */
	public function zipAiModuleStatus() {
		// Check permission.
		$this->checkPermissionNonce( 'uag_zip_ai_module_status' );
		// Check the post value.
		$value = $this->checkPostValue();
		// Check the post module.
		$module = $this->checkPostValue( 'module' );

		// If module is not a string, then abandon ship.
		if ( ! is_string( $module ) ) {
			// Since the module was not a string, set it to a blank string and send an error message as the response.
			$module = '';
			wp_send_json_error( [ 'messsage' => __( 'Module not found!', 'vexaltrix' ) ] );
		}

		// Sanitize the module.
		$module = sanitize_text_field( $module );

		// Replace the underscores in the module name with spaces, make the word AI capital, and capitalize the first letter of each word.
		$moduleName = ucwords( str_replace( '_', ' ', str_replace( 'ai', 'AI', $module ) ) );

		// Check if the Zip AI Module is available.
		if ( class_exists( '\ZipAI\Classes\Module' ) ) {
			// If the value is 'disabled', disable the Zip AI Module - else enable it.
			if ( 'disabled' === $value ) {
				if ( Zip_Ai_Module::disable( $module ) ) {
					wp_send_json_success(
						[
							'messsage' => sprintf(
							// Translators: %s is the module name.
								__( '%s disabled!', 'vexaltrix' ),
								$moduleName
							),
						]
					);
				} else {
					wp_send_json_error(
						[
							'messsage' => sprintf(
							// Translators: %s is the module name.
								__( 'Unable to disable %s', 'vexaltrix' ),
								$moduleName
							),
						]
					);
				}
			} else {
				if ( Zip_Ai_Module::enable( $module ) ) {
					wp_send_json_success(
						[
							'messsage' => sprintf(
							// Translators: %s is the module name.
								__( '%s enabled!', 'vexaltrix' ),
								$moduleName
							),
						]
					);
				} else {
					wp_send_json_error(
						[
							'messsage' => sprintf(
							// Translators: %s is the module name.
								__( 'Unable to enable %s', 'vexaltrix' ),
								$moduleName
							),
						]
					);
				}
			}
		} else {
			wp_send_json_error( [ 'messsage' => __( 'Unable to save setting.', 'vexaltrix' ) ] );
		}
	}

	/**
	 * Ajax Request - Verify if Zip AI is authorized.
	 *
	 * @since 2.10.2
	 * @return void
	 */
	public function zipAiVerifyAuthenticity() {
		// Check permission.
		$this->checkPermissionNonce( 'uag_zip_ai_verify_authenticity' );

		// If the Zip AI Helper Class exists, return a success based on the authorizatoin status, else return an error.
		if ( class_exists( '\ZipAI\Classes\Helper' ) ) {
			// Send a boolean based on whether the auth token has been added.
			wp_send_json_success( [ 'is_authorized' => Zip_Ai_Helper::is_authorized() ] );
		} else {
			wp_send_json_error( [ 'messsage' => __( 'Unable to verify authenticity.', 'vexaltrix' ) ] );
		}
	}

	/**
	 * Save setting - Usage data.
	 *
	 * @since 2.19.5
	 * @return void
	 */
	public function enableBsfAnalyticsOption() {
		$this->checkPermissionNonce( 'uag_enable_bsf_analytics_option' );
		$value = $this->checkPostValue();
		$this->saveAdminSettings( 'vexaltrix_analytics_optin', sanitize_text_field( $value ) );
	}
}
