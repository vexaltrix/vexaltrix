<?php
/**
 * ModulesController — REST endpoints for listing & toggling modules.
 *
 * GET  /wp-json/vexaltrix/v1/modules          → list all modules with status
 * POST /wp-json/vexaltrix/v1/modules/{slug}/enable   → enable a module
 * POST /wp-json/vexaltrix/v1/modules/{slug}/disable  → disable a module
 *
 * @package Vexaltrix\API
 * @author  Huu Ha <huuhadev@gmail.com>
 * @link    https://vexaltrix.com
 */
declare(strict_types=1);

namespace Vexaltrix\Transport\Api;

use Vexaltrix\Core\Module\ModuleRegistry;
use Vexaltrix\Core\Base\ApiController;
use WP_REST_Request;
use WP_REST_Response;
use WP_Error;

class ModulesController extends ApiController {

    protected $namespace = 'vexaltrix/v1';
    protected $rest_base = 'modules';

    public function __construct( private readonly ModuleRegistry $registry ) {}

    public function registerRoutes(): void {
        // GET /vexaltrix/v1/modules
        register_rest_route( $this->namespace, '/modules', [
            'methods'             => \WP_REST_Server::READABLE,
            'callback'            => [ $this, 'index' ],
            'permission_callback' => [ $this, 'permissionsCheck' ],
        ] );

        // POST /vexaltrix/v1/modules/{slug}/enable
        register_rest_route( $this->namespace, '/modules/(?P<slug>[a-z0-9-]+)/enable', [
            'methods'             => \WP_REST_Server::CREATABLE,
            'callback'            => [ $this, 'enable' ],
            'permission_callback' => [ $this, 'permissionsCheck' ],
            'args'                => [ 'slug' => [ 'required' => true, 'type' => 'string' ] ],
        ] );

        // POST /vexaltrix/v1/modules/{slug}/disable
        register_rest_route( $this->namespace, '/modules/(?P<slug>[a-z0-9-]+)/disable', [
            'methods'             => \WP_REST_Server::CREATABLE,
            'callback'            => [ $this, 'disable' ],
            'permission_callback' => [ $this, 'permissionsCheck' ],
            'args'                => [ 'slug' => [ 'required' => true, 'type' => 'string' ] ],
        ] );
    }

    /**
     * GET /vexaltrix/v1/modules
     */
    public function index( WP_REST_Request $request ): WP_REST_Response {
        return rest_ensure_response( [
            'modules' => array_values( $this->registry->status() ),
        ] );
    }

    /**
     * POST /vexaltrix/v1/modules/{slug}/enable
     */
    public function enable( WP_REST_Request $request ): WP_REST_Response|WP_Error {
        $slug   = sanitize_key( $request->get_param( 'slug' ) );
        $result = $this->registry->enable( $slug );

        if ( is_wp_error( $result ) ) {
            return $result;
        }

        return rest_ensure_response( [
            'success' => true,
            'module'  => $this->registry->status()[ $slug ] ?? null,
        ] );
    }

    /**
     * POST /vexaltrix/v1/modules/{slug}/disable
     */
    public function disable( WP_REST_Request $request ): WP_REST_Response|WP_Error {
        $slug   = sanitize_key( $request->get_param( 'slug' ) );
        $result = $this->registry->disable( $slug );

        if ( is_wp_error( $result ) ) {
            return $result;
        }

        return rest_ensure_response( [
            'success' => true,
            'module'  => $this->registry->status()[ $slug ] ?? null,
        ] );
    }

    /**
     * Default permission check — requires manage_options.
     *
     * @return bool|\WP_Error
     */
    public function permissionsCheck(): bool|\WP_Error {
        if ( ! current_user_can( 'manage_options' ) ) {
            return new \WP_Error(
                'vexaltrix_forbidden',
                __( 'You do not have permission to perform this action.', 'vexaltrix' ),
                [ 'status' => 403 ]
            );
        }

        return true;
    }
}
