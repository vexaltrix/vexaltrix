<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/how-to';
$blockData = [
	'doc'              => 'how-to-schema',
	'slug'             => '',
	'admin_categories' => [ 'seo' ],
	'link'             => 'how-to-schema-legacy',
	'title'            => __( 'How To', 'vexaltrix' ),
	'description'      => __( 'Add instructions/steps on processes using how to block.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Core\Blocks\BlockPrioritization::getBlockPriority( 'how-to' ),
	'deprecated'       => false,
	'dynamic_assets'   => [
		'dir' => 'how-to',
	],
];
