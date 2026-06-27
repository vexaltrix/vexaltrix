<?php
/**
 * Block Information.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/social-share';
$blockData = [
	'doc'              => 'social-share',
	'slug'             => '',
	'admin_categories' => [ 'social' ],
	'link'             => 'social-share-legacy',
	'title'            => __( 'Social Share', 'vexaltrix' ),
	'description'      => __( 'Share your content on different social media platforms.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'social-share' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'social-share',
	],
];
