<?php
/**
 * Vexaltrix Rollback.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * UAG Rollback.
 *
 * UAG Rollback. handler class is responsible for rolling back UAG to
 * previous version.
 *
 * @since 1.23.0
 */
class Rollback {

	/**
	 * Package URL.
	 *
	 * Holds the package URL.
	 *
	 * @since 1.23.0
	 * @access protected
	 *
	 * @var string Package URL.
	 */
	protected $packageUrl;

	/**
	 * Version.
	 *
	 * Holds the version.
	 *
	 * @since 1.23.0
	 * @access protected
	 *
	 * @var string Package URL.
	 */
	protected $version;

	/**
	 * Plugin name.
	 *
	 * Holds the plugin name.
	 *
	 * @since 1.23.0
	 * @access protected
	 *
	 * @var string Plugin name.
	 */
	protected $pluginName;

	/**
	 * Plugin slug.
	 *
	 * Holds the plugin slug.
	 *
	 * @since 1.23.0
	 * @access protected
	 *
	 * @var string Plugin slug.
	 */
	protected $pluginSlug;

	/**
	 * UAG Rollback constructor.
	 *
	 * Initializing UAG Rollback.
	 *
	 * @since 1.23.0
	 * @access public
	 *
	 * @param array $args Optional. Vexaltrix Rollback arguments. Default is an empty array.
	 */
	public function __construct( $args = [] ) {
		foreach ( $args as $key => $value ) {
			$this->{$key} = $value;
		}
	}

	/**
	 * Print inline style.
	 *
	 * Add an inline CSS to the UAG Rollback page.
	 *
	 * @since 1.23.0
	 * @access private
	 */
	private function printInlineStyle() {
		?>
		<style>
			.wrap {
				overflow: hidden;
				max-width: 850px;
				margin: auto;
				font-family: Courier, monospace;
			}

			h1 {
				background: rgb(74, 0, 224);
				text-align: center;
				color: #fff !important;
				padding: 70px !important;
				text-transform: uppercase;
				letter-spacing: 1px;
			}

			h1 img {
				max-width: 300px;
				display: block;
				margin: auto auto 50px;
			}
		</style>
		<?php
	}

	/**
	 * Apply package.
	 *
	 * Change the plugin data when WordPress checks for updates. This method
	 * modifies package data to update the plugin from a specific URL containing
	 * the version package.
	 *
	 * @since 1.23.0
	 * @access protected
	 */
	protected function applyPackage() {
		$updatePlugins = get_site_transient( 'update_plugins' );
		if ( ! is_object( $updatePlugins ) ) {
			$updatePlugins = new \stdClass();
		}

		$pluginInfo              = new \stdClass();
		$pluginInfo->new_version = $this->version;
		$pluginInfo->slug        = $this->plugin_slug;
		$pluginInfo->package     = $this->package_url;
		$pluginInfo->url         = 'https://wpvexaltrix.com/';

		$updatePlugins->response[ $this->plugin_name ] = $pluginInfo;

		set_site_transient( 'update_plugins', $updatePlugins );
	}

	/**
	 * Upgrade.
	 *
	 * Run WordPress upgrade to Vexaltrix Rollback to previous version.
	 *
	 * @since 1.23.0
	 * @access protected
	 */
	protected function upgrade() {

		require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

		$upgraderArgs = [
			'url'    => 'update.php?action=upgrade-plugin&plugin=' . rawurlencode( $this->plugin_name ),
			'plugin' => $this->plugin_name,
			'nonce'  => 'upgrade-plugin_' . $this->plugin_name,
			'title'  => __( 'Vexaltrix <p>Rollback to Previous Version</p>', 'vexaltrix' ),
		];

		$this->printInlineStyle();

		$upgrader = new \Plugin_Upgrader( new \Plugin_Upgrader_Skin( $upgraderArgs ) );
		$upgrader->upgrade( $this->plugin_name );
	}

	/**
	 * Run.
	 *
	 * Rollback UAG to previous versions.
	 *
	 * @since 1.23.0
	 * @access public
	 */
	public function run() {
		$this->applyPackage();
		$this->upgrade();
	}
}
