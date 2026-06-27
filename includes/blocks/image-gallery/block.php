<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.1.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/image-gallery';
$blockData = [
	'doc'                 => 'image-gallery',
	'slug'                => '',
	'admin_categories'    => [ 'content', 'creative' ],
	'link'                => 'image-gallery-legacy',
	'title'               => __( 'Image Gallery', 'vexaltrix' ),
	'description'         => __( 'Create a highly customizable image gallery', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'image-gallery' ),
	'static_dependencies' => [
		'vxt-image-gallery-js' => [
			'src'  => \Vexaltrix\Support\ScriptsUtils::getJsUrl( 'image-gallery' ),
			'dep'  => [],
			'type' => 'js',
		],
		'vxt-masonry'          => [
			'type' => 'js',
		],
		'vxt-imagesloaded'     => [
			'type' => 'js',
		],
		'vxt-slick-js'         => [
			'type' => 'js',
		],
		'vxt-swiper-js'        => [
			'type' => 'js',
		],
		'vxt-slick-css'        => [
			'type' => 'css',
		],
		'vxt-swiper-css'       => [
			'type' => 'css',
		],
	],
	'dynamic_assets'      => [
		'dir' => 'image-gallery',
	],
];
