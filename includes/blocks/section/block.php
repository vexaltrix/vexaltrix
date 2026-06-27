<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/section';
$blockData = [
	'doc'              => 'section',
	'slug'             => '',
	'admin_categories' => [],
	'link'             => 'sections-legacy',
	'title'            => __( 'Advanced Row', 'vexaltrix' ),
	'description'      => __( 'Outer wrap section that allows you to add other blocks within it.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'section' ),
	'deprecated'       => true,
	'dynamic_assets'   => [
		'dir' => 'section',
	],
];
