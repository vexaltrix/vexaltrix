<?php
/**
 * Hookable interface — lightweight contract for hook registration.
 *
 * @package Vexaltrix\Core\Contracts
 * @since x.x.x
 */

declare(strict_types=1);

namespace Vexaltrix\Core\Contracts;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Lightweight contract for anything that registers WordPress hooks.
 * Used by Module system and plugin extensions that don't need
 * the full ServiceInterface lifecycle.
 *
 * @since x.x.x
 */
interface HookableInterface {

	/**
	 * Register WordPress actions and filters.
	 *
	 * @return void
	 */
	public function registerHooks(): void;
}
