<?php
/**
 * Event interface — marker contract for internal events.
 *
 * @package Vexaltrix\Core\Events
 * @since x.x.x
 */

declare(strict_types=1);

namespace Vexaltrix\Core\Events;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Marker interface for internal events.
 * Event classes carry data; listeners receive the event object.
 *
 * Plugin extensions create event classes implementing this interface,
 * then fire them via EventDispatcher.
 *
 * @since x.x.x
 */
interface EventInterface {

	/**
	 * Unique event name. Convention: 'domain.action'
	 * e.g. 'block.saved', 'module.enabled', 'settings.updated'
	 *
	 * @return string
	 */
	public function name(): string;
}
