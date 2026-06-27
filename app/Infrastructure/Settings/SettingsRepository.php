<?php
/**
 * Settings Repository — WP options-backed implementation of SettingsInterface.
 *
 * @package Vexaltrix\Infrastructure\Settings
 * @since x.x.x
 */

declare(strict_types=1);

namespace Vexaltrix\Infrastructure\Settings;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Vexaltrix\Core\Contracts\SettingsInterface;
use Vexaltrix\Core\Events\EventDispatcher;
use Vexaltrix\Infrastructure\Settings\Events\SettingChanged;

/**
 * Stores plugin settings in WP options, with schema validation
 * and event dispatch on change.
 *
 * @since x.x.x
 */
final class SettingsRepository implements SettingsInterface {

	/**
	 * Option-name prefix applied to every key.
	 *
	 * @var string
	 */
	private const PREFIX = 'vxt_wp_blocks_';

	/**
	 * In-memory cache of all settings, populated lazily.
	 *
	 * @var array<string, mixed>|null
	 */
	private ?array $cache = null;

	/**
	 * Constructor.
	 *
	 * @since x.x.x
	 *
	 * @param SettingsSchema  $schema     Schema instance for defaults and validation.
	 * @param EventDispatcher $dispatcher Event dispatcher for change notifications.
	 */
	public function __construct(
		private readonly SettingsSchema $schema,
		private readonly EventDispatcher $dispatcher,
	) {}

	/**
	 * Get a setting value.
	 *
	 * @since x.x.x
	 *
	 * @param string $key     Setting key (without prefix).
	 * @param mixed  $default Default value if not set. Falls back to schema default.
	 * @return mixed
	 */
	public function get( string $key, mixed $default = null ): mixed {
		$schemaDefault = $this->schema->defaultFor( $key );
		$fallback      = $default ?? $schemaDefault;

		return get_option( self::PREFIX . $key, $fallback );
	}

	/**
	 * Update a setting value.
	 *
	 * Validates against schema, persists, fires SettingChanged event,
	 * and invalidates the local cache.
	 *
	 * @since x.x.x
	 *
	 * @param string $key   Setting key (without prefix).
	 * @param mixed  $value New value.
	 * @return bool True on success.
	 */
	public function set( string $key, mixed $value ): bool {
		$value    = $this->schema->validate( $key, $value );
		$oldValue = $this->get( $key );
		$result   = update_option( self::PREFIX . $key, $value );

		if ( $result ) {
			$this->cache = null; // Invalidate cache.
			$this->dispatcher->dispatch(
				new SettingChanged( $key, $oldValue, $value )
			);
		}

		return $result;
	}

	/**
	 * Delete a setting.
	 *
	 * @since x.x.x
	 *
	 * @param string $key Setting key (without prefix).
	 * @return bool True on success.
	 */
	public function delete( string $key ): bool {
		$result      = delete_option( self::PREFIX . $key );
		$this->cache = null;
		return $result;
	}

	/**
	 * Get all settings as key-value array.
	 *
	 * Combines schema defaults with stored values.
	 *
	 * @since x.x.x
	 * @return array<string, mixed>
	 */
	public function all(): array {
		if ( null !== $this->cache ) {
			return $this->cache;
		}

		$all = [];
		foreach ( $this->schema->keys() as $key ) {
			$all[ $key ] = $this->get( $key );
		}

		$this->cache = $all;
		return $this->cache;
	}
}
