<?php
/**
 * Block Information.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/taxonomy-list';
$blockData = [
	'doc'              => 'taxonomy-list',
	'slug'             => '',
	'admin_categories' => [ 'content' ],
	'link'             => 'taxonomy-legacy',
	'title'            => __( 'Taxonomy List', 'vexaltrix' ),
	'description'      => __( 'Display your content categorized as per post type.', 'vexaltrix' ),
	'default'          => true,
	'priority'         => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'taxonomy-list' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'taxonomy-list',
	],
];
