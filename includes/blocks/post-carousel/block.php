<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/post-carousel';
$blockData = [
	'doc'                 => 'post-carousel',
	'slug'                => '',
	'admin_categories'    => [ 'content', 'post' ],
	'link'                => 'post-carousel-legacy',
	'title'               => __( 'Post Carousel', 'vexaltrix' ),
	'description'         => __( 'Display your posts in a sliding carousel layout.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'post-carousel' ),
	'deprecated'          => false,
	'dynamic_assets'      => [
		'dir' => 'post-carousel',
	],
	'static_dependencies' => [
		'vxt-post-js'      => [
			'src'  => \Vexaltrix\Support\ScriptsUtils::getJsUrl( 'post' ),
			'dep'  => [ 'jquery', 'vxt-slick-js' ],
			'type' => 'js',
		],
		'vxt-imagesloaded' => [
			'type' => 'js',
		],
		'vxt-slick-js'     => [
			'type' => 'js',
		],
		'vxt-slick-css'    => [
			'type' => 'css',
		],
	],
	'static_css'          => 'post',
];
