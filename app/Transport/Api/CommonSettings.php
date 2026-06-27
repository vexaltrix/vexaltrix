<?php
/**
 * Common Settings Data Query.
 *
 * @package uag
 */

namespace Vexaltrix\Transport\Api;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Vexaltrix\Core\Base\ApiController;
use Vexaltrix\Presentation\Admin\AdminHelper;
use Vexaltrix\Presentation\Admin\AdminLearn;

/**
 * Class Admin_Query.
 */
class CommonSettings extends ApiController {

	/**
	 * Route base.
	 *
	 * @var string
	 */
	protected $rest_base = '/admin/commonsettings';

	/**
	 * Instance
	 *
	 * @access private
	 * @var object Class object.
	 * @since 1.0.0
	 */
	private static $instance;

	/**
	 * Initiator
	 *
	 * @since 1.0.0
	 * @return object initialized object of class.
	 */
	public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

	/**
	 * Init Hooks.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function registerRoutes() {

		$namespace = $this->getApiNamespace();

		// Register without trailing slash.
		register_rest_route(
			$namespace,
			$this->rest_base,
			[
				[
					'methods'             => \WP_REST_Server::READABLE,
					'callback'            => [ $this, 'getCommonSettings' ],
					'permission_callback' => [ $this, 'getItemsPermissionsCheck' ],
					'args'                => [],
				],
				'schema' => [ $this, 'get_public_item_schema' ],
			]
		);

		// Register with trailing slash.
		register_rest_route(
			$namespace,
			$this->rest_base . '/',
			[
				[
					'methods'             => \WP_REST_Server::READABLE,
					'callback'            => [ $this, 'getCommonSettings' ],
					'permission_callback' => [ $this, 'getItemsPermissionsCheck' ],
					'args'                => [],
				],
				'schema' => [ $this, 'get_public_item_schema' ],
			]
		);

		// Register learn chapters route.
		register_rest_route(
			$namespace,
			$this->rest_base . '/get-learn-chapters',
			[
				[
					'methods'             => \WP_REST_Server::READABLE,
					'callback'            => [ $this, 'getLearnChapters' ],
					'permission_callback' => [ $this, 'getItemsPermissionsCheck' ],
					'args'                => [],
				],
			]
		);

		// Register save learn progress route.
		register_rest_route(
			$namespace,
			$this->rest_base . '/update-learn-progress',
			[
				[
					'methods'             => \WP_REST_Server::CREATABLE,
					'callback'            => [ $this, 'saveLearnProgress' ],
					'permission_callback' => [ $this, 'getItemsPermissionsCheck' ],
					'args'                => [],
				],
			]
		);
	}

	/**
	 * Get learn chapters data.
	 *
	 * @param  \WP_REST_Request $request Full details about the request.
	 * @return array<int, array<string, mixed>>
	 * @since 2.19.23
	 */
	public function getLearnChapters( $request ) { // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
		return \Vexaltrix\Presentation\Admin\AdminLearn::getLearnChapters();
	}

	/**
	 * Save learn progress.
	 *
	 * @param \WP_REST_Request $request Full details about the request.
	 * @return \WP_REST_Response
	 * @since 2.19.23
	 */
	public function saveLearnProgress( $request ) {
		$rawChapter = $request->get_param( 'chapterId' );
		$rawStep    = $request->get_param( 'stepId' );
		$chapterId  = is_string( $rawChapter ) ? sanitize_text_field( $rawChapter ) : '';
		$stepId     = is_string( $rawStep ) ? sanitize_text_field( $rawStep ) : '';
		$completed   = (bool) $request->get_param( 'completed' );

		$userId        = get_current_user_id();
		$savedProgress = get_user_meta( $userId, 'vexaltrix_learn_progress', true );
		if ( ! is_array( $savedProgress ) ) {
			$savedProgress = [];
		}

		if ( ! isset( $savedProgress[ $chapterId ] ) || ! is_array( $savedProgress[ $chapterId ] ) ) {
			$savedProgress[ $chapterId ] = [];
		}

		$savedProgress[ $chapterId ][ $stepId ] = $completed;
		update_user_meta( $userId, 'vexaltrix_learn_progress', $savedProgress );

		/**
		 * Fires after Vexaltrix learn progress is saved.
		 *
		 * @since 2.19.23
		 * @param array $savedProgress Full progress data for the user, keyed by chapter id -> step id -> bool.
		 */
		do_action( 'vexaltrix_learn_progress_saved', $savedProgress );

		return new \WP_REST_Response(
			[
				'success' => true,
				'message' => __( 'Progress saved successfully.', 'vexaltrix' ),
			],
			200
		);
	}

	/**
	 * Get common settings.
	 *
	 * @param  WP_REST_Request $request Full details about the request.
	 */
	public function getCommonSettings( $request ) {

		$options = \Vexaltrix\Presentation\Admin\DashboardHelper::getOptions();

		return $options;
	}

	/**
	 * Check whether a given request has permission to read notes.
	 *
	 * @param  WP_REST_Request $request Full details about the request.
	 * @return WP_Error|boolean
	 */
	public function getItemsPermissionsCheck( $request ) {

		if ( ! current_user_can( 'manage_options' ) ) {
			return new \WP_Error( 'vxt_rest_cannot_view', __( 'Sorry, you cannot list resources.', 'vexaltrix' ), [ 'status' => rest_authorization_required_code() ] );
		}

		return true;
	}
}
