<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.6.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/animations-extension';
$blockData = [
	'slug'                => '',
	'title'               => __( 'Animations Extension', 'vexaltrix' ),
	'description'         => __( 'Add animations to Vexaltrix blocks.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => true,
	'attributes'          => [],
	'deprecated'          => false,
	'static_dependencies' => [
		'vxt-aos-js'       => [
			'src'  => \Vexaltrix\Support\ScriptsUtils::getJsUrl( 'aos' ),
			'dep'  => [],
			'type' => 'js',
		],
		'vxt-aos-css'      => [
			'type' => 'css',
		],
		'vxt-animation-js' => [
			'src'        => \Vexaltrix\Support\ScriptsUtils::getJsUrl( 'vexaltrix-animations' ),
			'dep'        => [ 'vxt-aos-js' ],
			'type'       => 'js',
			'skipEditor' => true,
		],
	],
];
