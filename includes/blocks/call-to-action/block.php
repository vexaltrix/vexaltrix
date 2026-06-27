<?php
/**
 * Block Information.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/call-to-action';
$blockData = [
	'slug'             => '',
	'doc'              => 'call-to-action-2',
	'admin_categories' => [ 'core', 'content' ],
	'link'             => 'call-to-action-legacy',
	'title'            => __( 'Call To Action', 'vexaltrix' ),
	'description'      => __( 'Add a button along with heading and description.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'call-to-action' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'call-to-action',
	],
];
