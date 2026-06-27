<?php
/**
 * Update Compatibility
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Infrastructure;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Infrastructure\Update' ) ) :

	/**
	 * Vexaltrix Update initial setup
	 *
	 * @since 1.13.4
	 */
	class Update implements ServiceInterface {

		/**
		 * Class instance.
		 *
		 * @access private
		 * @var $instance Class instance.
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

		/**
		 *  Constructor
		 */
		

		/**
		 * Init
		 *
		 * @since 1.13.4
		 * @return void
		 */
		public function init() {
			// Get auto saved version number.
			$savedVersion = get_option( 'vxt-version', false );

			// Update auto saved version number.
			if ( ! $savedVersion || ! is_string( $savedVersion ) ) {

				// Fresh install updation.
				$this->freshInstallUpdateAssetGenerationOption();

				// Update current version.
				update_option( 'vxt-version', VXT_VER );
				return;
			}

			do_action( 'vxt_ultimate_gutenberg_blocks_update_before' );

			// If equals then return.
			if ( version_compare( $savedVersion, VXT_VER, '=' ) ) {
				return;
			}

			// If user is older than 2.0.0 then set the option.
			if ( version_compare( $savedVersion, '2.0.0', '<' ) ) {
				update_option( 'vxt-old-user-less-than-2', 'yes' );
			}

			// Enable Legacy Blocks for users older than 2.0.5.
			if ( version_compare( $savedVersion, '2.0.5', '<' ) ) {
				\Vexaltrix\Presentation\Admin\AdminSettings::updateAdminSettingsOption( 'vxt_enable_legacy_blocks', 'yes' );
			}

			// If user is older than equal to 2.12.1 then set the option.
			if ( version_compare( $savedVersion, '2.12.1', '<=' ) ) {
				\Vexaltrix\Presentation\Admin\AdminSettings::updateAdminSettingsOption( 'vxt_enable_quick_action_sidebar', 'disabled' );
			}

			// Delete any of the unused options that have been unsupported or no longer required.

			// Delete the header titlebar option if it exists- which has been removed from version 2.14.1.
			if ( \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_enable_header_titlebar' ) ) {
				\Vexaltrix\Presentation\Admin\AdminSettings::deleteAdminSettingsOption( 'vxt_enable_header_titlebar' );
			}

			// Create a Core Block Array for all versions in which a Core Vexaltrix Block was added.
			$coreBlocks   = [];
			$blocksStatus = \Vexaltrix\Presentation\Admin\AdminSettings::get( '_vxt_ultimate_gutenberg_blocks_blocks' );

			// If Block Statuses exists and is not empty, enable the required Core Vexaltrix.
			if ( is_array( $blocksStatus ) && ! empty( $blocksStatus ) ) {

				// If user is older than 2.0.16 then enable all the Core Vexaltrix, as we have removed option to disable core blocks from 2.0.16.
				if ( version_compare( $savedVersion, '2.0.16', '<' ) ) {
					array_push(
						$coreBlocks,
						'container',
						'advanced-heading',
						'image',
						'buttons',
						'info-box',
						'call-to-action'
					);
				}

				// If user is older than 2.4.0 then enable the Icon Block that was added to the Core Blocks in this release.
				if ( version_compare( $savedVersion, '2.4.0', '<' ) ) {
					array_push(
						$coreBlocks,
						'icon'
					);
				}

				// If user is older than 2.6.0 then enable the Countdown Block that was added to the Core Blocks in this release.
				if ( version_compare( $savedVersion, '2.6.0', '<' ) ) {
					array_push(
						$coreBlocks,
						'countdown'
					);
				}

				// If user is older than 2.12.3 then enable the popup-builder Block that was added to the Core Blocks in this release.
				if ( version_compare( $savedVersion, '2.12.3', '<' ) ) {
					array_push(
						$coreBlocks,
						'popup-builder'
					);
				}
			}

			$inheritFromTheme = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_btn_inherit_from_theme' );
			// If user is older than 2.13.4 and Inherit from theme is enabled update the fallback.
			if ( version_compare( $savedVersion, '2.13.4', '<' ) && 'enabled' === $inheritFromTheme ) {
				\Vexaltrix\Presentation\Admin\AdminSettings::updateAdminSettingsOption( 'vxt_btn_inherit_from_theme_fallback', 'disabled' );
			}

			// If the core block array is not empty, update the enabled blocks option.
			if ( ! empty( $coreBlocks ) ) {

				foreach ( $coreBlocks as $block ) {
					$blocksStatus[ $block ] = $block;
				}

				\Vexaltrix\Presentation\Admin\AdminSettings::updateAdminSettingsOption( '_vxt_ultimate_gutenberg_blocks_blocks', $blocksStatus );
			}

			// Create file if not present.
			VxtUltimateGutenbergBlocksInstall()->createFiles();

			/* Create activated blocks stylesheet */
			\Vexaltrix\Presentation\Admin\AdminSettings::createSpecificStylesheet();

			// Update asset version number.
			update_option( '__vxt_ultimate_gutenberg_blocks_asset_version', time() );

			// Update auto saved version number.
			update_option( 'vxt-version', VXT_VER );

			do_action( 'vxt_ultimate_gutenberg_blocks_update_after' );
		}


		/**
		 * Migrate_visibility_mode
		 *
		 * @since 2.8.0
		 * @return void
		 */
		public static function migrateVisibilityMode() {

			$oldOption      = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_enable_coming_soon_mode' );
			$oldOptionPage = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_coming_soon_page' );

			if ( ! $oldOption && ! $oldOptionPage ) {
				return;
			}

			// Update the option.
			\Vexaltrix\Presentation\Admin\AdminSettings::updateAdminSettingsOption( 'vxt_visibility_mode', $oldOption ? $oldOption : 'disabled' );
			\Vexaltrix\Presentation\Admin\AdminSettings::updateAdminSettingsOption( 'vxt_visibility_page', $oldOptionPage ? $oldOptionPage : '' );

			// Delete the old option.
			\Vexaltrix\Presentation\Admin\AdminSettings::deleteAdminSettingsOption( 'vxt_enable_coming_soon_mode' );
			\Vexaltrix\Presentation\Admin\AdminSettings::deleteAdminSettingsOption( 'vxt_coming_soon_page' );
		}

		/**
		 * Update asset generation option if it is not exist.
		 *
		 * @since 1.22.4
		 * @return void
		 */
		public function freshInstallUpdateAssetGenerationOption() {

			VxtUltimateGutenbergBlocksInstall()->createFiles();

			if ( \Vexaltrix\Core\Support\Helper::isUagDirHasWritePermissions() ) {
				update_option( '_vxt_ultimate_gutenberg_blocks_allow_file_generation', 'enabled' );
			}
		}

		/**
		 * Plugin update notification.
		 *
		 * @param array $data Plugin update data.
		 * @since 2.7.2
		 * @return void
		 */
		public function pluginUpdateNotification( $data ) {
			if ( ! empty( $data['upgrade_notice'] ) ) { ?>
				<hr class="vxt-plugin-update-notification__separator" />
				<div class="vxt-plugin-update-notification">
					<div class="vxt-plugin-update-notification__icon">
						<span class="dashicons dashicons-info"></span>
					</div>
					<div>
						<div class="vxt-plugin-update-notification__title">
							<?php echo esc_html__( 'Heads up!', 'vexaltrix' ); ?>
						</div>
						<div class="vxt-plugin-update-notification__message">
							<?php
								printf(
									wp_kses(
										$data['upgrade_notice'],
										[ 'a' => [ 'href' => [] ] ]
									)
								);
							?>
						</div>
					</div>
				</div>
				<?php
			} //end if
		}

		/**
		 * Enqueue styles.
		 *
		 * @since 2.7.2
		 * @return void
		 */
		public function enqueueStyles() {
			// Check if assets should be excluded for the current post type.
			if ( \Vexaltrix\Presentation\Admin\AdminSettings::shouldExcludeAssetsForCpt() ) {
				return; // Early return to prevent loading assets.
			}

			$screen = get_current_screen();
			if ( empty( $screen->id ) || 'plugins' !== $screen->id ) {
				return;
			}
			wp_enqueue_style( 'vxt-update-notice', VXT_URL . 'assets/admin/css/update-notice.css', [], VXT_VER );
		}
	
	/**
	 * Service group.
	 *
	 * @return string
	 */
	public static function group(): string {
		return 'infrastructure';
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
		return 2;
	}

	/**
	 * Register actions and filters.
	 *
	 * @return void
	 */
	public function boot(): void {
			add_action( 'admin_init', [ $this, 'init' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'enqueueStyles' ] );
			add_action( 'in_plugin_update_message-' . VXT_BASE, [ $this, 'pluginUpdateNotification' ], 10 );
	}

}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
endif;
