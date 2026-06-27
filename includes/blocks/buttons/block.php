<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/buttons';
$blockData = [
	'doc'              => 'multi-buttons',
	'slug'             => '',
	'admin_categories' => [ 'creative', 'core' ],
	'link'             => 'buttons-legacy',
	'title'            => __( 'Buttons', 'vexaltrix' ),
	'description'      => __( 'Add multiple buttons to redirect user to different webpages.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'buttons' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'buttons',
	],
];
