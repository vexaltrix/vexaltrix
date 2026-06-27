<?php
/**
 * AJAX service provider.
 *
 * @package Vexaltrix
 * @since x.x.x
 */

namespace Vexaltrix\Core\Providers;

use Vexaltrix\Ajax\CommonSettings;
use Vexaltrix\Core\Base\ServiceProvider;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers AJAX services.
 *
 * @since x.x.x
 */
class AjaxServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register() {
		$this->container->singleton( CommonSettings::class, CommonSettings::class );
	}
}
