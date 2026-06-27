<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/marketing-button';
$blockData = [
	'doc'              => 'marketing-button',
	'slug'             => '',
	'admin_categories' => [ 'creative' ],
	'link'             => 'marketing-button-legacy',
	'title'            => __( 'Marketing Button', 'vexaltrix' ),
	'description'      => __( 'Add a marketing call to action button with a short description.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'marketing-button' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'marketing-button',
	],
];
