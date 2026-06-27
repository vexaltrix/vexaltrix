<?php
/**
 * Block Information.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/lottie';
$blockData = [
	'doc'                 => 'lottie',
	'slug'                => '',
	'admin_categories'    => [ 'creative' ],
	'link'                => 'lottie-legacy',
	'title'               => __( 'Lottie Animation', 'vexaltrix' ),
	'description'         => __( 'Add customizable lottie animation on your page.', 'vexaltrix' ),
	'default'             => true,
	'priority'            => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'lottie' ),
	'deprecated'          => false,
	'static_dependencies' => [
		'vxt-lottie-js'    => [
			'src'        => \Vexaltrix\Core\Support\ScriptsUtils::getJsUrl( 'lottie' ),
			'dep'        => [ 'vxt-bodymovin-js' ],
			'skipEditor' => true,
			'type'       => 'js',
		],
		'vxt-bodymovin-js' => [
			'type' => 'js',
		],
	],
	'dynamic_assets'      => [
		'dir' => 'lottie',
	],
];
