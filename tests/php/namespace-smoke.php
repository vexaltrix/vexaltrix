<?php
/**
 * Namespace migration smoke checks.
 *
 * @package Vexaltrix
 */

define( 'ABSPATH', __DIR__ . '/../../' );
define( 'VXT_FILE', __DIR__ . '/../../plugin.php' );

$actions = [];

function do_action( $hook ) {
	global $actions;
	$actions[ $hook ] = ( $actions[ $hook ] ?? 0 ) + 1;
}

function add_action() {}
function add_filter() {}
function register_activation_hook() {}
function register_deactivation_hook() {}
function plugin_basename( $file ) { return basename( $file ); }
function plugin_dir_path( $file ) { return dirname( $file ) . '/'; }
function plugin_dir_url( $file ) { return 'https://example.test/'; }
function plugins_url( $path, $file ) { return 'https://example.test/' . ltrim( $path, '/' ); }
function trailingslashit( $path ) { return rtrim( $path, '/' ) . '/'; }
function wp_upload_dir() { return [ 'basedir' => sys_get_temp_dir(), 'baseurl' => 'https://example.test/uploads' ]; }
function get_option( $option, $default = false ) { return $default; }
function is_admin() { return false; }
function apply_filters( $hook, $value ) { return $value; }
function esc_url( $url ) { return $url; }

require __DIR__ . '/../../vendor/autoload.php';

$expectNew = in_array( '--expect-new', $argv, true );

\Vexaltrix\Core\Plugin::getInstance();

$classes = [
	'Vexaltrix\\Core\\Container',
	'Vexaltrix\\Core\\Plugin',
	'Vexaltrix\\Presentation\\Admin\\AdminSettings',
	'Vexaltrix\\Presentation\\Admin\\DashboardHelper',
	'Vexaltrix\\Core\\Support\\Helper',
	'Vexaltrix\\Presentation\\Blocks\\BlockHelper',
	'Vexaltrix\\Presentation\\Blocks\\Block',
	'Vexaltrix\\Presentation\\Assets\\PostAssets',
	'Vexaltrix\\Transport\\Api\\RestApi',
];

foreach ( $classes as $class ) {
	if ( ! class_exists( $class ) ) {
		fwrite( STDERR, "Missing class: {$class}\n" );
		exit( 1 );
	}
}

if ( $expectNew ) {
	$container = \Vexaltrix\Core\Container::instance();
	if ( $container !== \Vexaltrix\Core\Container::getInstance() || $container !== \Vexaltrix\Core\Container::getInstance() ) {
		fwrite( STDERR, "Container singleton methods did not resolve to the same instance.\n" );
		exit( 1 );
	}

	\Vexaltrix\Core\Plugin::getInstance();
	\Vexaltrix\Core\Plugin::getInstance();

	if ( 1 !== ( $actions['vexaltrix_core_loaded'] ?? 0 ) ) {
		fwrite( STDERR, "vexaltrix_core_loaded did not fire exactly once.\n" );
		exit( 1 );
	}
}

echo "ok\n";
