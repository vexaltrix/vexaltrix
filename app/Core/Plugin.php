<?php
/**
 * Vexaltrix Loader.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Core;

use BSF_Analytics_Loader;
use Vexaltrix\Container;
use Vexaltrix\Core\Providers\AdminServiceProvider;
use Vexaltrix\Core\Providers\AjaxServiceProvider;
use Vexaltrix\Core\Providers\AnalyticsServiceProvider;
use Vexaltrix\Core\Providers\ApiServiceProvider;
use Vexaltrix\Core\Providers\BlocksServiceProvider;
use Vexaltrix\Core\Providers\CompatibilityServiceProvider;
use Vexaltrix\Core\Providers\CoreServiceProvider;
use Vexaltrix\Core\Providers\IntegrationsServiceProvider;
use ZipAI\Classes\Module as Zip_Ai_Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\\Core\\Plugin' ) ) {

	/**
	 * Class \Vexaltrix\Core\Plugin.
	 */
	final class Plugin {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Post assets object cache
		 *
		 * @var array
		 */
		public $postAssetsObjs = [];

		/**
		 * Block analytics instance
		 *
		 * @var \Vexaltrix\Core\Analytics\BlockAnalytics
		 */
		public $blockAnalytics;

		/**
		 * Service provider instances.
		 *
		 * @var array
		 */
		private $serviceProviders = [];

		/**
		 *  Initiator
		 */
		public static function getInstance() {
			$instance = \Vexaltrix\Container::getInstance()->get( self::class );
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
			// Activation hook.
			register_activation_hook( VXT_FILE, [ $this, 'activationReset' ] );

			// deActivation hook.
			register_deactivation_hook( VXT_FILE, [ $this, 'deactivationReset' ] );

			$this->defineConstants();

			$this->registerProviders();

			$this->loader();

			$this->bootProviders();

			add_action( 'after_setup_theme', [ $this, 'loadCompatibility' ] );

			add_action( 'plugins_loaded', [ $this, 'loadPlugin' ] );

			add_action( 'init', [ $this, 'initActions' ] );

			/*
			* BSF Analytics.
			*/
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

			add_filter( 'bsf_core_stats', [ $this, 'vexaltrixGetSpecificStats' ] );

			// Initialize block analytics after BSF analytics is set up.
			$this->blockAnalytics = \Vexaltrix\Core\Analytics\BlockAnalytics::getInstance();

			// Initialize event tracker for milestone analytics.
			\Vexaltrix\Core\Analytics\AnalyticsEventTracker::getInstance();

			// Initialize onboarding.
			\Vexaltrix\Admin\Onboarding::getInstance();
		}

		/**
		 * Register service providers.
		 *
		 * @since x.x.x
		 * @return void
		 */
		private function registerProviders() {
			$providerClasses = [
				CoreServiceProvider::class,
				AdminServiceProvider::class,
				BlocksServiceProvider::class,
				ApiServiceProvider::class,
				AjaxServiceProvider::class,
				IntegrationsServiceProvider::class,
				CompatibilityServiceProvider::class,
				AnalyticsServiceProvider::class,
			];

			$container = Container::instance();

			foreach ( $providerClasses as $providerClass ) {
				$provider = new $providerClass( $container );
				$provider->register();
				$this->serviceProviders[] = $provider;
			}
		}

		/**
		 * Boot service providers.
		 *
		 * @since x.x.x
		 * @return void
		 */
		private function bootProviders() {
			foreach ( $this->serviceProviders as $provider ) {
				$provider->boot();
			}
		}

		/**
		 * Defines all constants
		 *
		 * @since 1.0.0
		 */
		public function defineConstants() {
			define( 'VXT_BASE', plugin_basename( VXT_FILE ) );
			define( 'VXT_DIR', plugin_dir_path( VXT_FILE ) );
			define( 'VXT_URL', plugins_url( '/', VXT_FILE ) );
			define( 'VXT_VER', '2.19.26' );
			define( 'VXT_MODULES_DIR', VXT_DIR . 'modules/' );
			define( 'VXT_MODULES_URL', VXT_URL . 'modules/' );
			define( 'VXT_SLUG', 'vexaltrix' );
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
		 * Loads Other files.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function loader() {

			$this->loadApplicationClasses(
				[
					'Vexaltrix\\Core\\Blocks\\BlockPrioritization',
					'Vexaltrix\\Core\\Install',
					'Vexaltrix\\Support\\Filesystem',
					'Vexaltrix\\Core\\Update',
					'Vexaltrix\\Core\\Blocks\\Block',
					'Vexaltrix\\Migration\\BackgroundProcess',
					'Vexaltrix\\Migration\\MigrateBlocks',
					'Vexaltrix\\Core\\Analytics\\BlockAnalytics',
					'Vexaltrix\\Admin\\Onboarding',
					'Vexaltrix\\Admin\\LearnActions',
					'Vexaltrix\\Admin\\AstraSettingsAutoOpen',
					'Vexaltrix\\Admin\\AdminLearn',
				]
			);

			// Load One Onboarding library.
			if ( file_exists( VXT_DIR . 'app/lib/one-onboarding/loader.php' ) ) {
				require_once VXT_DIR . 'app/lib/one-onboarding/loader.php';
			}


			/**
			 * Register Commands.
			 */
			if ( defined( 'WP_CLI' ) && WP_CLI ) {
				class_exists( 'Vexaltrix\\Core\\Commands\\RegenerateAssetsCommand' );
			}

			if ( is_admin() ) {
				$this->loadApplicationClasses(
					[
						'Vexaltrix\\Admin\\BetaUpdates',
						'Vexaltrix\\Admin\\Rollback',
					]
				);
			}
		}

		/**
		 * Trigger Composer autoloading for application classes that register hooks
		 * when their class files are loaded.
		 *
		 * @param array<int, string> $classes Fully qualified class names.
		 * @since x.x.x
		 * @return void
		 */
		private function loadApplicationClasses( $classes ) {
			foreach ( $classes as $class ) {
				class_exists( $class );
			}
		}

		/**
		 * Load dynamic block configuration classes through Composer.
		 *
		 * @since x.x.x
		 * @return void
		 */
		private function loadBlockConfigClasses() {
			$this->loadApplicationClasses(
				[
					'Vexaltrix\\BlocksConfig\\Post\\Post',
					'Vexaltrix\\BlocksConfig\\PostTimeline\\PostTimeline',
					'Vexaltrix\\BlocksConfig\\Cf7Styler\\Cf7Styler',
					'Vexaltrix\\BlocksConfig\\GfStyler\\GfStyler',
					'Vexaltrix\\BlocksConfig\\TaxonomyList\\TaxonomyList',
					'Vexaltrix\\BlocksConfig\\TableOfContent\\TableOfContent',
					'Vexaltrix\\BlocksConfig\\Forms\\Forms',
					'Vexaltrix\\BlocksConfig\\Lottie\\Lottie',
					'Vexaltrix\\BlocksConfig\\Image\\Image',
					'Vexaltrix\\BlocksConfig\\ImageGallery\\ImageGallery',
					'Vexaltrix\\BlocksConfig\\PopupBuilder\\PopupBuilder',
					'Vexaltrix\\BlocksConfig\\ButtonsChild\\ButtonsChild',
					'Vexaltrix\\BlocksConfig\\GoogleMap\\GoogleMap',
					'Vexaltrix\\BlocksConfig\\Icon\\Icon',
					'Vexaltrix\\BlocksConfig\\Faq\\Faq',
					'Vexaltrix\\BlocksConfig\\Login\\Login',
					'Vexaltrix\\BlocksConfig\\Register\\Register',
					'Vexaltrix\\BlocksConfig\\AdvancedSettings\\BlockPositioning',
				]
			);
		}

		/**
		 * Loads plugin files.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function loadPlugin() {

			$this->loadApplicationClasses(
				[
					'Vexaltrix\\Support\\ScriptsUtils',
					'Vexaltrix\\Core\\Blocks\\BlockModule',
					'Vexaltrix\\Admin\\AdminSettings',
					'Vexaltrix\\Support\\Helper',
				]
			);
			$this->loadBlockConfigClasses();
			require_once VXT_DIR . 'app/lib/vxt-admin-notices/class-vxt-admin-notices.php';
			class_exists( 'Vexaltrix\\Integrations\\ZipwpImages' );
			class_exists( 'Vexaltrix\\Integrations\\NpsSurvey' );
			/**
			 * UTM Analytics lib file.
			 */
			class_exists( 'Vexaltrix\\Integrations\\UtmAnalytics' );

			$isRestRequest = ( defined( 'REST_REQUEST' ) && REST_REQUEST )
				|| isset( $_GET['rest_route'] )
				|| ( isset( $_SERVER['REQUEST_URI'] ) && false !== strpos( $_SERVER['REQUEST_URI'], '/wp-json/' ) );

			if ( is_admin() || $isRestRequest ) {
				\Vexaltrix\Admin\Loader::getInstance();
				class_exists( 'Vexaltrix\\Admin\\Admin' );
			}

			$this->loadApplicationClasses(
				[
					'Vexaltrix\\Assets\\PostAssets',
					'Vexaltrix\\Assets\\FrontAssets',
					'Vexaltrix\\Core\\Blocks\\InitBlocks',
					'Vexaltrix\\Api\\RestApi',
					'Vexaltrix\\Conditions\\Visibility',
					'Vexaltrix\\Core\\Cache\\Caching',
					'Vexaltrix\\Admin\\NpsNotice',
				]
			);

			if ( 'twentyseventeen' === get_template() ) {
				class_exists( 'Vexaltrix\\Compatibility\\TwentySeventeenCompatibility' );
			}

			if ( 'twentysixteen' === get_template() ) {
				class_exists( 'Vexaltrix\\Compatibility\\TwentySixteenCompatibility' );
			}
add_filter( 'restPreDispatch', [ $this, 'restPreDispatch' ], 10, 3 );

			$enableTemplatesButton = \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_templates_button', 'yes' );

			// Sync the Zip AI Library textdomain with the Vexaltrix textdomain.
			add_filter( 'zip_ai_library_textdomain', [ $this, 'syncLibraryTextdomain' ] );

			if ( 'yes' === $enableTemplatesButton ) {
				class_exists( 'Vexaltrix\\Integrations\\AstBlockTemplates' );
			} else {
				add_filter( 'ast_block_templates_disable', '__return_true' );
			}

			// Add the filters for the Zip AI Library and include it.
			add_filter( 'zip_ai_collab_product_details', [ $this, 'addZipAiCollabProductDetails' ], 20, 1 );
			add_filter( 'zip_ai_modules', [ $this, 'addZipAiModules' ], 20, 1 );
			add_filter( 'zip_ai_auth_redirection_flag', '__return_true', 20, 1 );
			add_filter( 'zip_ai_auth_redirection_url', [ $this, 'addZipAiRedirectionUrl' ], 20, 1 );
			add_filter( 'zip_ai_revoke_redirection_url', [ $this, 'addZipAiRedirectionUrl' ], 20, 1 );

			class_exists( 'Vexaltrix\\Integrations\\ZipAi' );
		}

		/**
		 * Sync the Zip AI Library textdomain with the Vexaltrix textdomain.
		 *
		 * @param string $textdomain The textdomain for the Zip AI Library.
		 * @since 2.13.9
		 * @return string The Vexaltrix textdomain.
		 */
		public function syncLibraryTextdomain( $textdomain ) {
			return 'vexaltrix';
		}

		/**
		 * Loads theme compatibility files.
		 *
		 * @since 2.5.1
		 *
		 * @return void
		 */
		public function loadCompatibility() {
			class_exists( 'Vexaltrix\\Compatibility\\FseFontsCompatibility' );
		}
		/**
		 * Fix REST API issue with blocks registered via PHP register_block_type.
		 *
		 * @since 1.25.2
		 *
		 * @param mixed  $result  Response to replace the requested version with.
		 * @param object $server  Server instance.
		 * @param object $request Request used to generate the response.
		 *
		 * @return array Returns updated results.
		 */
		public function restPreDispatch( $result, $server, $request ) {

			if ( strpos( $request->get_route(), '/wp/v2/block-renderer' ) !== false && isset( $request['attributes'] ) ) {

					$attributes = $request['attributes'];

				if ( isset( $attributes['UAGUserRole'] ) ) {
					unset( $attributes['UAGUserRole'] );
				}

				if ( isset( $attributes['Vexaltrixrowser'] ) ) {
					unset( $attributes['Vexaltrixrowser'] );
				}

				if ( isset( $attributes['UAGSystem'] ) ) {
					unset( $attributes['UAGSystem'] );
				}

				if ( isset( $attributes['UAGDisplayConditions'] ) ) {
					unset( $attributes['UAGDisplayConditions'] );
				}

				if ( isset( $attributes['UAGHideDesktop'] ) ) {
					unset( $attributes['UAGHideDesktop'] );
				}

				if ( isset( $attributes['UAGHideMob'] ) ) {
					unset( $attributes['UAGHideMob'] );
				}

				if ( isset( $attributes['UAGHideTab'] ) ) {
					unset( $attributes['UAGHideTab'] );
				}

				if ( isset( $attributes['UAGLoggedIn'] ) ) {
					unset( $attributes['UAGLoggedIn'] );
				}

				if ( isset( $attributes['UAGLoggedOut'] ) ) {
					unset( $attributes['UAGLoggedOut'] );
				}

				if ( isset( $attributes['UAGDay'] ) ) {
					unset( $attributes['UAGDay'] );
				}

				if ( isset( $attributes['zIndex'] ) ) {
					unset( $attributes['zIndex'] );
				}

				if ( isset( $attributes['UAGResponsiveConditions'] ) ) {
					unset( $attributes['UAGResponsiveConditions'] );
				}

				if ( isset( $attributes['UAGAnimationType'] ) ) {
					unset( $attributes['UAGAnimationType'] );
				}

				if ( isset( $attributes['UAGAnimationTime'] ) ) {
					unset( $attributes['UAGAnimationTime'] );
				}

				if ( isset( $attributes['UAGAnimationDelay'] ) ) {
					unset( $attributes['UAGAnimationDelay'] );
				}

				if ( isset( $attributes['UAGAnimationEasing'] ) ) {
					unset( $attributes['UAGAnimationEasing'] );
				}

				if ( isset( $attributes['UAGAnimationRepeat'] ) ) {
					unset( $attributes['UAGAnimationRepeat'] );
				}

				if ( isset( $attributes['UAGAnimationDelayInterval'] ) ) {
					unset( $attributes['UAGAnimationDelayInterval'] );
				}

				if ( isset( $attributes['UAGAnimationDoNotApplyToContainer'] ) ) {
					unset( $attributes['UAGAnimationDoNotApplyToContainer'] );
				}

				if ( isset( $attributes['UAGStickyLocation'] ) ) {
					unset( $attributes['UAGStickyLocation'] );
				}

				if ( isset( $attributes['UAGStickyRestricted'] ) ) {
					unset( $attributes['UAGStickyRestricted'] );
				}

				if ( isset( $attributes['UAGStickyOffset'] ) ) {
					unset( $attributes['UAGStickyOffset'] );
				}

				if ( isset( $attributes['UAGPosition'] ) ) {
					unset( $attributes['UAGPosition'] );
				}

					$request['attributes'] = $attributes;

			}

			return $result;
		}

		/**
		 * Check if Gutenberg is active
		 *
		 * @since 1.1.0
		 *
		 * @return boolean
		 */
		public function isGutenbergActive() {
			return function_exists( 'register_block_type' );
		}

		/**
		 * Load Ultimate Gutenberg Text Domain.
		 * This will load the translation textdomain depending on the file priorities.
		 *      1. Global Languages /wp-content/languages/vexaltrix/ folder
		 *      2. Local directory /wp-content/plugins/vexaltrix/languages/ folder
		 *
		 * @since  1.0.0
		 * @return void
		 */
		public function loadTextdomain() {

			/**
			 * Filters the languages directory path to use for AffiliateWP.
			 *
			 * @param string $langDir The languages directory path.
			 */
			$langDir = apply_filters( 'vxt_ultimate_gutenberg_blocks_languages_directory', VXT_ROOT . '/languages/' );

			load_plugin_textdomain( 'vexaltrix', false, $langDir );
		}

		/**
		 * Fires admin notice when Gutenberg is not installed and activated.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function vxtUltimateGutenbergBlocksFailsToLoad() {

			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			$class = 'notice notice-error';
			/* translators: %s: html tags */
			$message = sprintf( __( 'The %1$sVexaltrix%2$s plugin requires %1$sGutenberg%2$s plugin installed & activated.', 'vexaltrix' ), '<strong>', '</strong>' );

			$actionUrl   = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=gutenberg' ), 'install-plugin_gutenberg' );
			$buttonLabel = __( 'Install Gutenberg', 'vexaltrix' );

			$button = '<p><a href="' . $actionUrl . '" class="button-primary">' . $buttonLabel . '</a></p><p></p>';

			printf( '<div class="%1$s"><p>%2$s</p>%3$s</div>', esc_attr( $class ), wp_kses_post( $message ), wp_kses_post( $button ) );
		}

		/**
		 * Activation Reset
		 */
		public function activationReset() {
			$hasActivatedBefore = get_option( '__vxt_ultimate_gutenberg_blocks_activated_before', false );

			if ( ! $hasActivatedBefore ) {
				VxtUltimateGutenbergBlocksInstall()->createFiles();
		
				update_option( '__vxt_ultimate_gutenberg_blocks_do_redirect', true );
				update_option( '__vxt_ultimate_gutenberg_blocks_activated_before', true );
				update_option( '__vxt_ultimate_gutenberg_blocks_asset_version', time() );
			} else {
				update_option( '__vxt_ultimate_gutenberg_blocks_do_redirect', false );
			}
		}

		/**
		 * Deactivation Reset
		 */
		public function deactivationReset() {
			update_option( '__vxt_ultimate_gutenberg_blocks_do_redirect', false );
		}

		/**
		 * Init actions
		 *
		 * @since 2.0.0
		 *
		 * @return void
		 */
		public function initActions() {

			// Check if Gutenberg is active, if not, don't load anything.
			// TO DO: Add an admin notice to inform the user that Gutenberg is not active.
			if ( ! $this->isGutenbergActive() ) {
				add_action( 'admin_notices', [ $this, 'vxtUltimateGutenbergBlocksFailsToLoad' ] );
				return;
			}

			// Load the text domain for translation.
			$this->loadTextdomain();

			// Register all UAG Lite Blocks. This is done by calling the register_blocks method
			// on the vxt_ultimate_gutenberg_blocks_block() instance. This method is responsible for registering all the
			// blocks in the plugin.
			vxt_ultimate_gutenberg_blocks_block()->registerBlocks();

			$themeFolder = get_template();

				if ( function_exists( 'wp_is_block_theme' ) && wp_is_block_theme() ) {
					if ( 'twentytwentytwo' === $themeFolder ) {
						class_exists( 'Vexaltrix\\Compatibility\\TwentyTwentyTwoCompatibility' );
					}
				}

				if ( 'astra' === $themeFolder ) {
					class_exists( 'Vexaltrix\\Compatibility\\AstraCompatibility' );
				}

			register_meta(
				'post',
				'_uag_custom_page_level_css',
				[
					'show_in_rest'      => true,
					'type'              => 'string',
					'single'            => true,
					'auth_callback'     => function() {
						return current_user_can( 'edit_posts' );
					},
					'sanitize_callback' => function( $metaValue ) {
						return \Vexaltrix\Admin\AdminSettings::sanitizeInlineCss( $metaValue );
					},
				]
			);

			// This class is loaded from blocks config.
			\Vexaltrix\BlocksConfig\PopupBuilder\PopupBuilder::generateScripts();

			\Vexaltrix\Core\Update::migrateVisibilityMode();

			// Adds filters to modify the blocks allowed in excerpts.
			add_filter( 'excerpt_allowed_blocks', [ $this, 'addBlocksToExcerpt' ], 20 );
			add_filter( 'excerpt_allowed_wrapper_blocks', [ $this, 'addWrapperBlocksToExcerpt' ], 20 );
			add_filter( 'vxt_ultimate_gutenberg_blocks_blocks_allowed_in_excerpt', [ $this, 'addVxtUltimateGutenbergBlocksBlocksToExcerpt' ], 20, 2 );
			$this->getRegenerateAssetsOnMigration();
		}

		/**
		 * Adds specified blocks to the list of allowed blocks in excerpts.
		 *
		 * @param array $allowed    List of allowed blocks in excerpts.
		 * @since 2.6.0
		 * @return array            Modified list of allowed blocks in excerpts.
		 */
		public function addBlocksToExcerpt( $allowed ) {
			return apply_filters( 'vxt_ultimate_gutenberg_blocks_blocks_allowed_in_excerpt', $allowed, [ 'vexaltrix/advanced-heading' ] );
		}

		/**
		 * Adds specified wrapper blocks to the list of allowed blocks in excerpts.
		 *
		 * @param array $allowed    List of allowed blocks in excerpts.
		 * @since 2.6.0
		 * @return array            Modified list of allowed blocks in excerpts.
		 */
		public function addWrapperBlocksToExcerpt( $allowed ) {
			return apply_filters(
				'vxt_ultimate_gutenberg_blocks_blocks_allowed_in_excerpt',
				$allowed,
				[
					'vexaltrix/container',
					'vexaltrix/columns',
					'vexaltrix/column',
				]
			);
		}

		/**
		 * Adds specified Vexaltrix blocks to the list of allowed blocks in excerpts.
		 *
		 * @param array $excerptBlocks     List of allowed blocks in excerpts.
		 * @param array $blocksToAdd      Blocks to add to the list of allowed blocks in excerpts.
		 * @since 2.6.0
		 * @return array                    The merged excerpt blocks array if both parameters are arrays, or the original excerpt blocks if either parameter is not an array.
		 */
		public function addVxtUltimateGutenbergBlocksBlocksToExcerpt( $excerptBlocks, $blocksToAdd ) {
			if ( is_array( $excerptBlocks ) && is_array( $blocksToAdd ) ) {
				return array_merge( $excerptBlocks, $blocksToAdd );
			}

			// If either parameter is not an array, return the original excerpt blocks.
			return $excerptBlocks;
		}

		/**
		 * Generate assets on migration.
		 *
		 * @since 2.7.10
		 * @return void
		 */
		public function getRegenerateAssetsOnMigration() {
			// Parse the host (domain/hostname) from the site URL.
			$siteHost = wp_parse_url( site_url(), PHP_URL_HOST );

			// Check if $siteHost is empty or not a string. If true, return and exit the function.
			if ( empty( $siteHost ) || ! is_string( $siteHost ) ) {
				return;
			}

			// Remove 'www.' from the domain.
			$domain = str_replace( 'www.', '', $siteHost );

			// Replace dots (.) with dashes (-) in the domain to create $siteDomain.
			$siteDomain = str_replace( '.', '-', $domain );

			// Retrieve the stored domain from admin settings.
			$storedDomain = \Vexaltrix\Admin\AdminSettings::get( 'vxt_ultimate_gutenberg_blocks_site_url', '' );

			// If the stored domain is empty, update the 'vxt_ultimate_gutenberg_blocks_site_url' option in admin settings with the modified site domain and return.
			if ( empty( $storedDomain ) ) {
				\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( 'vxt_ultimate_gutenberg_blocks_site_url', $siteDomain );
				return;
			}

			// If the stored domain is different from the current site domain, update the '__vxt_ultimate_gutenberg_blocks_asset_version' option with the current timestamp.
			if ( $storedDomain !== $siteDomain ) {
				\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( '__vxt_ultimate_gutenberg_blocks_asset_version', time() );
			}
		}

		/**
		 * Add the Zip AI Collab Product Details.
		 *
		 * @param mixed $productDetails The previous product details, if any.
		 * @since 2.10.2
		 * @return array The Vexaltrix product details.
		 */
		public function addZipAiCollabProductDetails( $productDetails ) {
			// Overwrite the product details that were of a lower priority, if any.
			$productDetails = [
				'product_name'                          => 'Vexaltrix',
				'product_slug'                          => 'vexaltrix',
				'product_logo'                          => file_get_contents( VXT_DIR . 'assets/images/logos/vexaltrix.svg' ),
				'product_primary_color'                 => '#5733ff',
				'ai_assistant_learn_more_url'           => admin_url( 'admin.php?page=vexaltrix&path=ai-features' ),
				'ai_assistant_authorized_disable_url'   => admin_url( 'admin.php?page=vexaltrix&path=ai-features&manage-features=yes' ),
				'ai_assistant_unauthorized_disable_url' => admin_url( 'admin.php?page=vexaltrix&path=ai-features&manage-features=yes' ),
			];
			// Return the Vexaltrix product details.
			return $productDetails;
		}

		/**
		 * Add the Zip AI Modules that come with Vexaltrix.
		 *
		 * @param mixed $modules The modules for Zip AI, if any.
		 * @since 2.10.2
		 * @return array The Vexaltrix default modules.
		 */
		public function addZipAiModules( $modules ) {
			// If the filtered modules is not an array, make it one.
			$modules = is_array( $modules ) ? $modules : [];

			// List of module names to enable.
			$modulesToEnable = [ 'ai_assistant', 'ai_design_copilot' ];

			// Ensure each module in the list is enabled.
			foreach ( $modulesToEnable as $moduleName ) {
				// @phpcs:ignore WordPress.NamingConventions.ValidVariableName
				if ( class_exists( '\ZipAI\Classes\Module' ) && method_exists( '\ZipAI\Classes\Module', 'force_enabled' ) ) {
					\ZipAI\Classes\Module::force_enabled( $modules, $moduleName );
				}
			}

			// Return the Vexaltrix default modules.
			return $modules;
		}

		/**
		 * Add the Zip AI Authorization/Revoke URL.
		 *
		 * @param mixed $authUrl The previous authorization URL, if any.
		 * @since 2.10.2
		 * @return string The Vexaltrix redirection URL.
		 */
		public function addZipAiRedirectionUrl( $authUrl ) {
			return admin_url( 'admin.php?page=vexaltrix&path=ai-features' );
		}

		/**
		 * Create an array of block status.
		 *
		 * @return array $blockStatusData An associative array of block slug => status.
		 *                                  The status can be either 'enabled' or 'disabled'.
		 */
		public function createBlockStatusArray() {
			$savedBlocks      = (array) \Vexaltrix\Admin\AdminSettings::get( '_vxt_ultimate_gutenberg_blocks_blocks' );
			$blockManager     = vxt_ultimate_gutenberg_blocks_block();
			$blocks            = ( method_exists( $blockManager, 'getBlocks' ) )
			? (array) $blockManager->getBlocks()
			: [];
			$blockStatusData = [];
			if ( is_array( $blocks ) ) {
				foreach ( $blocks as $slug => $data ) {
					$slug = str_replace( 'vexaltrix/', '', $slug );
			
					// Skip child blocks.
					if ( isset( $blocks[ $slug ]['is_child'] ) ) {
						continue;
					}
			
					// Initialize status array.
					$blockStatusData[ $slug ] = [];
			
					// Check saved status.
					if ( isset( $savedBlocks[ $slug ] ) ) {
						$blockStatusData[ $slug ] = 
							'disabled' === $savedBlocks[ $slug ] ? 'disabled' : 'enabled';
					} else {
						$blockStatusData[ $slug ] = 'enabled';
					}
				}
			}

			return $blockStatusData;
		}

		/**
		 * Generates global setting data for analytics
		 *
		 * @since 1.4.0
		 * @return array
		 */
		public function globalSettingsData() {
			$globalData = [];
			// Prepare to get the Zip AI Co-pilot modules.
			$zipAiModules                               = [];
			$bsfInternalReferrer                        = get_option( 'bsf_product_referers', [] );
			$bsfInternalReferrer                        = (array) $bsfInternalReferrer;
			$globalData['internal_referer']              = isset( $bsfInternalReferrer['vexaltrix'] ) 
				? $bsfInternalReferrer['vexaltrix'] 
				: '';
			$globalData['beta']                          = get_option( 'vxt_ultimate_gutenberg_blocks_beta' );
			$globalData['enableLegacyBlocks']          = get_option( 'uag_enable_legacy_blocks' );
			$globalData['file_generation']               = get_option( '_vxt_ultimate_gutenberg_blocks_allow_file_generation' );
			$globalData['templates_button']              = get_option( 'uag_enable_templates_button' );
			$globalData['on_page_css_button']            = get_option( 'uag_enable_on_page_css_button' );
			$globalData['block_condition']               = get_option( 'uag_enable_block_condition' );
			$globalData['quick_action_sidebar']          = get_option( 'uag_enable_quick_action_sidebar' );
			$globalData['gbs_extension']                 = get_option( 'uag_enable_gbs_extension' );
			$globalData['block_responsive']              = get_option( 'uag_enable_block_responsive' );
			$globalData['loadSelectFontGlobally']     = get_option( 'uag_load_select_font_globally' );
			$globalData['loadGfontsLocally']           = get_option( 'uag_load_gfonts_locally' );
			$globalData['collapsePanels']               = get_option( 'uag_collapse_panels' );
			$globalData['copyPaste']                    = get_option( 'uag_copy_paste' );
			$globalData['preloadLocalFonts']           = get_option( 'uag_preload_local_fonts' );
			$globalData['visibilityMode']               = get_option( 'uag_visibility_mode' );
			$globalData['containerGlobalPadding']      = get_option( 'uag_container_global_padding' );
			$globalData['containerGlobalElementsGap'] = get_option( 'uag_container_global_elements_gap' );
			$globalData['btnInheritFromTheme']        = get_option( 'uag_btn_inherit_from_theme' );
			$globalData['blocksEditorSpacing']         = get_option( 'uag_blocks_editor_spacing' );
			$globalData['loadFontAwesome5']           = get_option( 'uag_load_font_awesome_5' );
			$globalData['autoBlockRecovery']           = get_option( 'uag_auto_block_recovery' );
			$globalData['loadFseFontGlobally']        = get_option( 'uag_load_fse_font_globally' );
			// If the Zip AI Helper is available, get the required modules and their states.
			if ( class_exists( '\ZipAI\Classes\Module' ) ) {
				$zipAiModules = Zip_Ai_Module::get_all_modules();
				// Restructure AI-related data.
				if ( isset( $zipAiModules['ai_assistant'] ) ) {
					$globalData['ai_assistant'] = $zipAiModules['ai_assistant']['status'];
				}
				
				if ( isset( $zipAiModules['ai_design_copilot'] ) ) {
					$globalData['ai_design_copilot'] = $zipAiModules['ai_design_copilot']['status'];
				}
				
				// Merge the rest of the modules.
				$globalData = array_merge_recursive(
					$globalData,
					array_filter(
						$zipAiModules,
						function( $key ) {
							return ! in_array( $key, [ 'ai_assistant', 'ai_design_copilot' ] );
						},
						ARRAY_FILTER_USE_KEY
					)
				);
			}
			// Structured boolean values for analytics backend.
			$globalData['boolean_values'] = [
				'beta'                      => 'yes' === get_option( 'vxt_ultimate_gutenberg_blocks_beta' ),
				'enableLegacyBlocks'      => 'enabled' === get_option( 'uag_enable_legacy_blocks' ),
				'file_generation'           => 'enabled' === get_option( '_vxt_ultimate_gutenberg_blocks_allow_file_generation' ),
				'templates_button'          => 'yes' === get_option( 'uag_enable_templates_button' ),
				'on_page_css_button'        => 'yes' === get_option( 'uag_enable_on_page_css_button' ),
				'block_condition'           => 'enabled' === get_option( 'uag_enable_block_condition' ),
				'quick_action_sidebar'      => 'enabled' === get_option( 'uag_enable_quick_action_sidebar' ),
				'gbs_extension'             => 'enabled' === get_option( 'uag_enable_gbs_extension' ),
				'block_responsive'          => 'enabled' === get_option( 'uag_enable_block_responsive' ),
				'loadGfontsLocally'       => 'enabled' === get_option( 'uag_load_gfonts_locally' ),
				'collapsePanels'           => 'enabled' === get_option( 'uag_collapse_panels' ),
				'copyPaste'                => 'enabled' === get_option( 'uag_copy_paste' ),
				'preloadLocalFonts'       => 'enabled' === get_option( 'uag_preload_local_fonts' ),
				'btnInheritFromTheme'    => 'enabled' === get_option( 'uag_btn_inherit_from_theme' ),
				'loadFontAwesome5'       => 'enabled' === get_option( 'uag_load_font_awesome_5' ),
				'autoBlockRecovery'       => 'enabled' === get_option( 'uag_auto_block_recovery' ),
				'loadFseFontGlobally'    => 'enabled' === get_option( 'uag_load_fse_font_globally' ),
				'loadSelectFontGlobally' => 'enabled' === get_option( 'uag_load_select_font_globally' ),
				'visibilityMode'           => 'enabled' === get_option( 'uag_visibility_mode' ),
				'vexaltrix_pro_active'        => function_exists( 'is_plugin_active' ) && is_plugin_active( 'vexaltrix-pro/vexaltrix-pro.php' ),
			];

			// Return the global data.
			return $globalData;
		}

		/**
		 * Pass vexaltrix specific stats to BSF analytics.
		 *
		 * @since 2.19.5
		 * @param array $defaultStats Default stats array.
		 * @return array $defaultStats Default stats with vexaltrix specific stats array.
		 */
		public function vexaltrixGetSpecificStats( $defaultStats ) {
			$defaultStats['plugin_data']['vexaltrix'] = [
				'version'              => VXT_VER,
				'old_user_less_than_2' => get_option( 'vxt-old-user-less-than-2' ), // Retrieves current user is old user less than 2 or not.
				'migration_status'     => get_option( 'uag_migration_status' ), // Retrieves migration status.
			];
			$defaultStats['plugin_data']['vexaltrix'] = array_merge_recursive( $defaultStats['plugin_data']['vexaltrix'], $this->globalSettingsData() );
			$blockStatusData                       = $this->createBlockStatusArray();
			$defaultStats['plugin_data']['vexaltrix'] = array_merge_recursive( $defaultStats['plugin_data']['vexaltrix'], $blockStatusData );

			// Add advanced block usage statistics.
			if ( is_object( $this->blockAnalytics ) ) {
				$defaultStats['plugin_data']['vexaltrix'] = $this->blockAnalytics->getBlockStatsForAnalytics( $defaultStats['plugin_data']['vexaltrix'] );
			}

			// Compute site activity once — reused below for the numeric payload and user segment.
			$siteActivity = is_object( $this->blockAnalytics ) ? $this->blockAnalytics->getSiteActivityLevel() : [];

			// Add additional numeric values.
			$additionalNumerics = $this->getAdditionalNumericValues( $blockStatusData, $siteActivity );
			if ( ! isset( $defaultStats['plugin_data']['vexaltrix']['numeric_values'] ) || ! is_array( $defaultStats['plugin_data']['vexaltrix']['numeric_values'] ) ) {
				$defaultStats['plugin_data']['vexaltrix']['numeric_values'] = [];
			}
			$defaultStats['plugin_data']['vexaltrix']['numeric_values'] = array_merge(
				$defaultStats['plugin_data']['vexaltrix']['numeric_values'],
				$additionalNumerics
			);

			// Add KPI records for daily time-series data.
			$kpiData = $this->getKpiTrackingData();
			if ( ! empty( $kpiData ) ) {
				$defaultStats['plugin_data']['vexaltrix']['kpi_records'] = $kpiData;
			}

			// Add user segment classification (Free/Pro x Active/Dormant).
			$hasPro   = defined( 'WP_VXT_PRO_VER' ) && function_exists( 'is_plugin_active' ) && is_plugin_active( 'vexaltrix-pro/vexaltrix-pro.php' );
			$isActive = ! empty( $siteActivity['is_active_site'] );

			if ( $hasPro ) {
				$userSegment = $isActive ? 'pro_active' : 'pro_dormant';
			} else {
				$userSegment = $isActive ? 'free_active' : 'free_inactive';
			}
			$defaultStats['plugin_data']['vexaltrix']['user_segment'] = $userSegment;

			// Add onboarding analytics data.
			$onboardingData = \Vexaltrix\Admin\Onboarding::getOnboardingAnalyticsData();
			if ( ! empty( $onboardingData ) ) {
				$defaultStats['plugin_data']['vexaltrix'] = array_merge_recursive(
					$defaultStats['plugin_data']['vexaltrix'],
					$onboardingData
				);
			}

			// Add pending milestone events.
			$events = \Vexaltrix\Core\Analytics\AnalyticsEvents::flushPending();
			if ( ! empty( $events ) ) {
				$defaultStats['plugin_data']['vexaltrix']['events_record'] = $events;
			}

			return $defaultStats;
		}

		/**
		 * Get KPI tracking data from the daily accumulators.
		 *
		 * Returns the last 7 days of three per-day counters so the ingestion
		 * pipeline can compute Active / Super Active classifications on the
		 * dashboard side with rolling-window arithmetic:
		 *
		 * - `vexaltrix_posts_published_daily` — publish transitions on posts
		 *   containing Vexaltrix blocks. Powers Frequency + Volume axes.
		 * - `vexaltrix_distinct_block_types_daily` — distinct Vexaltrix block
		 *   types saved that day. Powers the Breadth axis.
		 * - `vexaltrix_advanced_features_used_daily` — invocations across
		 *   GBS, Popups, Forms, Dynamic Content. Powers the Depth axis.
		 *
		 * Reading each accumulator is a single `get_option()` call — no
		 * wp_query, no postmeta scans. Replaces the previous
		 * `posts_modified_with_vexaltrix` scalar which suffered from lossy
		 * overwrites, noise from every editor save, and expensive full scans.
		 *
		 * @since 2.19.22
		 * @return array Keyed by date, each containing numeric_values.
		 */
			private function getKpiTrackingData() {
				class_exists( 'Vexaltrix\\Core\\Analytics\\DailyKpiCounters' );

				$publish      = \Vexaltrix\Core\Analytics\DailyKpiCounters::getLastNDays( \Vexaltrix\Core\Analytics\DailyKpiCounters::OPT_PUBLISH );
			$blockTypes  = \Vexaltrix\Core\Analytics\DailyKpiCounters::getLastNDays( \Vexaltrix\Core\Analytics\DailyKpiCounters::OPT_BLOCK_TYPES );
			$advFeatures = \Vexaltrix\Core\Analytics\DailyKpiCounters::getLastNDays( \Vexaltrix\Core\Analytics\DailyKpiCounters::OPT_ADVANCED );

			// Union every date key any of the three counters saw in the window.
			$dates = array_unique(
				array_merge(
					array_keys( $publish ),
					array_keys( $blockTypes ),
					array_keys( $advFeatures )
				)
			);
			sort( $dates );

			$today    = wp_date( 'Y-m-d' );
			$kpiData = [];

			foreach ( $dates as $date ) {
				// Skip today's partial-day data — the dashboard only reasons about
				// complete days and today will be shipped on the next cycle.
				if ( $date === $today ) {
					continue;
				}

				$publishCount      = isset( $publish[ $date ] ) && is_numeric( $publish[ $date ] ) ? (int) $publish[ $date ] : 0;
				$distinctTypes     = isset( $blockTypes[ $date ] ) && is_array( $blockTypes[ $date ] ) ? count( array_unique( $blockTypes[ $date ] ) ) : 0;
				$advancedUseCount = isset( $advFeatures[ $date ] ) && is_numeric( $advFeatures[ $date ] ) ? (int) $advFeatures[ $date ] : 0;

				$kpiData[ $date ] = [
					'numeric_values' => [
						'vexaltrix_posts_published_daily' => $publishCount,
						'vexaltrix_distinct_block_types_daily' => $distinctTypes,
						'vexaltrix_advanced_features_used_daily' => $advancedUseCount,
					],
				];
			}

			return $kpiData;
		}

		/**
		 * Get additional numeric values for analytics payload.
		 *
		 * @since 2.19.22
		 * @param array $blockStatusData Block enable/disable status array.
		 * @param array $siteActivity     Result of get_site_activity_level() — passed in to avoid a duplicate computation per payload.
		 * @return array Numeric values.
		 */
		private function getAdditionalNumericValues( $blockStatusData, $siteActivity = [] ) {
			$blockStats = \Vexaltrix\Core\Analytics\BlockStatsProcessor::getBlockStats();

			$totalForms = isset( $blockStats['vexaltrix/forms'] ) ? (int) $blockStats['vexaltrix/forms'] : 0;

			$totalPopups = 0;
			if ( post_type_exists( 'vexaltrix-popup' ) ) {
				$popupCount  = wp_count_posts( 'vexaltrix-popup' );
				$totalPopups = is_object( $popupCount ) ? (int) $popupCount->publish + (int) $popupCount->draft : 0;
			}

			$disabledCount = is_array( $blockStatusData )
				? count(
					array_filter(
						$blockStatusData,
						function ( $v ) {
							return 'disabled' === $v;
						}
					)
				)
				: 0;

			$uniqueBlocks = is_array( $blockStats ) ? count( array_filter( $blockStats ) ) : 0;

			return [
				'total_published_forms'    => $totalForms,
				'total_popups'             => $totalPopups,
				'disabled_blocks_count'    => $disabledCount,
				'unique_blocks_in_use'     => $uniqueBlocks,
				'total_pages_with_vexaltrix' => isset( $siteActivity['active_pages_180d'] ) ? (int) $siteActivity['active_pages_180d'] : 0,
			];
		}
	}
}
