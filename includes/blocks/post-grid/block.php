<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/post-grid';
$blockData = [
	'doc'                 => 'post-grid',
	'slug'                => '',
	'admin_categories'    => [ 'content', 'post' ],
	'link'                => 'post-grid-legacy',
	'title'               => __( 'Post Grid', 'vexaltrix' ),
	'description'         => __( 'Display your posts in a grid layout.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'post-grid' ),
	'deprecated'          => false,
	'static_css'          => 'post',
	'dynamic_assets'      => [
		'dir' => 'post-grid',
	],
	'static_dependencies' => [
		'vxt-post-js' => [
			'src'  => \Vexaltrix\Core\Support\ScriptsUtils::getJsUrl( 'post' ),
			'type' => 'js',
		],
	],
];
