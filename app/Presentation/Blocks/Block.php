<?php
/**
 * Vexaltrix Block.
 *
 * @since 2.1.0
 *
 * @package ugb
 */

namespace Vexaltrix\Presentation\Blocks;

use Vexaltrix\Core\Contracts\ServiceInterface;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Vexaltrix\Presentation\Blocks\\Block' ) ) {

	/**
	 * Class doc
	 */
	class Block implements ServiceInterface {

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
			return \Vexaltrix\Core\Container::getInstance()->get( self::class );
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

			$realPath  = realpath( $blockFile );
				$blocksDir = realpath( VXT_DIR . 'includes/blocks' );
				if ( $realPath && $blocksDir && str_starts_with( $realPath, $blocksDir ) ) {
					include $realPath;
				}
			
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

			do_action( 'vxt_register_block', $this );
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
	 * Gives \Vexaltrix\Presentation\Blocks\Block object
	 *
	 * @since 2.1.0
	 *
	 * @return object
	 */
	function vxtUltimateGutenbergBlocksBlock() {
		return \Vexaltrix\Presentation\Blocks\Block::getInstance();
	}
}
