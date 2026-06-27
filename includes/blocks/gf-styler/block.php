<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/gf-styler';
$blockData = [
	'doc'              => 'gravity-form',
	'slug'             => '',
	'admin_categories' => [ 'form' ],
	'link'             => 'gravity-form-styler-legacy',
	'title'            => __( 'Gravity Form Designer', 'vexaltrix' ),
	'description'      => __( 'Highly customize and style your forms created by Gravity Forms.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'is_active'        => class_exists( 'GFForms' ),
	'priority'         => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'gf-styler' ),
	'deprecated'       => true,
	'dynamic_assets'   => [
		'dir' => 'gf-styler',
	],
];
