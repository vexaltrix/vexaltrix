<?php
/**
 * Vexaltrix - Buttons Child
 *
 * @package Vexaltrix
 *
 * @since 2.6.3
 */

namespace Vexaltrix\Presentation\BlocksConfig\ButtonsChild;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class \Vexaltrix\Presentation\BlocksConfig\ButtonsChild\ButtonsChild.
 *
 * @since 2.6.3
 */
class ButtonsChild {

	/**
	 * Member Variable
	 *
	 * @since 2.6.3
	 * @var instance
	 */
	private static $instance;

	/**
	 * Get class instance.
	 *
	 * @since 2.6.3
	 * @return \Vexaltrix\Presentation\BlocksConfig\ButtonsChild\ButtonsChild
	 */
	public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

	/**
	 * Class Constructor.
	 *
	 * @since 2.6.3
	 * @return void
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'registerButtonsChild' ] );
	}

	/**
	 * Register Buttons Child.
	 *
	 * @since 2.6.3
	 * @return void
	 */
	public function registerButtonsChild() {
		register_block_type(
			'vexaltrix/buttons-child',
			[
				'renderCallback' => [ $this, 'renderButtonsChild' ],
				'uses_context'    => [
					'queryId',
					'query',
					'queryContext',
					'attrs',
				],
			]
		);
	}

	/**
	 * Render Button Child
	 *
	 * @param array  $attributes Attributes.
	 * @param String $content Content.
	 * @param object $block Block Object.
	 * @since 2.6.3
	 * @return string $content.
	 */
	public function renderButtonsChild( $attributes, $content, $block ) {
		return apply_filters( 'vexaltrix_buttons_child_content', $content, $attributes, $block );
	}
}

/**
 *  Prepare if class 'Vexaltrix\Presentation\BlocksConfig\\ButtonsChild\\ButtonsChild' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
