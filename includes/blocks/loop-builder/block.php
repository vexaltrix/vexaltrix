<?php
/**
 * Block Information.
 *
 * @since 2.6.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/loop-builder';
$blockData = [
	'doc'              => 'loop-builder',
	'slug'             => '',
	'admin_categories' => [ 'content', 'post', 'pro' ],
	'link'             => 'loop-builder-legacy',
	'title'            => __( 'Loop Builder', 'vexaltrix' ),
	'description'      => __( 'This block allows you to generate custom loop from different posts.', 'vexaltrix' ), // Need to be improved.
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'loop-builder' ),
	'pro_filler'       => true,
];
