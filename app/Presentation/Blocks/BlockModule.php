<?php
/**
 * Vexaltrix Block Module.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

namespace Vexaltrix\Presentation\Blocks;

use Vexaltrix\Core\Contracts\ServiceInterface;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vexaltrix\Presentation\Blocks\\BlockModule' ) ) {

	/**
	 * Class doc
	 */
	class BlockModule implements ServiceInterface {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 * Block Attributes
		 *
		 * @var block_attributes
		 */
		public static $blockAttributes = null;

		/**
		 * Block Assets
		 *
		 * @var array<mixed> block_assets
		 */
		public static $blockAssets = null;

		/**
		 *  Initiator
		 */
		public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 */
		

		/**
		 * Add Blocks Static Assets.
		 *
		 * @since 2.0.0
		 *
		 * @param array $blockAssets Block Assets.
		 * @return array
		 */
		public static function uagRegisterBlockStaticDependencies( $blockAssets ) {

			$blocks = self::getBlocksInfo();

			foreach ( $blocks as $block ) {
				if ( ! isset( $block['static_dependencies'] ) ) {
					continue;
				}

				foreach ( $block['static_dependencies'] as $key => $staticDependencies ) {
					if ( ! isset( $staticDependencies['src'] ) ) {
						continue;
					}
					$blockAssets[ $key ] = $staticDependencies;
				}
			}

			return $blockAssets;
		}
		
		/**
		 * Get frontend CSS.
		 *
		 * @since 2.0.0
		 *
		 * @param string $slug Block slug.
		 * @param array  $attr Block attributes.
		 * @param string $id   Block id.
		 * @param bool   $isGbs Is Global Block Style.
		 * @return array
		 */
		public static function getFrontendCss( $slug, $attr, $id, $isGbs = false ) {
			return self::getFrontendAssets( $slug, $attr, esc_attr( $id ), 'css', $isGbs );
		}

		/**
		 * Get frontend JS.
		 *
		 * @since 2.0.0
		 *
		 * @param string $slug Block slug.
		 * @param array  $attr Block attributes.
		 * @param string $id   Block id.
		 * @return array
		 */
		public static function getFrontendJs( $slug, $attr, $id ) {
			return self::getFrontendAssets( $slug, $attr, esc_attr( $id ), 'js' );
		}

		/**
		 * Filter GBS Placeholder Attributes.
		 *
		 * @param array $attributes Block attributes.
		 * @since 2.9.0
		 * @return array $attributes Block attributes by removing 0.001020304.
		 */
		public static function gbsFilterPlaceholderAttributes( $attributes ) {
			if ( ! empty( $attributes ) && is_array( $attributes ) ) {
				foreach ( $attributes as $key => $attribute ) {
					// Replace 0.001020304 with empty string.
					if ( 0.001020304 === $attribute ) {
						$attributes[ $key ] = '';
					}
				}
				return $attributes;
			}
			return [];
		}
		
		/**
		 * Get frontend Assets.
		 *
		 * @since 2.0.0
		 *
		 * @param string $slug Block slug.
		 * @param array  $attr Block attributes.
		 * @param string $id   Block id.
		 * @param string $type Asset Type.
		 * @param bool   $isGbs Is Global Block Style.
		 * @return array
		 */
		public static function getFrontendAssets( $slug, $attr, $id, $type = 'css', $isGbs = false ) {

			$attr = self::gbsFilterPlaceholderAttributes( $attr ); // Filter out GBS Placeholders if any added.

			$assets = [];

			if ( 'js' === $type ) {
				$assets = '';
			}

			$blocksInfo = self::getBlocksInfo();

			if ( ! isset( $blocksInfo[ 'vexaltrix/' . $slug ] ) || ! isset( $blocksInfo[ 'vexaltrix/' . $slug ]['dynamic_assets'] ) ) {
				return $assets;
			}

			$blocks = [
				$slug => $blocksInfo[ 'vexaltrix/' . $slug ]['dynamic_assets'],
			];

			if ( isset( $blocks[ $slug ] ) ) {

				$mainDir = VXT_DIR;

				if ( isset( $blocks[ $slug ]['plugin-dir'] ) ) {
					$mainDir = $blocks[ $slug ]['plugin-dir'];
				}

				$blockDir = $mainDir . 'includes/blocks/' . $blocks[ $slug ]['dir'];

				$assetsFile = realpath( $blockDir . '/frontend.' . $type . '.php' );

				if ( is_string( $assetsFile ) && file_exists( $assetsFile ) ) {

					
					// Set default attributes.
					$attrFile = realpath( $blockDir . '/attributes.php' );
					
					if ( is_string( $attrFile ) && file_exists( $attrFile ) ) {
						
						$defaultAttr = include $attrFile;
						
						$attr = self::getFallbackValues( $defaultAttr, $attr );
						
						if ( ! empty( $attr['globalBlockStyleId'] ) && $isGbs ) {
							$gbsClass = \Vexaltrix\Core\Support\Helper::getGbsSelector( $attr['globalBlockStyleId'] );
						}
					}

					// Get Assets.
					$assets = include $assetsFile;
				}
			}

			return $assets;

		}

		/**
		 * Get Widget List.
		 *
		 * @since 2.0.0
		 *
		 * @return array The Widget List.
		 */
		public static function getBlocksInfo() {

			return vxt_ultimate_gutenberg_blocks_block()->getBlocks();
		}

		/**
		 * Get Block Assets.
		 *
		 * @since 1.13.4
		 *
		 * @return array The Asset List.
		 */
		public static function getBlockDependencies() {

			$blocks = \Vexaltrix\Presentation\Admin\AdminSettings::getBlockOptions();

			if ( null === self::$blockAssets && defined( 'VXT_URL' ) ) {
				self::$blockAssets = [
					// Lib.
					'vxt-imagesloaded'          => [
						'src'  => VXT_URL . 'assets/js/imagesloaded.min.js',
						'dep'  => [ 'jquery' ],
						'type' => 'js',
					],
					'vxt-slick-js'              => [
						'src'  => VXT_URL . 'assets/js/slick.min.js',
						'dep'  => [ 'jquery' ],
						'type' => 'js',
					],
					'vxt-slick-css'             => [
						'src'  => VXT_URL . 'assets/css/slick.min.css',
						'dep'  => [],
						'type' => 'css',
					],
					'vxt-masonry'               => [
						'src'  => VXT_URL . 'assets/js/isotope.min.js',
						'dep'  => [ 'jquery' ],
						'type' => 'js',
					],
					'vxt-cookie-lib'            => [
						'src'        => VXT_URL . 'assets/js/js_cookie.min.js',
						'dep'        => [ 'jquery' ],
						'skipEditor' => true,
						'type'       => 'js',
					],
					'vxt-bodymovin-js'          => [
						'src'        => VXT_URL . 'assets/js/vxt-bodymovin.min.js',
						'dep'        => [],
						'skipEditor' => true,
						'type'       => 'js',
					],
					'vxt-countUp-js'            => [
						'src'  => VXT_URL . 'assets/js/countUp.min.js',
						'dep'  => [],
						'type' => 'js',
					],
					'vxt-swiper-js'             => [
						'src'        => VXT_URL . 'assets/js/swiper-bundle.min.js',
						'dep'        => [],
						'skipEditor' => true,
						'type'       => 'js',
					],
					'vxt-swiper-css'            => [
						'src'  => VXT_URL . 'assets/css/swiper-bundle.min.css',
						'dep'  => [],
						'type' => 'css',
					],
					'vxt-aos-js'                => [
						'src'  => VXT_URL . 'assets/js/aos.min.js',
						'dep'  => [],
						'type' => 'js',
					],
					'vxt-aos-css'               => [
						'src'  => VXT_URL . 'assets/css/aos.min.css',
						'dep'  => [],
						'type' => 'css',
					],
					'vxt-block-positioning-js'  => [
						'src'  => VXT_URL . 'assets/js/block-positioning.min.js',
						'dep'  => [],
						'type' => 'js',
					],
					'vxt-block-positioning-css' => [
						'src'  => VXT_URL . 'assets/css/block-positioning.min.css',
						'dep'  => [],
						'type' => 'css',
					],
				];
			}

			return apply_filters( 'uagRegisterBlockStaticDependencies', self::$blockAssets );
		}

		/**
		 * Returns attributes array with default value wherever required.
		 *
		 * @param array $defaultAttr default attribute value array from attributes.php.
		 * @param array $attr saved attributes data from database.
		 * @return array
		 * @since 2.3.2
		 */
		public static function getFallbackValues( $defaultAttr, $attr ) {
			foreach ( $defaultAttr as $key => $value ) {
				// sets default value if key is not available in database.
				if ( ! isset( $attr[ $key ] ) ) {
					$attr[ $key ] = $value;
				}
			}

			return $attr;
		}
	
	/**
	 * Service group.
	 *
	 * @return string
	 */
	public static function group(): string {
		return 'presentation';
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
		return 3;
	}

	/**
	 * Register actions and filters.
	 *
	 * @return void
	 */
	public function boot(): void {
			add_filter( 'uagRegisterBlockStaticDependencies', [ __CLASS__, 'uagRegisterBlockStaticDependencies' ] );
	}

}
}

/**
 *  Prepare if class 'Vexaltrix\Presentation\Blocks\\BlockModule' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
