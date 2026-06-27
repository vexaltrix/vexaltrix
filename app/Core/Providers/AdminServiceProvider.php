<?php
/**
 * Admin service provider.
 *
 * @package Vexaltrix
 * @since x.x.x
 */

namespace Vexaltrix\Core\Providers;

use Vexaltrix\Admin\Admin;
use Vexaltrix\Admin\AdminSettings;
use Vexaltrix\Admin\DashboardHelper;
use Vexaltrix\Core\Base\ServiceProvider;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers admin services.
 *
 * @since x.x.x
 */
class AdminServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register() {
		$this->container->singleton( Admin::class, Admin::class );
		$this->container->singleton( AdminSettings::class, AdminSettings::class );
		$this->container->singleton( DashboardHelper::class, DashboardHelper::class );
	}
}
