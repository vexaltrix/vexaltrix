<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/columns';
$blockData = [
	'admin_categories' => [],
	'doc'              => 'advanced-columns',
	'slug'             => '',
	'link'             => 'advanced-columns-legacy',
	'title'            => __( 'Advanced Columns', 'vexaltrix' ),
	'description'      => __( 'Insert a number of columns within a single row.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'columns' ),
	'deprecated'       => true,
	'dynamic_assets'   => [
		'dir' => 'columns',
	],
];
