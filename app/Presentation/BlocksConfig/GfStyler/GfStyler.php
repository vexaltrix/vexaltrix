<?php
/**
 * Vexaltrix - Gravity Form Styler.
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Presentation\BlocksConfig\GfStyler;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Presentation\BlocksConfig\\GfStyler\\GfStyler' ) ) {

	/**
	 * Class \Vexaltrix\Presentation\BlocksConfig\GfStyler\GfStyler.
	 */
	class GfStyler {

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

			$enableLegacyBlocks = \Vexaltrix\Presentation\Admin\AdminSettings::get( 'uag_enable_legacy_blocks' );

			if ( 'yes' === $enableLegacyBlocks ) {
				register_block_type(
					'vexaltrix/gf-styler',
					[
						'attributes'      => [
							'block_id'                     => [
								'type' => 'string',
							],
							'align'                        => [
								'type'    => 'string',
								'default' => 'left',
							],
							'className'                    => [
								'type' => 'string',
							],
							'formId'                       => [
								'type'    => 'string',
								'default' => '0',
							],
							'isHtml'                       => [
								'type' => 'boolean',
							],
							'formJson'                     => [
								'type'    => 'object',
								'default' => null,
							],
							'enableAjax'                   => [
								'type'    => 'boolean',
								'default' => false,
							],
							'enableTabSupport'             => [
								'type'    => 'boolean',
								'default' => false,
							],
							'formTabIndex'                 => [
								'type'    => 'number',
								'default' => 0,
							],
							'titleDescStyle'               => [
								'type'    => 'string',
								'default' => 'yes',
							],
							'titleDescAlignment'           => [
								'type'    => 'string',
								'default' => 'left',
							],
							'fieldStyle'                   => [
								'type'    => 'string',
								'default' => 'box',
							],
							'fieldVrPadding'               => [
								'type'    => 'number',
								'default' => 10,
							],
							'fieldHrPadding'               => [
								'type'    => 'number',
								'default' => 10,
							],
							'fieldBgColor'                 => [
								'type'    => 'string',
								'default' => '#fafafa',
							],
							'fieldLabelColor'              => [
								'type'    => 'string',
								'default' => '#333',
							],
							'fieldInputColor'              => [
								'type'    => 'string',
								'default' => '#333',
							],
							'fieldBorderStyle'             => [
								'type'    => 'string',
								'default' => 'solid',
							],
							'fieldBorderWidth'             => [
								'type'    => 'number',
								'default' => 1,
							],
							'fieldBorderWidthTablet'       => [
								'type' => 'number',
							],
							'fieldBorderWidthMobile'       => [
								'type' => 'number',
							],
							'fieldBorderWidthType'         => [
								'type'    => 'string',
								'default' => 'px',
							],
							'fieldBorderRadius'            => [
								'type'    => 'number',
								'default' => 0,
							],
							'fieldBorderColor'             => [
								'type'    => 'string',
								'default' => '#eeeeee',
							],
							'fieldBorderFocusColor'        => [
								'type'    => 'string',
								'default' => '',
							],
							'buttonAlignment'              => [
								'type'    => 'string',
								'default' => 'left',
							],
							'buttonAlignmentTablet'        => [
								'type'    => 'string',
								'default' => '',
							],
							'buttonAlignmentMobile'        => [
								'type'    => 'string',
								'default' => '',
							],
							'buttonVrPadding'              => [
								'type'    => 'number',
								'default' => 10,
							],
							'buttonHrPadding'              => [
								'type'    => 'number',
								'default' => 25,
							],
							'buttonBorderStyle'            => [
								'type'    => 'string',
								'default' => 'solid',
							],
							'buttonBorderWidth'            => [
								'type'    => 'number',
								'default' => 1,
							],
							'buttonBorderWidthTablet'      => [
								'type' => 'number',
							],
							'buttonBorderWidthMobile'      => [
								'type' => 'number',
							],
							'buttonBorderWidthType'        => [
								'type'    => 'string',
								'default' => 'px',
							],
							'buttonBorderRadius'           => [
								'type'    => 'number',
								'default' => 0,
							],
							'buttonBorderColor'            => [
								'type'    => 'string',
								'default' => '#333',
							],
							'buttonTextColor'              => [
								'type'    => 'string',
								'default' => '#333',
							],
							'buttonBgColor'                => [
								'type' => 'string',
							],
							'buttonBorderHoverColor'       => [
								'type'    => 'string',
								'default' => '#333',
							],
							'buttonTextHoverColor'         => [
								'type'    => 'string',
								'default' => '#333',
							],
							'buttonBgHoverColor'           => [
								'type' => 'string',
							],
							'fieldSpacing'                 => [
								'type'    => 'number',
								'default' => '',
							],
							'fieldSpacingTablet'           => [
								'type' => 'number',
							],
							'fieldSpacingMobile'           => [
								'type' => 'number',
							],
							'fieldLabelSpacing'            => [
								'type'    => 'number',
								'default' => '',
							],
							'fieldLabelSpacingTablet'      => [
								'type' => 'number',
							],
							'fieldLabelSpacingMobile'      => [
								'type' => 'number',
							],
							'enableLabel'                  => [
								'type'    => 'boolean',
								'default' => false,
							],
							'labelFontSize'                => [
								'type'    => 'number',
								'default' => '',
							],
							'labelFontSizeType'            => [
								'type'    => 'string',
								'default' => 'px',
							],
							'labelFontSizeTablet'          => [
								'type' => 'number',
							],
							'labelFontSizeMobile'          => [
								'type' => 'number',
							],
							'labelFontFamily'              => [
								'type'    => 'string',
								'default' => 'Default',
							],
							'labelFontWeight'              => [
								'type' => 'string',
							],
							'labelLineHeightType'          => [
								'type'    => 'string',
								'default' => 'em',
							],
							'labelLineHeight'              => [
								'type' => 'number',
							],
							'labelLineHeightTablet'        => [
								'type' => 'number',
							],
							'labelLineHeightMobile'        => [
								'type' => 'number',
							],
							'labelLoadGoogleFonts'         => [
								'type'    => 'boolean',
								'default' => false,
							],
							'inputFontSize'                => [
								'type'    => 'number',
								'default' => '',
							],
							'inputFontSizeType'            => [
								'type'    => 'string',
								'default' => 'px',
							],
							'inputFontSizeTablet'          => [
								'type' => 'number',
							],
							'inputFontSizeMobile'          => [
								'type' => 'number',
							],
							'inputFontFamily'              => [
								'type'    => 'string',
								'default' => 'Default',
							],
							'inputFontWeight'              => [
								'type' => 'string',
							],
							'inputLineHeightType'          => [
								'type'    => 'string',
								'default' => 'em',
							],
							'inputLineHeight'              => [
								'type' => 'number',
							],
							'inputLineHeightTablet'        => [
								'type' => 'number',
							],
							'inputLineHeightMobile'        => [
								'type' => 'number',
							],
							'inputLoadGoogleFonts'         => [
								'type'    => 'boolean',
								'default' => false,
							],
							'textAreaHeight'               => [
								'type'    => 'number',
								'default' => 'auto',
							],
							'textAreaHeightTablet'         => [
								'type' => 'number',
							],
							'textAreaHeightMobile'         => [
								'type' => 'number',
							],
							'buttonFontSize'               => [
								'type'    => 'number',
								'default' => '',
							],
							'buttonFontSizeType'           => [
								'type'    => 'string',
								'default' => 'px',
							],
							'buttonFontSizeTablet'         => [
								'type' => 'number',
							],
							'buttonFontSizeMobile'         => [
								'type' => 'number',
							],
							'buttonFontFamily'             => [
								'type'    => 'string',
								'default' => 'Default',
							],
							'buttonFontWeight'             => [
								'type' => 'string',
							],
							'buttonLineHeightType'         => [
								'type'    => 'string',
								'default' => 'em',
							],
							'buttonLineHeight'             => [
								'type' => 'number',
							],
							'buttonLineHeightTablet'       => [
								'type' => 'number',
							],
							'buttonLineHeightMobile'       => [
								'type' => 'number',
							],
							'buttonLoadGoogleFonts'        => [
								'type'    => 'boolean',
								'default' => false,
							],
							'enableOveride'                => [
								'type'    => 'boolean',
								'default' => true,
							],
							'radioCheckSize'               => [
								'type'    => 'number',
								'default' => '20',
							],
							'radioCheckSizeTablet'         => [
								'type' => 'number',
							],
							'radioCheckSizeMobile'         => [
								'type' => 'number',
							],
							'radioCheckBgColor'            => [
								'type'    => 'string',
								'default' => '#fafafa',
							],
							'radioCheckSelectColor'        => [
								'type'    => 'string',
								'default' => '',
							],
							'radioCheckLableColor'         => [
								'type'    => 'string',
								'default' => '',
							],
							'radioCheckBorderColor'        => [
								'type'    => 'string',
								'default' => '#cbcbcb',
							],
							'radioCheckBorderWidth'        => [
								'type'    => 'number',
								'default' => '1',
							],
							'radioCheckBorderWidthTablet'  => [
								'type' => 'number',
							],
							'radioCheckBorderWidthMobile'  => [
								'type' => 'number',
							],
							'radioCheckBorderWidthType'    => [
								'type'    => 'string',
								'default' => 'px',
							],
							'radioCheckBorderRadius'       => [
								'type'    => 'number',
								'default' => '',
							],
							'radioCheckFontSize'           => [
								'type'    => 'number',
								'default' => '',
							],
							'radioCheckFontSizeType'       => [
								'type'    => 'string',
								'default' => 'px',
							],
							'radioCheckFontSizeTablet'     => [
								'type' => 'number',
							],
							'radioCheckFontSizeMobile'     => [
								'type' => 'number',
							],
							'radioCheckFontFamily'         => [
								'type'    => 'string',
								'default' => 'Default',
							],
							'radioCheckFontWeight'         => [
								'type' => 'string',
							],
							'radioCheckLineHeightType'     => [
								'type'    => 'string',
								'default' => 'em',
							],
							'radioCheckLineHeight'         => [
								'type' => 'number',
							],
							'radioCheckLineHeightTablet'   => [
								'type' => 'number',
							],
							'radioCheckLineHeightMobile'   => [
								'type' => 'number',
							],
							'radioCheckLoadGoogleFonts'    => [
								'type'    => 'boolean',
								'default' => false,
							],
							'validationMsgColor'           => [
								'type'    => 'string',
								'default' => '#ff0000',
							],
							'validationMsgBgColor'         => [
								'type'    => 'string',
								'default' => '',
							],
							'advancedValidationSettings'   => [
								'type'    => 'boolean',
								'default' => false,
							],
							'highlightBorderColor'         => [
								'type'    => 'string',
								'default' => '#ff0000',
							],
							'validationMsgFontSize'        => [
								'type'    => 'number',
								'default' => '',
							],
							'validationMsgFontSizeType'    => [
								'type'    => 'string',
								'default' => 'px',
							],
							'validationMsgFontSizeTablet'  => [
								'type' => 'number',
							],
							'validationMsgFontSizeMobile'  => [
								'type' => 'number',
							],
							'validationMsgFontFamily'      => [
								'type'    => 'string',
								'default' => 'Default',
							],
							'validationMsgFontWeight'      => [
								'type' => 'string',
							],
							'validationMsgLineHeightType'  => [
								'type'    => 'string',
								'default' => 'em',
							],
							'validationMsgLineHeight'      => [
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
							'successMsgColor'              => [
								'type'    => 'string',
								'default' => '',
							],
							'errorMsgColor'                => [
								'type'    => 'string',
								'default' => '',
							],
							'errorMsgBgColor'              => [
								'type'    => 'string',
								'default' => '',
							],
							'errorMsgBorderColor'          => [
								'type'    => 'string',
								'default' => '',
							],
							'msgBorderSize'                => [
								'type'    => 'number',
								'default' => '',
							],
							'msgBorderSizeType'            => [
								'type'    => 'string',
								'default' => 'px',
							],
							'msgBorderRadius'              => [
								'type'    => 'number',
								'default' => '',
							],
							'msgVrPadding'                 => [
								'type'    => 'number',
								'default' => '',
							],
							'msgHrPadding'                 => [
								'type'    => 'number',
								'default' => '',
							],
							'msgFontSize'                  => [
								'type'    => 'number',
								'default' => '',
							],
							'msgFontSizeType'              => [
								'type'    => 'string',
								'default' => 'px',
							],
							'msgFontSizeTablet'            => [
								'type' => 'number',
							],
							'msgFontSizeMobile'            => [
								'type' => 'number',
							],
							'msgFontFamily'                => [
								'type'    => 'string',
								'default' => 'Default',
							],
							'msgFontWeight'                => [
								'type' => 'string',
							],
							'msgLineHeightType'            => [
								'type'    => 'string',
								'default' => 'em',
							],
							'msgLineHeight'                => [
								'type' => 'number',
							],
							'msgLineHeightTablet'          => [
								'type' => 'number',
							],
							'msgLineHeightMobile'          => [
								'type' => 'number',
							],
							'msgLoadGoogleFonts'           => [
								'type'    => 'boolean',
								'default' => false,
							],
							'radioCheckBorderRadiusType'   => [
								'type'    => 'string',
								'default' => 'px',
							],
							'msgBorderRadiusType'          => [
								'type'    => 'string',
								'default' => 'px',
							],
							'fieldBorderRadiusType'        => [
								'type'    => 'string',
								'default' => 'px',
							],
							'buttonBorderRadiusType'       => [
								'type'    => 'string',
								'default' => 'px',
							],
							'successMsgFontSize'           => [
								'type'    => 'number',
								'default' => '',
							],
							'successMsgFontSizeType'       => [
								'type'    => 'string',
								'default' => 'px',
							],
							'successMsgFontSizeTablet'     => [
								'type' => 'number',
							],
							'successMsgFontSizeMobile'     => [
								'type' => 'number',
							],
							'successMsgFontFamily'         => [
								'type'    => 'string',
								'default' => 'Default',
							],
							'successMsgFontWeight'         => [
								'type' => 'string',
							],
							'successMsgLineHeightType'     => [
								'type'    => 'string',
								'default' => 'em',
							],
							'successMsgLineHeight'         => [
								'type' => 'number',
							],
							'successMsgLineHeightTablet'   => [
								'type' => 'number',
							],
							'successMsgLineHeightMobile'   => [
								'type' => 'number',
							],
							'successMsgLoadGoogleFonts'    => [
								'type'    => 'boolean',
								'default' => false,
							],
							'msgleftPadding'               => [
								'type'    => 'number',
								'default' => '',
							],
							'msgrightPadding'              => [
								'type'    => 'number',
								'default' => '',
							],
							'msgtopPadding'                => [
								'type'    => 'number',
								'default' => '',
							],
							'msgbottomPadding'             => [
								'type'    => 'number',
								'default' => '',
							],
							'msgleftMobilePadding'         => [
								'type'    => 'number',
								'default' => '',
							],
							'msgrightMobilePadding'        => [
								'type'    => 'number',
								'default' => '',
							],
							'msgtopMobilePadding'          => [
								'type'    => 'number',
								'default' => '',
							],
							'msgbottomMobilePadding'       => [
								'type'    => 'number',
								'default' => '',
							],
							'msgleftTabletPadding'         => [
								'type'    => 'number',
								'default' => '',
							],
							'msgrightTabletPadding'        => [
								'type'    => 'number',
								'default' => '',
							],
							'msgtopTabletPadding'          => [
								'type'    => 'number',
								'default' => '',
							],
							'msgbottomTabletPadding'       => [
								'type'    => 'number',
								'default' => '',
							],
							'msgtabletPaddingUnit'         => [
								'type'    => 'string',
								'default' => 'px',
							],
							'msgmobilePaddingUnit'         => [
								'type'    => 'string',
								'default' => 'px',
							],
							'msgpaddingUnit'               => [
								'type'    => 'string',
								'default' => 'px',
							],
							'msgpaddingLink'               => [
								'type'    => 'boolean',
								'default' => false,
							],
							'buttonleftPadding'            => [
								'type' => 'number',
							],
							'buttonrightPadding'           => [
								'type' => 'number',
							],
							'buttontopPadding'             => [
								'type' => 'number',
							],
							'buttonbottomPadding'          => [
								'type' => 'number',
							],
							'buttonleftMobilePadding'      => [
								'type'    => 'number',
								'default' => '',
							],
							'buttonrightMobilePadding'     => [
								'type'    => 'number',
								'default' => '',
							],
							'buttontopMobilePadding'       => [
								'type'    => 'number',
								'default' => '',
							],
							'buttonbottomMobilePadding'    => [
								'type'    => 'number',
								'default' => '',
							],
							'buttonleftTabletPadding'      => [
								'type'    => 'number',
								'default' => '',
							],
							'buttonrightTabletPadding'     => [
								'type'    => 'number',
								'default' => '',
							],
							'buttontopTabletPadding'       => [
								'type'    => 'number',
								'default' => '',
							],
							'buttonbottomTabletPadding'    => [
								'type'    => 'number',
								'default' => '',
							],
							'buttonpaddingLink'            => [
								'type'    => 'boolean',
								'default' => false,
							],
							'buttontabletPaddingUnit'      => [
								'type'    => 'string',
								'default' => 'px',
							],
							'buttonmobilePaddingUnit'      => [
								'type'    => 'string',
								'default' => 'px',
							],
							'buttonpaddingUnit'            => [
								'type'    => 'string',
								'default' => 'px',
							],
							'fieldleftPadding'             => [
								'type' => 'number',
							],
							'fieldrightPadding'            => [
								'type' => 'number',
							],
							'fieldtopPadding'              => [
								'type' => 'number',
							],
							'fieldbottomPadding'           => [
								'type' => 'number',
							],
							'fieldleftMobilePadding'       => [
								'type'    => 'number',
								'default' => '',
							],
							'fieldrightMobilePadding'      => [
								'type'    => 'number',
								'default' => '',
							],
							'fieldtopMobilePadding'        => [
								'type'    => 'number',
								'default' => '',
							],
							'fieldbottomMobilePadding'     => [
								'type'    => 'number',
								'default' => '',
							],
							'fieldleftTabletPadding'       => [
								'type'    => 'number',
								'default' => '',
							],
							'fieldrightTabletPadding'      => [
								'type'    => 'number',
								'default' => '',
							],
							'fieldtopTabletPadding'        => [
								'type'    => 'number',
								'default' => '',
							],
							'fieldbottomTabletPadding'     => [
								'type'    => 'number',
								'default' => '',
							],
							'fieldtabletPaddingUnit'       => [
								'type'    => 'string',
								'default' => 'px',
							],
							'fieldmobilePaddingUnit'       => [
								'type'    => 'string',
								'default' => 'px',
							],
							'fieldpaddingUnit'             => [
								'type'    => 'string',
								'default' => 'px',
							],
							'fieldpaddingLink'             => [
								'type'    => 'boolean',
								'default' => false,
							],
							'labelTransform'               => [
								'type' => 'string',
							],
							'labelDecoration'              => [
								'type' => 'string',
							],
							'labelFontStyle'               => [
								'type' => 'string',
							],
							'inputTransform'               => [
								'type' => 'string',
							],
							'inputDecoration'              => [
								'type' => 'string',
							],
							'inputFontStyle'               => [
								'type' => 'string',
							],
							'buttonTransform'              => [
								'type' => 'string',
							],
							'buttonDecoration'             => [
								'type' => 'string',
							],
							'buttonFontStyle'              => [
								'type' => 'string',
							],
							'radioCheckTransform'          => [
								'type' => 'string',
							],
							'radioCheckDecoration'         => [
								'type' => 'string',
							],
							'radioCheckFontStyle'          => [
								'type' => 'string',
							],
							'validationMsgTransform'       => [
								'type' => 'string',
							],
							'validationMsgDecoration'      => [
								'type' => 'string',
							],
							'validationMsgFontStyle'       => [
								'type' => 'string',
							],
							'msgTransform'                 => [
								'type' => 'string',
							],
							'msgDecoration'                => [
								'type' => 'string',
							],
							'msgFontStyle'                 => [
								'type' => 'string',
							],
							'successMsgTransform'          => [
								'type' => 'string',
							],
							'successMsgDecoration'         => [
								'type' => 'string',
							],
							'successMsgFontStyle'          => [
								'type' => 'string',
							],
							'isPreview'                    => [
								'type'    => 'boolean',
								'default' => false,
							],
							'labelLetterSpacing'           => [
								'type'    => 'number',
								'default' => '',
							],
							'labelLetterSpacingType'       => [
								'type'    => 'string',
								'default' => 'px',
							],
							'labelLetterSpacingMobile'     => [
								'type' => 'number',
							],
							'labelLetterSpacingTablet'     => [
								'type' => 'number',
							],
							'inputLetterSpacing'           => [
								'type'    => 'number',
								'default' => '',
							],
							'inputLetterSpacingType'       => [
								'type'    => 'string',
								'default' => 'px',
							],
							'inputLetterSpacingMobile'     => [
								'type' => 'number',
							],
							'inputLetterSpacingTablet'     => [
								'type' => 'number',
							],
							'buttonLetterSpacing'          => [
								'type'    => 'number',
								'default' => '',
							],
							'buttonLetterSpacingType'      => [
								'type'    => 'string',
								'default' => 'px',
							],
							'buttonLetterSpacingMobile'    => [
								'type' => 'number',
							],
							'buttonLetterSpacingTablet'    => [
								'type' => 'number',
							],
							'radioCheckLetterSpacing'      => [
								'type'    => 'number',
								'default' => '',
							],
							'radioCheckLetterSpacingType'  => [
								'type'    => 'string',
								'default' => 'px',
							],
							'radioCheckLetterSpacingMobile' => [
								'type' => 'number',
							],
							'radioCheckLetterSpacingTablet' => [
								'type' => 'number',
							],
							'validationMsgLetterSpacing'   => [
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
							'msgLetterSpacing'             => [
								'type'    => 'number',
								'default' => '',
							],
							'msgLetterSpacingType'         => [
								'type'    => 'string',
								'default' => 'px',
							],
							'msgLetterSpacingMobile'       => [
								'type' => 'number',
							],
							'msgLetterSpacingTablet'       => [
								'type' => 'number',
							],
							'successMsgLetterSpacing'      => [
								'type'    => 'number',
								'default' => '',
							],
							'successMsgLetterSpacingType'  => [
								'type'    => 'string',
								'default' => 'px',
							],
							'successMsgLetterSpacingMobile' => [
								'type' => 'number',
							],
							'successMsgLetterSpacingTablet' => [
								'type' => 'number',
							],
						],
						'renderCallback' => [ $this, 'renderHtml' ],
					]
				);
			}

		}

		/**
		 * Render Gravity Form HTML.
		 *
		 * @param array $attributes Array of block attributes.
		 *
		 * @since 1.10.0
		 */
		public function renderHtml( $attributes ) {

			$form = $attributes['formId'];

			$classes = [
				'vxt-gf-styler__align-' . $attributes['align'],
				'vxt-gf-styler__field-style-' . $attributes['fieldStyle'],
				'vxt-gf-styler__gform-heading-' . $attributes['titleDescStyle'],
				'vxt-gf-styler__btn-align-' . $attributes['buttonAlignment'],
				'vxt-gf-styler__btn-align-tablet-' . $attributes['buttonAlignmentTablet'],
				'vxt-gf-styler__btn-align-mobile-' . $attributes['buttonAlignmentMobile'],
			];

			if ( $attributes['enableOveride'] ) {
				$classes[] = 'vxt-gf-styler__check-style-enabled';
			}

			if ( $attributes['enableLabel'] ) {
				$classes[] = 'vxt-gf-styler__hide-label';
			}

			if ( $attributes['advancedValidationSettings'] ) {
				$classes[] = 'vxt-gf-styler__error-yes';
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
				'wp-block-vxt-gf-styler',
				'vxt-gf-styler__outer-wrap',
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

				$shortcodeAttrs = [
					'id'       => $form,
					'ajax'     => ( $attributes['enableAjax'] ) ? 'true' : 'false',
					'tabindex' => ( $attributes['enableTabSupport'] ) ? $attributes['formTabIndex'] : '',
				];

				if ( isset( $attributes['titleDescStyle'] ) && 'none' === $attributes['titleDescStyle'] ) {
					$shortcodeAttrs['title']       = false;
					$shortcodeAttrs['description'] = false;
				}

				$attrs = [];

				foreach ( $shortcodeAttrs as $key => $attr ) {
					$attrs[] = $key . '=' . $attr;
				}
				?>
				<div class = "<?php echo esc_attr( implode( ' ', $mainClasses ) ); ?>">
					<div class = "<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
					<?php echo do_shortcode( '[gravityforms ' . esc_attr( implode( ' ', $attrs ) ) . '"]' ); ?>
					</div>
				</div>
				<?php
			}
			return ob_get_clean();
		}
	}

	/**
	 *  Prepare if class 'Vexaltrix\Presentation\BlocksConfig\\GfStyler\\GfStyler' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
