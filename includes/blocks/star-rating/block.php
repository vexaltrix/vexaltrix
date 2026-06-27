<?php
/**
 * Block Information.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/star-rating';
$blockData = [
	'slug'             => '',
	'doc'              => 'star-rating-block',
	'admin_categories' => [ 'creative' ],
	'link'             => 'star-rating-legacy',
	'title'            => __( 'Star Ratings', 'vexaltrix' ),
	'description'      => __( 'Display customizable star ratings on your page.', 'vexaltrix' ),
	'default'          => true,
	'priority'         => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'star-rating' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'star-rating',
	],
];
