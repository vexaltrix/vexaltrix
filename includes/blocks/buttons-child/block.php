<?php
/**
 * Block Information.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/buttons-child';
$blockData = [
	'slug'                => '',
	'link'                => '',
	'title'               => __( 'Button', 'vexaltrix' ),
	'description'         => __( 'Customize this button as per your need.', 'vexaltrix' ),
	'default'             => true,
	'is_child'            => true,
	'extension'           => false,
	'dynamic_assets'      => [
		'dir' => 'buttons-child',
	],
	'deprecated'          => false,
	'static_dependencies' => [
		'vxt-button-child-js' => [
			'src'  => \Vexaltrix\Support\ScriptsUtils::getJsUrl( 'vxt-button-child' ),
			'dep'  => [],
			'type' => 'js',
		],
	],
];
