<?php
/**
 * Vexaltrix Block Positioning.
 *
 * @since 2.8.0
 * @package ugb
 */

namespace Vexaltrix\BlocksConfig\AdvancedSettings;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if ( ! class_exists( 'Vexaltrix\\BlocksConfig\\AdvancedSettings\\BlockPositioning' ) ) {

	/**
	 * Class \Vexaltrix\BlocksConfig\AdvancedSettings\BlockPositioning.
	 * 
	 * @since 2.8.0
	 */
	class BlockPositioning {

		/**
		 * The instance of this class, or null if it has not been created yet.
		 *
		 * @since 2.8.0
		 * @var object|null instance
		 */
		private static $instance = null;

		/**
		 * The Initiator.
		 *
		 * @since 2.8.0
		 * @return object  An instance of this class.
		 */
		public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

		/**
		 * The Constructor.
		 * 
		 * @since 2.8.0
		 * @return void
		 */
		public function __construct() {
			add_filter( 'vxt_ultimate_gutenberg_blocks_render_block', [ $this, 'addPositioningClasses' ], 10, 2 );
		}

		/**
		 * Add the required positioning classes if needed.
		 *
		 * @param string $blockContent  The block content.
		 * @param array  $block          The block data.
		 * @since 2.8.0
		 * @return string                The block content after updation.
		 */
		public function addPositioningClasses( $blockContent, $block ) {
			if ( empty( $block['blockName'] ) ) {
				return $blockContent;
			}
			
			// Check $blockContent is string or not.
			if ( ! is_string( $blockContent ) || false === strpos( $block['blockName'], 'uagb' ) ) {
				return $blockContent;
			}
			
			// Filter image block content.
			if ( 'vexaltrix/image' === $block['blockName'] ) {
				$blockContent = $this->imageBlockContentFilters( $blockContent, $block );
			}

			// Return early if this doesn't need any positioning classes.
			if (
				'vexaltrix/container' !== $block['blockName']
				|| empty( $block['attrs']['UAGPosition'] )
			) {
				return $blockContent;
			}

			// Create the class to prepend to this block's class list.
			$prependedClasses = 'vxt-position__sticky';
			
			// Once all the additional classes have been added, add the start of the block selector.
			$prependedClasses .= ' wp-block-vxt-';

			// Replace the closest opening block selector with the prepended classes.
			$updatedContent = preg_replace( '/wp-block-vxt-/', $prependedClasses, $blockContent, 1 );

			// If an error was encountered, null would have been passed. Keep the content as it is when this happens.
			if ( $updatedContent ) {
				$blockContent = $updatedContent;
			}

			return $blockContent;
		}

		/**
		 * This function is used to filter image block content.
		 *
		 * @param string $blockContent Image block content.
		 * @param array  $block Image block data.
		 * @since 2.10.2
		 * @return string
		 */
		public function imageBlockContentFilters( $blockContent, $block ) {
			// Remove srcset attribute from image.
			if ( empty( $block['attrs']['id'] ) && ! empty( $block['attrs']['url'] ) && strpos( $blockContent, 'srcset' ) ) {
				$removeSrcsetFromContent = preg_replace( '/srcset="([^"]*)"/', '', $blockContent );
				if ( $removeSrcsetFromContent ) {
					$blockContent = $removeSrcsetFromContent;
				}
				
				return $blockContent;
			}

			/**
			 * For migrating http and https.
			 */
			if ( empty( $block['attrs']['id'] ) || empty( $block['attrs']['url'] ) ) {
				return $blockContent;
			}

			// Check url protocol.
			$currentUrlProtocol   = wp_parse_url( get_site_url(), PHP_URL_SCHEME );
			$attributeUrlProtocol = wp_parse_url( $block['attrs']['url'], PHP_URL_SCHEME );

			if ( ! is_string( $currentUrlProtocol ) || ! is_string( $attributeUrlProtocol ) || $currentUrlProtocol === $attributeUrlProtocol ) {
				return $blockContent;
			}

			foreach ( [ 'url', 'urlMobile', 'urlTablet' ] as $replaceAttributesUrl ) {
				if ( empty( $block['attrs'][ $replaceAttributesUrl ] ) ) {
					continue;
				}

				if ( false === strpos( $blockContent, $block['attrs'][ $replaceAttributesUrl ] ) ) {
					continue;
				}

				// Replace http with https with current url protocol.
				$migratedUrls = str_replace( $attributeUrlProtocol, $currentUrlProtocol, $block['attrs'][ $replaceAttributesUrl ] );

				$blockContent = str_replace( $block['attrs'][ $replaceAttributesUrl ], $migratedUrls, $blockContent );
			}
			
			return $blockContent;
		}
	}

	/**
	 *  Prepare if class 'Vexaltrix\\BlocksConfig\\AdvancedSettings\\BlockPositioning' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
