<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.1.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/counter';
$blockData = [
	'doc'                 => 'counter',
	'slug'                => '',
	'admin_categories'    => [ 'content', 'post' ],
	'link'                => 'counter',
	'title'               => __( 'Counter', 'vexaltrix' ),
	'description'         => __( 'This block allows you to add number counter.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'counter' ),
	'static_dependencies' => [
		'vxt-counter-js' => [
			'src'  => \Vexaltrix\Core\Support\ScriptsUtils::getJsUrl( 'counter' ),
			'dep'  => [],
			'type' => 'js',
		],
		'vxt-countUp-js' => [
			'type' => 'js',
		],
	],
	'dynamic_assets'      => [
		'dir' => 'counter',
	],
];
