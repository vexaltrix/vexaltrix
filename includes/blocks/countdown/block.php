<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.4.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/countdown';
$blockData = [
	'doc'                 => 'countdown',
	'slug'                => '',
	'admin_categories'    => [ 'creative', 'core' ],
	'link'                => 'countdown-legacy',
	'title'               => __( 'Countdown', 'vexaltrix' ),
	'description'         => __( 'This block allows you to add countdown timers.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'countdown' ),
	'static_dependencies' => [
		'vxt-countdown-js' => [
			'src'  => \Vexaltrix\Support\ScriptsUtils::getJsUrl( 'vxt-countdown' ),
			'dep'  => [],
			'type' => 'js',
		],
	],
	'dynamic_assets'      => [
		'dir' => 'countdown',
	],
];
