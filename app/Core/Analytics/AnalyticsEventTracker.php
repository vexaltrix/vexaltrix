<?php
/**
 * Vexaltrix Analytics Event Tracker.
 *
 * Registers hooks and detects state-based milestone events
 * for the BSF Analytics event tracking system.
 *
 * @since 2.19.22
 * @package Vexaltrix
 */

namespace Vexaltrix\Core\Analytics;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vexaltrix\\Core\\Analytics\\AnalyticsEventTracker' ) ) {

	/**
	 * Class \Vexaltrix\Core\Analytics\AnalyticsEventTracker
	 *
	 * @since 2.19.22
	 */
	class AnalyticsEventTracker {

		/**
		 * Instance.
		 *
		 * @var \Vexaltrix\Core\Analytics\AnalyticsEventTracker|null
		 */
		private static $instance = null;

		/**
		 * Get instance.
		 *
		 * @since 2.19.22
		 * @return \Vexaltrix\Core\Analytics\AnalyticsEventTracker
		 */
		public static function getInstance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Canonical Vexaltrix plugin basename — used as fallback when the VXT_BASE
		 * constant isn't defined (e.g., `deactivated_plugin` / `upgrader_process_complete`
		 * can fire from contexts where the main plugin file hasn't executed).
		 *
		 * @var string
		 * @since 2.19.25
		 */
		const PLUGIN_BASENAME_FALLBACK = 'vexaltrix/vexaltrix.php';

		/**
		 * Previous plugin version captured before update.
		 *
		 * @var string
		 * @since 2.19.23
		 */
		private $preUpdateVersion = '';

		/**
		 * Allow-list of setting keys worth tracking for `settings_changed` events.
		 *
		 * Only the KEY is ever sent — never the value. Keys chosen for product-usage
		 * insight; excludes migration state, reCAPTCHA secrets, OAuth-linked accounts,
		 * and anything that could leak PII.
		 *
		 * @var string[]
		 * @since 2.19.25
		 */
		private static $trackedSettings = [
			'uag_enable_gbs_extension',
			'uag_enable_dynamic_content',
			'uag_enable_block_condition',
			'uag_enable_block_responsive',
			'uag_enable_animations_extension',
			'uag_enable_masonry_gallery',
			'uag_enable_legacy_blocks',
			'uag_enable_on_page_css_button',
			'uag_enable_coming_soon_mode',
			'uag_enable_templates_button',
			'uag_enable_quick_action_sidebar',
			'uag_enable_header_titlebar',
			'uag_auto_block_recovery',
			'uag_copy_paste',
			'uag_dynamic_content_mode',
			'uag_visibility_mode',
			'uag_load_fse_font_globally',
			'uag_load_gfonts_locally',
			'uag_preload_local_fonts',
			'uag_btn_inherit_from_theme',
			'uag_container_global_padding',
			'uag_container_global_elements_gap',
			'uag_content_width',
			'uag_content_width_set_by',
			'uag_blocks_editor_spacing',
		];

		/**
		 * Constructor.
		 *
		 * @since 2.19.22
		 */
		private function __construct() {
			class_exists( 'Vexaltrix\\Core\\Analytics\\AnalyticsEvents' );

			add_action( 'admin_init', [ $this, 'trackPluginActivated' ] );
			add_action( 'admin_init', [ $this, 'detectStateEvents' ] );
			add_action( 'update_option_vexaltrix_usage_optin', [ $this, 'trackAnalyticsOptin' ], 10, 2 );
			add_action( 'save_post', [ $this, 'trackFirstVexaltrixBlockUsed' ], 20, 2 );
			add_action( 'wp_ajax_ast_block_templates_importer', [ $this, 'trackFirstTemplateImported' ], 5 );
			add_action( 'wp_ajax_ast_block_templates_import_template_kit', [ $this, 'trackFirstTemplateImported' ], 5 );
			add_action( 'wp_ajax_ast_block_templates_import_block', [ $this, 'trackFirstPatternImported' ], 5 );
			add_action( 'wp_ajax_vxt_ultimate_gutenberg_blocks_track_design_library_opened', [ $this, 'trackDesignLibraryOpened' ] );
			add_action( 'enqueue_block_editor_assets', [ $this, 'enqueueDesignLibraryOpenListener' ], 20 );
			add_action( 'vxt_ultimate_gutenberg_blocks_update_before', [ $this, 'capturePreUpdateVersion' ] );
			add_action( 'vxt_ultimate_gutenberg_blocks_update_after', [ $this, 'trackPluginUpdated' ] );
			add_action( 'upgrader_process_complete', [ $this, 'captureUpdateMethod' ], 10, 2 );

			// Deactivation signal — helps quantify churn.
			add_action( 'deactivated_plugin', [ $this, 'trackPluginDeactivated' ], 10, 1 );

			// Immediate Pro-activation signal — bypasses the 24h state-event throttle.
			add_action( 'activated_plugin', [ $this, 'onPluginActivatedHook' ], 10, 1 );

			// Settings-changed tracking — register per-key hooks from the allow-list.
			foreach ( self::$trackedSettings as $settingKey ) {
				add_action( 'update_option_' . $settingKey, [ $this, 'trackSettingChanged' ], 10, 3 );
			}

			// Track cumulative learn chapter progress.
			add_action( 'vexaltrix_learn_progress_saved', [ $this, 'trackLearnChapterProgress' ] );

			/*
			 * `one_onboarding_state_saved_vxt` has two listeners whose ordering matters:
			 *   priority 1  → capture_onboarding_start_time (stamps start on first save)
			 *   priority 10 → track_onboarding_skipped      (may consume/clear the stamp on exit)
			 * The stamp MUST exist before the skip handler reads it, so priority 1 runs first.
			 */
			add_action( 'one_onboarding_state_saved_vxt', [ $this, 'captureOnboardingStartTime' ], 1, 1 );

			// Track onboarding exits (users who save state without completing).
			add_action( 'one_onboarding_state_saved_vxt', [ $this, 'trackOnboardingSkipped' ], 10, 2 );

			// Hook-based onboarding completion — captures rich properties at the moment
			// of completion (current screen, starter templates builder, pro features,
			// selected addons). The polling fallback in detect_onboarding_completed()
			// handles users who completed before this code was deployed.
			add_action( 'one_onboarding_completion_vxt', [ $this, 'trackOnboardingCompleted' ], 10, 2 );
		}

		/**
		 * Track plugin activation event.
		 *
		 * @since 2.19.22
		 * @return void
		 */
		public function trackPluginActivated() {
			$referrers = get_option( 'bsf_product_referers', [] );
			$source    = 'self';
			if ( is_array( $referrers ) && ! empty( $referrers['vexaltrix'] ) && is_string( $referrers['vexaltrix'] ) ) {
				$source = sanitize_text_field( $referrers['vexaltrix'] );
			}

			$properties = [
				'source'             => $source,
				'days_since_install' => (string) self::getDaysSinceInstall(),
				'site_language'      => get_locale(),
				'wp_version'         => get_bloginfo( 'version' ),
				'php_version'        => self::getPhpVersionShort(),
				'active_theme'       => sanitize_text_field( (string) get_template() ),
				'is_multisite'       => is_multisite() ? 'yes' : 'no',
			];

			\Vexaltrix\Core\Analytics\AnalyticsEvents::track( 'plugin_activated', VXT_VER, $properties );
		}

		/**
		 * Short PHP version (major.minor) — avoids cardinality explosion from patch versions.
		 *
		 * @since 2.19.25
		 * @return string
		 */
		private static function getPhpVersionShort() {
			if ( defined( 'PHP_MAJOR_VERSION' ) && defined( 'PHP_MINOR_VERSION' ) ) {
				return PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION;
			}
			return (string) phpversion();
		}

		/**
		 * Days since the plugin was first installed.
		 *
		 * Uses the `vexaltrix_usage_installed_time` option. Returns 0 if unset.
		 *
		 * @since 2.19.23
		 * @return int
		 */
		private static function getDaysSinceInstall() {
			$installTime = get_site_option( 'vexaltrix_usage_installed_time', 0 );
			if ( ! $installTime || ! is_numeric( $installTime ) ) {
				return 0;
			}
			return (int) floor( ( time() - (int) $installTime ) / DAY_IN_SECONDS );
		}

		/**
		 * Track analytics opt-in/opt-out event.
		 *
		 * @since 2.19.22
		 * @param string $oldValue Old value.
		 * @param string $newValue New value.
		 * @return void
		 */
		public function trackAnalyticsOptin( $oldValue, $newValue ) {
			if ( 'yes' === $newValue ) {
				\Vexaltrix\Core\Analytics\AnalyticsEvents::track( 'analytics_optin', 'yes' );
			}
		}

		/**
		 * Track first time a Vexaltrix block is used in a post.
		 *
		 * @since 2.19.22
		 * @param int      $postId Post ID.
		 * @param \WP_Post $post    Post object.
		 * @return void
		 */
		public function trackFirstVexaltrixBlockUsed( $postId, $post ) {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			if ( wp_is_post_revision( $postId ) || wp_is_post_autosave( $postId ) ) {
				return;
			}

			if ( empty( $post->post_content ) ) {
				return;
			}

			// Check for any Vexaltrix block (vexaltrix/ or vexaltrix/ namespace).
			if ( ! preg_match( '/<!-- wp:(uagb|vexaltrix)\/(\S+)/', $post->post_content, $matches ) ) {
				return;
			}

			$postType      = (string) get_post_type( $postId );
			$editorContext = self::resolveEditorContext( $postType );
			$blockSlug     = $matches[1] . '/' . $matches[2];

			$properties = [
				'post_type'          => $postType,
				'editor_context'     => $editorContext,
				'days_since_install' => (string) self::getDaysSinceInstall(),
			];

			if ( ! \Vexaltrix\Core\Analytics\AnalyticsEvents::isTracked( 'first_vexaltrix_block_used' ) ) {
				\Vexaltrix\Core\Analytics\AnalyticsEvents::track( 'first_vexaltrix_block_used', $blockSlug, $properties );
			}

			// Separate FSE milestone — fires the first time a Vexaltrix block is used inside a site-editor template/part.
			if ( in_array( $editorContext, [ 'fse', 'fse_part' ], true )
				&& ! \Vexaltrix\Core\Analytics\AnalyticsEvents::isTracked( 'first_fse_block_used' ) ) {
				\Vexaltrix\Core\Analytics\AnalyticsEvents::track( 'first_fse_block_used', $blockSlug, $properties );
			}
		}

		/**
		 * Resolve editor_context from a post_type.
		 *
		 * @since 2.19.25
		 * @param string $postType WordPress post type slug.
		 * @return string One of: fse, fse_part, widget, reusable, post_editor.
		 */
		private static function resolveEditorContext( $postType ) {
			switch ( $postType ) {
				case 'wp_template':
					return 'fse';
				case 'wp_template_part':
					return 'fse_part';
				case 'wp_block':
					return 'reusable';
				case 'wp_navigation':
					return 'navigation';
				default:
					return 'post_editor';
			}
		}

		/**
		 * Capture the plugin version before an update overwrites it.
		 *
		 * @since 2.19.23
		 * @return void
		 */
		public function capturePreUpdateVersion() {
			$version                  = get_option( 'vxt-version', '' );
			$this->preUpdateVersion = is_string( $version ) ? $version : '';
		}

		/**
		 * Track plugin version update event.
		 *
		 * Fires on `vxt_ultimate_gutenberg_blocks_update_after` which only runs when a real version change occurs.
		 * Uses flush_pushed so the event re-fires on each update.
		 *
		 * @since 2.19.23
		 * @return void
		 */
		public function trackPluginUpdated() {
			$properties = [
				'from_version'  => $this->preUpdateVersion,
				'update_method' => self::resolveUpdateMethod(),
			];

			\Vexaltrix\Core\Analytics\AnalyticsEvents::retrackEvent( 'plugin_updated', VXT_VER, $properties );

			// Captured hint was consumed — clean up.
			delete_site_option( 'vxt_ultimate_gutenberg_blocks_last_update_method' );
		}

		/**
		 * Capture the update method from `upgrader_process_complete`.
		 *
		 * Fires inside the core upgrader at the moment the update runs — at this point
		 * we can accurately tell whether it's an auto-update (wp-cron), a WP-CLI run,
		 * or a manual update via admin UI. The hint is stashed as a site option so
		 * `track_plugin_updated()` (which may run on a later request) can read it.
		 *
		 * @since 2.19.25
		 * @param \WP_Upgrader $upgrader   WordPress upgrader instance (unused).
		 * @param array        $hookExtra Context from WP core.
		 * @return void
		 */
		public function captureUpdateMethod( $upgrader, $hookExtra ) { // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
			$type   = isset( $hookExtra['type'] ) ? (string) $hookExtra['type'] : '';
			$action = isset( $hookExtra['action'] ) ? (string) $hookExtra['action'] : '';

			if ( 'plugin' !== $type || 'update' !== $action ) {
				return;
			}

			$plugins = [];
			if ( ! empty( $hookExtra['plugins'] ) && is_array( $hookExtra['plugins'] ) ) {
				$plugins = $hookExtra['plugins'];
			} elseif ( ! empty( $hookExtra['plugin'] ) && is_string( $hookExtra['plugin'] ) ) {
				$plugins = [ $hookExtra['plugin'] ];
			}

			$target = defined( 'VXT_BASE' ) ? VXT_BASE : self::PLUGIN_BASENAME_FALLBACK;
			if ( ! in_array( $target, $plugins, true ) ) {
				return;
			}

			$method = self::detectUpdateMethodRuntime();
			// Persisted until `track_plugin_updated()` consumes and deletes it — site options have no TTL.
			update_site_option( 'vxt_ultimate_gutenberg_blocks_last_update_method', $method );
		}

		/**
		 * Resolve the update method from captured hint + runtime context.
		 *
		 * Prefers the captured hint (set during upgrader_process_complete) when
		 * available; falls back to runtime detection when the hook didn't fire
		 * (e.g., direct plugin-zip replacement).
		 *
		 * @since 2.19.25
		 * @return string One of: auto, cli, manual.
		 */
		private static function resolveUpdateMethod() {
			$hint = get_site_option( 'vxt_ultimate_gutenberg_blocks_last_update_method', '' );
			if ( is_string( $hint ) && '' !== $hint ) {
				return $hint;
			}
			return self::detectUpdateMethodRuntime();
		}

		/**
		 * Runtime detection of update method from execution context.
		 *
		 * @since 2.19.25
		 * @return string One of: auto, cli, manual.
		 */
		private static function detectUpdateMethodRuntime() {
			if ( wp_doing_cron() ) {
				return 'auto';
			}
			if ( defined( 'WP_CLI' ) && WP_CLI ) {
				return 'cli';
			}
			return 'manual';
		}

		/**
		 * Track plugin deactivation via `deactivated_plugin` action.
		 *
		 * Uses retrack so every deactivation overwrites the pending entry —
		 * only the latest deactivation timestamp is meaningful. Flushes on the
		 * next analytics cycle; if the plugin is permanently deleted before
		 * that cycle, the event is lost (acceptable — the vast majority of
		 * deactivations are temporary troubleshooting).
		 *
		 * @since 2.19.25
		 * @param string $plugin Basename of the deactivated plugin.
		 * @return void
		 */
		public function trackPluginDeactivated( $plugin ) {
			$target = defined( 'VXT_BASE' ) ? VXT_BASE : self::PLUGIN_BASENAME_FALLBACK;
			if ( $plugin !== $target ) {
				return;
			}

			$properties = [
				'days_since_install' => (string) self::getDaysSinceInstall(),
				'wp_version'         => get_bloginfo( 'version' ),
				'php_version'        => self::getPhpVersionShort(),
			];

			\Vexaltrix\Core\Analytics\AnalyticsEvents::retrackEvent( 'plugin_deactivated', VXT_VER, $properties );
		}

		/**
		 * Track a setting change for one of the allow-listed keys.
		 *
		 * Only the key name is sent — never the old or new value. Values can hold
		 * PII (domain names, custom CSS, API keys) and are out of scope for this
		 * event. Uses retrack_event so the latest-changed key overwrites any prior
		 * pending entry in the current analytics cycle.
		 *
		 * @since 2.19.25
		 * @param mixed  $oldValue  Previous value (unused — never sent).
		 * @param mixed  $newValue  New value (unused — never sent).
		 * @param string $option     The option key — present because WP passes it on `update_option_{$option}`.
		 * @return void
		 */
		public function trackSettingChanged( $oldValue, $newValue, $option ) { // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
			if ( ! is_string( $option ) || '' === $option ) {
				return;
			}
			if ( ! in_array( $option, self::$trackedSettings, true ) ) {
				return;
			}

			\Vexaltrix\Core\Analytics\AnalyticsEvents::retrackEvent(
				'settings_changed',
				sanitize_key( $option ),
				[
					'setting_key' => sanitize_key( $option ),
				]
			);
		}

		/**
		 * Bypass the 24h state-event throttle for Vexaltrix Pro activation.
		 *
		 * Fires the moment the Pro add-on is activated — avoids the up-to-24h
		 * delay that comes with the polled `detect_state_events()` path.
		 *
		 * @since 2.19.25
		 * @param string $plugin Basename of the activated plugin.
		 * @return void
		 */
		public function onPluginActivatedHook( $plugin ) {
			if ( 'vexaltrix-pro/vexaltrix-pro.php' !== $plugin ) {
				return;
			}
			$this->detectVexaltrixProActivated();
		}

		/**
		 * Detect state-based events on admin load.
		 *
		 * Throttled to run once per 24 hours via transient.
		 *
		 * @since 2.19.22
		 * @return void
		 */
		public function detectStateEvents() {
			if ( false !== get_transient( 'vxt_ultimate_gutenberg_blocks_state_events_checked' ) ) {
				return;
			}

			$this->detectVexaltrixProActivated();
			$this->detectAiAssistantFirstUse();
			$this->detectGbsFirstCreated();
			$this->detectOnboardingCompleted();
			$this->detectFirstFormCreated();
			$this->detectFirstPopupCreated();

			set_transient( 'vxt_ultimate_gutenberg_blocks_state_events_checked', 1, DAY_IN_SECONDS );
		}

		/**
		 * Detect if Vexaltrix Pro is active.
		 *
		 * @since 2.19.22
		 * @return void
		 */
		private function detectVexaltrixProActivated() {
			if ( \Vexaltrix\Core\Analytics\AnalyticsEvents::isTracked( 'vexaltrix_pro_activated' ) ) {
				return;
			}

			if ( ! function_exists( 'is_plugin_active' ) ) {
				require_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			if ( is_plugin_active( 'vexaltrix-pro/vexaltrix-pro.php' ) ) {
				$proVersion = defined( 'WP_VXT_PRO_VER' ) ? WP_VXT_PRO_VER : '';
				\Vexaltrix\Core\Analytics\AnalyticsEvents::track( 'vexaltrix_pro_activated', $proVersion );
			}
		}

		/**
		 * Detect first use of AI assistant.
		 *
		 * @since 2.19.22
		 * @return void
		 */
		private function detectAiAssistantFirstUse() {
			if ( \Vexaltrix\Core\Analytics\AnalyticsEvents::isTracked( 'ai_assistant_first_use' ) ) {
				return;
			}

			if ( ! class_exists( '\ZipAI\Classes\Helper' ) || ! method_exists( '\ZipAI\Classes\Helper', 'is_authorized' ) ) {
				return;
			}

			if ( \ZipAI\Classes\Helper::is_authorized() ) {
				\Vexaltrix\Core\Analytics\AnalyticsEvents::track(
					'ai_assistant_first_use',
					'',
					[ 'module' => 'ai_assistant' ]
				);
			}
		}

		/**
		 * Detect if Global Block Styles have been created.
		 *
		 * @since 2.19.22
		 * @return void
		 */
		private function detectGbsFirstCreated() {
			if ( \Vexaltrix\Core\Analytics\AnalyticsEvents::isTracked( 'gbs_first_created' ) ) {
				return;
			}

			$gbsEnabled = \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_gbs_extension', 'enabled' );

			if ( 'enabled' !== $gbsEnabled ) {
				return;
			}

			// Primary source of truth — `vexaltrix_global_block_styles` is the option
			// that actually stores GBS definitions (see class-vxt-init-blocks.php:1612).
			$gbsStored = get_option( 'vexaltrix_global_block_styles', [] );
			if ( ! empty( $gbsStored ) && is_array( $gbsStored ) ) {
				\Vexaltrix\Core\Analytics\AnalyticsEvents::track( 'gbs_first_created' );
				return;
			}

			// Fallback — the Google-Fonts-by-GBS-id map is populated when a GBS-styled
			// block is rendered on the frontend. Covers the case where the main option
			// is empty but GBS usage has already been recorded via rendering.
			$gbsFonts = get_option( 'vexaltrix_gbs_google_fonts', [] );
			if ( ! empty( $gbsFonts ) && is_array( $gbsFonts ) ) {
				\Vexaltrix\Core\Analytics\AnalyticsEvents::track( 'gbs_first_created' );
			}
		}

		/**
		 * Detect if onboarding has been completed.
		 *
		 * @since 2.19.22
		 * @return void
		 */
		private function detectOnboardingCompleted() {
			if ( \Vexaltrix\Core\Analytics\AnalyticsEvents::isTracked( 'onboarding_completed' ) ) {
				return;
			}

			if ( ! \Vexaltrix\Admin\Onboarding::isOnboardingCompleted() ) {
				return;
			}

			$analytics  = get_option( 'vexaltrix_onboarding_analytics', [] );
			$analytics  = is_array( $analytics ) ? $analytics : [];
			$properties = [];

			if ( ! empty( $analytics['skippedSteps'] ) && is_array( $analytics['skippedSteps'] ) ) {
				$properties['skipped_steps'] = implode( ',', array_map( 'sanitize_text_field', $analytics['skippedSteps'] ) );
			}

			$properties['exited_early'] = ! empty( $analytics['exitedEarly'] ) ? 'yes' : 'no';
			$properties['consent']      = ! empty( $analytics['consent'] ) ? 'yes' : 'no';

			// User completed onboarding — clear any prior `onboarding_skipped` event so the funnel reflects the final outcome.
			\Vexaltrix\Core\Analytics\AnalyticsEvents::clearEvent( 'onboarding_skipped' );

			\Vexaltrix\Core\Analytics\AnalyticsEvents::track( 'onboarding_completed', '', $properties );
		}

		/**
		 * Track first template import via AJAX hook.
		 *
		 * @since 2.19.22
		 * @return void
		 */
		public function trackFirstTemplateImported() {
			\Vexaltrix\Core\Analytics\AnalyticsEvents::track( 'first_template_imported' );
		}

		/**
		 * Track first pattern (block) import via AJAX hook.
		 *
		 * Hooked at priority 5 on `wp_ajax_ast_block_templates_import_block` so
		 * it runs before the main GT importer at priority 10. Dedup is handled
		 * by `\Vexaltrix\Core\Analytics\AnalyticsEvents::track()`, so repeat fires are no-ops.
		 *
		 * @since 2.19.25
		 * @return void
		 */
		public function trackFirstPatternImported() {
			\Vexaltrix\Core\Analytics\AnalyticsEvents::track( 'first_pattern_imported' );
		}

		/**
		 * Track first Design Library open via JS-side AJAX ping.
		 *
		 * The GT React app renders a toolbar button with id `#ast-block-templates-button`
		 * that toggles the library modal. Clicks (manual or auto-open) on that button
		 * fire a one-shot AJAX request to this handler. Dedup at the event layer means
		 * any repeat fires after the first are no-ops.
		 *
		 * @since 2.19.25
		 * @return void
		 */
		public function trackDesignLibraryOpened() {
			if ( ! check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_ajax_nonce', 'nonce', false ) ) {
				wp_send_json_error( 'invalid_nonce', 403 );
			}

			if ( ! current_user_can( 'edit_posts' ) ) {
				wp_send_json_error( 'forbidden', 403 );
			}

			\Vexaltrix\Core\Analytics\AnalyticsEvents::track( 'first_design_library_opened' );
			wp_send_json_success();
		}

		/**
		 * Enqueue a tiny inline listener that pings the tracker on first
		 * Design Library open per page load.
		 *
		 * Skipped once the event is already tracked — no need to ship the
		 * listener at all, the dedup is enforced server-side too.
		 *
		 * @since 2.19.25
		 * @return void
		 */
		public function enqueueDesignLibraryOpenListener() {
			if ( ! wp_script_is( 'vxt-block-editor-js', 'enqueued' ) ) {
				return;
			}

			if ( \Vexaltrix\Core\Analytics\AnalyticsEvents::isTracked( 'first_design_library_opened' ) ) {
				return;
			}

			$inline = "(function(){var fired=false;document.addEventListener('click',function(e){if(fired)return;if(!e.target||!e.target.closest)return;var btn=e.target.closest('#ast-block-templates-button');if(!btn)return;if(typeof vxt_ultimate_gutenberg_blocks_blocks_info==='undefined'||!vxt_ultimate_gutenberg_blocks_blocks_info.vxt_ultimate_gutenberg_blocks_ajax_nonce)return;fired=true;var url=(typeof ajaxurl!=='undefined')?ajaxurl:'/wp-admin/admin-ajax.php';var data=new FormData();data.append('action','vxt_ultimate_gutenberg_blocks_track_design_library_opened');data.append('nonce',vxt_ultimate_gutenberg_blocks_blocks_info.vxt_ultimate_gutenberg_blocks_ajax_nonce);if(window.fetch){fetch(url,{method:'POST',credentials:'same-origin',body:data}).catch(function(){});}},true);}());";

			wp_add_inline_script( 'vxt-block-editor-js', $inline );
		}

		/**
		 * Detect if a Vexaltrix form block has been created.
		 *
		 * @since 2.19.22
		 * @return void
		 */
		private function detectFirstFormCreated() {
			if ( \Vexaltrix\Core\Analytics\AnalyticsEvents::isTracked( 'first_form_created' ) ) {
				return;
			}

			$blockStats = \Vexaltrix\Core\Analytics\BlockStatsProcessor::getBlockStats();

			if ( ! empty( $blockStats['vexaltrix/forms'] ) && $blockStats['vexaltrix/forms'] > 0 ) {
				\Vexaltrix\Core\Analytics\AnalyticsEvents::track( 'first_form_created' );
			}
		}

		/**
		 * Detect if a Vexaltrix popup has been created.
		 *
		 * @since 2.19.22
		 * @return void
		 */
		private function detectFirstPopupCreated() {
			if ( \Vexaltrix\Core\Analytics\AnalyticsEvents::isTracked( 'first_popup_created' ) ) {
				return;
			}

			if ( ! post_type_exists( 'vexaltrix-popup' ) ) {
				return;
			}

			$popupCount = wp_count_posts( 'vexaltrix-popup' );

			if ( is_object( $popupCount ) && ( $popupCount->publish > 0 || $popupCount->draft > 0 ) ) {
				\Vexaltrix\Core\Analytics\AnalyticsEvents::track( 'first_popup_created' );
			}
		}

		/**
		 * Track onboarding completion from the `one_onboarding_completion_vxt` hook.
		 *
		 * Provides rich properties from the completion payload — completion_screen,
		 * starter_templates_builder, pro_features, selected_addons. These fields are
		 * only available in the hook payload, not in the fallback polling path.
		 *
		 * Mutual exclusion: clears `onboarding_skipped` (if a prior session had a
		 * skip tracked, completion wins).
		 *
		 * @since 2.19.23
		 * @param array                 $completionData Completion payload from the REST endpoint.
		 * @param \WP_REST_Request|null $request         The REST request (unused).
		 * @return void
		 */
		public function trackOnboardingCompleted( $completionData, $request = null ) { // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
			if ( ! is_array( $completionData ) ) {
				return;
			}

			// Completion wins — clear any prior skip entry from pushed and pending queues.
			\Vexaltrix\Core\Analytics\AnalyticsEvents::clearEvent( 'onboarding_skipped' );

			// If an earlier admin_init poll already tracked onboarding_completed with
			// minimal properties, retrack so the rich payload replaces it.
			$properties = self::buildOnboardingCompletionProperties( $completionData );

			\Vexaltrix\Core\Analytics\AnalyticsEvents::retrackEvent( 'onboarding_completed', VXT_VER, $properties );
		}

		/**
		 * Capture the onboarding start time on the first state save.
		 *
		 * The start stamp is a site-option so it survives across user sessions
		 * and the wizard's SPA-style screen transitions. Only written once —
		 * subsequent saves leave it alone.
		 *
		 * @since 2.19.25
		 * @param array $stateData State payload (unused — only the fact-of-save matters).
		 * @return void
		 */
		public function captureOnboardingStartTime( $stateData = [] ) { // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
			$start = absint( get_site_option( 'vexaltrix_onboarding_start_time', 0 ) );
			if ( $start > 0 ) {
				return;
			}
			update_site_option( 'vexaltrix_onboarding_start_time', time() );
		}

		/**
		 * Build the property bag for onboarding_completed from completion data.
		 *
		 * Pure function — safe to call from both the hook handler and tests.
		 *
		 * @since 2.19.23
		 * @param array $completionData Payload from one_onboarding_completion_vxt.
		 * @return array Property map for the analytics event.
		 */
		private static function buildOnboardingCompletionProperties( $completionData ) {
			$screens           = isset( $completionData['screens'] ) && is_array( $completionData['screens'] ) ? $completionData['screens'] : [];
			$skippedSteps     = [];
			$screensCompleted = 0;
			foreach ( $screens as $screen ) {
				if ( ! is_array( $screen ) ) {
					continue;
				}
				$screenId = isset( $screen['id'] ) && is_string( $screen['id'] ) ? $screen['id'] : '';
				if ( ! empty( $screen['skipped'] ) ) {
					if ( '' !== $screenId ) {
						$skippedSteps[] = sanitize_text_field( $screenId );
					}
				} else {
					++$screensCompleted;
				}
			}

			$completionScreen = isset( $completionData['completion_screen'] ) && is_string( $completionData['completion_screen'] )
				? sanitize_text_field( $completionData['completion_screen'] )
				: '';

			$properties = [
				'completion_screen' => $completionScreen,
				'screens_completed' => $screensCompleted,
				'screens_total'     => count( $screens ),
			];

			if ( ! empty( $skippedSteps ) ) {
				$properties['skipped_steps'] = implode( ',', $skippedSteps );
			}

			// Starter Templates builder — only relevant if user reached that screen.
			$stBuilder = isset( $completionData['starter_templates_builder'] ) && is_string( $completionData['starter_templates_builder'] )
				? sanitize_text_field( $completionData['starter_templates_builder'] )
				: '';
			if ( '' !== $stBuilder ) {
				$properties['st_builder'] = $stBuilder;
			}

			// Pro features selected during onboarding.
			if ( ! empty( $completionData['pro_features'] ) && is_array( $completionData['pro_features'] ) ) {
				$properties['pro_features'] = implode( ',', array_map( 'sanitize_text_field', $completionData['pro_features'] ) );
			}

			// Addons selected during onboarding.
			if ( ! empty( $completionData['selected_addons'] ) && is_array( $completionData['selected_addons'] ) ) {
				$properties['selected_addons'] = implode( ',', array_map( 'sanitize_text_field', $completionData['selected_addons'] ) );
			}

			// Wall-clock duration from first state save to completion.
			$start = absint( get_site_option( 'vexaltrix_onboarding_start_time', 0 ) );
			if ( $start > 0 ) {
				$duration = time() - $start;
				if ( $duration >= 0 && $duration <= ( 365 * DAY_IN_SECONDS ) ) {
					$properties['duration_seconds'] = (string) $duration;
				}
				// One-shot — clear the stamp so reopening the wizard after completion doesn't skew future values.
				delete_site_option( 'vexaltrix_onboarding_start_time' );
			}

			return $properties;
		}

		/**
		 * Track onboarding exits via the `one_onboarding_state_saved_vxt` hook.
		 *
		 * Fires whenever state is saved without completion — captures users who
		 * abandon the onboarding funnel. Retracks so only the latest exit point
		 * survives (not the first time state was saved). Early-returns if
		 * `onboarding_completed` was tracked in this session.
		 *
		 * @since 2.19.23
		 * @param array                 $stateData Onboarding state from the REST endpoint.
		 * @param \WP_REST_Request|null $request    The REST request (unused).
		 * @return void
		 */
		public function trackOnboardingSkipped( $stateData, $request = null ) { // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
			if ( ! is_array( $stateData ) ) {
				return;
			}

			// Only track actual exits — the hook fires on every screen transition;
			// exited_early is only true when the user explicitly closed/dismissed onboarding.
			if ( empty( $stateData['exited_early'] ) ) {
				return;
			}

			// Bail if onboarding was completed in this session — completion wins.
			if ( \Vexaltrix\Core\Analytics\AnalyticsEvents::isTracked( 'onboarding_completed' ) ) {
				return;
			}

			$screens           = isset( $stateData['screens'] ) && is_array( $stateData['screens'] ) ? $stateData['screens'] : [];
			$screensCompleted = 0;
			foreach ( $screens as $screen ) {
				if ( is_array( $screen ) && empty( $screen['skipped'] ) ) {
					++$screensCompleted;
				}
			}

			$exitScreen = '';
			if ( isset( $stateData['exit_screen'] ) && is_string( $stateData['exit_screen'] ) ) {
				$exitScreen = sanitize_text_field( $stateData['exit_screen'] );
			} elseif ( isset( $stateData['current_screen'] ) && is_string( $stateData['current_screen'] ) ) {
				$exitScreen = sanitize_text_field( $stateData['current_screen'] );
			}

			$properties = [
				'exit_screen'       => $exitScreen,
				'screens_completed' => $screensCompleted,
				'screens_total'     => count( $screens ),
			];

			// Retrack so the funnel reflects the user's latest exit point, not their first.
			\Vexaltrix\Core\Analytics\AnalyticsEvents::retrackEvent( 'onboarding_skipped', VXT_VER, $properties );

			// Clear the start-time stamp so a future re-entry starts fresh — otherwise
			// a user who exits, returns days later, and completes would produce a
			// misleadingly large duration_seconds.
			delete_site_option( 'vexaltrix_onboarding_start_time' );
		}

		/**
		 * Track cumulative learn chapter progress.
		 *
		 * Fires on `vexaltrix_learn_progress_saved`. Compares the saved progress
		 * against the chapter structure and retracks with a cumulative snapshot
		 * so the server always has the latest state (not just the first save).
		 *
		 * @since 2.19.23
		 * @param array $savedProgress Progress data from user meta: chapter_id => step_id => bool.
		 * @return void
		 */
		public function trackLearnChapterProgress( $savedProgress ) {
			if ( empty( $savedProgress ) || ! class_exists( 'Vexaltrix\\Admin\\AdminLearn' ) ) {
				return;
			}

			$chapters = \Vexaltrix\Admin\AdminLearn::getChaptersStructure();
			if ( empty( $chapters ) ) {
				return;
			}

			$properties   = [];
			$allComplete = true;

			foreach ( $chapters as $chapter ) {
				$chapterId = isset( $chapter['id'] ) ? $chapter['id'] : '';
				if ( empty( $chapterId ) || ! isset( $chapter['steps'] ) || ! is_array( $chapter['steps'] ) || empty( $chapter['steps'] ) ) {
					continue;
				}

				$totalSteps     = count( $chapter['steps'] );
				$completedSteps = 0;
				foreach ( $chapter['steps'] as $step ) {
					$stepId = isset( $step['id'] ) ? $step['id'] : '';
					if ( $stepId && ! empty( $savedProgress[ $chapterId ][ $stepId ] ) ) {
						++$completedSteps;
					}
				}

				$properties[ $chapterId ] = $completedSteps . '/' . $totalSteps;

				if ( $completedSteps < $totalSteps ) {
					$allComplete = false;
				}
			}

			if ( empty( $properties ) ) {
				return;
			}

			$eventValue = $allComplete ? 'completed' : 'in_progress';

			\Vexaltrix\Core\Analytics\AnalyticsEvents::retrackEvent( 'learn_chapter_progress', $eventValue, $properties );
		}

	}
}
