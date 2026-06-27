<?php
/**
 * Block Information.
 *
 * @since 2.4.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/icon';
$blockData = [
	'doc'              => 'icon',
	'slug'             => '',
	'admin_categories' => [ 'core' ],
	'link'             => 'icon',
	'title'            => __( 'Icon', 'vexaltrix' ),
	'description'      => __( 'Add stunning customizable icons to your website.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'icon' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'icon',
	],
];
