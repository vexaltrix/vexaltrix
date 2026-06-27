<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/table-of-contents';
$blockData = [
	'doc'                 => 'table-of-contents',
	'slug'                => '',
	'admin_categories'    => [ 'seo' ],
	'link'                => 'table-of-contents',
	'title'               => __( 'Table of Contents', 'vexaltrix' ),
	'description'         => __( 'Add a table of contents to allow page navigation.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'table-of-contents' ),
	'deprecated'          => false,
	'static_dependencies' => [
		'vxt-table-of-contents' => [
			'src'  => \Vexaltrix\Support\ScriptsUtils::getJsUrl( 'table-of-contents' ),
			'dep'  => [],
			'type' => 'js',
		],
	],
	'dynamic_assets'      => [
		'dir' => 'table-of-contents',
	],
];
