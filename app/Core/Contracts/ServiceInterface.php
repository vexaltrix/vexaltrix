<?php
/**
 * Service interface — base contract for all auto-discovered services.
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
 * Every service in the 5 layer folders must implement this interface
 * to be auto-discovered by ServiceDiscovery.
 *
 * @since x.x.x
 */
interface ServiceInterface {

	/**
	 * Layer this service belongs to. Controls boot order.
	 *
	 * @return string 'infrastructure' | 'domain' | 'integration' | 'presentation' | 'transport'
	 */
	public static function group(): string;

	/**
	 * When to load this service.
	 *
	 * @return string 'always' | 'admin' | 'frontend' | 'cron' | 'cli' | 'rest'
	 */
	public static function context(): string;

	/**
	 * Boot priority within the group (lower = earlier). Default 10.
	 *
	 * @return int
	 */
	public static function priority(): int;

	/**
	 * Register hooks, filters, post types, etc.
	 *
	 * @return void
	 */
	public function boot(): void;
}
