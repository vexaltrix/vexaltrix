<?php
/**
 * Integrations service provider.
 *
 * @package Vexaltrix
 * @since x.x.x
 */

namespace Vexaltrix\Core\Providers;

use Vexaltrix\Core\Base\ServiceProvider;
use Vexaltrix\Integrations\AstBlockTemplates;
use Vexaltrix\Integrations\NpsSurvey;
use Vexaltrix\Integrations\UtmAnalytics;
use Vexaltrix\Integrations\ZipwpImages;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers integration services.
 *
 * @since x.x.x
 */
class IntegrationsServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register() {
		$this->container->singleton( AstBlockTemplates::class, AstBlockTemplates::class );
		$this->container->singleton( NpsSurvey::class, NpsSurvey::class );
		$this->container->singleton( UtmAnalytics::class, UtmAnalytics::class );
		$this->container->singleton( ZipwpImages::class, ZipwpImages::class );
	}
}
