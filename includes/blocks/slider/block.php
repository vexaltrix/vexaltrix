<?php
/**
 * Block Information.
 *
 * @since 2.3.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/slider';
$blockData = [
	'doc'                 => 'slider',
	'slug'                => '',
	'admin_categories'    => [ 'content' ],
	'link'                => 'slider-legacy',
	'title'               => __( 'Slider', 'vexaltrix' ),
	'description'         => __( 'Create a Slider.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'slider' ),
	'deprecated'          => false,
	'static_dependencies' => [
		'vxt-swiper-js'  => [
			'type' => 'js',
		],
		'vxt-swiper-css' => [
			'type' => 'css',
		],
	],
	'dynamic_assets'      => [
		'dir' => 'slider',
	],
];
