<?php
/**
 * Analytics service provider.
 *
 * @package Vexaltrix
 * @since x.x.x
 */

namespace Vexaltrix\Core\Providers;

use Vexaltrix\Core\Analytics\BlockAnalytics;
use Vexaltrix\Core\Base\ServiceProvider;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers analytics services.
 *
 * @since x.x.x
 */
class AnalyticsServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register() {
		$this->container->singleton( BlockAnalytics::class, BlockAnalytics::class );
	}
}
