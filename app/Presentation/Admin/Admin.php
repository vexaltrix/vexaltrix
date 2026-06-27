<?php
/**
 * Vexaltrix Admin.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Presentation\Admin;

use Vexaltrix\Core\Contracts\ServiceInterface;

use VexaltrixAdminNotices;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if ( ! class_exists( 'Vexaltrix\Presentation\Admin\\Admin' ) ) {

	/**
	 * Class \Vexaltrix\Presentation\Admin\Admin.
	 */
	final class Admin implements ServiceInterface {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 */
		public function __construct() {
			if ( ! is_admin() ) {
				return;
			}

			global $wpCustomize;
			/**
			 * Conditionally load the scripts in the customizer.
			 * If the customizer is not set, it means we are not in the customizer.
			 * In that case load the script that will reload the page after migration is complete.
			 */
			if ( empty( $wpCustomize ) ) {
				add_action( 'admin_enqueue_scripts', [ $this, 'reloadOnMigrationComplete' ] );
			}
			add_action( 'wp_ajax_uag_migrate', [ $this, 'handleMigrationActionAjax' ] );

			add_action( 'admin_notices', [ $this, 'registerNotices' ] );
			add_filter( 'wp_kses_allowed_html', [ $this, 'addDataAttributes' ], 10, 2 );
			add_action( 'admin_enqueue_scripts', [ $this, 'noticeStylesScripts' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'noticeStylesScriptsUpgradePro' ] );
			add_filter( 'rank_math/researches/toc_plugins', [ $this, 'tocPlugin' ] );
			add_action( 'admin_init', [ $this, 'activationRedirect' ] );
			add_action( 'admin_init', [ $this, 'updateOldUserOptionByUrlParams' ] );
			add_action( 'admin_post_uag_rollback', [ $this, 'postVxtUltimateGutenbergBlocksRollback' ] );
			// Update get access url in Template Kits.
			add_filter( 'ast_block_templates_pro_url', [ $this, 'updateGutenbergTemplatesProUrl' ] );
			add_action( 'admin_post_uag_download_log', [ $this, 'handleLogDownload' ] );

		}

		/**
		 * Handle migration action AJAX.
		 * 
		 * @since 2.13.9
		 * @return void
		 */
		public function handleMigrationActionAjax() {
			check_ajax_referer( 'vexaltrix-migration', 'security' );

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_send_json_error( [ 'message' => 'Permission Denied' ] );
			}

			// Trigger the migration.
			\Vexaltrix\Infrastructure\Migration\MigrateBlocks::getInstance()->blocksMigration();

			// Update the migration status to 'no' before starting.
			update_option( 'uag_migration_status', 'yes' );

			// Set a new option to know that the migration process has started.
			update_option( 'uag_migration_progress_status', 'in-progress' );

			// Prepare the response.
			$response = [
				'success' => true,
				'data'    => [
					'message' => esc_html__( 'Migration started successfully.', 'vexaltrix' ),
				],
			];

			// Send JSON response.
			wp_send_json_success( $response );
		}

		/**
		 * Callback function to display migration log page content.
		 *
		 * @since 2.13.9
		 * @return void
		 */
		public function handleLogDownload() {
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'You do not have permission to access this page.', 'vexaltrix' ) );
			}

			$logFile = ABSPATH . 'wp-content/uploads/migration-log.txt';

			if ( file_exists( $logFile ) ) {
				header( 'Content-Description: File Transfer' );
				header( 'Content-Type: application/octet-stream' );
				header( 'Content-Disposition: attachment; filename="' . basename( $logFile ) . '"' );
				header( 'Expires: 0' );
				header( 'Cache-Control: must-revalidate' );
				header( 'Pragma: public' );
				header( 'Content-Length: ' . filesize( $logFile ) );
				flush(); // Flush system output buffer.
				readfile( $logFile );
				exit;
			} else {
				wp_die( esc_html__( 'Log file not found.', 'vexaltrix' ) );
			}
		}
		
		/**
		 * Updates the Gutenberg templates pro URL.
		 * This function returns the URL for the pro version of Gutenberg templates.
		 * 
		 * @since 2.13.7
		 * @return string The URL for Vexaltrix Webpage.
		 */
		public function updateGutenbergTemplatesProUrl() { 
			return \Vexaltrix\Presentation\Admin\AdminSettings::getProUrl( '/pricing/', 'gutenberg-templates', 'dashboard', 'Starter-Template-Backend' );
		}
 

		/**
		 * Update Old user option using URL Param.
		 *
		 * If any user wants to set the site as old user then just add the URL param as true.
		 *
		 * @since 2.0.1
		 * @access public
		 */
		public function updateOldUserOptionByUrlParams() {

			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$vexaltrixOldUser = isset( $_GET['vexaltrix_old_user'] ) ? sanitize_text_field( $_GET['vexaltrix_old_user'] ) : false; //phpcs:ignore WordPress.Security.NonceVerification.Recommended -- $_GET['vexaltrix_old_user'] does not provide nonce.

			if ( 'yes' === $vexaltrixOldUser ) {
				update_option( 'vxt-old-user-less-than-2', 'yes' );
			} elseif ( 'no' === $vexaltrixOldUser ) {
				delete_option( 'vxt-old-user-less-than-2' );
			}
		}

		/**
		 * UAG version rollback.
		 *
		 * Rollback to previous UAG version.
		 *
		 * Fired by `admin_post_uag_rollback` action.
		 *
		 * @since 1.23.0
		 * @access public
		 */
		public function postVxtUltimateGutenbergBlocksRollback() {

			if ( ! current_user_can( 'install_plugins' ) ) {
				wp_die(
					esc_html__( 'You do not have permission to access this page.', 'vexaltrix' ),
					esc_html__( 'Rollback to Previous Version', 'vexaltrix' ),
					[
						'response' => 200,
					]
				);
			}

			check_admin_referer( 'uag_rollback' );

			$rollbackVersions = \Vexaltrix\Presentation\Admin\AdminSettings::getInstance()->getRollbackVersions();
			$updateVersion    = isset( $_GET['version'] ) ? sanitize_text_field( $_GET['version'] ) : '';

			if ( empty( $updateVersion ) || ! in_array( $updateVersion, $rollbackVersions, true ) ) {
				wp_die( esc_html__( 'Error occurred, The version selected is invalid. Try selecting different version.', 'vexaltrix' ) );
			}

			$pluginSlug = basename( VXT_FILE, '.php' );

			$rollback = new \Vexaltrix\Presentation\Admin\Rollback(
				[
					'version'     => $updateVersion,
					'plugin_name' => VXT_BASE,
					'plugin_slug' => $pluginSlug,
					'package_url' => sprintf( 'https://downloads.wordpress.org/plugin/%s.%s.zip', $pluginSlug, $updateVersion ),
				]
			);

			$rollback->run();

			wp_die(
				'',
				esc_html__( 'Rollback to Previous Version', 'vexaltrix' ),
				[
					'response' => 200,
				]
			);
		}
		/**
		 * Activation Reset
		 */
		public function activationRedirect() {

			$doRedirect = apply_filters( 'vxt_ultimate_gutenberg_blocks_enable_redirect_activation', get_option( '__vxt_ultimate_gutenberg_blocks_do_redirect' ) );

			if ( $doRedirect ) {

				update_option( '__vxt_ultimate_gutenberg_blocks_do_redirect', false );

				if ( ! is_multisite() ) {
					// Redirect to onboarding wizard if not completed yet,
					// otherwise to the Vexaltrix dashboard.
					if ( ! \Vexaltrix\Presentation\Admin\Onboarding::isOnboardingCompleted() ) {
						wp_safe_redirect( admin_url( 'admin.php?page=vxt-onboarding' ) );
						exit;
					}

					wp_safe_redirect(
						add_query_arg(
							[
								'page' => VXT_SLUG,
								'vexaltrix-activation-redirect' => true,
							],
							admin_url( 'admin.php' )
						)
					);
					exit;
				}
			}
		}

		/**
		 * Filters and Returns a list of allowed tags and attributes for a given context.
		 *
		 * @param Array  $allowedposttags Array of allowed tags.
		 * @param String $context Context type (explicit).
		 * @since 1.8.0
		 * @return Array
		 */
		public function addDataAttributes( $allowedposttags, $context ) {
			$allowedposttags['a']['data-repeat-notice-after'] = true;

			return $allowedposttags;
		}

		/**
		 * Ask Plugin Rating
		 *
		 * @since 1.8.0
		 */
		public function registerNotices() {
			// Check if assets should be excluded for the current post type.
			if ( \Vexaltrix\Presentation\Admin\AdminSettings::shouldExcludeAssetsForCpt() ) {
				return; // Early return to prevent loading assets.
			}
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$imagePath = VXT_URL . 'assets/images/logos/vexaltrix.svg';

			if ( ! get_option( 'uag_migration_status', false ) && 'yes' === get_option( 'vxt-old-user-less-than-2' ) && 'in-progress' !== get_option( 'uag_migration_progress_status', '' ) ) {

				\VexaltrixAdminNotices::add_notice(
					[

						'id'                         => 'vxt-block-migration_status',
						'type'                       => '',
						'message'                    => sprintf(
							// Translators: %1$s: Vexaltrix logo, %2$s: migration note , %3$s: The closing tag, %4$s: migration description, %5$s: migration button placeholder, %6$s: Learn more button, %7$s: learn more placeholder.
							'<div class="notice-image">
                            <img src="%1$s" class="custom-logo" alt="Vexaltrix" itemprop="logo"></div>
                            <div class="notice-content">
                            <h4 style="margin: 0.5em 0" class="notice-heading">
                            %2$s
                            </h4>
						    %3$s<br /><br />
						     <strong>%4$s</strong>
                                <div style="margin-bottom: 0.5em" class="astra-review-notice-container">
                                    <a style="margin-right: 0.5em" id="trigger_migration" class="vxt-review-notice button-primary">
                                    %5$s
                                    </a>
									<a href="%6$s" class="vxt-review-notice button-primary">
                                    %7$s
                                    </a>
                                </div>
                                </div><br />',
							$imagePath,
							__( 'Vexaltrix database update required', 'vexaltrix' ),
							__( "We've detected that some of your pages were created with an older version of Vexaltrix. To ensure your designs remain unaffected, we recommend updating the Vexaltrix database now. Updating the Vexaltrix database will not impact any other parts of your website.", 'vexaltrix' ),
							__( 'To be on the safer side, please be sure to back up your site before updating.', 'vexaltrix' ),
							__( 'Update Vexaltrix Database', 'vexaltrix' ),
							esc_url( 'https://wpvexaltrix.com/docs/vexaltrix-database-update-instructions/' ),
							__( 'Learn More About This', 'vexaltrix' )
						),
						'priority'                   => 20,
						'display-with-other-notices' => true,
					]
				);
			} elseif ( 'yes' !== get_option( 'uag_migration_complete', 0 ) && 'yes' === get_option( 'vxt-old-user-less-than-2' ) ) {
				\VexaltrixAdminNotices::add_notice(
					[
						'id'                         => 'uag_migration_in_progress',
						'type'                       => 'info',
						'message'                    => sprintf(
							// Translators: %1$s: Vexaltrix logo, %2$s: in-progress note.
							'<div class="notice-image">
                                <img src="%1$s" class="custom-logo" alt="Vexaltrix" itemprop="logo"></div>
                                <div class="notice-content">
                                    <h4 style="margin: 0.5em 0" class="notice-heading">
                                        %2$s
                                    </h4>
                                    <div style="margin-bottom: 0.5em" class="astra-review-notice-container">
                                        <span class="spinner is-active"></span>
                                        %3$s
                                    </div>
                                </div><br />',
							$imagePath,
							__( 'Vexaltrix database update in progress', 'vexaltrix' ),
							__( 'Great! This should only take a few minutes. Thanks for hanging in there.', 'vexaltrix' )
						),
						'dismissible'                => false,
						'priority'                   => 20,
						'display-with-other-notices' => true,
					]
				);
			} elseif ( 'yes' === get_option( 'uag_migration_complete', 0 ) ) {
				\VexaltrixAdminNotices::add_notice(
					[
						'id'                         => 'uag_migration_success',
						'type'                       => 'success',
						'message'                    => sprintf(
							// Translators: %1$s: Vexaltrix logo, %2$s: success message, %3$s: additional note.
							'<div class="notice-image">
							<img src="%1$s" class="custom-logo" alt="Vexaltrix" itemprop="logo"></div>
							<div class="notice-content">
								<h4 style="margin: 0.5em 0" class="notice-heading">
									%2$s
								</h4>
								<div style="margin-bottom: 0.5em" class="astra-review-notice-container">
									%3$s
								</div>
							</div><br />',
							$imagePath,
							__( 'Update Successful!', 'vexaltrix' ),
							__( 'Your Vexaltrix database is now up-to-date. Your website will continue to function as before.', 'vexaltrix' ) . ' <a href="' . esc_url( admin_url( 'admin-post.php?action=uag_download_log' ) ) . '">' . __( 'View Log', 'vexaltrix' ) . '</a>'
						),
						'dismissible'                => true,
						'priority'                   => 20,
						'display-with-other-notices' => true,
					]
				);
			}
			

			if ( class_exists( 'Classic_Editor' ) ) {
				$editorOption = get_option( 'classic-editor-replace' );
				if ( 'block' !== $editorOption ) {
					\VexaltrixAdminNotices::add_notice(
						[
							'id'                         => 'vxt-classic-editor',
							'type'                       => 'warning',
							'message'                    => sprintf(
								/* translators: %s: html tags */
								__( 'Vexaltrix requires&nbsp;%3$sBlock Editor%4$s. You can change your editor settings to Block Editor from&nbsp;%1$shere%2$s. Plugin is currently NOT RUNNING.', 'vexaltrix' ),
								'<a href="' . admin_url( 'options-writing.php' ) . '">',
								'</a>',
								'<strong>',
								'</strong>'
							),
							'priority'                   => 20,
							'display-with-other-notices' => true,
						]
					);
				}
			}
			$imagePath = VXT_URL . 'admin-ui/assets/images/uag-logo.svg';

			$installedPlugins = get_plugins();

			$status = isset( $installedPlugins['vexaltrix-pro/vexaltrix-pro.php'] ) 
					? ( is_plugin_active( 'vexaltrix-pro/vexaltrix-pro.php' ) 
						? 'active' 
						: 'inactive' ) 
					: 'not-installed';

			if ( 'not-installed' === $status && isset( $_GET['post_type'] ) && 'vexaltrix-popup' === $_GET['post_type'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- $_GET['post_type'] does not provide nonce.
				\VexaltrixAdminNotices::add_notice(
					[
						'id'                         => 'vxt-pro-popup-note',
						'type'                       => '',
						'message'                    => sprintf(
							'<div class="notice-image">
								<img src="%1$s" class="custom-logo" style="max-width: 40px;" alt="Vexaltrix" itemprop="logo"></div>
								<div class="notice-content">
									<div class="notice-heading">
										<strong>
											%2$s
										</strong>
									</div>
									%3$s<br />
									<div class="astra-review-notice-container">
										<a href="%4$s" class="not-astra-notice-close vxt-review-notice button-primary" target="_blank">
										%5$s
										</a>
									
									</div>
								</div>',
							$imagePath,
							__( 'Want to do more with Popup Builder?', 'vexaltrix' ),
							__( 'Maximize your popup potential with Vexaltrix Pro. Unlock enhanced features, intuitive design options, and increased conversions!', 'vexaltrix' ),
							esc_url( \Vexaltrix\Presentation\Admin\AdminSettings::getProUrl( '/pricing/', 'free-plugin', 'popup-builder', 'popup-builder-banner' ) ),
							__( 'Upgrade Now', 'vexaltrix' )
						),
						'dismissible'                => true,
						'priority'                   => 20,
						'display-with-other-notices' => true,
						'class'                      => 'vexaltrix-upsell',
					]
				);
			}
		}

		/**
		 * Enqueue the needed CSS/JS for the builder's admin settings page.
		 *
		 * @since 1.8.0
		 */
		public function noticeStylesScripts() {
			$screen = get_current_screen();
	
			if ( $screen && 'admin_page_migration-log' === $screen->base ) {
				wp_enqueue_style( 'uag-admin-css', VXT_URL . 'assets/admin/admin-notice.css', [], VXT_VER );
		
				// Add inline CSS to hide elements with the 'notice' class.
				$customCss = '.notice { display: none !important; }';
				wp_add_inline_style( 'uag-admin-css', $customCss );
			}
		}

		/**
		 * Enqueue the needed CSS/JS for the plugin / popup page.
		 *
		 * @since 2.16.0
		 * @return void
		 */
		public function noticeStylesScriptsUpgradePro() {
			$screen = get_current_screen();

			if ( $screen && ( 'plugins' === $screen->base || 'vexaltrix-popup' === $screen->post_type ) ) {
				wp_enqueue_style( 'uag-admin-noticl-upgrade-pro-css', VXT_URL . 'assets/admin/admin-notice-upgrade-pro.css', [], VXT_VER );
			}
			// Redirect to Pro pricing page when click on Get Vexaltrix Pro button.
			if ( $screen && 'toplevel_page_vexaltrix' === $screen->base ) {
				?>
					<script type="text/javascript">
						document.addEventListener('DOMContentLoaded', function() {
							let upgradeLink = document.querySelector('a[href$="&path=upgrade-now"]');
							if (upgradeLink) {
								upgradeLink.setAttribute('target', '_blank');
								upgradeLink.setAttribute('rel', 'noreferrer');
								upgradeLink.addEventListener('click', function(e) {
									e.preventDefault();
									window.open( '<?php echo esc_url( \Vexaltrix\Presentation\Admin\AdminSettings::getProUrl( '/pricing/', 'free-plugin', 'dashboard', 'setting' ) ); ?>', '_blank', 'noopener,noreferrer' );
								});
							}
						});
					</script>
				<?php
			}
		}

		/**
		 * Enqueue script to reload the page on migration complete.
		 * 
		 * @since 2.13.9
		 * @return void
		 */
		public function reloadOnMigrationComplete() {
			?>
			<script type="text/javascript">
				document.addEventListener('DOMContentLoaded', function() {
					var triggerButton = document.getElementById('trigger_migration');

					if (triggerButton) {
						triggerButton.addEventListener('click', function(e) {
							e.preventDefault();

							fetch('<?php echo esc_html( admin_url( 'admin-ajax.php' ) ); ?>', {
								method: 'POST',
								headers: {
									'Content-Type': 'application/x-www-form-urlencoded',
								},
								body: 'action=uag_migrate&security=' + encodeURIComponent('<?php echo esc_html( wp_create_nonce( 'vexaltrix-migration' ) ); ?>'),
							})
							.then(function(response) {
								return response.json();
							})
							.then(function(data) {
								if (data.success) {
									location.reload();
									// Optionally, reload the page or perform additional actions.
								} else {
									return;
								}
							})
							.catch(function(error) {
								console.error('Error occurred during migration:', error);
							});
						});
					}
				});
			</script>
			<?php
		}


		/**
		 * Rank Math SEO filter to add kb-elementor to the TOC list.
		 *
		 * @param array $plugins TOC plugins.
		 */
		public function tocPlugin( $plugins ) {
			$plugins['vexaltrix/vexaltrix.php'] = 'Vexaltrix';
			return $plugins;
		}
	
	/**
	 * Service group.
	 *
	 * @return string
	 */
	public static function group(): string {
		return 'presentation';
	}

	/**
	 * Service context.
	 *
	 * @return string
	 */
	public static function context(): string {
		return 'admin';
	}

	/**
	 * Boot priority.
	 *
	 * @return int
	 */
	public static function priority(): int {
		return 10;
	}

	/**
	 * Register actions and filters.
	 *
	 * @return void
	 */
	public function boot(): void {
		// Auto-generated boot method.
	}

}
}
