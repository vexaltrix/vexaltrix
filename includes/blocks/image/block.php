<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/image';
$blockData = [
	'slug'             => '',
	'admin_categories' => [ 'content', 'core' ],
	'link'             => 'image-block-legacy',
	'doc'              => 'image',
	'title'            => __( 'Image', 'vexaltrix' ),
	'description'      => __( 'Add images on your webpage with multiple customization options.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'image' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'image',
	],
];
