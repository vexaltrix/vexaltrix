<?php
/**
 * Block Information.
 *
 * @since 2.6.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/popup-builder';
$blockData = [
	'doc'              => 'popup-builder',
	'slug'             => '',
	'admin_categories' => [ 'content', 'creative', 'pro' ],
	'link'             => 'popup-builder-legacy',
	'title'            => __( 'Popup Builder', 'vexaltrix' ),
	'description'      => __( 'Create eye-catching popups that can be reused sitewide!', 'vexaltrix' ),
	'default'          => true,
	'extension'        => true,
	'priority'         => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'popup-builder' ),
	'dynamic_assets'   => [
		'dir' => 'popup-builder',
	],
];
