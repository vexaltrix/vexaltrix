import TypographyControl from '@Components/typography';
import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import UAGMediaPicker from '@Components/image';
import SpacingControl from '@Components/spacing-control';
import MultiButtonsControl from '@Components/multi-buttons-control';
import UAGSelectControl from '@Components/select-control';
import { getImageSize } from '@Utils/Helpers';
import renderSVG from '@Controls/renderIcon';
import { ToggleControl, DateTimePicker, Icon } from '@wordpress/components';
import UAGTextControl from '@Components/text-control';
import { memo } from '@wordpress/element';
import UAGNumberControl from '@Components/number-control';
import UpgradeComponent from '@Components/upgrade-to-pro-cta';

let imageSizeOptions = [
	{
		value: 'thumbnail',
		label: __( 'Thumbnail', 'vexaltrix' ),
	},
	{ value: 'medium', label: __( 'Medium', 'vexaltrix' ) },
	{ value: 'full', label: __( 'Large', 'vexaltrix' ) },
];
export const removeFromArray = ( arr, removedElems ) =>
	arr.filter( ( a ) => ( Array.isArray( removedElems ) ? ! removedElems.includes( a ) : a !== removedElems ) );

import UAGAdvancedPanelBody from '@Components/advanced-panel-body';

const Settings = ( props ) => {
	// Setup the attributes
	const { attributes, setAttributes } = props;

	const {
		enableSchema,
		itemType,
		itemSubtype,
		sku,
		identifier,
		identifierType,
		offerType,
		offerCurrency,
		offerStatus,
		offerPrice,
		offerExpiry,
		datepublish,
		ctaLink,
		ctaTarget,
		brand,
		headingTag,
		mainimage,
		imgSize,
		showFeature,
		showAuthor,
		starColor,
		descColor,
		titleColor,
		contentColor,
		headFontFamily,
		headFontWeight,
		headFontSizeType,
		headFontSize,
		headFontSizeMobile,
		headFontSizeTablet,
		headLineHeightType,
		headLineHeight,
		headLineHeightMobile,
		headLineHeightTablet,
		headLoadGoogleFonts,
		subHeadFontFamily,
		subHeadFontWeight,
		subHeadFontSize,
		subHeadFontSizeType,
		subHeadFontSizeMobile,
		subHeadFontSizeTablet,
		subHeadLineHeight,
		subHeadLineHeightType,
		subHeadLineHeightMobile,
		subHeadLineHeightTablet,
		subHeadLoadGoogleFonts,
		contentLoadGoogleFonts,
		contentFontFamily,
		contentFontWeight,
		contentFontSizeType,
		contentLineHeightType,
		contentFontSize,
		contentFontSizeTablet,
		contentFontSizeMobile,
		contentLineHeight,
		contentLineHeightTablet,
		contentLineHeightMobile,
		topPadding,
		bottomPadding,
		rightPadding,
		leftPadding,
		//Mobile
		paddingTopMobile,
		paddingBottomMobile,
		paddingRightMobile,
		paddingLeftMobile,
		//Tablet
		paddingTopTablet,
		paddingBottomTablet,
		paddingRightTablet,
		paddingLeftTablet,
		spacingLink,
		paddingUnit,
		mobilePaddingUnit,
		tabletPaddingUnit,
		authorColor,
		summaryColor,
		starActiveColor,
		starOutlineColor,
		enableDescription,
		enableImage,
		overallAlignment,
		isbn,
		bookAuthorName,
		reviewPublisher,
		provider,
		appCategory,
		operatingSystem,
		datecreated,
		directorname,
		headTransform,
		headDecoration,
		subHeadTransform,
		subHeadDecoration,
		contentTransform,
		contentDecoration,
		headFontStyle,
		subHeadFontStyle,
		contentFontStyle,
		headLetterSpacing,
		headLetterSpacingTablet,
		headLetterSpacingMobile,
		headLetterSpacingType,
		subHeadLetterSpacing,
		subHeadLetterSpacingTablet,
		subHeadLetterSpacingMobile,
		subHeadLetterSpacingType,
		contentLetterSpacing,
		contentLetterSpacingTablet,
		contentLetterSpacingMobile,
		contentLetterSpacingType,
		courseMode,
		repeatCount,
		repeatFrequency,
		categoryOfCourse,
		courseLocation,
	} = attributes;

	const onItemTypeChange = ( value ) => {
		setAttributes( { itemType: value } );
		if ( itemType === 'Movie' ) {
			setAttributes( { enableImage: true } );
		}
		if ( itemType === 'Course' ) {
			setAttributes( { enableDescription: true } );
		}
		if (
			! subtypeCategories.hasOwnProperty( itemType ) ||
			! subtypeCategories[ itemType ].includes( itemSubtype )
		) {
			setAttributes( { itemSubtype: 'None' } );
		}
	};

	/*
	 * Event to set Image as while adding.
	 */
	const onSelectImage = ( media ) => {
		if ( ! media || ! media.url ) {
			setAttributes( { mainimage: null } );
			return;
		}

		if ( ! media.type || 'image' !== media.type ) {
			setAttributes( { mainimage: null } );
			return;
		}

		setAttributes( { mainimage: media } );
	};

	/*
	 * Event to set Image as null while removing.
	 */
	const onRemoveImage = () => {
		setAttributes( { mainimage: '' } );
	};

	const toggleTarget = () => {
		setAttributes( { ctaTarget: ! ctaTarget } );
	};

	const authorSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Author', 'vexaltrix' ) } initialOpen={ false }>
				<>
					<AdvancedPopColorControl
						label={ __( 'Color', 'vexaltrix' ) }
						colorValue={ authorColor }
						data={ {
							value: authorColor,
							label: 'authorColor',
						} }
						setAttributes={ setAttributes }
					/>
				</>
			</UAGAdvancedPanelBody>
		);
	};

	const contentSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Content', 'vexaltrix' ) } initialOpen={ false }>
				<>
					<AdvancedPopColorControl
						label={ __( 'Color', 'vexaltrix' ) }
						colorValue={ contentColor }
						data={ {
							value: contentColor,
							label: 'contentColor',
						} }
						setAttributes={ setAttributes }
					/>
				</>
			</UAGAdvancedPanelBody>
		);
	};

	const summarySettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Summary', 'vexaltrix' ) } initialOpen={ false }>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ summaryColor }
					data={ {
						value: summaryColor,
						label: 'summaryColor',
					} }
					setAttributes={ setAttributes }
				/>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ props.attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: contentLoadGoogleFonts,
						label: 'contentLoadGoogleFonts',
					} }
					fontFamily={ {
						value: contentFontFamily,
						label: 'contentFontFamily',
					} }
					fontWeight={ {
						value: contentFontWeight,
						label: 'contentFontWeight',
					} }
					fontStyle={ {
						value: contentFontStyle,
						label: 'contentFontStyle',
					} }
					transform={ {
						value: contentTransform,
						label: 'contentTransform',
					} }
					decoration={ {
						value: contentDecoration,
						label: 'contentDecoration',
					} }
					fontSizeType={ {
						value: contentFontSizeType,
						label: 'contentFontSizeType',
					} }
					fontSize={ {
						value: contentFontSize,
						label: 'contentFontSize',
					} }
					fontSizeMobile={ {
						value: contentFontSizeMobile,
						label: 'contentFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: contentFontSizeTablet,
						label: 'contentFontSizeTablet',
					} }
					lineHeightType={ {
						value: contentLineHeightType,
						label: 'contentLineHeightType',
					} }
					lineHeight={ {
						value: contentLineHeight,
						label: 'contentLineHeight',
					} }
					lineHeightMobile={ {
						value: contentLineHeightMobile,
						label: 'contentLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: contentLineHeightTablet,
						label: 'contentLineHeightTablet',
					} }
					letterSpacing={ {
						value: contentLetterSpacing,
						label: 'contentLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: contentLetterSpacingTablet,
						label: 'contentLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: contentLetterSpacingMobile,
						label: 'contentLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: contentLetterSpacingType,
						label: 'contentLetterSpacingType',
					} }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const starSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Star', 'vexaltrix' ) } initialOpen={ false }>
				<AdvancedPopColorControl
					label={ __( 'Active Color', 'vexaltrix' ) }
					colorValue={ starColor }
					data={ {
						value: starColor,
						label: 'starColor',
					} }
					setAttributes={ setAttributes }
				/>
				<AdvancedPopColorControl
					label={ __( 'Inactive Color', 'vexaltrix' ) }
					colorValue={ starActiveColor }
					data={ {
						value: starActiveColor,
						label: 'starActiveColor',
					} }
					setAttributes={ setAttributes }
				/>
				<AdvancedPopColorControl
					label={ __( 'Outline Color', 'vexaltrix' ) }
					colorValue={ starOutlineColor }
					data={ {
						value: starOutlineColor,
						label: 'starOutlineColor',
					} }
					setAttributes={ setAttributes }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const titleSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Title', 'vexaltrix' ) } initialOpen={ true }>
				<AdvancedPopColorControl
					label={ __( 'Color', 'vexaltrix' ) }
					colorValue={ titleColor }
					data={ {
						value: titleColor,
						label: 'titleColor',
					} }
					setAttributes={ setAttributes }
				/>
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ props.attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: headLoadGoogleFonts,
						label: 'headLoadGoogleFonts',
					} }
					fontFamily={ {
						value: headFontFamily,
						label: 'headFontFamily',
					} }
					fontWeight={ {
						value: headFontWeight,
						label: 'headFontWeight',
					} }
					fontStyle={ {
						value: headFontStyle,
						label: 'headFontStyle',
					} }
					transform={ {
						value: headTransform,
						label: 'headTransform',
					} }
					decoration={ {
						value: headDecoration,
						label: 'headDecoration',
					} }
					fontSizeType={ {
						value: headFontSizeType,
						label: 'headFontSizeType',
					} }
					fontSize={ { value: headFontSize, label: 'headFontSize' } }
					fontSizeMobile={ {
						value: headFontSizeMobile,
						label: 'headFontSizeMobile',
					} }
					fontSizeTablet={ {
						value: headFontSizeTablet,
						label: 'headFontSizeTablet',
					} }
					lineHeightType={ {
						value: headLineHeightType,
						label: 'headLineHeightType',
					} }
					lineHeight={ {
						value: headLineHeight,
						label: 'headLineHeight',
					} }
					lineHeightMobile={ {
						value: headLineHeightMobile,
						label: 'headLineHeightMobile',
					} }
					lineHeightTablet={ {
						value: headLineHeightTablet,
						label: 'headLineHeightTablet',
					} }
					letterSpacing={ {
						value: headLetterSpacing,
						label: 'headLetterSpacing',
					} }
					letterSpacingTablet={ {
						value: headLetterSpacingTablet,
						label: 'headLetterSpacingTablet',
					} }
					letterSpacingMobile={ {
						value: headLetterSpacingMobile,
						label: 'headLetterSpacingMobile',
					} }
					letterSpacingType={ {
						value: headLetterSpacingType,
						label: 'headLetterSpacingType',
					} }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const descriptionSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Description', 'vexaltrix' ) } initialOpen={ false }>
				{ enableDescription === true && (
					<>
						<AdvancedPopColorControl
							label={ __( 'Color', 'vexaltrix' ) }
							colorValue={ descColor }
							data={ {
								value: descColor,
								label: 'descColor',
							} }
							setAttributes={ setAttributes }
						/>
						<TypographyControl
							label={ __( 'Typography', 'vexaltrix' ) }
							attributes={ props.attributes }
							setAttributes={ setAttributes }
							loadGoogleFonts={ {
								value: subHeadLoadGoogleFonts,
								label: 'subHeadLoadGoogleFonts',
							} }
							fontFamily={ {
								value: subHeadFontFamily,
								label: 'subHeadFontFamily',
							} }
							fontWeight={ {
								value: subHeadFontWeight,
								label: 'subHeadFontWeight',
							} }
							fontStyle={ {
								value: subHeadFontStyle,
								label: 'subHeadFontStyle',
							} }
							transform={ {
								value: subHeadTransform,
								label: 'subHeadTransform',
							} }
							decoration={ {
								value: subHeadDecoration,
								label: 'subHeadDecoration',
							} }
							fontSizeType={ {
								value: subHeadFontSizeType,
								label: 'subHeadFontSizeType',
							} }
							fontSize={ {
								value: subHeadFontSize,
								label: 'subHeadFontSize',
							} }
							fontSizeMobile={ {
								value: subHeadFontSizeMobile,
								label: 'subHeadFontSizeMobile',
							} }
							fontSizeTablet={ {
								value: subHeadFontSizeTablet,
								label: 'subHeadFontSizeTablet',
							} }
							lineHeightType={ {
								value: subHeadLineHeightType,
								label: 'subHeadLineHeightType',
							} }
							lineHeight={ {
								value: subHeadLineHeight,
								label: 'subHeadLineHeight',
							} }
							lineHeightMobile={ {
								value: subHeadLineHeightMobile,
								label: 'subHeadLineHeightMobile',
							} }
							lineHeightTablet={ {
								value: subHeadLineHeightTablet,
								label: 'subHeadLineHeightTablet',
							} }
							letterSpacing={ {
								value: subHeadLetterSpacing,
								label: 'subHeadLetterSpacing',
							} }
							letterSpacingTablet={ {
								value: subHeadLetterSpacingTablet,
								label: 'subHeadLetterSpacingTablet',
							} }
							letterSpacingMobile={ {
								value: subHeadLetterSpacingMobile,
								label: 'subHeadLetterSpacingMobile',
							} }
							letterSpacingType={ {
								value: subHeadLetterSpacingType,
								label: 'subHeadLetterSpacingType',
							} }
						/>
					</>
				) }
			</UAGAdvancedPanelBody>
		);
	};

	const schemaSettings = () => {
		if ( true === enableSchema ) {
			return (
				<UAGAdvancedPanelBody title={ __( 'Schema', 'vexaltrix' ) } initialOpen={ false }>
					<UAGSelectControl
						label={ __( 'Item Type', 'vexaltrix' ) }
						data={ {
							value: itemType,
						} }
						onChange={ onItemTypeChange }
						options={ [
							{
								value: 'Book',
								label: __( 'Book', 'vexaltrix' ),
							},
							{
								value: 'Course',
								label: __( 'Course', 'vexaltrix' ),
							},
							{
								value: 'Movie',
								label: __( 'Movie', 'vexaltrix' ),
							},
							{
								value: 'Product',
								label: __( 'Product', 'vexaltrix' ),
							},
							{
								value: 'SoftwareApplication',
								label: __( 'Software Application', 'vexaltrix' ),
							},
						] }
					/>
					{ subtypeCategories.hasOwnProperty( itemType ) && (
						<UAGSelectControl
							label={ __( 'Item Subtype', 'vexaltrix' ) }
							data={ {
								value: itemSubtype,
								label: 'itemSubtype',
							} }
							setAttributes={ setAttributes }
							options={ [
								{
									value: 'none',
									label: __( 'None', 'vexaltrix' ),
								},
								...subtypeCategories[ itemType ],
							] }
						/>
					) }

					{ itemTypeExtras }
					<UAGTextControl
						label={ __( 'Review Publisher', 'vexaltrix' ) }
						value={ reviewPublisher }
						data={ {
							value: reviewPublisher,
							label: 'reviewPublisher',
						} }
						setAttributes={ setAttributes }
						onChange={ ( value ) => setAttributes( { reviewPublisher: value } ) }
						help={ __( 'Note: This is a mandatory field for the Review schema', 'vexaltrix' ) }
					/>
					<h2>{ __( 'Date Of Publish', 'vexaltrix' ) }</h2>
					<DateTimePicker
						className="vxt-date-picker"
						currentDate={ datepublish }
						onChange={ ( value ) => setAttributes( { datepublish: value } ) }
						is12Hour={ true }
					/>
					{ [ 'Product', 'SoftwareApplication' ].includes( itemType ) && (
						<>
							{ [ 'Product' ].includes( itemType ) && (
								<>
									<UAGTextControl
										label={ __( 'Brand', 'vexaltrix' ) }
										value={ brand }
										data={ {
											value: brand,
											label: 'brand',
										} }
										setAttributes={ setAttributes }
										onChange={ ( value ) => setAttributes( { brand: value } ) }
									/>
									<UAGTextControl
										label={ __( 'SKU', 'vexaltrix' ) }
										value={ sku }
										data={ {
											value: sku,
											label: 'sku',
										} }
										setAttributes={ setAttributes }
										onChange={ ( value ) => setAttributes( { sku: value } ) }
									/>
									<UAGTextControl
										label={ __( 'Identifier', 'vexaltrix' ) }
										value={ identifier }
										data={ {
											value: identifier,
											label: 'identifier',
										} }
										setAttributes={ setAttributes }
										onChange={ ( value ) =>
											setAttributes( {
												identifier: value,
											} )
										}
									/>
									<UAGSelectControl
										label={ __( 'Identifier Type', 'vexaltrix' ) }
										data={ {
											value: identifierType,
											label: 'identifierType',
										} }
										setAttributes={ setAttributes }
										options={ [ 'nsn', 'mpn', 'gtin8', 'gtin12', 'gtin13', 'gtin14', 'gtin' ].map(
											( a ) => ( {
												label: a.toUpperCase(),
												value: a,
											} )
										) }
									/>
								</>
							) }
							{ [ 'Product', 'SoftwareApplication' ].includes( itemType ) && (
								<>
									<UAGTextControl
										label={ __( 'Offer Currency', 'vexaltrix' ) }
										value={ offerCurrency }
										data={ {
											value: offerCurrency,
											label: 'offerCurrency',
										} }
										setAttributes={ setAttributes }
										onChange={ ( value ) =>
											setAttributes( {
												offerCurrency: value,
											} )
										}
									/>
								</>
							) }
							{ offerType === 'Offer' && (
								<>
									<UAGTextControl
										label={ __( 'Offer Price', 'vexaltrix' ) }
										value={ offerPrice }
										data={ {
											value: offerPrice,
											label: 'offerPrice',
										} }
										setAttributes={ setAttributes }
										onChange={ ( value ) =>
											setAttributes( {
												offerPrice: value,
											} )
										}
										help={ __(
											'Note: This is a mandatory field for the Review schema',
											'vexaltrix'
										) }
									/>
									<UAGSelectControl
										label={ __( 'Offer Status', 'vexaltrix' ) }
										data={ {
											value: offerStatus,
											label: 'offerStatus',
										} }
										setAttributes={ props.setAttributes }
										options={ [
											{
												value: 'https://schema.org/Discontinued',
												label: __( 'Discontinued', 'vexaltrix' ),
											},
											{
												value: 'https://schema.org/InStock',
												label: __( 'In Stock', 'vexaltrix' ),
											},
											{
												value: 'https://schema.org/InStoreOnly',
												label: __( 'In Store Only', 'vexaltrix' ),
											},
											{
												value: 'https://schema.org/LimitedAvailability',
												label: __( 'Limited Availability', 'vexaltrix' ),
											},
											{
												value: 'https://schema.org/OnlineOnly',
												label: __( 'Online Only', 'vexaltrix' ),
											},
											{
												value: 'https://schema.org/OutOfStock',
												label: __( 'Out Of Stock', 'vexaltrix' ),
											},
											{
												value: 'https://schema.org/PreOrder',
												label: __( 'Pre Order', 'vexaltrix' ),
											},
											{
												value: 'https://schema.org/PreSale',
												label: __( 'Pre Sale', 'vexaltrix' ),
											},
											{
												value: 'https://schema.org/SoldOut',
												label: __( 'Sold Out', 'vexaltrix' ),
											},
										] }
									/>
									<h2>{ __( 'Price Valid Until', 'vexaltrix' ) }</h2>
									<DateTimePicker
										className="vxt-date-picker"
										currentDate={ offerExpiry }
										onChange={ ( value ) =>
											setAttributes( {
												offerExpiry: value,
											} )
										}
										is12Hour={ true }
									/>
								</>
							) }
						</>
					) }
				</UAGAdvancedPanelBody>
			);
		}
	};

	const overallPadding = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Spacing', 'vexaltrix' ) } initialOpen={ false }>
				<SpacingControl
					{ ...props }
					label={ __( 'Padding', 'vexaltrix' ) }
					valueTop={ {
						value: topPadding,
						label: 'topPadding',
					} }
					valueRight={ {
						value: rightPadding,
						label: 'rightPadding',
					} }
					valueBottom={ {
						value: bottomPadding,
						label: 'bottomPadding',
					} }
					valueLeft={ {
						value: leftPadding,
						label: 'leftPadding',
					} }
					valueTopTablet={ {
						value: paddingTopTablet,
						label: 'paddingTopTablet',
					} }
					valueRightTablet={ {
						value: paddingRightTablet,
						label: 'paddingRightTablet',
					} }
					valueBottomTablet={ {
						value: paddingBottomTablet,
						label: 'paddingBottomTablet',
					} }
					valueLeftTablet={ {
						value: paddingLeftTablet,
						label: 'paddingLeftTablet',
					} }
					valueTopMobile={ {
						value: paddingTopMobile,
						label: 'paddingTopMobile',
					} }
					valueRightMobile={ {
						value: paddingRightMobile,
						label: 'paddingRightMobile',
					} }
					valueBottomMobile={ {
						value: paddingBottomMobile,
						label: 'paddingBottomMobile',
					} }
					valueLeftMobile={ {
						value: paddingLeftMobile,
						label: 'paddingLeftMobile',
					} }
					unit={ {
						value: paddingUnit,
						label: 'paddingUnit',
					} }
					mUnit={ {
						value: mobilePaddingUnit,
						label: 'mobilePaddingUnit',
					} }
					tUnit={ {
						value: tabletPaddingUnit,
						label: 'tabletPaddingUnit',
					} }
					attributes={ attributes }
					setAttributes={ setAttributes }
					link={ {
						value: spacingLink,
						label: 'spacingLink',
					} }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const proUpgradePanel = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Dynamic Content', 'vexaltrix' ) }>
				<UpgradeComponent
					control={ {
						title: __(
							'Experience dynamic content with Vexaltrix Pro. No more static displays. Personalize your user experience.',
							'vexaltrix'
						),
						renderAs: 'list',
						campaign: 'dynamic-content',
					} }
				/>
			</UAGAdvancedPanelBody>
		);
	};

	const generalSettings = () => {
		if ( mainimage && mainimage.sizes ) {
			imageSizeOptions = getImageSize( mainimage.sizes );
		}

		return (
			<UAGAdvancedPanelBody title={ __( 'General', 'vexaltrix' ) } initialOpen={ true }>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Review Title Tag', 'vexaltrix' ) }
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
					] }
				/>
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Alignment', 'vexaltrix' ) }
					data={ {
						value: overallAlignment,
						label: 'overallAlignment',
					} }
					className="vxt-multi-button-alignment-control"
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
				<ToggleControl
					label={ __( 'Enable Schema Support', 'vexaltrix' ) }
					checked={ enableSchema }
					onChange={ () => setAttributes( { enableSchema: ! enableSchema } ) }
				/>
				<ToggleControl
					label={ __( 'Show Review Description', 'vexaltrix' ) }
					checked={ enableDescription }
					onChange={ () =>
						setAttributes( {
							enableDescription: ! enableDescription,
						} )
					}
					help={ __( 'Note: This is a mandatory field for the Review schema.', 'vexaltrix' ) }
				/>
				<ToggleControl
					label={ __( 'Show Review Author', 'vexaltrix' ) }
					checked={ showAuthor }
					onChange={ () => setAttributes( { showAuthor: ! showAuthor } ) }
					help={ __( 'Note: This is a mandatory field for the Review schema.', 'vexaltrix' ) }
				/>
				<ToggleControl
					label={ __( 'Show Ratings', 'vexaltrix' ) }
					checked={ showFeature }
					onChange={ () => setAttributes( { showFeature: ! showFeature } ) }
					help={ __( 'Note: Add feature/section ratings separately.', 'vexaltrix' ) }
				/>
				<ToggleControl
					label={ __( 'Show Review Image', 'vexaltrix' ) }
					checked={ enableImage }
					onChange={ () => setAttributes( { enableImage: ! enableImage } ) }
					help={ __( 'Note: This is a mandatory field for the Review schema.', 'vexaltrix' ) }
				/>
				<UAGTextControl
					label={ __( 'Link', 'vexaltrix' ) }
					value={ ctaLink }
					data={ {
						value: ctaLink,
						label: 'ctaLink',
					} }
					setAttributes={ setAttributes }
					onChange={ ( value ) => setAttributes( { ctaLink: value } ) }
				/>
				<ToggleControl
					label={ __( 'Open in new window', 'vexaltrix' ) }
					checked={ ctaTarget }
					onChange={ toggleTarget }
				/>
			</UAGAdvancedPanelBody>
		);
	};
	const imageSettings = () => {
		return (
			<UAGAdvancedPanelBody title={ __( 'Image', 'vexaltrix' ) } initialOpen={ false }>
				<>
					<UAGMediaPicker
						onSelectImage={ onSelectImage }
						backgroundImage={ mainimage }
						onRemoveImage={ onRemoveImage }
						disableLabel={ true }
					/>
					{ mainimage && mainimage !== 'null' && mainimage.url !== 'null' && mainimage.url !== '' && (
						<UAGSelectControl
							label={ __( 'Size', 'vexaltrix' ) }
							data={ {
								value: imgSize,
								label: 'imgSize',
							} }
							setAttributes={ setAttributes }
							options={ imageSizeOptions }
						/>
					) }
				</>
			</UAGAdvancedPanelBody>
		);
	};

	let itemTypeExtras;

	const subtypeCategories = {
		Book: [
			{
				value: 'Audiobook',
				label: __( 'Audio book', 'vexaltrix' ),
			},
		],
		Product: [
			{
				value: 'IndividualProduct',
				label: __( 'Individual Product', 'vexaltrix' ),
			},
			{
				value: 'ProductCollection',
				label: __( 'Product Collection', 'vexaltrix' ),
			},
			{
				value: 'ProductGroup',
				label: __( 'Product Group', 'vexaltrix' ),
			},
			{
				value: 'ProductModel',
				label: __( 'Product Model', 'vexaltrix' ),
			},
			{
				value: 'SomeProducts',
				label: __( 'Some Products', 'vexaltrix' ),
			},
			{
				value: 'Vehicle',
				label: __( 'Vehicle', 'vexaltrix' ),
			},
		],
		SoftwareApplication: [
			{
				value: 'MobileApplication',
				label: __( 'Mobile Application', 'vexaltrix' ),
			},
			{
				value: 'VideoGame',
				label: __( 'Video Game', 'vexaltrix' ),
			},
			{
				value: 'WebApplication',
				label: __( 'Web Application', 'vexaltrix' ),
			},
		],
	};

	switch ( itemType ) {
		default:
			//empty
			break;
		case 'Book':
			itemTypeExtras = (
				<>
					<UAGTextControl
						label={ __( 'ISBN', 'vexaltrix' ) }
						value={ isbn }
						data={ {
							value: isbn,
							label: 'isbn',
						} }
						setAttributes={ setAttributes }
						onChange={ ( value ) => setAttributes( { isbn: value } ) }
						help={ __( 'Note: This is a mandatory field for the Review schema', 'vexaltrix' ) }
					/>
					<UAGTextControl
						label={ __( 'Book author name', 'vexaltrix' ) }
						value={ bookAuthorName }
						data={ {
							value: bookAuthorName,
							label: 'bookAuthorName',
						} }
						setAttributes={ setAttributes }
						onChange={ ( value ) => setAttributes( { bookAuthorName: value } ) }
						help={ __( 'Note: This is a mandatory field for the Review schema', 'vexaltrix' ) }
					/>
				</>
			);
			break;

		case 'Course':
			itemTypeExtras = (
				<>
					<UAGTextControl
						label={ __( 'Provider', 'vexaltrix' ) }
						value={ provider }
						data={ {
							value: provider,
							label: 'provider',
						} }
						setAttributes={ setAttributes }
						onChange={ ( value ) => setAttributes( { provider: value } ) }
						help={ __(
							'Note: This is a mandatory field for the Review schema, It contain information about the organization that created the content for the course.',
							'vexaltrix'
						) }
					/>
					<UAGSelectControl
						label={ __( 'Mode', 'vexaltrix' ) }
						data={ {
							value: courseMode,
							label: 'courseMode',
						} }
						setAttributes={ setAttributes }
						options={ [
							{
								value: 'Online',
								label: __( 'Online', 'vexaltrix' ),
							},
							{
								value: 'Onsite',
								label: __( 'Onsite', 'vexaltrix' ),
							},
							{
								value: 'Blended',
								label: __( 'Blended', 'vexaltrix' ),
							},
						] }
						help={ __(
							'Note: This is a mandatory field for the Review schema, It contain information of medium through which the course will be delivered.',
							'vexaltrix'
						) }
					/>
					{ ( 'Onsite' === courseMode || 'Blended' === courseMode ) && (
						<UAGTextControl
							label={ __( 'Location', 'vexaltrix' ) }
							value={ courseLocation }
							data={ {
								value: courseLocation,
								label: 'courseLocation',
							} }
							setAttributes={ setAttributes }
							onChange={ ( value ) => setAttributes( { courseLocation: value } ) }
							help={ __(
								'Note: This property is only required for Onsite or Blended courses, It contain name or address (or both) of the physical location where the course will be taught.',
								'vexaltrix'
							) }
						/>
					) }
					<UAGSelectControl
						label={ __( 'Frequency', 'vexaltrix' ) }
						layout={ 'stack' }
						data={ {
							value: repeatFrequency,
							label: 'repeatFrequency',
						} }
						setAttributes={ setAttributes }
						options={ [
							{
								value: 'Daily',
								label: __( 'Daily', 'vexaltrix' ),
							},
							{
								value: 'Weekly',
								label: __( 'Weekly', 'vexaltrix' ),
							},
							{
								value: 'Monthly',
								label: __( 'Monthly', 'vexaltrix' ),
							},
							{
								value: 'Yearly',
								label: __( 'Yearly', 'vexaltrix' ),
							},
						] }
						help={ __(
							'Note: This is a mandatory field for the Review schema, It contain information of course happens Daily / Weekly / Monthly or Yearly.',
							'vexaltrix'
						) }
					/>
					<UAGNumberControl
						label={ __( 'Duration', 'vexaltrix' ) }
						value={ repeatCount }
						data={ {
							value: repeatCount,
							label: 'repeatCount',
						} }
						displayUnit={ false }
						setAttributes={ setAttributes }
						min={ 1 }
						help={ __(
							'Note: This is a mandatory field for the Review schema, It contain the numerical value for how long the course lasts for in Frequency units. For example, if the Frequency is monthly and the Duration is 4, the course lasts for 4 months.',
							'vexaltrix'
						) }
						showControlHeader={ false }
						name="totalNumber"
					/>
					<UAGSelectControl
						label={ __( 'Pricing Category', 'vexaltrix' ) }
						layout={ 'stack' }
						data={ {
							value: categoryOfCourse,
							label: 'categoryOfCourse',
						} }
						setAttributes={ setAttributes }
						options={ [
							{
								value: 'Free',
								label: __( 'Free', 'vexaltrix' ),
							},
							{
								value: 'Partially Free',
								label: __( 'Partially Free', 'vexaltrix' ),
							},
							{
								value: 'Subscription',
								label: __( 'Subscription', 'vexaltrix' ),
							},
							{
								value: 'Paid',
								label: __( 'Paid', 'vexaltrix' ),
							},
						] }
						help={ __(
							'Note: This is a mandatory field for the Review schema, It contain information of pricing category of the course.',
							'vexaltrix'
						) }
					/>
				</>
			);

			break;

		case 'SoftwareApplication':
			itemTypeExtras = (
				<>
					<UAGTextControl
						label={ __( 'Application Category', 'vexaltrix' ) }
						value={ appCategory }
						data={ {
							value: appCategory,
							label: 'appCategory',
						} }
						setAttributes={ setAttributes }
						onChange={ ( value ) => setAttributes( { appCategory: value } ) }
					/>
					<UAGTextControl
						label={ __( 'Operating System', 'vexaltrix' ) }
						value={ operatingSystem }
						data={ {
							value: operatingSystem,
							label: 'operatingSystem',
						} }
						setAttributes={ setAttributes }
						onChange={ ( value ) => setAttributes( { operatingSystem: value } ) }
					/>
				</>
			);
			break;

		case 'Movie':
			itemTypeExtras = (
				<>
					<UAGTextControl
						label={ __( 'Director Name', 'vexaltrix' ) }
						value={ directorname }
						data={ {
							value: directorname,
							label: 'directorname',
						} }
						setAttributes={ setAttributes }
						onChange={ ( value ) => setAttributes( { directorname: value } ) }
					/>
					<h2>{ __( 'Date of create', 'vexaltrix' ) }</h2>
					<DateTimePicker
						currentDate={ datecreated }
						onChange={ ( value ) => setAttributes( { datecreated: value } ) }
						is12Hour={ true }
					/>
				</>
			);
			break;
	}

	return (
		<>
			<InspectorControls>
				<InspectorTabs>
					<InspectorTab { ...UAGTabs.general }>
						{ generalSettings() }
						{ enableImage === true && imageSettings() }
						{ schemaSettings() }
						{ 'not-installed' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status &&
							proUpgradePanel() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.style }>
						{ titleSettings() }
						{ enableDescription && descriptionSettings() }
						{ showAuthor === true && authorSettings() }
						{ showFeature === true && contentSettings() }
						{ summarySettings() }
						{ starSettings() }
						{ overallPadding() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
				</InspectorTabs>
			</InspectorControls>
		</>
	);
};
export default memo( Settings );
