<?php
/**
 * Vexaltrix Regenerate Assets Command.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Core\Commands;

use Exception;
use WP_CLI;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if ( ! class_exists( 'Vexaltrix\\Core\\Commands\\RegenerateAssetsCommand' ) ) {
	/**
	 * Class \Vexaltrix\Core\Commands\RegenerateAssetsCommand
	 */
	class RegenerateAssetsCommand {

		/**
		 * Regenerates Vexaltrix CSS files.
		 *
		 * EXAMPLES: wp vexaltrix regenerate-css
		 *
		 * @since 2.19.9
		 *
		 * @param array $args Positional arguments.
		 * @param array $assocArgs Associative arguments.
		 * @return void
		 */
		public function regenerateAssets( $args, $assocArgs ) {

			try {
				/* Update the asset version */
				\Vexaltrix\Admin\AdminSettings::createSpecificStylesheet();
				\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( '__vxt_ultimate_gutenberg_blocks_asset_version', time() );

				WP_CLI::success( 'Assets regenerated successfully!' );

			} catch ( Exception $e ) {
				WP_CLI::error( 'Error: ' . $e->getMessage() );
				return;
			}

		}


	}

	// Register the command to regenerate assets.
	WP_CLI::add_command( 'vexaltrix regenerate-css', [ 'Vexaltrix\\Core\\Commands\\RegenerateAssetsCommand', 'regenerateAssets' ] );
}

