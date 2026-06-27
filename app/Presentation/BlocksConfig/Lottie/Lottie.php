<?php
/**
 * Vexaltrix - Lottie
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Presentation\BlocksConfig\Lottie;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Presentation\BlocksConfig\\Lottie\\Lottie' ) ) {

	/**
	 * Class \Vexaltrix\Presentation\BlocksConfig\Lottie\Lottie.
	 *
	 * @since 1.20.0
	 */
	class Lottie {

		/**
		 * Member Variable
		 *
		 * @since 1.20.0
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 *
		 * @since 1.20.0
		 */
		public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 *
		 * @since 1.20.0
		 */
		public function __construct() {

			// Activation hook.
			add_action( 'init', [ $this, 'registerBlocks' ] );
		}

		/**
		 * Registers the `vexaltrix/lottie` block on server.
		 *
		 * @since 1.20.0
		 */
		public function registerBlocks() {

			// Check if the register function exists.
			if ( ! function_exists( 'register_block_type' ) ) {
				return;
			}

			register_block_type(
				'vexaltrix/lottie',
				[
					'attributes'      => [
						'block_id'         => [
							'type' => 'string',
						],
						'align'            => [
							'type'    => 'string',
							'default' => 'center',
						],
						'lottieURl'        => [
							'type'    => 'string',
							'default' => '',
						],
						'lottieSource'     => [
							'type'    => 'string',
							'default' => 'library',
						],
						'jsonLottie'       => [
							'type' => 'object',
						],
						// Controls.
						'loop'             => [
							'type'    => 'boolean',
							'default' => true,
						],
						'speed'            => [
							'type'    => 'number',
							'default' => 1,
						],
						'reverse'          => [
							'type'    => 'boolean',
							'default' => false,
						],
						'playOnHover'      => [
							'type'    => 'boolean',
							'default' => false,
						],
						'playOn'           => [
							'type'    => 'string',
							'default' => 'none',
						],
						// Style.
						'height'           => [
							'type' => 'number',
						],
						'heightTablet'     => [
							'type' => 'number',
						],
						'heightMob'        => [
							'type' => 'number',
						],
						'width'            => [
							'type' => 'number',
						],
						'widthTablet'      => [
							'type' => 'number',
						],
						'widthMob'         => [
							'type' => 'number',
						],
						'backgroundColor'  => [
							'type'    => 'string',
							'default' => '',
						],
						'backgroundHColor' => [
							'type'    => 'string',
							'default' => '',
						],
						'isPreview'        => [
							'type'    => 'boolean',
							'default' => false,
						],
					],
					'renderCallback' => [ $this, 'renderHtml' ],
				]
			);
		}

		/**
		 * Render Lottie HTML.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 1.20.0
		 */
		public function renderHtml( $attributes ) {

			$blockId = '';

			if ( isset( $attributes['block_id'] ) ) {
				$blockId = $attributes['block_id'];
			}

			$desktopClass = '';
			$tabClass     = '';
			$mobClass     = '';

			if ( array_key_exists( 'UAGHideDesktop', $attributes ) || array_key_exists( 'UAGHideTab', $attributes ) || array_key_exists( 'UAGHideMob', $attributes ) ) {

				$desktopClass = ( isset( $attributes['UAGHideDesktop'] ) ) ? 'uag-hide-desktop' : '';

				$tabClass = ( isset( $attributes['UAGHideTab'] ) ) ? 'uag-hide-tab' : '';

				$mobClass = ( isset( $attributes['UAGHideMob'] ) ) ? 'uag-hide-mob' : '';
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

			$mainClasses = [
				'vxt-block-' . $blockId,
				'vxt-lottie__outer-wrap',
				'vxt-lottie__' . $attributes['align'],
				$desktopClass,
				$tabClass,
				$mobClass,
				$zindexExtentionEnabled ? 'uag-blocks-common-selector' : '',
			];

			ob_start();

			?>
				<div class = "wp-block-vxt-lottie">
					<div class = "<?php echo esc_attr( implode( ' ', $mainClasses ) ); ?>" style="<?php echo esc_attr( implode( '', $zindexWrap ) ); ?>">
					</div>
				</div>
			<?php
				return ob_get_clean();
		}
	}

	/**
	 *  Prepare if class 'Vexaltrix\Presentation\BlocksConfig\\Lottie\\Lottie' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
