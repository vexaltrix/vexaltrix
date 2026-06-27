<?php
/**
 * Vexaltrix Post Base.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Presentation\Assets;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class \Vexaltrix\Presentation\Assets\PostAssets.
 */
class PostAssets {

	/**
	 * Current Block List
	 *
	 * @since 1.13.4
	 * @var array
	 */
	public $currentBlockList = [];

	/**
	 * UAG Block Flag
	 *
	 * @since 1.13.4
	 * @var uagFlag
	 */
	public $uagFlag = false;

	/**
	 * UAG FAQ Layout Flag
	 *
	 * @since 1.18.1
	 * @var uagFaqLayout
	 */
	public $uagFaqLayout = false;

	/**
	 * UAG File Generation Flag
	 *
	 * @since 1.14.0
	 * @var string
	 */
	public $fileGeneration = 'disabled';

	/**
	 * UAG File Generation Flag
	 *
	 * @since 1.14.0
	 * @var fileGeneration
	 */
	public $isAllowedAssetsGeneration = false;

	/**
	 * UAG File Generation Fallback Flag for CSS
	 *
	 * @since 1.15.0
	 * @var fileGeneration
	 */
	public $fallbackCss = false;

	/**
	 * UAG File Generation Fallback Flag for JS
	 *
	 * @since 1.15.0
	 * @var fileGeneration
	 */
	public $fallbackJs = false;

	/**
	 * Enqueue Style and Script Variable
	 *
	 * @since 1.14.0
	 * @var instance
	 */
	public $assetsFileHandler = [];

	/**
	 * Stylesheet
	 *
	 * @since 1.13.4
	 * @var string
	 */
	public $stylesheet = '';

	/**
	 * Script
	 *
	 * @since 1.13.4
	 * @var script
	 */
	public $script = '';

	/**
	 * Page Blocks Variable
	 *
	 * @since 1.6.0
	 * @var instance
	 */
	public $pageBlocks;

	/**
	 * Google fonts to enqueue
	 *
	 * @var array
	 */
	public $gfonts = [];

	/**
	 * Google fonts preload files
	 *
	 * @var array
	 */
	public $gfontsFiles = [];

	/**
	 * Google fonts url to enqueue
	 *
	 * @var string
	 */
	public $gfontsUrl = '';


	/**
	 * Load Google fonts locally
	 *
	 * @var string
	 */
	public $loadGfontsLocally = '';

	/**
	 * Preload google fonts files from local
	 *
	 * @var string
	 */
	public $preloadLocalFonts = '';

	/**
	 * Static CSS Added Array
	 *
	 * @since 1.23.0
	 * @var array
	 */
	public $staticCssBlocks = [];

	/**
	 * Static CSS Added Array
	 *
	 * @since 1.23.0
	 * @var array
	 */
	public static $conditionalBlocksPrinted = false;

	/**
	 * Post ID
	 *
	 * @since 1.23.0
	 * @var integer
	 */
	protected $postId;

	/**
	 * Preview
	 *
	 * @since 1.24.2
	 * @var preview
	 */
	public $preview = false;

	/**
	 * Load UAG Fonts Flag.
	 *
	 * @since 2.0.0
	 * @var preview
	 */
	public $loadUagFonts = true;

	/**
	 * Common Assets Added.
	 *
	 * @since 2.0.0
	 * @var preview
	 */
	public static $commonAssetsAdded = false;

	/**
	 * Custom CSS Appended Flag
	 *
	 * @since 2.1.0
	 * @var custom_css_appended
	 */
	public static $customCssAppended = false;

	/**
	 * Is current post a revision.
	 *
	 * @since 2.6.2
	 * @var isPostRevision
	 */
	public $isPostRevision = false;

	/**
	 * Seen Refs Array
	 * This array will store the block IDs which have already been processed.
	 *
	 * @since 2.19.5
	 * @var array
	 */
	private static $seenRefs = [];

	/**
	 * Constructor
	 *
	 * @param int $postId Post ID.
	 */
	public function __construct( $postId ) {
		// Reset seen refs for each new post.
		self::$seenRefs = [];

		$this->postId = intval( $postId );

		// For Vexaltrix Global Block Styles.
		$this->vexaltrixGbsLoadGfonts();

		if ( wp_is_post_revision( $this->postId ) ) {
			$this->isPostRevision = true;
		}

		$this->preview = isset( $_GET['preview'] ); //phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Nonce verification not required.

		$this->loadUagFonts = apply_filters( 'vxt_ultimate_gutenberg_blocks_enqueue_google_fonts', $this->loadUagFonts );

		if ( $this->preview || $this->isPostRevision ) {
			$this->fileGeneration              = 'disabled';
			$this->isAllowedAssetsGeneration = true;
		} else {
			$this->fileGeneration              = \Vexaltrix\Core\Support\Helper::$fileGeneration;
			$this->isAllowedAssetsGeneration = $this->allowAssetsGeneration();
		}
		// Set other options.
		$this->loadGfontsLocally = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_loadGfontsLocally', 'disabled' );
		$this->preloadLocalFonts = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_preloadLocalFonts', 'disabled' );

		if ( $this->isAllowedAssetsGeneration ) {
			global $post;
			$thisPost = $this->preview ? $post : get_post( $this->postId );
			if ( function_exists( 'wp_is_block_theme' ) && wp_is_block_theme() ) { // Check if block theme is active.
				$whatPostType = $this->determineTemplatePostType( $this->postId ); // Determine template post type.
				$this->prepareAssetsForTemplatesBasedPostType( $whatPostType ); // Prepare assets for templates based on post type.
			}
			$this->prepareAssets( $thisPost );
			if ( $this->preview ) { // Load CSS only in preview mode of block editor.
				$this->prepareAstCustomLayoutPostAssets();
			}
			$content = get_option( 'widget_block' );
			$this->prepareWidgetAreaAssets( $content );
		}
	}

