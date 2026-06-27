<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/advanced-heading';
$blockData = [
	'slug'             => '',
	'admin_categories' => [ 'content', 'core' ],
	'link'             => 'advanced-heading',
	'doc'              => 'advanced-heading',
	'title'            => __( 'Heading', 'vexaltrix' ),
	'description'      => __( 'Add heading, sub heading and a separator using one block.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'advanced-heading' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'advanced-heading',
	],
];
