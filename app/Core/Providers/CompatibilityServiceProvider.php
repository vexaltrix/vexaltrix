<?php
/**
 * Compatibility service provider.
 *
 * @package Vexaltrix
 * @since x.x.x
 */

namespace Vexaltrix\Core\Providers;

use Vexaltrix\Core\Base\ServiceProvider;
use Vexaltrix\Compatibility\FseFontsCompatibility;
use Vexaltrix\Compatibility\TwentySeventeenCompatibility;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers compatibility services.
 *
 * @since x.x.x
 */
class CompatibilityServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register() {
		$this->container->singleton( FseFontsCompatibility::class, FseFontsCompatibility::class );
		$this->container->singleton( TwentySeventeenCompatibility::class, TwentySeventeenCompatibility::class );
	}
}
