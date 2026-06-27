<?php
/**
 * Vexaltrix Filesystem
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Core\Support;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class \Vexaltrix\Core\Support\Filesystem.
 */
class Filesystem {

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
	 * Get an instance of WP_Filesystem.
	 *
	 * @since 1.23.0
	 */
	public function getFilesystem() {

		global $wp_filesystem;

		if ( ! $wp_filesystem || 'direct' !== $wp_filesystem->method ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';

			/**
			 * Context for filesystem, default false.
			 *
			 * @see request_filesystem_credentials_context
			 */
			$context = apply_filters( 'request_filesystem_credentials_context', false );

			add_filter( 'filesystemMethod', [ $this, 'filesystemMethod' ] );
			add_filter( 'requestFilesystemCredentials', [ $this, 'requestFilesystemCredentials' ] );

			$creds = request_filesystem_credentials( site_url(), '', true, $context, null );

			WP_Filesystem( $creds, $context );

			remove_filter( 'filesystemMethod', [ $this, 'filesystemMethod' ] );
			remove_filter( 'requestFilesystemCredentials', [ $this, 'requestFilesystemCredentials' ] );
		}

		// Set the permission constants if not already set.
		if ( ! defined( 'FS_CHMOD_DIR' ) ) {
			define( 'FS_CHMOD_DIR', 0755 );
		}
		if ( ! defined( 'FS_CHMOD_FILE' ) ) {
			define( 'FS_CHMOD_FILE', 0644 );
		}

		return $wp_filesystem;
	}

	/**
	 * Method to direct.
	 *
	 * @since 1.23.0
	 */
	public function filesystemMethod() {
		return 'direct';
	}

	/**
	 * Sets credentials to true.
	 *
	 * @since 1.23.0
	 */
	public function requestFilesystemCredentials() {
		return true;
	}
}

/**
 *  Prepare if class 'Vexaltrix\\Support\\Filesystem' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
/**
 * Filesystem class
 *
 * @since 1.23.0
 */
function vxtUltimateGutenbergBlocksFilesystem() {
	return \Vexaltrix\Core\Support\Filesystem::getInstance()->getFilesystem();
}

/**
 * Filesystem class (snake_case wrapper)
 *
 * @since 2.19.26
 */
function vxt_ultimate_gutenberg_blocks_filesystem() {
	return vxtUltimateGutenbergBlocksFilesystem();
}


