<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/post-masonry';
$blockData = [
	'doc'                 => 'post-masonry',
	'slug'                => '',
	'admin_categories'    => [ 'content', 'post' ],
	'link'                => 'post-layouts/#post-masonary-legacy',
	'title'               => __( 'Post Masonry', 'vexaltrix' ),
	'description'         => __( 'Display your posts in a masonary layout.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'post-masonry' ),
	'deprecated'          => true,
	'static_dependencies' => [
		'vxt-post-js'      => [
			'src'  => \Vexaltrix\Core\Support\ScriptsUtils::getJsUrl( 'post' ),
			'dep'  => [ 'jquery' ],
			'type' => 'js',
		],
		'vxt-masonry'      => [
			'type' => 'js',
		],
		'vxt-imagesloaded' => [
			'type' => 'js',
		],
	],
	'dynamic_assets'      => [
		'dir' => 'post-masonry',
	],
	'static_css'          => 'post',
];
