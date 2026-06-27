<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/wp-search';
$blockData = [
	'doc'              => 'wp-search',
	'slug'             => '',
	'admin_categories' => [ 'content' ],
	'link'             => 'wp-search-legacy',
	'title'            => __( 'Search', 'vexaltrix' ),
	'description'      => __( 'Add a search widget to let users search posts from your website.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'wp-search' ),
	'deprecated'       => true,
	'dynamic_assets'   => [
		'dir' => 'wp-search',
	],
];
