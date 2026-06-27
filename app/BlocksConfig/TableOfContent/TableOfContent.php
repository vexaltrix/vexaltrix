<?php
/**
 * Vexaltrix Table Of Contents block.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\BlocksConfig\TableOfContent;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\\BlocksConfig\\TableOfContent\\TableOfContent' ) ) {


	/**
	 * Class \Vexaltrix\BlocksConfig\TableOfContent\TableOfContent.
	 */
	class TableOfContent {


		/**
		 * Member Variable
		 *
		 * @since 1.23.0
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 *
		 * @since 1.23.0
		 */
		public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'init', [ $this, 'registerTableOfContents' ] );
			add_action( 'save_post', [ $this, 'deleteTocMeta' ], 10, 3 );
			add_filter( 'render_block_data', [ $this, 'updateTocTitle' ] );
		}

		/**
		 * Update Toc tile if old title is set.
		 *
		 * @access public
		 *
		 * @since 1.23.0
		 * @param array $parsedBlock Parsed Block.
		 */
		public function updateTocTitle( $parsedBlock ) {

			if ( 'vexaltrix/table-of-contents' === $parsedBlock['blockName'] && ! isset( $parsedBlock['attrs']['headingTitle'] ) ) {

				$content = $parsedBlock['innerHTML'];
				$matches = [];

				preg_match( '/<div class=\"vxt-toc__title\">([^`]*?)<\/div>/', $content, $matches );

				if ( ! empty( $matches[1] ) ) {
					$parsedBlock['attrs']['headingTitle'] = $matches[1];
				}
			}

			return $parsedBlock;
		}

		/**
		 * Delete toc meta.
		 *
		 * @access public
		 *
		 * @since 1.23.0
		 * @param int     $postId Post ID.
		 * @param object  $post Post object.
		 * @param boolean $update Whether this is an existing post being updated.
		 */
		public function deleteTocMeta( $postId, $post, $update ) {
			delete_post_meta( $postId, '_vxt_ultimate_gutenberg_blocks_toc_options' );
		}

		/**
		 * Extracts heading content, id, and level from the given post content.
		 *
		 * @since 1.23.0
		 * @access public
		 *
		 * @param string $content       The post content to extract headings from.
		 *
		 * @return array The list of headings.
		 */
		public function tableOfContentsGetHeadingsFromContent( $content ) {

			/* phpcs:disable WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase */
			// Disabled because of PHP DOMDocument and DOMXPath APIs using camelCase.

			// Create a document to load the post content into.
			$doc = new DOMDocument( '1.0', 'UTF-8' );

			// Enable user error handling for the HTML parsing. HTML5 elements aren't
			// supported (as of PHP 7.4) and There's no way to guarantee that the markup
			// is valid anyway, so we're just going to ignore all errors in parsing.
			// Nested heading elements will still be parsed.
			// The lack of HTML5 support is a libxml2 issue:
			// https://bugzilla.gnome.org/show_bug.cgi?id=761534.
			libxml_use_internal_errors( true );

			// Parse the post content into an HTML document.
			$doc->loadHTML(
				// loadHTML expects ISO-8859-1, so we need to convert the post content to
				// that format. We use htmlentities to encode Unicode characters not
				// supported by ISO-8859-1 as HTML entities. However, this function also
				// converts all special characters like < or > to HTML entities, so we use
				// htmlspecialchars_decode to decode them.
				'<html><head><meta charset="UTF-8"></head><body>' . $content . '</body></html>'
			);

			// We're done parsing, so we can disable user error handling. This also
			// clears any existing errors, which helps avoid a memory leak.
			libxml_use_internal_errors( false );

			// IE11 treats template elements like divs, so to avoid extracting heading
			// elements from them, we first have to remove them.
			// We can't use foreach directly on the $templates DOMNodeList because it's a
			// dynamic list, and removing nodes confuses the foreach iterator. So
			// instead, we convert the iterator to an array and then iterate over that.

			if ( ! isset( $doc->documentElement ) || ! is_object( $doc->documentElement ) ) {

				return [];
			}

			$templates = iterator_to_array(
				$doc->documentElement->getElementsByTagName( 'template' )
			);

			foreach ( $templates as $template ) {
				$template->parentNode->removeChild( $template );
			}

			$xpath = new DOMXPath( $doc );

			$tags = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div' ];
			// Delete $tags[$s].vxt-toc-hide-heading from doc.
			foreach ( $tags as $tag ) {
				$query = sprintf( '//%s[contains(attribute::class, "vxt-toc-hide-heading")]', $tag );

				foreach ( $xpath->query( $query ) as $e ) {
					$e->parentNode->removeChild( $e );
				}
			}

			// Get all non-empty heading elements in the post content.
			$headings = iterator_to_array(
				$xpath->query(
					'//*[self::h1 or self::h2 or self::h3 or self::h4 or self::h5 or self::h6]'
				)
			);

			return array_map(
				function ( $heading ) {

					$excludeHeading = null;

					if ( isset( $heading->attributes ) ) {
						$className = $heading->attributes->getNamedItem( 'class' );
						if ( null !== $className && '' !== $className->value ) {
							$excludeHeading = $className->value;
						}
					}

					$mappingHeader = 0;

					if ( 'vxt-toc-hide-heading' !== $excludeHeading ) {

						return [
							// A little hacky, but since we know at this point that the tag will
							// be an h1-h6, we can just grab the 2nd character of the tag name
							// and convert it to an integer. Should be faster than conditionals.
							'level'   => (int) $heading->nodeName[1],
							'id'      => $this->clean( $heading->textContent ),
							'content' => wp_strip_all_tags( $heading->textContent ),
							'depth'   => intval( substr( $heading->tagName, 1 ) ),
						];
					}
				},
				$headings
			);
			/* phpcs:enable */
		}

		/**
		 * Clean up heading content.
		 *
		 * @since 1.23.0
		 * @access public
		 *
		 * @param string $string The post content to extract headings from.
		 *
		 * @return string $string.
		 */
		public function clean( $string ) {

			$string = preg_replace( '/[\x00-\x1F\x7F]*/u', '', $string );
			$string = str_replace( [ '&amp;', '&nbsp;' ], ' ', $string );
			// Remove all except alphbets, space, `-`,`_` and latin characters.
			$string = preg_replace( '/[^a-zA-Z0-9\p{L} _-]/u', '', $string );
			// Convert space characters to an `_` (underscore).
			$string = preg_replace( '/\s+/', '_', $string );
			// Replace multiple `_` (underscore) with a single `-` (hyphen).
			$string = preg_replace( '/_+/', '-', $string );
			// Replace multiple `-` (hyphen) with a single `-` (hyphen).
			$string = preg_replace( '/-+/', '-', $string );
			// Remove trailing `-` and `_`.
			$string = trim( $string, '-_' );

			if ( empty( $string ) ) {
				$string = 'toc_' . uniqid();
			}

			return mb_strtolower( $string ); // Replaces multiple hyphens with single one.
		}

		/**
		 * Converts a flat list of heading parameters to a hierarchical nested list
		 * based on each header's immediate parent's level.
		 *
		 * @since 1.23.0
		 * @access public
		 *
		 * @param array $headingList Flat list of heading parameters to nest.
		 * @param int   $index        The current list index.
		 *
		 * @return array A hierarchical nested list of heading parameters.
		 */
		public function tableOfContentsLinearToNestedHeadingList(
			$headingList,
			$index = 0
		) {
			$nestedHeadingList = [];

			foreach ( $headingList as $key => $heading ) {

				if ( ! is_null( $headingList[ $key ] ) ) {

					$nestedHeadingList[] = [
						'heading'  => $heading,
						'index'    => $index + $key,
						'children' => null,
					];

				}
			}

			return $nestedHeadingList;
		}

		/**
		 * Renders the heading list of the Vexaltrix Table Of Contents block.
		 *
		 * @since 1.23.0
		 * @access public
		 *
		 * @param array  $nestedHeadingList Nested list of heading data.
		 * @param string $pageUrl URL of the page the block belongs to.
		 * @param array  $attributes array of attributes.
		 *
		 * @return string The heading list rendered as HTML.
		 */
		public function tableOfContentsRenderList(
			$nestedHeadingList,
			$pageUrl,
			$attributes
		) {
			$enableCollapsibleList = isset( $attributes['enableCollapsableList'] ) ? (bool) $attributes['enableCollapsableList'] : false;
			$nestingLevel           = isset( $attributes['collapsibleListDepth'] ) ? intval( $attributes['collapsibleListDepth'] ) : 5;
		
			$toc           = '<ol class="vxt-toc__list">';
			$lastLevel    = '';
			$parentLevel  = '';
			$firstLevel   = '';
			$currentDepth = 0;
			$depthArray   = [
				1 => 0,
				2 => 0,
				3 => 0,
				4 => 0,
				5 => 0,
				6 => 0,
			];
		
			if ( $enableCollapsibleList ) {
				$hasChildren  = array_fill( 0, count( $nestedHeadingList ), false );
				$depthMapping = array_fill( 0, count( $nestedHeadingList ), 0 );
		
				// Calculate depth and children mapping.
				$stack                = [];
				$nestedHeadingCount = count( $nestedHeadingList );

				foreach ( $nestedHeadingList as $anchor => $heading ) {
					$level = $heading['heading']['level'];
				
					// Calculate depth.
					$stackCount = count( $stack );
					while ( ! empty( $stack ) && $stack[ $stackCount - 1 ]['level'] >= $level ) {
						array_pop( $stack );
						$stackCount = count( $stack );  // Update the stack count after popping an element.
					}
					$depthMapping[ $anchor ] = $stackCount + 1;
					$stack[]                  = [
						'level' => $level,
						'index' => $anchor,
					];
				
					// Check for children.
					for ( $i = $anchor + 1; $i < $nestedHeadingCount; $i++ ) {
						if ( $nestedHeadingList[ $i ]['heading']['level'] > $level ) {
							$hasChildren[ $anchor ] = true;
							break;
						} elseif ( $nestedHeadingList[ $i ]['heading']['level'] <= $level ) {
							break;
						}
					}
				}               
			}
		
			foreach ( $nestedHeadingList as $anchor => $heading ) {
				$level = $heading['heading']['level'];
				$title = $heading['heading']['content'];
				$id    = $heading['heading']['id'];

				if ( 0 === $anchor ) {
					$firstLevel = $level;
				}

				if ( $level < $firstLevel ) {
					continue;
				}

				if ( empty( $parentLevel ) || $level < $parentLevel ) {
					$parentLevel = $level;
				}

				if ( ! empty( $lastLevel ) ) {
					if ( $level > $lastLevel ) {
						$toc .= '<ul class="vxt-toc__list">';
						$currentDepth ++;
						$depthArray[ $level ] = $currentDepth;
					} elseif ( $level === $lastLevel && $level !== $parentLevel ) {
						$toc                  .= '<li class="vxt-toc__list">';
						$depthArray[ $level ] = $currentDepth;
					} elseif ( $level < $lastLevel ) {
						$closing = absint( $currentDepth - $depthArray[ $level ] );

						if ( $level > $parentLevel ) {
							$toc          .= str_repeat( '</li></ul>', $closing );
							$currentDepth = absint( $currentDepth - $closing );
						} elseif ( $level === $parentLevel ) {
							$toc .= str_repeat( '</li></ul>', $closing );
							$toc .= '</li>';
						}
					}
				}

				if ( $enableCollapsibleList ) {
					$toc .= sprintf(
						'<li class="vxt-toc__list %s">%s<a href="#%s" class="vxt-toc-link__trigger">%s</a>',
						( $hasChildren[ $anchor ] && $depthMapping[ $anchor ] <= $nestingLevel ) ? 'vxt-toc__list--expandable' : '',
						( $hasChildren[ $anchor ] && $depthMapping[ $anchor ] <= $nestingLevel ) ? '<span class="list-open" role="button" tabindex="0" aria-expanded="true"></span>' : '',
						esc_attr( $id ),
						esc_html( $title )
					);
				} else {
					$toc .= sprintf( '<li class="vxt-toc__list"><a href="#%s" class="vxt-toc-link__trigger">%s</a>', esc_attr( $id ), esc_html( $title ) );
				}
				
		
				$lastLevel = $level;
			}

			$toc .= str_repeat( '</ul>', $currentDepth );
			$toc .= '</ol>';

			return $toc;
		}

		/**
		 * Filters the Headings according to Mapping Headers Array.
		 *
		 * @since 1.24.0
		 * @access public
		 *
		 * @param  array $headings Headings.
		 * @param  array $mappingHeadersArray    Mapping Headers.
		 *
		 * @return array FIltered Headings Array..
		 */
		public function filterHeadingsByMappingHeaders( $headings, $mappingHeadersArray ) {

			$filteredHeadings = [];

			foreach ( $headings as $heading ) {

				$mappingHeader = 0;

				foreach ( $mappingHeadersArray as $key => $value ) {

					if ( $mappingHeadersArray[ $key ] ) {

						$mappingHeader = ( $key + 1 );
					}

					if ( isset( $heading ) && $mappingHeader === $heading['level'] ) {

						$filteredHeadings[] = $heading;
						break;
					}
				}
			}

			return $filteredHeadings;

		}
		/**
		 * Get the Reusable Headings Array.
		 *
		 * @since 2.0.14
		 * @access public
		 *
		 * @param  array $blocksArray Block Array.
		 *
		 * @return array $finalReusableArray Heading Array.
		 */
		public function tocRecursiveReusableHeading( $blocksArray ) {
			$finalReusableArray = [];
			foreach ( $blocksArray as $key => $block ) {

				if ( 'core/block' === $blocksArray[ $key ]['blockName'] ) {
					if ( $blocksArray[ $key ]['attrs'] ) {
						$reusableBlock   = get_post( $blocksArray[ $key ]['attrs']['ref'] );
						$reusableHeading = $this->tableOfContentsGetHeadingsFromContent( $reusableBlock->post_content );
						if ( isset( $reusableHeading[0] ) ) {
							$finalReusableArray = array_merge( $finalReusableArray, $reusableHeading );
						}
					}
				} else {
					if ( 'core/block' !== $blocksArray[ $key ]['blockName'] ) {
						$innerBlockReusableArray = $this->tocRecursiveReusableHeading( $blocksArray[ $key ]['innerBlocks'] );
						$finalReusableArray       = array_merge( $finalReusableArray, $innerBlockReusableArray );
					}
				}
			}

			return $finalReusableArray;
		}

		/**
		 * Renders the Vexaltrix Table Of Contents block.
		 *
		 * @since 1.23.0
		 * @access public
		 *
		 * @param  array    $attributes Block attributes.
		 * @param  string   $content    Block default content.
		 * @param  WP_Block $block      Block instance.
		 *
		 * @return string Rendered block HTML.
		 */
		public function renderTableOfContents( $attributes, $content, $block ) {

			global $post;
			$result = [];
			if ( ! isset( $post->ID ) ) {
				return '';
			}

			$vxtUltimateGutenbergBlocksTocOptions         = get_post_meta( $post->ID, '_vxt_ultimate_gutenberg_blocks_toc_options', true );
			$vxtUltimateGutenbergBlocksTocVersion         = ! empty( $vxtUltimateGutenbergBlocksTocOptions['_vxt_ultimate_gutenberg_blocks_toc_version'] ) ? $vxtUltimateGutenbergBlocksTocOptions['_vxt_ultimate_gutenberg_blocks_toc_version'] : '';
			$vxtUltimateGutenbergBlocksTocHeadingContent = ! empty( $vxtUltimateGutenbergBlocksTocOptions['_vxt_ultimate_gutenberg_blocks_toc_headings'] ) ? $vxtUltimateGutenbergBlocksTocOptions['_vxt_ultimate_gutenberg_blocks_toc_headings'] : '';
			$enableCollapsibleList  = isset( $attributes['enableCollapsableList'] ) ? (bool) $attributes['enableCollapsableList'] : false;
			$initialCollapse          = isset( $attributes['initialCollapse'] ) ? (bool) $attributes['initialCollapse'] : false;

			if ( empty( $vxtUltimateGutenbergBlocksTocHeadingContent ) || VXT_ASSET_VER !== $vxtUltimateGutenbergBlocksTocVersion ) {
				global $_wp_current_template_content;
				$customPost  = get_post( $post->ID );
				$postContent = '';
				if ( $customPost instanceof WP_Post ) {
					$postContent = $customPost->post_content;
				}
				// If the current template contents exist, use that - else get the content from the post ID.
				if ( $_wp_current_template_content && has_block( 'vexaltrix/table-of-contents', $_wp_current_template_content ) ) {
					$content = $_wp_current_template_content . $postContent;
				} else {
					$content = $postContent;
				}
				$vxtUltimateGutenbergBlocksTocHeadingContent          = $this->tableOfContentsGetHeadingsFromContent( $content );
				$blocks                            = parse_blocks( $content );
				$vxtUltimateGutenbergBlocksTocReusableHeadingContent = $this->tocRecursiveReusableHeading( $blocks );
				$vxtUltimateGutenbergBlocksTocHeadingContent          = array_merge( $vxtUltimateGutenbergBlocksTocHeadingContent, $vxtUltimateGutenbergBlocksTocReusableHeadingContent );

				$metaArray = [
					'_vxt_ultimate_gutenberg_blocks_toc_version'  => VXT_ASSET_VER,
					'_vxt_ultimate_gutenberg_blocks_toc_headings' => $vxtUltimateGutenbergBlocksTocHeadingContent,
				];

				update_post_meta( $post->ID, '_vxt_ultimate_gutenberg_blocks_toc_options', $metaArray );

			}

			$vxtUltimateGutenbergBlocksTocHeadingContent = $this->filterHeadingsByMappingHeaders( $vxtUltimateGutenbergBlocksTocHeadingContent, $attributes['mappingHeaders'] );

			$mappingHeaderFunc = function( $value ) {
				return $value;
			};

			$hasContent   = ( $vxtUltimateGutenbergBlocksTocHeadingContent && count( $vxtUltimateGutenbergBlocksTocHeadingContent ) > 0 && count( array_filter( $attributes['mappingHeaders'], $mappingHeaderFunc ) ) > 0 );
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
			$allowedSpanAttr = [
				'span' => [
					'class'         => true,
					'role'          => true,
					'tabindex'      => true,
					'aria-expanded' => true,
				],
			];
			$allowedSpanAttr = array_merge( wp_kses_allowed_html( 'post' ), $allowedSpanAttr );
			$wrap              = [
				'wp-block-vxt-table-of-contents',
				'vxt-toc__align-' . $attributes['align'],
				'vxt-toc__columns-' . $attributes['tColumnsDesktop'],
				( ( true === $attributes['initialCollapse'] ) ? 'vxt-toc__collapse' : '' ),
				'vxt-block-' . $attributes['block_id'],
				( isset( $attributes['className'] ) ) ? $attributes['className'] : '',
				$desktopClass,
				$tabClass,
				$mobClass,
				$zindexExtentionEnabled ? 'uag-blocks-common-selector' : '',
				( ( true === $attributes['enableCollapsableList'] ) ? 'vxt-toc__collapse--list' : '' ),
			];

			ob_start();
			?>
				<div class="<?php echo esc_attr( implode( ' ', $wrap ) ); ?>"
					data-scroll= "<?php echo esc_attr( $attributes['smoothScroll'] ); ?>"
					data-offset= "<?php echo esc_attr( \Vexaltrix\Core\Blocks\BlockHelper::getFallbackNumber( $attributes['smoothScrollOffset'], 'smoothScrollOffset', 'table-of-contents' ) ); ?>"
					style="<?php echo esc_attr( implode( '', $zindexWrap ) ); ?>"
				>
				<div class="vxt-toc__wrap">
						<div class="vxt-toc__title">
							<?php
								echo wp_kses_post( $attributes['headingTitle'] );
							if ( $attributes['makeCollapsible'] && $attributes['icon'] ) {
								?>
									<?php \Vexaltrix\Support\Helper::renderSvgHtml( $attributes['icon'] ); ?>
									<?php
							}
							?>
						</div>
						<?php
						if ( 'none' !== $attributes['separatorStyle'] ) {
							?>
								<div class='vxt-toc__separator'></div>
							<?php
						}
						?>
						<?php
						if ( $hasContent && $enableCollapsibleList && ! $initialCollapse && ! is_customize_preview() ) {
							echo '<div class="vxt-toc__loader"></div>';
						}
						?>
					<?php if ( $vxtUltimateGutenbergBlocksTocHeadingContent && count( $vxtUltimateGutenbergBlocksTocHeadingContent ) > 0 && count( array_filter( $attributes['mappingHeaders'], $mappingHeaderFunc ) ) > 0 ) { ?>
					<div class="vxt-toc__list-wrap <?php echo $enableCollapsibleList && $hasContent && ! is_customize_preview() ? 'vxt-toc__list-hidden' : ''; ?>">
						<?php
							echo wp_kses(
								$this->tableOfContentsRenderList(
									$this->tableOfContentsLinearToNestedHeadingList( $vxtUltimateGutenbergBlocksTocHeadingContent ),
									get_permalink( $post->ID ),
									$attributes
								),
								$allowedSpanAttr
							);
						?>
					</div>
					<?php } else { ?>
						<p class='vxt_ultimate_gutenberg_blocks_table-of-contents-placeholder'>
						<?php echo esc_html( $attributes['emptyHeadingTeaxt'] ); ?>
						</p>
					<?php } ?>
				</div>
				</div>
			<?php

			return ob_get_clean();
		}

		/**
		 * Registers the Vexaltrix Table Of Contents block.
		 *
		 * @since 1.23.0
		 * @access public
		 *
		 * @uses render_table_of_contents()
		 *
		 * @throws WP_Error An exception parsing the block definition.
		 */
		public function registerTableOfContents() {
			$mappingHeadersArray = array_fill_keys( [ 0, 1, 2, 3, 4, 5 ], true );

					register_block_type(
						'vexaltrix/table-of-contents',
						[
							'attributes'      => array_merge(
								[
									'block_id'             => [
										'type'    => 'string',
										'default' => 'not_set',
									],
									'classMigrate'         => [
										'type'    => 'boolean',
										'default' => false,
									],
									'headingTitleString'   => [
										'type' => 'string',
									],
									'disableBullets'       => [
										'type'    => 'boolean',
										'default' => false,
									],
									'makeCollapsible'      => [
										'type'    => 'boolean',
										'default' => false,
									],
									'initialCollapse'      => [
										'type'    => 'boolean',
										'default' => false,
									],
									'icon'                 => [
										'type'    => 'string',
										'default' => 'angle-down',
									],
									'iconSize'             => [
										'type' => 'number',
									],
									'iconColor'            => [
										'type' => 'string',
									],
									'bulletColor'          => [
										'type' => 'string',
									],
									'align'                => [
										'type'    => 'string',
										'default' => 'left',
									],
									'headingAlignment'     => [
										'type'    => 'string',
										'default' => 'left',
									],
									'heading'              => [
										'type'     => 'string',
										'selector' => '.vxt-toc__title',
										'default'  => __( 'Table Of Contents', 'vexaltrix' ),
									],
									'headingTitle'         => [
										'type'    => 'string',
										'default' => __( 'Table Of Contents', 'vexaltrix' ),
									],
									'smoothScroll'         => [
										'type'    => 'boolean',
										'default' => true,
									],
									'smoothScrollOffset'   => [
										'type'    => 'number',
										'default' => 30,
									],
									'scrollToTop'          => [
										'type'    => 'boolean',
										'default' => false,
									],
									'scrollToTopColor'     => [
										'type' => 'string',
									],
									'scrollToTopBgColor'   => [
										'type' => 'string',
									],
									'tColumnsDesktop'      => [
										'type'    => 'number',
										'default' => 1,
									],
									'tColumnsTablet'       => [
										'type'    => 'number',
										'default' => 1,
									],
									'tColumnsMobile'       => [
										'type'    => 'number',
										'default' => 1,
									],
									'mappingHeaders'       => [
										'type'    => 'array',
										'default' => $mappingHeadersArray,
									],
									// Color.
									'backgroundColor'      => [
										'type'    => 'string',
										'default' => '#eee',
									],
									'linkColor'            => [
										'type'    => 'string',
										'default' => '#333',
									],
									'linkHoverColor'       => [
										'type' => 'string',
									],
									'headingColor'         => [
										'type' => 'string',
									],

									// Padding.
									'topPaddingTablet'     => [
										'type'    => 'number',
										'default' => '',
									],
									'bottomPaddingTablet'  => [
										'type'    => 'number',
										'default' => '',
									],
									'leftPaddingTablet'    => [
										'type'    => 'number',
										'default' => '',
									],
									'rightPaddingTablet'   => [
										'type'    => 'number',
										'default' => '',
									],
									'topPaddingMobile'     => [
										'type'    => 'number',
										'default' => '',
									],
									'bottomPaddingMobile'  => [
										'type'    => 'number',
										'default' => '',
									],
									'leftPaddingMobile'    => [
										'type'    => 'number',
										'default' => '',
									],
									'rightPaddingMobile'   => [
										'type'    => 'number',
										'default' => '',
									],
									'vPaddingDesktop'      => [
										'type'    => 'number',
										'default' => 30,
									],
									'hPaddingDesktop'      => [
										'type'    => 'number',
										'default' => 30,
									],
									'vPaddingTablet'       => [
										'type' => 'number',
									],
									'hPaddingTablet'       => [
										'type' => 'number',
									],
									'vPaddingMobile'       => [
										'type' => 'number',
									],
									'hPaddingMobile'       => [
										'type' => 'number',
									],
									// Margin.
									'vMarginDesktop'       => [
										'type' => 'number',
									],
									'hMarginDesktop'       => [
										'type' => 'number',
									],
									'vMarginTablet'        => [
										'type' => 'number',
									],
									'hMarginTablet'        => [
										'type' => 'number',
									],
									'vMarginMobile'        => [
										'type' => 'number',
									],
									'hMarginMobile'        => [
										'type' => 'number',
									],
									'marginTypeDesktop'    => [
										'type'    => 'string',
										'default' => 'px',
									],
									'marginTypeTablet'     => [
										'type'    => 'string',
										'default' => 'px',
									],
									'marginTypeMobile'     => [
										'type'    => 'string',
										'default' => 'px',
									],
									'headingBottom'        => [
										'type' => 'number',
									],
									'headingBottomTablet'  => [
										'type' => 'number',
									],
									'headingBottomMobile'  => [
										'type' => 'number',
									],
									'paddingTypeDesktop'   => [
										'type'    => 'string',
										'default' => 'px',
									],
									'paddingTypeTablet'    => [
										'type'    => 'string',
										'default' => 'px',
									],
									'paddingTypeMobile'    => [
										'type'    => 'string',
										'default' => 'px',
									],

									// Content Padding.
									'contentPaddingDesktop' => [
										'type' => 'number',
									],
									'contentPaddingTablet' => [
										'type' => 'number',
									],
									'contentPaddingMobile' => [
										'type' => 'number',
									],
									'contentPaddingTypeDesktop' => [
										'type'    => 'string',
										'default' => 'px',
									],
									'contentPaddingTypeTablet' => [
										'type'    => 'string',
										'default' => 'px',
									],
									'contentPaddingTypeMobile' => [
										'type'    => 'string',
										'default' => 'px',
									],

									// Border.
									'borderStyle'          => [
										'type'    => 'string',
										'default' => 'solid',
									],
									'borderWidth'          => [
										'type'    => 'number',
										'default' => 1,
									],
									'borderRadius'         => [
										'type' => 'number',
									],
									'borderColor'          => [
										'type'    => 'string',
										'default' => '#333',
									],

									// Typography.
									// Link Font Family.
									'loadGoogleFonts'      => [
										'type'    => 'boolean',
										'default' => false,
									],
									'fontFamily'           => [
										'type'    => 'string',
										'default' => 'Default',
									],
									'fontWeight'           => [
										'type' => 'string',
									],
									// Link Font Size.
									'fontSize'             => [
										'type' => 'number',
									],
									'fontSizeType'         => [
										'type'    => 'string',
										'default' => 'px',
									],
									'fontSizeTablet'       => [
										'type' => 'number',
									],
									'fontSizeMobile'       => [
										'type' => 'number',
									],
									// Link Line Height.
									'lineHeightType'       => [
										'type'    => 'string',
										'default' => 'em',
									],
									'lineHeight'           => [
										'type' => 'number',
									],
									'lineHeightTablet'     => [
										'type' => 'number',
									],
									'lineHeightMobile'     => [
										'type' => 'number',
									],

									// Link Font Family.
									'headingLoadGoogleFonts' => [
										'type'    => 'boolean',
										'default' => false,
									],
									'headingFontFamily'    => [
										'type'    => 'string',
										'default' => 'Default',
									],
									'headingFontWeight'    => [
										'type'    => 'string',
										'default' => '500',
									],
									// Link Font Size.
									'headingFontSize'      => [
										'type'    => 'number',
										'default' => 20,
									],
									'headingFontSizeType'  => [
										'type'    => 'string',
										'default' => 'px',
									],
									'headingFontSizeTablet' => [
										'type' => 'number',
									],
									'headingFontSizeMobile' => [
										'type' => 'number',
									],
									// Link Line Height.
									'headingLineHeightType' => [
										'type'    => 'string',
										'default' => 'em',
									],
									'headingLineHeight'    => [
										'type' => 'number',
									],
									'headingLineHeightTablet' => [
										'type' => 'number',
									],
									'headingLineHeightMobile' => [
										'type' => 'number',
									],
									'emptyHeadingTeaxt'    => [
										'type'    => 'string',
										'default' => __( 'Add a header to begin generating the table of contents', 'vexaltrix' ),
									],
									// Separator.
									'separatorStyle'       => [
										'type'    => 'string',
										'default' => 'none',
									],
									'separatorHeight'      => [
										'type'    => 'number',
										'default' => 1,
									],
									'separatorHeightType'  => [
										'type'    => 'string',
										'default' => 'px',
									],
									'separatorSpace'       => [
										'type'    => 'number',
										'default' => 15,
									],
									'separatorSpaceTablet' => [
										'type'    => 'number',
										'default' => '',
									],
									'separatorSpaceMobile' => [
										'type'    => 'number',
										'default' => '',
									],
									'separatorSpaceType'   => [
										'type'    => 'string',
										'default' => 'px',
									],
									'separatorColor'       => [
										'type'    => 'string',
										'default' => '',
									],
									'separatorHColor'      => [
										'type'    => 'string',
										'default' => '',
									],
									// Overall block alignment.
									'overallAlign'         => [
										'type'    => 'string',
										'default' => 'left',
									],
									'collapsibleListDepth' => [
										'type'    => 'number',
										'default' => 5,
									],
									'enableCollapsableList' => [
										'type'    => 'boolean',
										'default' => false,
									],
									'initiallyCollapseList' => [
										'type'    => 'boolean',
										'default' => false,
									],
								]
							),
							'renderCallback' => [ $this, 'renderTableOfContents' ],
						]
					);
		}

	}

	/**
	 *  Prepare if class 'Vexaltrix\\BlocksConfig\\TableOfContent\\TableOfContent' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
