<?php
/**
 * Abstract Command — base class for WP-CLI commands.
 *
 * @package Vexaltrix\Core\Base
 * @since x.x.x
 */

declare(strict_types=1);

namespace Vexaltrix\Core\Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Base class for WP-CLI commands.
 *
 * Subclasses define the command name and implement handle().
 * Registration is automatic via ServiceDiscovery (context = 'cli').
 *
 * @since x.x.x
 */
abstract class AbstractCommand {

	/**
	 * WP-CLI command name. e.g. 'vexaltrix regenerate-assets'
	 *
	 * @return string
	 */
	abstract protected function command(): string;

	/**
	 * Short description shown in `wp help`.
	 *
	 * @return string
	 */
	abstract protected function description(): string;

	/**
	 * Command handler.
	 *
	 * @param list<string>         $args      Positional arguments.
	 * @param array<string, mixed> $assocArgs Named arguments (--key=value).
	 * @return void
	 */
	abstract public function handle( array $args, array $assocArgs ): void;

	/**
	 * Register this command with WP-CLI.
	 * Called by ServiceDiscovery when context = 'cli'.
	 *
	 * @return void
	 */
	public function register(): void {
		if ( ! defined( 'WP_CLI' ) || ! WP_CLI ) {
			return;
		}

		\WP_CLI::add_command(
			$this->command(),
			[ $this, 'handle' ],
			[ 'shortdesc' => $this->description() ]
		);
	}

	// ── Helpers for subclasses ───────────────────────────────────────────

	/**
	 * Print success message.
	 *
	 * @param string $message Message.
	 * @return void
	 */
	protected function success( string $message ): void {
		\WP_CLI::success( $message );
	}

	/**
	 * Print error and exit.
	 *
	 * @param string $message Message.
	 * @return void
	 */
	protected function error( string $message ): void {
		\WP_CLI::error( $message );
	}

	/**
	 * Print log message.
	 *
	 * @param string $message Message.
	 * @return void
	 */
	protected function log( string $message ): void {
		\WP_CLI::log( $message );
	}

	/**
	 * Ask for confirmation.
	 *
	 * @param string $question Question text.
	 * @return void
	 */
	protected function confirm( string $question ): void {
		\WP_CLI::confirm( $question );
	}

	/**
	 * Create a progress bar.
	 *
	 * @param string $message Label.
	 * @param int    $count   Total items.
	 * @return \cli\progress\Bar|\WP_CLI\NoOp
	 */
	protected function progressBar( string $message, int $count ) {
		return \WP_CLI\Utils\make_progress_bar( $message, $count );
	}
}
