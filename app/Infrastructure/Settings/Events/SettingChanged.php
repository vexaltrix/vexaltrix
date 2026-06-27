<?php
/**
 * SettingChanged event — fired when a plugin setting is updated.
 *
 * @package Vexaltrix\Infrastructure\Settings\Events
 * @since x.x.x
 */

declare(strict_types=1);

namespace Vexaltrix\Infrastructure\Settings\Events;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Vexaltrix\Core\Events\EventInterface;

/**
 * Dispatched by SettingsRepository when a setting value changes.
 *
 * Listeners can react to option changes for cache invalidation,
 * logging, or triggering side-effects.
 *
 * @since x.x.x
 */
final class SettingChanged implements EventInterface {

	/**
	 * Constructor.
	 *
	 * @since x.x.x
	 *
	 * @param string $key      Setting key (without prefix).
	 * @param mixed  $oldValue Previous value.
	 * @param mixed  $newValue New value.
	 */
	public function __construct(
		public readonly string $key,
		public readonly mixed $oldValue,
		public readonly mixed $newValue,
	) {}

	/**
	 * Unique event name.
	 *
	 * @since x.x.x
	 * @return string
	 */
	public function name(): string {
		return 'settings.changed';
	}
}
