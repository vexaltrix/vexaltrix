<?php
/**
 * Api Base.
 *
 * @package uag
 */

namespace Vexaltrix\Core\Base;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class \Vexaltrix\Core\Base\ApiController.
 */
abstract class ApiController extends \WP_REST_Controller {

	/**
	 * Endpoint namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'vxt-ugb/v1';

	/**
	 * Register API routes.
	 */
	public function getApiNamespace() {

		return $this->namespace;
	}
}
