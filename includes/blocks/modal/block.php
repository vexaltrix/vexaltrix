<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.2.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/modal';
$blockData = [
	'doc'                 => 'modal',
	'slug'                => '',
	'admin_categories'    => [ 'content', 'post' ],
	'link'                => 'modal-legacy',
	'title'               => __( 'Modal', 'vexaltrix' ),
	'description'         => __( 'This block allows you to add modal popup.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'modal' ),
	'static_dependencies' => [
		'vxt-modal-js' => [
			'src'  => \Vexaltrix\Core\Support\ScriptsUtils::getJsUrl( 'modal' ),
			'dep'  => [],
			'type' => 'js',
		],
	],
	'dynamic_assets'      => [
		'dir' => 'modal',
	],
];
