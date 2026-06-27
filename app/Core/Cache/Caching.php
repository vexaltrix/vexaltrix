<?php
/**
 * Vexaltrix Caching.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Core\Cache;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use SiteGround_Optimizer\Options\Options;
use SiteGround_Optimizer\File_Cacher\File_Cacher;

/**
 * Class \Vexaltrix\Core\Cache\Caching.
 *
 * @since 2.10.1
 */
class Caching {

	/**
	 * Member Variable
	 *
	 * @since 2.10.1
	 * @var \Vexaltrix\Core\Cache\Caching|null
	 */
	private static $instance;

	/**
	 *  Initiator
	 *
	 * @since 2.10.1
	 * @return \Vexaltrix\Core\Cache\Caching
	 */
	public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

	/**
	 * Constructor
	 *
	 * @since 2.10.1
	 */
	public function __construct() {
		add_action( 'vxt_ultimate_gutenberg_blocks_delete_uag_asset_dir', [ $this, 'clearCache' ] );
		add_action( 'vxt_ultimate_gutenberg_blocks_delete_page_assets', [ $this, 'clearCache' ] );
	}

	/**
	 * Clears the cache.
	 *
	 * @since 2.10.1
	 * @return void
	 */
	public function clearCache() {
		self::clearSitegroundCache();
		self::clearCloudwaysCache();
	}

	/**
	 * Clears the SiteGround cache.
	 *
	 * @since 2.10.1
	 * @return void
	 */
	public static function clearSitegroundCache() {
		if ( ! class_exists( 'SiteGround_Optimizer\Options\Options' ) || ! class_exists( 'SiteGround_Optimizer\File_Cacher\File_Cacher' ) ) {
			return;
		}

		if ( Options::is_enabled( 'siteground_optimizer_file_caching' ) ) {
			File_Cacher::getInstance()->purge_everything();
		}
	}

	/**
	 * This function helps to purge all cache in clodways envirnoment.
	 * In presence of Breeze plugin (https://wordpress.org/plugins/breeze/)
	 *
	 * @since 2.11.0
	 * @return void
	 */
	public static function clearCloudwaysCache() {
		if ( ! class_exists( 'Breeze_Configuration' ) || ! class_exists( 'Breeze_CloudFlare_Helper' ) || ! class_exists( 'Breeze_Admin' ) ) {
			return;
		}

		// clear varnish cache.
		$admin = new Breeze_Admin();
		$admin->breeze_clear_varnish();

		// clear static cache.
		Breeze_Configuration::breeze_clean_cache();
		Breeze_CloudFlare_Helper::reset_all_cache();
	}
}

/**
 *  Prepare if class 'Vexaltrix\\Core\\Cache\\Caching' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
