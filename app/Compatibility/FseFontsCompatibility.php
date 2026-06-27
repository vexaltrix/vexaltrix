<?php
/**
 * Vexaltrix FSE Fonts Compatibility.
 *
 * @since 2.5.1
 * @package Vexaltrix
 */

namespace Vexaltrix\Compatibility;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\\Compatibility\\FseFontsCompatibility' ) ) {

	/**
	 * Class \Vexaltrix\Compatibility\FseFontsCompatibility.
	 *
	 * @since 2.5.1
	 */
	final class FseFontsCompatibility {

		/**
		 * Member Variable
		 *
		 * @since 2.5.1
		 * @var instance
		 */
		private static $instance;

		/**
		 * Base path.
		 *
		 * @access protected
		 * @since 2.5.1
		 * @var string
		 */
		protected $basePath;

		/**
		 * Base URL.
		 *
		 * @access protected
		 * @since 2.5.1
		 * @var string
		 */
		protected $baseUrl;

		/**
		 * The remote CSS.
		 *
		 * @access protected
		 * @since 2.5.1
		 * @var string
		 */
		protected $remoteStyles;

		/**
		 * The font-format.
		 *
		 * Use "woff" or "woff2".
		 * This will change the user-agent user to make the request.
		 *
		 * @access protected
		 * @since 2.5.1
		 * @var string
		 */
		protected $fontFormat = 'woff2';

		/**
		 *  Initiator
		 *
		 * @return object instance.
		 * @since 2.5.1
		 */
		public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 *
		 * @return void
		 * @since 2.5.1
		 */
		public function __construct() {
			$this->basePath = VXT_UPLOAD_DIR . 'assets/';

			$this->baseUrl = VXT_UPLOAD_URL . 'assets/';

			if ( empty( $_GET['page'] ) || 'vexaltrix' !== $_GET['page'] || empty( $_GET['path'] ) || 'settings' !== $_GET['path'] || empty( $_GET['settings'] ) || 'fse-support' !== $_GET['settings'] ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended -- $_GET['settings'] does not provide nonce.
				return;
			}

			$vxtUltimateGutenbergBlocksFilesystem   = vxt_ultimate_gutenberg_blocks_filesystem();
			$fontsFolderPath = get_stylesheet_directory() . '/assets/fonts/vexaltrix';

			if ( file_exists( $fontsFolderPath ) ) {
				$vxtUltimateGutenbergBlocksFilesystem->delete( $fontsFolderPath, true, 'd' );
			}

			self::deleteAllThemeFontFamily();

			$loadFseFontGlobally = \Vexaltrix\Admin\AdminSettings::get( 'uag_load_fse_font_globally', 'disabled' );

			if ( 'disabled' !== $loadFseFontGlobally ) {

				add_action( 'admin_init', [ $this, 'saveGoogleFontsToTheme' ] );
			}
		}

		/**
		 * Get, add and update font family in Vexaltrix for ST.
		 *
		 * @param array $families font family.
		 * @since 2.7.0
		 * @return void
		 */
		public function getFontFamilyForStarterTemplate( $families ) {
			if ( \Vexaltrix\Admin\AdminSettings::get( 'uag_load_fse_font_globally', 'disabled' ) ) { // if Load FSE Fonts Globaly is disabled then enabled it.
				\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( 'uag_load_fse_font_globally', 'enabled' );
			}
			$newFontFamilies = [];
			$newFontFaces    = [];
			if ( empty( $families ) || ! is_array( $families ) ) {
				return;
			}
			foreach ( $families as $family ) {
				$fontName        = ! empty( $family ) ? $family : '';
				$fontNameString = explode( ',', $fontName );
				$fontFamily      = trim( $fontNameString[0], "'" );
				$fontSlug        = $this->getFontSlug( $fontFamily );
				$fontWeight      = 'Default';
				$fontStyle       = 'normal';
				$finalFontFiles = $this->getFontsFileUrl( $fontFamily, $fontWeight, $fontStyle );
				// Loop through each font file and create a font face for it.
				foreach ( $finalFontFiles as $src ) {
					$newFontFaces[] = [
						'fontFamily' => $fontFamily,
						'fontStyle'  => $fontStyle,
						'fontWeight' => $fontWeight,
						'src'        => [ $src ],
					];
				}
				$this->addOrUpdateThemeFontFaces( $fontFamily, $fontSlug, $newFontFaces );
			}

			$themeJsonRaw = json_decode( file_get_contents( get_stylesheet_directory() . '/theme.json' ), true );

			$allFontFamilies = $themeJsonRaw['settings']['typography']['fontFamilies'];
			
			if ( empty( $allFontFamilies ) || ! is_array( $allFontFamilies ) ) {
				return;
			}

			foreach ( $allFontFamilies as $fontFamiliesItem ) {
				$newFontFamiliesItem = [
					'value'   => $fontFamiliesItem['fontFamily'],
					'label'   => $fontFamiliesItem['fontFamily'],
					'weights' => [
						[
							'value' => 'Default',
							'label' => __( 'Default', 'vexaltrix' ),
						],
						[
							'value' => '400',
							'label' => __( '400', 'vexaltrix' ),
						],
					],
					'styles'  => [
						[
							'value' => 'normal',
							'label' => __( 'normal', 'vexaltrix' ),
						],
					],
					'weight'  => [
						[
							'value' => '400',
							'label' => __( '400', 'vexaltrix' ),
						],
					],
					'style'   => [
						[
							'value' => 'normal',
							'label' => __( 'normal', 'vexaltrix' ),
						],
					],
				];

				$newFontFamilies[] = $newFontFamiliesItem;
			}

			\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( 'vexaltrix_global_fse_fonts', $newFontFamilies );
		}

		/**
		 * Save Google Fonts to the FSE Theme.
		 *
		 * @return void
		 * @since 2.5.1
		 */
		public function saveGoogleFontsToTheme() {

			$vexaltrixGlobalFseFonts = \Vexaltrix\Admin\AdminSettings::get( 'vexaltrix_global_fse_fonts', [] );

			if ( empty( $vexaltrixGlobalFseFonts ) || ! is_array( $vexaltrixGlobalFseFonts ) ) {
				return;
			}

			foreach ( $vexaltrixGlobalFseFonts as $font ) {
				$fontFamily    = ! empty( $font['value'] ) ? $font['value'] : '';
				$fontSlug      = $this->getFontSlug( $fontFamily );
				$newFontFaces = [];
				foreach ( $font['weight'] as $weight ) {
					$fontWeight = ! empty( $weight['value'] ) ? $weight['value'] : '';
					foreach ( $font['style'] as $style ) {
						$fontStyle = ! empty( $style['value'] ) ? $style['value'] : '';

						$finalFontFiles = $this->getFontsFileUrl( $fontFamily, $fontWeight, $fontStyle );
						// Loop through each font file and create a font face for it.
						foreach ( $finalFontFiles as $src ) {
							$newFontFaces[] = [
								'fontFamily' => $fontFamily,
								'fontStyle'  => $fontStyle,
								'fontWeight' => $fontWeight,
								'src'        => [ $src ],
							];
						}
					}
				}
				$this->addOrUpdateThemeFontFaces( $fontFamily, $fontSlug, $newFontFaces );
			}
		}

		/**
		 * Get Font Slug.
		 *
		 * @return string slug.
		 * @param string $name Font Family.
		 * @since 2.5.1
		 */
		public function getFontSlug( $name ) {
			$slug = sanitize_title( $name );
			$slug = preg_replace( '/\s+/', '', $slug ); // Remove spaces.
			return $slug;
		}

		/**
		 * Get Font URl.
		 *
		 * @param string $fontFamily Font Family.
		 * @param string $fontWeight Font Weight.
		 * @param string $fontStyle Font Style.
		 * @return array final font files.
		 * @since 2.5.1
		 */
		public function getFontsFileUrl( $fontFamily, $fontWeight, $fontStyle ) {

			$fontFamilyKey = sanitize_key( strtolower( str_replace( ' ', '-', $fontFamily ) ) );
			$fontsAttr      = str_replace( ' ', '+', $fontFamily );
			$fontsFileName = $fontFamilyKey;
			if ( ! empty( $fontWeight ) ) {
				$fontsAttr      .= ':' . $fontWeight;
				$fontsFileName .= '-' . $fontWeight;
				if ( ! empty( $fontStyle ) ) {
					$fontsAttr      .= ',' . $fontWeight . $fontStyle;
					$fontsFileName .= '-' . $fontStyle;
				}
			}
			$fontsLink = 'https://fonts.googleapis.com/css?family=' . esc_attr( $fontsAttr );

			// Get the remote URL contents.
			$this->remote_styles = $this->getRemoteUrlContents( $fontsLink );
			$fontFiles          = $this->getRemoteFilesFromCss();

			$fontsFolderPath = get_stylesheet_directory() . '/assets/fonts/vexaltrix/';

			// If the fonts folder don't exist, create it.
			if ( ! file_exists( $fontsFolderPath ) ) {

				wp_mkdir_p( $fontsFolderPath );

				if ( ! file_exists( $fontsFolderPath ) ) {
					$this->getFilesystem()->mkdir( $fontsFolderPath, FS_CHMOD_DIR );
				}
			}
			$finalFontFiles = [];

			if ( ! is_array( $fontFiles ) && empty( $fontFiles ) && empty( $fontFamilyKey ) ) {
				return;
			}
			foreach ( $fontFiles[ $fontFamilyKey ] as $key => $fontFile ) {

				// require file.php if the download_url function doesn't exist.
				if ( ! function_exists( 'download_url' ) ) {
					require_once wp_normalize_path( ABSPATH . '/wp-admin/includes/file.php' );
				}
				// Download file to temporary location.
				$tmpPath = download_url( $fontFile );

				// Make sure there were no errors.
				if ( is_wp_error( $tmpPath ) ) {
					return [];
				}

				$fontsFileNameFinal = $fontsFileName . $key . '.' . $this->font_format;
				// Move font asset to theme assets folder.
				rename( $tmpPath, get_stylesheet_directory() . '/assets/fonts/vexaltrix/' . $fontsFileNameFinal ); // phpcs:ignore WordPressVIPMinimum.Functions.RestrictedFunctions.file_ops_rename

				$finalFontFiles[] = 'file:./assets/fonts/vexaltrix/' . $fontsFileNameFinal;
			}

			return $finalFontFiles;
		}

		/**
		 * Get the filesystem.
		 *
		 * @access protected
		 * @since 2.5.1
		 * @return WP_Filesystem
		 */
		protected function getFilesystem() {
			global $wp_filesystem;

			// If the filesystem has not been instantiated yet, do it here.
			if ( ! $wp_filesystem ) {
				if ( ! function_exists( 'WP_Filesystem' ) ) {
					require_once wp_normalize_path( ABSPATH . '/wp-admin/includes/file.php' );
				}
				WP_Filesystem();
			}
			return $wp_filesystem;
		}

		/**
		 * Get remote file contents.
		 *
		 * @access public
		 * @param string $url URL.
		 * @since 2.5.1
		 * @return string Returns the remote URL contents.
		 */
		public function getRemoteUrlContents( $url ) {

			/**
			 * The user-agent we want to use.
			 *
			 * The default user-agent is the only one compatible with woff (not woff2)
			 * which also supports unicode ranges.
			 */
			$userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/603.3.8 (KHTML, like Gecko) Version/10.1.2 Safari/603.3.8';

			// Switch to a user-agent supporting woff2 if we don't need to support IE.
			if ( 'woff2' === $this->font_format ) {
				$userAgent = 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:73.0) Gecko/20100101 Firefox/73.0';
			}

			// Get the response.
			$response = wp_remote_get( $url, [ 'user-agent' => $userAgent ] );

			// Early exit if there was an error.
			if ( is_wp_error( $response ) ) {
				return '';
			}

			// Get the CSS from our response.
			$contents = wp_remote_retrieve_body( $response );

			// Early exit if there was an error.
			if ( is_wp_error( $contents ) ) {
				return '';
			}

			return $contents;
		}

		/**
		 * Get font files from the CSS.
		 *
		 * @access public
		 * @since 2.5.1
		 * @return array Returns an array of font-families and the font-files used.
		 */
		public function getRemoteFilesFromCss() {

			// Return early if remote styles is not a string, or is empty.
			if ( ! is_string( $this->remote_styles ) || empty( $this->remote_styles ) ) {
				return [];
			}

			$fontFaces = explode( '@font-face', $this->remote_styles );

			// Return early if font faces is not an array, or is empty.
			if ( ! is_array( $fontFaces ) || empty( $fontFaces ) ) {
				return [];
			}

			$result = [];

			// Loop all our font-face declarations.
			foreach ( $fontFaces as $fontFace ) {

				// Continue the loop if the current font face is not a string, or is empty.
				if ( ! is_string( $fontFace ) || empty( $fontFace ) ) {
					continue;
				}

				// Get the styles based on the font face.
				$styleArray = explode( '}', $fontFace );

				// Continue the loop if the current font face is not a string, or is empty.
				if ( ! is_string( $styleArray[0] ) || empty( $styleArray[0] ) ) {
					continue;
				}

				// Make sure we only process styles inside this declaration.
				$style = $styleArray[0];

				// Sanity check.
				if ( false === strpos( $style, 'font-family' ) ) {
					continue;
				}

				// Get an array of our font-families.
				preg_match_all( '/font-family.*?\;/', $style, $matchedFontFamilies );

				// Get an array of our font-files.
				preg_match_all( '/url\(.*?\)/i', $style, $matchedFontFiles );

				// Get the font-family name.
				$fontFamily = 'unknown';
				if ( isset( $matchedFontFamilies[0] ) && isset( $matchedFontFamilies[0][0] ) ) {
					$fontFamily = rtrim( ltrim( $matchedFontFamilies[0][0], 'font-family:' ), ';' );
					$fontFamily = trim( str_replace( [ "'", ';' ], '', $fontFamily ) );
					$fontFamily = sanitize_key( strtolower( str_replace( ' ', '-', $fontFamily ) ) );
				}

				// Make sure the font-family is set in our array.
				if ( ! isset( $result[ $fontFamily ] ) ) {
					$result[ $fontFamily ] = [];
				}

				// Get files for this font-family and add them to the array.
				foreach ( $matchedFontFiles as $match ) {

					// Sanity check.
					if ( ! isset( $match[0] ) ) {
						continue;
					}

					// Add the file URL.
					$result[ $fontFamily ][] = rtrim( ltrim( $match[0], 'url(' ), ')' );
				}

				// Make sure we have unique items.
				// We're using array_flip here instead of array_unique for improved performance.
				$result[ $fontFamily ] = array_flip( array_flip( $result[ $fontFamily ] ) );
			}
			return $result;
		}

		/**
		 * Get font files from the CSS.
		 *
		 * @access public
		 * @param string $fontName Font Name.
		 * @param string $fontSlug Font Slug.
		 * @param array  $fontFaces Font Faces.
		 * @return void
		 * @since 2.5.1
		 */
		public function addOrUpdateThemeFontFaces( $fontName, $fontSlug, $fontFaces ) {
			// Get the current theme.json and fontFamilies defined (if any).
			$themeJsonRaw      = json_decode( file_get_contents( get_stylesheet_directory() . '/theme.json' ), true );
			$themeFontFamilies = isset( $themeJsonRaw['settings']['typography']['fontFamilies'] ) ? $themeJsonRaw['settings']['typography']['fontFamilies'] : null;

			$existentFamily = $themeFontFamilies ? array_values(
				array_filter(
					$themeFontFamilies,
					function ( $fontFamily ) use ( $fontSlug ) {
						return $fontFamily['slug'] === $fontSlug; }
				)
			) : null;

			// Add the new font faces.
			if ( empty( $existentFamily ) ) { // If the new font family doesn't exist in the theme.json font families, add it to the exising font families.
				$themeFontFamilies[] = [
					'fontFamily' => $fontName,
					'slug'       => $fontSlug,
					'fontFace'   => $fontFaces,
					'isVexaltrix'  => true,
				];
			} else { // If the new font family already exists in the theme.json font families, add the new font faces to the existing font family.
				$themeFontFamilies            = array_values(
					array_filter(
						$themeFontFamilies,
						function ( $fontFamily ) use ( $fontSlug ) {
							return $fontFamily['slug'] !== $fontSlug; }
					)
				);
				$existentFamily[0]['fontFace'] = $fontFaces;
				$themeFontFamilies            = array_merge( $themeFontFamilies, $existentFamily );
			}

			// Overwrite the previous fontFamilies with the new ones.
			$themeJsonRaw['settings']['typography']['fontFamilies'] = $themeFontFamilies;

			$themeJson        = wp_json_encode( $themeJsonRaw, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
			$themeJsonString = preg_replace( '~(?:^|\G)\h{4}~m', "\t", $themeJson );

			// Write the new theme.json to the theme folder.
			file_put_contents( // phpcs:ignore WordPressVIPMinimum.Functions.RestrictedFunctions
				get_stylesheet_directory() . '/theme.json',
				$themeJsonString
			);

		}

		/**
		 * Save setting - Sanitizes form inputs.
		 *
		 * @param array $inputSettings setting data.
		 * @return array    The sanitized form inputs.
		 *
		 * @since 2.5.1
		 */
		public static function sanitizeFormInputs( $inputSettings = [] ) {
			$newSettings = [];

			if ( ! empty( $inputSettings ) ) {
				foreach ( $inputSettings as $key => $value ) {

					$newKey = sanitize_text_field( $key );

					if ( is_array( $value ) ) {
						$newSettings[ $newKey ] = self::sanitizeFormInputs( $value );
					} else {
						$newSettings[ $newKey ] = sanitize_text_field( $value );
					}
				}
			}

			return $newSettings;
		}

		/**
		 * Delete all Vexaltrix font files from the theme JSON.
		 *
		 * @return void
		 * @since 2.5.1
		 */
		public static function deleteAllThemeFontFamily() {

			// Construct updated theme.json.
			$themeJsonRaw = json_decode( file_get_contents( get_stylesheet_directory() . '/theme.json' ), true );
			if ( empty( $themeJsonRaw['settings']['typography']['fontFamilies'] ) ) { // Added condition to resolve an issue of PHP Notice:  Undefined index: fontFamilies.
				return;
			}
			// Overwrite the previous fontFamilies with the new ones.
			$fontFamilies = $themeJsonRaw['settings']['typography']['fontFamilies'];

			if ( ! empty( $fontFamilies ) && is_array( $fontFamilies ) ) {
				$fontFamilies = array_values(
					array_filter(
						$fontFamilies,
						function( $value ) {
							if ( ! empty( $value['isVexaltrix'] ) ) {
								return false;
							}
							return true;
						}
					)
				);
			}
			$themeJsonRaw['settings']['typography']['fontFamilies'] = $fontFamilies;

			$themeJson        = wp_json_encode( $themeJsonRaw, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
			$themeJsonString = preg_replace( '~(?:^|\G)\h{4}~m', "\t", $themeJson );

			// Write the new theme.json to the theme folder.
			file_put_contents( // phpcs:ignore WordPressVIPMinimum.Functions.RestrictedFunctions
				get_stylesheet_directory() . '/theme.json',
				$themeJsonString
			);
		}
		/**
		 * Delete font files from the CSS.
		 *
		 * @return void
		 * @param array $font Font Data.
		 * @since 2.5.1
		 */
		public static function deleteThemeFontFamily( $font ) {
			// Construct updated theme.json.
			$themeJsonRaw = json_decode( file_get_contents( get_stylesheet_directory() . '/theme.json' ), true );

			// Overwrite the previous fontFamilies with the new ones.
			$fontFamilies = $themeJsonRaw['settings']['typography']['fontFamilies'];
			if ( ! empty( $fontFamilies ) && is_array( $fontFamilies ) ) {
				foreach ( $fontFamilies as $key => $value ) {
					if ( $font['fontFamily'] === $value['fontFamily'] && ! empty( $value['fontFace'] ) && is_array( $value['fontFace'] ) ) {
						unset( $fontFamilies[ $key ] );
						break;
					}
				}
			}
			$themeJsonRaw['settings']['typography']['fontFamilies'] = $fontFamilies;

			$themeJson        = wp_json_encode( $themeJsonRaw, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
			$themeJsonString = preg_replace( '~(?:^|\G)\h{4}~m', "\t", $themeJson );

			// Write the new theme.json to the theme folder.
			file_put_contents( // phpcs:ignore WordPressVIPMinimum.Functions.RestrictedFunctions
				get_stylesheet_directory() . '/theme.json',
				$themeJsonString
			);

			$vexaltrixGlobalFseFonts = \Vexaltrix\Admin\AdminSettings::get( 'vexaltrix_global_fse_fonts', [] );

			if ( ! is_array( $vexaltrixGlobalFseFonts ) ) {
				$responseData = [
					'messsage' => __( 'There was some error in deleting the font.', 'vexaltrix' ),
				];
				wp_send_json_error( $responseData );
			}

			$vexaltrixGlobalFseFonts = array_values(
				array_filter(
					$vexaltrixGlobalFseFonts,
					function( $value ) use ( $font ) {
						if ( $font['fontFamily'] === $value['value'] ) {
							return false;
						}
						return true;
					}
				)
			);

			foreach ( $vexaltrixGlobalFseFonts as $key => $value ) {
				if ( $font['fontFamily'] === $value['value'] ) {
					array_splice( $vexaltrixGlobalFseFonts, $key, $key );
				}
			}
			$vexaltrixGlobalFseFonts = self::sanitizeFormInputs( $vexaltrixGlobalFseFonts );
			\Vexaltrix\Admin\AdminSettings::updateAdminSettingsOption( 'vexaltrix_global_fse_fonts', $vexaltrixGlobalFseFonts );

			$responseData = [
				'messsage' => __( 'Successfully deleted font.', 'vexaltrix' ),
			];
			wp_send_json_success( $responseData );
		}
	}
}
