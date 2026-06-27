<?php
/**
 * Vexaltrix Visibility.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Domain\Conditions;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class \Vexaltrix\Domain\Conditions\Visibility.
 */
class Visibility implements ServiceInterface {

	/**
	 * Member Variable
	 *
	 * @since 2.8.0
	 * @var \Vexaltrix\Domain\Conditions\Visibility|null
	 */
	private static $instance;

	/**
	 *  Initiator
	 *
	 * @since 2.8.0
	 * @return \Vexaltrix\Domain\Conditions\Visibility
	 */
	public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

	/**
	 * Constructor
	 */
	public function __construct() {

		$visibility         = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'uag_visibility_mode', 'disabled' );
		$visibilityPageId = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'uag_visibility_page', false );

		if ( 'disabled' !== $visibility && ! is_user_logged_in() && false !== $visibilityPageId && isset( $visibilityPageId ) && ! empty( $visibilityPageId ) ) {
	}
	}

	/**
	 * Set Visibility Template.
	 * 
	 * @since 2.8.0
	 * 
	 * @return string Template file path.
	 */
	public function setVisibilityTemplate() {
		return VXT_DIR . 'templates/visibility-template.php';
	}

	/**
	 * Set Visibility Page.
	 *
	 * @since 2.8.0
	 * 
	 * @return void
	 */
	public function setVisibilityPage() {
		$visibilityPageId = intval( \Vexaltrix\Presentation\Admin\AdminSettings::get( 'uag_visibility_page', false ) );

		$currentPageId = get_the_ID();

		if ( $visibilityPageId !== $currentPageId && 'publish' === get_post_status( $visibilityPageId ) ) {
			$maintenance = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'uag_visibility_mode', 'disabled' );
			if ( 'maintenance' === $maintenance ) {
				status_header( 503 );
			}

			// Output JavaScript for redirection.
			echo '<script type="text/javascript">window.location.href = "' . esc_url( get_page_link( $visibilityPageId ) ) . '";</script>';

			// Exit to prevent further processing.
			exit();
		}
	}

	/**
	 * Enqueue asset files.
	 *
	 * @since 2.8.0
	 */
	public function enqueueAssetFiles() {
		// Check if assets should be excluded for the current post type.
		if ( \Vexaltrix\Presentation\Admin\AdminSettings::shouldExcludeAssetsForCpt() ) {
			return; // Early return to prevent loading assets.
		}

		$currentPageId    = get_the_ID();
		$visibilityPageId = intval( \Vexaltrix\Presentation\Admin\AdminSettings::get( 'uag_visibility_page', false ) );

		if ( $visibilityPageId === $currentPageId ) {
			wp_enqueue_style(
				'vxt-style-visibility', // Handle.
				VXT_URL . 'assets/css/visibility.min.css',
				[],
				VXT_VER
			);
		}
	}

	/**
	 * Service group.
	 *
	 * @return string
	 */
	public static function group(): string {
		return 'domain';
	}

	/**
	 * Service context.
	 *
	 * @return string
	 */
	public static function context(): string {
		return 'always';
	}

	/**
	 * Boot priority.
	 *
	 * @return int
	 */
	public static function priority(): int {
		return 5;
	}

	/**
	 * Register actions and filters.
	 *
	 * @return void
	 */
	public function boot(): void {
			add_action( 'template_redirect', [ $this, 'setVisibilityPage' ], 99 );
			add_filter( 'template_include', [ $this, 'setVisibilityTemplate' ], 99 );
			add_action( 'wp_enqueue_scripts', [ $this, 'enqueueAssetFiles' ] );
	}

}

/**
 *  Prepare if class 'Vexaltrix\Domain\Conditions\\Visibility' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
