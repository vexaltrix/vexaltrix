<?php
/**
 * Block Information.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/review';
$blockData = [
	'doc'              => 'review-schema',
	'slug'             => '',
	'admin_categories' => [ 'seo' ],
	'link'             => 'review-schema-legacy',
	'title'            => __( 'Review', 'vexaltrix' ),
	'description'      => __( 'Add reviews to items with Schema support.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'review' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'review',
	],
];
