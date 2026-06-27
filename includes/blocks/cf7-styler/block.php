<?php
/**
 * Block Information.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/cf7-styler';
$blockData = [
	'doc'              => 'contact-form-7-styler',
	'slug'             => '',
	'admin_categories' => [ 'form' ],
	'link'             => 'contact-form-7-styler-legacy',
	'title'            => __( 'Contact Form 7 Designer', 'vexaltrix' ),
	'description'      => __( 'Highly customize and style your Contact Form 7 forms.', 'vexaltrix' ),
	'is_active'        => class_exists( 'WPCF7_ContactForm' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'cf7-styler' ),
	'deprecated'       => true,
	'dynamic_assets'   => [
		'dir' => 'cf7-styler',
	],
];
