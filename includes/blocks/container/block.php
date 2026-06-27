<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/container';
$blockData = [
	'slug'                => '',
	'admin_categories'    => [ 'content', 'core' ],
	'link'                => 'container-layout-legacy',
	'doc'                 => 'container',
	'title'               => __( 'Container', 'vexaltrix' ),
	'description'         => __( 'Create beautiful layouts with flexbox powered container block.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'container' ),
	'deprecated'          => false,
	'dynamic_assets'      => [
		'dir' => 'container',
	],
	'static_dependencies' => [
		'vxt-block-positioning-js'  => [
			'type' => 'js',
		],
		'vxt-block-positioning-css' => [
			'type' => 'css',
		],
	],
];
