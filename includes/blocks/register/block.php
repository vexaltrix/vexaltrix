<?php
/**
 * Block Information & Attributes File.
 *
 * @since 2.1.0
 *
 * @package ugb
 */

$blockSlug = 'vexaltrix/register';
$blockData = [
	'doc'              => 'register',
	'slug'             => '',
	'admin_categories' => [ 'form', 'pro' ],
	'link'             => 'register-legacy',
	'title'            => __( 'Registration Form', 'vexaltrix' ),
	'description'      => __( 'This block lets you add a user register form.', 'vexaltrix' ),
	'default'          => true,
	'extension'        => false,
	'priority'         => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'register' ),
	'deprecated'       => false,
	'pro_filler'       => true,
];
