<?php
/**
 * Uag Admin Helper.
 *
 * @package Uag
 */

namespace Vexaltrix\Admin;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use ZipAI\Classes\Module as Zip_Ai_Module;

/**
 * Class \Vexaltrix\Admin\DashboardHelper.
 */
class DashboardHelper {

	/**
	 * Common.
	 *
	 * @var object instance
	 */
	public static $common = null;

	/**
	 * Options.
	 *
	 * @var object instance
	 */
	public static $options = null;

	/**
	 * Get Common settings.
	 *
	 * @return array.
	 */
	public static function getCommonSettings() {

		$uagVersions = self::getRollbackVersionsOptions();

		$themeData          = \WP_Theme_JSON_Resolver::get_theme_data();
		$themeSettings      = $themeData->get_settings();
		$themeFontFamilies = isset( $themeSettings['typography']['fontFamilies']['theme'] ) && is_array( $themeSettings['typography']['fontFamilies']['theme'] ) ? $themeSettings['typography']['fontFamilies']['theme'] : [];

		// Prepare to get the Zip AI Co-pilot modules.
		$zipAiModules = [];

		// If the Zip AI Helper is available, get the required modules and their states.
		if ( class_exists( '\ZipAI\Classes\Module' ) ) {
			$zipAiModules = Zip_Ai_Module::get_all_modules();
		}

		$inheritFromTheme = false !== get_option( 'uag_btn_inherit_from_theme_fallback' ) ? 'disabled' : \Vexaltrix\Admin\AdminSettings::get( 'uag_btn_inherit_from_theme', 'disabled' );

		$options = [
			'rollback_to_previous_version'       => isset( $uagVersions[0]['value'] ) ? $uagVersions[0]['value'] : '',
			'enableBetaUpdates'                => \Vexaltrix\Admin\AdminSettings::get( 'vxt_ultimate_gutenberg_blocks_beta', 'no' ),
			'enableFileGeneration'             => \Vexaltrix\Admin\AdminSettings::get( '_vxt_ultimate_gutenberg_blocks_allow_file_generation', 'enabled' ),
			'blocksActivationAndDeactivation' => self::getBlocks(),
			'enableTemplatesButton'            => \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_templates_button', 'yes' ),
			'enableOnPageCssButton'          => \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_on_page_css_button', 'yes' ),
			'enableBlockCondition'             => \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_block_condition', 'disabled' ),
			'enableMasonryGallery'             => \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_masonry_gallery', 'enabled' ),
			'enableQuickActionSidebar'        => \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_quick_action_sidebar', 'enabled' ),
			'enableBlockResponsive'            => \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_block_responsive', 'enabled' ),
			'enableDynamicContent'             => \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_dynamic_content', 'enabled' ),
			'enableAnimationsExtension'        => \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_animations_extension', 'enabled' ),
			'enableGbsExtension'               => \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_gbs_extension', 'enabled' ),
			'selectFontGlobally'               => \Vexaltrix\Admin\AdminSettings::get( 'uag_select_font_globally', [] ),
			'loadSelectFontGlobally'          => \Vexaltrix\Admin\AdminSettings::get( 'uag_load_select_font_globally', 'disabled' ),
			'loadFseFontGlobally'             => \Vexaltrix\Admin\AdminSettings::get( 'uag_load_fse_font_globally', 'disabled' ),
			'loadGfontsLocally'                => \Vexaltrix\Admin\AdminSettings::get( 'uag_load_gfonts_locally', 'disabled' ),
			'collapsePanels'                    => \Vexaltrix\Admin\AdminSettings::get( 'uag_collapse_panels', 'enabled' ),
			'copyPaste'                         => \Vexaltrix\Admin\AdminSettings::get( 'uag_copy_paste', 'enabled' ),
			'preloadLocalFonts'                => \Vexaltrix\Admin\AdminSettings::get( 'uag_preload_local_fonts', 'disabled' ),
			'btnInheritFromTheme'             => \Vexaltrix\Admin\AdminSettings::get( 'uag_btn_inherit_from_theme', 'disabled' ),
			'btn_inherit_from_theme_fallback'    => $inheritFromTheme,
			'social'                             => \Vexaltrix\Admin\AdminSettings::get(
				'uag_social',
				[
					'socialRegister'    => false,
					'googleClientId'    => '',
					'facebookAppId'     => '',
					'facebookAppSecret' => '',
				]
			),
			'dynamicContentMode'               => \Vexaltrix\Admin\AdminSettings::get( 'uag_dynamic_content_mode', 'popup' ),
			'preloadLocalFonts'                => \Vexaltrix\Admin\AdminSettings::get( 'uag_preload_local_fonts', 'disabled' ),
			'visibilityMode'                    => \Vexaltrix\Admin\AdminSettings::get( 'uag_visibility_mode', 'disabled' ),
			'visibilityPage'                    => self::getVisibilityPage(),
			'uag_previous_versions'              => $uagVersions,
			'vxt_ultimate_gutenberg_blocks_old_user_less_than_2'          => get_option( 'vxt-old-user-less-than-2' ),
			'recaptchaSiteKeyV2'              => \Vexaltrix\Admin\AdminSettings::get( 'uag_recaptcha_site_key_v2', '' ),
			'recaptchaSecretKeyV2'            => \Vexaltrix\Admin\AdminSettings::get( 'uag_recaptcha_secret_key_v2', '' ),
			'recaptchaSiteKeyV3'              => \Vexaltrix\Admin\AdminSettings::get( 'uag_recaptcha_site_key_v3', '' ),
			'recaptchaSecretKeyV3'            => \Vexaltrix\Admin\AdminSettings::get( 'uag_recaptcha_secret_key_v3', '' ),
			'instaLinkedAccounts'              => \Vexaltrix\Admin\AdminSettings::get( 'uag_insta_linked_accounts', [] ),
			'vexaltrix_global_fse_fonts'           => \Vexaltrix\Admin\AdminSettings::get( 'vexaltrix_global_fse_fonts', [] ),
			'theme_fonts'                        => $themeFontFamilies,
			'zip_ai_modules'                     => $zipAiModules,
			'enableBsfAnalyticsOption'        => \Vexaltrix\Admin\AdminSettings::get( 'vexaltrix_analytics_optin', 'no' ),
		];

		return $options;
	}

