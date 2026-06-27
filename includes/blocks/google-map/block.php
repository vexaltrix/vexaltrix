<?php
/**
 * Block Information.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/google-map';
$blockData = [
	'doc'              => 'google-map',
	'slug'             => '',
	'admin_categories' => [ 'content' ],
	'link'             => 'google-maps-legacy',
	'title'            => __( 'Google Maps', 'vexaltrix' ),
	'description'      => __( 'Show a Google Map location on your website.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'google-map' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'google-map',
	],
];
