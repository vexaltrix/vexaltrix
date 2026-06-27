<?php
/**
 * Vexaltrix - Icon
 *
 * @since 2.12.5
 * @package Vexaltrix
 */

namespace Vexaltrix\BlocksConfig\Icon;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\\BlocksConfig\\Icon\\Icon' ) ) {

	/**
	 * Class \Vexaltrix\BlocksConfig\Icon\Icon.
	 * 
	 * @since 2.12.5
	 */
	final class Icon {

		/**
		 * Member Variable
		 *
		 * @since 2.12.5
		 * @var \Vexaltrix\BlocksConfig\Icon\Icon
		 */
		private static $instance;

		/**
		 *  Initiator
		 *
		 * @since 2.12.5
		 * @return \Vexaltrix\BlocksConfig\Icon\Icon
		 */
		public static function getInstance() {
			return \Vexaltrix\Container::getInstance()->get( self::class );
		}

		/**
		 * Constructor
		 * 
		 * @since 2.12.5
		 */
		public function __construct() {
			add_action( 'init', [ $this, 'registerIcon' ] );
			
		}

		/**
		 * Registers the `icon` block on server.
		 *
		 * @since 2.12.5
		 * @return void
		 */
		public function registerIcon() {
			// Check if the register function exists.
			if ( ! function_exists( 'register_block_type' ) ) {
				return;
			}

			$iconBorderAttributes = [];
			$iconBorderAttributes = \Vexaltrix\Core\Blocks\BlockHelper::uagGeneratePhpBorderAttribute( 'icon' ); // @phpstan-ignore-line
				
			register_block_type(
				'vexaltrix/icon',
				[
					'attributes'      => array_merge(
						[
							'icon'           => [
								'type'    => 'string',
								'default' => 'circle-check',
							],
							// Size.
							'iconSize'       => [
								'type'    => 'number',
								'default' => 40,
							],
							'iconSizeTablet' => [
								'type' => 'number',
							],
							'iconSizeMobile' => [
								'type' => 'number',
							],
							'iconSizeUnit'   => [
								'type'    => 'string',
								'default' => 'px',
							],
						],
						// Alignment.
						[
							'align'       => [
								'type'    => 'string',
								'default' => 'center',
							],
							'alignTablet' => [
								'type'    => 'string',
								'default' => '',
							],
							'alignMobile' => [
								'type'    => 'string',
								'default' => '',
							],
						],
						// Color.
						[
							'iconColor'                    => [
								'type'    => 'string',
								'default' => '#333',
							],
							'iconBorderColor'              => [
								'type'    => 'string',
								'default' => '',
							],
							'iconBackgroundColorType'      => [
								'type'    => 'string',
								'default' => 'classic',
							],
							'iconBackgroundColor'          => [
								'type'    => 'string',
								'default' => '',
							],
							'iconBackgroundGradientColor'  => [
								'type'    => 'string',
								'default' => 'linear-gradient(90deg, rgb(155, 81, 224) 0%, rgb(6, 147, 227) 100%)',
							],
							'iconHoverColor'               => [
								'type'    => 'string',
								'default' => '',
							],
							'iconHoverBackgroundColorType' => [
								'type'    => 'string',
								'default' => 'classic',
							],
							'iconHoverBackgroundColor'     => [
								'type' => 'string',
							],
							'iconHoverBackgroundGradientColor' => [
								'type'    => 'string',
								'default' => 'linear-gradient(90deg, rgb(155, 81, 224) 0%, rgb(6, 147, 227) 100%)',
							],
						],
						// Rotation.
						[
							'rotation'     => [
								'type'    => 'number',
								'default' => 0,
							],
							'rotationUnit' => [
								'type'    => 'string',
								'default' => 'deg',
							],
							'block_id'     => [
								'type' => 'string',
							],
						],
						// Link related attributes.
						[
							'link'                  => [
								'type'    => 'string',
								'default' => '',
							],
							'target'                => [
								'type'    => 'boolean',
								'default' => false,
							],
							'disableLink'           => [
								'type'    => 'boolean',
								'default' => false,
							],
							'iconAccessabilityMode' => [
								'type'    => 'string',
								'default' => 'svg',
							],
							'iconAccessabilityDesc' => [
								'type'    => 'string',
								'default' => '',
							],
						],
						// Padding.
						[
							'iconTopPadding'          => [
								'type'    => 'number',
								'default' => 5,
							],
							'iconRightPadding'        => [
								'type'    => 'number',
								'default' => 5,
							],
							'iconLeftPadding'         => [
								'type'    => 'number',
								'default' => 5,
							],
							'iconBottomPadding'       => [
								'type'    => 'number',
								'default' => 5,
							],
							'iconTopTabletPadding'    => [
								'type' => 'number',
							],
							'iconRightTabletPadding'  => [
								'type' => 'number',
							],
							'iconLeftTabletPadding'   => [
								'type' => 'number',
							],
							'iconBottomTabletPadding' => [
								'type' => 'number',
							],
							'iconTopMobilePadding'    => [
								'type' => 'number',
							],
							'iconRightMobilePadding'  => [
								'type' => 'number',
							],
							'iconLeftMobilePadding'   => [
								'type' => 'number',
							],
							'iconBottomMobilePadding' => [
								'type' => 'number',
							],
							'iconPaddingUnit'         => [
								'type'    => 'string',
								'default' => 'px',
							],
							'iconTabletPaddingUnit'   => [
								'type'    => 'string',
								'default' => 'px',
							],
							'iconMobilePaddingUnit'   => [
								'type'    => 'string',
								'default' => 'px',
							],
							'iconPaddingLink'         => [
								'type'    => 'boolean',
								'default' => false,
							],
						],
						// Margin.
						[
							'iconTopMargin'              => [
								'type' => 'number',
							],
							'iconRightMargin'            => [
								'type' => 'number',
							],
							'iconLeftMargin'             => [
								'type' => 'number',
							],
							'iconBottomMargin'           => [
								'type' => 'number',
							],
							'iconTopTabletMargin'        => [
								'type' => 'number',
							],
							'iconRightTabletMargin'      => [
								'type' => 'number',
							],
							'iconLeftTabletMargin'       => [
								'type' => 'number',
							],
							'iconBottomTabletMargin'     => [
								'type' => 'number',
							],
							'iconTopMobileMargin'        => [
								'type' => 'number',
							],
							'iconRightMobileMargin'      => [
								'type' => 'number',
							],
							'iconLeftMobileMargin'       => [
								'type' => 'number',
							],
							'iconBottomMobileMargin'     => [
								'type' => 'number',
							],
							'iconMarginUnit'             => [
								'type'    => 'string',
								'default' => 'px',
							],
							'iconTabletMarginUnit'       => [
								'type'    => 'string',
								'default' => 'px',
							],
							'iconMobileMarginUnit'       => [
								'type'    => 'string',
								'default' => 'px',
							],
							'iconMarginLink'             => [
								'type'    => 'boolean',
								'default' => false,
							],
							'isPreview'                  => [
								'type'    => 'boolean',
								'default' => false,
							],
							'iconBorderStyle'            => [
								'type'    => 'string',
								'default' => 'default',
							],
							'useSeparateBoxShadows'      => [
								'type'    => 'boolean',
								'default' => true,
							],
							'iconShadowColor'            => [
								'type'    => 'string',
								'default' => '#00000070',
							],
							'iconShadowHOffset'          => [
								'type'    => 'number',
								'default' => 0,
							],
							'iconShadowVOffset'          => [
								'type'    => 'number',
								'default' => 0,
							],
							'iconShadowBlur'             => [
								'type'    => 'number',
								'default' => 0,
							],
							'iconBoxShadowColor'         => [
								'type'    => 'string',
								'default' => '#00000070',
							],
							'iconBoxShadowHOffset'       => [
								'type'    => 'number',
								'default' => 0,
							],
							'iconBoxShadowVOffset'       => [
								'type'    => 'number',
								'default' => 0,
							],
							'iconBoxShadowBlur'          => [
								'type' => 'number',
							],
							'iconBoxShadowSpread'        => [
								'type' => 'number',
							],
							'iconBoxShadowPosition'      => [
								'type'    => 'string',
								'default' => 'outset',
							],
							'iconShadowColorHover'       => [
								'type'    => 'string',
								'default' => '#00000070',
							],
							'iconShadowHOffsetHover'     => [
								'type'    => 'number',
								'default' => 0,
							],
							'iconShadowVOffsetHover'     => [
								'type'    => 'number',
								'default' => 0,
							],
							'iconShadowBlurHover'        => [
								'type'    => 'number',
								'default' => 0,
							],
							'iconBoxShadowColorHover'    => [
								'type' => 'string',
							],
							'iconBoxShadowHOffsetHover'  => [
								'type'    => 'number',
								'default' => 0,
							],
							'iconBoxShadowVOffsetHover'  => [
								'type'    => 'number',
								'default' => 0,
							],
							'iconBoxShadowBlurHover'     => [
								'type' => 'number',
							],
							'iconBoxShadowSpreadHover'   => [
								'type' => 'number',
							],
							'iconBoxShadowPositionHover' => [
								'type'    => 'string',
								'default' => 'outset',
							],
						],
						// Responsive Borders.
						$iconBorderAttributes
					),
					'renderCallback' => [ $this, 'renderVxtUltimateGutenbergBlocksIcon' ],
				]
			);
	  
			
		}

		/**
		 * Check if a URL has a protocol (http/https).
		 *
		 * @since 2.12.5
		 * 
		 * @param string $url The URL to check.
		 * @return bool Whether the URL has a protocol.
		 */
		public static function getProtocol( $url ) {
			$urlParts = wp_parse_url( $url );

			if ( is_array( $urlParts ) ) {
				return isset( $urlParts['scheme'] );
			}
			return false;
		}

		/**
		 * Prepend 'http://' to a URL if it doesn't have a protocol.
		 *
		 * @since 2.12.5
		 * 
		 * @param string $url The URL to prepend 'http://' to.
		 * @return string The modified URL.
		 */
		public static function prependHttp( $url ) {
			return ( ! empty( $url ) && ! self::getProtocol( $url ) ) ? 'http://' . $url : $url;
		}


		/**
		 * Renders the icon block.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 2.12.5
		 * @return string|false
		 */
		public function renderVxtUltimateGutenbergBlocksIcon( $attributes ) {
			
			$blockId               = 'vxt-block-' . $attributes['block_id'];
			$iconBottomMargin       = isset( $attributes['iconBottomMargin'] ) ? $attributes['iconBottomMargin'] : '';
			$iconLeftMargin         = isset( $attributes['iconLeftMargin'] ) ? $attributes['iconLeftMargin'] : '';
			$iconRightMargin        = isset( $attributes['iconRightMargin'] ) ? $attributes['iconRightMargin'] : '';
			$iconTopMargin          = isset( $attributes['iconTopMargin'] ) ? $attributes['iconTopMargin'] : '';
			$iconBottomTabletMargin = isset( $attributes['iconBottomTabletMargin'] ) ? $attributes['iconBottomTabletMargin'] : '';
			$iconLeftTabletMargin   = isset( $attributes['iconLeftTabletMargin'] ) ? $attributes['iconLeftTabletMargin'] : '';
			$iconRightTabletMargin  = isset( $attributes['iconRightTabletMargin'] ) ? $attributes['iconRightTabletMargin'] : '';
			$iconTopTabletMargin    = isset( $attributes['iconTopTabletMargin'] ) ? $attributes['iconTopTabletMargin'] : '';
			$iconBottomMobileMargin = isset( $attributes['iconBottomMobileMargin'] ) ? $attributes['iconBottomMobileMargin'] : '';
			$iconLeftMobileMargin   = isset( $attributes['iconLeftMobileMargin'] ) ? $attributes['iconLeftMobileMargin'] : '';
			$iconRightMobileMargin  = isset( $attributes['iconRightMobileMargin'] ) ? $attributes['iconRightMobileMargin'] : '';
			$iconTopMobileMargin    = isset( $attributes['iconTopMobileMargin'] ) ? $attributes['iconTopMobileMargin'] : '';
			$marginVariables       = [ $iconBottomMargin, $iconLeftMargin, $iconRightMargin, $iconTopMargin, $iconBottomTabletMargin, $iconLeftTabletMargin, $iconRightTabletMargin, $iconTopTabletMargin, $iconBottomMobileMargin, $iconLeftMobileMargin, $iconRightMobileMargin, $iconTopMobileMargin ];

			$desktopClass = '';
			$tabClass     = '';
			$mobClass     = '';

			if ( array_key_exists( 'UAGHideDesktop', $attributes ) || array_key_exists( 'UAGHideTab', $attributes ) || array_key_exists( 'UAGHideMob', $attributes ) ) {

				$desktopClass = ( isset( $attributes['UAGHideDesktop'] ) ) ? 'uag-hide-desktop' : '';

				$tabClass = ( isset( $attributes['UAGHideTab'] ) ) ? 'uag-hide-tab' : '';

				$mobClass = ( isset( $attributes['UAGHideMob'] ) ) ? 'uag-hide-mob' : '';
			}

			$zindexDesktop           = '';
			$zindexTablet            = '';
			$zindexMobile            = '';
			$zindexWrap              = [];
			$zindexExtentionEnabled = ( isset( $attributes['zIndex'] ) || isset( $attributes['zIndexTablet'] ) || isset( $attributes['zIndexMobile'] ) );

			if ( $zindexExtentionEnabled ) {
				$zindexDesktop = ( isset( $attributes['zIndex'] ) ) ? '--z-index-desktop:' . $attributes['zIndex'] . ';' : false;
				$zindexTablet  = ( isset( $attributes['zIndexTablet'] ) ) ? '--z-index-tablet:' . $attributes['zIndexTablet'] . ';' : false;
				$zindexMobile  = ( isset( $attributes['zIndexMobile'] ) ) ? '--z-index-mobile:' . $attributes['zIndexMobile'] . ';' : false;

				if ( $zindexDesktop ) {
					array_push( $zindexWrap, $zindexDesktop );
				}

				if ( $zindexTablet ) {
					array_push( $zindexWrap, $zindexTablet );
				}

				if ( $zindexMobile ) {
					array_push( $zindexWrap, $zindexMobile );
				}
			}

			$hasMargin = false;
			foreach ( $marginVariables as $margin ) {
				if ( is_numeric( $margin ) ) {
					$hasMargin = true;
					break;
				}
			}
			$marginClass = $hasMargin ? 'wp-block-vxt-icon--has-margin' : '';
			$mainClasses = [
				'vxt-icon-wrapper',
				$blockId,
				( is_array( $attributes ) && isset( $attributes['className'] ) ) ? $attributes['className'] : '',
				$marginClass,
				$desktopClass,
				$tabClass,
				$mobClass,
				$zindexExtentionEnabled ? 'uag-blocks-common-selector' : '',
			];
	
			$iconSvg     = isset( $attributes['icon'] ) ? $attributes['icon'] : 'circle-check';
			$link        = isset( $attributes['link'] ) ? $attributes['link'] : '';
			$target      = isset( $attributes['target'] ) ? $attributes['target'] : false;
			$disableLink = isset( $attributes['disableLink'] ) ? $attributes['disableLink'] : false;
			$linkUrl     = $disableLink ? $link : '#';
			$targetVal   = $target ? '_blank' : '_self';

			ob_start();
			$iconHtml = \Vexaltrix\Support\Helper::renderSvgHtml( $iconSvg );
			$iconHtml = ob_get_clean();
	  
			if ( $iconHtml ) {

				$roleAttr        = ( 'image' === $attributes['iconAccessabilityMode'] ) ? ' role="img"' : ( ( 'svg' === $attributes['iconAccessabilityMode'] ) ? ' role="graphics-symbol"' : '' );
				$ariaHiddenAttr = ( 'presentation' === $attributes['iconAccessabilityMode'] ) ? 'true' : 'false';
				$ariaLabelAttr  = ( 'presentation' !== $attributes['iconAccessabilityMode'] ) ? ' aria-label="' . esc_attr( $attributes['iconAccessabilityDesc'] ) . '"' : '';
			
				$iconHtml = preg_replace(
					'/<svg(.*?)>/',
					'<svg$1' . $roleAttr . ' aria-hidden="' . $ariaHiddenAttr . '"' . $ariaLabelAttr . '>',
					$iconHtml
				);
			}
			

			$ariaLabelAttr = ( 'presentation' !== $attributes['iconAccessabilityMode'] ) ? ( empty( $attributes['iconAccessabilityDesc'] ) ? implode( '', str_split( $attributes['icon'] ) ) : $attributes['iconAccessabilityDesc'] ) : '';

			// Check and prepend the protocol if necessary.
			if ( '#' !== $linkUrl ) {
				$linkUrl = self::getProtocol( $linkUrl ) ? $linkUrl : self::prependHttp( $linkUrl );
			}
			
			if ( $iconHtml && $disableLink && $linkUrl ) {
				// Wrap the SVG content with an anchor tag.
				$iconHtml = preg_replace(
					'/<svg(.*?)>(.*?)<\/svg>/s',
					'<a rel="noopener noreferrer" href="' . esc_url( $linkUrl ) . '" target="' . esc_attr( $targetVal ) . '"><svg$1>$2</svg></a>',
					$iconHtml
				);
				
			}

			ob_start();
			?>      
			<div class="<?php echo esc_attr( implode( ' ', $mainClasses ) ); ?>"
			style="<?php echo esc_attr( implode( '', $zindexWrap ) ); ?>" >
				<?php if ( $hasMargin ) : ?>
				<div class='vxt-icon-margin-wrapper'>
				<?php endif; ?>
					<span class="vxt-svg-wrapper" 
					<?php 
					if ( $ariaLabelAttr ) {
						echo ' aria-label="' . esc_attr( $ariaLabelAttr ) . '"';
					} 
					?>
					tabindex="0">		
						<?php echo $iconHtml; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped & sanitize inside render_svg_html(). ?>
					</span>
				<?php if ( $hasMargin ) : ?>
				</div>
				<?php endif; ?>
			</div>
			<?php
			return ob_get_clean();

		}

		/**
		 * Renders Front-end Click Event.
		 *
		 * @param string $id             Block ID.
		 * @since 2.15.0
		 * @return string|false                The Output Buffer.
		 */
		public static function renderIconClick( $id ) {
			ob_start();
			?>
				window.addEventListener( 'DOMContentLoaded', () => {
					const blockScope = document.querySelector( '.vxt-block-<?php echo esc_html( $id ); ?>' );
					if ( ! blockScope ) {
						return;
					}

					const anchorElement = blockScope.querySelector('a');
					if (!anchorElement) {
						return;
					} 

					<?php // Add event listener for Enter and Space key presses. ?> 
					blockScope.addEventListener('keydown', (event) => {
						if ( 13 === event.keyCode || 32 === event.keyCode ) {
							event.preventDefault();
							<?php // Trigger the click event on the blockScope. ?> 
							anchorElement.click();	
						}
					} );
				} );
			<?php
			return ob_get_clean();
		}

	}

		
	/**
	 *  Prepare if class 'Vexaltrix\\BlocksConfig\\Icon\\Icon' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
