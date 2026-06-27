<?php
/**
 * Vexaltrix Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package Vexaltrix
 */

namespace Vexaltrix\Core\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * \Vexaltrix\Core\Blocks\InitBlocks.
 *
 * @package Vexaltrix
 */
class InitBlocks {


	/**
	 * Member Variable
	 *
	 * @var instance
	 */
	private static $instance;

	/**
	 * Member Variable
	 *
	 * @var block activation
	 */
	private $activeBlocks;

	/**
	 *  Initiator
	 */
	public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

	/**
	 * Constructor
	 */
	public function __construct() {

		// Hook: Editor assets.
		add_action( 'enqueue_block_editor_assets', [ $this, 'editorAssets' ] );

		if ( version_compare( get_bloginfo( 'version' ), '5.8', '>=' ) ) {
			add_filter( 'block_categories_all', [ $this, 'registerBlockCategory' ], 999999, 2 );
		} else {
			add_filter( 'block_categories', [ $this, 'registerBlockCategory' ], 999999, 2 );
		}

		add_action( 'wp_ajax_vxt_ultimate_gutenberg_blocks_get_taxonomy', [ $this, 'getTaxonomy' ] );

		add_action( 'wp_ajax_vxt_ultimate_gutenberg_blocks_gf_shortcode', [ $this, 'gfShortcode' ] );
		add_action( 'wp_ajax_nopriv_vxt_ultimate_gutenberg_blocks_gf_shortcode', [ $this, 'gfShortcode' ] );

		add_action( 'wp_ajax_vxt_ultimate_gutenberg_blocks_cf7_shortcode', [ $this, 'cf7Shortcode' ] );
		add_action( 'wp_ajax_nopriv_vxt_ultimate_gutenberg_blocks_cf7_shortcode', [ $this, 'cf7Shortcode' ] );

		add_action( 'wp_ajax_vxt_ultimate_gutenberg_blocks_forms_recaptcha', [ $this, 'formsRecaptcha' ] );

		// For Vexaltrix Global Block Styles.
		add_action( 'wp_ajax_uag_global_block_styles', [ $this, 'uagGlobalBlockStyles' ] );
		// For Vexaltrix Global Quick Action Bar.
		add_action( 'wp_ajax_uag_global_sidebar_enabled', [ $this, 'uagGlobalSidebarEnabled' ] );
		add_action( 'wp_ajax_uag_global_update_allowed_block', [ $this, 'uagGlobalUpdateAllowedBlock' ] );

		if ( ! is_admin() ) {
			add_action( 'renderBlock', [ $this, 'renderBlock' ], 5, 2 );

			// For Vexaltrix Global Block Styles.
			add_filter( 'renderBlock', [ $this, 'addGbsClass' ], 10, 2 );
		}

		if ( current_user_can( 'edit_posts' ) ) {
			add_action( 'wp_ajax_vxt_ultimate_gutenberg_blocks_svg_confirmation', [ $this, 'confirmSvgUpload' ] );
		}

		add_action( 'init', [ $this, 'registerPopupBuilder' ] );
		add_filter( 'srfm_enable_redirect_activation', '__return_false' );

		add_filter( 'admin_body_class', [ $this, 'addWpCompatBodyClass' ] );

		add_action( 'wp_ajax_vxt_ultimate_gutenberg_blocks_sureforms', [ $this, 'sureformsPluginActivator' ] );
		add_action( 'wp_ajax_vxt_ultimate_gutenberg_blocks_surecart', [ $this, 'surecartPluginActivator' ] );

	}


	/**
	 * Register the Popup Builder CPT.
	 *
	 * @return void
	 *
	 * @since 2.6.0
	 */
	public function registerPopupBuilder() {
		$supports = [
			'title',
			'editor',
			'custom-fields',
			'author',
		];

		$labels = [
			'name'               => _x( 'Popup Builder', 'plural', 'vexaltrix' ),
			'singular_name'      => _x( 'Vexaltrix Popup', 'singular', 'vexaltrix' ),
			'view_item'          => __( 'View Popup', 'vexaltrix' ),
			'add_new'            => __( 'Create Popup', 'vexaltrix' ),
			'add_new_item'       => __( 'Create New Popup', 'vexaltrix' ),
			'edit_item'          => __( 'Edit Popup', 'vexaltrix' ),
			'new_item'           => __( 'New Popup', 'vexaltrix' ),
			'search_items'       => __( 'Search Popups', 'vexaltrix' ),
			'not_found'          => __( 'No Popups Found', 'vexaltrix' ),
			'not_found_in_trash' => __( 'No Popups in Trash', 'vexaltrix' ),
			'all_items'          => __( 'All Popups', 'vexaltrix' ),
			'item_published'     => __( 'Popup Published', 'vexaltrix' ),
			'item_updated'       => __( 'Popup Updated', 'vexaltrix' ),
		];

		$typeArgs = [
			'supports'          => $supports,
			'labels'            => $labels,
			'public'            => false,
			'show_in_menu'      => false,
			'show_in_admin_bar' => true,
			'show_ui'           => true,
			'show_in_rest'      => true,
			'rest_base'         => 'vexaltrix-popup',
			'template_lock'     => 'all',
			'template'          => [
				[ 'vexaltrix/popup-builder', [] ],
			],
			'rewrite'           => [
				'slug'       => 'vexaltrix-popup',
				'with-front' => false,
				'pages'      => false,
			],
			'capabilities'      => [
				'edit_post'          => 'manage_options',
				'read_post'          => 'manage_options',
				'delete_post'        => 'manage_options',
				'edit_posts'         => 'manage_options',
				'edit_others_posts'  => 'manage_options',
				'publish_posts'      => 'manage_options',
				'read_private_posts' => 'manage_options',
				'delete_posts'       => 'manage_options',
				'create_posts'       => 'manage_options',
			],
		];

		$metaArgsPopupType = [
			'single'        => true,
			'type'          => 'string',
			'default'       => 'unset',
			'auth_callback' => function() {
				return current_user_can( 'manage_options' );
			},
			'show_in_rest'  => [
				'schema' => [
					'type' => 'string',
				],
			],
		];

		$metaArgsPopupEnabled = [
			'single'        => true,
			'type'          => 'boolean',
			'default'       => false,
			'auth_callback' => function() {
				return current_user_can( 'manage_options' );
			},
			'show_in_rest'  => [
				'schema' => [
					'type' => 'boolean',
				],
			],
		];

		$metaArgsPopupRepetition = [
			'single'        => true,
			'type'          => 'number',
			'default'       => 1,
			'auth_callback' => function() {
				return current_user_can( 'manage_options' );
			},
			'show_in_rest'  => [
				'schema' => [
					'type' => 'number',
				],
			],
		];

		register_post_type( 'vexaltrix-popup', $typeArgs );

		register_post_meta( 'vexaltrix-popup', 'vexaltrix-popup-type', $metaArgsPopupType );
		register_post_meta( 'vexaltrix-popup', 'vexaltrix-popup-enabled', $metaArgsPopupEnabled );
		register_post_meta( 'vexaltrix-popup', 'vexaltrix-popup-repetition', $metaArgsPopupRepetition );
		do_action( 'register_vexaltrix_pro_popup_meta' );

		$vexaltrixPopupDashboard = \Vexaltrix\BlocksConfig\PopupBuilder\PopupBuilder::createForAdmin();

		add_action( 'admin_enqueue_scripts', [ $vexaltrixPopupDashboard, 'popupToggleScripts' ] );
		add_action( 'wp_ajax_uag_update_popup_status', [ $vexaltrixPopupDashboard, 'updatePopupStatus' ] );

		do_action( 'vexaltrix_pro_popup_dashboard' );

		add_filter( 'manage_vexaltrix-popup_posts_columns', [ $vexaltrixPopupDashboard, 'popupBuilderAdminHeadings' ] );
		add_action( 'manage_vexaltrix-popup_posts_custom_column', [ $vexaltrixPopupDashboard, 'popupBuilderAdminContent' ], 10, 2 );

		// Add REST API access control for vexaltrix-popup post type.
		add_filter( 'rest_vexaltrix-popup_query', [ __CLASS__, 'filterRestPopupQuery' ], 10, 2 );
		add_filter( 'rest_prepare_vexaltrix-popup', [ __CLASS__, 'filterRestPopupResponse' ], 10, 3 );
		add_filter( 'rest_authentication_errors', [ __CLASS__, 'restrictPopupRestAccess' ], 99 );
	}

