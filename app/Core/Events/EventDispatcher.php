<?php
/**
 * Event Dispatcher — internal fire/listen event system.
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
 * Lightweight event dispatcher — fire/listen pattern.
 *
 * Independent of WordPress hooks so the event system is testable
 * and portable. Optionally bridges to WP hooks via bridgeToWordPress().
 *
 * Usage:
 *   $dispatcher->listen( BlockSaved::class, function( BlockSaved $e ) { ... } );
 *   $dispatcher->fire( new BlockSaved( $blockId, $postId ) );
 *
 * @since x.x.x
 */
final class EventDispatcher {

	/**
	 * Registered listeners.
	 *
	 * @var array<class-string<EventInterface>, list<array{callback: callable, priority: int}>>
	 */
	private array $listeners = [];

	/**
	 * Whether to also fire events as WP actions.
	 *
	 * @var bool
	 */
	private bool $wpBridge = false;

	/**
	 * Register a listener for an event class.
	 *
	 * @param class-string<EventInterface> $eventClass Event class name.
	 * @param callable                      $listener   Callback fn(EventInterface): void.
	 * @param int                           $priority   Lower = earlier. Default 10.
	 * @return void
	 */
	public function listen( string $eventClass, callable $listener, int $priority = 10 ): void {
		$this->listeners[ $eventClass ][] = [
			'callback' => $listener,
			'priority' => $priority,
		];

		// Sort by priority after adding.
		usort(
			$this->listeners[ $eventClass ],
			fn( $a, $b ) => $a['priority'] <=> $b['priority']
		);
	}

	/**
	 * Fire an event — all registered listeners are called synchronously.
	 *
	 * @param EventInterface $event The event to fire.
	 * @return EventInterface The (possibly mutated) event.
	 */
	public function fire( EventInterface $event ): EventInterface {
		$class = get_class( $event );

		if ( isset( $this->listeners[ $class ] ) ) {
			foreach ( $this->listeners[ $class ] as $entry ) {
				( $entry['callback'] )( $event );
			}
		}

		// Optionally bridge to WP action for backward compat / external listeners.
		if ( $this->wpBridge ) {
			do_action( 'vexaltrix/' . $event->name(), $event );
		}

		return $event;
	}

	/**
	 * Alias for fire().
	 *
	 * @param EventInterface $event The event to dispatch.
	 * @return EventInterface
	 */
	public function dispatch( EventInterface $event ): EventInterface {
		return $this->fire( $event );
	}

	/**
	 * Check if an event has listeners.
	 *
	 * @param class-string<EventInterface> $eventClass Event class name.
	 * @return bool
	 */
	public function hasListeners( string $eventClass ): bool {
		return ! empty( $this->listeners[ $eventClass ] );
	}

	/**
	 * Enable bridging events to WordPress actions.
	 * When enabled, every fire() also calls do_action('vexaltrix/{name}', $event).
	 *
	 * @param bool $enable Whether to enable bridging.
	 * @return void
	 */
	public function bridgeToWordPress( bool $enable = true ): void {
		$this->wpBridge = $enable;
	}

	/**
	 * Remove all listeners for an event (useful in tests).
	 *
	 * @param class-string<EventInterface>|null $eventClass Null = clear all.
	 * @return void
	 */
	public function clear( ?string $eventClass = null ): void {
		if ( $eventClass === null ) {
			$this->listeners = [];
		} else {
			unset( $this->listeners[ $eventClass ] );
		}
	}
}
