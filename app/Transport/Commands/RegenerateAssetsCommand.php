<?php
/**
 * Vexaltrix Regenerate Assets Command.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Transport\Commands;

use Vexaltrix\Core\Contracts\ServiceInterface;

use Exception;
use WP_CLI;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if ( ! class_exists( 'Vexaltrix\Transport\Commands\\RegenerateAssetsCommand' ) ) {
	/**
	 * Class \Vexaltrix\Transport\Commands\RegenerateAssetsCommand
	 */
	class RegenerateAssetsCommand implements ServiceInterface {

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
				\Vexaltrix\Presentation\Admin\AdminSettings::createSpecificStylesheet();
				\Vexaltrix\Presentation\Admin\AdminSettings::updateAdminSettingsOption( '__vxt_ultimate_gutenberg_blocks_asset_version', time() );

				WP_CLI::success( 'Assets regenerated successfully!' );

			} catch ( Exception $e ) {
				WP_CLI::error( 'Error: ' . $e->getMessage() );
				return;
			}

		}


	
	/**
	 * Service group.
	 *
	 * @return string
	 */
	public static function group(): string {
		return 'transport';
	}

	/**
	 * Service context.
	 *
	 * @return string
	 */
	public static function context(): string {
		return 'cli';
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

	// Register the command to regenerate assets.
	WP_CLI::add_command( 'vexaltrix regenerate-css', [ 'Vexaltrix\Transport\Commands\\RegenerateAssetsCommand', 'regenerateAssets' ] );
}