	/**
	 * Get Visibility Page
	 *
	 * @since 2.8.0
	 * @return boolean|array
	 */
	public static function getVisibilityPage() {
		$pageId = \Vexaltrix\Admin\AdminSettings::get( 'uag_visibility_page', '' );

		if ( $pageId ) {
			return [
				'value' => $pageId,
				'label' => \get_the_title( $pageId ),
			];
		}
		return false;
	}

	/**
	 * Get blocks.
	 */
	public static function getBlocks() {
		// Get all blocks.
		$listBlocks    = \Vexaltrix\Support\Helper::$blockList;
		if ( empty( $listBlocks ) ) {
			$listBlocks = \Vexaltrix\Core\Blocks\BlockModule::getBlocksInfo();
		}
		$defaultBlocks = [];

		if ( is_array( $listBlocks ) || is_object( $listBlocks ) ) {
			// Set all extension to enabled.
			foreach ( $listBlocks as $slug => $value ) {
				$slug                    = str_replace( 'vexaltrix/', '', $slug );
				$defaultBlocks[ $slug ] = $slug;
			}
		}

		// Escape attrs.
		$defaultBlocks = array_map( 'esc_attr', $defaultBlocks );
		$savedBlocks   = \Vexaltrix\Admin\AdminSettings::get( '_vxt_ultimate_gutenberg_blocks_blocks', [] );

		return wp_parse_args( $savedBlocks, $defaultBlocks );
	}

	/**
	 * Get options.
	 */
	public static function getOptions() {

		$generalSettings          = self::getCommonSettings();
		$shareableCommonSettings = \Vexaltrix\Admin\AdminSettings::getAdminSettingsShareableData();
		$options                   = array_merge( $generalSettings, $shareableCommonSettings );
		$options                   = apply_filters( 'uag_global_data_options', $options );

		$mappedOptions = [];
		foreach ( $options as $key => $value ) {
			$mappedOptions[ $key ] = $value;
			$snakeKey = strtolower( preg_replace( '/(?<!^)[A-Z]/', '_$0', $key ) );
			if ( $snakeKey !== $key ) {
				$mappedOptions[ $snakeKey ] = $value;
			}
		}

		return $mappedOptions;
	}

	/**
	 * Get Rollback versions.
	 *
	 * @since 1.23.0
	 * @return array
	 * @access public
	 */
	public static function getRollbackVersionsOptions() {

		$rollbackVersions = \Vexaltrix\Admin\AdminSettings::getInstance()->getRollbackVersions();

		$rollbackVersionsOptions = [];

		foreach ( $rollbackVersions as $version ) {

			$version = [
				'label' => $version,
				'value' => $version,

			];

			$rollbackVersionsOptions[] = $version;
		}

		return $rollbackVersionsOptions;
	}
	/**
	 * Sort Rollback versions.
	 *
	 * @param string $prev Previous Version.
	 * @param string $next Next Version.
	 *
	 * @since 1.23.0
	 * @return array
	 * @access public
	 */
	public static function sortRollbackVersions( $prev, $next ) {

		if ( version_compare( $prev, $next, '==' ) ) {
			return 0;
		}

		if ( version_compare( $prev, $next, '>' ) ) {
			return -1;
		}

		return 1;
	}
}
