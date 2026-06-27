<?php
/**
 * Block Information.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/social-share-child';
$blockData = [
	'slug'           => '',
	'link'           => '',
	'title'          => __( 'Social Share Child', 'vexaltrix' ),
	'description'    => __( 'Share your content on this social media platform.', 'vexaltrix' ),
	'default'        => true,
	'is_child'       => true,
	'extension'      => false,
	'dynamic_assets' => [
		'dir' => 'social-share-child',
	],
	'deprecated'     => false,
];
