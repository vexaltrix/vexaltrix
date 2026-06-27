<?php
/**
 * Block Information.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/post-timeline';
$blockData = [
	'doc'                 => 'post-timeline',
	'slug'                => '',
	'admin_categories'    => [ 'post', 'content' ],
	'link'                => 'post-timeline-legacy',
	'title'               => __( 'Post Timeline', 'vexaltrix' ),
	'description'         => __( 'Create an attractive timeline to display your posts.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'post-timeline' ),
	'deprecated'          => false,
	'static_dependencies' => [
		'vxt-timeline-js' => [
			'src'  => \Vexaltrix\Support\ScriptsUtils::getJsUrl( 'timeline' ),
			'dep'  => [],
			'type' => 'js',
		],
	],
	'static_css'          => 'timeline',
	'dynamic_assets'      => [
		'dir' => 'post-timeline',
	],
];
