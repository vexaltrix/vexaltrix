<?php
/**
 * Block Information & Attributes File.
 *
 * @since 1.0.0
 *
 */

$blockSlug = 'vexaltrix/login';
$blockData = [
	'slug'                => '',
	'admin_categories'    => [ 'form', 'pro' ],
	'link'                => 'login',
	'doc'                 => 'login',
	'title'               => __( 'Login Form', 'vexaltrix' ),
	'description'         => __( 'This block lets you add a user login form.', 'vexaltrix' ),
	'default'             => true,
	'extension'           => false,
	'priority'            => \Vexaltrix\Presentation\Blocks\BlockPrioritization::getBlockPriority( 'login' ),
	'static_dependencies' => [
		'vexaltrix-pro-login-js'  => [
			'src'  => \Vexaltrix\Core\Support\ScriptsUtils::getJsUrl( 'login' ),
			'dep'  => [ 'wp-escape-html' ],
			'type' => 'js',
		],
	],
	'dynamic_assets'      => [
		'dir'        => 'login'
	],
];