	/**
	 * Get WooCommerce Template.
	 *
	 * @since 2.9.1
	 * @return bool|string The WooCommerce template if found, or false if not found.
	 */
	public function getWoocommerceTemplate() {
		// Check if WooCommerce is active.
		if ( class_exists( 'WooCommerce' ) ) {
			$isOrderReceivedPage            = function_exists( 'is_order_received_page' ) && is_order_received_page();
			$isCheckout                       = function_exists( 'is_checkout' ) && is_checkout();
			$isWcOrderReceivedEndpointUrl = function_exists( 'is_wc_endpoint_url' ) && is_wc_endpoint_url( 'order-received' );
			// Check other WooCommerce pages.
			switch ( true ) {
				// Check if the current page is the shop page.
				case is_cart():
					return 'page-cart';

				// Check if the current page is the checkout page.
				case $isCheckout:
					// Check if the current page is the order received page.
					if ( $isOrderReceivedPage ) {
						return 'order-confirmation';
					}
					return 'page-checkout';

				// Check if the current page is the order received page.
				case $isWcOrderReceivedEndpointUrl:
					return 'order-confirmation';

				// Check if the current page is a product page.
				case is_product():
					// Retrieve the queried object.
					$object = get_queried_object();
					// Get all block templates.
					$templateTypes = get_block_templates();
					// Extract the 'slug' column from the block templates array.
					$templateTypeSlug = array_column( $templateTypes, 'slug' );
					// Check specific single product template exist or not. If not then use default single product template. 
					return ( $object instanceof WP_Post && in_array( 'single-product-' . $object->post_name, $templateTypeSlug ) ) ? 'single-product-' . $object->post_name : 'single-product';

				// Check if the current page is an archive page.
				case is_archive():
					// Retrieve the queried object.
					$object = get_queried_object();

					// Get all block templates.
					$templateTypes = get_block_templates();

					// Extract the 'slug' column from the block templates array.
					$templateTypeSlug = array_column( $templateTypes, 'slug' );

					// Check if the current request is a search and if the post type archive is for 'product'.
					$searchCondition = is_search() && is_post_type_archive( 'product' );

					// Switch statement to determine the template based on various conditions.
					switch ( true ) {
						// Case when the current page is a product taxonomy and the taxonomy is 'product_tag'.
						case ( is_product_taxonomy() && is_tax( 'product_tag' ) ) && $object instanceof WP_Term && ! in_array( 'taxonomy-' . $object->taxonomy . '-' . $object->slug, $templateTypeSlug ):
							// Check if 'taxonomy-product_tag' template exists in the template type slugs array.
							if ( in_array( 'taxonomy-product_tag', $templateTypeSlug ) ) {
								// Prepare assets for the 'taxonomy-product_tag' template.
								$this->prepareAssetsForTemplatesBasedPostType( 'taxonomy-product_tag' );
							}
							// Return the appropriate template based on the search condition.
							return $searchCondition ? 'product-search-results' : 'archive-product';

						// Case when the current page is a product taxonomy and the object is a term.
						case is_product_taxonomy() && $object instanceof WP_Term:
							// Check if the taxonomy is a product attribute.
							if ( taxonomy_is_product_attribute( $object->taxonomy ) ) {
								// Prepare assets for the 'archive-product' template if it exists in the template type slugs array.
								if ( in_array( 'archive-product', $templateTypeSlug ) ) {
									$this->prepareAssetsForTemplatesBasedPostType( 'archive-product' );
								}
								// Return the 'product-search-results' or 'taxonomy-product_attribute' template based on the search condition.
								return $searchCondition ? 'product-search-results' : 'taxonomy-product_attribute';
							} elseif ( ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) && in_array( 'taxonomy-' . $object->taxonomy . '-' . $object->slug, $templateTypeSlug ) ) {
								// Return the specific taxonomy template based on the search condition.
								return $searchCondition ? 'product-search-results' : 'taxonomy-' . $object->taxonomy . '-' . $object->slug;
							} else {
								// Prepare assets for the 'taxonomy-product_cat' template if it exists in the template type slugs array.
								if ( in_array( 'taxonomy-product_cat', $templateTypeSlug ) ) {
									$this->prepareAssetsForTemplatesBasedPostType( 'taxonomy-product_cat' );
								}
								// Return the appropriate template based on the search condition.
								return $searchCondition ? 'product-search-results' : 'archive-product';
							}
							break;

						// Case when the current page is the shop page.
						case is_shop():
							// Return the appropriate template based on the search condition.
							return $searchCondition ? 'product-search-results' : 'archive-product';

						default:
							// Return the appropriate template based on the search condition and the type of the queried object.
							return $searchCondition ? 'product-search-results' : ( ( $object instanceof WP_Post || $object instanceof WP_Post_Type || $object instanceof WP_Term || $object instanceof WP_User ) ? $this->getArchivePageTemplate( $object, $templateTypeSlug ) : 'archive-product' );
					}
					break;

				default:
					// Handle other cases if needed.
					break;
			}
		}
		return false;
	}

	/**
	 * Get archive page template for current post.
	 *
	 * @param object $archiveObject of current post.
	 * @param array  $templateTypeSlug name.
	 * @since 2.12.8
	 * @return string The determined archive post type.
	 */
	public function getArchivePageTemplate( $archiveObject, $templateTypeSlug ) {
		if ( is_author() && $archiveObject instanceof WP_User ) { // For author archive or more specific author template.
			$authorSlug = 'author-' . $archiveObject->user_nicename;
			return in_array( $authorSlug, $templateTypeSlug ) ? $authorSlug : ( in_array( 'author', $templateTypeSlug ) ? 'author' : 'archive' );
		} elseif ( $archiveObject instanceof WP_Term ) {
			if ( is_category() ) { // For category archive or more specific category template.
				$categorySlug = 'category-' . $archiveObject->slug;
				return in_array( $categorySlug, $templateTypeSlug ) ? $categorySlug : ( in_array( 'category', $templateTypeSlug ) ? 'category' : 'archive' );
			} elseif ( is_tag() ) { // For tag archive or more specific tag template.
				$tagSlug = 'tag-' . $archiveObject->slug;
				return in_array( $tagSlug, $templateTypeSlug ) ? $tagSlug : ( in_array( 'tag', $templateTypeSlug ) ? 'tag' : 'archive' );
			} elseif ( is_tax() ) {
				$taxSlug          = 'taxonomy-' . $archiveObject->taxonomy;
				$specificTaxSlug = 'taxonomy-' . $archiveObject->taxonomy . '-' . $archiveObject->slug;
				if ( in_array( $specificTaxSlug, $templateTypeSlug ) ) { // For more specific custom taxonomy template.
					$this->prepareAssetsForTemplatesBasedPostType( $specificTaxSlug );
				}
				// For all custom taxonomy archive or more archive taxonomy template.
				return in_array( $taxSlug, $templateTypeSlug ) ? $taxSlug : 'archive';
			}
		} elseif ( is_date() && in_array( 'date', $templateTypeSlug ) ) { // For date archive template.
			return 'date';
		} elseif ( $archiveObject instanceof WP_Post_Type && is_post_type_archive() ) { // For custom post type archive or more specific custom post type archive template.
			$postTypeArchiveSlug = 'archive-' . $archiveObject->name;
			return in_array( $postTypeArchiveSlug, $templateTypeSlug ) ? $postTypeArchiveSlug : ( in_array( 'archive', $templateTypeSlug ) ? 'archive' : 'archive-' . $archiveObject->name );
		}
		return 'archive';
	}

	/**
	 * Determine template post type function.
	 *
	 * @param int $postId of current post.
	 * @since 2.9.1
	 * @return string The determined post type.
	 */
	public function determineTemplatePostType( $postId ) {
		$getWoocommerceTemplate = $this->getWoocommerceTemplate(); // Get WooCommerce template.
		if ( is_string( $getWoocommerceTemplate ) ) { // Check if WooCommerce template is found.
			return $getWoocommerceTemplate; // WooCommerce templates to post type.
		}

		// Check if post id is passed.
		if ( ! empty( $postId ) ) {
			$templateSlug = get_page_template_slug( $postId );
			if ( ! empty( $templateSlug ) ) {
				return $templateSlug;
			}
		}

		$conditionalToPostType = [
			'is_attachment' => 'attachment',
			'is_embed'      => 'embed',
			'is_front_page' => 'home',
			'is_home'       => 'home',
			'is_search'     => 'search',
			'is_paged'      => 'paged',
		]; // Conditional tags to post type.

		$whatPostType     = '404'; // Default to '404' if no condition matches.
		$object             = get_queried_object();
		$templateTypes     = get_block_templates();
		$templateTypeSlug = array_column( $templateTypes, 'slug' );

		// Determines whether the query is for an existing single page.
		$isRegularPage        = is_page() && ! is_front_page();
		$isFrontPageTemplate = is_front_page() && get_front_page_template();
		$isStaticFrontPage   = 'page' === get_option( 'show_on_front' ) && get_option( 'page_on_front' ) && is_front_page() && ! is_home() && ! $isFrontPageTemplate;

		if ( $isRegularPage || $isStaticFrontPage ) { // Run only for page and any page selected as home page from settings > reading > static page.
			return ( $object instanceof WP_Post && in_array( 'page-' . $object->post_name, $templateTypeSlug ) ) ? 'page-' . $object->post_name : 'page';
		} elseif ( $isFrontPageTemplate ) { // Run only when is_home and is_front_page() and get_front_page_template() is true. i.e front-page template.
			return 'front-page';
		} elseif ( is_archive() ) { // Applies to archive pages.
			// If none of the above condition matches, return archive template.
			return ( $object instanceof WP_Post || $object instanceof WP_Post_Type || $object instanceof WP_Term || $object instanceof WP_User ) ? $this->getArchivePageTemplate( $object, $templateTypeSlug ) : 'archive';
		} else {
			if ( $object instanceof WP_Post && ! empty( $object->post_type ) ) {
				if ( is_singular() ) { // Applies to single post of any post type ( attachment, page, custom post types).
					$nameDecoded = urldecode( $object->post_name );
					if ( in_array( 'single-' . $object->post_type . '-' . $nameDecoded, $templateTypeSlug ) ) {
						return 'single-' . $object->post_type . '-' . $nameDecoded;
					} elseif ( in_array( 'single-' . $object->post_type, $templateTypeSlug ) ) {
						return 'single-' . $object->post_type;
					} else { // If none of the above condition matches, return single template.
						return 'single';
					}
				}
			}
		}

		foreach ( $conditionalToPostType as $conditional => $postType ) {
			if ( $conditional() ) {
				$whatPostType = $postType;
				break;
			}
		}

		return $whatPostType;
	}

	/**
	 * Generates assets for templates based on post type.
	 *
	 * @param string $postType of current template.
	 * @since 2.9.1
	 * @return void
	 */
	public function prepareAssetsForTemplatesBasedPostType( $postType ) {
		$templateSlug    = $postType;
		$currentTemplate = get_block_templates( [ 'slug__in' => [ $templateSlug ] ] ); // Get block templates based on post type.
		// Check if block templates were found.
		if ( ! empty( $currentTemplate ) && is_array( $currentTemplate ) ) {
			// Ensure the first template has content.
			if ( isset( $currentTemplate[0]->content ) && has_blocks( $currentTemplate[0]->content ) ) {
				$this->commonFunctionForAssetsPreparation( $currentTemplate[0]->content );
			}
		}
	}

	/**
	 * Generate assets of Astra custom layout post in preview
	 *
	 * @since 2.6.0
	 * @return void
	 */
	public function prepareAstCustomLayoutPostAssets() {

		if ( ! defined( 'ASTRA_ADVANCED_HOOKS_POST_TYPE' ) ) {
			return;
		}

		$option = [
			'location'  => 'ast-advanced-hook-location',
			'exclusion' => 'ast-advanced-hook-exclusion',
			'users'     => 'ast-advanced-hook-users',
		];
		$result = Astra_Target_Rules_Fields::getInstance()->get_posts_by_conditions( ASTRA_ADVANCED_HOOKS_POST_TYPE, $option );

		if ( empty( $result ) || ! is_array( $result ) ) {
			return;
		}
		foreach ( $result as $postId => $postData ) {
			$customPost = get_post( $postId );
			$this->prepareAssets( $customPost );
		}
	}

	/**
	 * Load Styles for Vexaltrix Global Block Styles.
	 *
	 * @since 2.9.0
	 * @return void
	 */
	public function vexaltrixGbsLoadStyles() {
		// Check if GBS is enabled.
		$gbsStatus                  = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_enable_gbs_extension', 'enabled' );
		$vexaltrixGlobalBlockStyles = get_option( 'vexaltrix_global_block_styles', [] );
		if ( empty( $vexaltrixGlobalBlockStyles ) || ! is_array( $vexaltrixGlobalBlockStyles ) ) {
			return;
		}

		if ( 'disabled' === $gbsStatus ) {
			// Enqueue GBS default styles.
			foreach ( $vexaltrixGlobalBlockStyles as $style ) {

				if ( empty( $style['blockName'] ) || ! is_string( $style['blockName'] ) ) {
					continue;
				}

				// Check if uagb string exist in $blockName or not.
				if ( 0 !== strpos( $style['blockName'], 'vexaltrix/' ) ) {
					continue;
				}

				$blockSlug = str_replace( 'vexaltrix/', '', $style['blockName'] );

				// This is class name and file name.
				$fileNames    = 'vxt-gbs-default-' . $blockSlug;
				$wpUploadDir = \Vexaltrix\Core\Support\Helper::getUagUploadDirPath();
				$wpUploadUrl = \Vexaltrix\Core\Support\Helper::getUagUploadUrlPath();
				$fileDir      = $wpUploadDir . $fileNames . '.css';
				if ( file_exists( $fileDir ) ) {
					$fileUrl = $wpUploadUrl . $fileNames . '.css';
					wp_enqueue_style( $fileNames, $fileUrl, [], VXT_VER, 'all' );
				}
			}
		}

		if ( 'enabled' !== $gbsStatus ) {
			return;
		}

		$shouldRenderStylesInFsePage = wp_is_block_theme() && ! get_queried_object();

		foreach ( $vexaltrixGlobalBlockStyles as $style ) {
			if ( ! empty( $style['value'] ) && ! empty( $style['frontendStyles'] ) ) {

				if ( ! empty( $style['postIds'] ) && in_array( $this->postId, $style['postIds'] ) ) {
					$this->stylesheet = $style['frontendStyles'] . $this->stylesheet;
				} elseif ( $shouldRenderStylesInFsePage && isset( $style['page_template_slugs'] ) && ! empty( $style['page_template_slugs'] ) ) {
					// Render in fse template.
					$this->stylesheet = $style['frontendStyles'] . $this->stylesheet;
				} elseif ( isset( $style['styleForGlobal'] ) && ! empty( $style['styleForGlobal'] ) ) {
					$this->stylesheet = $style['frontendStyles'] . $this->stylesheet;
				}
			}
		}
	}


	/**
	 * Load Google Fonts for Vexaltrix Global Block Styles.
	 *
	 * @since 2.9.0
	 * @return void
	 */
	public function vexaltrixGbsLoadGfonts() {

		$vexaltrixGbsGoogleFonts = get_option( 'vexaltrix_gbs_google_fonts', [] );

		if ( ! is_array( $vexaltrixGbsGoogleFonts ) ) {
			return;
		}

		$families = [];
		foreach ( $vexaltrixGbsGoogleFonts as $style ) {
			if ( is_array( $style ) ) {
				foreach ( $style as $family ) {
					if ( ! in_array( $family, $families, true ) ) {
						\Vexaltrix\Core\Support\Helper::blocksGoogleFont( true, $family, '' );
						$families[] = $family;
					}
				}
			}
		}
	}

	/**
	 * Generates stylesheet for widget area.
	 *
	 * @param object $content Current Post Object.
	 * @since 2.0.0
	 */
	public function prepareWidgetAreaAssets( $content ) {

		if ( empty( $content ) ) {
			return;
		}

		foreach ( $content as $value ) {
			if ( is_array( $value ) && isset( $value['content'] ) && has_blocks( $value['content'] ) ) {
				$this->commonFunctionForAssetsPreparation( $value['content'] );
			}
		}

	}

	/**
	 * This function determines wether to generate new assets or not.
	 *
	 * @since 1.23.0
	 */
	public function allowAssetsGeneration() {

		$pageAssets     = get_post_meta( $this->postId, '_vxt_page_assets', true );
		$versionUpdated = false;
		$cssAssetInfo  = [];
		$jsAssetInfo   = [];

		if ( empty( $pageAssets ) || empty( $pageAssets['vxt_version'] ) ) {
			return true;
		}

		if ( VXT_ASSET_VER !== $pageAssets['vxt_version'] ) {
			$versionUpdated = true;
		}

		if ( 'enabled' === $this->fileGeneration ) {

			$cssFileName = get_post_meta( $this->postId, '_vxt_css_file_name', true );
			$jsFileName  = get_post_meta( $this->postId, '_vxt_js_file_name', true );

			if ( ! empty( $cssFileName ) ) {
				$cssAssetInfo = \Vexaltrix\Core\Support\ScriptsUtils::getAssetInfo( 'css', $this->postId );
				$cssFilePath  = $cssAssetInfo['css'];
			}

			if ( ! empty( $jsFileName ) ) {
				$jsAssetInfo = \Vexaltrix\Core\Support\ScriptsUtils::getAssetInfo( 'js', $this->postId );
				$jsFilePath  = $jsAssetInfo['js'];
			}

			/**
			 * CRITICAL FIX: Don't delete files OR meta on version mismatch.
			 *
			 * The _vxt_page_assets meta is already deleted (line 705).
			 * This triggers regeneration without orphaning files.
			 * file_write() will overwrite existing files safely.
			 * If regeneration fails, old files remain accessible → No 404 error.
			 */

			// Don't delete file name meta - keeps file referenced in DB
			// Regeneration triggered by _vxt_page_assets deletion (line 705).

			if ( empty( $cssFilePath ) || ! file_exists( $cssFilePath ) ) {
				return true;
			}

			if ( ! empty( $jsFilePath ) && ! file_exists( $jsFilePath ) ) {
				return true;
			}
		}

		// If version is updated, return true.
		if ( $versionUpdated ) {
			// Delete cached meta.
			$uniqueIds = get_option( '_vxt_ultimate_gutenberg_blocks_fse_uniqids' );
			if ( ! empty( $uniqueIds ) && is_array( $uniqueIds ) ) {
				foreach ( $uniqueIds as $id ) {
					delete_post_meta( (int) $id, '_vxt_page_assets' );
				}
			}
			delete_post_meta( $this->postId, '_vxt_page_assets' );
			return true;
		}

		// Set required varibled from stored data.
		$this->currentBlockList  = $pageAssets['currentBlockList'];
		$this->uagFlag            = $pageAssets['uagFlag'];
		$this->stylesheet          = apply_filters( 'vxt_page_assets_css', $pageAssets['css'] );
		$this->script              = apply_filters( 'vxt_page_assets_js', $pageAssets['js'] );
		$this->gfonts              = $pageAssets['gfonts'];
		$this->gfontsFiles        = $pageAssets['gfontsFiles'];
		$this->gfontsUrl          = $pageAssets['gfontsUrl'];
		$this->uagFaqLayout      = $pageAssets['uagFaqLayout'];
		$this->assetsFileHandler = array_merge( $cssAssetInfo, $jsAssetInfo );

		return false;
	}

	/**
	 * Enqueue all page assets.
	 *
	 * @since 1.23.0
	 */
	public function enqueueScripts() {
		if ( \Vexaltrix\Presentation\Admin\AdminSettings::shouldExcludeAssetsForCpt() ) {
			return; // Early return to prevent loading assets.
		}
		
		$blocks = [];
		if ( \Vexaltrix\Presentation\Admin\AdminSettings::isBlockTheme() ) {
			global $_wp_current_template_content;
			if ( isset( $_wp_current_template_content ) ) {
				$blocks = parse_blocks( $_wp_current_template_content );
			}
		}
		// Global Required assets.
		// If the current template has content and contains blocks, execute this code block.
		if ( has_blocks( $this->postId ) || has_blocks( $blocks ) ) {
			/* Print conditional css for all blocks */
			add_action( 'wp_head', [ $this, 'printConditionalCss' ], 80 );
		}

		// For Vexaltrix Global Block Styles.
		$this->vexaltrixGbsLoadStyles();

		// UAG Flag specific.
		if ( $this->isAllowedAssetsGeneration ) {

			// Prepare font css and files.
			$this->generateFonts();

			$this->generateAssets();
			$this->generateAssetFiles();
		}
		if ( $this->uagFlag ) {

			// Register Assets for Frontend & Enqueue for Editor.
			\Vexaltrix\Core\Support\ScriptsUtils::enqueueBlocksDependencyBoth();

			// Enqueue all dependency assets.
			$this->enqueueBlocksDependencyFrontend();

			// RTL Styles Support.
			\Vexaltrix\Core\Support\ScriptsUtils::enqueueBlocksRtlStyles();

			if ( $this->loadUagFonts ) {
				// Render google fonts.
				$this->renderGoogleFonts();
			}

			if ( 'enabled' === $this->fileGeneration ) {
				// Enqueue File Generation Assets Files.
				$this->enqueueFileGenerationAssets();
			}

			// Print Dynamic CSS.
			if ( 'disabled' === $this->fileGeneration || $this->fallbackCss ) {
				\Vexaltrix\Core\Support\ScriptsUtils::enqueueBlocksStyles(); // Enqueue block styles.
				add_action( 'wp_head', [ $this, 'printStylesheet' ], 80 );
			}
			// Print Dynamic JS.
			if ( 'disabled' === $this->fileGeneration || $this->fallbackJs ) {
				add_action( 'wp_footer', [ $this, 'printScript' ], 1000 );
			}
		} else {
			// this custom css load,if only WP core block is present on the page.
			if ( $this->stylesheet ) {
				add_action( 'wp_head', [ $this, 'printStylesheet' ], 80 );
			}
		}
	}
	/**
	 * Get saved fonts.
	 *
	 * @since 2.0.0
	 *
	 * @return array
	 */
	public function getFonts() {

		return $this->gfonts;
	}

	/**
	 * This function updates the Page assets in the Page Meta Key.
	 *
	 * @since 1.23.0
	 */
	public function updatePageAssets() {

		if ( $this->preview || $this->isPostRevision ) {
			return;
		}

		$metaArray = [
			'css'                => wp_slash( $this->stylesheet ),
			'js'                 => $this->script,
			'currentBlockList' => $this->currentBlockList,
			'uagFlag'           => $this->uagFlag,
			'vxt_version'        => VXT_ASSET_VER,
			'gfonts'             => $this->gfonts,
			'gfontsUrl'         => $this->gfontsUrl,
			'gfontsFiles'       => $this->gfontsFiles,
			'uagFaqLayout'     => $this->uagFaqLayout,
		];

		update_post_meta( $this->postId, '_vxt_page_assets', $metaArray );
	}
	/**
	 * This is the action where we create dynamic asset files.
	 * CSS Path : uploads/uag-plugin/uag-style-{postId}.css
	 * JS Path : uploads/uag-plugin/uag-script-{postId}.js
	 *
	 * @since 1.15.0
	 */
	public function generateAssetFiles() {

		if ( 'enabled' === $this->fileGeneration ) {
			$this->fileWrite( $this->stylesheet, 'css', $this->postId );
			$this->fileWrite( $this->script, 'js', $this->postId );
		}

		$this->updatePageAssets();
	}

	/**
	 * Enqueue Gutenberg block assets for both frontend + backend.
	 *
	 * @since 1.13.4
	 */
	public function enqueueBlocksDependencyFrontend() {

		$blockListForAssets = $this->currentBlockList;

		$blocks = \Vexaltrix\Presentation\Blocks\BlockModule::getBlocksInfo();

		$blockAssets = \Vexaltrix\Presentation\Blocks\BlockModule::getBlockDependencies();

		foreach ( $blockListForAssets as $key => $currBlockName ) {

			$staticDependencies = ( isset( $blocks[ $currBlockName ]['static_dependencies'] ) ) ? $blocks[ $currBlockName ]['static_dependencies'] : [];

			foreach ( $staticDependencies as $assetHandle => $assetInfo ) {

				if ( 'js' === $assetInfo['type'] ) {
					// Scripts.
					if ( 'vxt-faq-js' === $assetHandle ) {
							wp_enqueue_script( 'vxt-faq-js' );
					} else {

						wp_enqueue_script( $assetHandle );
					}
				}

				if ( 'css' === $assetInfo['type'] ) {
					// Styles.
					wp_enqueue_style( $assetHandle );
				}
			}
		}

		$vxtUltimateGutenbergBlocksMasonryAjaxNonce = wp_create_nonce( 'vxt_ultimate_gutenberg_blocks_masonry_ajax_nonce' );
		$vxtUltimateGutenbergBlocksGridAjaxNonce    = wp_create_nonce( 'vxt_ultimate_gutenberg_blocks_grid_ajax_nonce' );
		wp_localize_script(
			'vxt-post-js',
			'vxt_ultimate_gutenberg_blocks_data',
			[
				'ajax_url'                => admin_url( 'admin-ajax.php' ),
				'vxt_ultimate_gutenberg_blocks_masonry_ajax_nonce' => $vxtUltimateGutenbergBlocksMasonryAjaxNonce,
				'vxt_ultimate_gutenberg_blocks_grid_ajax_nonce'    => $vxtUltimateGutenbergBlocksGridAjaxNonce,
			]
		);

		$vxtUltimateGutenbergBlocksFormsAjaxNonce = wp_create_nonce( 'vxt_ultimate_gutenberg_blocks_forms_ajax_nonce' );
		wp_localize_script(
			'vxt-forms-js',
			'vxt_ultimate_gutenberg_blocks_forms_data',
			[
				'ajax_url'              => admin_url( 'admin-ajax.php' ),
				'vxt_ultimate_gutenberg_blocks_forms_ajax_nonce' => $vxtUltimateGutenbergBlocksFormsAjaxNonce,
				'recaptchaSiteKeyV2' => \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_recaptcha_site_key_v2', '' ),
				'recaptchaSiteKeyV3' => \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_recaptcha_site_key_v3', '' ),
			]
		);

		wp_localize_script(
			'vxt-container-js',
			'vxt_ultimate_gutenberg_blocks_container_data',
			[
				'tablet_breakpoint' => VXT_TABLET_BREAKPOINT,
				'mobile_breakpoint' => VXT_MOBILE_BREAKPOINT,
			]
		);

		wp_localize_script(
			'vxt-timeline-js',
			'vxt_ultimate_gutenberg_blocks_timeline_data',
			[
				'tablet_breakpoint' => VXT_TABLET_BREAKPOINT,
				'mobile_breakpoint' => VXT_MOBILE_BREAKPOINT,
			]
		);

		do_action( 'vexaltrix_localize_pro_block_ajax' );

	}

	/**
	 * Enqueue File Generation Files.
	 */
	public function enqueueFileGenerationAssets() {

		$fileHandler = $this->assetsFileHandler;

		/*
		* Added filter to allows developers and users to adjust constant values for theme compatibility, easy updates, and compatibility with other plugins.
		*/
		$vxtUltimateGutenbergBlocksAssetVer = apply_filters( 'vxt_ultimate_gutenberg_blocks_asset_version', VXT_ASSET_VER );

		if ( empty( $vxtUltimateGutenbergBlocksAssetVer ) || ! is_string( $vxtUltimateGutenbergBlocksAssetVer ) ) {
			$vxtUltimateGutenbergBlocksAssetVer = VXT_ASSET_VER;
		}

		if ( isset( $fileHandler['css_url'] ) ) {
			wp_enqueue_style( 'uag-style-' . $this->postId, $fileHandler['css_url'], [], $vxtUltimateGutenbergBlocksAssetVer, 'all' );
		} else {
			$this->fallbackCss = true;
		}
		if ( isset( $fileHandler['js_url'] ) ) {
			wp_enqueue_script( 'uag-script-' . $this->postId, $fileHandler['js_url'], [], $vxtUltimateGutenbergBlocksAssetVer, true );
		} else {
			$this->fallbackJs = true;
		}
	}
	/**
	 * Print the Script in footer.
	 */
	public function printScript() {

		if ( empty( $this->script ) ) {
			return;
		}

		echo '<script type="text/javascript" id="vxt-script-frontend-' . esc_attr( $this->postId ) . '">' . $this->script . '</script>'; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaping not required.
	}

	/**
	 * Print the Stylesheet in header.
	 */
	public function printStylesheet() {

		if ( empty( $this->stylesheet ) ) {
			return;
		}
		echo '<style id="vxt-style-frontend-' . esc_attr( $this->postId ) . '">' . $this->stylesheet . '</style>'; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaping not required.
	}

	/**
	 * Print Conditional blocks css.
	 */
	public function printConditionalCss() {

		if ( self::$conditionalBlocksPrinted ) {
			return;
		}

		$conditionalBlockCss = \Vexaltrix\Presentation\Blocks\BlockHelper::getConditionBlockCss();

		if ( in_array( 'vexaltrix/masonry-gallery', $this->currentBlockList, true ) ) {
			$conditionalBlockCss .= \Vexaltrix\Presentation\Blocks\BlockHelper::getMasonryGalleryCss();
		}
		echo '<style id="vxt-style-conditional-extension">' . $conditionalBlockCss . '</style>'; //phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped - Escaping not required.

		self::$conditionalBlocksPrinted = true;

	}

	/**
	 * Generate google fonts link and font files
	 *
	 * @since 2.0.0
	 *
	 * @return void
	 */
	public function generateFonts() {

		if ( ! $this->loadUagFonts || empty( $this->gfonts ) ) {
			return;
		}

		$fontsLink = '';
		$fontsAttr = '';
		$extraAttr = '';
		$fontsSlug = [];

		// Sort key for same md5 id while loading native fonts.
		ksort( $this->gfonts );

		foreach ( $this->gfonts as $key => $gfontValues ) {
			if ( ! empty( $fontsAttr ) ) {
				$fontsAttr .= '|'; // Append a new font to the string.
			}
			if ( empty( $gfontValues['fontfamily'] ) && is_string( $gfontValues['fontfamily'] ) ) {
				continue;
			}
			$fontsAttr  .= str_replace( ' ', '+', $gfontValues['fontfamily'] );
			$fontsSlug[] = sanitize_key( str_replace( ' ', '-', strtolower( $gfontValues['fontfamily'] ) ) );
			if ( ! empty( $gfontValues['fontvariants'] ) ) {
				$fontsAttr .= ':';
				$fontsAttr .= implode( ',', $gfontValues['fontvariants'] );
				foreach ( $gfontValues['fontvariants'] as $key => $fontVariants ) {
					$fontsAttr .= ',' . $fontVariants . 'italic';
				}
			}
		}

		$subsets = apply_filters( 'vxt_font_subset', [] );

		if ( ! empty( $subsets ) ) {
			$extraAttr .= '&subset=' . implode( ',', $subsets );
		} else {
			$extraAttr .= '&subset=latin';
		}

		$display = apply_filters( 'vxt_font_disaply', 'fallback' );

		if ( ! empty( $display ) ) {
			$extraAttr .= '&display=' . $display;
		}

		if ( isset( $fontsAttr ) && ! empty( $fontsAttr ) ) {

			// link without https protocol.
			$fontsLink = '//fonts.googleapis.com/css?family=' . esc_attr( $fontsAttr ) . $extraAttr;

			if ( 'enabled' === $this->loadGfontsLocally ) {

				// Include the font loader file.
				require_once VXT_DIR . 'app/lib/webfont/webfont-loader.php';

				// link with https protocol to download fonts.
				$fontsLink = 'https:' . $fontsLink;

				$fontsData = vxt_ultimate_gutenberg_blocks_get_webfont_remote_styles( $fontsLink );

				$this->stylesheet = $fontsData . $this->stylesheet;

				if ( 'enabled' === $this->preloadLocalFonts ) {

					$fontFiles = vxt_ultimate_gutenberg_blocks_get_preloadLocalFonts( $fontsLink );

					if ( is_array( $fontFiles ) && ! empty( $fontFiles ) ) {
						foreach ( $fontFiles as $fileData ) {

							if ( isset( $fileData['font_family'] ) && in_array( $fileData['font_family'], $fontsSlug, true ) ) {

								$this->gfontsFiles[ $fileData['font_family'] ] = $fileData['font_url'];
							}
						}
					}
				}
			}

			// Set fonts url.
			$this->gfontsUrl = $fontsLink;
		}

		/* Update page assets */
		$this->updatePageAssets();
	}

	/**
	 * Load the Google Fonts.
	 */
	public function renderGoogleFonts() {

		if ( empty( $this->gfonts ) || empty( $this->gfontsUrl ) ) {
			return;
		}

		$showGoogleFonts = apply_filters( 'vxt_ultimate_gutenberg_blocks_blocks_show_google_fonts', true );

		if ( ! $showGoogleFonts ) {
			return;
		}

		// Load remote google fonts if local font is disabled.
		if ( 'disabled' === $this->loadGfontsLocally ) {

			// Enqueue google fonts.
			wp_enqueue_style( 'uag-google-fonts-' . $this->postId, $this->gfontsUrl, [], VXT_VER, 'all' );

		} else {

			// Preload woff files local font preload is enabled.
			if ( 'enabled' === $this->preloadLocalFonts ) {

				if ( is_array( $this->gfontsFiles ) && ! empty( $this->gfontsFiles ) ) {

					foreach ( $this->gfontsFiles as $gfontFileUrl ) {
						echo '<link rel="preload" href="' . esc_url( $gfontFileUrl ) . '" as="font" type="font/woff2">'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped - Escaping not required.
					}
				}
			}
		}
	}

	/**
	 * Load the front end Google Fonts.
	 */
	public function printGoogleFonts() {

		if ( empty( $this->gfontsUrl ) ) {
			return;
		}

		$showGoogleFonts = apply_filters( 'vxt_ultimate_gutenberg_blocks_blocks_show_google_fonts', true );
		if ( ! $showGoogleFonts ) {
			return;
		}

		if ( ! empty( $this->gfontsUrl ) ) {
			echo '<link href="' . esc_url( $this->gfontsUrl ) . '" rel="stylesheet">'; //phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet
		}
	}

	/**
	 * Generates CSS recurrsively.
	 *
	 * @param object $block The block object.
	 * @since 0.0.1
	 */
	public function getBlockCssAndJs( $block ) {

		$block = (array) $block;

		$name     = $block['blockName'];
		$css      = [];
		$js       = '';
		$blockId = '';

		if ( ! isset( $name ) ) {
			return [
				'css' => [],
				'js'  => '',
			];
		}

		if ( isset( $block['attrs'] ) && is_array( $block['attrs'] ) ) {
			/**
			 * Filters the block attributes for CSS and JS generation.
			 *
			 * @param array  $blockAttributes The block attributes to be filtered.
			 * @param string $name             The block name.
			 */
			$blockattr = apply_filters( 'vxt_ultimate_gutenberg_blocks_block_attributes_for_css_and_js', $block['attrs'], $name );
			if ( isset( $blockattr['block_id'] ) ) {
				$blockId = $blockattr['block_id'];
			}
		}

		$this->currentBlockList[] = $name;

		if ( 'core/gallery' === $name && isset( $block['attrs']['masonry'] ) && true === $block['attrs']['masonry'] ) {
			$this->currentBlockList[] = 'vexaltrix/masonry-gallery';
			$this->uagFlag             = true;
			$css                       += \Vexaltrix\Presentation\Blocks\BlockHelper::getGalleryCss( $blockattr, $blockId );
		}

		// If UAGAnimationType is set and is not equal to none, explicitly load the extension (and it's assets) on frontend.
		// Also check if animations extension is enabled.
		if (
			'enabled' === \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_enable_animations_extension', 'enabled' ) &&
			! empty( $block['attrs']['UAGAnimationType'] )
		) {
			$this->currentBlockList[] = 'vexaltrix/animations-extension';
		}

		if ( strpos( $name, 'vexaltrix/' ) !== false ) {
			$this->uagFlag = true;
		}

		// Add static css here.
		$blocks = \Vexaltrix\Presentation\Blocks\BlockModule::getBlocksInfo();

		$blockCssFileName = isset( $blocks[ $name ]['static_css'] ) ? $blocks[ $name ]['static_css'] : str_replace( 'vexaltrix/', '', $name );

		if ( 'enabled' === $this->fileGeneration && ! in_array( $blockCssFileName, $this->staticCssBlocks, true ) ) {
			$commonCss = [
				'common' => $this->getBlockStaticCss( $blockCssFileName ),
			];
			$css       += $commonCss;
		}

		if ( strpos( $name, 'vexaltrix/' ) !== false ) {
			$blockSlug = str_replace( 'vexaltrix/', '', $name );

			$blockattr = isset( $blockattr ) && is_array( $blockattr ) ? $blockattr : [];

			$blockCss = \Vexaltrix\Presentation\Blocks\BlockModule::getFrontendCss( $blockSlug, $blockattr, $blockId );
			$blockJs  = \Vexaltrix\Presentation\Blocks\BlockModule::getFrontendJs( $blockSlug, $blockattr, $blockId, 'js' );
			$css        = $this->mergeArrayStringValues( $css, $blockCss );
			if ( ! empty( $blockJs ) ) {
				$js .= $blockJs;
			}

			if ( 'vexaltrix/faq' === $name && ! isset( $blockattr['layout'] ) ) {
				$this->uagFaqLayout = true;
			}
		}

		if ( isset( $block['innerBlocks'] ) ) {
			foreach ( $block['innerBlocks'] as $j => $innerBlock ) {
				if ( 'core/block' === $innerBlock['blockName'] ) {
					$id = ( isset( $innerBlock['attrs']['ref'] ) ) ? $innerBlock['attrs']['ref'] : 0;
					if ( $id ) {
						// Check if we've already processed this block ID to prevent infinite recursion.
						if ( ! in_array( $id, self::$seenRefs, true ) ) {
							self::$seenRefs[] = $id;
							$assets            = $this->getAssetsUsingPostContent( $id );
							if ( function_exists( 'wp_is_block_theme' ) && wp_is_block_theme() ) {
								$reuseBlockCss             = [
									'desktop' => '',
									'tablet'  => '',
									'mobile'  => '',
								];
								$reuseBlockCss['desktop'] .= $assets['css'];
								$css                         = $this->mergeArrayStringValues( $css, $reuseBlockCss );
								$js                         .= $assets['js'];
							} else {
								$this->stylesheet .= $assets['css'];
								$this->script     .= $assets['js'];
							}
						}
					}
				} elseif ( 'core/template-part' === $innerBlock['blockName'] ) {
					$id = $this->getFseTemplatePart( $innerBlock );

					if ( $id ) {
						// Check if we've already processed this template part ID.
						if ( ! in_array( $id, self::$seenRefs, true ) ) {
							self::$seenRefs[] = $id;
							$assets            = $this->getAssetsUsingPostContent( $id );
							$this->stylesheet .= $assets['css'];
							$this->script     .= $assets['js'];
						}
					}
				} else {
					// Get CSS for the Block.
					$innerAssets    = $this->getBlockCssAndJs( $innerBlock );
					$innerBlockCss = $innerAssets['css'];

					$cssDesktop = ( isset( $css['desktop'] ) ? $css['desktop'] : '' );
					$cssTablet  = ( isset( $css['tablet'] ) ? $css['tablet'] : '' );
					$cssMobile  = ( isset( $css['mobile'] ) ? $css['mobile'] : '' );

					if ( 'enabled' === $this->fileGeneration ) { // Get common CSS for the block when file generation is enabled.
						$cssCommon = ( isset( $css['common'] ) ? $css['common'] : '' );
						if ( isset( $innerBlockCss['common'] ) ) {
							$css['common'] = $cssCommon . $innerBlockCss['common'];
						}
					}

					if ( isset( $innerBlockCss['desktop'] ) ) {
						$css['desktop'] = $cssDesktop . $innerBlockCss['desktop'];
						$css['tablet']  = $cssTablet . $innerBlockCss['tablet'];
						$css['mobile']  = $cssMobile . $innerBlockCss['mobile'];
					}

					$js .= $innerAssets['js'];
				}
			}
		}

		$this->currentBlockList = array_unique( $this->currentBlockList );

		return [
			'css' => $css,
			'js'  => $js,
		];

	}

	/**
	 * Generates stylesheet and appends in head tag.
	 *
	 * @since 0.0.1
	 */
	public function generateAssets() {

		/* Finalize prepared assets and store in static variable */
		global $contentWidth;

		$this->stylesheet = str_replace( '#CONTENT_WIDTH#', $contentWidth . 'px', $this->stylesheet );

		if ( '' !== $this->script ) {
			$this->script = 'document.addEventListener("DOMContentLoaded", function(){ ' . $this->script . ' });';
		}

		/* Update page assets */
		$this->updatePageAssets();
	}

	/**
	 * Get SureCart Template Part Content.
	 * 
	 * @param string $id Template part ID.
	 * @param string $templatePartName Name of the template part.
	 * @return string Return the template part content.
	 * @since 2.19.5
	 */
	public function getSurecartTemplatePartContent( $id, $templatePartName ) {
		if ( 'cart' === $templatePartName ) {
			$templatePartId = 'surecart/surecart//cart';
			$template         = get_block_template( $templatePartId, 'wp_template_part' );
			return ( isset( $template->content ) && is_string( $template->content ) ) ? $template->content : '';
		}

		if ( 'upsell' === $templatePartName ) {
			$upsellData = get_query_var( 'surecart_current_upsell' );
			
			if ( is_object( $upsellData ) && isset( $upsellData->metadata->wp_template_part_id ) ) {
				$templatePartId = $upsellData->metadata->wp_template_part_id;
				$template         = get_block_template( $templatePartId, 'wp_template_part' );
				return ( isset( $template->content ) && is_string( $template->content ) ) ? $template->content : '';
			} else {
				return '';
			}
		}

		// Available SureCart functions to get the template part id.
		$surecartFunctions = [
			'single_product'     => 'sc_get_product',
			'product_collection' => 'sc_get_collection',
		];

		if ( ! isset( $surecartFunctions[ $templatePartName ] ) || ! function_exists( $surecartFunctions[ $templatePartName ] ) ) {
			return '';
		}

		$templateData = call_user_func( $surecartFunctions[ $templatePartName ], $id );

		if ( 'single_product' === $templatePartName ) {
			if ( ! is_object( $templateData ) || empty( $templateData->template_part_id ) ) {
				return '';
			}
			$templatePartId = $templateData->template_part_id;
		} elseif ( 'product_collection' === $templatePartName ) {
			if ( ! is_object( $templateData ) || empty( $templateData->template_part->id ) ) {
				return '';
			}
			$templatePartId = $templateData->template_part->id;
		} else {
			return '';
		}

		$template = get_block_template( $templatePartId, 'wp_template_part' );
		
		return ( isset( $template->content ) && is_string( $template->content ) ) ? $template->content : '';
	}

	/**
	 * Generates stylesheet in loop.
	 *
	 * @param object $thisPost Current Post Object.
	 * @since 1.7.0
	 */
	public function prepareAssets( $thisPost ) {

		if ( ! $thisPost instanceof WP_Post ) {
			return;
		}
		// Store the original post content into dummy variable.
		$thisPostPostContent = $thisPost->post_content;

		$surecartTemplateParts = [ 'single_product', 'product_collection', 'cart', 'upsell' ];

		foreach ( $surecartTemplateParts as $templatePartName ) {
			$templatePartContent = $this->getSurecartTemplatePartContent( (string) $thisPost->ID, $templatePartName );
	
			if ( ! empty( $templatePartContent ) && has_blocks( $templatePartContent ) && isset( $thisPostPostContent ) ) {
				$templateContents[] = $templatePartContent;
			}
		}
		// Combine all template part contents into a dummy variable.
		if ( ! empty( $templateContents ) && isset( $thisPostPostContent ) ) {
			$thisPostPostContent .= implode( '', $templateContents );
		}
		// Prepare assets.
		if ( $thisPost instanceof WP_Post && ( has_blocks( $thisPost->ID ) || has_blocks( $thisPostPostContent ) ) ) {
			$this->commonFunctionForAssetsPreparation( $thisPostPostContent );
		}
	}

	/**
	 * Common function to generate stylesheet.
	 *
	 * @param string $postContent Current Post Object.
	 * @since 2.0.0
	 */
	public function commonFunctionForAssetsPreparation( $postContent ) {
		// Reset seen refs for each new content processing.
		self::$seenRefs = [];

		$blocks = $this->parseBlocks( $postContent );

		$this->pageBlocks = $blocks;

		$enableOnPageCssButton = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_enable_on_page_css_button', 'yes' );

		if ( 'yes' === $enableOnPageCssButton ) {
			$customCss = get_post_meta( $this->postId, '_vxt_custom_page_level_css', true );

			$customCss = ! empty( $customCss ) && is_string( $customCss ) ? $customCss : '';

			if ( ! empty( $customCss ) && ! self::$customCssAppended ) {
				$this->stylesheet         .= \Vexaltrix\Presentation\Admin\AdminSettings::sanitizeInlineCss( $customCss );
				self::$customCssAppended = true;
			}
		}

		if ( ! is_array( $blocks ) || empty( $blocks ) ) {
			return;
		}

		$assets = $this->getBlocksAssets( $blocks );


		if ( 'enabled' === $this->fileGeneration && isset( $assets['css'] ) && ! self::$commonAssetsAdded ) {

			$commonStaticCssAllBlocks = $this->getBlockStaticCss( 'extensions' );
			$assets['css']                = $assets['css'] . $commonStaticCssAllBlocks;
			self::$commonAssetsAdded    = true;
		}

		$this->stylesheet .= $assets['css'];
		$this->script     .= $assets['js'];

		// Update fonts.
		$this->gfonts = array_merge( $this->gfonts, \Vexaltrix\Core\Support\Helper::$gfonts );
	}

	/**
	 * Parse Guten Block.
	 *
	 * @param string $content the content string.
	 * @since 1.1.0
	 */
	public function parseBlocks( $content ) {

		global $wp_version;

		return ( version_compare( $wp_version, '5', '>=' ) ) ? parse_blocks( $content ) : gutenberg_parse_blocks( $content );
	}

	/**
	 * Generates ids for all wp template part.
	 *
	 * @param array $block the content array.
	 * @since 2.4.1
	 */
	public function getFseTemplatePart( $block ) {
		if ( empty( $block['attrs']['slug'] ) ) {
			return;
		}

		$slug            = $block['attrs']['slug'];
		$templatesParts = get_block_templates( [ 'slug__in' => [ $slug ] ], 'wp_template_part' );
		foreach ( $templatesParts as $templatesPart ) {
			if ( $slug === $templatesPart->slug ) {
				$id = $templatesPart->wp_id;
				return $id;
			}
		}
	}

	/**
	 * Generates parse content for all blocks including reusable blocks.
	 *
	 * @param int $id of blocks.
	 * @since 2.4.1
	 */
	public function getAssetsUsingPostContent( $id ) {
		// Add to seen refs to prevent processing the same block multiple times.
		self::$seenRefs[] = $id;

		$content         = get_post_field( 'post_content', $id );
		$reusableBlocks = $this->parseBlocks( $content );
		$assets          = $this->getBlocksAssets( $reusableBlocks );

		return $assets;
	}

	/**
	 * Generates assets for all blocks including reusable blocks.
	 *
	 * @param array $blocks Blocks array.
	 * @since 1.1.0
	 */
	public function getBlocksAssets( $blocks ) {
		// Ensure we're not processing the same blocks repeatedly.
		$staticAndDynamicAssets = $this->getStaticAndDynamicAssets( $blocks );
		return [
			'css' => $staticAndDynamicAssets['static'] . $staticAndDynamicAssets['dynamic'],
			'js'  => $staticAndDynamicAssets['js'],
		];
	}

	/**
	 * Get static & dynamic css for block.
	 *
	 * @param array $blocks Blocks array.
	 * @since 2.12.3
	 * @return array Of static and dynamic css and js.
	 */
	public function getStaticAndDynamicAssets( $blocks ) {
		$desktop    = '';
		$tablet     = '';
		$mobile     = '';
		$staticCss = '';

		$tabStylingCss = '';
		$mobStylingCss = '';
		$blockCss       = '';
		$js              = '';

		foreach ( $blocks as $i => $block ) {

			if ( is_array( $block ) ) {

				if ( empty( $block['blockName'] ) || ! isset( $block['attrs'] ) ) {
					continue;
				}

				if ( 'core/block' === $block['blockName'] ) {
					$id = ( isset( $block['attrs']['ref'] ) ) ? $block['attrs']['ref'] : 0;

					if ( $id ) {
						// Check if we've already processed this block ID.
						if ( ! in_array( $id, self::$seenRefs, true ) ) {
							$assets            = $this->getAssetsUsingPostContent( $id );
							$this->stylesheet .= $assets['css'];
							$this->script     .= $assets['js'];
						}
					}
				} elseif ( 'core/template-part' === $block['blockName'] ) {
					$id = $this->getFseTemplatePart( $block );

					if ( $id ) {
						// Check if we've already processed this template part ID.
						if ( ! in_array( $id, self::$seenRefs, true ) ) {
							$assets     = $this->getAssetsUsingPostContent( $id );
							$blockCss .= $assets['css'];
							$js        .= $assets['js'];
						}
					}
				} elseif ( 'core/pattern' === $block['blockName'] ) {
					$getAssets = $this->getCorePatternAssets( $block );

					if ( ! empty( $getAssets['css'] ) ) {
						$blockCss .= $getAssets['css'];
						$js        .= $getAssets['js'];
					}
				} else {
					// Add your block specif css here.
					$blockAssets = $this->getBlockCssAndJs( $block );
					// Get CSS for the Block.
					$css = $blockAssets['css'];

					if ( ! empty( $css['common'] ) ) {
						$staticCss .= $css['common'];
					}

					if ( isset( $css['desktop'] ) ) {
						$desktop .= $css['desktop'];
						$tablet  .= $css['tablet'];
						$mobile  .= $css['mobile'];
					}
					$js .= $blockAssets['js'];
				}
			}
		}

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
		return [
			'static'  => $staticCss,
			'dynamic' => $blockCss . $desktop . $tabStylingCss . $mobStylingCss,
			'js'      => $js,
		];
	}

	/**
	 * Creates a new file for Dynamic CSS/JS.
	 *
	 * @param  string $fileData The data that needs to be copied into the created file.
	 * @param  string $type Type of file - CSS/JS.
	 * @param  string $fileState Wether File is new or old.
	 * @param  string $oldFileName Old file name timestamp.
	 * @since 1.15.0
	 * @return boolean true/false
	 */
	public function createFile( $fileData, $type, $fileState = 'new', $oldFileName = '' ) {

		$uploadsDir = \Vexaltrix\Core\Support\Helper::getUploadDir();
		$fileSystem = \Vexaltrix\Core\Support\Filesystem::getInstance()->getFilesystem();

		// Example 'uag-css-15.css'.
		$fileName = 'uag-' . $type . '-' . $this->postId . '.' . $type;

		if ( 'old' === $fileState ) {
			$fileName = $oldFileName;
		}

		$folderName    = \Vexaltrix\Core\Support\ScriptsUtils::getAssetFolderName( $this->postId );
		$baseFilePath = $uploadsDir['path'] . 'assets/' . $folderName . '/';
		$filePath      = $uploadsDir['path'] . 'assets/' . $folderName . '/' . $fileName;

		$result = false;

		/**
		 * LEGACY CLEANUP REMOVED (v3.0.0+)
		 *
		 * Previously deleted old timestamped files (uag-css-123-1234567890.css).
		 * Removed as scheduled after 3 major releases from v2.11.0.
		 * Current format uses static names (uag-css-123.css) that safely overwrite.
		 */

		if ( wp_mkdir_p( $baseFilePath ) ) {

			// Create a new file.
			$result = $fileSystem->put_contents( $filePath, $fileData, FS_CHMOD_FILE );

			if ( $result && ! $this->isPostRevision ) {
				// Update meta with current timestamp.
				update_post_meta( $this->postId, '_vxt_' . $type . '_file_name', $fileName );
			}
		}

		return $result;
	}

	/**
	 * Creates css and js files.
	 *
	 * @param  var    $fileData    Gets the CSS\JS for the current Page.
	 * @param  string $type    Gets the CSS\JS type.
	 * @param  int    $postId Post ID.
	 * @since  1.14.0
	 */
	public function fileWrite( $fileData, $type = 'css', $postId = 0 ) {

		if ( ! $this->postId ) {
			return false;
		}

		$fileSystem = \Vexaltrix\Core\Support\Filesystem::getInstance()->getFilesystem();

		// Get timestamp - Already saved OR new one.
		$fileName   = get_post_meta( $this->postId, '_vxt_' . $type . '_file_name', true );
		$fileName   = empty( $fileName ) ? '' : $fileName;
		$assetsInfo = \Vexaltrix\Core\Support\ScriptsUtils::getAssetInfo( $type, $this->postId );
		$filePath   = $assetsInfo[ $type ];

		if ( '' === $fileData ) {
			/**
			 * When CSS/JS generation returns empty, KEEP existing file.
			 *
			 * CRITICAL FIX: Empty output could mean:
			 * 1. Page has no Vexaltrix blocks (legitimate)
			 * 2. Generation failed (parse error, memory limit, cache issue)
			 *
			 * We cannot distinguish between these cases, so we keep the old file.
			 * Better to serve old CSS than no CSS (404 error with page cache).
			 */

			if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
				// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
				error_log(
					sprintf(
						'Vexaltrix: CSS/JS generation returned empty for post %d (type: %s). Keeping existing file to prevent 404.',
						$this->postId,
						$type
					) 
				);
			}

			return false; // Signal that generation did not produce new content.
		}

		/**
		 * Timestamp present but file does not exists.
		 * This is the case where somehow the files are delete or not created in first place.
		 * Here we attempt to create them again.
		 */
		if ( ! $fileSystem->exists( $filePath ) && '' !== $fileName ) {

			$didCreate = $this->createFile( $fileData, $type, 'old', $fileName );

			if ( $didCreate ) {
				$this->assetsFileHandler = array_merge( $this->assetsFileHandler, $assetsInfo );
			}

			return $didCreate;
		}

		/**
		 * Need to create new assets.
		 * No such assets present for this current page.
		 */
		if ( '' === $fileName ) {

			// Create a new file.
			$didCreate = $this->createFile( $fileData, $type );

			if ( $didCreate ) {
				$newAssetsInfo           = \Vexaltrix\Core\Support\ScriptsUtils::getAssetInfo( $type, $this->postId );
				$this->assetsFileHandler = array_merge( $this->assetsFileHandler, $newAssetsInfo );
			}

			return $didCreate;

		}

		/**
		 * File already exists.
		 * Need to match the content.
		 * If new content is present we update the current assets.
		 */
		if ( file_exists( $filePath ) ) {

			$oldData = $fileSystem->get_contents( $filePath );

			if ( $oldData !== $fileData ) {

				/**
				 * CRITICAL FIX: Don't delete old file before creating new one.
				 *
				 * Method create_file() uses put_contents() which overwrites existing files.
				 * If write fails, old file remains intact → No 404 error.
				 * This prevents CSS 404s with page-level caching.
				 */

				// Create a new file (will overwrite existing).
				$didCreate = $this->createFile( $fileData, $type );

				if ( $didCreate ) {
					$newAssetsInfo           = \Vexaltrix\Core\Support\ScriptsUtils::getAssetInfo( $type, $this->postId );
					$this->assetsFileHandler = array_merge( $this->assetsFileHandler, $newAssetsInfo );
				}

				return $didCreate;
			}
		}

		$this->assetsFileHandler = array_merge( $this->assetsFileHandler, $assetsInfo );

		return true;
	}

	/**
	 * Get Static CSS of Block.
	 *
	 * @param string $blockName Block Name.
	 *
	 * @return string Static CSS.
	 * @since 1.23.0
	 */
	public function getBlockStaticCss( $blockName ) {

		$css = '';

		$blockStaticCssPath = VXT_DIR . 'assets/css/blocks/' . $blockName . '.css';

		if ( file_exists( $blockStaticCssPath ) ) {

			$fileSystem = \Vexaltrix\Core\Support\Filesystem::getInstance()->getFilesystem();

			$css = $fileSystem->get_contents( $blockStaticCssPath );
		}

		array_push( $this->staticCssBlocks, $blockName );

		return apply_filters( 'vexaltrix_frontend_static_style', $css, $blockName );
	}

	/**
	 * Merge two arrays with string values.
	 *
	 * @param array $array1 First array.
	 * @param array $array2 Second array.
	 * @since 2.7.3
	 * @return array
	 */
	public function mergeArrayStringValues( $array1, $array2 ) {
		foreach ( $array1 as $key => $value ) {
			if ( isset( $array2[ $key ] ) ) {
				$array1[ $key ] = $value . $array2[ $key ];
			}
			unset( $array2[ $key ] );
		}

		return array_merge( $array1, $array2 );
	}

	/**
	 * Handle the block assets when blocks type will be core/pattern.
	 *
	 * @param array $block The block array.
	 * @since 2.9.1
	 * @return array
	 */
	public function getCorePatternAssets( $block ) {
		if ( empty( $block['attrs']['slug'] ) ) {
			return [];
		}

		$slug = $block['attrs']['slug'];

		// Check class and function exists.
		if ( ! class_exists( 'WP_Block_Patterns_Registry' ) || ! method_exists( 'WP_Block_Patterns_Registry', 'getInstance' ) ) {
			return [];
		}

		$registry = WP_Block_Patterns_Registry::getInstance();

		// Check is_registered method exists.
		if ( ! method_exists( $registry, 'is_registered' ) || ! method_exists( $registry, 'get_registered' ) || ! $registry->is_registered( $slug ) ) {
			return [];
		}

		$pattern = $registry->get_registered( $slug );

		return $this->getBlocksAssets( parse_blocks( $pattern['content'] ) );
	}

	/**
	 * Get static and dynamic assets data for a post. Its a helper function used by starter templates and GT library.
	 *
	 * @param int $postId The post id.
	 * @since 2.12.3
	 * @return array of Static and dynamic css and js.
	 */
	public function getStaticAndDynamicCss( $postId ) {
		// Reset seen refs for each new post processing.
		self::$seenRefs = [];

		$thisPost = get_post( $postId );

		if ( empty( $thisPost ) || empty( $thisPost->ID ) ) {
			return [];
		}

		if ( has_blocks( $thisPost->ID ) && ! empty( $thisPost->post_content ) ) {

			$blocks = $this->parseBlocks( $thisPost->post_content );

			if ( ! is_array( $blocks ) || empty( $blocks ) ) {
				return [];
			}

			return $this->getStaticAndDynamicAssets( $blocks );
		}

		return [];

	}


	/**
	 * Service group.
	 *
	 * @return string
	 */
}
