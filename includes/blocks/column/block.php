<?php
/**
 * Block Information.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/column';
$blockData = [
	'slug'           => '',
	'link'           => '',
	'title'          => __( 'Column', 'vexaltrix' ),
	'description'    => __( 'Immediate child of Advanced Columns.', 'vexaltrix' ),
	'default'        => true,
	'is_child'       => true,
	'extension'      => false,
	'dynamic_assets' => [
		'dir' => 'column',
	],
	'deprecated'     => true,
];
