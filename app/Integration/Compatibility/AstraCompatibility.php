<?php
/**
 * Astra compatibility
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Integration\Compatibility;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class \Vexaltrix\Integration\Compatibility\AstraCompatibility.
 */
class AstraCompatibility implements ServiceInterface {

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
	 *
	 * @since 2.0.0
	 */
	public function __construct() {


		// Update Astra's admin top level menu position.

		$uagLoadFontsLocally = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'uag_load_gfonts_locally', 'disabled' );

		if ( 'disabled' === $uagLoadFontsLocally ) {

			$astraSettings = ( defined( 'ASTRA_THEME_SETTINGS' ) ) ? get_option( ASTRA_THEME_SETTINGS ) : '';

			if ( is_array( $astraSettings ) && empty( $astraSettings['load-google-fonts-locally'] ) || ( isset( $astraSettings['load-google-fonts-locally'] ) && false === $astraSettings['load-google-fonts-locally'] ) ) {

				// Disabled uag fonts.

				// Add uag fonts in astra.

	}
		}
	}

	/**
	 * This functions adds UAG Google Fonts in Astra filter to load a common Google Font File for both UAG & Astra.
	 *
	 * @param array $astraFonts Astra Fonts Object.
	 *
	 * @since 2.0.0
	 * @return array
	 */
	public function addGoogleFontsInAstra( $astraFonts ) {

		global $post;

		if ( $post ) {
			$postId = $post->ID;
		}

		if ( is_404() ) {
			$postId = get_queried_object_id();
		}

		if ( isset( $postId ) ) {

			$googleFonts = vxt_ultimate_gutenberg_blocks_get_post_assets( $postId )->getFonts();

			if ( is_array( $googleFonts ) && ! empty( $googleFonts ) ) {

				foreach ( $googleFonts as $key => $gfontValues ) {
					if ( ! empty( $gfontValues['fontfamily'] ) && is_string( $gfontValues['fontfamily'] ) && isset( $gfontValues['fontvariants'] ) ) {

						$astraFonts[ $gfontValues['fontfamily'] ] = $gfontValues['fontvariants'];

						foreach ( $gfontValues['fontvariants'] as $key => $fontVariants ) {

							$astraFonts[ $gfontValues['fontfamily'] ][ $key ] .= ',' . $fontVariants . 'italic';
						}
					}
				}
			}
		}

		return $astraFonts;
	}

	/**
	 * Update Astra's menu priority to show after Dashboard menu.
	 *
	 * @param int $menuPriority top level menu priority.
	 * @since 2.3.0
	 */
	public function updateAdminMenuPosition( $menuPriority ) {
		return 2.1;
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
		add_filter( 'astra_menu_priority', [ $this, 'updateAdminMenuPosition' ] );
				add_filter( 'vxt_ultimate_gutenberg_blocks_enqueue_google_fonts', '__return_false' );
				add_filter( 'astra_google_fonts_selected', [ $this, 'addGoogleFontsInAstra' ] );
	}

}

/**
 *  Prepare if class 'Vexaltrix\Integration\Compatibility\\AstraCompatibility' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
