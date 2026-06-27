<?php
/**
 * Vexaltrix Rest API.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Transport\Api;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Transport\Api\\RestApi' ) ) {

	/**
	 * Class \Vexaltrix\Transport\Api\RestApi.
	 */
	final class RestApi implements ServiceInterface {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 */
		public function __construct() {


			// Activation hook.

			// We have added this action here to support both the ways of post updations, Rest API & Normal.
			// Adding this action to delete post assets if the post is moved to trash.
			global $wpCustomize;
			if ( $wpCustomize ) { // Check whether the $wpCustomize is set.
	} else {
				add_action( 'rest_after_save_widget', [ $this, 'afterWidgetSaveAction' ] ); // Update the assets on widget save.
			}

		}

		/**
		 * Function to delete post assets.
		 *
		 * @param int $postId post_id of deleted post.
		 * @since 2.13.1
		 * @return void 
		 */
		public function deletePageAssetsOnTrash( $postId ) {
			
				$cssAssetInfo = \Vexaltrix\Core\Support\ScriptsUtils::getAssetInfo( 'css', $postId );
				$jsAssetInfo  = \Vexaltrix\Core\Support\ScriptsUtils::getAssetInfo( 'js', $postId );

				$cssFilePath = $cssAssetInfo['css'];
				$jsFilePath  = $jsAssetInfo['js'];

			if ( file_exists( $cssFilePath ) ) {
				wp_delete_file( $cssFilePath );
			}
			if ( file_exists( $jsFilePath ) ) {
				wp_delete_file( $jsFilePath );
			}
		}

		/**
		 * Function to load assets for post/page in customizer before gutenberg rendering.
		 *
		 * @param array $block Block data.
		 *
		 * @since 2.0.13
		 *
		 * @return array New block data.
		 */
		public function contentPreRender( $block ) {
			$tabStylingCss  = '';
			$mobStylingCss  = '';
			$postAssets = new \Vexaltrix\Presentation\Assets\PostAssets( get_the_ID() );

			$assets = $postAssets->getBlockCssAndJs( $block );

			$desktopCss = isset( $assets['css']['desktop'] ) ? $assets['css']['desktop'] : '';

			if ( ! empty( $assets['css']['tablet'] ) ) {
				$tabStylingCss .= '@media only screen and (max-width: ' . VXT_TABLET_BREAKPOINT . 'px) {';
				$tabStylingCss .= $assets['css']['tablet'];
				$tabStylingCss .= '}';
			}

			if ( ! empty( $assets['css']['mobile'] ) ) {
				$mobStylingCss .= '@media only screen and (max-width: ' . VXT_MOBILE_BREAKPOINT . 'px) {';
				$mobStylingCss .= $assets['css']['mobile'];
				$mobStylingCss .= '}';
			}

			$blockCssStyle = $desktopCss . $tabStylingCss . $mobStylingCss;

			if ( empty( $blockCssStyle ) || empty( $block['attrs'] ) || ! is_array( $block['attrs'] ) ) {
				return $block;
			}

			// This line of code creates a new array named $fontFamilyAttrs by searching through the keys of an existing array.
			$fontFamilyAttrs = preg_grep( '/fontfamily/i', array_keys( $block['attrs'] ) );
			$linkTagList     = '';

			if ( ! empty( $fontFamilyAttrs ) && is_array( $fontFamilyAttrs ) ) {
				foreach ( $fontFamilyAttrs as $attr ) {
					if ( ! empty( $block['attrs'][ $attr ] ) ) {
						// Get the font family value and construct the Google Fonts URL.
						$gfontUrl = 'https://fonts.googleapis.com/css?family=' . urlencode( $block['attrs'][ $attr ] );
						// Create a link tag for the stylesheet with the constructed URL.
						$linkTagList .= '<link rel="stylesheet" href="' . esc_url( $gfontUrl ) . '" media="all">';
					}
				}
			}

				$style = '<style class="vxt-widgets-style-renderer">' . $blockCssStyle . '</style>';
				$style = $style . $linkTagList;

				array_push( $block['innerContent'], $style );

			return $block;
		}

		/**
		 * This function updates the __vxt_ultimate_gutenberg_blocks_asset_version when Widgets Editor is Updated.
		 *
		 * @since 2.0.0
		 */
		public function afterWidgetSaveAction() {
			/* Update the asset version */
			update_option( '__vxt_ultimate_gutenberg_blocks_asset_version', time() );
		}

		/**
		 * Create API fields for additional info
		 *
		 * @since 0.0.1
		 */
		public function blocksRegisterRestFields() {
			$postType = \Vexaltrix\Core\Support\Helper::getPostTypes();

			foreach ( $postType as $key => $value ) {
				// Add featured image source.
				register_rest_field(
					$value['value'],
					'vxt_ultimate_gutenberg_blocks_featured_image_src',
					[
						'get_callback'    => [ $this, 'getImageSrc' ],
						'update_callback' => null,
						'schema'          => null,
					]
				);

				// Add author info.
				register_rest_field(
					$value['value'],
					'vxt_ultimate_gutenberg_blocks_author_info',
					[
						'get_callback'    => [ $this, 'getAuthorInfo' ],
						'update_callback' => null,
						'schema'          => null,
					]
				);

				// Add comment info.
				register_rest_field(
					$value['value'],
					'vxt_ultimate_gutenberg_blocks_comment_info',
					[
						'get_callback'    => [ $this, 'getCommentInfo' ],
						'update_callback' => null,
						'schema'          => null,
					]
				);

				// Add excerpt info.
				register_rest_field(
					$value['value'],
					'vxt_ultimate_gutenberg_blocks_excerpt',
					[
						'get_callback'    => [ $this, 'getExcerpt' ],
						'update_callback' => null,
						'schema'          => null,
					]
				);

			}

			register_rest_route(
				'vexaltrix/v1',
				'all_taxonomy',
				[
					[
						'methods'             => 'GET',
						'callback'            => [ $this, 'getRelatedTaxonomy' ],
						'permission_callback' => [ $this, 'getItemsPermissionsCheck' ],
						'args'                => [],
					],
				]
			);

			register_rest_route(
				'vexaltrix/v1',
				'editor',
				[
					[
						'methods'             => 'GET',
						'callback'            => [ $this, 'vxtUltimateGutenbergBlocksInitialStates' ],
						'permission_callback' => [ $this, 'getItemsPermissionsCheck' ],
						'args'                => [],
					],
				]
			);

			register_rest_route(
				'vexaltrix/v1',
				'check-custom-fields-support',
				[
					[
						'methods'             => 'GET',
						'callback'            => [ $this, 'checkCustomFieldsSupport' ],
						'permission_callback' => [ $this, 'getItemsPermissionsCheck' ],
						'args'                => $this->checkCustomFieldsSupportArgs(),
					],
				]
			);
		}

		/**
		 * Get Initial States.
		 *
		 * @since 2.12.0
		 * @return array
		 */
		public function vxtUltimateGutenbergBlocksInitialStates() {

			$response = array_merge( 
				// For GBS initial states.
				$this->getGbsInitialStates(),
				// For quick action sidebar.
				$this->getQuickActionBarInitialStates()
			);

			return $response;
		}

		/**
		 * Get Quick Action Bar Initial States.
		 *
		 * @since 2.12.0
		 * @return array
		 */
		public function getQuickActionBarInitialStates() {
			// Get value from DB for Quick Action Bar.
			$dbValue                            = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'uag_enable_quick_action_sidebar' );
			$showEnable                         = ( empty( $dbValue ) ) ? 'enabled' : $dbValue;
			$vexaltrixEnableQuickActionSidebar = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'uag_enable_quick_action_sidebar', $showEnable );

			$vexaltrixDefaultAllowedQuickSidebarBlocks = \Vexaltrix\Presentation\Admin\AdminSettings::get(
				'vxt_ultimate_gutenberg_blocks_quick_sidebar_allowed_blocks',
				[]
			);

			if ( empty( $vexaltrixDefaultAllowedQuickSidebarBlocks ) ) {
				$vexaltrixDefaultAllowedQuickSidebarBlocks = [
					'vexaltrix/container',
					'vexaltrix/advanced-heading',
					'vexaltrix/image',
					'vexaltrix/icon',
					'vexaltrix/buttons',
					'vexaltrix/info-box',
					'vexaltrix/call-to-action',
				];
			}
			
			$initialState = [
				'uag_enable_quick_action_sidebar'   => $vexaltrixEnableQuickActionSidebar,
				'vxt_ultimate_gutenberg_blocks_quick_sidebar_allowed_blocks' => $vexaltrixDefaultAllowedQuickSidebarBlocks,
			];

			return $initialState;
		}

		/**
		 * Get GBS Initial States.
		 *
		 * @since 2.9.0
		 * @return array
		 */
		public function getGbsInitialStates() {
			// check if GBS is enabled or not.
			if ( 'enabled' !== \Vexaltrix\Presentation\Admin\AdminSettings::get( 'uag_enable_gbs_extension', 'enabled' ) ) {
				return [];
			}

			$vexaltrixGlobalBlockStyles = get_option(
				'vexaltrix_global_block_styles',
				[
					[
						'value' => '',
						'label' => __( 'None', 'vexaltrix' ),
					],
				] 
			);
			
			$vexaltrixGbsGoogleFontsEditor = get_option(
				'vexaltrix_gbs_google_fonts_editor',
				[]
			);


			if ( empty( $vexaltrixGlobalBlockStyles ) ) {
				$vexaltrixGlobalBlockStyles = [
					[
						'value' => '',
						'label' => __( 'None', 'vexaltrix' ),
					],
				];
			}

			$initialState = [
				'vexaltrix_global_block_styles'     => $vexaltrixGlobalBlockStyles,
				'vexaltrix_gbs_google_fonts_editor' => $vexaltrixGbsGoogleFontsEditor,
			];

			return $initialState;
		}

		/**
		 * Get all taxonomies.
		 *
		 * @since 1.11.0
		 * @access public
		 */
		public function getRelatedTaxonomy() {

			$postTypes = self::getPostTypes();

			$returnArray = [];

			foreach ( $postTypes as $key => $value ) {
				$postType = $value['value'];

				$taxonomies = get_object_taxonomies( $postType, 'objects' );
				$data       = [];

				foreach ( $taxonomies as $taxSlug => $tax ) {
					if ( ! $tax->public || ! $tax->show_ui || ! $tax->show_in_rest ) {
						continue;
					}

					$data[ $taxSlug ] = $tax;

					$terms = get_terms( $taxSlug );

					$relatedTax = [];

					if ( ! empty( $terms ) ) {
						foreach ( $terms as $tIndex => $tObj ) {
							$relatedTax[] = [
								'id'    => $tObj->term_id,
								'name'  => $tObj->name,
								'child' => get_term_children( $tObj->term_id, $taxSlug ),
							];
						}
						$returnArray[ $postType ]['terms'][ $taxSlug ] = $relatedTax;
					}
				}

				$returnArray[ $postType ]['taxonomy'] = $data;

			}

			return apply_filters( 'vxt_ultimate_gutenberg_blocks_post_loop_taxonomies', $returnArray );
		}

		/**
		 * Get Post Types.
		 *
		 * @since 1.11.0
		 * @access public
		 */
		public static function getPostTypes() {

			$postTypes = get_post_types(
				[
					'public'       => true,
					'show_in_rest' => true,
				],
				'objects'
			);

			$options = [];

			foreach ( $postTypes as $postType ) {

				if ( 'attachment' === $postType->name ) {
					continue;
				}

				$options[] = [
					'value' => $postType->name,
					'label' => $postType->label,
				];
			}

			return apply_filters( 'vxt_ultimate_gutenberg_blocks_loop_post_types', $options );
		}
		/**
		 * Check whether a given request has permission to read notes.
		 *
		 * @param  WP_REST_Request $request Full details about the request.
		 * @return WP_Error|boolean
		 */
		public function getItemsPermissionsCheck( $request ) {

			if ( ! current_user_can( 'edit_posts' ) ) {
				return new \WP_Error( 'uag_rest_cannot_view', __( 'Sorry, you cannot list resources.', 'vexaltrix' ), [ 'status' => rest_authorization_required_code() ] );
			}

			return true;
		}

		/**
		 * Get featured image source for the rest field as per size
		 *
		 * @param object $object Post Object.
		 * @param string $fieldName Field name.
		 * @param object $request Request Object.
		 * @since 0.0.1
		 */
		public function getImageSrc( $object, $fieldName, $request ) {
			$imageSizes = \Vexaltrix\Core\Support\Helper::getImageSizes();

			$featuredImages = [];

			if ( ! isset( $object['featured_media'] ) ) {
				return $featuredImages;
			}

			foreach ( $imageSizes as $key => $value ) {
				$size = $value['value'];

				$featuredImages[ $size ] = wp_get_attachment_image_src(
					$object['featured_media'],
					$size,
					false
				);
			}

			return $featuredImages;
		}

		/**
		 * Get author info for the rest field
		 *
		 * @param object $object Post Object.
		 * @param string $fieldName Field name.
		 * @param object $request Request Object.
		 * @since 0.0.1
		 */
		public function getAuthorInfo( $object, $fieldName, $request ) {

			$author = ( isset( $object['author'] ) ) ? $object['author'] : '';

			// Get the author name.
			$authorData['display_name'] = get_the_author_meta( 'display_name', $author );

			// Get the author link.
			$authorData['author_link'] = get_author_posts_url( $author );

			// Return the author data.
			return $authorData;
		}

		/**
		 * Get comment info for the rest field
		 *
		 * @param object $object Post Object.
		 * @param string $fieldName Field name.
		 * @param object $request Request Object.
		 * @since 0.0.1
		 */
		public function getCommentInfo( $object, $fieldName, $request ) {
			// Get the comments link.
			$commentsCount = wp_count_comments( $object['id'] );
			return $commentsCount->total_comments;
		}

		/**
		 * Get excerpt for the rest field
		 *
		 * @param object $object Post Object.
		 * @param string $fieldName Field name.
		 * @param object $request Request Object.
		 * @since 0.0.1
		 */
		public function getExcerpt( $object, $fieldName, $request ) {
			$excerpt = wp_trim_words( get_the_excerpt( $object['id'] ) );
			if ( ! $excerpt ) {
				$excerpt = null;
			}
			return $excerpt;
		}

		/**
		 * Create API Order By Fields
		 *
		 * @since 1.12.0
		 */
		public function registerRestOrderbyFields() {
			$postType = \Vexaltrix\Core\Support\Helper::getPostTypes();

			foreach ( $postType as $key => $type ) {
				add_filter( "rest_{$type['value']}_collection_params", [ $this, 'addOrderby' ], 10, 1 );
			}
		}

		/**
		 * Adds Order By values to Rest API
		 *
		 * @param object $params Parameters.
		 * @since 1.12.0
		 */
		public function addOrderby( $params ) {

			$params['orderby']['enum'][] = 'rand';
			$params['orderby']['enum'][] = 'menu_order';

			return $params;
		}

		/**
		 * Adds the Contect Form 7 Custom Post Type to REST.
		 *
		 * @param array  $args Array of arguments.
		 * @param string $postType Post Type.
		 * @since 1.10.0
		 */
		public function addCptsToApi( $args, $postType ) {
			if ( 'wpcf7_contact_form' !== $postType || ! is_admin() ) {
				return $args; // Don't change anything for other post types.
			}

			// Modify args only for wpcf7_contact_form.
			$args['show_in_rest'] = true;
			return $args;
		}

		/**
		 * Supported arguments to check if the given post type supports custom fields.
		 *
		 * @since 2.13.1
		 * @return array The array of supported arguments.
		 */
		public function checkCustomFieldsSupportArgs() {
			$args = [];

			$args['post_type'] = [
				'type'              => 'string',
				'required'          => false,
				'sanitize_callback' => 'sanitize_text_field',
				'validate_callback' => function ( $value ) {
					// Allow empty value since required is false.
					if ( empty( $value ) ) {
						return true;
					}
					// Validate that it's a string.
					if ( ! is_string( $value ) ) {
						return new \WP_Error( 'invalid_type', __( 'Post type must be a string.', 'vexaltrix' ) );
					}
					// Validate against registered post types.
					$postTypes = get_post_types( [ 'public' => true ] );
					if ( ! in_array( $value, $postTypes, true ) ) {
						return new \WP_Error( 'invalid_post_type', __( 'Invalid post type.', 'vexaltrix' ) );
					}
					return true;
				},
			];

			return $args;
		}

		/**
		 * Checks if the given post type supports custom fields.
		 *
		 * @param WP_REST_Request $request All the details about the request.
		 * @since 2.13.1
		 * @return WP_REST_Response The response.
		 */
		public function checkCustomFieldsSupport( $request ) {
			$postType = $request->get_param( 'post_type' );

			// If the post type was not passed, abandon ship.
			if ( empty( $postType ) || ! is_string( $postType ) ) {
				$response = new \WP_REST_Response(
					[
						'success' => false,
					]
				);
				$response->set_status( 400 );
				return $response;
			}

			// Sanitize the post type, and check if the post type supports custom fields.
			$postType              = sanitize_text_field( $postType );
			$supportsCustomFields = post_type_supports( $postType, 'custom-fields' );

			// Return the successful response, with whether or not custom fields is supported.
			$response = new \WP_REST_Response(
				[
					'success'                => true,
					'supports_custom_fields' => $supportsCustomFields,
				]
			);
			$response->set_status( 200 );

			return $response;
		}
	
	/**
	 * Service group.
	 *
	 * @return string
	 */
	public static function group(): string {
		return 'transport';
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
			add_action( 'rest_api_init', [ $this, 'blocksRegisterRestFields' ] );
			add_action( 'init', [ $this, 'registerRestOrderbyFields' ] );
			add_filter( 'register_post_type_args', [ $this, 'addCptsToApi' ], 10, 2 );
			add_action( 'save_post', [ 'Vexaltrix\\Support\\Helper', 'deletePageAssets' ], 10, 1 );
			add_action( 'wp_trash_post', [ $this, 'deletePageAssetsOnTrash' ] );
				add_filter( 'render_block_data', [ $this, 'contentPreRender' ] ); // Add a inline style for block when it rendered in customizer.
				add_action( 'customize_save', [ $this, 'afterWidgetSaveAction' ] ); // Update the assets on customizer save/publish.
	}

}

	/**
	 *  Prepare if class 'Vexaltrix\Transport\Api\\RestApi' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
