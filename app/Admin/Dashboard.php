<?php
/**
 * Uag Admin Menu.
 *
 * @package Uag
 */

namespace Vexaltrix\Admin;

use Vexaltrix\Admin\AdminHelper;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use ZipAI\Classes\Helper as Zip_Ai_Helper;
use ZipAI\Classes\Module as Zip_Ai_Module;


/**
 * Class \Vexaltrix\Admin\Dashboard.
 */
class Dashboard {

	public const ROOT_ID = 'vxt-dashboard-app';

	/**
	 * Instance
	 *
	 * @access private
	 * @var object Class object.
	 * @since 1.0.0
	 */
	private static $instance;

	/**
	 * Initiator
	 *
	 * @since 1.0.0
	 * @return object initialized object of class.
	 */
	public static function instance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

	/**
	 * Instance
	 *
	 * @access private
	 * @var string Class object.
	 * @since 1.0.0
	 */
	private $menuSlug = 'vexaltrix';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$this->initializeHooks();
	}

	/**
	 * Init Hooks.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function initializeHooks() {

		/* Setup the Admin Menu */
		add_action( 'admin_menu', [ $this, 'setupMenu' ] );
		add_action( 'admin_init', [ $this, 'settingsAdminScripts' ] );
		add_filter(
			'admin_footer_text', 
			function () {
				return ''; // Return an empty string to remove the text.
			}
		);

		/* Add the Action Links */
		add_filter( 'plugin_action_links_' . VXT_BASE, [ $this, 'addActionLinks' ] );

		/* Render admin content view */
		add_action( 'vxt_render_admin_page_content', [ $this, 'renderContent' ], 10, 2 );

		add_action( 'wp_ajax_vxt_ultimate_gutenberg_blocks_recommended_plugin_activate', [ $this, 'vxtUltimateGutenbergBlocksActivateAddon' ] );
		add_action( 'wp_ajax_vxt_ultimate_gutenberg_blocks_recommended_plugin_install', 'wp_ajax_install_plugin' );
		add_action( 'wp_ajax_vxt_ultimate_gutenberg_blocks_recommended_theme_install', 'wp_ajax_install_theme' );
	}

	/**
	 * List of plugins that we propose to install.
	 *
	 * @since 2.19.0
	 *
	 * @return array
	 */
	public static function getPlugins() {

		$plugins = [

			// 'astra'                           => [
			// 	'type'         => 'theme',
			// 	'name'         => esc_html__( 'Astra', 'vexaltrix' ),
			// 	'desc'         => esc_html__( 'Fast and customizable theme for your website.', 'vexaltrix' ),
			// 	'wporg'        => 'https://wordpress.org/themes/astra/',
			// 	'url'          => 'https://downloads.wordpress.org/theme/astra.zip',
			// 	'siteurl'      => 'https://wpastra.com/',
			// 	'slug'         => 'astra',
			// 	'isFree'       => true,
			// 	'status'       => self::getThemeStatus( 'astra' ),
			// 	'settings_url' => admin_url( 'admin.php?page=astra' ),
			// ],

		];

		return $plugins;
	}

	/**
	 * Activate addon.
	 *
	 * @since 2.19.0
	 * @return void
	 */
	public function vxtUltimateGutenbergBlocksActivateAddon() {

		// Run a security check.
		check_ajax_referer( 'updates', 'nonce' );

		if ( isset( $_POST['plugin'] ) ) {

			$type = '';
			if ( ! empty( $_POST['type'] ) ) {
				$type = sanitize_key( wp_unslash( $_POST['type'] ) );
			}

			$plugin = sanitize_text_field( wp_unslash( $_POST['plugin'] ) );

			if ( 'plugin' === $type ) {

				// Check for permissions.
				if ( ! current_user_can( 'activate_plugins' ) ) {
					wp_send_json_error( esc_html__( 'Plugin activation is disabled for you on this site.', 'vexaltrix' ) );
				}
				if ( isset( $_POST['slug'] ) ) {
					$slug = sanitize_key( wp_unslash( $_POST['slug'] ) );
					if ( class_exists( '\BSF_UTM_Analytics\Inc\Utils' ) && is_callable( '\BSF_UTM_Analytics\Inc\Utils::update_referer' ) ) {
						// If the plugin is found and the update_referer function is callable, update the referer with the corresponding product slug.
						\BSF_UTM_Analytics\Inc\Utils::update_referer( 'vexaltrix', $slug );
					}
				}

				$activate = activate_plugins( $plugin );

				if ( ! is_wp_error( $activate ) ) {

					do_action( 'vxt_ultimate_gutenberg_blocks_plugin_activated', $plugin );

					wp_send_json_success( esc_html__( 'Plugin Activated.', 'vexaltrix' ) );
				}
			}

			if ( 'theme' === $type ) {

				if ( isset( $_POST['slug'] ) ) {
					$slug = sanitize_key( wp_unslash( $_POST['slug'] ) );

					// Check for permissions.
					if ( ! ( current_user_can( 'switch_themes' ) ) ) {
						wp_send_json_error( esc_html__( 'Theme activation is disabled for you on this site.', 'vexaltrix' ) );
					}

					if ( class_exists( '\BSF_UTM_Analytics\Inc\Utils' ) && is_callable( '\BSF_UTM_Analytics\Inc\Utils::update_referer' ) ) {
						// If the theme is found and the update_referer function is callable, update the referer with the corresponding product slug.
						\BSF_UTM_Analytics\Inc\Utils::update_referer( 'vexaltrix', $slug );
					}

					$activate = switch_theme( $slug );

					if ( ! is_wp_error( $activate ) ) {

						do_action( 'vxt_ultimate_gutenberg_blocks_theme_activated', $plugin );

						wp_send_json_success( esc_html__( 'Theme Activated.', 'vexaltrix' ) );
					}
				}
			}
		}

		if ( isset( $type ) ) { 
			if ( 'plugin' === $type ) {
				wp_send_json_error( esc_html__( 'Could not activate plugin. Please activate from the Plugins page.', 'vexaltrix' ) );
			} elseif ( 'theme' === $type ) {
				wp_send_json_error( esc_html__( 'Could not activate theme. Please activate from the Themes page.', 'vexaltrix' ) );
			}
		}
	}

	/**
	 * Get the status of a plugin.
	 *
	 * @since 2.19.0
	 *
	 * @param  string $pluginInitFile Plugin init file.
	 * @return string
	 */
	public static function getPluginStatus( $pluginInitFile ) {

		$installedPlugins = get_plugins();

		if ( ! isset( $installedPlugins[ $pluginInitFile ] ) ) {
			return 'Install';
		} elseif ( is_plugin_active( $pluginInitFile ) ) {
			return 'Activated';
		} else {
			return 'Installed';
		}
	}

	/**
	 * Get the status of a theme.
	 *
	 * @param string $themeSlug The slug of the theme.
	 * @return string The theme status: 'Activated', 'Installed', or 'Install'.
	 *
	 * @since 2.19.0
	 */
	public static function getThemeStatus( $themeSlug ) {
		$installedThemes = wp_get_themes();

		// Check if the theme is installed.
		if ( isset( $installedThemes[ $themeSlug ] ) ) {
			$currentTheme = wp_get_theme();
			// Check if the current theme slug matches the provided theme slug.
			if ( $currentTheme->get_stylesheet() === $themeSlug ) {
				return 'Activated'; // Theme is active.
			} else {
				return 'Installed'; // Theme is installed but not active.
			}
		} else {
			return 'Install'; // Theme is not installed at all.
		}
	}
	
	/**
	 * Show action on plugin page.
	 *
	 * @param  array $links links.
	 * @return array
	 */
	public function addActionLinks( $links ) {

		$defaultUrl = admin_url( 'admin.php?page=' . $this->menuSlug );
		$rollback    = admin_url( 'admin.php?page=' . $this->menuSlug . '&path=settings&settings=version-control' );
		$vexaltrixPro = \Vexaltrix\Admin\AdminSettings::getProUrl( '/pricing/', 'free-plugin', 'plugin-list', 'plugin-list' );

		$freeLinks = [
			'<a href="' . $defaultUrl . '">' . __( 'Settings', 'vexaltrix' ) . '</a>',
			'<a href="' . $rollback . '">' . __( 'Rollback', 'vexaltrix' ) . '</a>',
		];

		// Check if Vexaltrix Pro plugin is not active.
		if ( ! is_plugin_active( 'vexaltrix-pro/vexaltrix-pro.php' ) && ! file_exists( VXT_DIR . '../vexaltrix-pro/vexaltrix-pro.php' ) ) {
			$freeLinks[] = '<a href="' . $vexaltrixPro . '" target="_blank" rel="noreferrer" class="vexaltrix-plugins-go-pro">' . __( 'Get Vexaltrix Pro', 'vexaltrix' ) . '</a>';
		}

		// Merge with $links array if it exists (assuming $links is defined elsewhere).
		if ( isset( $links ) && is_array( $links ) ) {
			return array_merge( $freeLinks, $links );
		}

		return $freeLinks;
	}

	/**
	 *  Initialize after Vexaltrix gets loaded.
	 */
	public function settingsAdminScripts() {

		// Enqueue admin scripts.
		if ( ! empty( $_GET['page'] ) && ( $this->menuSlug === $_GET['page'] || false !== strpos( sanitize_text_field( $_GET['page'] ), $this->menuSlug . '_' ) ) || ( array_key_exists( 'post_type', $_GET ) && 'vexaltrix-popup' === $_GET['post_type'] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended -- $_GET['page'] does not provide nonce.
			add_action( 'admin_enqueue_scripts', [ $this, 'stylesScripts' ] );
		}

	}

	/**
	 * Add submenu to admin menu.
	 *
	 * @since 1.0.0
	 */
	public function setupMenu() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$menuSlug  = $this->menuSlug;
		$capability = 'manage_options';

		$icon = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDcwIDcwIiBmaWxsPSJub25lIiBjbGFzcz0ic3BlY3RyYS1wYWdlLXNldHRpbmdzLWJ1dHRvbiIgYXJpYS1oaWRkZW49InRydWUiIGZvY3VzYWJsZT0iZmFsc2UiPiA8cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGNsaXAtcnVsZT0iZXZlbm9kZCIgZD0iTTM1IDcwQzU0LjMzIDcwIDcwIDU0LjMzIDcwIDM1QzcwIDE1LjY3IDU0LjMzIDAgMzUgMEMxNS42NyAwIDAgMTUuNjcgMCAzNUMwIDU0LjMzIDE1LjY3IDcwIDM1IDcwWk0yNC40NDcxIDIzLjUxMTJDMTguOTcyMiAyNi43NDAzIDIwLjI4NTIgMzUuMzc1OSAyNi41MDMyIDM3LjAzNTFMMzYuODg3NSAzOS44MDZDMzcuNzUzMyA0MC4wMzcgMzcuOTEgNDEuMjI0IDM3LjEzNSA0MS42ODExTDI3LjA5NzIgNDcuNTc5OUwyNi4wMzYgNThMNDUuNTUyOSA0Ni40ODg4QzUxLjAyNzggNDMuMjU5NyA0OS43MTQ4IDM0LjYyNDEgNDMuNDk2OCAzMi45NjQ5TDMzLjExMjUgMzAuMTk0MUMzMi4yNDY3IDI5Ljk2MyAzMi4wOSAyOC43NzYgMzIuODY1IDI4LjMxODlMNDIuOTAyOCAyMi40MjAyTDQzLjk2NCAxMkwyNC40NDcxIDIzLjUxMTJaIj48L3BhdGg+IDwvc3ZnPg==';

		// Add the Vexaltrix Menu.
		add_menu_page(
			__( 'Vexaltrix', 'vexaltrix' ),
			__( 'Vexaltrix', 'vexaltrix' ),
			$capability,
			$menuSlug,
			[ $this, 'render' ],
			$icon,
			30
		);

		// Add the Dashboard Submenu.
		add_submenu_page(
			$menuSlug,
			__( 'Vexaltrix', 'vexaltrix' ),
			__( 'Dashboard', 'vexaltrix' ),
			$capability,
			$menuSlug,
			[ $this, 'render' ]
		);

		// Add the Blocks / Extensions Submenu.
		add_submenu_page(
			$menuSlug,
			__( 'Vexaltrix', 'vexaltrix' ),
			__( 'Blocks', 'vexaltrix' ),
			$capability,
			$menuSlug . '&path=blocks',
			[ $this, 'render' ]
		);

		// Use this action hook to add sub menu to above menu.
		do_action( 'vxt_after_menu_register' );

		// Add the AI Features Submenu if Zip AI Library is loaded.
		if ( defined( 'ZIP_AI_VERSION' ) ) {
			add_submenu_page(
				$menuSlug,
				__( 'Vexaltrix', 'vexaltrix' ),
				__( 'AI Features', 'vexaltrix' ),
				$capability,
				$menuSlug . '&path=ai-features',
				[ $this, 'render' ]
			);
		}

		// Finally, add the Settings Submenu.
		add_submenu_page(
			$menuSlug,
			__( 'Vexaltrix', 'vexaltrix' ),
			__( 'Settings', 'vexaltrix' ),
			$capability,
			$menuSlug . '&path=settings',
			[ $this, 'render' ]
		);

		// Add the Learn tab in Submenu.
		add_submenu_page(
			$menuSlug,
			__( 'Vexaltrix', 'vexaltrix' ),
			__( 'Learn', 'vexaltrix' ),
			$capability,
			$menuSlug . '&path=learn',
			[ $this, 'render' ]
		);

		// Add the Free vs Pro Submenu.
		if ( ! file_exists( VXT_DIR . '../vexaltrix-pro/vexaltrix-pro.php' ) ) {
			add_submenu_page(
				$menuSlug,
				__( 'Free vs Pro', 'vexaltrix' ),
				__( 'Get Pro', 'vexaltrix' ),
				$capability,
				$menuSlug . '&path=free-vs-pro',
				[ $this, 'render' ]
			);
		}
	}

	/**
	 * Renders the admin settings.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function render() {

		$menuPageSlug = ( ! empty( $_GET['page'] ) ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : $this->menuSlug; //phpcs:ignore WordPress.Security.NonceVerification.Recommended -- $_GET['page'] does not provide nonce.
		$pageAction    = '';

		if ( isset( $_GET['action'] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended -- $_GET['page'] does not provide nonce.
			$pageAction = sanitize_text_field( wp_unslash( $_GET['action'] ) ); //phpcs:ignore WordPress.Security.NonceVerification.Recommended -- $_GET['page'] does not provide nonce.
			$pageAction = str_replace( '_', '-', $pageAction );
		}
		?>
			<div class="uag-menu-page-wrapper">
				<div id="uag-menu-page">
					<div class="uag-menu-page-content uag-clear">
						<?php do_action( 'vxt_render_admin_page_content', $menuPageSlug, $pageAction );?>
					</div>
				</div>
			</div>
		<?php
	}

	/**
	 * Render the Free vs Pro page.
	 *
	 * @since 2.19.0
	 * @return void
	 */
	public function renderFreeVsPro() {
		echo '<div style="background-color: green; color: white; padding: 20px;">';
		echo '<h1>' . esc_html__( 'Free vs Pro Features', 'vexaltrix' ) . '</h1>';
		echo '<p>' . esc_html__( 'Here you can compare the features of Free and Pro versions.', 'vexaltrix' ) . '</p>';
		// Add more content as needed.
		echo '</div>';
	}

	/**
	 * Renders the admin settings content.
	 *
	 * @since 1.0.0
	 * @param sting $menuPageSlug current page name.
	 * @param sting $pageAction current page action.
	 *
	 * @return void
	 */
	public function renderContent( $menuPageSlug, $pageAction ) {

		if ( $this->menuSlug === $menuPageSlug ) {

			printf( '<div id="%s" class="vexaltrix-dashboard-app"></div>', esc_attr( self::ROOT_ID ) );

		}
	}

	/**
	 * Enqueues the needed CSS/JS for the builder's admin settings page.
	 *
	 * @since 1.0.0
	 */
	public function stylesScripts() {

		$adminSlug  = 'vxt-admin';
		$blocksInfo = $this->getBlocksInfoForActivationDeactivation();
		wp_enqueue_style( $adminSlug . '-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap', [], VXT_VER );
		// Styles.
		wp_enqueue_style( $adminSlug . '-menu-style', VXT_URL . 'assets/admin/submenu.css', [], VXT_VER );
		wp_enqueue_style( 'wp-components' );

		$theme = wp_get_theme();

		$themeData          = \WP_Theme_JSON_Resolver::get_theme_data();
		$themeSettings      = $themeData->get_settings();
		$themeFontFamilies = isset( $themeSettings['typography']['fontFamilies']['theme'] ) && is_array( $themeSettings['typography']['fontFamilies']['theme'] ) ? $themeSettings['typography']['fontFamilies']['theme'] : [];
		if ( ! defined( 'VXT_URI' ) ) {
			define( 'VXT_URI', trailingslashit( 'https://wpvexaltrix.com/' ) );
		}
		$localize = apply_filters(
			'ugb_react_admin_localize',
			[
				'root_id'                    		=> esc_attr( self::ROOT_ID ),
				'current_user'                      => ! empty( wp_get_current_user()->user_firstname ) ? wp_get_current_user()->user_firstname : wp_get_current_user()->display_name,
				'admin_base_url'                    => admin_url(),
				'uag_base_url'                      => admin_url( 'admin.php?page=' . $this->menuSlug ),
				'plugin_dir'                        => VXT_URL,
				'plugin_ver'                        => VXT_VER,
				'admin_url'                         => admin_url( 'admin.php' ),
				'ajax_url'                          => admin_url( 'admin-ajax.php' ),
				'wp_pages_url'                      => admin_url( 'post-new.php?post_type=page' ),
				'home_slug'                         => $this->menuSlug,
				'rollback_url'                      => esc_url( add_query_arg( 'version', 'VERSION', wp_nonce_url( admin_url( 'admin-post.php?action=uag_rollback' ), 'uag_rollback' ) ) ),
				'blocks_info'                       => $blocksInfo,
				'reusable_url'                      => esc_url( admin_url( 'edit.php?post_type=wp_block' ) ),
				'global_data'                       => \Vexaltrix\Admin\DashboardHelper::getOptions(),
				'uag_content_width_set_by'          => \Vexaltrix\Admin\AdminSettings::get( 'uag_content_width_set_by', __('Vexaltrix', 'vexaltrix' ) ),
				'vexaltrix_pro_installed'             => file_exists( VXT_DIR . '../vexaltrix-pro/vexaltrix-pro.php' ),
				'vexaltrix_pro_licensing'             => file_exists( VXT_DIR . '../vexaltrix-pro/admin/license-handler.php' ),
				'vexaltrix_pro_status'                => is_plugin_active( 'vexaltrix-pro/vexaltrix-pro.php' ),
				'vexaltrix_pro_ver'                   => defined( 'WP_VXT_PRO_VER' ) ? WP_VXT_PRO_VER : null,
				'vexaltrix_custom_fonts'              => apply_filters( 'vexaltrix_system_fonts', [] ),
				'vexaltrix_admin_video'               => apply_filters( 'vexaltrix_display_admin_video', true ),
				'is_allow_registration'             => (bool) get_option( 'users_can_register' ),
				'theme_fonts'                       => $themeFontFamilies,
				'isBlockTheme'                    => \Vexaltrix\Admin\AdminSettings::isBlockTheme(),
				'vxt_ultimate_gutenberg_blocks_site_url'                     => VXT_URI,
				'vxt_links'                   => [
					'baseUrl'                => VXT_URI,
					'docsUrl'                => \Vexaltrix\Admin\AdminSettings::getProUrl( '/docs/', 'free-plugin', 'vxt-dashboard', 'documentation' ),
					'docsCategoryDynamicUrl' => \Vexaltrix\Admin\AdminSettings::getProUrl( '/docs-category/{{category}}', 'free-plugin', 'vxt-dashboard', 'documentation' ),
					'vipPrioritySupportUrl'  => \Vexaltrix\Admin\AdminSettings::getProUrl( '/vip-priority-support/', 'free-plugin', 'vxt-dashboard', 'vip-priority-support' ),
					'templatesUrl'           => \Vexaltrix\Admin\AdminSettings::getProUrl( '/pricing/', 'free-plugin', 'vxt-dashboard', 'starter-templates' ),
					'banner'                 => \Vexaltrix\Admin\AdminSettings::getProUrl( '/pricing/', 'free-plugin', 'vxt-dashboard', 'banner' ),
					'topBar'                 => '',//\Vexaltrix\Admin\AdminSettings::getProUrl( '/pricing/', 'free-plugin', 'vxt-dashboard', 'top-bar' ),
					'freeVsPro'              => \Vexaltrix\Admin\AdminSettings::getProUrl( '/pricing/', 'free-plugin', 'vxt-dashboard', 'free-vs-pro' ),
					'setting'                => \Vexaltrix\Admin\AdminSettings::getProUrl( '/pricing/', 'free-plugin', 'vxt-dashboard', 'setting' ),
					'uagDashboard'           => \Vexaltrix\Admin\AdminSettings::getProUrl( '/pricing/', 'free-plugin', 'vxt-dashboard', 'uag-dashboard' ),
					'whatsNewFeedUrl'        => null, // esc_url( VXT_URI . 'whats-new/feed/' )
					'upsellModalAdmin'       => \Vexaltrix\Admin\AdminSettings::getProUrl( '/pricing/', 'free-plugin', 'vxt-dashboard', 'upsell-popup-view-plan' ),
				],
				'plugin_installing_text'            => esc_html__( 'Installing', 'vexaltrix' ),
				'plugin_installed_text'             => esc_html__( 'Installed', 'vexaltrix' ),
				'plugin_activating_text'            => esc_html__( 'Activating', 'vexaltrix' ),
				'plugin_activated_text'             => esc_html__( 'Activated', 'vexaltrix' ),
				'plugin_activate_text'              => esc_html__( 'Activate', 'vexaltrix' ),
				'plugin_manager_nonce'              => wp_create_nonce( 'vexaltrix_plugin_manager_nonce' ),
				'installer_nonce'                   => wp_create_nonce( 'updates' ),
				'enable_beta_updates_nonce'         => wp_create_nonce( 'ugb_enable_beta_updates' ),
				'check_beta_update_available_nonce' => wp_create_nonce( 'ugb_check_beta_update_available' ),
				'force_check_plugin_updates_nonce'  => wp_create_nonce( 'ugb_force_check_plugin_updates' ),
				'update_beta_plugin_nonce'          => wp_create_nonce( 'ugb_update_beta_plugin' ),
				'pro_installed_status'              => 'inactive' === self::getPluginStatus( 'vexaltrix-pro/vexaltrix-pro.php' ) ? true : false,
				'pro_plugin_status'                 => self::getPluginStatus( 'vexaltrix-pro/vexaltrix-pro.php' ),
				'contry_code'                       => \Vexaltrix\Admin\AdminSettings::getUserCountryCode(),
				'onboarding_completed'              => \Vexaltrix\Admin\Onboarding::isOnboardingCompleted(),
			]
		);

		// If the Zip AI Assets is available, add the Zip AI localizations.
		if ( is_array( $localize )
			&& class_exists( '\ZipAI\Classes\Helper' )
			&& class_exists( '\ZipAI\Classes\Module' )
			&& defined( 'ZIP_AI_CREDIT_TOPUP_URL' )
			&& is_string( ZIP_AI_CREDIT_TOPUP_URL )
		) {

			$localize = array_merge(
				$localize,
				[
					'zip_ai_auth_middleware'  => Zip_Ai_Helper::get_auth_middleware_url(
						[
							'plugin' => 'vexaltrix',
							'source' => 'vexaltrix',
						] 
					),
					'zip_ai_auth_revoke_url'  => Zip_Ai_Helper::get_auth_revoke_url(),
					'zip_ai_credit_topup_url' => esc_url( add_query_arg( 'source', 'vexaltrix', ZIP_AI_CREDIT_TOPUP_URL ) ),
					'zip_ai_is_authorized'    => Zip_Ai_Helper::is_authorized(),
					'zip_ai_is_chat_enabled'  => Zip_Ai_Module::is_enabled( 'ai_assistant' ),
					'zip_ai_admin_nonce'      => wp_create_nonce( 'zip_ai_admin_nonce' ),
					'zip_ai_credit_details'   => Zip_Ai_Helper::get_credit_details(),
					'zip_ai_status'           => Zip_AI_Helper::get_setting( 'status' ),
				]
			);

			// In Zip AI version 1.1.2, the ZIPWP API constant was added - if this is available, get the current plan details.
			if ( defined( 'ZIP_AI_ZIPWP_API' ) ) {
				$responseZipwpPlan = Zip_Ai_Helper::get_current_plan_details();

				// If the response is not an error, then proceed to localize the required details.
				if ( is_array( $responseZipwpPlan ) && 'error' !== $responseZipwpPlan['status'] ) {
					// Create the base array to be localized.
					$currentZipwpPlan = [];

					// Add the team name if it exists.
					if ( ! empty( $responseZipwpPlan['team']['name'] ) ) {
						$currentZipwpPlan['team_name'] = $responseZipwpPlan['team']['name'];
					}

					// If the final array is not empty, localize it.
					if ( ! empty( $currentZipwpPlan ) ) {
						$localize['zip_ai_current_plan'] = $currentZipwpPlan;
					}
				}
			}
		}

		$this->settingsAppScripts( $localize );
	}


	/**
	 * Create an Array of Blocks info which we need to show in Admin dashboard.
	 */
	public function getBlocksInfoForActivationDeactivation() {

		$blocks = \Vexaltrix\Admin\AdminSettings::getBlockOptions();

		if ( ! is_array( $blocks ) ) {
			$blocks = [];
		}

		$blockPriorities = array_map(
			function( $element ) {
				if ( isset( $element['priority'] ) ) {
					return $element['priority'];
				}
			},
			$blocks
		);

		array_multisort( $blockPriorities, SORT_ASC, $blocks );

		$cf7Status = $this->getPluginStatus( 'contact-form-7/wp-contact-form-7.php' );
		$gfStatus  = $this->getPluginStatus( 'gravityforms/gravityforms.php' );

		if ( is_array( $blocks ) && ! empty( $blocks ) ) {

			$blocksNames = [];

			foreach ( $blocks as $addon => $info ) {

				$addon = str_replace( 'vexaltrix/', '', $addon );

				$excludeBlocks = [
					'column',
					'icon-list-child',
					'social-share-child',
					'buttons-child',
					'faq-child',
					'forms-name',
					'forms-email',
					'forms-hidden',
					'forms-phone',
					'forms-textarea',
					'forms-url',
					'forms-select',
					'forms-radio',
					'forms-checkbox',
					'forms-upload',
					'forms-toggle',
					'forms-date',
					'forms-accept',
					'post-title',
					'post-image',
					'post-button',
					'post-excerpt',
					'post-taxonomy',
					'post-meta',
					'restaurant-menu-child',
					'content-timeline-child',
					'tabs-child',
					'how-to-step',
					'slider-child',
					'slider-pro',
					'image-gallery-pro',
					'loop-wrapper',
					'loop-search',
					'loop-sort',
					'loop-reset',
					'loop-pagination',
					'loop-category',
					'modal-pro',
					'countdown-pro',
				];

				if ( ( 'cf7-styler' === $addon && 'active' !== $cf7Status ) || ( 'gf-styler' === $addon && 'active' !== $gfStatus ) ) {
					$excludeBlocks[] = $addon;
				}

				$enableLegacyBlocks = \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_legacy_blocks' );

				if ( 'yes' !== $enableLegacyBlocks ) {
					$excludeBlocks[] = 'wp-search';
					$excludeBlocks[] = 'columns';
					$excludeBlocks[] = 'section';
					$excludeBlocks[] = 'cf7-styler';
					$excludeBlocks[] = 'gf-styler';
					$excludeBlocks[] = 'post-masonry';
				}

				if ( array_key_exists( 'extension', $info ) && $info['extension'] ) {
					continue;
				}

				if ( in_array( $addon, $excludeBlocks, true ) ) {
					continue;
				}
				$info['slug']   = $addon;
				$blocksNames[] = $info;

			}

			return $blocksNames;
		}

		return [];

	}

	/**
	 * Settings app scripts
	 *
	 * @param array $localize Variable names.
	 */
	public function settingsAppScripts( $localize ) {
		// Check if we're on the popup builder page.
		$currentScreen = get_current_screen();
		if ( isset( $currentScreen ) && 'vexaltrix-popup' === $currentScreen->post_type ) {
			return; // Don't load dashboard scripts on popup builder page.
		}

		$handle            = 'uag-admin-settings';
		$buildPath        = VXT_DIR . 'assets/admin-ui/';
		$buildUrl         = VXT_URL . 'assets/admin-ui/';
		$scriptAssetPath = $buildPath . 'dashboard-app.asset.php';
		$scriptInfo       = file_exists( $scriptAssetPath )
			? include $scriptAssetPath
			: [
				'dependencies' => [],
				'version'      => VXT_VER,
			];

		$scriptDep = array_merge( $scriptInfo['dependencies'], [ 'updates' ] );

		wp_register_script(
			$handle,
			$buildUrl . 'dashboard-app.js',
			$scriptDep,
			$scriptInfo['version'],
			true
		);

		wp_register_style(
			$handle,
			$buildUrl . 'dashboard-app.css',
			[],
			VXT_VER
		);

		// Fix: Tailwind 3.4 dropped implicit border-style and cursor on DropdownMenu triggers.
		wp_add_inline_style(
			$handle,
			':is(.vxt-dashboard-app) [aria-haspopup="menu"] { cursor: pointer; }
			:is(.vxt-dashboard-app) .border-border-subtle[aria-haspopup="menu"] { border-width: 1px; border-style: solid; }'
		);

		wp_register_style(
			'vxt-admin-google-fonts',
			'https://fonts.googleapis.com/css2?family=Inter:wght@200&display=swap',
			[],
			VXT_VER
		);

		wp_enqueue_script( $handle );

		wp_set_script_translations( $handle, 'vexaltrix' );
		wp_enqueue_style( 'vxt-admin-google-fonts' );
		if ( isset( $_GET['page'] ) && $this->menuSlug === $_GET['page'] ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended -- $_GET['page'] does not provide nonce.
			wp_enqueue_style( $handle );
		}
		wp_style_add_data( $handle, 'rtl', 'replace' );
		wp_localize_script( $handle, 'vexaltrixAdmin', $localize );

		$currentUser = wp_get_current_user();

		$userData = [
			'isLoggedIn'  => is_user_logged_in(),
			'username'    => $currentUser->user_login,
			'firstName'   => $currentUser->first_name,
			'lastName'    => $currentUser->last_name,
			'email'       => $currentUser->user_email,
			'displayName' => $currentUser->display_name,
		];

		wp_localize_script( $handle, 'vxt_ultimate_gutenberg_blocks_user_data', $userData );

		$pluginsData      = self::getPlugins();
		$jsonPluginsData = wp_json_encode( $pluginsData );

		wp_localize_script( $handle, 'vxt_ultimate_gutenberg_blocks_plugins_data', $pluginsData );
	}

}
