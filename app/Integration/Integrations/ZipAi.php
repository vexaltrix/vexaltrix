<?php
/**
 * Zip AI initialization
 *
 * @since 2.10.2
 * @package zip-ai
 */

namespace Vexaltrix\Integration\Integrations;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( __NAMESPACE__ . '\\ZipAi' ) ) :

	/**
	 * This class connect zip ai library with vexaltrix
	 *
	 * @since 2.10.2
	 */
	class ZipAi implements ServiceInterface {

		/**
		 * Instance
		 *
		 * @since 2.10.2
		 * @var (Object) VXT_Zip_AI
		 */
		private static $instance = null;

		/**
		 * Get Instance
		 *
		 * @since 2.10.2
		 *
		 * @return object Class object.
		 */
		public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor.
		 *
		 * @since 2.10.2
		 *
		 * @return void
		 */
		private function __construct() {
			$this->versionCheck();
			add_action( 'plugins_loaded', [ $this, 'load' ], 15 );
		}

		/**
		 * Checks for latest version of zip-ai library available in environment.
		 *
		 * @since 2.10.2
		 *
		 * @return void
		 */
		public function versionCheck() {

			$file = realpath( VXT_DIR . 'app/lib/zip-ai/version.json' );

			// Is file exist?
			if ( is_file( $file ) ) {
				// @codingStandardsIgnoreStart
				$fileData = json_decode( file_get_contents( $file ), true );
				// @codingStandardsIgnoreEnd
				global $zipAiVersion, $zipAiPath;
				$path    = realpath( VXT_DIR . 'app/lib/zip-ai/zip-ai.php' );
				$version = isset( $fileData['zip-ai'] ) ? $fileData['zip-ai'] : 0;

				if ( null === $zipAiVersion ) {
					$zipAiVersion = '1.0.0';
				}

				// Compare versions.
				if ( version_compare( $version, $zipAiVersion, '>' ) ) {
					$zipAiVersion = $version;
					$zipAiPath    = $path;
				}
			}
		}

		/**
		 * Load latest zip-ai library
		 *
		 * @since 2.10.2
		 *
		 * @return void
		 */
		public function load() {
			global $zipAiPath;
			if ( ! is_null( $zipAiPath ) && is_file( realpath( $zipAiPath ) ) ) {
				include_once realpath( $zipAiPath );
			}
		}

	
	/**
	 * Service group.
	 *
	 * @return string
	 */
	public static function group(): string {
		return 'integration';
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

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	ZipAi::getInstance();

endif;
