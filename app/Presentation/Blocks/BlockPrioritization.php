<?php
/**
 * Vexaltrix Block Prioritization.
 *
 * @package Vexaltrix
 * @since 2.1.0
 */

namespace Vexaltrix\Presentation\Blocks;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class \Vexaltrix\Presentation\Blocks\BlockPrioritization.
 */
class BlockPrioritization implements ServiceInterface {

	/**
	 * Array of all blocks in order.
	 * This array should be in the same order as: /src/blocks.js.
	 *
	 * @var array
	 */
	private static $blocks = [
		// Core Vexaltrix.
		'container',
		'advanced-heading',
		'image',
		'icon',
		'buttons',
		'info-box',
		'call-to-action',
		'countdown',
		// Alphabetically Ordered Blocks.
		'blockquote',
		'content-timeline',
		'counter',
		'faq',
		'forms',
		'google-map',
		'how-to',
		'icon-list',
		'image-gallery',
		'inline-notice',
		'instagram-feed',
		'login',
		'loop-builder',
		'lottie',
		'marketing-button',
		'modal',
		'post-carousel',
		'post-grid',
		'post-timeline',
		'price-list',
		'register',
		'review',
		'separator',
		'slider',
		'social-share',
		'star-rating',
		'table-of-contents',
		'tabs',
		'taxonomy-list',
		'team',
		'testimonial',
		// Legacy Blocks.
		'columns',
		'section',
		'cf7-styler',
		'gf-styler',
		'post-masonry',
		'wp-search',
		// Extensions.
		'popup-builder',
	];

	/**
	 * Member Variable.
	 *
	 * @var instance
	 */
	private static $instance;

	/**
	 *  Initiator.
	 */
	public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

	/**
	 * Get the Block Priority of a Specific Block.
	 *
	 * @since 2.1.0
	 * @param string $blockName The slug of the required block.
	 */
	public static function getBlockPriority( $blockName ) {
		return ( array_search( $blockName, self::$blocks, true ) + 1 );
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
		return 2;
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
 *  Prepare if class 'Vexaltrix\Presentation\Blocks\\BlockPrioritization' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
