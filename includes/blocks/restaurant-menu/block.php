<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/restaurant-menu';
$blockData = [
	'doc'              => 'price-list',
	'slug'             => '',
	'admin_categories' => [ 'content' ],
	'link'             => 'price-list-legacy',
	'title'            => __( 'Price List', 'vexaltrix' ),
	'description'      => __( 'Create an attractive price list for your products.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'price-list' ),
	'deprecated'       => false,
	'static_css'       => 'price-list',
	'dynamic_assets'   => [
		'dir' => 'restaurant-menu',
	],
];