	/**
	 * Restrict REST API access to vexaltrix-popup for non-authenticated users.
	 *
	 * @param WP_Error|null|bool $result Error from another authentication handler, null if not errors, true if authenticated.
	 * @return WP_Error|null|bool Modified result.
	 *
	 * @since 2.19.18
	 */
	public static function restrictPopupRestAccess( $result ) {
		// If there's already an error, return it.
		if ( is_wp_error( $result ) ) {
			return $result;
		}

		// Only apply to vexaltrix-popup endpoints.
		$route = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
		if ( false === strpos( $route, '/wp/v2/vexaltrix-popup' ) ) {
			return $result;
		}

		// Allow authenticated admin users with manage_options.
		if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {
			return $result;
		}

		// Block unauthenticated users and non-admin users.
		return new WP_Error(
			'rest_forbidden',
			__( 'Sorry, you are not allowed to access popups.', 'vexaltrix' ),
			[ 'status' => rest_authorization_required_code() ]
		);
	}

	/**
	 * Filter REST API query to only include enabled popups for non-admin users.
	 *
	 * @param array           $args    Array of query arguments.
	 * @param WP_REST_Request $request REST request object.
	 * @return array Modified query arguments.
	 *
	 * @since 2.19.18
	 */
	public static function filterRestPopupQuery( $args, $request ) {
		// Allow admin users with manage_options to see all popups.
		if ( current_user_can( 'manage_options' ) ) {
			return $args;
		}

		// For non-admin users, only show enabled popups.
		if ( ! isset( $args['meta_query'] ) ) {
			$args['meta_query'] = []; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
		}

		$args['meta_query'][] = [
			'key'     => 'vexaltrix-popup-enabled',
			'value'   => true,
			'compare' => '=',
			'type'    => 'BOOLEAN',
		];

		return $args;
	}

	/**
	 * Filter REST API response to hide disabled popups from non-admin users.
	 *
	 * @param WP_REST_Response $response Response object.
	 * @param WP_Post          $post     Post object.
	 * @param WP_REST_Request  $request  Request object.
	 * @return WP_REST_Response|WP_Error Modified response or error.
	 *
	 * @since 2.19.18
	 */
	public static function filterRestPopupResponse( $response, $post, $request ) {
		// Allow admin users with manage_options to see all popups.
		if ( current_user_can( 'manage_options' ) ) {
			return $response;
		}

		// Check if popup is enabled.
		$popupEnabled = get_post_meta( $post->ID, 'vexaltrix-popup-enabled', true );

		// If popup is not enabled, return 403 error.
		if ( ! $popupEnabled ) {
			return new WP_Error(
				'rest_forbidden',
				__( 'You do not have permission to view this popup.', 'vexaltrix' ),
				[ 'status' => 403 ]
			);
		}

		return $response;
	}

	/**
	 * Render block.
	 *
	 * @param mixed $blockContent The block content.
	 * @param array $block The block data.
	 * @since 1.21.0
	 * @return mixed Returns the new block content.
	 */
	public function renderBlock( $blockContent, $block ) {
		// Register only UAG blocks.
		if ( ! empty( $block['blockName'] ) && strpos( $block['blockName'], 'vexaltrix/' ) !== false ) {
			// Register block on server-side to support WP Hide blocks feature introduce in WP 6.9.
			$registry = WP_Block_Type_Registry::getInstance();
			// Only register if the block is NOT already registered.
			if ( ! $registry->is_registered( $block['blockName'] ) ) {
				$registry->register( $block['blockName'], [] );
			}
		}

		if ( ! empty( $block['attrs']['UAGDisplayConditions'] ) ) {
			switch ( $block['attrs']['UAGDisplayConditions'] ) {
				case 'userstate':
					$blockContent = $this->userStateVisibility( $block['attrs'], $blockContent );
					break;

				case 'userRole':
					$blockContent = $this->userRoleVisibility( $block['attrs'], $blockContent );
					break;

				case 'browser':
					$blockContent = $this->browserVisibility( $block['attrs'], $blockContent );
					break;

				case 'os':
					$blockContent = $this->osVisibility( $block['attrs'], $blockContent );
					break;
				case 'day':
					$blockContent = $this->dayVisibility( $block['attrs'], $blockContent );
					break;
				default:
					// code...
					break;
			}
		}

		// Check if animations extension is enabled and an animation type is selected.
		if (
			'enabled' === \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_animations_extension', 'enabled' ) &&
			! empty( $block['attrs']['UAGAnimationType'] )
		) {

			$attrs                                      = $block['attrs'];
			$attrs['UAGAnimationDoNotApplyToContainer'] = isset( $attrs['UAGAnimationDoNotApplyToContainer'] ) ? $attrs['UAGAnimationDoNotApplyToContainer'] : false;
			$blockPositioning                          = ! empty( $attrs['UAGPosition'] ) && is_string( $attrs['UAGPosition'] ) ? $attrs['UAGPosition'] : false;

			// Container-specific animation attributes.
			if ( ! $attrs['UAGAnimationDoNotApplyToContainer'] ) {
				// Defaults aren't received here, hence we set them.
				// Without these defaults, empty data is sent to markup (which doesn't affect the functionality at all but still it's a good practice to follow).
				$attrs['UAGAnimationTime']   = isset( $attrs['UAGAnimationTime'] ) ? $attrs['UAGAnimationTime'] : 400;
				$attrs['UAGAnimationDelay']  = isset( $attrs['UAGAnimationDelay'] ) ? $attrs['UAGAnimationDelay'] : 0;
				$attrs['UAGAnimationEasing'] = isset( $attrs['UAGAnimationEasing'] ) ? $attrs['UAGAnimationEasing'] : 'ease';
				$attrs['UAGAnimationRepeat'] = isset( $attrs['UAGAnimationRepeat'] ) ? 'false' : 'true';

				// Container-specific animation attributes.
				$attrs['UAGAnimationDelayInterval'] = isset( $attrs['UAGAnimationDelayInterval'] ) ? $attrs['UAGAnimationDelayInterval'] : 200;

				// If this is a sticky element, don't update the attributes of this element just yet.
				if ( 'sticky' !== $blockPositioning ) {
					$aosAttributes = '<div data-aos= "' . esc_attr( $attrs['UAGAnimationType'] ) . '" data-aos-duration="' . esc_attr( $attrs['UAGAnimationTime'] ) . '" data-aos-delay="' . esc_attr( $attrs['UAGAnimationDelay'] ) . '" data-aos-easing="' . esc_attr( $attrs['UAGAnimationEasing'] ) . '" data-aos-once="' . esc_attr( $attrs['UAGAnimationRepeat'] ) . '" ';
					$blockContent  = preg_replace( '/<div /', $aosAttributes, $blockContent, 1 );
				}
			}
		}

		// Render Block Manipulation for the required Vexaltrix.
		$blockContent = apply_filters( 'vxt_ultimate_gutenberg_blocks_render_block', $blockContent, $block );

		// Render Block Manipulation for the required Vexaltrix Pro Blocks.
		$blockContent = apply_filters( 'vexaltrix_pro_render_block', $blockContent, $block );

		return $blockContent;
	}

	/**
	 * User State Visibility.
	 *
	 * @param array $blockAttributes The block data.
	 * @param mixed $blockContent The block content.
	 *
	 * @since 1.21.0
	 * @return mixed Returns the new block content.
	 */
	public function userRoleVisibility( $blockAttributes, $blockContent ) {
		if ( empty( $blockAttributes['UAGUserRole'] ) ) {
			return $blockContent;
		}

		$user = wp_get_current_user();
		return is_user_logged_in() && ! empty( $user->roles ) && in_array( $blockAttributes['UAGUserRole'], $user->roles, true ) ? '' : $blockContent;
	}

