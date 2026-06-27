<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/inline-notice';
$blockData = [
	'doc'                 => 'inline-notice',
	'slug'                => '',
	'admin_categories'    => [ 'content' ],
	'link'                => 'inline-notice-legacy',
	'title'               => __( 'Inline Notice', 'vexaltrix' ),
	'description'         => __( 'Highlight important information using inline notice block.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'inline-notice' ),
	'deprecated'          => false,
	'static_dependencies' => [
		'vxt-inline-notice-js' => [
			'src'        => \Vexaltrix\Core\Support\ScriptsUtils::getJsUrl( 'inline-notice' ),
			'dep'        => [ 'vxt-cookie-lib' ],
			'skipEditor' => true,
			'type'       => 'js',
		],
		'vxt-cookie-lib'       => [
			'type' => 'js',
		],
	],
	'dynamic_assets'      => [
		'dir' => 'inline-notice',
	],
];
