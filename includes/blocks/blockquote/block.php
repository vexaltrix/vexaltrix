<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/blockquote';
$blockData = [
	'doc'              => 'blockquote',
	'slug'             => '',
	'admin_categories' => [ 'social' ],
	'link'             => 'blockquote-legacy',
	'title'            => __( 'Blockquote', 'vexaltrix' ),
	'description'      => __( 'Display qoutes/quoted texts using blockquote.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'blockquote' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'blockquote',
	],
];
