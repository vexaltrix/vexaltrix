<?php
/**
 * Vexaltrix Admin Helper.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Presentation\Admin;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use ZipAI\Classes\Module as Zip_Ai_Module;

if ( ! class_exists( 'Vexaltrix\Presentation\Admin\\AdminSettings' ) ) {

	/**
	 * Class \Vexaltrix\Presentation\Admin\AdminSettings.
	 */
	final class AdminSettings implements ServiceInterface {

		/**
		 * Member Variable
		 *
		 * @since 0.0.1
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 *
		 * @since 0.0.1
		 */
		public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

		/**
		 * Get all data from the admin settings page.
		 *
		 * @return mixed
		 * @since 2.0.8
		 */
		public static function getAdminSettingsShareableData() {

			// Prepare to get the Zip AI Co-pilot modules.
			$zipAiModules = [];

			// If the Zip AI Helper is available, get the required modules and their states.
			if ( class_exists( '\ZipAI\Classes\Module' ) ) {
				$zipAiModules = Zip_Ai_Module::get_all_modules();
			}

			$contentWidth = self::getGlobalContentWidth();

			$options = [
				'vxt_ultimate_gutenberg_blocks_beta'                         => self::get( 'vxt_ultimate_gutenberg_blocks_beta', 'no' ),
				'vxt_enable_legacy_blocks'          => self::get( 'vxt_enable_legacy_blocks' ),
				'_vxt_ultimate_gutenberg_blocks_allow_file_generation'       => self::get( '_vxt_ultimate_gutenberg_blocks_allow_file_generation', 'enabled' ),
				'vxt_enable_templates_button'       => self::get( 'vxt_enable_templates_button', 'yes' ),
				'vxt_enable_on_page_css_button'     => self::get( 'vxt_enable_on_page_css_button', 'yes' ),
				'vxt_enable_block_condition'        => self::get( 'vxt_enable_block_condition', 'disabled' ),
				'vxt_enable_masonry_gallery'        => self::get( 'vxt_enable_masonry_gallery', 'enabled' ),
				'vxt_enable_quick_action_sidebar'   => self::get( 'vxt_enable_quick_action_sidebar', 'enabled' ),
				'vxt_enable_animations_extension'   => self::get( 'vxt_enable_animations_extension', 'enabled' ),
				'vxt_enable_gbs_extension'          => self::get( 'vxt_enable_gbs_extension', 'enabled' ),
				'vxt_enable_block_responsive'       => self::get( 'vxt_enable_block_responsive', 'enabled' ),
				'vxt_select_font_globally'          => self::get( 'vxt_select_font_globally', [] ),
				'vxt_load_select_font_globally'     => self::get( 'vxt_load_select_font_globally', 'disabled' ),
				'vxt_load_gfonts_locally'           => self::get( 'vxt_load_gfonts_locally', 'disabled' ),
				'vxt_collapse_panels'               => self::get( 'vxt_collapse_panels', 'enabled' ),
				'vxt_copy_paste'                    => self::get( 'vxt_copy_paste', 'enabled' ),
				'vxt_preload_local_fonts'           => self::get( 'vxt_preload_local_fonts', 'disabled' ),
				'vxt_visibility_mode'               => self::get( 'vxt_visibility_mode', 'disabled' ),
				'vxt_container_global_padding'      => self::get( 'vxt_container_global_padding', 'default' ),
				'vxt_container_global_elements_gap' => self::get( 'vxt_container_global_elements_gap', 20 ),
				'vxt_btn_inherit_from_theme'        => self::get( 'vxt_btn_inherit_from_theme', 'disabled' ),
				'vxt_blocks_editor_spacing'         => apply_filters( 'vxt_ultimate_gutenberg_blocks_default_blocks_editor_spacing', self::get( 'vxt_blocks_editor_spacing', 0 ) ),
				'vxt_load_font_awesome_5'           => self::get( 'vxt_load_font_awesome_5' ),
				'vxt_auto_block_recovery'           => self::get( 'vxt_auto_block_recovery' ),
				'vxt_enable_bsf_analytics_option'   => self::get( 'vexaltrix_usage_optin', 'no' ),
				'vxt_content_width'                 => $contentWidth,
				'vexaltrix_core_blocks'               => apply_filters(
					'vexaltrix_core_blocks',
					[
						'container',
						'advanced-heading',
						'image',
						'icon',
						'buttons',
						'info-box',
						'call-to-action',
						'countdown',
						'popup-builder',
					]
				),
				'wp_is_block_theme'                 => self::isBlockTheme(),
				'zip_ai_modules'                    => $zipAiModules,
			];

			return $options;
		}

		/**
		 * Update all data from the admin settings page.
		 *
		 * @param array $data All settings of Admin.
		 * @return mixed
		 * @since 2.0.8
		 */
		public static function updateAdminSettingsShareableData( $data = [] ) {

			foreach ( $data as $key => $value ) {
				self::updateAdminSettingsOption( $key, $value );
			}
		}

		/**
		 * Returns an option from the database for
		 * the admin settings page.
		 *
		 * @param  string  $key     The option key.
		 * @param  mixed   $default Option default value if option is not available.
		 * @param  boolean $networkOverride Whether to allow the network admin setting to be overridden on subsites.
		 * @return mixed            Return the option value.
		 * @since 0.0.1
		 */
		public static function get( $key, $default = false, $networkOverride = false ) {
			// Get the site-wide option if we're in the network admin.
			return $networkOverride && is_multisite() ? get_site_option( $key, $default ) : get_option( $key, $default );
		}

		/**
		 * Deletes an option from the database for
		 * the admin settings page.
		 *
		 * @param  string  $key     The option key.
		 * @param  boolean $networkOverride Whether to allow the network admin setting to be overridden on subsites.
		 * @since 2.8.0
		 * @return void            Return the option value.
		 */
		public static function deleteAdminSettingsOption( $key, $networkOverride = false ) {
			// Get the site-wide option if we're in the network admin.
			if ( $networkOverride && is_multisite() ) {
				delete_site_option( $key );
			} else {
				delete_option( $key );
			}
		}

		/**
		 * Provide Widget settings.
		 *
		 * @return array()
		 * @since 0.0.1
		 */
		public static function getBlockOptions() {

			$blocks       = \Vexaltrix\Core\Support\Helper::$blockList;
			$savedBlocks = self::get( '_vxt_ultimate_gutenberg_blocks_blocks' );

			if ( ! is_array( $blocks ) ) {
				$blocks = \Vexaltrix\Presentation\Blocks\BlockModule::getBlocksInfo();
			}

			if ( is_array( $blocks ) ) {
				foreach ( $blocks as $slug => $data ) {
					$_slug = str_replace( 'vexaltrix/', '', $slug );

					if ( isset( $savedBlocks[ $_slug ] ) ) {
						if ( 'disabled' === $savedBlocks[ $_slug ] ) {
							$blocks[ $slug ]['is_activate'] = false;
						} else {
							$blocks[ $slug ]['is_activate'] = true;
						}
					} else {
						$blocks[ $slug ]['is_activate'] = ( isset( $data['default'] ) ) ? $data['default'] : false;
					}
				}
			}

			\Vexaltrix\Core\Support\Helper::$blockList = is_array( $blocks ) ? $blocks : [];

			return apply_filters( 'vxt_ultimate_gutenberg_blocks_enabled_blocks', \Vexaltrix\Core\Support\Helper::$blockList );
		}

		/**
		 * Updates an option from the admin settings page.
		 *
		 * @param string $key       The option key.
		 * @param mixed  $value     The value to update.
		 * @param bool   $network   Whether to allow the network admin setting to be overridden on subsites.
		 * @return mixed
		 * @since 0.0.1
		 */
		public static function updateAdminSettingsOption( $key, $value, $network = false ) {

			// Update the site-wide option since we're in the network admin.
			if ( $network && is_multisite() ) {
				update_site_option( $key, $value );
			} else {
				update_option( $key, $value );
			}
		}

		/**
		 *  Get Specific Stylesheet
		 *
		 * @since 1.13.4
		 */
		public static function createSpecificStylesheet() {

			$savedBlocks         = self::get( '_vxt_ultimate_gutenberg_blocks_blocks' );
			$combined             = [];
			$isAlreadyPost      = false;
			$isAlreadyTimeline  = false;
			$isAlreadyColumn    = false;
			$isAlreadyIconList = false;
			$isAlreadyButton    = false;
			$isAlreadyFaq       = false;
			$isAlreadyTabs      = false;
			$blocksInfo          = \Vexaltrix\Presentation\Blocks\BlockModule::getBlocksInfo();

			foreach ( $blocksInfo as $key => $block ) {

				$blockName = str_replace( 'vexaltrix/', '', $key );

				if ( isset( $savedBlocks[ $blockName ] ) && 'disabled' === $savedBlocks[ $blockName ] ) {
					continue;
				}

				switch ( $blockName ) {

					case 'post-grid':
					case 'post-carousel':
					case 'post-masonry':
					case 'post-title':
					case 'post-image':
					case 'post-button':
					case 'post-excerpt':
					case 'post-meta':
						if ( ! $isAlreadyPost ) {
							$combined[]      = 'post';
							$isAlreadyPost = true;
						}
						break;

					case 'columns':
					case 'column':
						if ( ! $isAlreadyColumn ) {
							$combined[]        = 'column';
							$combined[]        = 'columns';
							$isAlreadyColumn = true;
						}
						break;

					case 'icon-list':
					case 'icon-list-child':
						if ( ! $isAlreadyIconList ) {
							$combined[]           = 'icon-list';
							$combined[]           = 'icon-list-child';
							$isAlreadyIconList = true;
						}
						break;
					case 'buttons-child':
					case 'buttons':
						if ( ! $isAlreadyButton ) {
							$combined[]        = 'buttons';
							$combined[]        = 'buttons-child';
							$isAlreadyButton = true;
						}
						break;

					case 'post-timeline':
					case 'content-timeline':
						if ( ! $isAlreadyTimeline ) {
							$combined[]          = 'timeline';
							$isAlreadyTimeline = true;
						}
						break;

					case 'restaurant-menu':
						$combined[] = 'price-list';
						break;

					case 'faq-child':
					case 'faq':
						if ( ! $isAlreadyFaq ) {
							$combined[]     = 'faq';
							$combined[]     = 'faq-child';
							$isAlreadyFaq = true;
						}
						break;
					
					case 'tabs-child':
					case 'tabs':
						if ( ! $isAlreadyTabs ) {
							$combined[]      = 'tabs';
							$combined[]      = 'tabs-child';
							$isAlreadyTabs = true;
						}
						break;

					default:
						$combined[] = $blockName;
						break;
				}
			}

			// Load common CSS for all the blocks.
			$combined[] = 'extensions';

			$wpUploadDir = \Vexaltrix\Core\Support\Helper::getUagUploadDirPath();
			$combinedPath = $wpUploadDir . 'custom-style-blocks.css';

			$style = '';

			$wp_filesystem = vxt_ultimate_gutenberg_blocks_filesystem();

			foreach ( $combined as $key => $cBlock ) {

				if ( false !== strpos( $cBlock, '-pro' ) ) {
					$styleFile = WP_VXT_PRO_DIR . 'assets/css/blocks/' . $cBlock . '.css';
				} else {
					$styleFile = VXT_DIR . 'assets/css/blocks/' . $cBlock . '.css';
				}

				if ( file_exists( $styleFile ) ) {
					$style .= $wp_filesystem->get_contents( $styleFile );
				}
			}

			$wp_filesystem->put_contents( $combinedPath, $style, FS_CHMOD_FILE );
		}

		/**
		 * Get Rollback versions.
		 *
		 * @since 1.23.0
		 * @return array
		 * @access public
		 */
		public function getRollbackVersions() {

			$rollbackVersions = get_transient( 'vxt_rollback_versions_' . VXT_VER );

			if ( empty( $rollbackVersions ) ) {

				$maxVersions = 10;

				require_once ABSPATH . 'wp-admin/includes/plugin-install.php';

				$pluginInformation = plugins_api(
					'plugin_information',
					[
						'slug' => 'vexaltrix',
					]
				);

				if ( empty( $pluginInformation->versions ) || ! is_array( $pluginInformation->versions ) ) {
					return [];
				}

				krsort( $pluginInformation->versions );

				$rollbackVersions = [];

				foreach ( $pluginInformation->versions as $version => $downloadLink ) {

					$lowercaseVersion = strtolower( $version );

					$isValidRollbackVersion = ! preg_match( '/(trunk|beta|rc|dev)/i', $lowercaseVersion );

					if ( ! $isValidRollbackVersion ) {
						continue;
					}

					if ( version_compare( $version, VXT_VER, '>=' ) ) {
						continue;
					}

					$rollbackVersions[] = $version;
				}

				usort( $rollbackVersions, [ $this, 'sortRollbackVersions' ] );

				$rollbackVersions = array_slice( $rollbackVersions, 0, $maxVersions, true );

				set_transient( 'vxt_rollback_versions_' . VXT_VER, $rollbackVersions, WEEK_IN_SECONDS );
			}

			return $rollbackVersions;
		}
		/**
		 * Sort Rollback versions.
		 *
		 * @param string $prev Previous Version.
		 * @param string $next Next Version.
		 *
		 * @since 1.23.0
		 * @return array
		 * @access public
		 */
		public function sortRollbackVersions( $prev, $next ) {

			if ( version_compare( $prev, $next, '==' ) ) {
				return 0;
			}

			if ( version_compare( $prev, $next, '>' ) ) {
				return -1;
			}

			return 1;
		}

		/**
		 * Checks if assets should be excluded for a given Custom Post Type (CPT).
		 *
		 * This static method determines if assets should be excluded based on the given CPT and
		 * any additional exclusions provided via a filter.
		 *
		 * @since 2.16.0
		 * @return bool True if assets should be excluded for the given CPT, false otherwise.
		 */
		public static function shouldExcludeAssetsForCpt() {
			// Define the default CPTs to always exclude.
			$defaultExcludedCpts = [ 'sureforms_form' ];

			// Get the filtered CPT(s) that should not load assets.
			$filteredExcludedCpts = apply_filters( 'exclude_vxt_ultimate_gutenberg_blocks_assets_for_cpts', [] );

			// If the filtered value is not an array, set it to an empty array.
			if ( ! is_array( $filteredExcludedCpts ) ) {
				$filteredExcludedCpts = [];
			}

			// Merge default and filtered excluded CPTs.
			$excludedCpts = array_merge( $defaultExcludedCpts, $filteredExcludedCpts );

			// Pass the excluded CPTs to the 'ast_block_templates_exclude_post_types' filter.
			add_filter(
				'ast_block_templates_exclude_post_types',
				function() use ( $excludedCpts ) {
					return $excludedCpts;
				}
			);

			// Pass the excluded CPTs to the 'zipwp_images_excluded_post_types' filter.
			add_filter(
				'zipwp_images_excluded_post_types',
				function() use ( $excludedCpts ) {
					return $excludedCpts;
				}
			);

			// Initialize post type variable.
			$postType = '';

			// Check if we're in the admin/editor context.
			if ( is_admin() ) {
				// Get the current screen and retrieve the post type.
				$screen    = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
				$postType = ( $screen instanceof WP_Screen ) ? $screen->post_type : ''; // Admin: use WP_Screen.
			} else {
				// On frontend: get the post type from the queried object.
				$queriedObject = get_queried_object();
				$postType      = ( $queriedObject instanceof WP_Post ) ? get_post_type( $queriedObject ) : ''; // Frontend: use WP_Post.
			}

			// Return true if the post type matches any in the excluded CPTs list.
			return in_array( $postType, $excludedCpts );
		}


		/**
		 * Get Global Content Width
		 *
		 * @since 2.0.0
		 * @return int
		 * @access public
		 */
		public static function getGlobalContentWidth() {
			$contentWidth                = self::get( 'vxt_content_width', '' );
			$uagContentWidthSetBy     = 'Vexaltrix';
			$getUagContentWidthSetBy = self::get( 'vxt_content_width_set_by', '' );

			if ( '' === $contentWidth ) {
				$contentWidthThirdParty = apply_filters( 'vexaltrix_global_content_width', 'default' );
				$astraContentWidth       = function_exists( 'astra_get_option' ) ? astra_get_option( 'site-content-width' ) : false;

				if ( self::isBlockTheme() ) {
					$settings                 = wp_get_global_settings();
					$contentWidth            = intval( $settings['layout']['wideSize'] );
					$uagContentWidthSetBy = __( "Full Site Editor's Global Styles", 'vexaltrix' );
				} elseif ( 'default' !== $contentWidthThirdParty ) {
					$contentWidth            = intval( $contentWidthThirdParty );
					$uagContentWidthSetBy = __( 'Filter added through any 3rd Party Theme/Plugin.', 'vexaltrix' );
				} elseif ( $astraContentWidth ) {
					$contentWidth            = intval( $astraContentWidth );
					$astThemeName           = function_exists( 'astra_get_theme_name' ) ? astra_get_theme_name() : 'Astra';
					$uagContentWidthSetBy = $astThemeName . ' ' . __( 'Theme', 'vexaltrix' );
				}
			}

			// Update admin settings option vxt_content_width_set_by if $getUagContentWidthSetBy and $uagContentWidthSetBy are not same.
			if ( $getUagContentWidthSetBy !== $uagContentWidthSetBy ) {
				self::updateAdminSettingsOption( 'vxt_content_width_set_by', $uagContentWidthSetBy );
			}

			return '' === $contentWidth ? 1140 : $contentWidth;
		}

		/**
		 * Function to check if the current theme is a block theme.
		 *
		 * @since 2.7.11
		 * @return boolean
		 */
		public static function isBlockTheme() {
			return ( function_exists( 'wp_is_block_theme' ) && wp_is_block_theme() ) ? true : false;
		}

		/**
		 * Get Vexaltrix Pro URL with required params
		 *
		 * @param string $path     Path for the Website URL.
		 * @param string $source   UMM source.
		 * @param string $medium   UTM medium.
		 * @param string $campaign UTM campaign.
		 * @since 2.7.11
		 * @return string
		 */
		public static function getProUrl( $path, $source = '', $medium = '', $campaign = '' ) {
			if ( ! defined( 'VXT_URI' ) ) {
				define( 'VXT_URI', trailingslashit( 'https://vexaltrix.com/' ) );
			}

			$url             = esc_url( VXT_URI . $path );
			$vexaltrixProUrl = trailingslashit( $url );

			// Modify the utm_source parameter using the UTM ready link function to include tracking information.
			if ( class_exists( '\BSF_UTM_Analytics\Inc\Utils' ) && is_callable( '\BSF_UTM_Analytics\Inc\Utils::get_utm_ready_link' ) ) {
				$vexaltrixProUrl = \BSF_UTM_Analytics\Inc\Utils::get_utm_ready_link( $vexaltrixProUrl, 'vexaltrix' );
			} else {
				if ( ! empty( $source ) ) {
					$vexaltrixProUrl = add_query_arg( 'utm_source', sanitize_text_field( $source ), $vexaltrixProUrl );
				}
			}

			// Set up our URL if we have a medium.
			if ( ! empty( $medium ) ) {
				$vexaltrixProUrl = add_query_arg( 'utm_medium', sanitize_text_field( $medium ), $vexaltrixProUrl );
			}

			// Set up our URL if we have a campaign.
			if ( ! empty( $campaign ) ) {
				$vexaltrixProUrl = add_query_arg( 'utm_campaign', sanitize_text_field( $campaign ), $vexaltrixProUrl );
			}

			$vexaltrixProUrl = apply_filters( 'vexaltrix_get_pro_url', $vexaltrixProUrl, $url );
			$vexaltrixProUrl = remove_query_arg( 'bsf', is_string( $vexaltrixProUrl ) ? $vexaltrixProUrl : '' );

			$ref = get_option( 'vexaltrix_partner_url_param', '' );
			if ( ! empty( $ref ) && is_string( $ref ) ) {
				$vexaltrixProUrl = add_query_arg( 'bsf', sanitize_text_field( $ref ), $vexaltrixProUrl );
			}

			return $vexaltrixProUrl;
		}

		/**
		 * Prepare user country code.
		 *
		 * Returns the user's country code.
		 * Checks the cookie first, then the Cloudflare IP Country header if available,
		 * and finally detects the IP address country if the header is not available.
		 *
		 * @since 2.19.8
		 * @return string The user's country code.
		 */
		public static function prepareUserCountryCode() {
			static $currencyCode = 'null';

			$defaultCurrencyCode = 'US'; // Default currency.
			$userId               = get_current_user_id();

			// If user is logged in and currency is already stored.
			if ( $userId ) {
				$storedCode = get_user_meta( $userId, 'pse_country_code', true );
				if ( is_string( $storedCode ) && ! empty( $storedCode ) ) {
					$currencyCode = sanitize_text_field( $storedCode );
					return $currencyCode;
				}
			}

			// Prefer Cloudflare IP Country header if available.
			if ( isset( $_SERVER['HTTP_CF_IPCOUNTRY'] ) ) {
				$defaultCurrencyCode = sanitize_text_field( $_SERVER['HTTP_CF_IPCOUNTRY'] );

				if ( $userId && $defaultCurrencyCode ) {
					update_user_meta( $userId, 'pse_country_code', $defaultCurrencyCode );
					$currencyCode = $defaultCurrencyCode;
					return $defaultCurrencyCode;
				}
			}

			// Detect IP address country if Cloudflare header is not available.
			$tokens = [
				'c1578516a7378c', // rohitp@bsf.io.
				'abeeb8e41600b5', // lawaca8819@cashbn.com.
				'0f5ba880c5ee80', // tern0@mailshan.com.
			];

			$userIp = static::getUserIp();
			if ( ! empty( $userIp ) ) {
				if ( ! filter_var( $userIp, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) ) {
					return $defaultCurrencyCode;
				}

				$token = $tokens[ array_rand( $tokens ) ];
				$url   = "https://ipinfo.io/{$userIp}?token={$token}";

				$request = wp_remote_get(
					$url,
					[
						'timeout' => 2,
					]
				);
				if ( ! is_wp_error( $request ) && wp_remote_retrieve_response_code( $request ) === 200 ) {
					$response = json_decode( wp_remote_retrieve_body( $request ), true );

					if ( is_array( $response ) && ! empty( $response['country'] ) ) {
						$defaultCurrencyCode = sanitize_text_field( $response['country'] );
					}

					if ( $userId ) {
						update_user_meta( $userId, 'pse_country_code', $defaultCurrencyCode );
					}
					$currencyCode = $defaultCurrencyCode;
					return $defaultCurrencyCode;
				}
			}

			return $defaultCurrencyCode;
		}

		/**
		 * Retrieves the user's IP address.
		 *
		 * This function works by following the order of preference:
		 * 1. Cloudflare's `HTTP_CF_CONNECTING_IP`.
		 * 2. `HTTP_X_FORWARDED_FOR` (first IP in case of multiple proxies).
		 * 3. `HTTP_CLIENT_IP`.
		 * 4. `REMOTE_ADDR`.
		 *
		 * @since 2.19.8
		 * @return string The user's IP address.
		 */
		public static function getUserIp() {
			if ( ! empty( $_SERVER['HTTP_CF_CONNECTING_IP'] ) ) {
				return sanitize_text_field( $_SERVER['HTTP_CF_CONNECTING_IP'] ); // Cloudflare real IP.
			} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
				return explode( ',', sanitize_text_field( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )[0]; // First IP in case of multiple proxies.
			} elseif ( ! empty( $_SERVER['HTTP_CLIENT_IP'] ) ) {
				return sanitize_text_field( $_SERVER['HTTP_CLIENT_IP'] );
			} elseif ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
				return sanitize_text_field( $_SERVER['REMOTE_ADDR'] );
			}
			return '';
		}

		/**
		 * Get the user's country code and return a pricing region
		 *
		 * Returns a pricing region based on the user's country code.
		 * The pricing regions are based on the country codes.
		 * The default pricing region is 'US'.
		 *
		 * @since 2.19.8
		 * @return string The pricing region.
		 */
		public static function getUserCountryCode() {
			$countryCode   = self::prepareUserCountryCode();
			$pricingRegion = 'US'; // Default fallback.

			switch ( $countryCode ) {
				case 'IN':
					$pricingRegion = 'IN';
					break;

				// Add more cases as needed.

				default:
					$pricingRegion = 'US';
					break;
			}

			return $pricingRegion;
		}

		/**
		 * Sanitize inline css.
		 *
		 * @param string $css User-provided CSS input.
		 *
		 * @since 2.19.15
		 * @return string Sanitized CSS.
		 */
		public static function sanitizeInlineCss( $css ) {
			if ( empty( $css ) || ! is_string( $css ) ) {
				return '';
			}

			// 1. Strip all HTML/Script tags.
			$css = wp_strip_all_tags( $css );
			$css = is_string( $css ) ? $css : '';

			// 2. Additional XSS prevention.
			$css = str_replace( [ '\\', '<', '&' ], '', $css );

			// 3. Context-aware XSS prevention that preserves valid CSS.
			$css = self::sanitizeCssWithContext( $css );

			// Final safety check to ensure we always return a string.
			return is_string( $css ) ? $css : '';
		}

		/**
		 * Context-aware CSS sanitization that preserves quoted content.
		 *
		 * @param string $css CSS content to sanitize.
		 * @return string Sanitized CSS.
		 * @since 2.19.15
		 */
		private static function sanitizeCssWithContext( $css ) {
			if ( empty( $css ) || ! is_string( $css ) ) {
				return '';
			}

			// Extract and protect quoted strings (including URLs in quotes).
			$protectedStrings  = [];
			$placeholderPrefix = '___PROTECTED_STRING_';
			$counter            = 0;

			// Match quoted strings (single and double quotes).
			$result = preg_replace_callback(
				'/(["\'])((?:\\\\.|(?!\1)[^\\\\])*)(\1)/',
				function( $matches ) use ( &$protectedStrings, $placeholderPrefix, &$counter ) {
					$placeholder                       = $placeholderPrefix . $counter . '___';
					$protectedStrings[ $placeholder ] = $matches[0];
					$counter++;
					return $placeholder;
				},
				$css
			);
			$css    = is_string( $result ) ? $result : $css;

			// Apply XSS patterns only to unprotected (non-quoted) content.
			$xssPatterns = [
				// Dangerous CSS functions and protocols.
				'/javascript\s*:/i',
				'/vbscript\s*:/i',
				'/data\s*:\s*[^;]*script/i',

				// CSS expressions (IE specific).
				'/expression\s*\(/i',

				// Event handlers (shouldn't be in CSS but could be injected).
				'/on\w+\s*=/i',

				// Script execution attempts.
				'/alert\s*\(/i',
				'/eval\s*\(/i',

				// @import with potentially dangerous URLs (but preserve normal @import).
				'/@import\s+[^;]*javascript\s*:/i',
				'/@import\s+[^;]*vbscript\s*:/i',
				'/@import\s+[^;]*data\s*:\s*[^;]*script/i',
			];

			foreach ( $xssPatterns as $pattern ) {
				$result = preg_replace( $pattern, '', $css );
				$css    = is_string( $result ) ? $result : $css;
			}

			// Restore protected quoted strings.
			foreach ( $protectedStrings as $placeholder => $original ) {
				$result = str_replace( $placeholder, $original, $css );
				$css    = is_string( $result ) ? $result : $css;
			}

			return $css;
		}
	
	/**
	 * Service group.
	 *
	 * @return string
	 */
	public static function group(): string {
		return 'presentation';
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
		// Auto-generated boot method.
	}

}

	/**
	 *  Prepare if class 'Vexaltrix\Presentation\Admin\\AdminSettings' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
