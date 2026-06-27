<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/team';
$blockData = [
	'doc'              => 'team',
	'slug'             => '',
	'admin_categories' => [ 'social' ],
	'link'             => 'team-legacy',
	'title'            => __( 'Team', 'vexaltrix' ),
	'description'      => __( 'Showcase your team by displaying info and social media profiles.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'team' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'team',
	],
];
