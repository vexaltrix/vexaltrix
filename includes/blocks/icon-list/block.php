<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/icon-list';
$blockData = [
	'doc'              => 'icon-list',
	'slug'             => '',
	'admin_categories' => [ 'creative' ],
	'link'             => 'icon-list-legacy',
	'title'            => __( 'Icon List', 'vexaltrix' ),
	'description'      => __( 'Create a list highlighted with icons/images.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'icon-list' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'icon-list',
	],
];
