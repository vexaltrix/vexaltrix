<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.4.1
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/instagram-feed';
$blockData = [
	'doc'              => 'instagram-feed',
	'slug'             => '',
	'admin_categories' => [ 'social', 'pro' ],
	'link'             => 'instagram-feed-legacy',
	'title'            => __( 'Instagram Feed', 'vexaltrix' ),
	'description'      => __( 'This block allows you to add Instagram Feeds.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'instagram-feed' ),
	'pro_filler'       => true,
];
