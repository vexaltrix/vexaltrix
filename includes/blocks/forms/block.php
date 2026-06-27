<?php
/**
 * Block Information.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/forms';
$blockData = [
	'slug'                => '',
	'admin_categories'    => [ 'form' ],
	'link'                => 'forms-legacy',
	'doc'                 => 'uag-forms-block',
	'title'               => __( 'Form', 'vexaltrix' ),
	'description'         => __( 'Add easily customizable forms to gather information.', 'vexaltrix' ),
	'default'             => true,
	'priority'            => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'forms' ),
	'deprecated'          => false,
	'static_dependencies' => [
		'vxt-forms-js' => [
			'src'  => \Vexaltrix\Support\ScriptsUtils::getJsUrl( 'forms' ),
			'dep'  => [],
			'type' => 'js',
		],
	],
	'dynamic_assets'      => [
		'dir' => 'forms',
	],
];
