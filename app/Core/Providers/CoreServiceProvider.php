<?php
/**
 * Core service provider.
 *
 * @package Vexaltrix
 * @since x.x.x
 */

namespace Vexaltrix\Core\Providers;

use Vexaltrix\Core\Base\ServiceProvider;
use Vexaltrix\Core\Install;
use Vexaltrix\Core\Update;
use Vexaltrix\Support\Filesystem;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers core services.
 *
 * @since x.x.x
 */
class CoreServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register() {
		$this->container->singleton( Install::class, Install::class );
		$this->container->singleton( Update::class, Update::class );
		$this->container->singleton( Filesystem::class, Filesystem::class );
	}
}
