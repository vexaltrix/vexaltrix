<?php
/**
 * Vexaltrix Filesystem
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Infrastructure;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class \Vexaltrix\Infrastructure\Install.
 */
class Install implements ServiceInterface {

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
	 * Create files/directories.
	 */
	public function createFiles() {

		if ( ! defined( 'VXT_UPLOAD_DIR_NAME' ) ) {
			define( 'VXT_UPLOAD_DIR_NAME', 'uag-plugin' );
		}

		if ( ! defined( 'VXT_UPLOAD_DIR' ) ) {
			$uploadDir = wp_upload_dir( null, false );
			define( 'VXT_UPLOAD_DIR', $uploadDir['basedir'] . '/' . VXT_UPLOAD_DIR_NAME . '/' );
		}

		$files = [
			[
				'base'    => VXT_UPLOAD_DIR,
				'file'    => 'index.html',
				'content' => '',
			],
			[
				'base'    => VXT_UPLOAD_DIR . 'assets',
				'file'    => 'index.html',
				'content' => '',
			],
			[
				'base' => VXT_UPLOAD_DIR . 'assets/fonts',
			],
		];

		foreach ( $files as $file ) {

			if ( wp_mkdir_p( $file['base'] ) && ! empty( $file['file'] ) && ! file_exists( trailingslashit( $file['base'] ) . $file['file'] ) ) {

				$fileHandle = @fopen( trailingslashit( $file['base'] ) . $file['file'], 'w' ); // phpcs:ignore

				if ( $fileHandle ) {
					fwrite( $fileHandle, $file['content'] ); // phpcs:ignore WordPressVIPMinimum.Functions.RestrictedFunctions.file_ops_fwrite
					fclose( $fileHandle ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fclose
				}
			}
		}
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
		return 'always';
	}

	/**
	 * Boot priority.
	 *
	 * @return int
	 */
	public static function priority(): int {
		return 1;
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

/**
 *  Prepare if class 'Vexaltrix\Infrastructure\Install' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
/**
 * Filesystem class
 *
 * @since 1.23.0
 */

/**
 * Install class
 *
 * @since 2.0.0
 *
 * @return object
 */
function VxtUltimateGutenbergBlocksInstall() {
	return \Vexaltrix\Infrastructure\Install::getInstance();

}

