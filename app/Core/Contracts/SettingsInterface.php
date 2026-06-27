<?php
/**
 * Settings interface — contract for settings access.
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
 * Contract for settings access.
 * Default implementation uses WP options. Plugin extensions can
 * implement for custom storage (file-based, REST-synced, etc.)
 *
 * @since x.x.x
 */
interface SettingsInterface {

	/**
	 * Get a setting value.
	 *
	 * @param string $key     Setting key (without prefix).
	 * @param mixed  $default Default value if not set.
	 * @return mixed
	 */
	public function get( string $key, mixed $default = null ): mixed;

	/**
	 * Update a setting value.
	 *
	 * @param string $key   Setting key (without prefix).
	 * @param mixed  $value New value.
	 * @return bool True on success.
	 */
	public function set( string $key, mixed $value ): bool;

	/**
	 * Delete a setting.
	 *
	 * @param string $key Setting key (without prefix).
	 * @return bool True on success.
	 */
	public function delete( string $key ): bool;

	/**
	 * Get all settings as key-value array.
	 *
	 * @return array<string, mixed>
	 */
	public function all(): array;
}
