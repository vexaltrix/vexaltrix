<?php
/**
 * Block Information.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/content-timeline';
$blockData = [
	'doc'                 => 'content-timeline',
	'slug'                => '',
	'admin_categories'    => [ 'content' ],
	'link'                => 'content-timeline-legacy',
	'title'               => __( 'Content Timeline', 'vexaltrix' ),
	'description'         => __( 'Create a timeline displaying contents of your site.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'content-timeline' ),
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
		'dir' => 'content-timeline',
	],
];
