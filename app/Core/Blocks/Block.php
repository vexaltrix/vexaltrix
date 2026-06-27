<?php
/**
 * Vexaltrix Block.
 *
 * @since 2.1.0
 *
 * @package ugb
 */

namespace Vexaltrix\Core\Blocks;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vexaltrix\\Core\\Blocks\\Block' ) ) {

	/**
	 * Class doc
	 */
	class Block {

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
		private static $blocks = null;

		/**
		 *  Initiator
		 */
		public static function getInstance() {
			return \Vexaltrix\Container::getInstance()->get( self::class );
		}

		/**
		 * Register a Block.
		 *
		 * @since 2.1.0
		 * @param string $blockFile Block File Path.
		 */
		public function register( $blockFile ) {

			$blockSlug = '';
			$blockData = [];

			include $blockFile;
			
			if ( ! empty( $blockSlug ) && ! empty( $blockData ) ) {
				self::$blocks[ $blockSlug ] = apply_filters( "vexaltrix_{$blockSlug}_blockdata", $blockData );
			}
		}

		/**
		 * Register all UAG Lite Blocks.
		 *
		 * @since 2.1.0
		 */
		public function registerBlocks() {

			self::$blocks = [];

			$blockFiles = glob( VXT_DIR . 'includes/blocks/*/block.php' );

			foreach ( $blockFiles as $blockFile ) {
				$this->register( $blockFile );
			}

			do_action( 'uag_register_block', $this );
		}

		/**
		 * Gives all Blocks.
		 *
		 * @since 2.1.0
		 */
		public function getBlocks() {

			if ( null === self::$blocks ) {

				$this->registerBlocks();
			}

			return self::$blocks;
		}
	}

	/**
	 * Gives \Vexaltrix\Core\Blocks\Block object
	 *
	 * @since 2.1.0
	 *
	 * @return object
	 */
	function vxtUltimateGutenbergBlocksBlock() {
		return \Vexaltrix\Core\Blocks\Block::getInstance();
	}
}
