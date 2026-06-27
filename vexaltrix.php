<?php
/**
 * Plugin Name: Vexaltrix
 * Plugin URI: https://vexaltrix.com
 * Author: Huu Ha
 * Author URI: https://vexaltrix.com
 * Version: 2.19.26
 * Description: Build WordPress websites faster with Vexaltrix, a modular toolkit that lets you enable only the features you need.
 * Text Domain: 'vexaltrix'
 * Domain Path: /languages
 *
 * @package Vexaltrix
 */

define( 'VXT_FILE', __FILE__ );
define( 'VXT_ROOT', dirname( plugin_basename( VXT_FILE ) ) );
define( 'VXT_PLUGIN_NAME', 'Vexaltrix' );
define( 'VXT_PLUGIN_SHORT_NAME', 'Vexaltrix' );
define( 'WP_VXT_PRO_PLUGIN_URL', 'https://vexaltrix.com/wp/pro' );

if ( ! version_compare( PHP_VERSION, '8.1', '>=' ) ) {
	add_action( 'admin_notices', 'vxt_ultimate_gutenberg_blocks_fail_php_version' );
} elseif ( ! version_compare( get_bloginfo( 'version' ), '6.6', '>=' ) ) {
	add_action( 'admin_notices', 'vxt_ultimate_gutenberg_blocks_fail_wp_version' );
} else {
	$vxtUgbAutoload = __DIR__ . '/vendor/autoload.php';

	if ( file_exists( $vxtUgbAutoload ) ) {
		require_once $vxtUgbAutoload;
		
		// Initialize the IoC Container and resolve the Loader.
		$container = \Vexaltrix\Core\Container::getInstance();
		$container->get( \Vexaltrix\Core\Plugin::class );
	} else {
		add_action( 'admin_notices', 'vxt_ultimate_gutenberg_blocks_fail_autoload' );
	}
}

/**
 * Ultimate Addons for Gutenberg admin notice for minimum PHP version.
 *
 * Warning when the site doesn't have the minimum required PHP version.
 *
 * @since 1.8.1
 *
 * @return void
 */
function vxt_ultimate_gutenberg_blocks_fail_php_version() {
	/* translators: %s: PHP version */
	$message      = sprintf( esc_html__( 'Vexaltrix requires PHP version %s+, plugin is currently NOT RUNNING.', 'vexaltrix' ), '8.1' );
	$htmlMessage = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $htmlMessage );
}

/**
 * Vexaltrix admin notice when Composer autoloading is unavailable.
 *
 * @since x.x.x
 *
 * @return void
 */
function vxt_ultimate_gutenberg_blocks_fail_autoload() {
	$message      = esc_html__( 'Vexaltrix requires Composer autoload files. Run composer install before activating the plugin.', 'vexaltrix' );
	$htmlMessage = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $htmlMessage );
}


/**
 * Ultimate Addons for Gutenberg admin notice for minimum WordPress version.
 *
 * Warning when the site doesn't have the minimum required WordPress version.
 *
 * @since 1.8.1
 *
 * @return void
 */
function vxt_ultimate_gutenberg_blocks_fail_wp_version() {
	/* translators: %s: WordPress version */
	$message      = sprintf( esc_html__( 'Vexaltrix requires WordPress version %s+. Because you are using an earlier version, the plugin is currently NOT RUNNING.', 'vexaltrix' ), '6.6' );
	$htmlMessage = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $htmlMessage );
}
