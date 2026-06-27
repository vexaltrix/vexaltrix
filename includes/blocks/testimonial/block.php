<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/testimonial';
$blockData = [
	'doc'                 => 'testimonial',
	'slug'                => '',
	'admin_categories'    => [ 'social' ],
	'link'                => 'testimonials-legacy',
	'title'               => __( 'Testimonials', 'vexaltrix' ),
	'description'         => __( 'Display customer testimonials with customizable layouts.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'testimonial' ),
	'deprecated'          => false,
	'static_dependencies' => [
		'vxt-testimonial-js' => [
			'src'  => \Vexaltrix\Support\ScriptsUtils::getJsUrl( 'testimonial' ),
			'dep'  => [],
			'type' => 'js',
		],
		'vxt-imagesloaded'   => [
			'type' => 'js',
		],
		'vxt-slick-js'       => [
			'type' => 'js',
		],
		'vxt-slick-css'      => [
			'type' => 'css',
		],
	],
	'dynamic_assets'      => [
		'dir' => 'testimonial',
	],
];
