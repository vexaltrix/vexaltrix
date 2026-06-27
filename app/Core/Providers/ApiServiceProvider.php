<?php
/**
 * API service provider.
 *
 * @package Vexaltrix
 * @since x.x.x
 */

namespace Vexaltrix\Core\Providers;

use Vexaltrix\Api\RestApi;
use Vexaltrix\Core\Base\ServiceProvider;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers API services.
 *
 * @since x.x.x
 */
class ApiServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register() {
		$this->container->singleton( RestApi::class, RestApi::class );
	}
}
