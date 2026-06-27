<?php
/**
 * Vexaltrix Plugin Loader & Bootstrapper.
 *
 * @package Vexaltrix\Core
 * @since x.x.x
 */

declare(strict_types=1);

namespace Vexaltrix\Core;

use BSF_Analytics_Loader;
use Vexaltrix\Core\Events\EventDispatcher;
use Vexaltrix\Core\Module\ModuleRegistry;
use Vexaltrix\Core\Registry\ServiceRegistry;
use ZipAI\Classes\Module as Zip_Ai_Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\\Core\\Plugin' ) ) {

	/**
	 * Main plugin bootstrap class.
	 */
	final class Plugin {

		/**
		 * Singleton instance of the loader.
		 *
		 * @var Plugin
		 */
		private static $instance;

		/**
		 * Post assets object cache
		 *
		 * @var array
		 */
		public $postAssetsObjs = [];

		/**
		 * Block analytics instance reference.
		 *
		 * @var \Vexaltrix\Domain\Analytics\BlockAnalytics
		 */
		public $blockAnalytics;

		/**
		 * Initiator
		 */
		public static function getInstance() {
			$instance = Container::getInstance()->get( self::class );
			static $fired = false;
			if ( ! $fired ) {
				$fired = true;
				do_action( 'vexaltrix_core_loaded' );
			}
			return $instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			register_activation_hook( VXT_FILE, [ $this, 'activationReset' ] );
			register_deactivation_hook( VXT_FILE, [ $this, 'deactivationReset' ] );

			$this->defineConstants();
			$this->wireCore();
			$this->loadLibraries();

			// Hook service and module bootstrap.
			add_action( 'plugins_loaded', [ $this, 'bootServices' ] );
			add_action( 'init', [ $this, 'bootModules' ], 5 );

			// Hook other filters/compatibility handlers that remain in bootstrap.
			add_filter( 'restPreDispatch', [ $this, 'restPreDispatch' ], 10, 3 );
			add_filter( 'zip_ai_library_textdomain', [ $this, 'syncLibraryTextdomain' ] );
			add_filter( 'zip_ai_collab_product_details', [ $this, 'addZipAiCollabProductDetails' ], 20, 1 );
			add_filter( 'zip_ai_modules', [ $this, 'addZipAiModules' ], 20, 1 );
			add_filter( 'zip_ai_auth_redirection_flag', '__return_true', 20, 1 );
			add_filter( 'zip_ai_auth_redirection_url', [ $this, 'addZipAiRedirectionUrl' ], 20, 1 );
			add_filter( 'zip_ai_revoke_redirection_url', [ $this, 'addZipAiRedirectionUrl' ], 20, 1 );
			add_filter( 'bsf_core_stats', [ $this, 'vexaltrixGetSpecificStats' ] );
		}

		/**
		 * Register core engine components in Container.
		 */
		private function wireCore(): void {
			$container = Container::getInstance();

			// Event dispatcher (singleton).
			$dispatcher = new EventDispatcher();
			$dispatcher->bridgeToWordPress( true );
			$container->singleton( EventDispatcher::class, fn() => $dispatcher );

			// Service registry for modules.
			$registry = new ServiceRegistry( $container );
			$container->singleton( ServiceRegistry::class, fn() => $registry );

			// Module registry.
			$modules = new ModuleRegistry( $registry );
			$container->singleton( ModuleRegistry::class, fn() => $modules );

			// Service discovery engine.
			$discovery = new ServiceDiscovery( $container );
			$container->singleton( ServiceDiscovery::class, fn() => $discovery );

			// Explicit bindings for singleton services with private constructors.
			$container->singleton( \Vexaltrix\Domain\Analytics\AnalyticsEventTracker::class, fn() => self::instantiatePrivate( \Vexaltrix\Domain\Analytics\AnalyticsEventTracker::class ) );
			$container->singleton( \Vexaltrix\Integration\Integrations\ZipwpImages::class, fn() => self::instantiatePrivate( \Vexaltrix\Integration\Integrations\ZipwpImages::class ) );
			$container->singleton( \Vexaltrix\Integration\Integrations\ZipAi::class, fn() => self::instantiatePrivate( \Vexaltrix\Integration\Integrations\ZipAi::class ) );
			$container->singleton( \Vexaltrix\Integration\Integrations\AstBlockTemplates::class, fn() => self::instantiatePrivate( \Vexaltrix\Integration\Integrations\AstBlockTemplates::class ) );
			$container->singleton( \Vexaltrix\Integration\Integrations\NpsSurvey::class, fn() => self::instantiatePrivate( \Vexaltrix\Integration\Integrations\NpsSurvey::class ) );
			$container->singleton( \Vexaltrix\Integration\Integrations\UtmAnalytics::class, fn() => self::instantiatePrivate( \Vexaltrix\Integration\Integrations\UtmAnalytics::class ) );
			$container->singleton( \Vexaltrix\Presentation\Admin\NpsNotice::class, fn() => self::instantiatePrivate( \Vexaltrix\Presentation\Admin\NpsNotice::class ) );
			$container->singleton( \Vexaltrix\Presentation\Admin\Onboarding::class, fn() => self::instantiatePrivate( \Vexaltrix\Presentation\Admin\Onboarding::class ) );
		}

		/**
		 * Instantiate a class with a private/protected constructor.
		 *
		 * @template T
		 * @param class-string<T> $class Class name.
		 * @return T
		 */
		private static function instantiatePrivate( string $class ): object {
			$ref = new \ReflectionClass( $class );
			$instance = $ref->newInstanceWithoutConstructor();
			$constructor = $ref->getConstructor();
			if ( $constructor ) {
				$constructor->setAccessible( true );
				$constructor->invoke( $instance );
			}
			return $instance;
		}

		/**
		 * Discover and boot all services across the 5 layer folders.
		 */
		public function bootServices(): void {
			Container::getInstance()->get( ServiceDiscovery::class )->boot();

			// Resolve domain block analytics & event tracker once services are booted.
			$this->blockAnalytics = Container::getInstance()->get( \Vexaltrix\Domain\Analytics\BlockAnalytics::class );
			Container::getInstance()->get( \Vexaltrix\Domain\Analytics\AnalyticsEventTracker::class );
		}

		/**
		 * Boot registered modules.
		 */
		public function bootModules(): void {
			$container = Container::getInstance();
			$registry  = $container->get( ModuleRegistry::class );

			foreach ( $this->moduleClasses as $class ) {
				$registry->register( $class );
			}

			$registry->boot();
		}

		/**
		 * Registered module classes.
		 *
		 * @var array
		 */
		private array $moduleClasses = [];

		/**
		 * Defines all constants
		 */
		public function defineConstants() {
			define( 'VXT_BASE', plugin_basename( VXT_FILE ) );
			define( 'VXT_DIR', plugin_dir_path( VXT_FILE ) );
			define( 'VXT_URL', plugins_url( '/', VXT_FILE ) );
			define( 'VXT_VER', '2.19.26' );
			define( 'VXT_MODULES_DIR', VXT_DIR . 'modules/' );
			define( 'VXT_MODULES_URL', VXT_URL . 'modules/' );
			define( 'VXT_SLUG', 'vexaltrix' );
			define( 'VXT_AJAX_PREFIX', 'vxt' );
			define( 'VXT_URI', trailingslashit( 'https://vexaltrix.com/' ) );

			if ( ! defined( 'VXT_TABLET_BREAKPOINT' ) ) {
				define( 'VXT_TABLET_BREAKPOINT', '976' );
			}
			if ( ! defined( 'VXT_MOBILE_BREAKPOINT' ) ) {
				define( 'VXT_MOBILE_BREAKPOINT', '767' );
			}

			if ( ! defined( 'VXT_UPLOAD_DIR_NAME' ) ) {
				define( 'VXT_UPLOAD_DIR_NAME', 'uag-plugin' );
			}

			$uploadDir = wp_upload_dir( null, false );

			if ( ! defined( 'VXT_UPLOAD_DIR' ) ) {
				define( 'VXT_UPLOAD_DIR', $uploadDir['basedir'] . '/' . VXT_UPLOAD_DIR_NAME . '/' );
			}

			if ( ! defined( 'VXT_UPLOAD_URL' ) ) {
				define( 'VXT_UPLOAD_URL', $uploadDir['baseurl'] . '/' . VXT_UPLOAD_DIR_NAME . '/' );
			}

			define( 'VXT_ASSET_VER', get_option( '__vxt_ultimate_gutenberg_blocks_asset_version', VXT_VER ) );
			define( 'VXT_CSS_EXT', defined( 'WP_DEBUG' ) && WP_DEBUG ? '.css' : '.min.css' );
			define( 'VXT_JS_EXT', defined( 'WP_DEBUG' ) && WP_DEBUG ? '.js' : '.min.js' );
		}

		/**
		 * Load legacy non-PSR-4 library files.
		 */
		private function loadLibraries(): void {
			// BSF Analytics.
			if ( ! class_exists( 'BSF_Analytics_Loader' ) ) {
				require_once VXT_DIR . 'app/lib/bsf-analytics/class-bsf-analytics-loader.php';
			}

			if ( class_exists( 'BSF_Analytics_Loader' ) && is_callable( 'BSF_Analytics_Loader::get_instance' ) ) {
				$vexaltrixBsfAnalytics = BSF_Analytics_Loader::get_instance();

				$vexaltrixBsfAnalytics->set_entity(
					[
						'vexaltrix' => [
							'product_name'        => 'Vexaltrix',
							'path'                => VXT_DIR . 'app/lib/bsf-analytics',
							'author'              => 'Vexaltrix by Brainstorm Force',
							'time_to_display'     => '+24 hours',
							'deactivation_survey' => apply_filters(
								'vexaltrix_deactivation_survey_data',
								[
									[
										'id'              => 'deactivation-survey-vexaltrix',
										'popup_logo'      => esc_url( plugin_dir_url( __DIR__ ) . 'assets/images/logos/vexaltrix.svg' ),
										'plugin_slug'     => 'vexaltrix',
										'popup_title'     => 'Quick Feedback',
										'support_url'     => 'https://wpvexaltrix.com/contact/',
										'popup_description' => 'If you have a moment, please share why you are deactivating Vexaltrix:',
										'show_on_screens' => [ 'plugins' ],
										'plugin_version'  => VXT_VER,
									],
								]
							),
							'hide_optin_checkbox' => true,
						],
					]
				);
			}

			// Load One Onboarding library.
			if ( file_exists( VXT_DIR . 'app/lib/one-onboarding/loader.php' ) ) {
				require_once VXT_DIR . 'app/lib/one-onboarding/loader.php';
			}

			// Admin Notices helper library.
			require_once VXT_DIR . 'app/lib/vxt-admin-notices/class-vxt-admin-notices.php';
		}

		/**
		 * Activation Reset.
		 */
		public function activationReset() {
			$hasActivatedBefore = get_option( '__vxt_ultimate_gutenberg_blocks_activated_before', false );

			if ( ! $hasActivatedBefore ) {
				\Vexaltrix\Infrastructure\Install::getInstance()->createFiles();
		
				update_option( '__vxt_ultimate_gutenberg_blocks_do_redirect', true );
				update_option( '__vxt_ultimate_gutenberg_blocks_activated_before', true );
				update_option( '__vxt_ultimate_gutenberg_blocks_asset_version', time() );
			} else {
				update_option( '__vxt_ultimate_gutenberg_blocks_do_redirect', false );
			}
		}

		/**
		 * Deactivation Reset.
		 */
		public function deactivationReset() {
			update_option( '__vxt_ultimate_gutenberg_blocks_do_redirect', false );
		}

		/**
		 * Sync the Zip AI Library textdomain with the Vexaltrix textdomain.
		 */
		public function syncLibraryTextdomain( $textdomain ) {
			return 'vexaltrix';
		}

		/**
		 * Add the Zip AI Collab Product Details.
		 */
		public function addZipAiCollabProductDetails( $productDetails ) {
			return [
				'product_name'                          => 'Vexaltrix',
				'product_slug'                          => 'vexaltrix',
				'product_logo'                          => file_get_contents( VXT_DIR . 'assets/images/logos/vexaltrix.svg' ),
				'product_primary_color'                 => '#5733ff',
				'ai_assistant_learn_more_url'           => admin_url( 'admin.php?page=vexaltrix&path=ai-features' ),
				'ai_assistant_authorized_disable_url'   => admin_url( 'admin.php?page=vexaltrix&path=ai-features&manage-features=yes' ),
				'ai_assistant_unauthorized_disable_url' => admin_url( 'admin.php?page=vexaltrix&path=ai-features&manage-features=yes' ),
			];
		}

		/**
		 * Add the Zip AI Modules that come with Vexaltrix.
		 */
		public function addZipAiModules( $modules ) {
			$modules = is_array( $modules ) ? $modules : [];
			$modulesToEnable = [ 'ai_assistant', 'ai_design_copilot' ];

			foreach ( $modulesToEnable as $moduleName ) {
				if ( class_exists( '\ZipAI\Classes\Module' ) && method_exists( '\ZipAI\Classes\Module', 'force_enabled' ) ) {
					\ZipAI\Classes\Module::force_enabled( $modules, $moduleName );
				}
			}

			return $modules;
		}

		/**
		 * Add the Zip AI Authorization/Revoke URL.
		 */
		public function addZipAiRedirectionUrl( $authUrl ) {
			return admin_url( 'admin.php?page=vexaltrix&path=ai-features' );
		}

		/**
		 * Get BSF core stats callback.
		 */
		public function vexaltrixGetSpecificStats( $defaultStats ) {
			$defaultStats['plugin_data']['vexaltrix'] = [
				'version'              => VXT_VER,
				'old_user_less_than_2' => get_option( 'vxt-old-user-less-than-2' ),
				'migration_status'     => get_option( 'uag_migration_status' ),
			];

			// Load global options values.
			$globalData = [
				'beta'                      => get_option( 'vxt_ultimate_gutenberg_blocks_beta' ),
				'enableLegacyBlocks'      => get_option( 'uag_enable_legacy_blocks' ),
				'file_generation'           => get_option( '_vxt_ultimate_gutenberg_blocks_allow_file_generation' ),
				'templates_button'          => get_option( 'uag_enable_templates_button' ),
				'on_page_css_button'        => get_option( 'uag_enable_on_page_css_button' ),
				'block_condition'           => get_option( 'uag_enable_block_condition' ),
				'quick_action_sidebar'      => get_option( 'uag_enable_quick_action_sidebar' ),
				'gbs_extension'             => get_option( 'uag_enable_gbs_extension' ),
				'block_responsive'          => get_option( 'uag_enable_block_responsive' ),
				'loadSelectFontGlobally'     => get_option( 'uag_load_select_font_globally' ),
				'loadGfontsLocally'           => get_option( 'uag_load_gfonts_locally' ),
				'collapsePanels'               => get_option( 'uag_collapse_panels' ),
				'copyPaste'                    => get_option( 'uag_copy_paste' ),
				'preloadLocalFonts'           => get_option( 'uag_preload_local_fonts' ),
				'visibilityMode'               => get_option( 'uag_visibility_mode' ),
				'containerGlobalPadding'      => get_option( 'uag_container_global_padding' ),
				'containerGlobalElementsGap' => get_option( 'uag_container_global_elements_gap' ),
				'btnInheritFromTheme'        => get_option( 'uag_btn_inherit_from_theme' ),
				'blocksEditorSpacing'         => get_option( 'uag_blocks_editor_spacing' ),
				'loadFontAwesome5'           => get_option( 'uag_load_font_awesome_5' ),
				'autoBlockRecovery'           => get_option( 'uag_auto_block_recovery' ),
				'loadFseFontGlobally'        => get_option( 'uag_load_fse_font_globally' ),
			];

			$defaultStats['plugin_data']['vexaltrix'] = array_merge_recursive( $defaultStats['plugin_data']['vexaltrix'], $globalData );

			return $defaultStats;
		}

		/**
		 * Fix REST API issues with block attributes.
		 */
		public function restPreDispatch( $result, $server, $request ) {
			if ( strpos( $request->get_route(), '/wp/v2/block-renderer' ) !== false && isset( $request['attributes'] ) ) {
				$attributes = $request['attributes'];
				$keys = [
					'UAGUserRole', 'Vexaltrixrowser', 'UAGSystem', 'UAGDisplayConditions', 
					'UAGHideDesktop', 'UAGHideMob', 'UAGHideTab', 'UAGLoggedIn', 'UAGLoggedOut', 
					'UAGDay', 'zIndex', 'UAGResponsiveConditions', 'UAGAnimationType', 'UAGAnimationTime', 
					'UAGAnimationDelay', 'UAGAnimationEasing', 'UAGAnimationRepeat', 'UAGAnimationDelayInterval', 
					'UAGAnimationDoNotApplyToContainer', 'UAGStickyLocation', 'UAGStickyRestricted', 
					'UAGStickyOffset', 'UAGPosition'
				];

				foreach ( $keys as $key ) {
					if ( isset( $attributes[ $key ] ) ) {
						unset( $attributes[ $key ] );
					}
				}

				$request['attributes'] = $attributes;
			}
			return $result;
		}
	}
}
