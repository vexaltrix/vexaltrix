<?php
/**
 * Vexaltrix - Taxonomy-List
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Presentation\BlocksConfig\TaxonomyList;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Presentation\BlocksConfig\\TaxonomyList\\TaxonomyList' ) ) {

	/**
	 * Class \Vexaltrix\Presentation\BlocksConfig\TaxonomyList\TaxonomyList.
	 *
	 * @since 1.18.1
	 */
	class TaxonomyList {

		/**
		 * Member Variable
		 *
		 * @since 1.18.1
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 *
		 * @since 1.18.1
		 */
		public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 *
		 * @since 1.18.1
		 */
		public function __construct() {

			// Activation hook.
			add_action( 'init', [ $this, 'registerBlocks' ] );
		}

		/**
		 * Registers the `vexaltrix/taxonomy-list` block on server.
		 *
		 * @since 1.18.1
		 */
		public function registerBlocks() {

			// Check if the register function exists.
			if ( ! function_exists( 'register_block_type' ) ) {
				return;
			}
			$borderAttribute = [];

			if ( method_exists( 'Vexaltrix\Presentation\Blocks\\BlockHelper', 'uagGeneratePhpBorderAttribute' ) ) {

				$borderAttribute = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGeneratePhpBorderAttribute( 'overall' );

			}

			register_block_type(
				'vexaltrix/taxonomy-list',
				[
					'attributes'      => array_merge(
						$borderAttribute,
						[
							'block_id'                   => [
								'type' => 'string',
							],
							'postType'                   => [
								'type'    => 'string',
								'default' => 'post',
							],
							'taxonomyType'               => [
								'type'    => 'string',
								'default' => 'category',
							],
							'categories'                 => [
								'type' => 'string',
							],
							'order'                      => [
								'type'    => 'string',
								'default' => 'desc',
							],
							'orderBy'                    => [
								'type'    => 'string',
								'default' => 'date',
							],
							'postsToShow'                => [
								'type'    => 'number',
								'default' => '8',
							],
							'layout'                     => [
								'type'    => 'string',
								'default' => 'grid',
							],
							'columns'                    => [
								'type'    => 'number',
								'default' => 3,
							],
							'tcolumns'                   => [
								'type'    => 'number',
								'default' => 2,
							],
							'mcolumns'                   => [
								'type'    => 'number',
								'default' => 1,
							],
							'noTaxDisplaytext'           => [
								'type'    => 'string',
								'default' => __( 'Taxonomy Not Available.', 'vexaltrix' ),
							],
							'boxShadowColor'             => [
								'type'    => 'string',
								'default' => '#00000070',
							],
							'boxShadowHOffset'           => [
								'type'    => 'number',
								'default' => 0,
							],
							'boxShadowVOffset'           => [
								'type'    => 'number',
								'default' => 0,
							],
							'boxShadowBlur'              => [
								'type' => 'number',
							],
							'boxShadowSpread'            => [
								'type' => 'number',
							],
							'boxShadowPosition'          => [
								'type'    => 'string',
								'default' => 'outset',
							],
							'showCount'                  => [
								'type'    => 'boolean',
								'default' => true,
							],
							'showEmptyTaxonomy'          => [
								'type'    => 'boolean',
								'default' => false,
							],
							'showhierarchy'              => [
								'type'    => 'boolean',
								'default' => false,
							],
							'titleTag'                   => [
								'type'    => 'string',
								'default' => '',
							],
							// Color Attributes.
							'bgColor'                    => [
								'type'    => 'string',
								'default' => '#f5f5f5',
							],
							'titleColor'                 => [
								'type'    => 'string',
								'default' => '#3b3b3b',
							],
							'countColor'                 => [
								'type'    => 'string',
								'default' => '#777777',
							],
							'listTextColor'              => [
								'type'    => 'string',
								'default' => '#3b3b3b',
							],
							'hoverlistTextColor'         => [
								'type'    => 'string',
								'default' => '#3b3b3b',
							],
							'listStyleColor'             => [
								'type'    => 'string',
								'default' => '#3b3b3b',
							],
							'hoverlistStyleColor'        => [
								'type'    => 'string',
								'default' => '#3b3b3b',
							],

							// Spacing Attributes.
							'rowGap'                     => [
								'type'    => 'number',
								'default' => 20,
							],
							'columnGap'                  => [
								'type'    => 'number',
								'default' => 20,
							],
							'contentPadding'             => [
								'type'    => 'number',
								'default' => 20,
							],
							'contentPaddingTablet'       => [
								'type'    => 'number',
								'default' => 15,
							],
							'contentPaddingMobile'       => [
								'type'    => 'number',
								'default' => 15,
							],
							'titleBottomSpace'           => [
								'type'    => 'number',
								'default' => 5,
							],
							'listBottomMargin'           => [
								'type'    => 'number',
								'default' => 10,
							],

							// ALignment Attributes.
							'alignment'                  => [
								'type'    => 'string',
								'default' => 'center',
							],

							// List Attributes.
							'listStyle'                  => [
								'type'    => 'string',
								'default' => 'disc',
							],
							'listDisplayStyle'           => [
								'type'    => 'string',
								'default' => 'list',
							],

							// Seperator Attributes.
							'seperatorStyle'             => [
								'type'    => 'string',
								'default' => 'none',
							],
							'seperatorWidth'             => [
								'type'    => 'number',
								'default' => 100,
							],
							'seperatorThickness'         => [
								'type'    => 'number',
								'default' => 1,
							],
							'seperatorColor'             => [
								'type'    => 'string',
								'default' => '#b2b4b5',
							],
							'seperatorHoverColor'        => [
								'type'    => 'string',
								'default' => '#b2b4b5',
							],

							// Typograpghy attributes.
							'titleFontSize'              => [
								'type' => 'number',
							],
							'titleFontSizeType'          => [
								'type'    => 'string',
								'default' => 'px',
							],
							'titleFontSizeMobile'        => [
								'type' => 'number',
							],
							'titleFontSizeTablet'        => [
								'type' => 'number',
							],
							'titleFontFamily'            => [
								'type'    => 'string',
								'default' => 'Default',
							],
							'titleFontWeight'            => [
								'type' => 'string',
							],
							'titleFontStyle'             => [
								'type' => 'string',
							],
							'titleLineHeightType'        => [
								'type'    => 'string',
								'default' => 'em',
							],
							'titleLineHeight'            => [
								'type' => 'number',
							],
							'titleLineHeightTablet'      => [
								'type' => 'number',
							],
							'titleLineHeightMobile'      => [
								'type' => 'number',
							],
							'titleLoadGoogleFonts'       => [
								'type'    => 'boolean',
								'default' => false,
							],
							'countFontSize'              => [
								'type' => 'number',
							],
							'countFontSizeType'          => [
								'type'    => 'string',
								'default' => 'px',
							],
							'countFontSizeMobile'        => [
								'type' => 'number',
							],
							'countFontSizeTablet'        => [
								'type' => 'number',
							],
							'countFontFamily'            => [
								'type'    => 'string',
								'default' => 'Default',
							],
							'countFontWeight'            => [
								'type' => 'string',
							],
							'countFontStyle'             => [
								'type' => 'string',
							],
							'countLineHeightType'        => [
								'type'    => 'string',
								'default' => 'em',
							],
							'countLineHeight'            => [
								'type' => 'number',
							],
							'countLineHeightTablet'      => [
								'type' => 'number',
							],
							'countLineHeightMobile'      => [
								'type' => 'number',
							],
							'countLoadGoogleFonts'       => [
								'type'    => 'boolean',
								'default' => false,
							],

							'listFontSize'               => [
								'type' => 'number',
							],
							'listFontSizeType'           => [
								'type'    => 'string',
								'default' => 'px',
							],
							'listFontSizeMobile'         => [
								'type' => 'number',
							],
							'listFontSizeTablet'         => [
								'type' => 'number',
							],
							'listFontFamily'             => [
								'type'    => 'string',
								'default' => 'Default',
							],
							'listFontWeight'             => [
								'type' => 'string',
							],
							'listFontStyle'              => [
								'type' => 'string',
							],
							'listLineHeightType'         => [
								'type'    => 'string',
								'default' => 'em',
							],
							'listLineHeight'             => [
								'type' => 'number',
							],
							'listLineHeightTablet'       => [
								'type' => 'number',
							],
							'listLineHeightMobile'       => [
								'type' => 'number',
							],
							'listLoadGoogleFonts'        => [
								'type'    => 'boolean',
								'default' => false,
							],
							'contentLeftPadding'         => [
								'type' => 'number',
							],
							'contentRightPadding'        => [
								'type' => 'number',
							],
							'contentTopPadding'          => [
								'type' => 'number',
							],
							'contentBottomPadding'       => [
								'type' => 'number',
							],
							'contentLeftPaddingTablet'   => [
								'type' => 'number',
							],
							'contentRightPaddingTablet'  => [
								'type' => 'number',
							],
							'contentTopPaddingTablet'    => [
								'type' => 'number',
							],
							'contentBottomPaddingTablet' => [
								'type' => 'number',
							],
							'contentLeftPaddingMobile'   => [
								'type' => 'number',
							],
							'contentRightPaddingMobile'  => [
								'type' => 'number',
							],
							'contentTopPaddingMobile'    => [
								'type' => 'number',
							],
							'contentBottomPaddingMobile' => [
								'type' => 'number',
							],
							'contentPaddingUnit'         => [
								'type'    => 'string',
								'default' => 'px',
							],
							'mobileContentPaddingUnit'   => [
								'type'    => 'string',
								'default' => 'px',
							],
							'tabletContentPaddingUnit'   => [
								'type'    => 'string',
								'default' => 'px',
							],
							'contentPaddingLink'         => [
								'type'    => 'boolean',
								'default' => false,
							],
							'titleTransform'             => [
								'type' => 'string',
							],
							'countTransform'             => [
								'type' => 'string',
							],
							'listTransform'              => [
								'type' => 'string',
							],
							'titleDecoration'            => [
								'type' => 'string',
							],
							'countDecoration'            => [
								'type' => 'string',
							],
							'listDecoration'             => [
								'type' => 'string',
							],
							'isPreview'                  => [
								'type'    => 'boolean',
								'default' => false,
							],
							// letter spacing.
							'titleLetterSpacing'         => [
								'type'    => 'number',
								'default' => 0,
							],
							'titleLetterSpacingTablet'   => [
								'type' => 'number',
							],
							'titleLetterSpacingMobile'   => [
								'type' => 'number',
							],
							'titleLetterSpacingType'     => [
								'type'    => 'string',
								'default' => 'px',
							],
							'countLetterSpacing'         => [
								'type' => 'number',
							],
							'countLetterSpacingTablet'   => [
								'type' => 'number',
							],
							'countLetterSpacingMobile'   => [
								'type' => 'number',
							],
							'countLetterSpacingType'     => [
								'type'    => 'string',
								'default' => 'px',
							],
							'listLetterSpacing'          => [
								'type' => 'number',
							],
							'listLetterSpacingTablet'    => [
								'type' => 'number',
							],
							'listLetterSpacingMobile'    => [
								'type' => 'number',
							],
							'listLetterSpacingType'      => [
								'type'    => 'string',
								'default' => 'px',
							],
							'borderColor'                => [
								'type'    => 'string',
								'default' => '#E0E0E0',
							],
							'borderThickness'            => [
								'type'    => 'number',
								'default' => 1,
							],
							'borderRadius'               => [
								'type'    => 'number',
								'default' => 3,
							],
							'borderStyle'                => [
								'type'    => 'string',
								'default' => 'solid',
							],
							'borderHoverColor'           => [
								'type'    => 'string',
								'default' => '#E0E0E0',
							],
						]
					),
					'renderCallback' => [ $this, 'renderHtml' ],
				]
			);
		}

		/**
		 * Render Grid HTML.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 1.18.1
		 */
		public function gridHtml( $attributes ) {
			$blockId         = $attributes['block_id'];
			$postType         = $attributes['postType'];
			$taxonomyType     = $attributes['taxonomyType'];
			$layout           = $attributes['layout'];
			$seperatorStyle   = $attributes['seperatorStyle'];
			$noTaxDisplaytext = $attributes['noTaxDisplaytext'];
			$showCount        = $attributes['showCount'];
			$titleTag         = $attributes['titleTag'];

			if ( 'grid' === $layout ) {

				$arrayOfAllowedHTML = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div' ];
				$titleTag             = \Vexaltrix\Core\Support\Helper::titleTagAllowedHtml( $titleTag, $arrayOfAllowedHTML, 'h4' );

				$pt = get_post_type_object( $postType );
				
				if ( $pt ) {
					$singularName = $pt->labels->singular_name;
					$pluralName   = $pt->labels->name;
				} else {
					// Fallback if $pt or $pt->labels is null.
					$singularName = __( 'Item', 'vexaltrix' );
					$pluralName   = __( 'Items', 'vexaltrix' );
				}

				$args                = [
					'hide_empty' => ! $attributes['showEmptyTaxonomy'],
					'parent'     => 0,
				];
				$newCategoriesList = get_terms( $attributes['taxonomyType'], $args );

				if ( is_array( $newCategoriesList ) ) {
					foreach ( $newCategoriesList as $value ) {
						$link = get_term_link( $value->slug, $attributes['taxonomyType'] );
						if ( ! is_wp_error( $link ) ) {
							?>

						<div class="vxt-taxomony-box">
							<a class="vxt-tax-link" href= "<?php echo esc_url( $link ); ?>">
								<<?php echo esc_html( $titleTag ); ?> class="vxt-tax-title"><?php echo esc_html( $value->name ); ?>
								</<?php echo esc_html( $titleTag ); ?>>
								<?php if ( $showCount ) { ?>
										<?php echo esc_attr( $value->count ); ?>
										<?php $countName = ( 1 != $value->count ) ? esc_attr( $pluralName ) : esc_attr( $singularName ); ?>
										<?php echo esc_attr( apply_filters( 'vxt_ultimate_gutenberg_blocks_taxonomy_count_text', $countName, $value->count ) ); ?>
								<?php } ?>
							</a>
						</div>
							<?php
						}
					}
				}
			}
		}
		/**
		 * Return link for individual category.
		 *
		 * @param string $slug of category.
		 * @param string $taxonomyType attributes.
		 *
		 * @since 2.6.0
		 * @return string link using slug.
		 */
		public function getLinkOfIndividualCategories( $slug, $taxonomyType ) {
			if ( ! is_string( $slug ) ) {
				return '#';
			}
			$link = get_term_link( $slug, $taxonomyType );
			if ( is_wp_error( $link ) ) {
				$link = '#';
			}
			return $link;
		}

		/**
		 * Get terms hierarchical.
		 *
		 * @param string  $taxonomyType of taxonomy type.
		 * @param integer $parentId of parent id.
		 * @param bool    $showEmptyTaxonomy of show empty taxonomy.
		 * @since 2.10.4
		 * @return array of terms.
		 */
		public function getTermsHierarchical( $taxonomyType, $parentId, $showEmptyTaxonomy ) {
			$args = [
				'taxonomy'   => $taxonomyType,
				'parent'     => $parentId,
				'hide_empty' => ! $showEmptyTaxonomy,
			];

			$terms = get_terms( $args );

			if ( is_wp_error( $terms ) || empty( $terms ) || ! is_array( $terms ) ) {
				return [];
			}

			foreach ( $terms as $term ) {
				$term->children = $this->getTermsHierarchical( $taxonomyType, $term->term_id, $showEmptyTaxonomy );
			}

			return $terms;
		}

		/**
		 * Display terms recursive.
		 *
		 * @param object $term of terms.
		 * @param string $taxonomyType of taxonomy type.
		 * @param bool   $showCount of show count.
		 * @param string $seperatorStyle of separator style.
		 * @param string $titleTag of title tag.
		 * @param bool   $showHierarchy of show hierarchy.
		 * @since 2.10.4
		 * @return void
		 */
		public function displayTermsRecursive( $term, $taxonomyType, $showCount, $seperatorStyle, $titleTag, $showHierarchy ) {
			if ( $term instanceof WP_Term ) {
				$childLink = $this->getLinkOfIndividualCategories( $term->slug, $taxonomyType );
				echo sprintf(
					'<li class="vxt-tax-list"><%s class="vxt-tax-link-wrap"><a class="vxt-tax-link" href="%s">%s</a> %s</%s><div class="vxt-tax-separator"></div></li>',
					esc_html( $titleTag ),
					esc_url( $childLink ),
					esc_html( $term->name ),
					( boolval( $showCount ) ? ' (' . esc_attr( $term->count ) . ') ' : '' ),
					esc_html( $titleTag )
				);

				if ( $showHierarchy && ! empty( $term->children ) && is_array( $term->children ) ) {
					foreach ( $term->children as $child ) {
						echo sprintf( '<ul class="vxt-taxonomy-list-children">' );
						$this->displayTermsRecursive( $child, $taxonomyType, $showCount, $seperatorStyle, $titleTag, $showHierarchy );
						echo sprintf( '</ul>' );
					}
				}
			}
		}

		/**
		 * Render List HTML.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 1.18.1
		 */
		public function listHtml( $attributes ) {
			$blockId         = $attributes['block_id'];
			$postType         = $attributes['postType'];
			$taxonomyType     = $attributes['taxonomyType'];
			$layout           = $attributes['layout'];
			$seperatorStyle   = $attributes['seperatorStyle'];
			$noTaxDisplaytext = $attributes['noTaxDisplaytext'];
			$showCount        = $attributes['showCount'];
			$titleTag         = $attributes['titleTag'];

			if ( 'list' === $layout ) {

				$arrayOfAllowedHTML = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div' ];
				$titleTag             = \Vexaltrix\Core\Support\Helper::titleTagAllowedHtml( $titleTag, $arrayOfAllowedHTML, 'div' );

				$pt            = get_post_type_object( $postType );
				$singularName = $pt->labels->singular_name;

				$args = [
					'hide_empty' => ! $attributes['showEmptyTaxonomy'],
					'parent'     => 0,
				];

				$taxonomyType       = $attributes['taxonomyType'];
				$showEmptyTaxonomy = $attributes['showEmptyTaxonomy'];
				$newCategoriesList = $this->getTermsHierarchical( $taxonomyType, 0, $showEmptyTaxonomy );
				?>
				<?php if ( 'dropdown' !== $attributes['listDisplayStyle'] && ! empty( $newCategoriesList ) && is_array( $newCategoriesList ) ) { ?>
					<ul class="vxt-list-wrap">
						<?php
						foreach ( $newCategoriesList as $term ) {
							?>
							<?php
							if ( $term instanceof WP_Term ) {
								$this->displayTermsRecursive( $term, $taxonomyType, $showCount, $seperatorStyle, $titleTag, $attributes['showhierarchy'] );
							}
							?>
						<?php } ?>
						</ul>
				<?php } else { ?>
					<select class="vxt-list-dropdown-wrap" onchange="redirectToTaxonomyLink(this)">
						<option selected value=""> -- <?php esc_html_e( 'Select', 'vexaltrix' ); ?> -- </option>
						<?php
						if ( is_array( $newCategoriesList ) ) {
							foreach ( $newCategoriesList as $key => $value ) {
								$link = $this->getLinkOfIndividualCategories( $value->slug, $attributes['taxonomyType'] );
								?>
							<option value="<?php echo esc_url( $link ); ?>" >
								<?php echo esc_attr( $value->name ); ?>
								<?php if ( $showCount ) { ?>
									<?php echo ' (' . esc_attr( $value->count ) . ')'; ?>
								<?php } ?>
							</option>
								<?php
							}
						}
						?>
					</select>
					<script type="text/javascript">
						function redirectToTaxonomyLink( selectedOption ) {
							var selectedValue = selectedOption.value;
							if ( selectedValue ) {
								location.href = selectedValue;
							}
						}
					</script>
				<?php } ?>
				<?php
			}
		}

		/**
		 * Render Taxonomy List HTML.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 1.18.1
		 */
		public function renderHtml( $attributes ) {

			$blockId         = $attributes['block_id'];
			$postType         = $attributes['postType'];
			$taxonomyType     = $attributes['taxonomyType'];
			$layout           = $attributes['layout'];
			$seperatorStyle   = $attributes['seperatorStyle'];
			$noTaxDisplaytext = $attributes['noTaxDisplaytext'];
			$showCount        = $attributes['showCount'];

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

			$mainClasses = [
				'wp-block-vxt-taxonomy-list',
				'vxt-taxonomy__outer-wrap',
				'vxt-layout-' . $layout,
				'vxt-block-' . $blockId,
				$desktopClass,
				$tabClass,
				$mobClass,
				$zindexExtentionEnabled ? 'uag-blocks-common-selector' : '',
			];

			$args = [
				'hide_empty' => ! $attributes['showEmptyTaxonomy'],
			];

			if ( $taxonomyType ) {
				$newCategoriesList = get_terms( $taxonomyType, $args );
			}

			ob_start();

			?>
				<div class = "<?php echo esc_attr( implode( ' ', $mainClasses ) ); ?>" style="<?php echo esc_attr( implode( '', $zindexWrap ) ); ?>">
					<?php if ( ! empty( $newCategoriesList ) ) { ?>
							<?php $this->gridHtml( $attributes ); ?>
							<?php $this->listHtml( $attributes ); ?>
					<?php } else { ?>
							<div class="vxt-tax-not-available"><?php echo esc_html( $noTaxDisplaytext ); ?></div>
					<?php } ?>
				</div>

			<?php

			return ob_get_clean();
		}
	}

	/**
	 *  Prepare if class 'Vexaltrix\Presentation\BlocksConfig\\TaxonomyList\\TaxonomyList' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
