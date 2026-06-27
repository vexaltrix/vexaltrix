<?php
/**
 * Vexaltrix Google Map.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\BlocksConfig\GoogleMap;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\\BlocksConfig\\GoogleMap\\GoogleMap' ) ) {

	/**
	 * Class \Vexaltrix\BlocksConfig\GoogleMap\GoogleMap.
	 */
	class GoogleMap {


		/**
		 * Member Variable
		 *
		 * @since 2.6.4
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 *
		 * @since 2.6.4
		 */
		public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'init', [ $this, 'registerBlocks' ] );
		}

		/**
		 * Registers the `core/latest-posts` block on server.
		 *
		 * @since 2.6.4
		 */
		public function registerBlocks() {
			// Check if the register function exists.
			if ( ! function_exists( 'register_block_type' ) ) {
				return;
			}

			register_block_type(
				'vexaltrix/google-map',
				[
					'attributes'      => [
						'block_id'            => [
							'type' => 'string',
						],
						'address'             => [
							'type'    => 'string',
							'default' => 'Brainstorm Force',
						],
						'height'              => [
							'type'    => 'number',
							'default' => 300,
						],
						'heightTablet'        => [
							'type'    => 'number',
							'default' => 300,
						],
						'heightMobile'        => [
							'type'    => 'number',
							'default' => 300,
						],
						'zoom'                => [
							'type'    => 'number',
							'default' => 12,
						],
						'language'            => [
							'type'    => 'string',
							'default' => 'en',
						],
						'isPreview'           => [
							'type'    => 'boolean',
							'default' => false,
						],
						'enableSatelliteView' => [
							'type'    => 'boolean',
							'default' => false,
						],
					],
					'renderCallback' => [ $this, 'googleMapCallback' ],
				]
			);
		}

		/**
		 * Renders the Google Map block on server.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 2.6.4
		 */
		public function googleMapCallback( $attributes ) {
			$desktopClass = '';
			$tabClass     = '';
			$mobClass     = '';

			/**
			 * Added filter to attributes to support Dynamic Content.
			 *
			 * @since 2.7.0
			 * @hooked Pro -> DynamicContent->vxt_ultimate_gutenberg_blocks_google_map_block_attributes
			 * */
			$attributes = apply_filters( 'vxt_ultimate_gutenberg_blocks_google_map_block_attributes', $attributes );
			
			if ( array_key_exists( 'UAGHideDesktop', $attributes ) || array_key_exists( 'UAGHideTab', $attributes ) || array_key_exists( 'UAGHideMob', $attributes ) ) {
				$desktopClass = ( isset( $attributes['UAGHideDesktop'] ) ) ? 'uag-hide-desktop' : '';
				$tabClass     = ( isset( $attributes['UAGHideTab'] ) ) ? 'uag-hide-tab' : '';
				$mobClass     = ( isset( $attributes['UAGHideMob'] ) ) ? 'uag-hide-mob' : '';
			}
			
			$zindexDesktop           = '';
			$zindexTablet            = '';
			$zindexMobile            = '';
			$zindexWrap              = [];
			$zindexExtentionEnabled = ( isset( $attributes['zIndex'] ) || isset( $attributes['zIndexTablet'] ) || isset( $attributes['zIndexMobile'] ) );
			
			if ( $zindexExtentionEnabled ) {
				$zindexDesktop = ( isset( $attributes['zIndex'] ) ) ? '--z-index-desktop:' . $attributes['zIndex'] . ';' : false;
				$zindexTablet  = ( isset( $attributes['zIndexTablet'] ) ) ? '--z-index-tablet:' . $attributes['zIndexTablet'] . ';' : false;
				$zindexMobile  = ( isset( $attributes['zIndexMobile'] ) ) ? '--z-index-mobile:' . $attributes['zIndexMobile'] . ';' : false;
				
				if ( $zindexDesktop ) {
					array_push( $zindexWrap, $zindexDesktop );
				}
				
				if ( $zindexTablet ) {
					array_push( $zindexWrap, $zindexTablet );
				}
				
				if ( $zindexMobile ) {
					array_push( $zindexWrap, $zindexMobile );
				}
			}
			
			$blockId     = 'vxt-block-' . $attributes['block_id'];
			$mainClasses = [
				'wp-block-vxt-google-map',
				'vxt-google-map__wrap',
				$blockId,
				$desktopClass,
				$tabClass,
				$mobClass,
				$zindexExtentionEnabled ? 'uag-blocks-common-selector' : '',
				( is_array( $attributes ) && isset( $attributes['className'] ) ) ? $attributes['className'] : '',
			];

			$address  = ! empty( $attributes['address'] ) ? rawurlencode( $attributes['address'] ) : rawurlencode( 'Brainstorm Force' );
			$zoom     = ! empty( $attributes['zoom'] ) ? $attributes['zoom'] : 12;
			$language = ! empty( $attributes['language'] ) ? $attributes['language'] : 'en';
			$height   = ! empty( $attributes['height'] ) ? $attributes['height'] : 300;
			$mapType = 'm';

			if ( is_array( $attributes ) && isset( $attributes['enableSatelliteView'] ) ) {
				$mapType = $attributes['enableSatelliteView'] ? 'k' : 'm';
			}


			$updatedUrl = add_query_arg(
				[
					'q'      => $address,
					'z'      => $zoom,
					'hl'     => $language,
					't'      => $mapType,
					'output' => 'embed',
					'iwloc'  => 'near',
				],
				'https://maps.google.com/maps' 
			);
			ob_start();
			?>
			<div 
			class="<?php echo esc_attr( implode( ' ', $mainClasses ) ); ?>"
			style="<?php echo esc_attr( implode( '', $zindexWrap ) ); ?>" >
				<embed
					class="vxt-google-map__iframe"
					title="<?php _e( 'Google Map for ', 'vexaltrix' ) . $address; ?>"
					src="<?php echo esc_url_raw( $updatedUrl ); ?>"
					width="640"
					height="<?php echo floatval( $height ); ?>"
					loading="lazy"
				></embed>
			</div>
			<?php
			return ob_get_clean();
		}
	}

	/**
	 *  Prepare if class 'Vexaltrix\\BlocksConfig\\GoogleMap\\GoogleMap' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