	/**
	 * User State Visibility.
	 *
	 * @param array $blockAttributes The block data.
	 * @param mixed $blockContent The block content.
	 * @since 1.21.0
	 * @return mixed Returns the new block content.
	 */
	public function osVisibility( $blockAttributes, $blockContent ) {

		if ( empty( $blockAttributes['UAGSystem'] ) ) {
			return $blockContent;
		}

		$os = [
			'iphone'   => '(iPhone)',
			'android'  => '(Android)',
			'windows'  => 'Win16|(Windows 95)|(Win95)|(Windows_95)|(Windows 98)|(Win98)|(Windows NT 5.0)|(Windows 2000)|(Windows NT 5.1)|(Windows XP)|(Windows NT 5.2)|(Windows NT 6.0)|(Windows Vista)|(Windows NT 6.1)|(Windows 7)|(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)|Windows ME',
			'open_bsd' => 'OpenBSD',
			'sun_os'   => 'SunOS',
			'linux'    => '(Linux)|(X11)',
			'mac_os'   => '(Mac_PowerPC)|(Macintosh)',
		];

		$userAgent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ) : '';

		return isset( $os[ $blockAttributes['UAGSystem'] ] ) && preg_match( '@' . $os[ $blockAttributes['UAGSystem'] ] . '@', $userAgent ) ? '' : $blockContent;
	}

	/**
	 * User State Visibility.
	 *
	 * @param array $blockAttributes The block data.
	 * @param mixed $blockContent The block content.
	 *
	 * @since 1.21.0
	 * @return mixed Returns the new block content.
	 */
	public function browserVisibility( $blockAttributes, $blockContent ) {

		if ( empty( $blockAttributes['Vexaltrixrowser'] ) ) {
			return $blockContent;
		}

		$userAgent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? \Vexaltrix\Support\Helper::getBrowserName( sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ) ) : '';

		return $blockAttributes['Vexaltrixrowser'] === $userAgent ? '' : $blockContent;
	}

	/**
	 * User State Visibility.
	 *
	 * @param array $blockAttributes The block data.
	 * @param mixed $blockContent The block content.
	 *
	 * @since 1.21.0
	 * @return mixed Returns the new block content.
	 */
	public function userStateVisibility( $blockAttributes, $blockContent ) {

		if ( ! empty( $blockAttributes['UAGLoggedIn'] ) && is_user_logged_in() ) {
			return '';
		}

		if ( ! empty( $blockAttributes['UAGLoggedOut'] ) && ! is_user_logged_in() ) {
			return '';
		}

		return $blockContent;

	}

	/**
	 * Day Visibility.
	 *
	 * @param array $blockAttributes The block data.
	 * @param mixed $blockContent The block content.
	 *
	 * @since 2.1.3
	 * @return mixed Returns the new block content.
	 */
	public function dayVisibility( $blockAttributes, $blockContent ) {

		// If not set restriction.
		if ( empty( $blockAttributes['UAGDay'] ) ) {
			return $blockContent;
		}

		$currentDay = strtolower( current_datetime()->format( 'l' ) );
		// Check in restricted day.
		return ! in_array( $currentDay, $blockAttributes['UAGDay'] ) ? $blockContent : '';

	}

	/**
	 * Ajax call to get Taxonomy List.
	 *
	 * @since 2.0.0
	 */
	public function getTaxonomy() {

		$responseData = [
			'messsage' => __( 'User is not authenticated!', 'vexaltrix' ),
		];

		if ( ! current_user_can( 'edit_posts' ) ) {
			wp_send_json_error( $responseData );
		}

		check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_ajax_nonce', 'nonce' );

		$postTypes = \Vexaltrix\Support\Helper::getPostTypes();

		$returnArray = [];

		foreach ( $postTypes as $key => $value ) {
			$postType = $value['value'];

			$taxonomies = get_object_taxonomies( $postType, 'objects' );
			$data       = [];

			$getTaxonomyNames = get_post_type_object( $postType ); // Renaming this variable to follow proper naming convention.
			foreach ( $taxonomies as $taxSlug => $tax ) {
				if ( ! $tax->public || ! $tax->show_ui || ! $tax->show_in_rest ) {
					continue;
				}

				$data[ $taxSlug ] = $tax;

				$terms = get_terms( $taxSlug );

				$relatedTaxTerms = [];

				if ( ! empty( $terms ) ) {
					foreach ( $terms as $tIndex => $tObj ) {
						$relatedTaxTerms[] = [
							'id'            => $tObj->term_id,
							'name'          => $tObj->name,
							'count'         => $tObj->count,
							'link'          => get_term_link( $tObj->term_id ),
							'singular_name' => $getTaxonomyNames ? $getTaxonomyNames->labels->singular_name : 'Post',
							'plural_name'   => $getTaxonomyNames ? $getTaxonomyNames->labels->name : 'Posts', // Adding this field to use it on the editor.
						];
					}

					$returnArray[ $postType ]['terms'][ $taxSlug ] = $relatedTaxTerms;
				}

				$newcategoriesList = get_terms(
					$taxSlug,
					[
						'hide_empty' => true,
						'parent'     => 0,
					]
				);

				$relatedTax = [];

				if ( ! empty( $newcategoriesList ) ) {
					foreach ( $newcategoriesList as $tIndex => $tObj ) {
						$childArg     = [
							'hide_empty' => true,
							'parent'     => $tObj->term_id,
						];
						$childCat     = get_terms( $taxSlug, $childArg );
						$childCatArr = $childCat ? $childCat : null;
						$relatedTax[] = [
							'id'            => $tObj->term_id,
							'name'          => $tObj->name,
							'count'         => $tObj->count,
							'link'          => get_term_link( $tObj->term_id ),
							'singular_name' => $getTaxonomyNames ? $getTaxonomyNames->labels->singular_name : 'Post',
							'plural_name'   => $getTaxonomyNames ? $getTaxonomyNames->labels->name : 'Posts', // Adding this field to use it on the editor.
							'children'      => $childCatArr,
						];

					}

					$returnArray[ $postType ]['without_empty_taxonomy'][ $taxSlug ] = $relatedTax;

				}

				$newcategoriesListEmptyTax = get_terms(
					$taxSlug,
					[
						'hide_empty' => false,
						'parent'     => 0,
					]
				);

				$relatedTaxEmptyTax = [];

				if ( ! empty( $newcategoriesListEmptyTax ) ) {
					foreach ( $newcategoriesListEmptyTax as $tIndex => $tObj ) {
						$childArgEmptyTax     = [
							'hide_empty' => false,
							'parent'     => $tObj->term_id,
						];
						$childCatEmptyTax     = get_terms( $taxSlug, $childArgEmptyTax );
						$childCatEmptyTaxArr = $childCatEmptyTax ? $childCatEmptyTax : null;
						$relatedTaxEmptyTax[] = [
							'id'            => $tObj->term_id,
							'name'          => $tObj->name,
							'count'         => $tObj->count,
							'link'          => get_term_link( $tObj->term_id ),
							'singular_name' => $getTaxonomyNames ? $getTaxonomyNames->labels->singular_name : 'Post',
							'plural_name'   => $getTaxonomyNames ? $getTaxonomyNames->labels->name : 'Posts', // Adding this field to use it on the editor.
							'children'      => $childCatEmptyTaxArr,
						];
					}

					$returnArray[ $postType ]['with_empty_taxonomy'][ $taxSlug ] = $relatedTaxEmptyTax;

				}
			}
			$returnArray[ $postType ]['taxonomy'] = $data;

		}

		wp_send_json_success( apply_filters( 'vxt_ultimate_gutenberg_blocks_taxonomies_list', $returnArray ) );
	}

	/**
	 * Renders the Gravity Form shortcode.
	 *
	 * @since 1.12.0
	 */
	public function gfShortcode() {

		check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_ajax_nonce', 'nonce' );

		$id = isset( $_POST['formId'] ) ? intval( $_POST['formId'] ) : 0;

		if ( $id && 0 !== $id && -1 !== $id ) {
			$data['html'] = do_shortcode( '[gravityforms id="' . $id . '" ajax="true"]' );
		} else {
			$data['html'] = '<p>' . __( 'Please select a valid Gravity Form.', 'vexaltrix' ) . '</p>';
		}
		wp_send_json_success( $data );
	}

	/**
	 * Renders the forms recaptcha keys.
	 *
	 * @since 2.0.0
	 */
	public function formsRecaptcha() {

		$responseData = [
			'messsage' => __( 'User is not authenticated!', 'vexaltrix' ),
		];

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( $responseData );
		}

		check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_ajax_nonce', 'nonce' );
		// security validation done in later stage.
		$value = isset( $_POST['value'] ) ? json_decode( wp_unslash( $_POST['value'] ), true ) : []; // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		if ( ! is_array( $value ) ) {
			$value = [];
		}

		\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( 'uag_recaptcha_secret_key_v2', sanitize_text_field( $value['reCaptchaSecretKeyV2'] ) );
		\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( 'uag_recaptcha_secret_key_v3', sanitize_text_field( $value['reCaptchaSecretKeyV3'] ) );
		\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( 'uag_recaptcha_site_key_v2', sanitize_text_field( $value['reCaptchaSiteKeyV2'] ) );
		\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( 'uag_recaptcha_site_key_v3', sanitize_text_field( $value['reCaptchaSiteKeyV3'] ) );

		$responseData = [
			'messsage' => __( 'Successfully saved data!', 'vexaltrix' ),
		];
		wp_send_json_success( $responseData );

	}

	/**
	 * Renders the Sure Form.
	 *
	 * @since 2.19.0
	 * @return void
	 */
	public function sureformsPluginActivator() {
		// Check user capability.
		if ( ! ( current_user_can( 'activate_plugins' ) && current_user_can( 'install_plugins' ) ) ) {
			wp_send_json_error(
				[
					'success' => false,
					'message' => 'User is not authenticated!',
				] 
			);
		}

		// Verify nonce.
		if ( ! check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_ajax_nonce', 'security', false ) ) {
			wp_send_json_error(
				[
					'success' => false,
					'message' => 'Invalid nonce.',
				] 
			);
		}

		$installedPlugins   = get_plugins();
		$statusOfSureforms = isset( $installedPlugins['sureforms/sureforms.php'] ) 
			? ( is_plugin_active( 'sureforms/sureforms.php' ) ? 'active' : 'inactive' ) 
			: 'not-installed';

		if ( class_exists( '\BSF_UTM_Analytics\Inc\Utils' ) && is_callable( '\BSF_UTM_Analytics\Inc\Utils::update_referer' ) ) {
			// If the plugin is found and the update_referer function is callable, update the referer with the corresponding product slug.
			\BSF_UTM_Analytics\Inc\Utils::update_referer( 'vexaltrix', 'sureforms' );
		}

		// If plugin is not installed, install it first.
		if ( 'not-installed' === $statusOfSureforms ) {
			include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
			include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

			$pluginSlug = 'sureforms';
			$pluginData = plugins_api( 'plugin_information', [ 'slug' => $pluginSlug ] );

			// Check if $pluginData is valid and contains the download_link property.
			if ( is_wp_error( $pluginData ) || ! is_object( $pluginData ) || empty( $pluginData->download_link ) ) {
				wp_send_json_error(
					[
						'success' => false,
						'message' => 'Error fetching plugin data.',
					] 
				);
			}

			if ( is_object( $pluginData ) || is_array( $pluginData ) ) {
				$downloadLink = ( is_object( $pluginData ) && isset( $pluginData->download_link ) ) ? $pluginData->download_link : '';
				$skin          = new WP_Ajax_Upgrader_Skin();
				$upgrader      = new Plugin_Upgrader( $skin );
				$installed     = $upgrader->install( $downloadLink );

				if ( is_wp_error( $installed ) ) {
					wp_send_json_error(
						[
							'success' => false,
							'message' => 'Failed to install the plugin.',
						] 
					);
				}
			}

			$installedPlugins   = get_plugins();
			$statusOfSureforms = isset( $installedPlugins['sureforms/sureforms.php'] ) ? 'inactive' : 'not-installed';
		}

		// If the plugin is installed but inactive, activate it.
		if ( 'inactive' === $statusOfSureforms ) {
			$activate = activate_plugin( 'sureforms/sureforms.php', '', false, false );

			if ( is_wp_error( $activate ) ) {
				wp_send_json_error(
					[
						'success' => false,
						'message' => $activate->get_error_message(),
					] 
				);
			}

			wp_send_json_success(
				[
					'success' => true,
					'message' => 'Plugin successfully activated.',
				] 
			);
		}

		// If already active, send a success message.
		if ( 'active' === $statusOfSureforms ) {
			wp_send_json_success(
				[
					'success' => true,
					'message' => 'Plugin is already active.',
				] 
			);
		}

		// If no condition matches, send an error response.
		wp_send_json_error(
			[
				'success' => false,
				'message' => 'Unexpected error occurred.',
			] 
		);
	}

	/**
	 * Renders the Sure Form.
	 *
	 * @since 2.19.0
	 * @return void
	 */
	public function surecartPluginActivator() {
		// Check user capability.
		if ( ! ( current_user_can( 'activate_plugins' ) && current_user_can( 'install_plugins' ) ) ) {
			wp_send_json_error(
				[
					'success' => false,
					'message' => 'User is not authenticated!',
				] 
			);
		}

		// Verify nonce.
		if ( ! check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_ajax_nonce', 'security', false ) ) {
			wp_send_json_error(
				[
					'success' => false,
					'message' => 'Invalid nonce.',
				] 
			);
		}

		$installedPlugins  = get_plugins();
		$statusOfSurecart = isset( $installedPlugins['surecart/surecart.php'] ) 
			? ( is_plugin_active( 'surecart/surecart.php' ) ? 'active' : 'inactive' ) 
			: 'not-installed';

		if ( class_exists( '\BSF_UTM_Analytics\Inc\Utils' ) && is_callable( '\BSF_UTM_Analytics\Inc\Utils::update_referer' ) ) {
			// If the plugin is found and the update_referer function is callable, update the referer with the corresponding product slug.
			\BSF_UTM_Analytics\Inc\Utils::update_referer( 'vexaltrix', 'surecart' );
		}

		// If plugin is not installed, install it first.
		if ( 'not-installed' === $statusOfSurecart ) {
			include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
			include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

			$pluginSlug = 'surecart';
			$pluginData = plugins_api( 'plugin_information', [ 'slug' => $pluginSlug ] );

			if ( is_wp_error( $pluginData ) || ! is_object( $pluginData ) || empty( $pluginData->download_link ) ) {
				wp_send_json_error(
					[
						'success' => false,
						'message' => 'Error fetching plugin data.',
					] 
				);
			}

			if ( is_object( $pluginData ) || is_array( $pluginData ) ) {
				$downloadLink = ( is_object( $pluginData ) && isset( $pluginData->download_link ) ) ? $pluginData->download_link : '';
				$skin          = new WP_Ajax_Upgrader_Skin();
				$upgrader      = new Plugin_Upgrader( $skin );
				$installed     = $upgrader->install( $downloadLink );

				if ( is_wp_error( $installed ) ) {
					wp_send_json_error(
						[
							'success' => false,
							'message' => 'Failed to install the plugin.',
						] 
					);
				}
			}

			$installedPlugins  = get_plugins();
			$statusOfSurecart = isset( $installedPlugins['surecart/surecart.php'] ) ? 'inactive' : 'not-installed';
		}

		// If the plugin is installed but inactive, activate it.
		if ( 'inactive' === $statusOfSurecart ) {
			$activate = activate_plugin( 'surecart/surecart.php' );
			if ( is_wp_error( $activate ) ) {
				wp_send_json_error(
					[
						'success' => false,
						'message' => $activate->get_error_message(),
					] 
				);
			}

			wp_send_json_success(
				[
					'success' => true,
					'message' => 'Plugin successfully activated.',
				] 
			);
		}

		// If already active, send a success message.
		if ( 'active' === $statusOfSurecart ) {
			wp_send_json_success(
				[
					'success' => true,
					'message' => 'Plugin is already active.',
				] 
			);
		}

		// If no condition matches, send an error response.
		wp_send_json_error(
			[
				'success' => false,
				'message' => 'Unexpected error occurred.',
			] 
		);
	}

	/**
	 * Renders the Contect Form 7 shortcode.
	 *
	 * @since 1.10.0
	 */
	public function cf7Shortcode() {

		check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_ajax_nonce', 'nonce' );

		$id = isset( $_POST['formId'] ) ? intval( $_POST['formId'] ) : 0;

		if ( $id && 0 !== $id && -1 !== $id ) {
			$data['html'] = do_shortcode( '[contact-form-7 id="' . $id . '" ajax="true"]' );
		} else {
			$data['html'] = '<p>' . __( 'Please select a valid Contact Form 7.', 'vexaltrix' ) . '</p>';
		}
		wp_send_json_success( $data );
	}

	/**
	 * Gutenberg block category for Vexaltrix.
	 *
	 * @param array  $categories Block categories.
	 * @param object $post Post object.
	 * @since 1.0.0
	 */
	public function registerBlockCategory( $categories, $post ) {
		$categories = array_merge(
			[
				[
					'slug'  => 'uagb',
					'title' => __( 'Vexaltrix', 'vexaltrix' ),
				],
			],
			$categories
		);
		// Define the new category to be added.
		$newCategory = [
			'slug'  => 'extension',
			'title' => __( 'Extensions', 'vexaltrix' ),
			'icon'  => '',
		];

		// Find the index where the new category should be inserted.
		$insertAfterSlug = 'vexaltrix-pro'; // Default insertion point.
		$insertIndex      = false;

		// Look for the 'vexaltrix-pro' category.
		foreach ( $categories as $index => $category ) {
			if ( $insertAfterSlug === $category['slug'] ) {
				$insertIndex = $index + 1;
				break;
			}
		}

		// If 'vexaltrix-pro' is not found, look for 'uagb'.
		if ( false === $insertIndex ) {
			$insertAfterSlug = 'uagb';
			foreach ( $categories as $index => $category ) {
				if ( $insertAfterSlug === $category['slug'] ) {
					$insertIndex = $index + 1;
					break;
				}
			}
		}

		// If neither is found, append the new category at the end.
		if ( false === $insertIndex ) {
			$categories[] = $newCategory;
		} else {
			array_splice( $categories, $insertIndex, 0, [ $newCategory ] );
		}

		return $categories;
	}

	/**
	 * Localize SVG icon scripts in chunks.
	 * Ex - if 1800 icons available so we will localize 4 variables for it.
	 *
	 * @since 2.7.0
	 * @return void
	 */
	public function addSvgIconAssets() {
		$localizeIconChunks = \Vexaltrix\Support\Helper::backendLoadFontAwesomeIcons();
		if ( ! $localizeIconChunks ) {
			return;
		}

		foreach ( $localizeIconChunks as $chunkIndex => $value ) {
			wp_localize_script( 'vxt-block-editor-js', "vxt_ultimate_gutenberg_blocks_svg_icons_{$chunkIndex}", $value );
		}
	}

	/**
	 * Get the status of a plugin.
	 * This function is used internally in the editor upsell scripts to check if Vexaltrix Pro is installed or not.
	 *
	 * @since 2.19.2
	 *
	 * @param  string $pluginInitFile Plugin init file.
	 * @return string
	 */
	public static function getPluginStatus( $pluginInitFile ) {

		$installedPlugins = get_plugins();

		if ( ! isset( $installedPlugins[ $pluginInitFile ] ) ) {
			return 'Install';
		} elseif ( is_plugin_active( $pluginInitFile ) ) {
			return 'Activated';
		} else {
			return 'Installed';
		}
	}

	/**
	 * Add a version-independent body class for WP >= 6.9 compat CSS.
	 *
	 * Replaces version-specific body classes (version-6-9, version-6-9-1)
	 * with a single class that persists across future WordPress updates.
	 *
	 * @since 2.19.22
	 *
	 * @param string $classes Admin body classes.
	 * @return string Modified admin body classes.
	 */
	public function addWpCompatBodyClass( $classes ) {
		if ( version_compare( get_bloginfo( 'version' ), '6.9', '>=' ) ) {
			$classes .= ' vexaltrix-wp-gte-6-9';
		}
		return $classes;
	}

	/**
	 * Enqueue Gutenberg block assets for backend editor.
	 *
	 * @since 1.0.0
	 */
	public function editorAssets() {
		// Check if assets should be excluded for the current post type.
		if ( \Vexaltrix\Admin\AdminSettings::shouldExcludeAssetsForCpt() ) {
			return; // Early return to prevent loading assets.
		}

		$vxtUltimateGutenbergBlocksAjaxNonce = wp_create_nonce( 'vxt_ultimate_gutenberg_blocks_ajax_nonce' );

		$scriptDepPath = VXT_DIR . 'assets/build/blocks.asset.php';
		$scriptInfo     = file_exists( $scriptDepPath )
			? include $scriptDepPath
			: [
				'dependencies' => [],
				'version'      => VXT_VER,
			];
		global $pagenow;

		$scriptDep = array_merge( $scriptInfo['dependencies'], [ 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-components', 'wp-api-fetch' ] );

		if ( 'widgets.php' !== $pagenow ) {
			$scriptDep = array_merge( $scriptInfo['dependencies'], [ 'wp-editor' ] );
		}

		$jsExt = ( SCRIPT_DEBUG ) ? '.js' : '.min.js';

		wp_enqueue_code_editor( [ 'type' => 'text/css' ] );
		wp_enqueue_script( 'wp-theme-plugin-editor' );
		wp_enqueue_style( 'wp-codemirror' );

		// Scripts.
		$blocksScript = file_exists( VXT_DIR . 'assets/build/blocks.min.js' ) ? 'blocks.min.js' : 'blocks.js';
		wp_enqueue_script(
			'vxt-block-editor-js', // Handle.
			VXT_URL . 'assets/build/' . $blocksScript,
			$scriptDep, // Dependencies, defined above.
			$scriptInfo['version'], // VXT_VER.
			true // Enqueue the script in the footer.
		);

		wp_set_script_translations( 'vxt-block-editor-js', 'vexaltrix' );

		// Common Editor style.
		wp_enqueue_style(
			'vxt-block-common-editor-css', // Handle.
			VXT_URL . 'assets/build/common-editor.css', // Block editor CSS.
			[ 'wp-edit-blocks' ], // Dependency to include the CSS after it.
			VXT_VER
		);

		wp_localize_script( 'vxt-block-editor-js', 'ugb_react', [ 'pro_plugin_status' => self::getPluginStatus( 'vexaltrix-pro/vexaltrix-pro.php' ) ] );

		wp_enqueue_script( 'vxt-deactivate-block-js', VXT_URL . 'assets/admin/blocks-deactivate.js', [ 'wp-blocks' ], VXT_VER, true );

		$blocks       = [];
		$savedBlocks = \Vexaltrix\Admin\AdminSettings::get( '_vxt_ultimate_gutenberg_blocks_blocks' );

		if ( is_array( $savedBlocks ) ) {
			foreach ( $savedBlocks as $slug => $data ) {

				$slug       = 'vexaltrix/' . $slug;
				$blocksInfo = \Vexaltrix\Core\Blocks\BlockModule::getBlocksInfo();

				if ( ! isset( $blocksInfo[ $slug ] ) ) {
					continue;
				}

				$currentBlock = $blocksInfo[ $slug ];

				if ( isset( $currentBlock['is_child'] ) && $currentBlock['is_child'] ) {
					continue;
				}

				if ( isset( $currentBlock['is_active'] ) && ! $currentBlock['is_active'] ) {
					continue;
				}

				if ( isset( $savedBlocks[ $slug ] ) ) {
					if ( 'disabled' === $savedBlocks[ $slug ] ) {
						array_push( $blocks, $slug );
					}
				}
			}
		}

		wp_localize_script(
			'vxt-deactivate-block-js',
			'vxt_ultimate_gutenberg_blocks_deactivate_blocks',
			[
				'deactivated_blocks' => $blocks,
			]
		);
		$displayCondition            = \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_block_condition', 'enabled' );
		$displayResponsiveCondition = \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_block_responsive', 'enabled' );

		$enableSelectedFonts = \Vexaltrix\Admin\AdminSettings::get( 'uag_load_select_font_globally', 'disabled' );
		$selectedFonts        = [];

		if ( 'enabled' === $enableSelectedFonts ) {

			/**
			 * Selected fonts variable
			 *
			 * @var array
			 */
			$selectedFonts = \Vexaltrix\Admin\AdminSettings::get( 'uag_select_font_globally', [] );

			if ( ! empty( $selectedFonts ) ) {
				usort(
					$selectedFonts,
					function( $a, $b ) {
						return strcmp( $a['label'], $b['label'] );
					}
				);

				$defaultSelected = [
					[
						'value' => 'Default',
						'label' => __( 'Default', 'vexaltrix' ),
					],
				];
				$selectedFonts   = array_merge( $defaultSelected, $selectedFonts );
			}
		}

		$vxtUltimateGutenbergBlocksExcludeBlocksFromExtension = [ 'core/archives', 'core/calendar', 'core/latest-comments', 'core/tag-cloud', 'core/rss' ];

		$contentWidth = \Vexaltrix\Admin\AdminSettings::getGlobalContentWidth();


		$containerPadding = \Vexaltrix\Admin\AdminSettings::get( 'uag_container_global_padding', 'default' );

		if ( 'default' === $containerPadding ) {
			\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( 'uag_container_global_padding', 10 );
			$containerPadding = 10;
		}

		$containerElementsGap = \Vexaltrix\Admin\AdminSettings::get( 'uag_container_global_elements_gap', 20 );
		$screen                 = get_current_screen();

		$uagEnableQuickActionSidebar = apply_filters( 'uag_enable_quick_action_sidebar', \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_quick_action_sidebar', 'enabled' ) );

		// An array of all the required Vexaltrix Admin URLs.
		$vexaltrixAdminUrls = [
			'settings' => [
				'editor_enhancements' => admin_url( 'admin.php?page=vexaltrix&path=settings&settings=editor-enhancements' ),
			],
		];

		$inheritFromTheme               = 'deleted' !== \Vexaltrix\Admin\AdminSettings::get( 'uag_btn_inherit_from_theme_fallback', 'deleted' ) ? 'disabled' : \Vexaltrix\Admin\AdminSettings::get( 'uag_btn_inherit_from_theme', 'disabled' );
		$astraThemeSettingsAvailable   = defined( 'ASTRA_THEME_SETTINGS' );
		$astraThemeBodyTextDecoration = $astraThemeSettingsAvailable && function_exists( 'astra_get_font_extras' ) && function_exists( 'astra_get_option' ) ? astra_get_font_extras( astra_get_option( 'body-font-extras' ), 'text-decoration' ) : '';
		$installedPlugins                = get_plugins();
		$status                           = isset( $installedPlugins['vexaltrix-pro/vexaltrix-pro.php'] ) 
					? ( is_plugin_active( 'vexaltrix-pro/vexaltrix-pro.php' ) 
						? 'active' 
						: 'inactive' ) 
					: 'not-installed';
		$statusOfSurecart               = isset( $installedPlugins['surecart/surecart.php'] ) 
					? ( is_plugin_active( 'surecart/surecart.php' ) 
						? 'active' 
						: 'inactive' ) 
					: 'not-installed';
		$statusOfSureforms              = isset( $installedPlugins['sureforms/sureforms.php'] ) 
					? ( is_plugin_active( 'sureforms/sureforms.php' ) 
						? 'active' 
						: 'inactive' ) 
					: 'not-installed';

		$localizedParams = [
			'cf7_is_active'                           => class_exists( 'WPCF7_ContactForm' ),
			'gf_is_active'                            => class_exists( 'GFForms' ),
			'category'                                => 'uagb',
			'premium_category'                        => 'extension',
			'ajax_url'                                => admin_url( 'admin-ajax.php' ),
			'vexaltrix_admin_urls'                      => $vexaltrixAdminUrls,
			'cf7_forms'                               => $this->getCf7Forms(),
			'gf_forms'                                => $this->getGravityForms(),
			'tablet_breakpoint'                       => VXT_TABLET_BREAKPOINT,
			'mobile_breakpoint'                       => VXT_MOBILE_BREAKPOINT,
			'image_sizes'                             => \Vexaltrix\Support\Helper::getImageSizes(),
			'post_types'                              => \Vexaltrix\Support\Helper::getPostTypes(),
			'vxt_ultimate_gutenberg_blocks_ajax_nonce'                         => $vxtUltimateGutenbergBlocksAjaxNonce,
			'vxt_ultimate_gutenberg_blocks_svg_confirmation_nonce'             => current_user_can( 'edit_posts' ) ? wp_create_nonce( 'vxt_ultimate_gutenberg_blocks_confirm_svg_nonce' ) : '',
			'svg_confirmation'                        => current_user_can( 'edit_posts' ) ? get_option( 'vexaltrix_svg_confirmation' ) : '',
			'vxt_ultimate_gutenberg_blocks_home_url'                           => home_url(),
			'user_role'                               => $this->getUserRole(),
			'vxt_ultimate_gutenberg_blocks_url'                                => VXT_URL,
			'vxt_ultimate_gutenberg_blocks_mime_type'                          => \Vexaltrix\Support\Helper::getMimeType(),
			'vxt_ultimate_gutenberg_blocks_site_url'                           => VXT_URI,
			'enableConditions'                        => apply_filters_deprecated( 'enableBlockCondition', [ $displayCondition ], '1.23.4', 'uag_enable_block_condition' ),
			'enableConditionsForCoreBlocks'           => apply_filters( 'enable_block_condition_for_core', true ),
			'enableResponsiveConditionsForCoreBlocks' => apply_filters( 'enable_responsive_condition_for_core', true ),
			'enableMasonryGallery'                    => apply_filters( 'uag_enable_masonry_gallery', \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_masonry_gallery', 'enabled' ) ),
			'enableQuickActionSidebar'                => $uagEnableQuickActionSidebar,
			'enableAnimationsExtension'               => apply_filters( 'uag_enable_animations_extension', \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_animations_extension', 'enabled' ) ),
			'enableResponsiveConditions'              => apply_filters( 'enableBlockResponsive', \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_block_responsive', 'enabled' ) ),
			'number_of_icon_chunks'                   => \Vexaltrix\Support\Helper::$numberOfIconChunks,
			'vxt_ultimate_gutenberg_blocks_enable_extensions_for_blocks'       => apply_filters( 'vxt_ultimate_gutenberg_blocks_enable_extensions_for_blocks', [] ),
			'vxt_ultimate_gutenberg_blocks_exclude_blocks_from_extension'      => $vxtUltimateGutenbergBlocksExcludeBlocksFromExtension,
			'uag_load_select_font_globally'           => $enableSelectedFonts,
			'uag_select_font_globally'                => $selectedFonts,
			'vxt_ultimate_gutenberg_blocks_old_user_less_than_2'               => get_option( 'vxt-old-user-less-than-2' ),
			'collapsePanels'                         => \Vexaltrix\Admin\AdminSettings::get( 'uag_collapse_panels', 'enabled' ),
			'enableLegacyBlocks'                    => \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_legacy_blocks' ),
			'copyPaste'                              => \Vexaltrix\Admin\AdminSettings::get( 'uag_copy_paste', 'enabled' ),
			'enableOnPageCssButton'               => \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_on_page_css_button', 'yes' ),
			'contentWidth'                           => $contentWidth,
			'containerGlobalPadding'                => $containerPadding,
			'container_elements_gap'                  => $containerElementsGap,
			'recaptchaSiteKeyV2'                   => \Vexaltrix\Admin\AdminSettings::get( 'uag_recaptcha_site_key_v2', '' ),
			'recaptchaSiteKeyV3'                   => \Vexaltrix\Admin\AdminSettings::get( 'uag_recaptcha_site_key_v3', '' ),
			'recaptchaSecretKeyV2'                 => '', // Secret keys removed from client-side — used server-side only.
			'recaptchaSecretKeyV3'                 => '', // Secret keys removed from client-side — used server-side only.
			'blocksEditorSpacing'                   => apply_filters( 'vxt_ultimate_gutenberg_blocks_default_blocks_editor_spacing', \Vexaltrix\Admin\AdminSettings::get( 'uag_blocks_editor_spacing', 0 ) ),
			'loadFontAwesome5'                     => \Vexaltrix\Admin\AdminSettings::get( 'uag_load_font_awesome_5' ),
			'autoBlockRecovery'                     => \Vexaltrix\Admin\AdminSettings::get( 'uag_auto_block_recovery' ),
			'font_awesome_5_polyfill'                 => [],
			'vexaltrix_custom_fonts'                    => apply_filters( 'vexaltrix_system_fonts', [] ),
			'vexaltrix_pro_status'                      => $status,
			'vexaltrix_custom_css_example'              => __(
				'Use custom class added in block\'s advanced settings to target your desired block. Examples:
		.my-class {text-align: center;} // my-class is a custom selector',
				'vexaltrix'
			),
			'is_rtl'                                  => is_rtl(),
			'instaLinkedAccounts'                   => \Vexaltrix\Admin\AdminSettings::get( 'uag_insta_linked_accounts', [] ),
			'instaAllUsersMedia'                   => apply_filters( 'uag_instagram_transients', [] ),
			'is_site_editor'                          => $screen->id,
			'current_post_id'                         => get_the_ID(),
			'btnInheritFromTheme'                  => \Vexaltrix\Admin\AdminSettings::get( 'uag_btn_inherit_from_theme', 'disabled' ),
			'btn_inherit_from_theme_fallback'         => $inheritFromTheme,
			'wp_version'                              => get_bloginfo( 'version' ),
			'isBlockTheme'                          => \Vexaltrix\Admin\AdminSettings::isBlockTheme(),
			'is_customize_preview'                    => is_customize_preview(),
			'uag_enable_gbs_extension'                => \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_gbs_extension', 'enabled' ),
			'current_theme'                           => wp_get_theme()->get( 'Name' ),
			'is_gutenberg_activated'                  => is_plugin_active( 'gutenberg/gutenberg.php' ), // TODO: Once Gutenberg merged the rename functionality code in WP then we need to remove localization part for is_gutenberg_activated.
			'header_titlebar_status'                  => \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_header_titlebar', 'enabled' ),
			'is_astra_based_theme'                    => $astraThemeSettingsAvailable,
			'astra_body_text_decoration'              => $astraThemeBodyTextDecoration,
			// creating an array of iframe names to ignore and checking against that array.
			// Add more iframe names to ignore, this is done by using the 'vexaltrix_exclude_crops_iframes' filter.
			'exclude_crops_iframes'                   => apply_filters( 'vexaltrix_exclude_crops_iframes', [ '__privateStripeMetricsController8690' ] ),
			'status_of_sureforms'                     => $statusOfSureforms,
			'status_of_surecart'                      => $statusOfSurecart,
			'docsUrl'                                 => \Vexaltrix\Admin\AdminSettings::getProUrl( '/docs/', 'free-plugin', 'vxt-editor-page', 'vxt-plugin' ),
			'upsellModalEditor'                       => \Vexaltrix\Admin\AdminSettings::getProUrl( '/pricing/', 'free-plugin', 'vexaltrix-editor', 'upsell-popup-view-plan' ),
			'contry_code'                             => \Vexaltrix\Admin\AdminSettings::getUserCountryCode(),
		];

		wp_localize_script(
			'vxt-block-editor-js',
			'vxt_ultimate_gutenberg_blocks_blocks_info',
			$localizedParams
		);

		// Enqueue the assets for editor upsells.
		wp_enqueue_style(
			'vexaltrix-upsell-banner-tailwind-style',
			VXT_URL . 'assets/build/blocks.css',
			[],
			VXT_VER
		);

		// To match the editor with frontend.
		// Scripts Dependency.
		\Vexaltrix\Support\ScriptsUtils::enqueueBlocksDependencyBoth();
		// Style.
		\Vexaltrix\Support\ScriptsUtils::enqueueBlocksStyles();
		// RTL Styles.
		\Vexaltrix\Support\ScriptsUtils::enqueueBlocksRtlStyles();

		// Add svg icons in chunks.
		$this->addSvgIconAssets();
	}

	/**
	 *  Get the User Roles
	 *
	 *  @since 1.21.0
	 */
	public function getUserRole() {

		$fieldOptions = [];

		$roleLists = wp_roles()->get_names();

		$fieldOptions[0] = [
			'value' => '',
			'label' => __( 'None', 'vexaltrix' ),
		];

		foreach ( $roleLists as $key => $roleList ) {
			$fieldOptions[] = [
				'value' => $key,
				'label' => $roleList,
			];
		}

		return $fieldOptions;
	}

	/**
	 * Function to integrate CF7 Forms.
	 *
	 * @since 1.10.0
	 */
	public function getCf7Forms() {
		$fieldOptions = [];

		if ( class_exists( 'WPCF7_ContactForm' ) ) {
			$args             = [
				'post_type'      => 'wpcf7_contact_form',
				'posts_per_page' => -1,
			];
			$forms            = get_posts( $args );
			$fieldOptions[0] = [
				'value' => -1,
				'label' => __( 'Select Form', 'vexaltrix' ),
			];
			if ( $forms ) {
				foreach ( $forms as $form ) {
					$fieldOptions[] = [
						'value' => $form->ID,
						'label' => $form->post_title,
					];
				}
			}
		}

		if ( empty( $fieldOptions ) ) {
			$fieldOptions = [
				'-1' => __( 'You have not added any Contact Form 7 yet.', 'vexaltrix' ),
			];
		}
		return $fieldOptions;
	}

	/**
	 * Returns all gravity forms with ids
	 *
	 * @since 1.12.0
	 * @return array Key Value paired array.
	 */
	public function getGravityForms() {
		$fieldOptions = [];

		if ( class_exists( 'GFForms' ) ) {
			$forms            = RGFormsModel::get_forms( null, 'title' );
			$fieldOptions[0] = [
				'value' => -1,
				'label' => __( 'Select Form', 'vexaltrix' ),
			];
			if ( is_array( $forms ) ) {
				foreach ( $forms as $form ) {
					$fieldOptions[] = [
						'value' => $form->id,
						'label' => $form->title,
					];
				}
			}
		}

		if ( empty( $fieldOptions ) ) {
			$fieldOptions = [
				'-1' => __( 'You have not added any Gravity Forms yet.', 'vexaltrix' ),
			];
		}

		return $fieldOptions;
	}

	/**
	 * Ajax call to confirm add users confirmation option in database
	 *
	 * @return void
	 * @since 2.4.0
	 */
	public function confirmSvgUpload() {
		check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_confirm_svg_nonce', 'svg_nonce' );
		if ( empty( $_POST['confirmation'] ) || 'yes' !== sanitize_text_field( $_POST['confirmation'] ) ) {
			wp_send_json_error( [ 'message' => __( 'Invalid request', 'vexaltrix' ) ] );
		}

		update_option( 'vexaltrix_svg_confirmation', 'yes' );
		wp_send_json_success();
	}

	/**
	 * Add Global Block Styles Class.
	 *
	 * @param string $blockContent The block content.
	 * @param array  $block The block data.
	 * @since 2.9.0
	 * @return mixed Returns the new block content.
	 */
	public function addGbsClass( $blockContent, $block ) {
		if ( empty( $block['blockName'] ) || ! is_string( $block['blockName'] ) || false === strpos( $block['blockName'], 'vexaltrix/' ) || empty( $block['attrs']['globalBlockStyleId'] ) || empty( $block['attrs']['block_id'] ) ) {
			return $blockContent;
		}

		// Check if GBS is enabled.
		$gbsStatus = \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_gbs_extension', 'enabled' );

		$styleName       = $block['attrs']['globalBlockStyleId'];
		$styleClassName = 'vexaltrix-gbs-' . $styleName;

		// If GBS extension is disabled then add static class name.
		if ( 'disabled' === $gbsStatus ) {
			$blockSlug      = str_replace( 'vexaltrix/', '', $block['blockName'] );
			$className       = 'vexaltrix-gbs-vxt-gbs-default-' . $blockSlug;
			$styleClassName = $className;
		}

		$blockId = 'vxt-block-' . $block['attrs']['block_id'];

		// Replace the block id with the block id and the style class name.
		$replacementString = esc_attr( $blockId ) . ' ' . esc_attr( $styleClassName );
		$html               = str_replace( $blockId, $replacementString, $blockContent );

		return $html;
	}

	/**
	 * Function to save enable/disable data.
	 *
	 * @since 2.12.0
	 * @return void
	 */
	public function uagGlobalSidebarEnabled() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error();
		}

		if ( ! check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_ajax_nonce', 'security', false ) ) {
			wp_send_json_error();
		}

		if ( ! empty( $_POST['enableQuickActionSidebar'] ) ) {
			$vexaltrixEnableQuickActionSidebar = ( 'enabled' === $_POST['enableQuickActionSidebar'] ? 'enabled' : 'disabled' );
			\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( 'uag_enable_quick_action_sidebar', $vexaltrixEnableQuickActionSidebar );
			wp_send_json_success();
		}
		wp_send_json_error();
	}

	/**
	 * Function to save allowed block data.
	 *
	 * @since 2.12.0
	 * @return void
	 */
	public function uagGlobalUpdateAllowedBlock() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error();
		}

		if ( ! check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_ajax_nonce', 'security', false ) ) {
			wp_send_json_error();
		}

		if ( ! empty( $_POST['defaultAllowedQuickSidebarBlocks'] ) ) {
			$vexaltrixDefaultAllowedQuickSidebarBlocks = json_decode( wp_unslash( sanitize_text_field( $_POST['defaultAllowedQuickSidebarBlocks'] ) ), true );
			\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( 'vxt_ultimate_gutenberg_blocks_quick_sidebar_allowed_blocks', $vexaltrixDefaultAllowedQuickSidebarBlocks );
			wp_send_json_success();
		}
		wp_send_json_error();
	}

	/**
	 * Function to save Vexaltrix Global Block Styles data.
	 *
	 * @since 2.9.0
	 * @return void
	 */
	public function uagGlobalBlockStyles() {
		// Check if gbs enabled or not.
		if ( 'enabled' !== \Vexaltrix\Admin\AdminSettings::get( 'uag_enable_gbs_extension', 'enabled' ) ) {
			wp_send_json_error();
		}


		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error();
		}

		if ( ! check_ajax_referer( 'vxt_ultimate_gutenberg_blocks_ajax_nonce', 'security', false ) ) {
			wp_send_json_error();
		}

		$responseData = [ 'messsage' => __( 'No post data found!', 'vexaltrix' ) ];

		if ( empty( $_POST['vexaltrixGlobalStyles'] ) ) {
			wp_send_json_error( $responseData );
		}

		$globalBlockStyles = json_decode( wp_unslash( sanitize_text_field( $_POST['vexaltrixGlobalStyles'] ) ), true );

		if ( ! empty( $_POST['bulkUpdateStyles'] ) && 'no' !== $_POST['bulkUpdateStyles'] ) {
			update_option( 'vexaltrix_global_block_styles', $globalBlockStyles );
			wp_send_json_success( $globalBlockStyles );
		}

		if ( empty( $_POST ) || empty( $_POST['attributes'] ) || empty( $_POST['blockName'] ) || empty( $_POST['postId'] ) || empty( $_POST['vexaltrixGlobalStyles'] ) || ! is_array( $globalBlockStyles ) ) {
			wp_send_json_error( $responseData );
		}

		$globalBlockStyles = is_array( $globalBlockStyles ) ? $globalBlockStyles : [];
		$blockAttr          = [];

		$postId = sanitize_text_field( $_POST['postId'] );
		// Not sanitizing this array because $_POST['attributes'] is a very large array of different types of attributes.
		foreach ( $globalBlockStyles as $key => $style ) {
			if ( ! empty( $_POST['globalBlockStyleId'] ) && ! empty( $style['value'] ) && $style['value'] === $_POST['globalBlockStyleId'] ) {
				$blockAttr = $style['attributes'];

				if ( ! $blockAttr ) {
					wp_send_json_error( $responseData );
					break;
				}

				$blockSlug = str_replace( 'vexaltrix/', '', sanitize_text_field( $_POST['blockName'] ) );
				$blockCss  = \Vexaltrix\Core\Blocks\BlockModule::getFrontendCss( $blockSlug, $blockAttr, $blockAttr['block_id'], true );

				$desktop = '';
				$tablet  = '';
				$mobile  = '';

				$tabStylingCss = '';
				$mobStylingCss = '';
				$desktop        .= $blockCss['desktop'];
				$tablet         .= $blockCss['tablet'];
				$mobile         .= $blockCss['mobile'];
				if ( ! empty( $tablet ) ) {
					$tabStylingCss .= '@media only screen and (max-width: ' . VXT_TABLET_BREAKPOINT . 'px) {';
					$tabStylingCss .= $tablet;
					$tabStylingCss .= '}';
				}

				if ( ! empty( $mobile ) ) {
					$mobStylingCss .= '@media only screen and (max-width: ' . VXT_MOBILE_BREAKPOINT . 'px) {';
					$mobStylingCss .= $mobile;
					$mobStylingCss .= '}';
				}
				$blockCss                                    = $desktop . $tabStylingCss . $mobStylingCss;
				$globalBlockStyles[ $key ]['frontendStyles'] = $blockCss;
				$gbsStored                                    = get_option( 'vexaltrix_global_block_styles', [] );
				$gbsStoredKeyValue                          = is_array( $gbsStored ) && isset( $gbsStored[ $key ] ) ? $gbsStored[ $key ] : [];

				if ( ! empty( $gbsStoredKeyValue['post_ids'] ) ) {
					$globalBlockStyles[ $key ]['post_ids'] = array_merge( $globalBlockStyles[ $key ]['post_ids'], $gbsStoredKeyValue['post_ids'] );
				}

				// For FSE template slug.
				if ( ! empty( $gbsStoredKeyValue['page_template_slugs'] ) ) {
					$globalBlockStyles[ $key ]['page_template_slugs'] = array_merge( $globalBlockStyles[ $key ]['page_template_slugs'], $gbsStoredKeyValue['page_template_slugs'] );
				}

				// For global styles (  widget and customize area ).
				if ( ! empty( $gbsStoredKeyValue['styleForGlobal'] ) ) {
					$globalBlockStyles[ $key ]['styleForGlobal'] = array_merge( $globalBlockStyles[ $key ]['styleForGlobal'], $gbsStoredKeyValue['styleForGlobal'] );
				}

				update_option( 'vexaltrix_global_block_styles', $globalBlockStyles );

				if ( ! empty( $globalBlockStyles[ $key ]['post_ids'] ) && is_array( $globalBlockStyles[ $key ]['post_ids'] ) ) {
					foreach ( $globalBlockStyles[ $key ]['post_ids'] as $postId ) {
						\Vexaltrix\Support\Helper::deletePageAssets( $postId );
					}
				}
			}
		}

		$vexaltrixGbsGoogleFonts = get_option( 'vexaltrix_gbs_google_fonts', [] );

		// Global Font Families.
		$fontFamilies = [];
		foreach ( $blockAttr as $name => $attribute ) {
			if ( false !== strpos( $name, 'Family' ) && '' !== $attribute ) {

				$fontFamilies[] = $attribute;
			}
		}

		if ( isset( $blockAttr['globalBlockStyleId'] ) && is_array( $vexaltrixGbsGoogleFonts ) ) {
			$vexaltrixGbsGoogleFonts[ $blockAttr['globalBlockStyleId'] ] = $fontFamilies;
			if ( isset( $vexaltrixGbsGoogleFonts[ $blockAttr['globalBlockStyleId'] ] ) && is_array( $vexaltrixGbsGoogleFonts[ $blockAttr['globalBlockStyleId'] ] ) ) {
				$vexaltrixGbsGoogleFonts[ $blockAttr['globalBlockStyleId'] ] = array_unique( $vexaltrixGbsGoogleFonts[ $blockAttr['globalBlockStyleId'] ] );
			}
		}

		update_option( 'vexaltrix_gbs_google_fonts', $vexaltrixGbsGoogleFonts );

		if ( ! empty( $_POST['globalBlockStylesFontFamilies'] ) ) {
			$vexaltrixGbsGoogleFontsEditor = json_decode( wp_unslash( sanitize_text_field( $_POST['globalBlockStylesFontFamilies'] ) ), true );
			update_option( 'vexaltrix_gbs_google_fonts_editor', $vexaltrixGbsGoogleFontsEditor );
		}

		wp_send_json_success( $globalBlockStyles );
	}
}

/**
 *  Prepare if class 'Vexaltrix\\Core\\Blocks\\InitBlocks' exist.
 *  Kicking this off by calling 'get_instance()' method
 */
