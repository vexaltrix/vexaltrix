<?php
/**
 * Block Information.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/faq';
$blockData = [
	'doc'                 => 'faq-schema-or-accordion',
	'slug'                => '',
	'admin_categories'    => [ 'seo' ],
	'link'                => 'faq-schema-legacy',
	'title'               => __( 'FAQ', 'vexaltrix' ),
	'description'         => __( 'Add accordions/FAQ schema to your page.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'faq' ),
	'deprecated'          => false,
	'dynamic_assets'      => [
		'dir' => 'faq',
	],
	'static_dependencies' => [
		'vxt-faq-js' => [
			'src'  => \Vexaltrix\Support\ScriptsUtils::getJsUrl( 'faq' ),
			'dep'  => [],
			'type' => 'js',
		],
	],
];
