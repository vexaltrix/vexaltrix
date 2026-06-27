<?php
/**
 * Init
 *
 * @since 1.0.0
 * @package Ast Block Templates
 */

namespace Vexaltrix\Integrations;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( __NAMESPACE__ . '\\AstBlockTemplates' ) ) :

	/**
	 * Admin
	 */
	class AstBlockTemplates {

		/**
		 * Instance
		 *
		 * @since 1.0.0
		 * @var (Object) VXT_Ast_Block_Templates
		 */
		private static $instance = null;

		/**
		 * Get Instance
		 *
		 * @since 1.0.0
		 *
		 * @return object Class object.
		 */
		public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		private function __construct() {
			$this->versionCheck();
			add_action( 'init', [ $this, 'load' ], 999 );
			add_filter( 'ast_block_templates_localize_vars', [ $this, 'updateVars' ] );
		}

		/**
		 * Add support to change template button text.
		 *
		 * @since 1.21.0
		 * @param  array $vars localize array of button.
		 */
		public function updateVars( $vars = [] ) {
			if ( defined( 'ASTRA_SITES_VER' ) ) {
				return $vars;
			}

			$vars['button_text']         = __( 'Design Library', 'vexaltrix' );
			$vars['display_button_logo'] = true;
			$vars['popup_logo_uri']      = VXT_URL . 'admin-ui/assets/images/uag-logo.svg';
			$vars['button_logo']         = VXT_URL . 'admin-ui/assets/images/btn-logo.svg';
			$vars['button_class']        = 'vxt-template-button-logo';
			return $vars;
		}

		/**
		 * Version Check
		 *
		 * @return void
		 */
		public function versionCheck() {

			$file = realpath( VXT_DIR . 'app/lib/gutenberg-templates/version.json' );

			// Is file exist?
			if ( is_file( $file ) ) {
				// @codingStandardsIgnoreStart
				$fileData = json_decode( file_get_contents( $file ), true );
				// @codingStandardsIgnoreEnd
				global $astBlockTemplatesVersion, $astBlockTemplatesInit;
				$path    = realpath( VXT_DIR . 'app/lib/gutenberg-templates/ast-block-templates.php' );
				$version = isset( $fileData['ast-block-templates'] ) ? $fileData['ast-block-templates'] : 0;

				if ( null === $astBlockTemplatesVersion ) {
					$astBlockTemplatesVersion = '1.0.0';
				}

				// Compare versions.
				if ( version_compare( $version, $astBlockTemplatesVersion, '>' ) ) {
					$astBlockTemplatesVersion = $version;
					$astBlockTemplatesInit    = $path;
				}
			}
		}

		/**
		 * Load latest plugin
		 *
		 * @return void
		 */
		public function load() {
			global $astBlockTemplatesVersion, $astBlockTemplatesInit;
			if ( is_file( realpath( $astBlockTemplatesInit ) ) ) {
				include_once realpath( $astBlockTemplatesInit );
			}
		}

	}

	/**
	 * Kicking this off by calling 'get_instance()' method
	 */
	AstBlockTemplates::getInstance();

endif;
