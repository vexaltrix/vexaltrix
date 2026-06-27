<?php
/**
 * Vexaltrix - Contact Form 7 Designer.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Presentation\BlocksConfig\Cf7Styler;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Presentation\BlocksConfig\\Cf7Styler\\Cf7Styler' ) ) {

	/**
	 * Class \Vexaltrix\Presentation\BlocksConfig\Cf7Styler\Cf7Styler.
	 */
	class Cf7Styler {

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
			add_action( 'init', [ $this, 'registerBlocks' ] );
		}

		/**
		 * Registers the `core/latest-posts` block on server.
		 *
		 * @since 0.0.1
		 */
		public function registerBlocks() {

			// Check if the register function exists.
			if ( ! function_exists( 'register_block_type' ) ) {
				return;
			}
			$fieldBorderAttribute = [];
			$btnBorderAttribute   = [];

			if ( method_exists( 'Vexaltrix\Presentation\Blocks\\BlockHelper', 'uagGeneratePhpBorderAttribute' ) ) {

				$fieldBorderAttribute = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGeneratePhpBorderAttribute( 'input' );
				$btnBorderAttribute   = \Vexaltrix\Presentation\Blocks\BlockHelper::uagGeneratePhpBorderAttribute( 'btn' );

			}

			$enableLegacyBlocks = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_enable_legacy_blocks' );

			if ( 'yes' === $enableLegacyBlocks ) {
				register_block_type(
					'vexaltrix/cf7-styler',
					[
						'attributes'      => array_merge(
							$fieldBorderAttribute,
							$btnBorderAttribute,
							[
								'block_id'                 => [
									'type' => 'string',
								],
								'align'                    => [
									'type'    => 'string',
									'default' => 'left',
								],
								'className'                => [
									'type' => 'string',
								],
								'formId'                   => [
									'type'    => 'string',
									'default' => '0',
								],
								'isHtml'                   => [
									'type' => 'boolean',
								],
								'formJson'                 => [
									'type'    => 'object',
									'default' => null,
								],
								'fieldStyle'               => [
									'type'    => 'string',
									'default' => 'box',
								],
								'fieldVrPadding'           => [
									'type'    => 'number',
									'default' => 10,
								],
								'fieldHrPadding'           => [
									'type'    => 'number',
									'default' => 10,
								],
								'fieldBgColor'             => [
									'type'    => 'string',
									'default' => '#fafafa',
								],
								'fieldLabelColor'          => [
									'type'    => 'string',
									'default' => '#333',
								],
								'fieldInputColor'          => [
									'type'    => 'string',
									'default' => '#333',
								],
								'buttonAlignment'          => [
									'type'    => 'string',
									'default' => 'left',
								],
								'buttonAlignmentTablet'    => [
									'type'    => 'string',
									'default' => '',
								],
								'buttonAlignmentMobile'    => [
									'type'    => 'string',
									'default' => '',
								],
								'buttonVrPadding'          => [
									'type'    => 'number',
									'default' => 10,
								],
								'buttonHrPadding'          => [
									'type'    => 'number',
									'default' => 25,
								],
								'buttonTextColor'          => [
									'type'    => 'string',
									'default' => '#333',
								],
								'buttonBgColor'            => [
									'type'    => 'string',
									'default' => '',
								],
								'buttonTextHoverColor'     => [
									'type'    => 'string',
									'default' => '#333',
								],
								'buttonBgHoverColor'       => [
									'type'    => 'string',
									'default' => '',
								],
								'fieldSpacing'             => [
									'type'    => 'number',
									'default' => '',
								],
								'fieldSpacingTablet'       => [
									'type' => 'number',
								],
								'fieldSpacingMobile'       => [
									'type' => 'number',
								],
								'fieldLabelSpacing'        => [
									'type'    => 'number',
									'default' => '',
								],
								'fieldLabelSpacingTablet'  => [
									'type' => 'number',
								],
								'fieldLabelSpacingMobile'  => [
									'type' => 'number',
								],
								'labelFontSize'            => [
									'type'    => 'number',
									'default' => '',
								],
								'labelFontSizeType'        => [
									'type'    => 'string',
									'default' => 'px',
								],
								'labelFontSizeTablet'      => [
									'type' => 'number',
								],
								'labelFontSizeMobile'      => [
									'type' => 'number',
								],
								'labelFontFamily'          => [
									'type'    => 'string',
									'default' => 'Default',
								],
								'labelFontWeight'          => [
									'type' => 'string',
								],
								'labelLineHeightType'      => [
									'type'    => 'string',
									'default' => 'em',
								],
								'labelLineHeight'          => [
									'type' => 'number',
								],
								'labelLineHeightTablet'    => [
									'type' => 'number',
								],
								'labelLineHeightMobile'    => [
									'type' => 'number',
								],
								'labelLoadGoogleFonts'     => [
									'type'    => 'boolean',
									'default' => false,
								],
								'inputFontSize'            => [
									'type'    => 'number',
									'default' => '',
								],
								'inputFontSizeType'        => [
									'type'    => 'string',
									'default' => 'px',
								],
								'inputFontSizeTablet'      => [
									'type' => 'number',
								],
								'inputFontSizeMobile'      => [
									'type' => 'number',
								],
								'inputFontFamily'          => [
									'type'    => 'string',
									'default' => 'Default',
								],
								'inputFontWeight'          => [
									'type' => 'string',
								],
								'inputLineHeightType'      => [
									'type'    => 'string',
									'default' => 'em',
								],
								'inputLineHeight'          => [
									'type' => 'number',
								],
								'inputLineHeightTablet'    => [
									'type' => 'number',
								],
								'inputLineHeightMobile'    => [
									'type' => 'number',
								],
								'inputLoadGoogleFonts'     => [
									'type'    => 'boolean',
									'default' => false,
								],
								'buttonFontSize'           => [
									'type'    => 'number',
									'default' => '',
								],
								'buttonFontSizeType'       => [
									'type'    => 'string',
									'default' => 'px',
								],
								'buttonFontSizeTablet'     => [
									'type' => 'number',
								],
								'buttonFontSizeMobile'     => [
									'type' => 'number',
								],
								'buttonFontFamily'         => [
									'type'    => 'string',
									'default' => 'Default',
								],
								'buttonFontWeight'         => [
									'type' => 'string',
								],
								'buttonLineHeightType'     => [
									'type'    => 'string',
									'default' => 'em',
								],
								'buttonLineHeight'         => [
									'type' => 'number',
								],
								'buttonLineHeightTablet'   => [
									'type' => 'number',
								],
								'buttonLineHeightMobile'   => [
									'type' => 'number',
								],
								'buttonLoadGoogleFonts'    => [
									'type'    => 'boolean',
									'default' => false,
								],
								'enableOveride'            => [
									'type'    => 'boolean',
									'default' => true,
								],
								'radioCheckSize'           => [
									'type'    => 'number',
									'default' => '',
								],
								'radioCheckSizeTablet'     => [
									'type' => 'number',
								],
								'radioCheckSizeMobile'     => [
									'type' => 'number',
								],
								'radioCheckBgColor'        => [
									'type'    => 'string',
									'default' => '',
								],
								'radioCheckSelectColor'    => [
									'type'    => 'string',
									'default' => '',
								],
								'radioCheckLableColor'     => [
									'type'    => 'string',
									'default' => '',
								],
								'radioCheckBorderColor'    => [
									'type'    => 'string',
									'default' => '#abb8c3',
								],
								'radioCheckBorderWidth'    => [
									'type'    => 'number',
									'default' => '',
								],
								'radioCheckBorderWidthTablet' => [
									'type'    => 'number',
									'default' => '1',
								],
								'radioCheckBorderWidthMobile' => [
									'type'    => 'number',
									'default' => '1',
								],
								'radioCheckBorderWidthUnit' => [
									'type'    => 'string',
									'default' => 'px',
								],
								'radioCheckBorderRadius'   => [
									'type'    => 'number',
									'default' => '',
								],
								'radioCheckFontSize'       => [
									'type'    => 'number',
									'default' => '',
								],
								'radioCheckFontSizeType'   => [
									'type'    => 'string',
									'default' => 'px',
								],
								'radioCheckFontSizeTablet' => [
									'type' => 'number',
								],
								'radioCheckFontSizeMobile' => [
									'type' => 'number',
								],
								'radioCheckFontFamily'     => [
									'type'    => 'string',
									'default' => 'Default',
								],
								'radioCheckFontWeight'     => [
									'type' => 'string',
								],
								'radioCheckLineHeightType' => [
									'type'    => 'string',
									'default' => 'em',
								],
								'radioCheckLineHeight'     => [
									'type' => 'number',
								],
								'radioCheckLineHeightTablet' => [
									'type' => 'number',
								],
								'radioCheckLineHeightMobile' => [
									'type' => 'number',
								],
								'radioCheckLoadGoogleFonts' => [
									'type'    => 'boolean',
									'default' => false,
								],
								'validationMsgPosition'    => [
									'type'    => 'string',
									'default' => 'default',
								],
								'validationMsgColor'       => [
									'type'    => 'string',
									'default' => '#ff0000',
								],
								'validationMsgBgColor'     => [
									'type'    => 'string',
									'default' => '',
								],
								'enableHighlightBorder'    => [
									'type'    => 'boolean',
									'default' => false,
								],
								'highlightBorderColor'     => [
									'type'    => 'string',
									'default' => '#ff0000',
								],
								'validationMsgFontSize'    => [
									'type'    => 'number',
									'default' => '',
								],
								'validationMsgFontSizeType' => [
									'type'    => 'string',
									'default' => 'px',
								],
								'validationMsgFontSizeTablet' => [
									'type' => 'number',
								],
								'validationMsgFontSizeMobile' => [
									'type' => 'number',
								],
								'validationMsgFontFamily'  => [
									'type'    => 'string',
									'default' => 'Default',
								],
								'validationMsgFontWeight'  => [
									'type' => 'string',
								],
								'validationMsgLineHeightType' => [
									'type'    => 'string',
									'default' => 'em',
								],
								'validationMsgLineHeight'  => [
									'type' => 'number',
								],
								'validationMsgLineHeightTablet' => [
									'type' => 'number',
								],
								'validationMsgLineHeightMobile' => [
									'type' => 'number',
								],
								'validationMsgLoadGoogleFonts' => [
									'type'    => 'boolean',
									'default' => false,
								],
								'successMsgColor'          => [
									'type'    => 'string',
									'default' => '',
								],
								'successMsgBgColor'        => [
									'type'    => 'string',
									'default' => '',
								],
								'successMsgBorderColor'    => [
									'type'    => 'string',
									'default' => '',
								],
								'errorMsgColor'            => [
									'type'    => 'string',
									'default' => '',
								],
								'errorMsgBgColor'          => [
									'type'    => 'string',
									'default' => '',
								],
								'errorMsgBorderColor'      => [
									'type'    => 'string',
									'default' => '',
								],
								'msgBorderSize'            => [
									'type'    => 'number',
									'default' => '',
								],
								'msgBorderSizeUnit'        => [
									'type'    => 'string',
									'default' => 'px',
								],
								'msgBorderRadius'          => [
									'type'    => 'number',
									'default' => '',
								],
								'msgVrPadding'             => [
									'type'    => 'number',
									'default' => '',
								],
								'msgHrPadding'             => [
									'type'    => 'number',
									'default' => '',
								],
								'msgFontSize'              => [
									'type'    => 'number',
									'default' => '',
								],
								'msgFontSizeType'          => [
									'type'    => 'string',
									'default' => 'px',
								],
								'msgFontSizeTablet'        => [
									'type' => 'number',
								],
								'msgFontSizeMobile'        => [
									'type' => 'number',
								],
								'msgFontFamily'            => [
									'type'    => 'string',
									'default' => 'Default',
								],
								'msgFontWeight'            => [
									'type' => 'string',
								],
								'msgLineHeightType'        => [
									'type'    => 'string',
									'default' => 'em',
								],
								'msgLineHeight'            => [
									'type' => 'number',
								],
								'msgLineHeightTablet'      => [
									'type' => 'number',
								],
								'msgLineHeightMobile'      => [
									'type' => 'number',
								],
								'msgLoadGoogleFonts'       => [
									'type'    => 'boolean',
									'default' => false,
								],
								'radioCheckBorderRadiusType' => [
									'type'    => 'string',
									'default' => 'px',
								],
								'msgBorderRadiusType'      => [
									'type'    => 'string',
									'default' => 'px',
								],
								'fieldBorderRadiusType'    => [
									'type'    => 'string',
									'default' => 'px',
								],
								'buttonBorderRadiusType'   => [
									'type'    => 'string',
									'default' => 'px',
								],
								'messageTopPaddingDesktop' => [
									'type' => 'number',
								],
								'messageBottomPaddingDesktop' => [
									'type' => 'number',
								],
								'messageLeftPaddingDesktop' => [
									'type' => 'number',
								],
								'messageRightPaddingDesktop' => [
									'type' => 'number',
								],

								'messageTopPaddingTablet'  => [
									'type' => 'number',
								],
								'messageBottomPaddingTablet' => [
									'type' => 'number',
								],
								'messageLeftPaddingTablet' => [
									'type' => 'number',
								],
								'messageRightPaddingTablet' => [
									'type' => 'number',
								],

								'messageTopPaddingMobile'  => [
									'type' => 'number',
								],
								'messageBottomPaddingMobile' => [
									'type' => 'number',
								],
								'messageLeftPaddingMobile' => [
									'type' => 'number',
								],
								'messageRightPaddingMobile' => [
									'type' => 'number',
								],
								'messagePaddingTypeDesktop' => [
									'type'    => 'string',
									'default' => 'px',
								],
								'messageSpacingLink'       => [
									'type'    => 'boolean',
									'default' => false,
								],

								'buttonTopPaddingDesktop'  => [
									'type' => 'number',
								],
								'buttonBottomPaddingDesktop' => [
									'type' => 'number',
								],
								'buttonLeftPaddingDesktop' => [
									'type' => 'number',
								],
								'buttonRightPaddingDesktop' => [
									'type' => 'number',
								],

								'buttonTopPaddingTablet'   => [
									'type' => 'number',
								],
								'buttonBottomPaddingTablet' => [
									'type' => 'number',
								],
								'buttonLeftPaddingTablet'  => [
									'type' => 'number',
								],
								'buttonRightPaddingTablet' => [
									'type' => 'number',
								],

								'buttonTopPaddingMobile'   => [
									'type' => 'number',
								],
								'buttonBottomPaddingMobile' => [
									'type' => 'number',
								],
								'buttonLeftPaddingMobile'  => [
									'type' => 'number',
								],
								'buttonRightPaddingMobile' => [
									'type' => 'number',
								],
								'buttonPaddingTypeDesktop' => [
									'type'    => 'string',
									'default' => 'px',
								],
								'buttonPaddingTypeTablet'  => [
									'type'    => 'string',
									'default' => 'px',
								],
								'buttonPaddingTypeMobile'  => [
									'type'    => 'string',
									'default' => 'px',
								],
								'buttonSpacingLink'        => [
									'type'    => 'boolean',
									'default' => false,
								],

								'fieldTopPaddingDesktop'   => [
									'type' => 'number',
								],
								'fieldBottomPaddingDesktop' => [
									'type' => 'number',
								],
								'fieldLeftPaddingDesktop'  => [
									'type' => 'number',
								],
								'fieldRightPaddingDesktop' => [
									'type' => 'number',
								],

								'fieldTopPaddingTablet'    => [
									'type' => 'number',
								],
								'fieldBottomPaddingTablet' => [
									'type' => 'number',
								],
								'fieldLeftPaddingTablet'   => [
									'type' => 'number',
								],
								'fieldRightPaddingTablet'  => [
									'type' => 'number',
								],

								'fieldTopPaddingMobile'    => [
									'type' => 'number',
								],
								'fieldBottomPaddingMobile' => [
									'type' => 'number',
								],
								'fieldLeftPaddingMobile'   => [
									'type' => 'number',
								],
								'fieldRightPaddingMobile'  => [
									'type' => 'number',
								],
								'fieldPaddingTypeDesktop'  => [
									'type'    => 'string',
									'default' => 'px',
								],
								'fieldPaddingTypeTablet'   => [
									'type'    => 'string',
									'default' => 'px',
								],
								'fieldPaddingTypeMobile'   => [
									'type'    => 'string',
									'default' => 'px',
								],
								'fieldSpacingLink'         => [
									'type'    => 'boolean',
									'default' => false,
								],
								'labelTransform'           => [
									'type' => 'string',
								],
								'labelDecoration'          => [
									'type' => 'string',
								],
								'labelFontStyle'           => [
									'type' => 'string',
								],
								'inputTransform'           => [
									'type' => 'string',
								],
								'inputDecoration'          => [
									'type' => 'string',
								],
								'inputFontStyle'           => [
									'type' => 'string',
								],
								'buttonTransform'          => [
									'type' => 'string',
								],
								'buttonDecoration'         => [
									'type' => 'string',
								],
								'buttonFontStyle'          => [
									'type' => 'string',
								],
								'radioCheckTransform'      => [
									'type' => 'string',
								],
								'radioCheckDecoration'     => [
									'type' => 'string',
								],
								'radioCheckFontStyle'      => [
									'type' => 'string',
								],
								'validationMsgTransform'   => [
									'type' => 'string',
								],
								'validationMsgDecoration'  => [
									'type' => 'string',
								],
								'validationMsgFontStyle'   => [
									'type' => 'string',
								],
								'msgTransform'             => [
									'type' => 'string',
								],
								'msgDecoration'            => [
									'type' => 'string',
								],
								'msgFontStyle'             => [
									'type' => 'string',
								],
								'isPreview'                => [
									'type'    => 'boolean',
									'default' => false,
								],

								'labelLetterSpacing'       => [
									'type'    => 'number',
									'default' => '',
								],
								'labelLetterSpacingType'   => [
									'type'    => 'string',
									'default' => 'px',
								],
								'labelLetterSpacingMobile' => [
									'type' => 'number',
								],
								'labelLetterSpacingTablet' => [
									'type' => 'number',
								],
								'inputLetterSpacing'       => [
									'type'    => 'number',
									'default' => '',
								],
								'inputLetterSpacingType'   => [
									'type'    => 'string',
									'default' => 'px',
								],
								'inputLetterSpacingMobile' => [
									'type' => 'number',
								],
								'inputLetterSpacingTablet' => [
									'type' => 'number',
								],
								'buttonLetterSpacing'      => [
									'type'    => 'number',
									'default' => '',
								],
								'buttonLetterSpacingType'  => [
									'type'    => 'string',
									'default' => 'px',
								],
								'buttonLetterSpacingMobile' => [
									'type' => 'number',
								],
								'buttonLetterSpacingTablet' => [
									'type' => 'number',
								],
								'radioCheckLetterSpacing'  => [
									'type'    => 'number',
									'default' => '',
								],
								'radioCheckLetterSpacingType' => [
									'type'    => 'string',
									'default' => 'px',
								],
								'radioCheckLetterSpacingMobile' => [
									'type' => 'number',
								],
								'radioCheckLetterSpacingTablet' => [
									'type' => 'number',
								],
								'validationMsgLetterSpacing' => [
									'type'    => 'number',
									'default' => '',
								],
								'validationMsgLetterSpacingType' => [
									'type'    => 'string',
									'default' => 'px',
								],
								'validationMsgLetterSpacingMobile' => [
									'type' => 'number',
								],
								'validationMsgLetterSpacingTablet' => [
									'type' => 'number',
								],

								'msgLetterSpacing'         => [
									'type'    => 'number',
									'default' => '',
								],
								'msgLetterSpacingType'     => [
									'type'    => 'string',
									'default' => 'px',
								],
								'msgLetterSpacingMobile'   => [
									'type' => 'number',
								],
								'msgLetterSpacingTablet'   => [
									'type' => 'number',
								],
								'fieldBorderStyle'         => [
									'type'    => 'string',
									'default' => 'solid',
								],
								'fieldBorderWidth'         => [
									'type'    => 'number',
									'default' => 1,
								],
								'fieldBorderRadius'        => [
									'type'    => 'number',
									'default' => 0,
								],
								'fieldBorderColor'         => [
									'type'    => 'string',
									'default' => '#eeeeee',
								],
								'fieldBorderFocusColor'    => [
									'type'    => 'string',
									'default' => '',
								],
								'buttonBorderStyle'        => [
									'type'    => 'string',
									'default' => 'solid',
								],
								'buttonBorderWidth'        => [
									'type'    => 'number',
									'default' => 1,
								],
								'buttonBorderRadius'       => [
									'type'    => 'number',
									'default' => 0,
								],
								'buttonBorderColor'        => [
									'type'    => 'string',
									'default' => '#333',
								],
								'buttonBorderHoverColor'   => [
									'type'    => 'string',
									'default' => '#333',
								],
							]
						),
						'renderCallback' => [ $this, 'renderHtml' ],
					]
				);
			}

		}

		/**
		 * Render CF7 HTML.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 1.10.0
		 */
		public function renderHtml( $attributes ) {

			$form = $attributes['formId'];

			$classes = [
				'vxt-cf7-styler__align-' . $attributes['align'],
				'vxt-cf7-styler__field-style-' . $attributes['fieldStyle'],
				'vxt-cf7-styler__btn-align-' . $attributes['buttonAlignment'],
				'vxt-cf7-styler__btn-align-tablet-' . $attributes['buttonAlignmentTablet'],
				'vxt-cf7-styler__btn-align-mobile-' . $attributes['buttonAlignmentMobile'],
				'vxt-cf7-styler__highlight-style-' . $attributes['validationMsgPosition'],
			];

			if ( $attributes['enableOveride'] ) {
				$classes[] = 'vxt-cf7-styler__check-style-enabled';
			}

			if ( $attributes['enableHighlightBorder'] ) {
				$classes[] = 'vxt-cf7-styler__highlight-border';
			}
			$desktopClass = '';
			$tabClass     = '';
			$mobClass     = '';

			if ( array_key_exists( 'UAGHideDesktop', $attributes ) || array_key_exists( 'UAGHideTab', $attributes ) || array_key_exists( 'UAGHideMob', $attributes ) ) {

				$desktopClass = ( isset( $attributes['UAGHideDesktop'] ) ) ? 'uag-hide-desktop' : '';

				$tabClass = ( isset( $attributes['UAGHideTab'] ) ) ? 'uag-hide-tab' : '';

				$mobClass = ( isset( $attributes['UAGHideMob'] ) ) ? 'uag-hide-mob' : '';
			}

			$mainClasses = [
				'wp-block-vxt-cf7-styler',
				'vxt-cf7-styler__outer-wrap',
				'vxt-block-' . $attributes['block_id'],
				$desktopClass,
				$tabClass,
				$mobClass,
			];

			if ( isset( $attributes['className'] ) ) {
				$mainClasses[] = $attributes['className'];
			}

			ob_start();
			if ( $form && 0 !== $form && -1 !== $form ) {
				?>
				<div class = "<?php echo esc_attr( implode( ' ', $mainClasses ) ); ?>">
					<div class = "<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<?php echo do_shortcode( '[contact-form-7 id="' . $form . '"]' ); ?>
					</div>
				</div>
				<?php
			}
			return ob_get_clean();
		}
	}

	/**
	 *  Prepare if class 'Vexaltrix\Presentation\BlocksConfig\\Cf7Styler\\Cf7Styler' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
