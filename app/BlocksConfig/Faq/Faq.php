<?php
/**
 * Vexaltrix faq.
 *
 * @package Vexaltrix
 * @since 2.13.5
 */

namespace Vexaltrix\BlocksConfig\Faq;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\\BlocksConfig\\Faq\\Faq' ) ) {

	/**
	 * Class \Vexaltrix\BlocksConfig\Faq\Faq.
	 *
	 * @since 2.13.5
	 */
	class Faq {

		/**
		 * Member Variable
		 *
		 * @var \Vexaltrix\BlocksConfig\Faq\Faq
		 * @since 2.13.5
		 */
		private static $instance;

		/**
		 * Initiator
		 *
		 * @return \Vexaltrix\BlocksConfig\Faq\Faq
		 * @since 2.13.5
		 */
		public static function getInstance() {
			return \Vexaltrix\Container::getInstance()->get( self::class );
		}

		/**
		 * Constructor
		 *
		 * @since 2.13.5
		 */
		public function __construct() {
			add_action( 'init', [ $this, 'registerBlocks' ] );
		}

		/**
		 * Registers the `faq` block on server.
		 *
		 * @since 2.13.5
		 * @return void
		 */
		public function registerBlocks() {

			register_block_type(
				'vexaltrix/faq',
				[
					'attributes'      => [
						'block_id'                     => [
							'type' => 'string',
						],
						'anchor'                       => [
							'type'    => 'string',
							'default' => '',
						],
						'layout'                       => [
							'type'    => 'string',
							'default' => 'accordion',
						],
						'inactiveOtherItems'           => [
							'type'    => 'boolean',
							'default' => true,
						],
						'expandFirstItem'              => [
							'type'    => 'boolean',
							'default' => true,
						],
						'enableSchemaSupport'          => [
							'type'    => 'boolean',
							'default' => false,
						],
						'align'                        => [
							'type'         => 'string',
							'default'      => 'left',
							'UAGCopyPaste' => [
								'styleType' => 'overall-alignment',
							],
						],
						'blockTopPadding'              => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-top-padding',
							],
						],
						'blockRightPadding'            => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-right-padding',
							],
						],
						'blockLeftPadding'             => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-left-padding',
							],
						],
						'blockBottomPadding'           => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-bottom-padding',
							],
						],
						'blockTopPaddingTablet'        => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-top-padding-tablet',
							],
						],
						'blockRightPaddingTablet'      => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-right-padding-tablet',
							],
						],
						'blockLeftPaddingTablet'       => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-left-padding-tablet',
							],
						],
						'blockBottomPaddingTablet'     => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-bottom-padding-tablet',
							],
						],
						'blockTopPaddingMobile'        => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-top-padding-mobile',
							],
						],
						'blockRightPaddingMobile'      => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-right-padding-mobile',
							],
						],
						'blockLeftPaddingMobile'       => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-left-padding-mobile',
							],
						],
						'blockBottomPaddingMobile'     => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-bottom-padding-mobile',
							],
						],
						'blockPaddingUnit'             => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'block-padding-unit',
							],
						],

						'blockPaddingUnitTablet'       => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'block-padding-unit-tablet',
							],
						],
						'blockPaddingUnitMobile'       => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'block-padding-unit-mobile',
							],
						],
						'blockPaddingLink'             => [
							'type'    => 'boolean',
							'default' => true,
						],
						'blockTopMargin'               => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-top-margin',
							],
						],
						'blockRightMargin'             => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-right-margin',
							],
						],
						'blockLeftMargin'              => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-left-margin',
							],
						],
						'blockBottomMargin'            => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-bottom-margin',
							],
						],
						'blockTopMarginTablet'         => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-top-margin-tablet',
							],
						],
						'blockRightMarginTablet'       => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-right-margin-tablet',
							],
						],
						'blockLeftMarginTablet'        => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-left-margin-tablet',
							],
						],
						'blockBottomMarginTablet'      => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-bottom-margin-tablet',
							],
						],
						'blockTopMarginMobile'         => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-top-margin-mobile',
							],
						],
						'blockRightMarginMobile'       => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-right-margin-mobile',
							],
						],
						'blockLeftMarginMobile'        => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-left-margin-mobile',
							],
						],
						'blockBottomMarginMobile'      => [
							'type'         => 'number',
							'isGBSStyle'   => true,
							'UAGCopyPaste' => [
								'styleType' => 'block-bottom-margin-mobile',
							],
						],
						'blockMarginUnit'              => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'block-margin-unit',
							],
						],
						'blockMarginUnitTablet'        => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'block-margin-unit-tablet',
							],
						],
						'blockMarginUnitMobile'        => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'block-margin-unit-mobile',
							],
						],
						'blockMarginLink'              => [
							'type'    => 'boolean',
							'default' => true,
						],
						'enableSeparator'              => [
							'type'         => 'boolean',
							'default'      => false,
							'UAGCopyPaste' => [
								'styleType' => 'enable-separator',
							],
						],
						'rowsGap'                      => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'row-gap',
							],
						],
						'rowsGapTablet'                => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'row-gap-tablet',
							],
						],
						'rowsGapMobile'                => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'row-gap-mobile',
							],
						],
						'rowsGapUnit'                  => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'row-gap-type',
							],
						],
						'columnsGap'                   => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'column-gap',
							],
						],
						'columnsGapTablet'             => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'column-gap-tablet',
							],
						],
						'columnsGapMobile'             => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'column-gap-mobile',
							],
						],
						'columnsGapUnit'               => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'column-gap-type',
							],
						],
						'boxBgType'                    => [
							'type'         => 'string',
							'default'      => 'color',
							'UAGCopyPaste' => [
								'styleType' => 'faq-bg-type',
							],
						],
						'boxBgHoverType'               => [
							'type'         => 'string',
							'default'      => 'color',
							'UAGCopyPaste' => [
								'styleType' => 'faq-bg-hover-type',
							],
						],
						'boxBgColor'                   => [
							'type'         => 'string',
							'default'      => '',
							'UAGCopyPaste' => [
								'styleType' => 'faq-bg-color',
							],
						],
						'boxBgHoverColor'              => [
							'type'         => 'string',
							'default'      => '',
							'UAGCopyPaste' => [
								'styleType' => 'faq-bg-hover-color',
							],
						],
						'boxPaddingTypeMobile'         => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'faq-padding-type-mobile',
							],
							'default'      => 'px',
						],
						'boxPaddingTypeTablet'         => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'faq-padding-type-tablet',
							],
						],
						'boxPaddingTypeDesktop'        => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'faq-padding-type-desktop',
							],
						],
						'vBoxPaddingMobile'            => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'faq-vertical-padding-mobile',
							],
						],
						'hBoxPaddingMobile'            => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'faq-horizontal-padding-mobile',
							],
						],
						'vBoxPaddingTablet'            => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'faq-vertical-padding-tablet',
							],
						],
						'hBoxPaddingTablet'            => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'faq-horizontal-padding-tablet',
							],
						],
						'vBoxPaddingDesktop'           => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'faq-vertical-padding-desktop',
							],
						],
						'hBoxPaddingDesktop'           => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'faq-horizontal-padding-desktop',
							],
						],
						'borderHoverColor'             => [
							'type' => 'string',
						],
						'borderStyle'                  => [
							'type'    => 'string',
							'default' => 'solid',
						],
						'borderWidth'                  => [
							'type'    => 'number',
							'default' => 1,
						],
						'borderRadius'                 => [
							'type'    => 'number',
							'default' => 2,
						],
						'borderColor'                  => [
							'type'    => 'string',
							'default' => '#D2D2D2',
						],
						'questionTextColor'            => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-color',
							],
						],
						'questionTextActiveColor'      => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-hover-color',
							],
						],
						'questionTextBgColor'          => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-bg-color',
							],
						],
						'questionTextActiveBgColor'    => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-hover-bg-color',
							],
						],
						'questionPaddingTypeDesktop'   => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-padding-type-desktop',
							],
							'default'      => 'px',
						],
						'questionPaddingTypeTablet'    => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-padding-type-tablet',
							],
							'default'      => 'px',
						],
						'questionPaddingTypeMobile'    => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-padding-type-mobile',
							],
							'default'      => 'px',
						],
						'vquestionPaddingMobile'       => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-vertical-padding-mobile',
							],
							'default'      => 10,
						],
						'vquestionPaddingTablet'       => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-vertical-padding-tablet',
							],
							'default'      => 10,
						],
						'vquestionPaddingDesktop'      => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-vertical-padding-desktop',
							],
							'default'      => 10,
						],
						'hquestionPaddingMobile'       => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-horizontal-padding-mobile',
							],
							'default'      => 10,
						],
						'hquestionPaddingTablet'       => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-horizontal-padding-tablet',
							],
							'default'      => 10,
						],
						'hquestionPaddingDesktop'      => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-horizontal-padding-desktop',
							],
							'default'      => 10,
						],
						'answerTextColor'              => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'desc-color',
							],
						],
						'answerPaddingTypeDesktop'     => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'desc-padding-type-desktop',
							],
						],
						'answerPaddingTypeTablet'      => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'desc-padding-type-tablet',
							],
						],
						'answerPaddingTypeMobile'      => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'desc-padding-type-mobile',
							],
						],
						'vanswerPaddingMobile'         => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'desc-vertical-padding-mobile',
							],
							'default'      => 10,
						],
						'vanswerPaddingTablet'         => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'desc-vertical-padding-tablet',
							],
							'default'      => 10,
						],
						'iconBgSize'                   => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'icon-bg-size',
							],
						],
						'iconBgSizeTablet'             => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'icon-bg-size-tablet',
							],
						],
						'iconBgSizeMobile'             => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'icon-bg-size-mobile',
							],
						],
						'iconBgSizeType'               => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'icon-bg-size-type',
							],
						],
						'columns'                      => [
							'type'         => 'number',
							'default'      => 2,
							'UAGCopyPaste' => [
								'styleType' => 'column-count',
							],
						],
						'tcolumns'                     => [
							'type'         => 'number',
							'default'      => 2,
							'UAGCopyPaste' => [
								'styleType' => 'column-count-tablet',
							],
						],
						'mcolumns'                     => [
							'type'         => 'number',
							'default'      => 1,
							'UAGCopyPaste' => [
								'styleType' => 'column-count-mobile',
							],
						],
						'schema'                       => [
							'type'    => 'string',
							'default' => '',
						],
						'enableToggle'                 => [
							'type'    => 'boolean',
							'default' => true,
						],
						'equalHeight'                  => [
							'type'         => 'boolean',
							'default'      => true,
							'UAGCopyPaste' => [
								'styleType' => 'equal-height',
							],
						],
						'questionLeftPaddingTablet'    => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'main-title-left-padding-tablet',
							],
						],
						'questionBottomPaddingTablet'  => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'main-title-bottom-padding-tablet',
							],
						],
						'questionLeftPaddingDesktop'   => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'main-title-left-padding-desktop',
							],
						],
						'questionBottomPaddingDesktop' => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'main-title-bottom-padding-desktop',
							],
						],
						'questionLeftPaddingMobile'    => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'main-title-left-padding-mobile',
							],
						],
						'questionBottomPaddingMobile'  => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'main-title-bottom-padding-mobile',
							],
						],
						'headingTag'                   => [
							'type'     => 'string',
							'selector' => 'span,p,h1,h2,h3,h4,h5,h6',
							'default'  => 'span',
						],
						'questionSpacingLink'          => [
							'type'    => 'boolean',
							'default' => false,
						],
						'answerSpacingLink'            => [
							'type'    => 'boolean',
							'default' => false,
						],
						'answerTopPadding'             => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'desc-top-padding',
							],
						],
						'answerRightPadding'           => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'desc-right-padding',
							],
						],
						'answerBottomPadding'          => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'desc-bottom-padding',
							],
						],
						'answerLeftPadding'            => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'desc-left-padding',
							],
						],
						'answerTopPaddingTablet'       => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'desc-top-padding-tablet',
							],
						],
						'answerRightPaddingTablet'     => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'desc-right-padding-tablet',
							],
						],
						'answerBottomPaddingTablet'    => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'desc-bottom-padding-tablet',
							],
						],
						'answerLeftPaddingTablet'      => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'desc-left-padding-tablet',
							],
						],
						'answerTopPaddingMobile'       => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'desc-top-padding-mobile',
							],
						],
						'answerRightPaddingMobile'     => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'desc-right-padding-mobile',
							],
						],
						'answerBottomPaddingMobile'    => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'desc-bottom-padding-mobile',
							],
						],
						'answerLeftPaddingMobile'      => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'desc-left-padding-mobile',
							],
						],
						'isPreview'                    => [
							'type'    => 'boolean',
							'default' => false,
						],
						'questionLetterSpacing'        => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-letter-spacing',
							],
						],
						'questionLetterSpacingTablet'  => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-letter-spacing-tablet',
							],
						],
						'questionLetterSpacingMobile'  => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-letter-spacing-mobile',
							],
						],
						'questionLetterSpacingType'    => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-letter-spacing-type',
							],
						],
						'answerLetterSpacing'          => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'desc-letter-spacing',
							],
						],
						'answerLetterSpacingTablet'    => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'desc-letter-spacing-tablet',
							],
						],
						'answerLetterSpacingMobile'    => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'desc-letter-spacing-mobile',
							],
						],
						'answerLetterSpacingType'      => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'desc-letter-spacing-type',
							],
						],
						'iconBgColor'                  => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'icon-bg-color',
							],
						],
						'iconColor'                    => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'icon-color',
							],
						],
						'iconActiveColor'              => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'icon-hover-color',
							],
						],
						'gapBtwIconQUestion'           => [
							'type'         => 'number',
							'default'      => 10,
							'UAGCopyPaste' => [
								'styleType' => 'icon-spacing',
							],
						],
						'gapBtwIconQUestionTablet'     => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'icon-spacing-tablet',
							],
						],
						'gapBtwIconQUestionMobile'     => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'icon-spacing-mobile',
							],
						],
						'questionloadGoogleFonts'      => [
							'type'         => 'boolean',
							'default'      => false,
							'UAGCopyPaste' => [
								'styleType' => 'main-title-load-google-fonts',
							],
						],
						'answerloadGoogleFonts'        => [
							'type'         => 'boolean',
							'UAGCopyPaste' => [
								'styleType' => 'desc-load-google-fonts',
							],
							'default'      => false,
						],
						'questionFontFamily'           => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-font-family',
							],
							'default'      => 'Default',
						],
						'questionFontWeight'           => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-font-weight',
							],
						],
						'questionFontStyle'            => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-font-style',
							],
							'default'      => 'normal',
						],
						'questionTransform'            => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-transform',
							],
						],
						'questionDecoration'           => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-decoration',
							],
						],
						'questionFontSize'             => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-font-size',
							],
						],
						'questionFontSizeType'         => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-font-size-type',
							],
							'default'      => 'px',
						],
						'questionFontSizeTablet'       => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-font-size-tablet',
							],
						],
						'questionFontSizeMobile'       => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-font-size-mobile',
							],
						],
						'questionLineHeight'           => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-line-height',
							],
						],
						'questionLineHeightType'       => [
							'type'         => 'string',
							'default'      => 'em',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-line-height-type',
							],
						],
						'questionLineHeightTablet'     => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-line-height-tablet',
							],
						],
						'questionLineHeightMobile'     => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'main-title-line-height-mobile',
							],
						],
						'answerFontFamily'             => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'desc-font-family',
							],
							'default'      => 'Default',
						],
						'answerFontWeight'             => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'desc-font-weight',
							],
						],
						'answerFontStyle'              => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'desc-font-style',
							],
							'default'      => 'normal',
						],
						'answerTransform'              => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'desc-transform',
							],
						],
						'answerDecoration'             => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'desc-decoration',
							],
						],
						'answerFontSize'               => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'desc-font-size',
							],
						],
						'answerFontSizeType'           => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'desc-font-size-type',
							],
							'default'      => 'px',
						],
						'answerFontSizeTablet'         => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'desc-font-size-tablet',
							],
						],
						'answerFontSizeMobile'         => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'desc-font-size-mobile',
							],
						],
						'answerLineHeight'             => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'desc-line-height',
							],
						],
						'answerLineHeightType'         => [
							'type'         => 'string',
							'UAGCopyPaste' => [
								'styleType' => 'desc-line-height-type',
							],
							'default'      => 'em',
						],
						'answerLineHeightTablet'       => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'desc-line-height-tablet',
							],
						],
						'answerLineHeightMobile'       => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'desc-line-height-mobile',
							],
						],
						'icon'                         => [
							'type'    => 'string',
							'default' => 'plus',
						],
						'iconActive'                   => [
							'type'    => 'string',
							'default' => 'minus',
						],
						'iconAlign'                    => [
							'type'         => 'string',
							'default'      => 'row',
							'UAGCopyPaste' => [
								'styleType' => 'icon-align',
							],
						],
						'iconSize'                     => [
							'type'         => 'number',
							'default'      => 12,
							'UAGCopyPaste' => [
								'styleType' => 'icon-size',
							],
						],
						'iconSizeTablet'               => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'icon-size-tablet',
							],
						],
						'iconSizeMobile'               => [
							'type'         => 'number',
							'UAGCopyPaste' => [
								'styleType' => 'icon-size-mobile',
							],
						],
						'iconSizeType'                 => [
							'type'         => 'string',
							'default'      => 'px',
							'UAGCopyPaste' => [
								'styleType' => 'icon-size-type',
							],
						],
						'question'                     => [
							'type'    => 'string',
							'default' => __( 'What is FAQ?', 'vexaltrix' ),
						],
						'answer'                       => [
							'type'    => 'string',
							'default' => __(
								'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
								'vexaltrix'
							),
						],
					],
					'renderCallback' => [ $this, 'renderFaqBlock' ],
				]
			);

			register_block_type(
				'vexaltrix/faq-child',
				[
					'attributes'      => [
						'isPreview'  => [
							'type'    => 'boolean',
							'default' => false,
						],
						'block_id'   => [
							'type' => 'string',
						],
						'anchor'     => [
							'type'    => 'string',
							'default' => '',
						],
						'question'   => [
							'type'    => 'string',
							'default' => __( 'What is FAQ?', 'vexaltrix' ),
						],
						'answer'     => [
							'type'    => 'string',
							'default' => __(
								'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
								'vexaltrix'
							),
						],
						'icon'       => [
							'type'    => 'string',
							'default' => 'plus',
						],
						'iconActive' => [
							'type'    => 'string',
							'default' => 'minus',
						],
						'layout'     => [
							'type'    => 'string',
							'default' => 'accordion',
						],
						'headingTag' => [
							'type'     => 'string',
							'selector' => 'span,p,h1,h2,h3,h4,h5,h6',
							'default'  => 'span',
						],
					],
					'renderCallback' => [ $this, 'renderFaqChildBlock' ],
				] 
			);
		}

		/**
		 * Renders the Vexaltrix FAQ block.
		 *
		 * @param  array    $attributes Block attributes.
		 * @param  string   $content    Block default content.
		 * @param  WP_Block $block      Block instance.
		 * @since 2.13.5
		 * @return string Rendered block HTML.
		 */
		public function renderFaqBlock( $attributes, $content, $block ) {
			global $post; // Use the global post object to get the current post.
			$blockId            = isset( $attributes['block_id'] ) ? $attributes['block_id'] : '';
			$enableSchema       = $attributes['enableSchemaSupport'];
			$equalHeight        = $attributes['equalHeight'];
			$iconAlign          = $attributes['iconAlign'];
			$layout              = $attributes['layout'];
			$expandFirstItem   = ( true === $attributes['expandFirstItem'] ) ? 'vxt-faq-expand-first-true' : 'vxt-faq-expand-first-false';
			$inactiveOtherItem = ( true === $attributes['inactiveOtherItems'] ) ? 'vxt-faq-inactive-other-true' : 'vxt-faq-inactive-other-false';
			$enableToggle       = isset( $attributes['enableToggle'] ) ? 'true' : 'false';
			$anchor              = ( isset( $attributes['anchor'] ) ) ? $attributes['anchor'] : '';
			$anchor              = empty( $anchor ) ? '' : 'id="' . esc_attr( $anchor ) . '"';
			// Get the current page URL.
			$pageUrl = get_permalink( $post );
			// Initialize the schema JSON structure.
			$jsonData = [
				'@context'   => 'https://schema.org',
				'@type'      => 'FAQPage',
				'@id'        => $pageUrl,
				'mainEntity' => [],
			];
			// Collect data from inner blocks for the schema.
			$innerBlocksHtml = '';
			foreach ( $block->inner_blocks as $innerBlock ) {
				if ( is_object( $innerBlock ) && method_exists( $innerBlock, 'render' ) ) {
					$innerBlocksHtml .= $innerBlock->render();
					// Assuming inner blocks have 'question' and 'answer' attributes.
					if ( isset( $innerBlock->attributes['question'] ) && isset( $innerBlock->attributes['answer'] ) ) {
						$faqData                  = [
							'@type'          => 'Question',
							'name'           => $innerBlock->attributes['question'],
							'acceptedAnswer' => [
								'@type' => 'Answer',
								'text'  => $innerBlock->attributes['answer'],
							],
						];
						$jsonData['mainEntity'][] = $faqData;
					}
				}
			}
			// Render schema if enabled.
			$schemaOutput = '';
			if ( $enableSchema && ! empty( $jsonData['mainEntity'] ) ) {
				$schemaOutput = '<script type="application/ld+json">' . wp_json_encode( $jsonData ) . '</script>';
			}
			// Add equal height class if enabled.
			$equalHeightClass = $equalHeight ? 'vxt-faq-equal-height' : '';
			$desktopClass      = '';
			$tabClass          = '';
			$mobClass          = '';

			if ( array_key_exists( 'UAGHideDesktop', $attributes ) || array_key_exists( 'UAGHideTab', $attributes ) || array_key_exists( 'UAGHideMob', $attributes ) ) {

				$desktopClass = ( isset( $attributes['UAGHideDesktop'] ) ) ? 'uag-hide-desktop' : '';

				$tabClass = ( isset( $attributes['UAGHideTab'] ) ) ? 'uag-hide-tab' : '';

				$mobClass = ( isset( $attributes['UAGHideMob'] ) ) ? 'uag-hide-mob' : '';
			}

			$zindexDesktop           = '';
			$zindexTablet            = '';
			$zindexMobile            = '';
			$zindexWrap              = [];
			$zindexExtensionEnabled = ( isset( $attributes['zIndex'] ) || isset( $attributes['zIndexTablet'] ) || isset( $attributes['zIndexMobile'] ) );

			if ( $zindexExtensionEnabled ) {
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
			$zindex     = $zindexExtensionEnabled ? 'uag-blocks-common-selector' : '';
			$className = ( isset( $attributes['className'] ) ) ? $attributes['className'] : '';
			// Build the block's HTML.
			$output  = '<div class="' . esc_attr( "wp-block-vxt-faq vxt-faq__outer-wrap vxt-block-{$blockId} vxt-faq-icon-{$iconAlign} vxt-faq-layout-{$layout} {$expandFirstItem} {$inactiveOtherItem} vxt-faq__wrap vxt-buttons-layout-wrap {$equalHeightClass} {$desktopClass} {$tabClass} {$mobClass} {$zindex} {$className}" ) . '" ' . $anchor . 'data-faqtoggle="' . esc_attr( $enableToggle ) . '" role="tablist">';
			$output .= $schemaOutput;
			$output .= $innerBlocksHtml;
			$output .= '</div>';

			return $output;
		}

		/**
		 * Render faq icon function.
		 *
		 * @param string $icon Icon name.
		 * @param string $class Icon class.
		 * @since 2.13.5
		 * @return string|false Rendered icon HTML.
		 */
		public function faqRenderIcon( $icon, $class ) {
			ob_start();
			?>
			<span class="<?php echo esc_attr( $class ); ?> vxt-faq-icon-wrap">
				<?php	
				echo \Vexaltrix\Support\Helper::renderSvgHtml( $icon ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped & sanitize inside render_svg_html().
				?>
			</span>
			<?php
			return ob_get_clean();
		}

		/**
		 * Renders the Vexaltrix FAQ child block.
		 *
		 * @param  array    $attributes Block attributes.
		 * @param  string   $content    Block default content.
		 * @param  WP_Block $block      Block instance.
		 * @since 2.13.5
		 * @return string Rendered block HTML.
		 */
		public function renderFaqChildBlock( $attributes, $content, $block ) {
			// Extract attributes.
			$blockId              = isset( $attributes['block_id'] ) ? $attributes['block_id'] : '';
			$question              = $attributes['question'];
			$answer                = $attributes['answer'];
			$icon                  = isset( $attributes['icon'] ) ? $attributes['icon'] : 'plus';
			$iconActive           = isset( $attributes['iconActive'] ) ? $attributes['iconActive'] : 'minus';
			$layout                = $attributes['layout'];
			$arrayOfAllowedHTML = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'span', 'p' ];
			$headingTag           = \Vexaltrix\Support\Helper::titleTagAllowedHtml( $attributes['headingTag'], $arrayOfAllowedHTML, 'span' );

			// Render icon and active icon.
			$iconOutput        = $this->faqRenderIcon( $icon, 'vxt-icon' );
			$iconActiveOutput = $this->faqRenderIcon( $iconActive, 'vxt-icon-active' );
			$className         = ( isset( $attributes['className'] ) ) ? $attributes['className'] : '';
			$anchor             = ( isset( $attributes['anchor'] ) ) ? $attributes['anchor'] : '';
			$anchor             = empty( $anchor ) ? '' : 'id="' . esc_attr( $anchor ) . '"';

			// Build the block's HTML.
			$output  = '<div class="' . esc_attr( "wp-block-vxt-faq-child vxt-faq-child__outer-wrap vxt-faq-item vxt-block-{$blockId} {$className}" ) . '" ' . $anchor . 'role="tab" tabindex="0">';
			$output .= '<div class="vxt-faq-questions-button vxt-faq-questions">';
			if ( 'accordion' === $layout ) {
				$output .= $iconOutput;
				$output .= $iconActiveOutput;
				$output .= '<' . esc_attr( $headingTag ) . ' class="vxt-question">' . wp_kses_post( $question ) . '</' . esc_attr( $headingTag ) . '>';
			} else {
				$output .= '<' . esc_attr( $headingTag ) . ' class="vxt-question">' . wp_kses_post( $question ) . '</' . esc_attr( $headingTag ) . '>';
			}
			$output .= '</div>';
			$output .= '<div class="vxt-faq-content"><p>' . wp_kses_post( $answer ) . '</p></div>';
			$output .= '</div>';

			return $output;
		}
	}

	/**
	 *  Prepare if class 'Vexaltrix\\BlocksConfig\\Faq\\Faq' exist.
	 *  Kicking this off by calling 'get_instance()' method
	 */
}
