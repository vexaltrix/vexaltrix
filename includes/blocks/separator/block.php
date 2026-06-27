<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.6.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/separator';
$blockData = [
	'doc'              => 'separator',
	'slug'             => '',
	'admin_categories' => [],
	'link'             => 'separator-legacy',
	'title'            => __( 'Separator', 'vexaltrix' ),
	'description'      => __( 'Add a modern separator to divide your page content with icon/text.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'separator' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'separator',
	],
];
