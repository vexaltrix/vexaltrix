<?php
/**
 * Container aware trait.
 *
 * @package Vexaltrix
 * @since x.x.x
 */

namespace Vexaltrix\Traits;

use Vexaltrix\Container;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Provides access to the global container.
 *
 * @since x.x.x
 */
trait ContainerAware {

	/**
	 * Get the IoC container.
	 *
	 * @return Container
	 */
	protected function container() {
		return Container::instance();
	}
}
