<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/info-box';
$blockData = [
	'doc'              => 'infobox',
	'slug'             => '',
	'admin_categories' => [ 'core', 'content' ],
	'link'             => 'info-box-legacy',
	'title'            => __( 'Info Box', 'vexaltrix' ),
	'description'      => __( 'Add image/icon, seperator and text description using a single block.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'info-box' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'info-box',
	],
];
