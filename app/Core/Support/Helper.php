<?php
/**
 * Vexaltrix Helper.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Core\Support;

use WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\\Support\\Helper' ) ) {

	/**
	 * Class \Vexaltrix\Core\Support\Helper.
	 */
	final class Helper {


		/**
		 * Member Variable
		 *
		 * @since 0.0.1
		 * @var instance
		 */
		private static $instance;

		/**
		 * Member Variable
		 *
		 * @since 0.0.1
		 * @var instance
		 */
		public static $blockList;

		/**
		 * UAG File Generation Flag
		 *
		 * @since 1.14.0
		 * @var string
		 */
		public static $fileGeneration = 'disabled';

		/**
		 * Store Json variable
		 *
		 * @since 1.8.1
		 * @var array
		 */
		public static $iconJson;

		/**
		 * Google fonts to enqueue
		 *
		 * @var array
		 */
		public static $gfonts = [];

		/**
		 * Current Block List
		 *
		 * @since 1.13.4
		 * @var current_block_list
		 * @deprecated 1.23.0
		 */
		public static $currentBlockList = [];

		/**
		 * UAG Block Flag
		 *
		 * @since 1.13.4
		 * @var vxt_flag
		 * @deprecated 1.23.0
		 */
		public static $uagFlag = false;

		/**
		 * Page Blocks Variable
		 *
		 * @since 1.6.0
		 * @var page_blocks
		 * @deprecated 1.23.0
		 */
		public static $pageBlocks;

		/**
		 * Stylesheet
		 *
		 * @since 1.13.4
		 * @var stylesheet
		 * @deprecated 1.23.0
		 */
		public static $stylesheet = '';

		/**
		 * Script
		 *
		 * @since 1.13.4
		 * @var script
		 * @deprecated 1.23.0
		 */
		public static $script = '';

		/**
		 * UAG FAQ Layout Flag
		 *
		 * @since 1.18.1
		 * @deprecated 1.23.0
		 * @var vxt_faq_layout
		 */
		public static $uagFaqLayout = false;

		/**
		 * UAG TOC Flag
		 *
		 * @since 1.18.1
		 * @deprecated 1.23.0
		 * @var table_of_contents_flag
		 */
		public static $tableOfContentsFlag = false;

		/**
		 * As our svg icon is too long array so we will divide that into number of icon chunks.
		 *
		 * @var int
		 * @since 2.7.0
		 */
		public static $numberOfIconChunks = 4;

		/**
		 * We have icon list in chunks in this variable we will merge all insides array into one single array.
		 *
		 * @var array
		 * @since 2.7.0
		 */
		public static $iconArrayMerged = [];

		/**
		 *  Initiator
		 *
		 * @since 0.0.1
		 */
		public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 */
		public function __construct() {
			class_exists( 'Vexaltrix\Presentation\Blocks\\BlockHelper' );
			class_exists( 'Vexaltrix\Presentation\Blocks\\BlockJs' );

			/**
			 * Add action hook to initialize block list during WordPress initialization.
			 * This hook is needed to ensure that the block list is populated before any other actions are taken.
			 * The block list is used to generate the CSS and JS files for the blocks, and is also used to generate the block categories.
			 */
			add_action( 'init', [ $this, 'initializeBlockList' ] );
			self::$fileGeneration = self::allowFileGeneration();
			// Condition is only needed when we are using block based theme and Reading setting is updated.
			$this->readingPage();
		}

		/**
		 * Updates the asset version when the reading settings are updated in a block theme.
		 *
		 * This is needed because the reading settings affect the block layout and the asset version is used to cache the block CSS and JS assets.
		 *
		 * @since 2.19.5
		 * @return void
		 */
		public function readingPage() {
			// Check if it's a block theme and the appropriate POST data exists.
			$isBlockTheme         = function_exists( 'wp_is_block_theme' ) && wp_is_block_theme();
			$isReadingPageUpdate = isset( $_POST['option_page'], $_POST['action'] ) && 'reading' === $_POST['option_page'] && 'update' === $_POST['action']; // phpcs:ignore WordPress.Security.NonceVerification.Missing -- Nonce verification is not needed here.

			// Return early if the conditions are not met.
			if ( ! $isBlockTheme || ! $isReadingPageUpdate ) {
				return;
			}

			// Update the asset version when the reading settings are updated.
			\Vexaltrix\Presentation\Admin\AdminSettings::updateAdminSettingsOption( '__vxt_ultimate_gutenberg_blocks_asset_version', time() );

		}

		/**
		 * Initialize block list.
		 *
		 * @since 2.17.0
		 * @return void
		 */
		public function initializeBlockList() {
			self::$blockList = \Vexaltrix\Presentation\Blocks\BlockModule::getBlocksInfo();
		}

		/**
		 * Parse CSS into correct CSS syntax.
		 *
		 * @param array  $selectors The block selectors.
		 * @param string $id The selector ID.
		 * @since 0.0.1
		 */
		public static function generateCss( $selectors, $id ) {
			$stylingCss = '';

			if ( empty( $selectors ) ) {
				return '';
			}

			foreach ( $selectors as $key => $value ) {

				$css = '';

				foreach ( $value as $j => $val ) {

					if ( 'font-family' === $j && 'Default' === $val ) {
						continue;
					}

					if ( ! empty( $val ) || ( empty( $val ) && 'content' === $j ) || 0 === $val ) {
						if ( 'font-family' === $j ) {
							$css .= $j . ': "' . $val . '";';
						} else {
							if ( is_array( $val ) ) {
								// Convert $val array property to string.
								foreach ( $val as $index => $property ) {
									$properties = is_string( $property ) ? $property : (string) $property;
									$css       .= $j . ': ' . $properties . ';';
								}
							} else {
								$css .= $j . ': ' . $val . ';';
							}
						}
					}
				}

				if ( ! empty( $css ) ) {
					$stylingCss     .= $id;
					$stylingCss     .= $key . '{';
						$stylingCss .= $css . '}';
				}
			}

			return $stylingCss;
		}

		/**
		 * Get CSS value
		 *
		 * Syntax:
		 *
		 *  get_css_value( VALUE, UNIT );
		 *
		 * E.g.
		 *
		 *  get_css_value( VALUE, 'em' );
		 *
		 * @param mixed  $value  CSS value.
		 * @param string $unit  CSS unit.
		 * @since 1.13.4
		 */
		public static function getCssValue( $value = '', $unit = '' ) {
			if ( ! is_numeric( $value ) ) {
				return '';
			}

			$unit = sanitize_text_field( $unit );

			if ( empty( $unit ) ) {
				return $value;
			}

			return esc_attr( $value . $unit );
		}


		/**
		 * Adds Google fonts all blocks.
		 *
		 * @param bool       $loadGoogleFont the blocks attr.
		 * @param array      $fontFamily the blocks attr.
		 * @param int|string $fontWeight the blocks attr.
		 */
		public static function blocksGoogleFont( $loadGoogleFont, $fontFamily, $fontWeight ) {

			if ( true === $loadGoogleFont ) {
				if ( ! array_key_exists( $fontFamily, self::$gfonts ) ) {
					$addFont                     = [
						'fontfamily'   => $fontFamily,
						'fontvariants' => ( isset( $fontWeight ) && ! empty( $fontWeight ) ? [ $fontWeight ] : [] ),
					];
					self::$gfonts[ $fontFamily ] = $addFont;
				} else {
					if ( isset( $fontWeight ) && ! empty( $fontWeight ) && ! in_array( $fontWeight, self::$gfonts[ $fontFamily ]['fontvariants'], true ) ) {
						array_push( self::$gfonts[ $fontFamily ]['fontvariants'], $fontWeight );
					}
				}
			}
		}

		/**
		 * Get Json Data.
		 * Customize and add icons via 'vxt_ultimate_gutenberg_blocks_icons_chunks' filter.
		 *
		 * @since 1.8.1
		 * @return array
		 */
		public static function backendLoadFontAwesomeIcons() {

			if ( null !== self::$iconJson ) {
				return self::$iconJson;
			}

			$iconsChunks = [];
			for ( $i = 0; $i < self::$numberOfIconChunks; $i++ ) {
				$jsonFile = VXT_DIR . "includes/blocks-config/vxt-controls/icons-v6-{$i}.php";
				if ( file_exists( $jsonFile ) ) {
					$iconsChunks[] = include $jsonFile;
				}
			}

			$iconsChunks = apply_filters( 'vxt_ultimate_gutenberg_blocks_icons_chunks', $iconsChunks );

			if ( ! is_array( $iconsChunks ) || empty( $iconsChunks ) ) {
				$iconsChunks = [];
			}

			self::$iconJson = $iconsChunks;
			return self::$iconJson;
		}

		/**
		 * Generate SVG.
		 *
		 * @since 1.8.1
		 * @param  string $icon Decoded fontawesome json file data.
		 */
		public static function renderSvgHtml( $icon ) {
			$icon = sanitize_text_field( esc_attr( $icon ) );

			$json = self::backendLoadFontAwesomeIcons();

			if ( ! empty( $json ) ) {
				if ( empty( $iconArrayMerged ) ) {
					foreach ( $json as $value ) {
						self::$iconArrayMerged = array_merge( self::$iconArrayMerged, $value );
					}
				}
				$json = self::$iconArrayMerged;
			}

			// Load Polyfiller Array if needed.
			$loadFontAwesome5 = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_load_font_awesome_5' );

			if ( 'disabled' !== $loadFontAwesome5 ) {
				// If Icon doesn't need Polyfilling, use the Original.
				$fontAwesome5Polyfiller = vxt_get_vexaltrix_font_awesome_polyfiller();
				$icon                      = ! empty( $fontAwesome5Polyfiller[ $icon ] ) ? $fontAwesome5Polyfiller[ $icon ] : $icon;
			}

			$iconBrandOrSolid = isset( $json[ $icon ]['svg']['brands'] ) ? $json[ $icon ]['svg']['brands'] : ( isset( $json[ $icon ]['svg']['solid'] ) ? $json[ $icon ]['svg']['solid'] : [] );
			$path                = isset( $iconBrandOrSolid['path'] ) ? $iconBrandOrSolid['path'] : '';
			$view                = isset( $iconBrandOrSolid['width'] ) && isset( $iconBrandOrSolid['height'] ) ? '0 0 ' . $iconBrandOrSolid['width'] . ' ' . $iconBrandOrSolid['height'] : null;

			if ( $path && $view ) {
				?>
				<svg xmlns="https://www.w3.org/2000/svg" viewBox= "<?php echo esc_attr( $view ); ?>"><path d="<?php echo esc_attr( $path ); ?>"></path></svg>
				<?php
			}
		}

		/**
		 *  Check MIME Type
		 *
		 *  @since 1.20.0
		 */
		public static function getMimeType() {

			$allowedTypes = get_allowed_mime_types();

			return ( array_key_exists( 'json', $allowedTypes ) ) ? true : false;

		}

		/**
		 * Returns Query.
		 *
		 * @param array  $attributes The block attributes.
		 * @param string $blockType The Block Type.
		 * @since 1.8.2
		 */
		public static function getQuery( $attributes, $blockType ) {
			$fallbackForPostsToShow = \Vexaltrix\Presentation\Blocks\BlockHelper::getFallbackNumber( $attributes['postsToShow'], 'postsToShow', $attributes['blockName'] );
			$fallbackForOffset        = \Vexaltrix\Presentation\Blocks\BlockHelper::getFallbackNumber( $attributes['postsOffset'], 'postsOffset', $attributes['blockName'] );

			// SECURITY: Validate post type against public post types to prevent information disclosure.
			$postType     = ( isset( $attributes['postType'] ) ) ? sanitize_text_field( $attributes['postType'] ) : 'post';
			$allowedTypes = get_post_types( [ 'public' => true ] );
			if ( ! in_array( $postType, $allowedTypes, true ) ) {
				$postType = 'post';
			}

			// SECURITY: Validate orderBy against allowed WP_Query values.
			$orderBy        = ( isset( $attributes['orderBy'] ) ) ? sanitize_text_field( $attributes['orderBy'] ) : 'date';
			$allowedOrderby = [ 'date', 'modified', 'ID', 'author', 'title', 'rand', 'menu_order', 'comment_count' ];
			if ( ! in_array( $orderBy, $allowedOrderby, true ) ) {
				$orderBy = 'date';
			}

			// SECURITY: Validate order direction.
			$order = ( isset( $attributes['order'] ) ) ? sanitize_text_field( $attributes['order'] ) : 'desc';
			if ( ! in_array( strtolower( $order ), [ 'asc', 'desc' ], true ) ) {
				$order = 'desc';
			}

			// Block type is grid/masonry/carousel/timeline.
			$queryArgs = [
				'posts_per_page'      => $fallbackForPostsToShow,
				'post_status'         => 'publish',
				'post_type'           => $postType,
				'order'               => $order,
				'orderby'             => $orderBy,
				'ignore_sticky_posts' => 1,
				'paged'               => 1,
			];

			if ( isset( $attributes['enableOffset'] ) && false !== $attributes['enableOffset'] && 0 !== $attributes['postsOffset'] ) {
				$queryArgs['offset'] = $fallbackForOffset;
			}

			if ( $attributes['excludeCurrentPost'] ) {
				$queryArgs['post__not_in'] = [ get_the_ID() ];
			}

			if ( isset( $attributes['categories'] ) && '' !== $attributes['categories'] ) {
				$queryArgs['tax_query'][] = [
					'taxonomy' => ( isset( $attributes['taxonomyType'] ) ) ? $attributes['taxonomyType'] : 'category',
					'field'    => 'id',
					'terms'    => $attributes['categories'],
					'operator' => 'IN',
				];
			}

			if ( 'grid' === $blockType && isset( $attributes['postPagination'] ) && true === $attributes['postPagination'] ) {

				if ( get_query_var( 'paged' ) ) {

					$paged = get_query_var( 'paged' );

				} elseif ( get_query_var( 'page' ) ) {

					$paged = get_query_var( 'page' );

				} else {

					$paged = isset( $attributes['paged'] ) ? $attributes['paged'] : 1;

				}
				$queryArgs['posts_per_page'] = $attributes['postsToShow'];
				$queryArgs['paged']          = $paged;

			}

			if ( 'masonry' === $blockType && isset( $attributes['paginationType'] ) && 'none' !== $attributes['paginationType'] && isset( $attributes['paged'] ) ) {

				$queryArgs['paged'] = $attributes['paged'];

			}

			$queryArgs = apply_filters( "vxt_ultimate_gutenberg_blocks_post_query_args_{$blockType}", $queryArgs, $attributes );

			return new WP_Query( $queryArgs );
		}

		/**
		 * Get size information for all currently-registered image sizes.
		 *
		 * @global $_wpAdditionalImageSizes
		 * @uses   get_intermediate_image_sizes()
		 * @link   https://codex.wordpress.org/Function_Reference/get_intermediate_image_sizes
		 * @since  1.9.0
		 * @return array $sizes Data for all currently-registered image sizes.
		 */
		public static function getImageSizes() {

			global $_wp_additional_image_sizes;

			$sizes       = get_intermediate_image_sizes();
			$imageSizes = [];

			$imageSizes[] = [
				'value' => 'full',
				'label' => esc_html__( 'Full', 'vexaltrix' ),
			];

			foreach ( $sizes as $size ) {
				if ( in_array( $size, [ 'thumbnail', 'medium', 'medium_large', 'large' ], true ) ) {
					$imageSizes[] = [
						'value' => $size,
						'label' => ucwords( trim( str_replace( [ '-', '_' ], [ ' ', ' ' ], $size ) ) ),
					];
				} else {
					$imageSizes[] = [
						'value' => $size,
						'label' => sprintf(
							'%1$s (%2$sx%3$s)',
							ucwords( trim( str_replace( [ '-', '_' ], [ ' ', ' ' ], $size ) ) ),
							$_wp_additional_image_sizes[ $size ]['width'],
							$_wp_additional_image_sizes[ $size ]['height']
						),
					];
				}
			}

			$imageSizes = apply_filters( 'vxt_ultimate_gutenberg_blocks_post_featured_image_sizes', $imageSizes );

			return $imageSizes;
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
		 *  Get - RGBA Color
		 *
		 *  Get HEX color and return RGBA. Default return RGB color.
		 *
		 * @param  var   $color      Gets the color value.
		 * @param  var   $opacity    Gets the opacity value.
		 * @param  array $isArray Gets an array of the value.
		 * @since   1.11.0
		 */
		public static function hex2rgba( $color, $opacity = false, $isArray = false ) {

			$default = $color;

			// Return default if no color provided.
			if ( empty( $color ) ) {
				return $default;
			}

			// Sanitize $color if "#" is provided.
			if ( '#' === $color[0] ) {
				$color = substr( $color, 1 );
			}

			// Check if color has 6 or 3 characters and get values.
			if ( strlen( $color ) === 6 ) {
					$hex = [ $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] ];
			} elseif ( strlen( $color ) === 3 ) {
					$hex = [ $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] ];
			} else {
					return $default;
			}

			// Convert hexadec to rgb.
			$rgb = array_map( 'hexdec', $hex );

			// Check if opacity is set(rgba or rgb).
			if ( false !== $opacity && '' !== $opacity ) {
				if ( abs( $opacity ) >= 1 ) {
					$opacity = $opacity / 100;
				}
				$output = 'rgba(' . implode( ',', $rgb ) . ',' . $opacity . ')';
			} else {
				$output = 'rgb(' . implode( ',', $rgb ) . ')';
			}

			if ( $isArray ) {
				return $rgb;
			} else {
				// Return rgb(a) color string.
				return $output;
			}
		}

		/**
		 * Returns an array of paths for the upload directory
		 * of the current site.
		 *
		 * @since 1.14.0
		 * @return array
		 */
		public static function getUploadDir() {

			$wpInfo = wp_upload_dir( null, false );

			// SSL workaround.
			if ( self::isSsl() ) {
				$wpInfo['baseurl'] = str_ireplace( 'http://', 'https://', $wpInfo['baseurl'] );
			}

			// Build the paths.
			$dirInfo = [
				'path' => trailingslashit( trailingslashit( $wpInfo['basedir'] ) . VXT_UPLOAD_DIR_NAME ),
				'url'  => trailingslashit( trailingslashit( $wpInfo['baseurl'] ) . VXT_UPLOAD_DIR_NAME ),
			];

			// Create the upload dir if it doesn't exist.
			if ( ! file_exists( $dirInfo['path'] ) ) {

				VxtUltimateGutenbergBlocksInstall()->createFiles();
			}

			return apply_filters( 'vxt_get_upload_dir', $dirInfo );
		}

		/**
		 * Deletes the upload dir.
		 *
		 * @since 1.18.0
		 * @return array
		 */
		public static function deleteUploadDir() {

			$wpInfo = wp_upload_dir( null, false );

			// Build the paths.
			$dirInfo = [
				'path' => trailingslashit( trailingslashit( $wpInfo['basedir'] ) . VXT_UPLOAD_DIR_NAME ),
			];

			// Check the upload dir if it doesn't exist or not.
			if ( file_exists( $dirInfo['path'] ) ) {
				// Remove the directory.
				$wp_filesystem = Filesystem::getInstance()->getFilesystem();
				return $wp_filesystem->rmdir( $dirInfo['path'], true );
			}

			return false;
		}

		/**
		 * Get UAG upload dir path.
		 *
		 * @since 1.23.0
		 * @return string
		 */
		public static function getUagUploadDirPath() {

			$wpInfo = self::getUploadDir();

			// Build the paths.
			return $wpInfo['path'];
		}

		/**
		 * Get UAG upload url path.
		 *
		 * @since 1.23.0
		 * @return string
		 */
		public static function getUagUploadUrlPath() {

			$wpInfo = self::getUploadDir();

			// Build the paths.
			return $wpInfo['url'];
		}

		/**
		 * Delete all files from UAG upload dir.
		 *
		 * @since 1.23.0
		 * @return string
		 */
		public static function deleteUagAssetDir() {

			// Build the paths.
			$basePath = self::getUagUploadDirPath();

			// Get all files.
			$paths = glob( $basePath . 'assets/*' );

			foreach ( $paths as $path ) {

				// Check the dir if it exists or not.
				if ( file_exists( $path ) ) {

					$wp_filesystem = Filesystem::getInstance()->getFilesystem();

					// Remove the directory.
					$wp_filesystem->rmdir( $path, true );
				}
			}

			// Create empty files.
			VxtUltimateGutenbergBlocksInstall()->createFiles();
			\Vexaltrix\Presentation\Admin\AdminSettings::createSpecificStylesheet();
			do_action( 'vxt_ultimate_gutenberg_blocks_delete_vxt_asset_dir' );
			return true;
		}

		/**
		 * Checks to see if the site has SSL enabled or not.
		 *
		 * @since 1.14.0
		 * @return bool
		 */
		public static function isSsl() {
			if (
				is_ssl() ||
				( 0 === stripos( get_option( 'siteurl' ), 'https://' ) ) ||
				( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === $_SERVER['HTTP_X_FORWARDED_PROTO'] )
			) {
				return true;
			}
			return false;
		}

		/**
		 * Allow File Geranation flag.
		 *
		 * @since  1.14.0
		 */
		public static function allowFileGeneration() {
			return apply_filters( 'vxt_ultimate_gutenberg_blocks_allow_file_generation', get_option( '_vxt_ultimate_gutenberg_blocks_allow_file_generation', 'disabled' ) );
		}

		/**
		 * Check if UAG upload folder has write permissions or not.
		 *
		 * @since  1.14.9
		 * @return bool true or false.
		 */
		public static function isUagDirHasWritePermissions() {

			$uploadDir = self::getUploadDir();

			return Filesystem::getInstance()->getFilesystem()->is_writable( $uploadDir['path'] );
		}
		/**
		 * Gives the paged Query var.
		 *
		 * @param Object $query Query.
		 * @return int $paged Paged Query var.
		 * @since 1.14.9
		 */
		public static function getPaged( $query ) {

			global $paged;

			// Check the 'paged' query var.
			$pagedQv = $query->get( 'paged' );

			if ( is_numeric( $pagedQv ) ) {
				return $pagedQv;
			}

			// Check the 'page' query var.
			$pageQv = $query->get( 'page' );

			if ( is_numeric( $pageQv ) ) {
				return $pageQv;
			}

			// Check the $paged global?
			if ( is_numeric( $paged ) ) {
				return $paged;
			}

			return 0;
		}
		/**
		 * Builds the base url.
		 *
		 * @param string $permalinkStructure Premalink Structure.
		 * @param string $base Base.
		 * @since 1.14.9
		 */
		public static function buildBaseUrl( $permalinkStructure, $base ) {
			// Check to see if we are using pretty permalinks.
			if ( ! empty( $permalinkStructure ) ) {

				if ( strrpos( $base, 'paged-' ) ) {
					$base = substr_replace( $base, '', strrpos( $base, 'paged-' ), strlen( $base ) );
				}

				// Remove query string from base URL since paginate_links() adds it automatically.
				// This should also fix the WPML pagination issue that was added since 1.10.2.
				if ( count( $_GET ) > 0 ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- $_GET does not provide nonce.
					$base = strtok( $base, '?' );
				}

				// Add trailing slash when necessary.
				if ( '/' === substr( $permalinkStructure, -1 ) ) {
					$base = trailingslashit( $base );
				} else {
					$base = untrailingslashit( $base );
				}
			} else {
				$urlParams = wp_parse_url( $base, PHP_URL_QUERY );

				if ( empty( $urlParams ) ) {
					$base = trailingslashit( $base );
				}
			}

			return $base;
		}
		/**
		 * Returns the Paged Format.
		 *
		 * @param string $permalinkStructure Premalink Structure.
		 * @param string $base Base.
		 * @since 1.14.9
		 */
		public static function pagedFormat( $permalinkStructure, $base ) {

			$pagePrefix = empty( $permalinkStructure ) ? 'paged' : 'page';

			if ( ! empty( $permalinkStructure ) ) {
				$format  = substr( $base, -1 ) !== '/' ? '/' : '';
				$format .= $pagePrefix . '/';
				$format .= '%#%';
				$format .= substr( $permalinkStructure, -1 ) === '/' ? '/' : '';
			} elseif ( empty( $permalinkStructure ) || is_search() ) {
				$parseUrl = wp_parse_url( $base, PHP_URL_QUERY );
				$format    = empty( $parseUrl ) ? '?' : '&';
				$format   .= $pagePrefix . '=%#%';
			}

			return $format;
		}

		/**
		 * Get Typography Dynamic CSS.
		 *
		 * @param  array  $attr The Attribute array.
		 * @param  string $slug The field slug.
		 * @param  string $selector The selector array.
		 * @param  array  $combinedSelectors The combined selector array.
		 * @since  1.15.0
		 * @return array
		 */
		public static function getTypographyCss( $attr, $slug, $selector, $combinedSelectors ) {

			$typoCssDesktop = [];
			$typoCssTablet  = [];
			$typoCssMobile  = [];

			$alreadySelectorsDesktop = ( isset( $combinedSelectors['desktop'][ $selector ] ) ) ? $combinedSelectors['desktop'][ $selector ] : [];
			$alreadySelectorsTablet  = ( isset( $combinedSelectors['tablet'][ $selector ] ) ) ? $combinedSelectors['tablet'][ $selector ] : [];
			$alreadySelectorsMobile  = ( isset( $combinedSelectors['mobile'][ $selector ] ) ) ? $combinedSelectors['mobile'][ $selector ] : [];

			$familySlug     = ( '' === $slug ) ? 'fontFamily' : $slug . 'FontFamily';
			$weightSlug     = ( '' === $slug ) ? 'fontWeight' : $slug . 'FontWeight';
			$transformSlug  = ( '' === $slug ) ? 'fontTransform' : $slug . 'Transform';
			$decorationSlug = ( '' === $slug ) ? 'fontDecoration' : $slug . 'Decoration';
			$styleSlug      = ( '' === $slug ) ? 'fontStyle' : $slug . 'FontStyle';

			$lHtSlug        = ( '' === $slug ) ? 'lineHeight' : $slug . 'LineHeight';
			$fSzSlug        = ( '' === $slug ) ? 'fontSize' : $slug . 'FontSize';
			$lHtTypeSlug   = ( '' === $slug ) ? 'lineHeightType' : $slug . 'LineHeightType';
			$fSzTypeSlug   = ( '' === $slug ) ? 'fontSizeType' : $slug . 'FontSizeType';
			$fSzTypeTSlug = ( '' === $slug ) ? 'fontSizeTypeTablet' : $slug . 'FontSizeTypeTablet';
			$fSzTypeMSlug = ( '' === $slug ) ? 'fontSizeTypeMobile' : $slug . 'FontSizeTypeMobile';
			$lSpSlug        = ( '' === $slug ) ? 'letterSpacing' : $slug . 'LetterSpacing';
			$lSpTypeSlug   = ( '' === $slug ) ? 'letterSpacingType' : $slug . 'LetterSpacingType';

			$textTransform  = isset( $attr[ $transformSlug ] ) ? $attr[ $transformSlug ] : 'normal';
			$textDecoration = isset( $attr[ $decorationSlug ] ) ? $attr[ $decorationSlug ] : 'none';
			$fontStyle      = isset( $attr[ $styleSlug ] ) ? $attr[ $styleSlug ] : 'normal';

			$typoCssDesktop[ $selector ] = [
				'font-family'     => $attr[ $familySlug ],
				'text-transform'  => $textTransform,
				'text-decoration' => $textDecoration,
				'font-style'      => $fontStyle,
				'font-weight'     => $attr[ $weightSlug ],
				'font-size'       => ( isset( $attr[ $fSzSlug ] ) ) ? self::getCssValue( $attr[ $fSzSlug ], $attr[ $fSzTypeSlug ] ) : '',
				'line-height'     => ( isset( $attr[ $lHtSlug ] ) ) ? self::getCssValue( $attr[ $lHtSlug ], $attr[ $lHtTypeSlug ] ) : '',
				'letter-spacing'  => ( isset( $attr[ $lSpSlug ] ) ) ? self::getCssValue( $attr[ $lSpSlug ], $attr[ $lSpTypeSlug ] ) : '',
			];

			$typoCssDesktop[ $selector ] = array_merge(
				$typoCssDesktop[ $selector ],
				$alreadySelectorsDesktop
			);

			$typoCssTablet[ $selector ] = [
				'font-size'      => ( isset( $attr[ $fSzSlug . 'Tablet' ] ) ) ? self::getCssValue( $attr[ $fSzSlug . 'Tablet' ], ( isset( $attr[ $fSzTypeTSlug ] ) ) ? $attr[ $fSzTypeTSlug ] : $attr[ $fSzTypeSlug ] ) : '',
				'line-height'    => ( isset( $attr[ $lHtSlug . 'Tablet' ] ) ) ? self::getCssValue( $attr[ $lHtSlug . 'Tablet' ], $attr[ $lHtTypeSlug ] ) : '',
				'letter-spacing' => ( isset( $attr[ $lSpSlug . 'Tablet' ] ) ) ? self::getCssValue( $attr[ $lSpSlug . 'Tablet' ], $attr[ $lSpTypeSlug ] ) : '',
			];

			$typoCssTablet[ $selector ] = array_merge(
				$typoCssTablet[ $selector ],
				$alreadySelectorsTablet
			);

			$typoCssMobile[ $selector ] = [
				'font-size'      => ( isset( $attr[ $fSzSlug . 'Mobile' ] ) ) ? self::getCssValue( $attr[ $fSzSlug . 'Mobile' ], ( isset( $attr[ $fSzTypeMSlug ] ) ) ? $attr[ $fSzTypeMSlug ] : $attr[ $fSzTypeSlug ] ) : '',
				'line-height'    => ( isset( $attr[ $lHtSlug . 'Mobile' ] ) ) ? self::getCssValue( $attr[ $lHtSlug . 'Mobile' ], $attr[ $lHtTypeSlug ] ) : '',
				'letter-spacing' => ( isset( $attr[ $lSpSlug . 'Mobile' ] ) ) ? self::getCssValue( $attr[ $lSpSlug . 'Mobile' ], $attr[ $lSpTypeSlug ] ) : '',
			];

			$typoCssMobile[ $selector ] = array_merge(
				$typoCssMobile[ $selector ],
				$alreadySelectorsMobile
			);

			return [
				'desktop' => array_merge(
					$combinedSelectors['desktop'],
					$typoCssDesktop
				),
				'tablet'  => array_merge(
					$combinedSelectors['tablet'],
					$typoCssTablet
				),
				'mobile'  => array_merge(
					$combinedSelectors['mobile'],
					$typoCssMobile
				),
			];
		}

		/**
		 * Sets the selector to Global Block Styles Selector if applicable.
		 *
		 * @param string $selector Selector.
		 * @param array  $gbsAttributes GBS attributes array.
		 * @since 2.9.0
		 * @return string $selector Updated selector.
		 */
		public static function addGbsSelectorIfApplicable( $selector, $gbsAttributes ) {
			if ( empty( $gbsAttributes['globalBlockStyleId'] ) ) {
				return $selector;
			}

			return self::getGbsSelector( $gbsAttributes['globalBlockStyleId'] );
		}

		/**
		 * Get the Global block styles CSS selector.
		 *
		 * @param string $styleName Style Name.
		 *
		 * @since 2.9.0
		 * @return string $selector Styles Selector.
		 */
		public static function getGbsSelector( $styleName ) {

			if ( $styleName ) {
				return '.vexaltrix-gbs-' . $styleName;
			}
			return '';
		}

		/**
		 * Parse CSS into correct CSS syntax.
		 *
		 * @param array  $combinedSelectors The combined selector array.
		 * @param string $id The selector ID.
		 * @param string $gbsClass The GBS class as string.
		 *
		 * @since 1.15.0
		 * @return array $css CSS.
		 */
		public static function generateAllCss( $combinedSelectors, $id, $gbsClass = '' ) {

			if ( ! empty( $gbsClass ) ) {
				$id = $gbsClass;
			}

			return [
				'desktop' => self::generateCss( $combinedSelectors['desktop'], $id ),
				'tablet'  => self::generateCss( $combinedSelectors['tablet'], $id ),
				'mobile'  => self::generateCss( $combinedSelectors['mobile'], $id ),
			];
		}

		/**
		 * Merge and combine CSS arrays for devices.
		 *
		 * @param array $normalCss The normal CSS array with 'desktop', 'tablet', and 'mobile' keys.
		 * @param array $rtlCss    The RTL CSS array with 'desktop', 'tablet', and 'mobile' keys.
		 *
		 * @since 2.18.0
		 * @return array $mergedCss The merged CSS array.
		 */
		public static function mergeCssArrays( $normalCss, $rtlCss ) {
			$mergedCss = [];

			// Iterate through devices and combine the values.
			foreach ( [ 'desktop', 'tablet', 'mobile' ] as $device ) {
				$mergedCss[ $device ] = ( isset( $normalCss[ $device ] ) ? $normalCss[ $device ] : '' )
					. ( isset( $rtlCss[ $device ] ) ? $rtlCss[ $device ] : '' );
			}

			return $mergedCss;
		}
		
		/**
		 * Get Post Assets Instance.
		 */
		public function getPostAssetsInstance() {
			return vxt_ultimate_gutenberg_blocks_get_front_post_assets();
		}

		/** Generates stylesheet in loop.
		 *
		 * @since 1.7.0
		 * @param object $thisPost Post Object.
		 * @deprecated 1.23.0
		 * @access public
		 */
		public function getGeneratedStylesheet( $thisPost ) {
			_deprecated_function( __METHOD__, '1.23.0' );

			if ( ! is_object( $thisPost ) ) {
				return;
			}

			if ( ! isset( $thisPost->ID ) ) {
				return;
			}

			if ( has_blocks( $thisPost->ID ) && isset( $thisPost->post_content ) ) {

				$blocks            = parse_blocks( $thisPost->post_content );
				self::$pageBlocks = $blocks;

				if ( ! is_array( $blocks ) || empty( $blocks ) ) {
					return;
				}

				$assets = $this->getAssets( $blocks );

				self::$stylesheet .= $assets['css'];
				self::$script     .= $assets['js'];
			}
		}

		/**
		 * Generates stylesheet for reusable blocks.
		 *
		 * @since 1.1.0
		 * @param array $blocks Blocks.
		 * @deprecated 1.23.0
		 * @access public
		 */
		public function getAssets( $blocks ) {
			_deprecated_function( __METHOD__, '1.23.0' );

			$desktop = '';
			$tablet  = '';
			$mobile  = '';

			$tabStylingCss = '';
			$mobStylingCss = '';

			$js = '';

			foreach ( $blocks as $i => $block ) {

				if ( is_array( $block ) ) {

					if ( empty( $block['blockName'] ) ) {
						continue;
					}

					if ( 'core/block' === $block['blockName'] ) {
						$id = ( isset( $block['attrs']['ref'] ) ) ? $block['attrs']['ref'] : 0;

						if ( $id ) {
							$content = get_post_field( 'post_content', $id );

							$reusableBlocks = parse_blocks( $content );

							$assets = $this->getAssets( $reusableBlocks );

							self::$stylesheet .= $assets['css'];
							self::$script     .= $assets['js'];

						}
					} else {

						$blockAssets = $this->getBlockCssAndJs( $block );
						// Get CSS for the Block.
						$css = $blockAssets['css'];

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

			$postAssetsInstance = $this->getPostAssetsInstance();
			if ( $postAssetsInstance ) {

				$postAssetsInstance->stylesheet .= $desktop . $tabStylingCss . $mobStylingCss;
				$postAssetsInstance->script     .= $js;
			}

			return [
				'css' => $desktop . $tabStylingCss . $mobStylingCss,
				'js'  => $js,
			];
		}

		/**
		 * Parse Guten Block.
		 *
		 * @since 1.1.0
		 * @param string $content the content string.
		 * @deprecated 1.23.0 Use `parse_blocks()` instead
		 * @access public
		 */
		public function parse( $content ) {
			_deprecated_function( __METHOD__, '1.23.0', 'parse_blocks()' );

			return parse_blocks( $content );
		}
		/**
		 * This is the action where we create dynamic asset files.
		 * CSS Path : uploads/uag-plugin/uag-style-{post_id}-{timestamp}.css
		 * JS Path : uploads/uag-plugin/uag-script-{post_id}-{timestamp}.js
		 *
		 * @since 1.15.0
		 * @deprecated 1.23.0
		 */
		public function generateAssetFiles() {
			_deprecated_function( __METHOD__, '1.23.0' );

			global $contentWidth;
			self::$stylesheet = str_replace( '#CONTENT_WIDTH#', $contentWidth . 'px', self::$stylesheet );
			if ( '' !== self::$script ) {
				self::$script = 'document.addEventListener("DOMContentLoaded", function(){ ' . self::$script . ' })';
			}

			if ( 'enabled' === self::$fileGeneration ) {

				$postAssetsInstance = $this->getPostAssetsInstance();

				if ( $postAssetsInstance ) {
					$postAssetsInstance->stylesheet .= self::$stylesheet;
					$postAssetsInstance->script     .= self::$script;
				}
			}
		}

		/**
		 * Enqueue Gutenberg block assets for both frontend + backend.
		 *
		 * @since 1.13.4
		 * @deprecated 1.23.0
		 */
		public function blockAssets() {
			_deprecated_function( __METHOD__, '1.23.0' );

			$this->getPostAssetsInstance()->enqueueBlocksDependencyFrontend();

		}
		/**
		 * Print the Script in footer.
		 *
		 * @since 1.15.0
		 * @deprecated 1.23.0
		 */
		public function printScript() {
			_deprecated_function( __METHOD__, '1.23.0' );

			$this->getPostAssetsInstance()->printScript();

		}
		/**
		 * Print the Stylesheet in header.
		 *
		 * @since 1.15.0
		 * @deprecated 1.23.0
		 */
		public function printStylesheet() {
			_deprecated_function( __METHOD__, '1.23.0' );

			$this->getPostAssetsInstance()->printStylesheet();

		}
		/**
		 * Load the front end Google Fonts.
		 *
		 * @since 1.15.0
		 * @deprecated 1.23.0
		 */
		public function frontendGfonts() {
			_deprecated_function( __METHOD__, '1.23.0' );

			$this->getPostAssetsInstance()->printGoogleFonts();

		}
		/**
		 * Generates CSS recurrsively.
		 *
		 * @param object $block The block object.
		 * @since 0.0.1
		 * @deprecated 1.23.0
		 */
		public function getBlockCssAndJs( $block ) {

			_deprecated_function( __METHOD__, '1.23.0' );

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

			self::$currentBlockList[] = $name;

			if ( strpos( $name, 'vexaltrix/' ) !== false ) {

				self::$uagFlag = true;
				$blockSlug    = str_replace( 'vexaltrix/', '', $name );
				$blockCss     = \Vexaltrix\Presentation\Blocks\BlockModule::getFrontendCss( $blockSlug, $blockattr, $blockId );
				$blockJs      = \Vexaltrix\Presentation\Blocks\BlockModule::getFrontendJs( $blockSlug, $blockattr, $blockId );
				$css            = array_merge( $css, $blockCss );
				if ( ! empty( $blockJs ) ) {
					$js .= $blockJs;
				}

				if ( 'vexaltrix/faq' === $name && ! isset( $blockattr['layout'] ) ) {
					$this->vxt_faq_layout = true;
				}
			}

			if ( isset( $block['innerBlocks'] ) ) {
				foreach ( $block['innerBlocks'] as $j => $innerBlock ) {
					if ( 'core/block' === $innerBlock['blockName'] ) {
						$id = ( isset( $innerBlock['attrs']['ref'] ) ) ? $innerBlock['attrs']['ref'] : 0;

						if ( $id ) {
							$content = get_post_field( 'post_content', $id );

							$reusableBlocks = $this->parse( $content );

							$assets = $this->getAssets( $reusableBlocks );

							self::$stylesheet .= $assets['css'];
							self::$script     .= $assets['js'];
						}
					} else {
						// Get CSS for the Block.
						$innerAssets    = $this->getBlockCssAndJs( $innerBlock );
						$innerBlockCss = $innerAssets['css'];

						$cssDesktop = ( isset( $css['desktop'] ) ? $css['desktop'] : '' );
						$cssTablet  = ( isset( $css['tablet'] ) ? $css['tablet'] : '' );
						$cssMobile  = ( isset( $css['mobile'] ) ? $css['mobile'] : '' );

						if ( isset( $innerBlockCss['desktop'] ) ) {
							$css['desktop'] = $cssDesktop . $innerBlockCss['desktop'];
							$css['tablet']  = $cssTablet . $innerBlockCss['tablet'];
							$css['mobile']  = $cssMobile . $innerBlockCss['mobile'];
						}

						$js .= $innerAssets['js'];
					}
				}
			}

			self::$currentBlockList = array_unique( self::$currentBlockList );

			return [
				'css' => $css,
				'js'  => $js,
			];
		}

		/**
		 * Generates stylesheet and appends in head tag.
		 *
		 * @since 0.0.1
		 * @deprecated 1.23.0
		 */
		public function generateAssets() {
			_deprecated_function( __METHOD__, '1.23.0' );

			$thisPost = [];

			if ( class_exists( 'WooCommerce' ) ) {

				if ( is_cart() ) {

					$id        = get_option( 'woocommerce_cart_page_id' );
					$thisPost = get_post( $id );

				} elseif ( is_account_page() ) {

					$id        = get_option( 'woocommerce_myaccount_page_id' );
					$thisPost = get_post( $id );

				} elseif ( is_checkout() ) {

					$id        = get_option( 'woocommerce_checkout_page_id' );
					$thisPost = get_post( $id );

				} elseif ( is_checkout_pay_page() ) {

					$id        = get_option( 'woocommerce_pay_page_id' );
					$thisPost = get_post( $id );

				} elseif ( is_shop() ) {

					$id        = get_option( 'woocommerce_shop_page_id' );
					$thisPost = get_post( $id );
				}

				if ( is_object( $thisPost ) ) {
					$this->getGeneratedStylesheet( $thisPost );
				}
			}

			if ( is_single() || is_page() || is_404() ) {

				global $post;
				$thisPost = $post;

				if ( ! is_object( $thisPost ) ) {
					return;
				}

				/**
				 * Filters the post to build stylesheet for.
				 *
				 * @param \WP_Post $thisPost The global post.
				 */
				$thisPost = apply_filters( 'vxt_ultimate_gutenberg_blocks_post_for_stylesheet', $thisPost );

				$this->getGeneratedStylesheet( $thisPost );

			} elseif ( is_archive() || is_home() || is_search() ) {

				global $wp_query;
				$cachedWpQuery = $wp_query;

				foreach ( $cachedWpQuery as $post ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
					$this->getGeneratedStylesheet( $post );
				}
			}
		}

		/**
		 * Get the excerpt.
		 *
		 * @param int    $postId          for the block.
		 * @param string $content          for post content.
		 * @param int    $lengthFallback  for excerpt, after fallback has been done.
		 *
		 * @since 2.0.0
		 */
		public static function vxtUltimateGutenbergBlocksGetExcerpt( $postId, $content, $lengthFallback ) {

			if ( post_password_required( $postId ) ) {
				return __( 'There is no excerpt because this is a protected post.', 'vexaltrix' );
			}

			// If there's an excerpt provided from meta, use it.
			$excerpt = get_post_field( 'post_excerpt', $postId );

			if ( empty( $excerpt ) ) { // If no excerpt provided from meta.
				$maxExcerpt = 100;
				// If the content present on post, then trim it and use that.
				if ( ! empty( $content ) ) {
					$excerpt = apply_filters( 'the_excerpt', wp_trim_words( $content, $maxExcerpt ) );
				}
			}
			// Trim the excerpt.
			if ( ! empty( $excerpt ) ) {
				$excerpt = explode( ' ', $excerpt );
				if ( count( $excerpt ) > $lengthFallback ) {
					$excerpt = implode( ' ', array_slice( $excerpt, 0, $lengthFallback ) ) . '...';
				} else {
					$excerpt = implode( ' ', $excerpt );
				}
			}

			return empty( $excerpt ) ? '' : $excerpt;
		}

		/**
		 * Get User Browser name
		 *
		 * @param string $userAgent Browser names.
		 * @return string
		 * @since 2.0.8
		 */
		public static function getBrowserName( $userAgent ) {

			if ( strpos( $userAgent, 'Opera' ) || strpos( $userAgent, 'OPR/' ) ) {
				return 'opera';
			} elseif ( strpos( $userAgent, 'Edg' ) || strpos( $userAgent, 'Edge' ) ) {
				return 'edge';
			} elseif ( strpos( $userAgent, 'Chrome' ) ) {
				return 'chrome';
			} elseif ( strpos( $userAgent, 'Safari' ) ) {
				return 'safari';
			} elseif ( strpos( $userAgent, 'Firefox' ) ) {
				return 'firefox';
			} elseif ( strpos( $userAgent, 'MSIE' ) || strpos( $userAgent, 'Trident/7' ) ) {
				return 'ie';
			}
		}

		/**
		 * Get block dynamic CSS selector with filters applied for extending it.
		 *
		 * @param string $blockName Block name to filter.
		 * @param array  $selectors Array of selectors to filter.
		 * @param array  $attr Attributes.
		 * @return array Combined selectors array.
		 * @since 2.4.0
		 */
		public static function getCombinedSelectors( $blockName, $selectors, $attr ) {
			if ( ! is_array( $selectors ) ) {
				return $selectors;
			}

			$combinedSelectors = [];

			foreach ( $selectors as $key => $selector ) {
				$hookPrefix                = ( 'desktop' === $key ) ? '' : '_' . $key;
				$combinedSelectors[ $key ] = apply_filters( 'vexaltrix_' . $blockName . $hookPrefix . '_styling', $selector, $attr );
			}

			return $combinedSelectors;
		}

		/**
		 * This function deletes the Page assets from the Page Meta Key.
		 *
		 * @param int $postId Post Id.
		 *
		 * @return void
		 * @since 1.23.0
		 */
		public static function deletePageAssets( $postId ) {
			$currentPostType = get_post_type( $postId );
			if ( 'wp_template_part' === $currentPostType || 'wp_template' === $currentPostType ) {

				// Delete all the TOC Post Meta on update of the template.
				delete_post_meta_by_key( '_vxt_ultimate_gutenberg_blocks_toc_options' );

				\Vexaltrix\Presentation\Admin\AdminSettings::createSpecificStylesheet();

				/* Update the asset version */
				\Vexaltrix\Presentation\Admin\AdminSettings::updateAdminSettingsOption( '__vxt_ultimate_gutenberg_blocks_asset_version', time() );
				return;
			}

			$uniqueIds = get_option( '_vxt_ultimate_gutenberg_blocks_fse_uniqids' );
			if ( ! empty( $uniqueIds ) && is_array( $uniqueIds ) ) {
				foreach ( $uniqueIds as $id ) {
					delete_post_meta( (int) $id, '_vxt_page_assets' );
				}
			}

			delete_post_meta( $postId, '_vxt_page_assets' );
			delete_post_meta( $postId, '_vxt_css_file_name' );
			delete_post_meta( $postId, '_vxt_js_file_name' );

			/* Update the asset version */
			\Vexaltrix\Presentation\Admin\AdminSettings::updateAdminSettingsOption( '__vxt_ultimate_gutenberg_blocks_asset_version', time() );

			do_action( 'vxt_ultimate_gutenberg_blocks_delete_page_assets' );
		}

		/**
		 * Does Post contains reusable blocks.
		 *
		 * @param int $postId Post ID.
		 *
		 * @since 1.23.5
		 *
		 * @return boolean Wether the Post contains any Reusable blocks or not.
		 */
		public static function doesPostContainReusableBlocks( $postId ) {

			$postContent = get_post_field( 'post_content', $postId, 'raw' );
			$tag          = '<!-- wp:block';
			$flag         = strpos( $postContent, $tag );
			return ( 0 === $flag || is_numeric( $flag ) );
		}

		/**
		 * Set alignment css function.
		 *
		 * @param string $align passed.
		 * @since 2.7.7
		 * @return array
		 */
		public static function alignmentCss( $align ) {
			$alignCss = [];
			switch ( $align ) {
				case 'left':
					$alignCss = [
						'margin-left'  => 0,
						'margin-right' => 'auto',
					];
					break;
				case 'center':
					$alignCss = [
						'margin-left'  => 'auto',
						'margin-right' => 'auto',
					];
					break;
				case 'right':
					$alignCss = [
						'margin-right' => 0,
						'margin-left'  => 'auto',
					];
					break;
			}
			return $alignCss;
		}

		/**
		 * Get allowed HTML title tag.
		 *
		 * @param string $titleTag HTML tag of title.
		 * @param array  $allowedArray Array of allowed HTML tags.
		 * @param string $defaultTag Default HTML tag.
		 * @since 2.7.10
		 * @return string $titleTag | $defaultTag.
		 */
		public static function titleTagAllowedHtml( $titleTag, $allowedArray, $defaultTag ) {
			return in_array( $titleTag, $allowedArray, true ) ? sanitize_key( $titleTag ) : $defaultTag;
		}

		/**
		 * Check if file exists and delete it.
		 *
		 * @param string $fileName File name.
		 * @since 2.9.0
		 * @return void
		 */
		public static function removeFile( $fileName ) {
			if ( file_exists( $fileName ) ) {
				wp_delete_file( $fileName );
			}
		}
	}

	/**
	 *  Prepare if class 'Vexaltrix\\Support\\Helper' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
