import UAGIconPicker from '@Components/icon-picker';
import TypographyControl from '@Components/typography';
import { __ } from '@wordpress/i18n';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import SpacingControl from '@Components/spacing-control';
import Range from '@Components/range/Range.js';
import ResponsiveSlider from '@Components/responsive-slider';
import MultiButtonsControl from '@Components/multi-buttons-control';
import { InspectorControls } from '@wordpress/block-editor';

import { select } from '@wordpress/data';
import renderSVG from '@Controls/renderIcon';
import { ToggleControl, Icon } from '@wordpress/components';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import { memo } from '@wordpress/element';

const Settings = ( props ) => {
	const { attributes, setAttributes } = props;
	const {
		icon,
		iconSize,
		iconSizeTab,
		iconSizeMob,
		iconSizeUnit,
		noticeDismiss,
		cookies,
		close_cookie_days,
		textColor,
		titleColor,
		noticeColor,
		contentBgColor,
		noticeDismissColor,
		noticeAlignment,
		titleFontFamily,
		titleFontWeight,
		titleFontSizeType,
		titleLineHeightType,
		titleFontSize,
		titleFontSizeTablet,
		titleFontSizeMobile,
		titleLineHeight,
		titleLineHeightTablet,
		titleLineHeightMobile,
		descFontFamily,
		descFontWeight,
		descFontSize,
		descFontSizeType,
		descFontSizeTablet,
		descFontSizeMobile,
		descLineHeight,
		descLineHeightType,
		descLineHeightTablet,
		descLineHeightMobile,
		titleLoadGoogleFonts,
		descLoadGoogleFonts,
		titleTopPadding,
		titleRightPadding,
		titleBottomPadding,
		titleLeftPadding,
		titleTopPaddingTablet,
		titleRightPaddingTablet,
		titleBottomPaddingTablet,
		titleLeftPaddingTablet,
		titleTopPaddingMobile,
		titleRightPaddingMobile,
		titleBottomPaddingMobile,
		titleLeftPaddingMobile,
		titlePaddingUnit,
		mobileTitlePaddingUnit,
		tabletTitlePaddingUnit,
		titlePaddingLink,
		headingTag,
		layout,
		highlightWidth,
		highlightWidthTablet,
		highlightWidthMobile,
		contentTopPadding,
		contentRightPadding,
		contentBottomPadding,
		contentLeftPadding,
		contentTopPaddingTablet,
		contentRightPaddingTablet,
		contentBottomPaddingTablet,
		contentLeftPaddingTablet,
		contentTopPaddingMobile,
		contentRightPaddingMobile,
		contentBottomPaddingMobile,
		contentLeftPaddingMobile,
		contentPaddingUnit,
		mobileContentPaddingUnit,
		tabletContentPaddingUnit,
		contentPaddingLink,
		titleTransform,
		titleDecoration,
		descTransform,
		descDecoration,
		titleFontStyle,
		descFontStyle,
		// letter spacing
		titleLetterSpacing,
		titleLetterSpacingTablet,
		titleLetterSpacingMobile,
		titleLetterSpacingType,
		descLetterSpacing,
		descLetterSpacingTablet,
		descLetterSpacingMobile,
		descLetterSpacingType,
	} = attributes;

	const updateCookieId = ( value ) => {
		const getStore = select( 'core/editor' );
		const post_id = getStore?.getCurrentPostId ? getStore.getCurrentPostId().toString() : 'null';
		const timestamp = new Date().getTime();
		setAttributes( { c_id: post_id + '-' + timestamp } );
		setAttributes( { cookies: value } );
	};

	// Notice dismiss options
	const noticeDismissOptions = [
		{
			value: '',
			label: __( 'Always Show', 'vexaltrix' ),
		},
		{
			value: 'uagb-dismissable',
			label: __( 'Dismissible', 'vexaltrix' ),
		},
	];

	const inlineGeneralSettings = () => {
		return (
			<UAGAdvancedPanelBody initialOpen={ true }>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Layout', 'vexaltrix' ) }
					data={ {
						value: layout,
						label: 'layout',
					} }
					className="uagb-multi-button-alignment-control"
					options={ [
						{
							value: 'modern',
							label: 'Modern',
						},
						{
							value: 'simple',
							label: 'Border',
						},
					] }
					showIcons={ false }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Alignment', 'vexaltrix' ) }
					data={ {
						value: noticeAlignment,
						label: 'noticeAlignment',
					} }
					className="uagb-multi-button-alignment-control"
					options={ [
						{
							value: 'left',
							icon: <Icon icon={ renderSVG( 'fa fa-align-left' ) } />,
							tooltip: __( 'Left', 'vexaltrix' ),
						},
						{
							value: 'center',
							icon: <Icon icon={ renderSVG( 'fa fa-align-center' ) } />,
							tooltip: __( 'Center', 'vexaltrix' ),
						},
						{
							value: 'right',
							icon: <Icon icon={ renderSVG( 'fa fa-align-right' ) } />,
							tooltip: __( 'Right', 'vexaltrix' ),
						},
					] }
					showIcons={ true }
				/>

				{ 'simple' === layout && (
					<ResponsiveSlider
						label={ __( 'Border Width', 'vexaltrix' ) }
						data={ {
							desktop: {
								value: highlightWidth,
								label: 'highlightWidth',
							},
							tablet: {
								value: highlightWidthTablet,
								label: 'highlightWidthTablet',
							},
							mobile: {
								value: highlightWidthMobile,
								label: 'highlightWidthMobile',
							},
						} }
						min={ 0 }
						max={ 50 }
						displayUnit={ false }
						setAttributes={ setAttributes }
					/>
				) }
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Title Tag', 'vexaltrix' ) }
					data={ {
						value: headingTag,
						label: 'headingTag',
					} }
					options={ [
						{
							value: 'h1',
							label: __( 'H1', 'vexaltrix' ),
						},
						{
							value: 'h2',
							label: __( 'H2', 'vexaltrix' ),
						},
						{
							value: 'h3',
							label: __( 'H3', 'vexaltrix' ),
						},
						{
							value: 'h4',
							label: __( 'H4', 'vexaltrix' ),
						},
						{
							value: 'h5',
							label: __( 'H5', 'vexaltrix' ),
						},
						{
							value: 'h6',
							label: __( 'H6', 'vexaltrix' ),
						},
						{
							value: 'span',
							label: __( 'Span', 'vexaltrix' ),
						},
						{
							value: 'p',
							label: __( 'P', 'vexaltrix' ),
						},
					] }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Notice Display', 'vexaltrix' ) }
					data={ {
						value: noticeDismiss,
						label: 'noticeDismiss',
					} }
					options={ noticeDismissOptions }
				/>
				{ noticeDismiss && (
					<>
						<UAGIconPicker
							label={ __( 'Button Icon', 'vexaltrix' ) }
							value={ icon }
							onChange={ ( value ) => setAttributes( { icon: value } ) }
						/>
						<ResponsiveSlider
							label={ __( 'Button Size', 'vexaltrix' ) }
							data={ {
								desktop: {
									value: iconSize,
									label: 'iconSize',
								},
								tablet: {
									value: iconSizeTab,
									label: 'iconSizeTab',
								},
								mobile: {
									value: iconSizeMob,
									label: 'iconSizeMob',
								},
							} }
							min={ 0 }
							max={ 100 }
							unit={ {
								value: iconSizeUnit,
								label: 'iconSizeUnit',
							} }
							setAttributes={ setAttributes }
						/>
					</>
				) }
				{ noticeDismiss && (
					<ToggleControl
						label={ __( 'Enable Cookies', 'vexaltrix' ) }
						checked={ cookies }
						onChange={ updateCookieId }
					/>
				) }
				{ cookies && noticeDismiss && (
					<Range
						label={ __( 'Show Closed Notice After (Days)', 'vexaltrix' ) }
						value={ close_cookie_days }
						data={ {
							value: close_cookie_days,
							label: 'close_cookie_days',
						} }
						min={ 0 }
						max={ 50 }
						displayUnit={ false }
						setAttributes={ setAttributes }
					/>
				) }
			</UAGAdvancedPanelBody>
		);
	};

	const inlineTitleSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Title', 'vexaltrix' ) } initialOpen={ true }>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ titleColor ? titleColor : '' }
					data={ {
						value: titleColor,
						label: 'titleColor',
					} }
					setAttributes={ setAttributes }
				/>
				<AdvancedPopColorControl
					label={ __( 'Border Color', 'vexaltrix' ) }
					colorValue={ noticeColor ? noticeColor : '' }
					data={ {
						value: noticeColor,
						label: 'noticeColor',
					} }
					setAttributes={ setAttributes }
				/>
				{ noticeDismiss && (
					<AdvancedPopColorControl
						label={ __( 'Dismiss Icon Color', 'vexaltrix' ) }
						colorValue={ noticeDismissColor ? noticeDismissColor : '' }
						data={ {
							value: noticeDismissColor,
							label: 'noticeDismissColor',
						} }
						setAttributes={ setAttributes }
					/>
				) }
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: titleLoadGoogleFonts,
						label: 'titleLoadGoogleFonts',
					} }
					fontFamily={ {
						value: titleFontFamily,
						label: 'titleFontFamily',
					} }
					fontWeight={ {
						value: titleFontWeight,
						label: 'titleFontWeight',
					} }
					fontStyle={ {
						value: titleFontStyle,
						label: 'titleFontStyle',
					} }
					transform={ {
						value: titleTransform,
						label: 'titleTransform',
					} }
					decoration={ {
						value: titleDecoration,
						label: 'titleDecoration',
					} }
					fontSizeType={ {
						value: titleFontSizeType,
						label: 'titleFontSizeType',
					} }
					fontSize={ {
						value: titleFontSize,
						label: 'titleFontSize',
					} }
					fontSizeMobile={ {
						value: titleFontSizeMobile,
						label: 'titleFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: titleFontSizeTablet,
						label: 'titleFontSizeTablet',
					} }
					lineHeightType={ {
						value: titleLineHeightType,
						label: 'titleLineHeightType',
					} }
					lineHeight={ {
						value: titleLineHeight,
						label: 'titleLineHeight',
					} }
					lineHeightMobile={ {
						value: titleLineHeightMobile,
						label: 'titleLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: titleLineHeightTablet,
						label: 'titleLineHeightTablet',
					} }
					letterSpacing={ {
						value: titleLetterSpacing,
						label: 'titleLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: titleLetterSpacingTablet,
						label: 'titleLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: titleLetterSpacingMobile,
						label: 'titleLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: titleLetterSpacingType,
						label: 'titleLetterSpacingType',
					} }
				/>
				<SpacingControl
					{ ...props }
					label={ __( 'Padding', 'vexaltrix' ) }
					valueTop={ {
						value: titleTopPadding,
						label: 'titleTopPadding',
					} }
					valueRight={ {
						value: titleRightPadding,
						label: 'titleRightPadding',
					} }
					valueBottom={ {
						value: titleBottomPadding,
						label: 'titleBottomPadding',
					} }
					valueLeft={ {
						value: titleLeftPadding,
						label: 'titleLeftPadding',
					} }
					valueTopTablet={ {
						value: titleTopPaddingTablet,
						label: 'titleTopPaddingTablet',
					} }
					valueRightTablet={ {
						value: titleRightPaddingTablet,
						label: 'titleRightPaddingTablet',
					} }
					valueBottomTablet={ {
						value: titleBottomPaddingTablet,
						label: 'titleBottomPaddingTablet',
					} }
					valueLeftTablet={ {
						value: titleLeftPaddingTablet,
						label: 'titleLeftPaddingTablet',
					} }
					valueTopMobile={ {
						value: titleTopPaddingMobile,
						label: 'titleTopPaddingMobile',
					} }
					valueRightMobile={ {
						value: titleRightPaddingMobile,
						label: 'titleRightPaddingMobile',
					} }
					valueBottomMobile={ {
						value: titleBottomPaddingMobile,
						label: 'titleBottomPaddingMobile',
					} }
					valueLeftMobile={ {
						value: titleLeftPaddingMobile,
						label: 'titleLeftPaddingMobile',
					} }
					unit={ {
						value: titlePaddingUnit,
						label: 'titlePaddingUnit',
					} }
					mUnit={ {
						value: mobileTitlePaddingUnit,
						label: 'mobileTitlePaddingUnit',
					} }
					tUnit={ {
						value: tabletTitlePaddingUnit,
						label: 'tabletTitlePaddingUnit',
					} }
					attributes={ attributes }
					setAttributes={ setAttributes }
					link={ {
						value: titlePaddingLink,
						label: 'titlePaddingLink',
					} }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const inlineContentSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Content', 'vexaltrix' ) } initialOpen={ false }>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ textColor ? textColor : '' }
					data={ {
						value: textColor,
						label: 'textColor',
					} }
					setAttributes={ setAttributes }
				/>
				<AdvancedPopColorControl
					label={ __( 'Background Color', 'vexaltrix' ) }
					colorValue={ contentBgColor ? contentBgColor : '' }
					data={ {
						value: contentBgColor,
						label: 'contentBgColor',
					} }
					setAttributes={ setAttributes }
				/>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: descLoadGoogleFonts,
						label: 'descLoadGoogleFonts',
					} }
					fontFamily={ {
						value: descFontFamily,
						label: 'descFontFamily',
					} }
					fontWeight={ {
						value: descFontWeight,
						label: 'descFontWeight',
					} }
					fontStyle={ {
						value: descFontStyle,
						label: 'descFontStyle',
					} }
					transform={ {
						value: descTransform,
						label: 'descTransform',
					} }
					decoration={ {
						value: descDecoration,
						label: 'descDecoration',
					} }
					fontSizeType={ {
						value: descFontSizeType,
						label: 'descFontSizeType',
					} }
					fontSize={ {
						value: descFontSize,
						label: 'descFontSize',
					} }
					fontSizeMobile={ {
						value: descFontSizeMobile,
						label: 'descFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: descFontSizeTablet,
						label: 'descFontSizeTablet',
					} }
					lineHeightType={ {
						value: descLineHeightType,
						label: 'descLineHeightType',
					} }
					lineHeight={ {
						value: descLineHeight,
						label: 'descLineHeight',
					} }
					lineHeightMobile={ {
						value: descLineHeightMobile,
						label: 'descLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: descLineHeightTablet,
						label: 'descLineHeightTablet',
					} }
					letterSpacing={ {
						value: descLetterSpacing,
						label: 'descLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: descLetterSpacingTablet,
						label: 'descLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: descLetterSpacingMobile,
						label: 'descLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: descLetterSpacingType,
						label: 'descLetterSpacingType',
					} }
				/>
				<SpacingControl
					{ ...props }
					label={ __( 'Padding', 'vexaltrix' ) }
					valueTop={ {
						value: contentTopPadding,
						label: 'contentTopPadding',
					} }
					valueRight={ {
						value: contentRightPadding,
						label: 'contentRightPadding',
					} }
					valueBottom={ {
						value: contentBottomPadding,
						label: 'contentBottomPadding',
					} }
					valueLeft={ {
						value: contentLeftPadding,
						label: 'contentLeftPadding',
					} }
					valueTopTablet={ {
						value: contentTopPaddingTablet,
						label: 'contentTopPaddingTablet',
					} }
					valueRightTablet={ {
						value: contentRightPaddingTablet,
						label: 'contentRightPaddingTablet',
					} }
					valueBottomTablet={ {
						value: contentBottomPaddingTablet,
						label: 'contentBottomPaddingTablet',
					} }
					valueLeftTablet={ {
						value: contentLeftPaddingTablet,
						label: 'contentLeftPaddingTablet',
					} }
					valueTopMobile={ {
						value: contentTopPaddingMobile,
						label: 'contentTopPaddingMobile',
					} }
					valueRightMobile={ {
						value: contentRightPaddingMobile,
						label: 'contentRightPaddingMobile',
					} }
					valueBottomMobile={ {
						value: contentBottomPaddingMobile,
						label: 'contentBottomPaddingMobile',
					} }
					valueLeftMobile={ {
						value: contentLeftPaddingMobile,
						label: 'contentLeftPaddingMobile',
					} }
					unit={ {
						value: contentPaddingUnit,
						label: 'contentPaddingUnit',
					} }
					mUnit={ {
						value: mobileContentPaddingUnit,
						label: 'mobileContentPaddingUnit',
					} }
					tUnit={ {
						value: tabletContentPaddingUnit,
						label: 'tabletContentPaddingUnit',
					} }
					attributes={ attributes }
					setAttributes={ setAttributes }
					link={ {
						value: contentPaddingLink,
						label: 'contentPaddingLink',
					} }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	return (
		<>
			<InspectorControls>
				<InspectorTabs tabs={ [ 'general', 'style', 'advance' ] }>
					<InspectorTab { ...UAGTabs.general }>{ inlineGeneralSettings() }</InspectorTab>
					<InspectorTab { ...UAGTabs.style }>
						{ inlineTitleSettings() }
						{ inlineContentSettings() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
				</InspectorTabs>
			</InspectorControls>
		</>
	);
};

export default memo( Settings );
