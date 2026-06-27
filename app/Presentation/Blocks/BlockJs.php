<?php
/**
 * Vexaltrix Block Helper.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Presentation\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Presentation\Blocks\\BlockJs' ) ) {

	/**
	 * Class \Vexaltrix\Presentation\Blocks\BlockJs.
	 */
	class BlockJs {

		/**
		 * Adds Google fonts for Advanced Heading block.
		 *
		 * @since 1.9.1
		 * @param array $attr the blocks attr.
		 */
		public static function blocksAdvancedHeadingGfont( $attr ) {

			$headLoadGoogleFont = isset( $attr['headLoadGoogleFonts'] ) ? $attr['headLoadGoogleFonts'] : '';
			$headFontFamily      = isset( $attr['headFontFamily'] ) ? $attr['headFontFamily'] : '';
			$headFontWeight      = isset( $attr['headFontWeight'] ) ? $attr['headFontWeight'] : '';

			$subheadLoadGoogleFont = isset( $attr['subHeadLoadGoogleFonts'] ) ? $attr['subHeadLoadGoogleFonts'] : '';
			$subheadFontFamily      = isset( $attr['subHeadFontFamily'] ) ? $attr['subHeadFontFamily'] : '';
			$subheadFontWeight      = isset( $attr['subHeadFontWeight'] ) ? $attr['subHeadFontWeight'] : '';

			$highlightHeadLoadGoogleFont = isset( $attr['highLightLoadGoogleFonts'] ) ? $attr['highLightLoadGoogleFonts'] : '';
			$highlightHeadFontFamily      = isset( $attr['highLightFontFamily'] ) ? $attr['highLightFontFamily'] : '';
			$highlightHeadFontWeight      = isset( $attr['highLightFontWeight'] ) ? $attr['highLightFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $headLoadGoogleFont, $headFontFamily, $headFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $subheadLoadGoogleFont, $subheadFontFamily, $subheadFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $highlightHeadLoadGoogleFont, $highlightHeadFontFamily, $highlightHeadFontWeight );
		}

		/**
		 * Adds Google fonts for How To block.
		 *
		 * @since 1.15.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksHowToGfont( $attr ) {

			$headLoadGoogleFont = isset( $attr['headLoadGoogleFonts'] ) ? $attr['headLoadGoogleFonts'] : '';
			$headFontFamily      = isset( $attr['headFontFamily'] ) ? $attr['headFontFamily'] : '';
			$headFontWeight      = isset( $attr['headFontWeight'] ) ? $attr['headFontWeight'] : '';

			$subheadLoadGoogleFont = isset( $attr['subHeadLoadGoogleFonts'] ) ? $attr['subHeadLoadGoogleFonts'] : '';
			$subheadFontFamily      = isset( $attr['subHeadFontFamily'] ) ? $attr['subHeadFontFamily'] : '';
			$subheadFontWeight      = isset( $attr['subHeadFontWeight'] ) ? $attr['subHeadFontWeight'] : '';

			$priceLoadGoogleFont = isset( $attr['priceLoadGoogleFonts'] ) ? $attr['priceLoadGoogleFonts'] : '';
			$priceFontFamily      = isset( $attr['priceFontFamily'] ) ? $attr['priceFontFamily'] : '';
			$priceFontWeight      = isset( $attr['priceFontWeight'] ) ? $attr['priceFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $headLoadGoogleFont, $headFontFamily, $headFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $subheadLoadGoogleFont, $subheadFontFamily, $subheadFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $priceLoadGoogleFont, $priceFontFamily, $priceFontWeight );
		}
		/**
		 * Adds Google fonts for How To Step block.
		 *
		 * @since 2.0.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksHowToStepGfont( $attr ) {

			$urlLoadGoogleFont = isset( $attr['urlLoadGoogleFonts'] ) ? $attr['urlLoadGoogleFonts'] : '';
			$urlFontFamily      = isset( $attr['urlFontFamily'] ) ? $attr['urlFontFamily'] : '';
			$urlFontWeight      = isset( $attr['urlFontWeight'] ) ? $attr['urlFontWeight'] : '';

			$titleLoadGoogleFont = isset( $attr['titleLoadGoogleFonts'] ) ? $attr['titleLoadGoogleFonts'] : '';
			$titleFontFamily      = isset( $attr['titleFontFamily'] ) ? $attr['titleFontFamily'] : '';
			$titleFontWeight      = isset( $attr['titleFontWeight'] ) ? $attr['titleFontWeight'] : '';

			$descriptionLoadGoogleFont = isset( $attr['descriptionLoadGoogleFonts'] ) ? $attr['descriptionLoadGoogleFonts'] : '';
			$descriptionFontFamily      = isset( $attr['descriptionFontFamily'] ) ? $attr['descriptionFontFamily'] : '';
			$descriptionFontWeight      = isset( $attr['descriptionFontWeight'] ) ? $attr['descriptionFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $urlLoadGoogleFont, $urlFontFamily, $urlFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $titleLoadGoogleFont, $titleFontFamily, $titleFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $descriptionLoadGoogleFont, $descriptionFontFamily, $descriptionFontWeight );
		}

		/**
		 * Adds Google fonts for review block.
		 *
		 * @since 1.19.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksReviewGfont( $attr ) {

			$headLoadGoogleFont = isset( $attr['headLoadGoogleFonts'] ) ? $attr['headLoadGoogleFonts'] : '';
			$headFontFamily      = isset( $attr['headFontFamily'] ) ? $attr['headFontFamily'] : '';
			$headFontWeight      = isset( $attr['headFontWeight'] ) ? $attr['headFontWeight'] : '';

			$subheadLoadGoogleFont = isset( $attr['subHeadLoadGoogleFonts'] ) ? $attr['subHeadLoadGoogleFonts'] : '';
			$subheadFontFamily      = isset( $attr['subHeadFontFamily'] ) ? $attr['subHeadFontFamily'] : '';
			$subheadFontWeight      = isset( $attr['subHeadFontWeight'] ) ? $attr['subHeadFontWeight'] : '';

			$contentLoadGoogleFonts = isset( $attr['contentLoadGoogleFonts'] ) ? $attr['contentLoadGoogleFonts'] : '';
			$contentFontFamily       = isset( $attr['contentFontFamily'] ) ? $attr['contentFontFamily'] : '';
			$contentFontWeight       = isset( $attr['contentFontWeight'] ) ? $attr['contentFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $subheadLoadGoogleFont, $subheadFontFamily, $subheadFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $headLoadGoogleFont, $headFontFamily, $headFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $contentLoadGoogleFonts, $contentFontFamily, $contentFontWeight );
		}

		/**
		 * Adds Google fonts for Inline Notice block.
		 *
		 * @since 1.16.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksInlineNoticeGfont( $attr ) {

			$titleLoadGoogleFont = isset( $attr['titleLoadGoogleFonts'] ) ? $attr['titleLoadGoogleFonts'] : '';
			$titleFontFamily      = isset( $attr['titleFontFamily'] ) ? $attr['titleFontFamily'] : '';
			$titleFontWeight      = isset( $attr['titleFontWeight'] ) ? $attr['titleFontWeight'] : '';

			$descLoadGoogleFont = isset( $attr['descLoadGoogleFonts'] ) ? $attr['descLoadGoogleFonts'] : '';
			$descFontFamily      = isset( $attr['descFontFamily'] ) ? $attr['descFontFamily'] : '';
			$descFontWeight      = isset( $attr['descFontWeight'] ) ? $attr['descFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $titleLoadGoogleFont, $titleFontFamily, $titleFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $descLoadGoogleFont, $descFontFamily, $descFontWeight );
		}

		/**
		 * Adds Google fonts for CF7 Styler block.
		 *
		 * @since 1.10.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksCf7StylerGfont( $attr ) {

			$labelLoadGoogleFont = isset( $attr['labelLoadGoogleFonts'] ) ? $attr['labelLoadGoogleFonts'] : '';
			$labelFontFamily      = isset( $attr['labelFontFamily'] ) ? $attr['labelFontFamily'] : '';
			$labelFontWeight      = isset( $attr['labelFontWeight'] ) ? $attr['labelFontWeight'] : '';

			$inputLoadGoogleFont = isset( $attr['inputLoadGoogleFonts'] ) ? $attr['inputLoadGoogleFonts'] : '';
			$inputFontFamily      = isset( $attr['inputFontFamily'] ) ? $attr['inputFontFamily'] : '';
			$inputFontWeight      = isset( $attr['inputFontWeight'] ) ? $attr['inputFontWeight'] : '';

			$radioCheckLoadGoogleFont = isset( $attr['radioCheckLoadGoogleFonts'] ) ? $attr['radioCheckLoadGoogleFonts'] : '';
			$radioCheckFontFamily      = isset( $attr['radioCheckFontFamily'] ) ? $attr['radioCheckFontFamily'] : '';
			$radioCheckFontWeight      = isset( $attr['radioCheckFontWeight'] ) ? $attr['radioCheckFontWeight'] : '';

			$buttonLoadGoogleFont = isset( $attr['buttonLoadGoogleFonts'] ) ? $attr['buttonLoadGoogleFonts'] : '';
			$buttonFontFamily      = isset( $attr['buttonFontFamily'] ) ? $attr['buttonFontFamily'] : '';
			$buttonFontWeight      = isset( $attr['buttonFontWeight'] ) ? $attr['buttonFontWeight'] : '';

			$msgFontLoadGoogleFont = isset( $attr['msgLoadGoogleFonts'] ) ? $attr['msgLoadGoogleFonts'] : '';
			$msgFontFamily           = isset( $attr['msgFontFamily'] ) ? $attr['msgFontFamily'] : '';
			$msgFontWeight           = isset( $attr['msgFontWeight'] ) ? $attr['msgFontWeight'] : '';

			$validationMsgLoadGoogleFont = isset( $attr['validationMsgLoadGoogleFonts'] ) ? $attr['validationMsgLoadGoogleFonts'] : '';
			$validationMsgFontFamily      = isset( $attr['validationMsgFontFamily'] ) ? $attr['validationMsgFontFamily'] : '';
			$validationMsgFontWeight      = isset( $attr['validationMsgFontWeight'] ) ? $attr['validationMsgFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $msgFontLoadGoogleFont, $msgFontFamily, $msgFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $validationMsgLoadGoogleFont, $validationMsgFontFamily, $validationMsgFontWeight );

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $radioCheckLoadGoogleFont, $radioCheckFontFamily, $radioCheckFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $buttonLoadGoogleFont, $buttonFontFamily, $buttonFontWeight );

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $labelLoadGoogleFont, $labelFontFamily, $labelFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $inputLoadGoogleFont, $inputFontFamily, $inputFontWeight );
		}


		/**
		 * Adds Google fonts for Gravity Form Styler block.
		 *
		 * @since 1.12.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksGfStylerGfont( $attr ) {

			$labelLoadGoogleFont = isset( $attr['labelLoadGoogleFonts'] ) ? $attr['labelLoadGoogleFonts'] : '';
			$labelFontFamily      = isset( $attr['labelFontFamily'] ) ? $attr['labelFontFamily'] : '';
			$labelFontWeight      = isset( $attr['labelFontWeight'] ) ? $attr['labelFontWeight'] : '';

			$inputLoadGoogleFont = isset( $attr['inputLoadGoogleFonts'] ) ? $attr['inputLoadGoogleFonts'] : '';
			$inputFontFamily      = isset( $attr['inputFontFamily'] ) ? $attr['inputFontFamily'] : '';
			$inputFontWeight      = isset( $attr['inputFontWeight'] ) ? $attr['inputFontWeight'] : '';

			$radioCheckLoadGoogleFont = isset( $attr['radioCheckLoadGoogleFonts'] ) ? $attr['radioCheckLoadGoogleFonts'] : '';
			$radioCheckFontFamily      = isset( $attr['radioCheckFontFamily'] ) ? $attr['radioCheckFontFamily'] : '';
			$radioCheckFontWeight      = isset( $attr['radioCheckFontWeight'] ) ? $attr['radioCheckFontWeight'] : '';

			$buttonLoadGoogleFont = isset( $attr['buttonLoadGoogleFonts'] ) ? $attr['buttonLoadGoogleFonts'] : '';
			$buttonFontFamily      = isset( $attr['buttonFontFamily'] ) ? $attr['buttonFontFamily'] : '';
			$buttonFontWeight      = isset( $attr['buttonFontWeight'] ) ? $attr['buttonFontWeight'] : '';

			$msgFontLoadGoogleFont = isset( $attr['msgLoadGoogleFonts'] ) ? $attr['msgLoadGoogleFonts'] : '';
			$msgFontFamily           = isset( $attr['msgFontFamily'] ) ? $attr['msgFontFamily'] : '';
			$msgFontWeight           = isset( $attr['msgFontWeight'] ) ? $attr['msgFontWeight'] : '';

			$validationMsgLoadGoogleFont = isset( $attr['validationMsgLoadGoogleFonts'] ) ? $attr['validationMsgLoadGoogleFonts'] : '';
			$validationMsgFontFamily      = isset( $attr['validationMsgFontFamily'] ) ? $attr['validationMsgFontFamily'] : '';
			$validationMsgFontWeight      = isset( $attr['validationMsgFontWeight'] ) ? $attr['validationMsgFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $msgFontLoadGoogleFont, $msgFontFamily, $msgFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $validationMsgLoadGoogleFont, $validationMsgFontFamily, $validationMsgFontWeight );

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $radioCheckLoadGoogleFont, $radioCheckFontFamily, $radioCheckFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $buttonLoadGoogleFont, $buttonFontFamily, $buttonFontWeight );

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $labelLoadGoogleFont, $labelFontFamily, $labelFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $inputLoadGoogleFont, $inputFontFamily, $inputFontWeight );
		}

		/**
		 * Adds Google fonts for Marketing Button block.
		 *
		 * @since 1.11.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksMarketingBtnGfont( $attr ) {

			$titleLoadGoogleFont = isset( $attr['titleLoadGoogleFonts'] ) ? $attr['titleLoadGoogleFonts'] : '';
			$titleFontFamily      = isset( $attr['titleFontFamily'] ) ? $attr['titleFontFamily'] : '';
			$titleFontWeight      = isset( $attr['titleFontWeight'] ) ? $attr['titleFontWeight'] : '';

			$prefixLoadGoogleFont = isset( $attr['prefixLoadGoogleFonts'] ) ? $attr['prefixLoadGoogleFonts'] : '';
			$prefixFontFamily      = isset( $attr['prefixFontFamily'] ) ? $attr['prefixFontFamily'] : '';
			$prefixFontWeight      = isset( $attr['prefixFontWeight'] ) ? $attr['prefixFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $titleLoadGoogleFont, $titleFontFamily, $titleFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $prefixLoadGoogleFont, $prefixFontFamily, $prefixFontWeight );
		}

		/**
		 * Adds Google fonts for Table Of Contents block.
		 *
		 * @since 1.13.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksTableOfContentsGfont( $attr ) {
			$loadGoogleFont         = isset( $attr['loadGoogleFonts'] ) ? $attr['loadGoogleFonts'] : '';
			$fontFamily              = isset( $attr['fontFamily'] ) ? $attr['fontFamily'] : '';
			$fontWeight              = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : '';
			$headingLoadGoogleFont = isset( $attr['headingLoadGoogleFonts'] ) ? $attr['headingLoadGoogleFonts'] : '';
			$headingFontFamily      = isset( $attr['headingFontFamily'] ) ? $attr['headingFontFamily'] : '';
			$headingFontWeight      = isset( $attr['headingFontWeight'] ) ? $attr['headingFontWeight'] : '';
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $loadGoogleFont, $fontFamily, $fontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $headingLoadGoogleFont, $headingFontFamily, $headingFontWeight );
		}

		/**
		 * Adds Google fonts for Blockquote.
		 *
		 * @since 1.9.1
		 * @param array $attr the blocks attr.
		 */
		public static function blocksBlockquoteGfont( $attr ) {

			$descLoadGoogleFont = isset( $attr['descLoadGoogleFonts'] ) ? $attr['descLoadGoogleFonts'] : '';
			$descFontFamily      = isset( $attr['descFontFamily'] ) ? $attr['descFontFamily'] : '';
			$descFontWeight      = isset( $attr['descFontWeight'] ) ? $attr['descFontWeight'] : '';

			$authorLoadGoogleFont = isset( $attr['authorLoadGoogleFonts'] ) ? $attr['authorLoadGoogleFonts'] : '';
			$authorFontFamily      = isset( $attr['authorFontFamily'] ) ? $attr['authorFontFamily'] : '';
			$authorFontWeight      = isset( $attr['authorFontWeight'] ) ? $attr['authorFontWeight'] : '';

			$tweetBtnLoadGoogleFont = isset( $attr['tweetBtnLoadGoogleFonts'] ) ? $attr['tweetBtnLoadGoogleFonts'] : '';
			$tweetBtnFontFamily      = isset( $attr['tweetBtnFontFamily'] ) ? $attr['tweetBtnFontFamily'] : '';
			$tweetBtnFontWeight      = isset( $attr['tweetBtnFontWeight'] ) ? $attr['tweetBtnFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $descLoadGoogleFont, $descFontFamily, $descFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $authorLoadGoogleFont, $authorFontFamily, $authorFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $tweetBtnLoadGoogleFont, $tweetBtnFontFamily, $tweetBtnFontWeight );
		}

		/**
		 * Adds Google fonts for Testimonials block.
		 *
		 * @since 1.9.1
		 * @param array $attr the blocks attr.
		 */
		public static function blocksTestimonialGfont( $attr ) {
			$descLoadGoogleFonts = isset( $attr['descLoadGoogleFonts'] ) ? $attr['descLoadGoogleFonts'] : '';
			$descFontFamily       = isset( $attr['descFontFamily'] ) ? $attr['descFontFamily'] : '';
			$descFontWeight       = isset( $attr['descFontWeight'] ) ? $attr['descFontWeight'] : '';

			$nameLoadGoogleFonts = isset( $attr['nameLoadGoogleFonts'] ) ? $attr['nameLoadGoogleFonts'] : '';
			$nameFontFamily       = isset( $attr['nameFontFamily'] ) ? $attr['nameFontFamily'] : '';
			$nameFontWeight       = isset( $attr['nameFontWeight'] ) ? $attr['nameFontWeight'] : '';

			$companyLoadGoogleFonts = isset( $attr['companyLoadGoogleFonts'] ) ? $attr['companyLoadGoogleFonts'] : '';
			$companyFontFamily       = isset( $attr['companyFontFamily'] ) ? $attr['companyFontFamily'] : '';
			$companyFontWeight       = isset( $attr['companyFontWeight'] ) ? $attr['companyFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $descLoadGoogleFonts, $descFontFamily, $descFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $nameLoadGoogleFonts, $nameFontFamily, $nameFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $companyLoadGoogleFonts, $companyFontFamily, $companyFontWeight );
		}

		/**
		 * Adds Google fonts for Advanced Heading block.
		 *
		 * @since 1.9.1
		 * @param array $attr the blocks attr.
		 */
		public static function blocksTeamGfont( $attr ) {

			$titleLoadGoogleFont = isset( $attr['titleLoadGoogleFonts'] ) ? $attr['titleLoadGoogleFonts'] : '';
			$titleFontFamily      = isset( $attr['titleFontFamily'] ) ? $attr['titleFontFamily'] : '';
			$titleFontWeight      = isset( $attr['titleFontWeight'] ) ? $attr['titleFontWeight'] : '';

			$prefixLoadGoogleFont = isset( $attr['prefixLoadGoogleFonts'] ) ? $attr['prefixLoadGoogleFonts'] : '';
			$prefixFontFamily      = isset( $attr['prefixFontFamily'] ) ? $attr['prefixFontFamily'] : '';
			$prefixFontWeight      = isset( $attr['prefixFontWeight'] ) ? $attr['prefixFontWeight'] : '';

			$descLoadGoogleFont = isset( $attr['descLoadGoogleFonts'] ) ? $attr['descLoadGoogleFonts'] : '';
			$descFontFamily      = isset( $attr['descFontFamily'] ) ? $attr['descFontFamily'] : '';
			$descFontWeight      = isset( $attr['descFontWeight'] ) ? $attr['descFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $titleLoadGoogleFont, $titleFontFamily, $titleFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $prefixLoadGoogleFont, $prefixFontFamily, $prefixFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $descLoadGoogleFont, $descFontFamily, $descFontWeight );
		}

		/**
		 *
		 * Adds Google fonts for Restaurant Menu block.
		 *
		 * @since 1.9.1
		 * @param array $attr the blocks attr.
		 */
		public static function blocksRestaurantMenuGfont( $attr ) {
			$titleLoadGoogleFonts = isset( $attr['titleLoadGoogleFonts'] ) ? $attr['titleLoadGoogleFonts'] : '';
			$titleFontFamily       = isset( $attr['titleFontFamily'] ) ? $attr['titleFontFamily'] : '';
			$titleFontWeight       = isset( $attr['titleFontWeight'] ) ? $attr['titleFontWeight'] : '';

			$priceLoadGoogleFonts = isset( $attr['priceLoadGoogleFonts'] ) ? $attr['priceLoadGoogleFonts'] : '';
			$priceFontFamily       = isset( $attr['priceFontFamily'] ) ? $attr['priceFontFamily'] : '';
			$priceFontWeight       = isset( $attr['priceFontWeight'] ) ? $attr['priceFontWeight'] : '';

			$descLoadGoogleFonts = isset( $attr['descLoadGoogleFonts'] ) ? $attr['descLoadGoogleFonts'] : '';
			$descFontFamily       = isset( $attr['descFontFamily'] ) ? $attr['descFontFamily'] : '';
			$descFontWeight       = isset( $attr['descFontWeight'] ) ? $attr['descFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $titleLoadGoogleFonts, $titleFontFamily, $titleFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $priceLoadGoogleFonts, $priceFontFamily, $priceFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $descLoadGoogleFonts, $descFontFamily, $descFontWeight );
		}

		/**
		 * Adds Google fonts for Content Timeline block.
		 *
		 * @since 1.9.1
		 * @param array $attr the blocks attr.
		 */
		public static function blocksContentTimelineGfont( $attr ) {
			$headLoadGoogleFonts = isset( $attr['headLoadGoogleFonts'] ) ? $attr['headLoadGoogleFonts'] : '';
			$headFontFamily       = isset( $attr['headFontFamily'] ) ? $attr['headFontFamily'] : '';
			$headFontWeight       = isset( $attr['headFontWeight'] ) ? $attr['headFontWeight'] : '';

			$subheadloadGoogleFonts = isset( $attr['subHeadLoadGoogleFonts'] ) ? $attr['subHeadLoadGoogleFonts'] : '';
			$subheadfontFamily       = isset( $attr['subHeadFontFamily'] ) ? $attr['subHeadFontFamily'] : '';
			$subheadfontWeight       = isset( $attr['subHeadFontWeight'] ) ? $attr['subHeadFontWeight'] : '';

			$dateLoadGoogleFonts = isset( $attr['dateLoadGoogleFonts'] ) ? $attr['dateLoadGoogleFonts'] : '';
			$dateFontFamily       = isset( $attr['dateFontFamily'] ) ? $attr['dateFontFamily'] : '';
			$dateFontWeight       = isset( $attr['dateFontWeight'] ) ? $attr['dateFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $headLoadGoogleFonts, $headFontFamily, $headFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $subheadloadGoogleFonts, $subheadfontFamily, $subheadfontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $dateLoadGoogleFonts, $dateFontFamily, $dateFontWeight );
		}

		/**
		 * Adds Google fonts for Post Timeline block.
		 *
		 * @since 1.9.1
		 * @param array $attr the blocks attr.
		 */
		public static function blocksPostTimelineGfont( $attr ) {
			self::blocksContentTimelineGfont( $attr );

			$authorLoadGoogleFonts = isset( $attr['authorLoadGoogleFonts'] ) ? $attr['authorLoadGoogleFonts'] : '';
			$authorFontFamily       = isset( $attr['authorFontFamily'] ) ? $attr['authorFontFamily'] : '';
			$authorFontWeight       = isset( $attr['authorFontWeight'] ) ? $attr['authorFontWeight'] : '';

			$ctaLoadGoogleFonts = isset( $attr['ctaLoadGoogleFonts'] ) ? $attr['ctaLoadGoogleFonts'] : '';
			$ctaFontFamily       = isset( $attr['ctaFontFamily'] ) ? $attr['ctaFontFamily'] : '';
			$ctaFontWeight       = isset( $attr['ctaFontWeight'] ) ? $attr['ctaFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $authorLoadGoogleFonts, $authorFontFamily, $authorFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $ctaLoadGoogleFonts, $ctaFontFamily, $ctaFontWeight );
		}

		/**
		 * Adds Google fonts for Mulit Button's block.
		 *
		 * @since 1.9.1
		 * @param array $attr the blocks attr.
		 */
		public static function blocksButtonsGfont( $attr ) {

			$loadGoogleFont = isset( $attr['loadGoogleFonts'] ) ? $attr['loadGoogleFonts'] : '';
			$fontFamily      = isset( $attr['fontFamily'] ) ? $attr['fontFamily'] : '';
			$fontWeight      = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : '';
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $loadGoogleFont, $fontFamily, $fontWeight );
		}

		/**
		 * Adds Google fonts for Post block.
		 *
		 * @since 1.9.1
		 * @param array $attr the blocks attr.
		 */
		public static function blocksPostGfont( $attr ) {

			$titleLoadGoogleFont = isset( $attr['titleLoadGoogleFonts'] ) ? $attr['titleLoadGoogleFonts'] : '';
			$titleFontFamily      = isset( $attr['titleFontFamily'] ) ? $attr['titleFontFamily'] : '';
			$titleFontWeight      = isset( $attr['titleFontWeight'] ) ? $attr['titleFontWeight'] : '';

			$metaLoadGoogleFont = isset( $attr['metaLoadGoogleFonts'] ) ? $attr['metaLoadGoogleFonts'] : '';
			$metaFontFamily      = isset( $attr['metaFontFamily'] ) ? $attr['metaFontFamily'] : '';
			$metaFontWeight      = isset( $attr['metaFontWeight'] ) ? $attr['metaFontWeight'] : '';

			$excerptLoadGoogleFont = isset( $attr['excerptLoadGoogleFonts'] ) ? $attr['excerptLoadGoogleFonts'] : '';
			$excerptFontFamily      = isset( $attr['excerptFontFamily'] ) ? $attr['excerptFontFamily'] : '';
			$excerptFontWeight      = isset( $attr['excerptFontWeight'] ) ? $attr['excerptFontWeight'] : '';

			$ctaLoadGoogleFont = isset( $attr['ctaLoadGoogleFonts'] ) ? $attr['ctaLoadGoogleFonts'] : '';
			$ctaFontFamily      = isset( $attr['ctaFontFamily'] ) ? $attr['ctaFontFamily'] : '';
			$ctaFontWeight      = isset( $attr['ctaFontWeight'] ) ? $attr['ctaFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $titleLoadGoogleFont, $titleFontFamily, $titleFontWeight );

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $metaLoadGoogleFont, $metaFontFamily, $metaFontWeight );

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $excerptLoadGoogleFont, $excerptFontFamily, $excerptFontWeight );

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $ctaLoadGoogleFont, $ctaFontFamily, $ctaFontWeight );
		}

		/**
		 * Adds Google fonts for Advanced Heading block.
		 *
		 * @since 1.9.1
		 * @param array $attr the blocks attr.
		 */
		public static function blocksInfoBoxGfont( $attr ) {

			$headLoadGoogleFont = isset( $attr['headLoadGoogleFonts'] ) ? $attr['headLoadGoogleFonts'] : '';
			$headFontFamily      = isset( $attr['headFontFamily'] ) ? $attr['headFontFamily'] : '';
			$headFontWeight      = isset( $attr['headFontWeight'] ) ? $attr['headFontWeight'] : '';

			$prefixLoadGoogleFont = isset( $attr['prefixLoadGoogleFonts'] ) ? $attr['prefixLoadGoogleFonts'] : '';
			$prefixFontFamily      = isset( $attr['prefixFontFamily'] ) ? $attr['prefixFontFamily'] : '';
			$prefixFontWeight      = isset( $attr['prefixFontWeight'] ) ? $attr['prefixFontWeight'] : '';

			$subheadLoadGoogleFont = isset( $attr['subHeadLoadGoogleFonts'] ) ? $attr['subHeadLoadGoogleFonts'] : '';
			$subheadFontFamily      = isset( $attr['subHeadFontFamily'] ) ? $attr['subHeadFontFamily'] : '';
			$subheadFontWeight      = isset( $attr['subHeadFontWeight'] ) ? $attr['subHeadFontWeight'] : '';

			$ctaLoadGoogleFont = isset( $attr['ctaLoadGoogleFonts'] ) ? $attr['ctaLoadGoogleFonts'] : '';
			$ctaFontFamily      = isset( $attr['ctaFontFamily'] ) ? $attr['ctaFontFamily'] : '';
			$ctaFontWeight      = isset( $attr['ctaFontWeight'] ) ? $attr['ctaFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $ctaLoadGoogleFont, $ctaFontFamily, $ctaFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $headLoadGoogleFont, $headFontFamily, $headFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $prefixLoadGoogleFont, $prefixFontFamily, $prefixFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $subheadLoadGoogleFont, $subheadFontFamily, $subheadFontWeight );
		}

		/**
		 * Adds Google fonts for Call To Action block.
		 *
		 * @since 1.9.1
		 * @param array $attr the blocks attr.
		 */
		public static function blocksCallToActionGfont( $attr ) {

			$titleLoadGoogleFont = isset( $attr['titleLoadGoogleFonts'] ) ? $attr['titleLoadGoogleFonts'] : '';
			$titleFontFamily      = isset( $attr['titleFontFamily'] ) ? $attr['titleFontFamily'] : '';
			$titleFontWeight      = isset( $attr['titleFontWeight'] ) ? $attr['titleFontWeight'] : '';

			$descLoadGoogleFont = isset( $attr['descLoadGoogleFonts'] ) ? $attr['descLoadGoogleFonts'] : '';
			$descFontFamily      = isset( $attr['descFontFamily'] ) ? $attr['descFontFamily'] : '';
			$descFontWeight      = isset( $attr['descFontWeight'] ) ? $attr['descFontWeight'] : '';

			$ctaLoadGoogleFont = isset( $attr['ctaLoadGoogleFonts'] ) ? $attr['ctaLoadGoogleFonts'] : '';
			$ctaFontFamily      = isset( $attr['ctaFontFamily'] ) ? $attr['ctaFontFamily'] : '';
			$ctaFontWeight      = isset( $attr['ctaFontWeight'] ) ? $attr['ctaFontWeight'] : '';

			$secondCtaLoadGoogleFont = isset( $attr['secondCtaLoadGoogleFonts'] ) ? $attr['secondCtaLoadGoogleFonts'] : '';
			$secondCtaFontFamily      = isset( $attr['secondCtaFontFamily'] ) ? $attr['secondCtaFontFamily'] : '';
			$secondCtaFontWeight      = isset( $attr['secondCtaFontWeight'] ) ? $attr['secondCtaFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $ctaLoadGoogleFont, $ctaFontFamily, $ctaFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $titleLoadGoogleFont, $titleFontFamily, $titleFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $descLoadGoogleFont, $descFontFamily, $descFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $secondCtaLoadGoogleFont, $secondCtaFontFamily, $secondCtaFontWeight );
		}

		/**
		 * Adds Google fonts for FAQ block.
		 *
		 * @since 1.15.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksFaqGfont( $attr ) {

			$questionLoadGoogleFont = isset( $attr['questionloadGoogleFonts'] ) ? $attr['questionloadGoogleFonts'] : '';
			$questionFontFamily      = isset( $attr['questionFontFamily'] ) ? $attr['questionFontFamily'] : '';
			$questionFontWeight      = isset( $attr['questionFontWeight'] ) ? $attr['questionFontWeight'] : '';

			$answerLoadGoogleFont = isset( $attr['answerloadGoogleFonts'] ) ? $attr['answerloadGoogleFonts'] : '';
			$answerFontFamily      = isset( $attr['answerFontFamily'] ) ? $attr['answerFontFamily'] : '';
			$answerFontWeight      = isset( $attr['answerFontWeight'] ) ? $attr['answerFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $questionLoadGoogleFont, $questionFontFamily, $questionFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $answerLoadGoogleFont, $answerFontFamily, $answerFontWeight );

		}

		/**
		 * Adds Google fonts for WP Search block.
		 *
		 * @since 1.16.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksWpSearchGfont( $attr ) {

			$inputLoadGoogleFont = isset( $attr['inputloadGoogleFonts'] ) ? $attr['inputloadGoogleFonts'] : '';
			$inputFontFamily      = isset( $attr['inputFontFamily'] ) ? $attr['inputFontFamily'] : '';
			$inputFontWeight      = isset( $attr['inputFontWeight'] ) ? $attr['inputFontWeight'] : '';

			$buttonLoadGoogleFont = isset( $attr['buttonloadGoogleFonts'] ) ? $attr['buttonloadGoogleFonts'] : '';
			$buttonFontFamily      = isset( $attr['buttonFontFamily'] ) ? $attr['buttonFontFamily'] : '';
			$buttonFontWeight      = isset( $attr['buttonFontWeight'] ) ? $attr['buttonFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $buttonLoadGoogleFont, $buttonFontFamily, $buttonFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $inputLoadGoogleFont, $inputFontFamily, $inputFontWeight );
		}

		/**
		 *
		 * Adds Google fonts for Separator block.
		 *
		 * @since 2.6.0
		 * @param array $attr the blocks attr.
		 * @return void
		 */
		public static function blocksSeparatorGfont( $attr ) {
			$elementTextLoadGoogleFont = isset( $attr['elementTextLoadGoogleFonts'] ) ? $attr['elementTextLoadGoogleFonts'] : '';
			$elementTextFontFamily      = isset( $attr['elementTextFontFamily'] ) ? $attr['elementTextFontFamily'] : '';
			$elementTextFontWeight      = isset( $attr['elementTextFontWeight'] ) ? $attr['elementTextFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $elementTextLoadGoogleFont, $elementTextFontFamily, $elementTextFontWeight );
		}

		/**
		 * Adds Google fonts for Taxonomy List block.
		 *
		 * @since 1.18.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksTaxonomyListGfont( $attr ) {

			$titleLoadGoogleFont = isset( $attr['titleLoadGoogleFonts'] ) ? $attr['titleLoadGoogleFonts'] : '';
			$titleFontFamily      = isset( $attr['titleFontFamily'] ) ? $attr['titleFontFamily'] : '';
			$titleFontWeight      = isset( $attr['titleFontWeight'] ) ? $attr['titleFontWeight'] : '';

			$countLoadGoogleFont = isset( $attr['countLoadGoogleFonts'] ) ? $attr['countLoadGoogleFonts'] : '';
			$countFontFamily      = isset( $attr['countFontFamily'] ) ? $attr['countFontFamily'] : '';
			$countFontWeight      = isset( $attr['countFontWeight'] ) ? $attr['countFontWeight'] : '';

			$listLoadGoogleFont = isset( $attr['listLoadGoogleFonts'] ) ? $attr['listLoadGoogleFonts'] : '';
			$listFontFamily      = isset( $attr['listFontFamily'] ) ? $attr['listFontFamily'] : '';
			$listFontWeight      = isset( $attr['listFontWeight'] ) ? $attr['listFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $titleLoadGoogleFont, $titleFontFamily, $titleFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $countLoadGoogleFont, $countFontFamily, $countFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $listLoadGoogleFont, $listFontFamily, $listFontWeight );

		}

		/**
		 * Adds Google fonts for Forms block.
		 *
		 * @since 1.22.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksFormsGfont( $attr ) {

			$submitTextLoadGoogleFont = isset( $attr['submitTextloadGoogleFonts'] ) ? $attr['submitTextloadGoogleFonts'] : '';
			$submitTextFontFamily      = isset( $attr['submitTextFontFamily'] ) ? $attr['submitTextFontFamily'] : '';
			$submitTextFontWeight      = isset( $attr['submitTextFontWeight'] ) ? $attr['submitTextFontWeight'] : '';

			$labelLoadGoogleFont = isset( $attr['labelloadGoogleFonts'] ) ? $attr['labelloadGoogleFonts'] : '';
			$labelFontFamily      = isset( $attr['labelFontFamily'] ) ? $attr['labelFontFamily'] : '';
			$labelFontWeight      = isset( $attr['labelFontWeight'] ) ? $attr['labelFontWeight'] : '';

			$inputLoadGoogleFont = isset( $attr['inputloadGoogleFonts'] ) ? $attr['inputloadGoogleFonts'] : '';
			$inputFontFamily      = isset( $attr['inputFontFamily'] ) ? $attr['inputFontFamily'] : '';
			$inputFontWeight      = isset( $attr['inputFontWeight'] ) ? $attr['inputFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $submitTextLoadGoogleFont, $submitTextFontFamily, $submitTextFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $labelLoadGoogleFont, $labelFontFamily, $labelFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $inputLoadGoogleFont, $inputFontFamily, $inputFontWeight );
		}

		/**
		 * Adds Google fonts for Star Rating block.
		 *
		 * @since 2.0.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksStarRatingGfont( $attr ) {

			$loadGoogleFont = isset( $attr['loadGoogleFonts'] ) ? $attr['loadGoogleFonts'] : '';
			$fontFamily      = isset( $attr['fontFamily'] ) ? $attr['fontFamily'] : '';
			$fontWeight      = isset( $attr['fontWeight'] ) ? $attr['fontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $loadGoogleFont, $fontFamily, $fontWeight );
		}
		/**
		 * Adds Google fonts for Tabs block.
		 *
		 * @since 2.0.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksTabsGfont( $attr ) {

			$loadGoogleFont = isset( $attr['titleLoadGoogleFonts'] ) ? $attr['titleLoadGoogleFonts'] : '';
			$fontFamily      = isset( $attr['titleFontFamily'] ) ? $attr['titleFontFamily'] : '';
			$fontWeight      = isset( $attr['titleFontWeight'] ) ? $attr['titleFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $loadGoogleFont, $fontFamily, $fontWeight );
		}

		/**
		 * Adds Google fonts for Advanced Image block.
		 *
		 * @since 2.0.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksAdvancedImageGfont( $attr ) {

			$headingLoadGoogleFont = isset( $attr['headingLoadGoogleFonts'] ) ? $attr['headingLoadGoogleFonts'] : '';
			$headingFontFamily      = isset( $attr['headingFontFamily'] ) ? $attr['headingFontFamily'] : '';
			$headingFontWeight      = isset( $attr['headingFontWeight'] ) ? $attr['headingFontWeight'] : '';

			$captionLoadGoogleFont = isset( $attr['captionLoadGoogleFonts'] ) ? $attr['captionLoadGoogleFonts'] : '';
			$captionFontFamily      = isset( $attr['captionFontFamily'] ) ? $attr['captionFontFamily'] : '';
			$captionFontWeight      = isset( $attr['captionFontWeight'] ) ? $attr['captionFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $headingLoadGoogleFont, $headingFontFamily, $headingFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $captionLoadGoogleFont, $captionFontFamily, $captionFontWeight );
		}

		/**
		 * Adds Google fonts for Counter block.
		 *
		 * @since 2.1.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksCounterGfont( $attr ) {

			$headingLoadGoogleFont = isset( $attr['headingLoadGoogleFonts'] ) ? $attr['headingLoadGoogleFonts'] : '';
			$headingFontFamily      = isset( $attr['headingFontFamily'] ) ? $attr['headingFontFamily'] : '';
			$headingFontWeight      = isset( $attr['headingFontWeight'] ) ? $attr['headingFontWeight'] : '';

			$numberLoadGoogleFont = isset( $attr['numberLoadGoogleFonts'] ) ? $attr['numberLoadGoogleFonts'] : '';
			$numberFontFamily      = isset( $attr['numberFontFamily'] ) ? $attr['numberFontFamily'] : '';
			$numberFontWeight      = isset( $attr['numberFontWeight'] ) ? $attr['numberFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $headingLoadGoogleFont, $headingFontFamily, $headingFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $numberLoadGoogleFont, $numberFontFamily, $numberFontWeight );
		}

		/**
		 * Adds Google fonts for Image Gallery block.
		 *
		 * @since 2.1.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksImageGalleryGfont( $attr ) {

			$captionLoadGoogleFont = isset( $attr['captionLoadGoogleFonts'] ) ? $attr['captionLoadGoogleFonts'] : '';
			$captionFontFamily      = isset( $attr['captionFontFamily'] ) ? $attr['captionFontFamily'] : '';
			$captionFontWeight      = isset( $attr['captionFontWeight'] ) ? $attr['captionFontWeight'] : '';

			$loadMoreLoadGoogleFont = isset( $attr['loadMoreLoadGoogleFonts'] ) ? $attr['loadMoreLoadGoogleFonts'] : '';
			$loadMoreFontFamily      = isset( $attr['loadMoreFontFamily'] ) ? $attr['loadMoreFontFamily'] : '';
			$loadMoreFontWeight      = isset( $attr['loadMoreFontWeight'] ) ? $attr['loadMoreFontWeight'] : '';

			$lightboxLoadGoogleFont = isset( $attr['lightboxLoadGoogleFonts'] ) ? $attr['lightboxLoadGoogleFonts'] : '';
			$lightboxFontFamily      = isset( $attr['lightboxFontFamily'] ) ? $attr['lightboxFontFamily'] : '';
			$lightboxFontWeight      = isset( $attr['lightboxFontWeight'] ) ? $attr['lightboxFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $captionLoadGoogleFont, $captionFontFamily, $captionFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $loadMoreLoadGoogleFont, $loadMoreFontFamily, $loadMoreFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $lightboxLoadGoogleFont, $lightboxFontFamily, $lightboxFontWeight );
		}

		/**
		 * Adds Google fonts for Countdown block.
		 *
		 * @since 2.4.0
		 * @param array $attr the blocks attr.
		 * @return void
		 */
		public static function blocksCountdownGfont( $attr ) {

			$digitLoadGoogleFont = isset( $attr['digitLoadGoogleFonts'] ) ? $attr['digitLoadGoogleFonts'] : '';
			$digitFontFamily      = isset( $attr['digitFontFamily'] ) ? $attr['digitFontFamily'] : '';
			$digitFontWeight      = isset( $attr['digitFontWeight'] ) ? $attr['digitFontWeight'] : '';

			$labelLoadGoogleFont = isset( $attr['labelLoadGoogleFonts'] ) ? $attr['labelLoadGoogleFonts'] : '';
			$labelFontFamily      = isset( $attr['labelFontFamily'] ) ? $attr['labelFontFamily'] : '';
			$labelFontWeight      = isset( $attr['labelFontWeight'] ) ? $attr['labelFontWeight'] : '';

			$separatorLoadGoogleFont = isset( $attr['separatorLoadGoogleFonts'] ) ? $attr['separatorLoadGoogleFonts'] : '';
			$separatorFontFamily      = isset( $attr['separatorFontFamily'] ) ? $attr['separatorFontFamily'] : '';
			$separatorFontWeight      = isset( $attr['separatorFontWeight'] ) ? $attr['separatorFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $digitLoadGoogleFont, $digitFontFamily, $digitFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $labelLoadGoogleFont, $labelFontFamily, $labelFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $separatorLoadGoogleFont, $separatorFontFamily, $separatorFontWeight );
		}

		/**
		 * Adds Google fonts for Modal block.
		 *
		 * @since 2.2.0
		 * @param array $attr the blocks attr.
		 */
		public static function blocksModalGfont( $attr ) {

			$textLoadGoogleFont = isset( $attr['textLoadGoogleFonts'] ) ? $attr['textLoadGoogleFonts'] : '';
			$textFontFamily      = isset( $attr['textFontFamily'] ) ? $attr['textFontFamily'] : '';
			$textFontWeight      = isset( $attr['textFontWeight'] ) ? $attr['textFontWeight'] : '';

			$btnLoadGoogleFont = isset( $attr['btnLoadGoogleFonts'] ) ? $attr['btnLoadGoogleFonts'] : '';
			$btnFontFamily      = isset( $attr['btnFontFamily'] ) ? $attr['btnFontFamily'] : '';
			$btnFontWeight      = isset( $attr['btnFontWeight'] ) ? $attr['btnFontWeight'] : '';

			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $textLoadGoogleFont, $textFontFamily, $textFontWeight );
			\Vexaltrix\Core\Support\Helper::blocksGoogleFont( $btnLoadGoogleFont, $btnFontFamily, $btnFontWeight );
		}
	}
}
