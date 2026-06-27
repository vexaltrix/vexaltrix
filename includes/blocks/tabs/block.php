<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/tabs';
$blockData = [
	'slug'                => '',
	'admin_categories'    => [ 'content' ],
	'link'                => 'tabs-legacy',
	'doc'                 => 'tabs-block',
	'title'               => __( 'Tabs', 'vexaltrix' ),
	'description'         => __( 'Display your content under different tabs.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'tabs' ),
	'deprecated'          => false,
	'static_dependencies' => [
		'vxt-tabs-js' => [
			'src'  => \Vexaltrix\Core\Support\ScriptsUtils::getJsUrl( 'tabs' ),
			'dep'  => [],
			'type' => 'js',
		],
	],
	'dynamic_assets'      => [
		'dir' => 'tabs',
	],
];
