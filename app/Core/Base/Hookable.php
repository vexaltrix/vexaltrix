<?php
/**
 * Hookable base class.
 *
 * @package Vexaltrix
 * @since x.x.x
 */

namespace Vexaltrix\Core\Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Base hookable contract.
 *
 * @since x.x.x
 */
abstract class Hookable {

	/**
	 * Register WordPress hooks.
	 *
	 * @return void
	 */
	abstract public function registerHooks();
}
