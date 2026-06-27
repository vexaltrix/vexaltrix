import { useEffect, useState } from '@wordpress/element';
import TypographyControl from '@Components/typography';
import { useViewportMatch } from '@wordpress/compose';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import ResponsiveSelectControl from '@Components/responsive-select';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import SpacingControl from '@Components/spacing-control';
import Range from '@Components/range/Range.js';
import UAGMediaPicker from '@Components/image';
import BoxShadowControl from '@Components/box-shadow';
import { useSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';
import MultiButtonsControl from '@Components/multi-buttons-control';
import UAGSelectControl from '@Components/select-control';
import UAGTextControl from '@Components/text-control';
import { store as blockEditorStore, InspectorControls } from '@wordpress/block-editor';
import { Icon, ToggleControl } from '@wordpress/components';
import UAGTabsControl from '@Components/tabs';
import renderSVG from '@Controls/renderIcon';
import ImageSizeControl from '@Components/image-size-control';
import ResponsiveBorder from '@Components/responsive-border';
import VexaltrixMatrixControl from '@Components/matrix-alignment-control';
import { store as coreStore } from '@wordpress/core-data';
// Extend component
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import boxShadowPresets, { boxShadowHoverPresets } from './presets';
import UAGPresets from '@Components/presets';
import { pickRelevantMediaFiles, getDevicesAttributes } from './utils';
import renderGBSSettings from '@Controls/renderGBSSettings';
import styling from './styling';
import UpgradeComponent from '@Components/upgrade-to-pro-cta';

export default function Settings( props ) {
	const { attributes, setAttributes, context, isSelected, clientId, deviceType } = props;
	const {
		block_id,
		objectFit,
		objectFitTablet,
		objectFitMobile,
		layout,
		id,
		url,
		urlTablet,
		urlMobile,
		width,
		widthTablet,
		widthMobile,
		height,
		heightTablet,
		heightMobile,
		align,
		alignTablet,
		alignMobile,
		alt,
		title,
		sizeSlug,
		sizeSlugTablet,
		sizeSlugMobile,
		enableCaption,
		// image
		naturalWidth,
		naturalHeight,
		imageTopMargin,
		imageRightMargin,
		imageLeftMargin,
		imageBottomMargin,
		imageTopMarginTablet,
		imageRightMarginTablet,
		imageLeftMarginTablet,
		imageBottomMarginTablet,
		imageTopMarginMobile,
		imageRightMarginMobile,
		imageLeftMarginMobile,
		imageBottomMarginMobile,
		imageMarginUnit,
		imageMarginUnitTablet,
		imageMarginUnitMobile,
		imageMarginLink,
		// caption
		captionShowOn,
		captionLoadGoogleFonts,
		captionAlign,
		captionFontFamily,
		captionFontWeight,
		captionFontStyle,
		captionFontSize,
		captionColor,
		captionTransform,
		captionDecoration,
		captionFontSizeType,
		captionFontSizeTypeMobile,
		captionFontSizeTypeTablet,
		captionFontSizeMobile,
		captionFontSizeTablet,
		captionLineHeight,
		captionLineHeightType,
		captionLineHeightMobile,
		captionLineHeightTablet,
		captionTopMargin,
		captionRightMargin,
		captionLeftMargin,
		captionBottomMargin,
		captionTopMarginTablet,
		captionRightMarginTablet,
		captionLeftMarginTablet,
		captionBottomMarginTablet,
		captionTopMarginMobile,
		captionRightMarginMobile,
		captionLeftMarginMobile,
		captionBottomMarginMobile,
		captionMarginUnit,
		captionMarginUnitTablet,
		captionMarginUnitMobile,
		captionMarginLink,
		// heading
		headingTag,
		headingShowOn,
		headingLoadGoogleFonts,
		headingFontFamily,
		headingFontWeight,
		headingFontStyle,
		headingFontSize,
		headingColor,
		headingTransform,
		headingDecoration,
		headingFontSizeType,
		headingFontSizeTypeMobile,
		headingFontSizeTypeTablet,
		headingFontSizeMobile,
		headingFontSizeTablet,
		headingLineHeight,
		headingLineHeightType,
		headingLineHeightMobile,
		headingLineHeightTablet,
		headingTopMargin,
		headingRightMargin,
		headingLeftMargin,
		headingBottomMargin,
		headingTopMarginTablet,
		headingRightMarginTablet,
		headingLeftMarginTablet,
		headingBottomMarginTablet,
		headingTopMarginMobile,
		headingRightMarginMobile,
		headingLeftMarginMobile,
		headingBottomMarginMobile,
		headingMarginUnit,
		headingMarginUnitTablet,
		headingMarginUnitMobile,
		headingMarginLink,
		// overlay
		overlayPositionFromEdge,
		overlayPositionFromEdgeUnit,
		overlayContentPosition,
		overlayBackground,
		overlayOpacity,
		overlayHoverOpacity,
		// seperator
		seperatorShowOn,
		seperatorStyle,
		seperatorWidth,
		separatorWidthType,
		seperatorThickness,
		seperatorThicknessUnit,
		seperatorPosition,
		seperatorColor,
		seperatorTopMargin,
		seperatorRightMargin,
		seperatorLeftMargin,
		seperatorBottomMargin,
		seperatorTopMarginTablet,
		seperatorRightMarginTablet,
		seperatorLeftMarginTablet,
		seperatorBottomMarginTablet,
		seperatorTopMarginMobile,
		seperatorRightMarginMobile,
		seperatorLeftMarginMobile,
		seperatorBottomMarginMobile,
		seperatorMarginUnit,
		seperatorMarginUnitTablet,
		seperatorMarginUnitMobile,
		seperatorMarginLink,
		// effect
		imageHoverEffect,
		// shadow
		useSeparateBoxShadows,
		imageBoxShadowColor,
		imageBoxShadowHOffset,
		imageBoxShadowVOffset,
		imageBoxShadowBlur,
		imageBoxShadowSpread,
		imageBoxShadowPosition,
		imageBoxShadowColorHover,
		imageBoxShadowHOffsetHover,
		imageBoxShadowVOffsetHover,
		imageBoxShadowBlurHover,
		imageBoxShadowSpreadHover,
		imageBoxShadowPositionHover,
		// mask
		maskShape,
		maskCustomShape,
		maskSize,
		maskPosition,
		maskRepeat,
		headingLetterSpacing,
		headingLetterSpacingTablet,
		headingLetterSpacingMobile,
		headingLetterSpacingType,
		captionLetterSpacing,
		captionLetterSpacingTablet,
		captionLetterSpacingMobile,
		captionLetterSpacingType,
		disableLazyLoad,
		imgRole,
	} = attributes;

	const { imageSizes } = useSelect(
		( select ) => {
			const { getSettings } = select( blockEditorStore );

			const { imageSizes } = getSettings();
			return { imageSizes };
		},
		[ clientId ]
	);

	const { image } = useSelect(
		( select ) => {
			const { getMedia } = select( coreStore );
			return {
				image: id && isSelected ? getMedia( id ) : null,
			};
		},
		[ id, isSelected ]
	);

	const { imageDefaultSize } = useSelect( ( select ) => {
		const { getSettings } = select( blockEditorStore );

		const { imageDefaultSize } = getSettings();
		return { imageDefaultSize };
	}, [] );

	const [ currentSizes, setCurrentSizes ] = useState( {
		desktop: sizeSlug,
		tablet: sizeSlugTablet,
		mobile: sizeSlugMobile,
	} );

	useEffect( () => {
		if ( ! sizeSlug ) {
			return;
		}
		switch ( deviceType ) {
			case 'Mobile':
				if ( 'custom' === sizeSlugMobile && currentSizes.mobile !== sizeSlugMobile ) {
					setAttributes( { objectFitMobile: 'cover' } );
				} else if ( 'custom' !== sizeSlugMobile ) {
					updateMobileImage( sizeSlugMobile );
				}
				setCurrentSizes( { ...currentSizes, mobile: sizeSlugMobile } );
				break;
			case 'Tablet':
				if ( 'custom' === sizeSlugTablet && currentSizes.tablet !== sizeSlugTablet ) {
					setAttributes( { objectFitTablet: 'cover' } );
				} else if ( 'custom' !== sizeSlugTablet ) {
					updateTabletImage( sizeSlugTablet );
				}
				setCurrentSizes( { ...currentSizes, tablet: sizeSlugTablet } );
				break;
			default:
				if ( 'custom' === sizeSlug && currentSizes.desktop !== sizeSlug ) {
					setAttributes( { objectFit: 'cover' } );
				} else if ( 'custom' !== sizeSlug ) {
					updateImage( sizeSlug );
				}
				setCurrentSizes( { ...currentSizes, desktop: sizeSlug } );
		}
	}, [ sizeSlug, sizeSlugTablet, sizeSlugMobile ] );

	const { allowResize = true } = context;
	const isLargeViewport = useViewportMatch( 'medium' );
	const isWideAligned = [ 'wide', 'full' ].includes( align );
	const isResizable = allowResize && ! ( isWideAligned && isLargeViewport );
	const imageSizeOptions =
		image?.media_details &&
		imageSizes.reduce(
			( acc, item ) => {
				if ( image?.media_details?.sizes[ item.slug ] ) {
					const custom = acc.pop();
					acc.push( { value: item.slug, label: item.name }, custom );
				}
				return acc;
			},
			[ { value: 'custom', label: 'Custom' } ]
		);

	const updateImage = ( newSizeSlug ) => {
		const newUrl = image?.media_details?.sizes[ newSizeSlug ];
		if ( ! newUrl || newUrl?.source_url === url ) {
			return null;
		}
		setAttributes( {
			url: newUrl?.source_url,
			width: newUrl?.width,
			height: newUrl?.height,
			sizeSlug: newSizeSlug,
		} );
	};

	const updateTabletImage = ( newSizeSlug ) => {
		const newUrl = image?.media_details?.sizes[ newSizeSlug ];
		if ( ! newUrl || newUrl?.source_url === urlTablet ) {
			return null;
		}
		setAttributes( {
			urlTablet: newUrl?.source_url,
			widthTablet: newUrl?.width,
			heightTablet: newUrl?.height,
			sizeSlugTablet: newSizeSlug,
		} );
	};

	const updateMobileImage = ( newSizeSlug ) => {
		const newUrl = image?.media_details?.sizes[ newSizeSlug ];
		if ( ! newUrl || newUrl?.source_url === urlMobile ) {
			return null;
		}
		setAttributes( {
			urlMobile: newUrl?.source_url,
			widthMobile: newUrl?.width,
			heightMobile: newUrl?.height,
			sizeSlugMobile: newSizeSlug,
		} );
	};

	/*
	 * Event to set Image as null while removing.
	 */
	const onRemoveImage = () => {
		setAttributes( {
			url: undefined,
			urlTablet: undefined,
			urlMobile: undefined,
			alt: undefined,
			id: undefined,
			title: undefined,
			caption: undefined,
			width: undefined,
			widthTablet: undefined,
			widthMobile: undefined,
			height: undefined,
			heightTablet: undefined,
			heightMobile: undefined,
		} );
	};

	/*
	 * Event to set Image as while adding.
	 */
	const onSelectImage = ( media ) => {
		if ( ! media || ! media.url ) {
			setAttributes( {
				url: undefined,
				alt: undefined,
				id: undefined,
				title: undefined,
				caption: undefined,
			} );

			return;
		}

		let mediaAttributes = pickRelevantMediaFiles( media, imageDefaultSize );
		mediaAttributes = {
			...mediaAttributes,
			...getDevicesAttributes( media, 'Tablet' ),
			...getDevicesAttributes( media, 'Mobile' ),
		};

		// If Custom Sizing was set, remove the size reset.
		if ( 'custom' === sizeSlug ) {
			delete mediaAttributes.width;
			delete mediaAttributes.height;
		}

		setAttributes( mediaAttributes );
	};

	/*
	 * Event to set Image as while adding.
	 */
	const onSelectCustomMaskShape = ( media ) => {
		if ( ! media || ! media.url ) {
			setAttributes( { maskCustomShape: null } );
			return;
		}

		if ( ! media.type || 'image' !== media.type ) {
			return;
		}

		setAttributes( { maskCustomShape: media } );
	};

	const onRemoveMaskCustomShape = () => {
		setAttributes( { maskCustomShape: null } );
	};

	const objectFitOptions = {
		desktop: [
			{
				value: '',
				label: __( 'Default', 'vexaltrix' ),
			},
			{
				value: 'fill',
				label: __( 'Fill', 'vexaltrix' ),
			},
			{
				value: 'cover',
				label: __( 'Cover', 'vexaltrix' ),
			},
			{
				value: 'contain',
				label: __( 'Contain', 'vexaltrix' ),
			},
		],
		tablet: [
			{
				value: '',
				label: __( 'Default', 'vexaltrix' ),
			},
			{
				value: 'fill',
				label: __( 'Fill', 'vexaltrix' ),
			},
			{
				value: 'cover',
				label: __( 'Cover', 'vexaltrix' ),
			},
			{
				value: 'contain',
				label: __( 'Contain', 'vexaltrix' ),
			},
		],
		mobile: [
			{
				value: '',
				label: __( 'Default', 'vexaltrix' ),
			},
			{
				value: 'fill',
				label: __( 'Fill', 'vexaltrix' ),
			},
			{
				value: 'cover',
				label: __( 'Cover', 'vexaltrix' ),
			},
			{
				value: 'contain',
				label: __( 'Contain', 'vexaltrix' ),
			},
		],
	};

	const generalPanel = (
		<UAGAdvancedPanelBody title={ __( 'Image', 'vexaltrix' ) } initialOpen={ true }>
			<UAGMediaPicker
				onSelectImage={ onSelectImage }
				backgroundImage={ { id, url } }
				onRemoveImage={ onRemoveImage }
				disableLabel={ true }
			/>
			<ToggleControl
				label={ __( 'Disable Lazy Loading', 'vexaltrix' ) }
				checked={ disableLazyLoad }
				onChange={ () => {
					setAttributes( { disableLazyLoad: ! disableLazyLoad } );
				} }
			/>
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ __( 'Alignment', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: align,
						label: 'align',
					},
					tablet: {
						value: alignTablet,
						label: 'alignTablet',
					},
					mobile: {
						value: alignMobile,
						label: 'alignMobile',
					},
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
				responsive={ true }
				help={
					( 'left' === align || 'right' === align ) &&
					__(
						'Note: We use WP core alignment. Left or Right alignments on desktop won`t support responsive alignment.',
						'vexaltrix'
					)
				}
			/>
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ __( 'Layout', 'vexaltrix' ) }
				data={ {
					value: layout,
					label: 'layout',
				} }
				className="vxt-multi-button-alignment-control"
				options={ [
					{
						value: 'default',
						label: __( 'Normal', 'vexaltrix' ),
					},
					{
						value: 'overlay',
						label: __( 'Overlay', 'vexaltrix' ),
					},
				] }
				showIcons={ false }
			/>

			{ layout === 'overlay' && (
				<>
					<VexaltrixMatrixControl
						label={ __( 'Content Position', 'vexaltrix' ) }
						data={ {
							label: 'overlayContentPosition',
							value: overlayContentPosition,
						} }
						setAttributes={ setAttributes }
					/>
					<ResponsiveBorder
						setAttributes={ setAttributes }
						prefix={ 'overlay' }
						attributes={ attributes }
						deviceType={ deviceType }
					/>
					<Range
						label={ __( 'Border Distance From EDGE', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						value={ overlayPositionFromEdge }
						data={ {
							value: overlayPositionFromEdge,
							label: 'overlayPositionFromEdge',
						} }
						min={ -100 }
						max={ 100 }
						unit={ {
							value: overlayPositionFromEdgeUnit,
							label: 'overlayPositionFromEdgeUnit',
						} }
					/>
				</>
			) }

			{ isSelected && (
				<>
					<ImageSizeControl
						onChange={ ( value ) => setAttributes( value ) }
						data={ {
							sizeSlug: {
								label: 'sizeSlug',
								value: sizeSlug,
							},
							sizeSlugTablet: {
								label: 'sizeSlugTablet',
								value: sizeSlugTablet,
							},
							sizeSlugMobile: {
								label: 'sizeSlugMobile',
								value: sizeSlugMobile,
							},
						} }
						width={ width ? width : naturalWidth }
						widthTablet={ widthTablet }
						widthMobile={ widthMobile }
						height={ height ? height : naturalHeight }
						heightTablet={ heightTablet }
						heightMobile={ heightMobile }
						setAttributes={ setAttributes }
						imageSizeOptions={ imageSizeOptions }
						isResizable={ isResizable }
						imageWidth={ naturalWidth }
						imageHeight={ naturalHeight }
					/>
					<MultiButtonsControl
						setAttributes={ setAttributes }
						label={ __( 'Image Role', 'vexaltrix' ) }
						data={ {
							value: imgRole,
							label: 'imgRole',
						} }
						options={ [
							{
								value: 'img',
								label: __( 'Image', 'vexaltrix' ),
							},
							{
								value: 'presentation',
								label: __( 'Presentation', 'vexaltrix' ),
							},
						] }
					/>
					{ 'presentation' !== imgRole && (
						<>
							<UAGTextControl
								label={ __( 'Alt Text', 'vexaltrix' ) }
								enableDynamicContent={ true }
								dynamicContentType="text"
								value={ alt }
								name="alt"
								setAttributes={ setAttributes }
								data={ {
									value: alt,
									label: 'alt',
								} }
							/>

							<UAGTextControl
								label={ __( 'Title', 'vexaltrix' ) }
								enableDynamicContent={ true }
								dynamicContentType="text"
								value={ title }
								name="title"
								setAttributes={ setAttributes }
								data={ {
									value: title,
									label: 'title',
								} }
							/>
						</>
					) }
				</>
			) }
			<ResponsiveSelectControl
				label={ __( 'Object Fit', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: objectFit,
						label: 'objectFit',
					},
					tablet: {
						value: objectFitTablet,
						label: 'objectFitTablet',
					},
					mobile: {
						value: objectFitMobile,
						label: 'objectFitMobile',
					},
				} }
				options={ objectFitOptions }
				setAttributes={ setAttributes }
			/>
			<UAGSelectControl
				label={ __( 'On Hover Image', 'vexaltrix' ) }
				data={ {
					value: imageHoverEffect,
					label: 'imageHoverEffect',
				} }
				setAttributes={ setAttributes }
				options={ [
					{
						value: 'static',
						label: __( 'Static', 'vexaltrix' ),
					},
					{
						value: 'zoomin',
						label: __( 'Zoom In', 'vexaltrix' ),
					},
					{
						value: 'slide',
						label: __( 'Slide', 'vexaltrix' ),
					},
					{
						value: 'grayscale',
						label: __( 'Gray Scale', 'vexaltrix' ),
					},
					{
						value: 'blur',
						label: __( 'Blur', 'vexaltrix' ),
					},
				] }
			/>

			{ layout !== 'overlay' && (
				<>
					<ToggleControl
						label={ __( 'Enable Caption', 'vexaltrix' ) }
						checked={ enableCaption }
						onChange={ () => {
							setAttributes( { enableCaption: ! enableCaption } );
						} }
					/>
					{ enableCaption && (
						<MultiButtonsControl
							setAttributes={ setAttributes }
							label={ __( 'Alignment', 'vexaltrix' ) }
							data={ {
								value: captionAlign,
								label: 'captionAlign',
							} }
							className="vxt-multi-button-alignment-control"
							options={ [
								{
									value: 'start',
									icon: <Icon icon={ renderSVG( 'fa fa-align-left' ) } />,
									tooltip: __( 'Left', 'vexaltrix' ),
								},
								{
									value: 'center',
									icon: <Icon icon={ renderSVG( 'fa fa-align-center' ) } />,
									tooltip: __( 'Center', 'vexaltrix' ),
								},
								{
									value: 'end',
									icon: <Icon icon={ renderSVG( 'fa fa-align-right' ) } />,
									tooltip: __( 'Right', 'vexaltrix' ),
								},
							] }
							showIcons={ true }
						/>
					) }
				</>
			) }
		</UAGAdvancedPanelBody>
	);

	// shape
	const shapeGeneralPanel = (
		<UAGAdvancedPanelBody title={ __( 'Mask', 'vexaltrix' ) } initialOpen={ false }>
			<UAGSelectControl
				label={ __( 'Mask Shape', 'vexaltrix' ) }
				data={ {
					value: maskShape,
					label: 'maskShape',
				} }
				setAttributes={ setAttributes }
				options={ [
					{
						value: 'none',
						label: __( 'None', 'vexaltrix' ),
					},
					{
						value: 'circle',
						label: __( 'Circle', 'vexaltrix' ),
					},
					{
						value: 'diamond',
						label: __( 'Diamond', 'vexaltrix' ),
					},
					{
						value: 'hexagon',
						label: __( 'Hexagon', 'vexaltrix' ),
					},
					{
						value: 'rounded',
						label: __( 'Rounded', 'vexaltrix' ),
					},
					{
						value: 'blob1',
						label: __( 'Blob 1', 'vexaltrix' ),
					},
					{
						value: 'blob2',
						label: __( 'Blob 2', 'vexaltrix' ),
					},
					{
						value: 'blob3',
						label: __( 'Blob 3', 'vexaltrix' ),
					},
					{
						value: 'blob4',
						label: __( 'Blob 4', 'vexaltrix' ),
					},
					{
						value: 'custom',
						label: __( 'Custom', 'vexaltrix' ),
					},
				] }
			/>
			{ maskShape === 'custom' && (
				<UAGMediaPicker
					onSelectImage={ onSelectCustomMaskShape }
					backgroundImage={ maskCustomShape }
					onRemoveImage={ onRemoveMaskCustomShape }
					label={ __( 'Custom Mask Image', 'vexaltrix' ) }
					slug={ 'custom-mask-image' }
				/>
			) }
			{ maskShape !== 'none' && (
				<>
					<UAGSelectControl
						label={ __( 'Mask Size', 'vexaltrix' ) }
						data={ {
							value: maskSize,
							label: 'maskSize',
						} }
						setAttributes={ setAttributes }
						options={ [
							{
								value: 'auto',
								label: __( 'Auto', 'vexaltrix' ),
							},
							{
								value: 'contain',
								label: __( 'Contain', 'vexaltrix' ),
							},
							{
								value: 'cover',
								label: __( 'Cover', 'vexaltrix' ),
							},
						] }
					/>
					<UAGSelectControl
						label={ __( 'Mask Position', 'vexaltrix' ) }
						data={ {
							value: maskPosition,
							label: 'maskPosition',
						} }
						setAttributes={ setAttributes }
						options={ [
							{
								value: 'center top',
								label: __( 'Center Top', 'vexaltrix' ),
							},
							{
								value: 'center center',
								label: __( 'Center Center', 'vexaltrix' ),
							},
							{
								value: 'center bottom',
								label: __( 'Center Bottom', 'vexaltrix' ),
							},
							{
								value: 'left top',
								label: __( 'Left Top', 'vexaltrix' ),
							},
							{
								value: 'left center',
								label: __( 'Left Center', 'vexaltrix' ),
							},
							{
								value: 'left bottom',
								label: __( 'Left Bottom', 'vexaltrix' ),
							},
							{
								value: 'right top',
								label: __( 'Right Top', 'vexaltrix' ),
							},
							{
								value: 'right center',
								label: __( 'Right Center', 'vexaltrix' ),
							},
							{
								value: 'right bottom',
								label: __( 'Right Bottom', 'vexaltrix' ),
							},
						] }
					/>
					<UAGSelectControl
						label={ __( 'Mask Repeat', 'vexaltrix' ) }
						data={ {
							value: maskRepeat,
							label: 'maskRepeat',
						} }
						setAttributes={ setAttributes }
						options={ [
							{
								value: 'no-repeat',
								label: __( 'No Repeat', 'vexaltrix' ),
							},
							{
								value: 'repeat',
								label: __( 'Repeat', 'vexaltrix' ),
							},
							{
								value: 'repeat-x',
								label: __( 'Repeat-X', 'vexaltrix' ),
							},
							{
								value: 'repeat-y',
								label: __( 'Repeat-Y', 'vexaltrix' ),
							},
						] }
					/>
				</>
			) }
		</UAGAdvancedPanelBody>
	);

	// Separator settings.
	const seperatorGeneralPanel = (
		<UAGAdvancedPanelBody title={ __( 'Separator', 'vexaltrix' ) } initialOpen={ false }>
			{ seperatorStyle !== 'none' && (
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Show On', 'vexaltrix' ) }
					data={ {
						value: seperatorShowOn,
						label: 'seperatorShowOn',
					} }
					className="vxt-multi-button-alignment-control"
					options={ [
						{
							value: 'always',
							label: __( 'Always', 'vexaltrix' ),
						},
						{
							value: 'hover',
							label: __( 'Hover', 'vexaltrix' ),
						},
					] }
					showIcons={ false }
				/>
			) }
			<UAGSelectControl
				label={ __( 'Style', 'vexaltrix' ) }
				data={ {
					value: seperatorStyle,
					label: 'seperatorStyle',
				} }
				setAttributes={ setAttributes }
				options={ [
					{
						value: 'none',
						label: __( 'None', 'vexaltrix' ),
					},
					{
						value: 'solid',
						label: __( 'Solid', 'vexaltrix' ),
					},
					{
						value: 'double',
						label: __( 'Double', 'vexaltrix' ),
					},
					{
						value: 'dashed',
						label: __( 'Dashed', 'vexaltrix' ),
					},
					{
						value: 'dotted',
						label: __( 'Dotted', 'vexaltrix' ),
					},
				] }
			/>
			{ 'none' !== seperatorStyle && (
				<UAGSelectControl
					label={ __( 'Position', 'vexaltrix' ) }
					data={ {
						value: seperatorPosition,
						label: 'seperatorPosition',
					} }
					setAttributes={ setAttributes }
					options={ [
						{
							value: 'before_title',
							label: __( 'Before Title', 'vexaltrix' ),
						},
						{
							value: 'after_title',
							label: __( 'After Title', 'vexaltrix' ),
						},
						{
							value: 'after_sub_title',
							label: __( 'After Sub Title', 'vexaltrix' ),
						},
					] }
				/>
			) }
		</UAGAdvancedPanelBody>
	);

	const headingGeneralPanel = (
		<UAGAdvancedPanelBody title={ __( 'Heading', 'vexaltrix' ) } initialOpen={ false }>
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ __( 'Show On', 'vexaltrix' ) }
				data={ {
					value: headingShowOn,
					label: 'headingShowOn',
				} }
				className="vxt-multi-button-alignment-control"
				options={ [
					{
						value: 'always',
						label: __( 'Always', 'vexaltrix' ),
					},
					{
						value: 'hover',
						label: __( 'Hover', 'vexaltrix' ),
					},
				] }
				showIcons={ false }
			/>
		</UAGAdvancedPanelBody>
	);

	const descriptionGeneralPanel = (
		<UAGAdvancedPanelBody title={ __( 'Description', 'vexaltrix' ) } initialOpen={ false }>
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ __( 'Show On', 'vexaltrix' ) }
				data={ {
					value: captionShowOn,
					label: 'captionShowOn',
				} }
				className="vxt-multi-button-alignment-control"
				options={ [
					{
						value: 'always',
						label: __( 'Always', 'vexaltrix' ),
					},
					{
						value: 'hover',
						label: __( 'Hover', 'vexaltrix' ),
					},
				] }
				showIcons={ false }
			/>
		</UAGAdvancedPanelBody>
	);

	const headingStylePanel = (
		<UAGAdvancedPanelBody title={ __( 'Heading', 'vexaltrix' ) } initialOpen={ false }>
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ __( 'Heading Tag', 'vexaltrix' ) }
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

			<TypographyControl
				label={ __( 'Typography', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				loadGoogleFonts={ {
					value: headingLoadGoogleFonts,
					label: 'headingLoadGoogleFonts',
				} }
				fontFamily={ {
					value: headingFontFamily,
					label: 'headingFontFamily',
				} }
				fontWeight={ {
					value: headingFontWeight,
					label: 'headingFontWeight',
				} }
				fontStyle={ {
					value: headingFontStyle,
					label: 'headingFontStyle',
				} }
				transform={ {
					value: headingTransform,
					label: 'headingTransform',
				} }
				decoration={ {
					value: headingDecoration,
					label: 'headingDecoration',
				} }
				fontSizeType={ {
					value: headingFontSizeType,
					label: 'headingFontSizeType',
				} }
				fontSizeTypeTablet={ {
					value: headingFontSizeTypeTablet,
					label: 'headingFontSizeTypeTablet',
				} }
				fontSizeTypeMobile={ {
					value: headingFontSizeTypeMobile,
					label: 'headingFontSizeTypeMobile',
				} }
				fontSize={ {
					value: headingFontSize,
					label: 'headingFontSize',
				} }
				fontSizeMobile={ {
					value: headingFontSizeMobile,
					label: 'headingFontSizeMobile',
				} }
				fontSizeTablet={ {
					value: headingFontSizeTablet,
					label: 'headingFontSizeTablet',
				} }
				lineHeightType={ {
					value: headingLineHeightType,
					label: 'headingLineHeightType',
				} }
				lineHeight={ {
					value: headingLineHeight,
					label: 'headingLineHeight',
				} }
				lineHeightMobile={ {
					value: headingLineHeightMobile,
					label: 'headingLineHeightMobile',
				} }
				lineHeightTablet={ {
					value: headingLineHeightTablet,
					label: 'headingLineHeightTablet',
				} }
				letterSpacing={ {
					value: headingLetterSpacing,
					label: 'headingLetterSpacing',
				} }
				letterSpacingTablet={ {
					value: headingLetterSpacingTablet,
					label: 'headingLetterSpacingTablet',
				} }
				letterSpacingMobile={ {
					value: headingLetterSpacingMobile,
					label: 'headingLetterSpacingMobile',
				} }
				letterSpacingType={ {
					value: headingLetterSpacingType,
					label: 'headingLetterSpacingType',
				} }
			/>

			<AdvancedPopColorControl
				label={ __( 'Color', 'vexaltrix' ) }
				colorValue={ headingColor ? headingColor : '' }
				data={ {
					value: headingColor,
					label: 'headingColor',
				} }
				setAttributes={ setAttributes }
			/>
			<SpacingControl
				label={ __( 'Margin', 'vexaltrix' ) }
				valueTop={ {
					value: headingTopMargin,
					label: 'headingTopMargin',
				} }
				valueRight={ {
					value: headingRightMargin,
					label: 'headingRightMargin',
				} }
				valueBottom={ {
					value: headingBottomMargin,
					label: 'headingBottomMargin',
				} }
				valueLeft={ {
					value: headingLeftMargin,
					label: 'headingLeftMargin',
				} }
				valueTopTablet={ {
					value: headingTopMarginTablet,
					label: 'headingTopMarginTablet',
				} }
				valueRightTablet={ {
					value: headingRightMarginTablet,
					label: 'headingRightMarginTablet',
				} }
				valueBottomTablet={ {
					value: headingBottomMarginTablet,
					label: 'headingBottomMarginTablet',
				} }
				valueLeftTablet={ {
					value: headingLeftMarginTablet,
					label: 'headingLeftMarginTablet',
				} }
				valueTopMobile={ {
					value: headingTopMarginMobile,
					label: 'headingTopMarginMobile',
				} }
				valueRightMobile={ {
					value: headingRightMarginMobile,
					label: 'headingRightMarginMobile',
				} }
				valueBottomMobile={ {
					value: headingBottomMarginMobile,
					label: 'headingBottomMarginMobile',
				} }
				valueLeftMobile={ {
					value: headingLeftMarginMobile,
					label: 'headingLeftMarginMobile',
				} }
				unit={ {
					value: headingMarginUnit,
					label: 'headingMarginUnit',
				} }
				mUnit={ {
					value: headingMarginUnitMobile,
					label: 'headingMarginUnitMobile',
				} }
				tUnit={ {
					value: headingMarginUnitTablet,
					label: 'headingMarginUnitTablet',
				} }
				deviceType={ deviceType }
				attributes={ attributes }
				setAttributes={ setAttributes }
				link={ {
					value: headingMarginLink,
					label: 'headingMarginLink',
				} }
			/>
		</UAGAdvancedPanelBody>
	);

	const captionStylePanel = (
		<UAGAdvancedPanelBody
			title={ layout === 'overlay' ? __( 'Description', 'vexaltrix' ) : __( 'Caption', 'vexaltrix' ) }
			initialOpen={ false }
		>
			<TypographyControl
				label={ __( 'Typography', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				loadGoogleFonts={ {
					value: captionLoadGoogleFonts,
					label: 'captionLoadGoogleFonts',
				} }
				fontFamily={ {
					value: captionFontFamily,
					label: 'captionFontFamily',
				} }
				fontWeight={ {
					value: captionFontWeight,
					label: 'captionFontWeight',
				} }
				fontStyle={ {
					value: captionFontStyle,
					label: 'captionFontStyle',
				} }
				transform={ {
					value: captionTransform,
					label: 'captionTransform',
				} }
				decoration={ {
					value: captionDecoration,
					label: 'captionDecoration',
				} }
				fontSizeType={ {
					value: captionFontSizeType,
					label: 'captionFontSizeType',
				} }
				fontSizeTypeTablet={ {
					value: captionFontSizeTypeTablet,
					label: 'captionFontSizeTypeTablet',
				} }
				fontSizeTypeMobile={ {
					value: captionFontSizeTypeMobile,
					label: 'captionFontSizeTypeMobile',
				} }
				fontSize={ {
					value: captionFontSize,
					label: 'captionFontSize',
				} }
				fontSizeMobile={ {
					value: captionFontSizeMobile,
					label: 'captionFontSizeMobile',
				} }
				fontSizeTablet={ {
					value: captionFontSizeTablet,
					label: 'captionFontSizeTablet',
				} }
				lineHeightType={ {
					value: captionLineHeightType,
					label: 'captionLineHeightType',
				} }
				lineHeight={ {
					value: captionLineHeight,
					label: 'captionLineHeight',
				} }
				lineHeightMobile={ {
					value: captionLineHeightMobile,
					label: 'captionLineHeightMobile',
				} }
				lineHeightTablet={ {
					value: captionLineHeightTablet,
					label: 'captionLineHeightTablet',
				} }
				letterSpacing={ {
					value: captionLetterSpacing,
					label: 'captionLetterSpacing',
				} }
				letterSpacingTablet={ {
					value: captionLetterSpacingTablet,
					label: 'captionLetterSpacingTablet',
				} }
				letterSpacingMobile={ {
					value: captionLetterSpacingMobile,
					label: 'captionLetterSpacingMobile',
				} }
				letterSpacingType={ {
					value: captionLetterSpacingType,
					label: 'captionLetterSpacingType',
				} }
			/>

			<AdvancedPopColorControl
				label={ __( 'Color', 'vexaltrix' ) }
				colorValue={ captionColor ? captionColor : '' }
				data={ {
					value: captionColor,
					label: 'captionColor',
				} }
				setAttributes={ setAttributes }
			/>
			<SpacingControl
				label={ __( 'Margin', 'vexaltrix' ) }
				valueTop={ {
					value: captionTopMargin,
					label: 'captionTopMargin',
				} }
				valueRight={ {
					value: captionRightMargin,
					label: 'captionRightMargin',
				} }
				valueBottom={ {
					value: captionBottomMargin,
					label: 'captionBottomMargin',
				} }
				valueLeft={ {
					value: captionLeftMargin,
					label: 'captionLeftMargin',
				} }
				valueTopTablet={ {
					value: captionTopMarginTablet,
					label: 'captionTopMarginTablet',
				} }
				valueRightTablet={ {
					value: captionRightMarginTablet,
					label: 'captionRightMarginTablet',
				} }
				valueBottomTablet={ {
					value: captionBottomMarginTablet,
					label: 'captionBottomMarginTablet',
				} }
				valueLeftTablet={ {
					value: captionLeftMarginTablet,
					label: 'captionLeftMarginTablet',
				} }
				valueTopMobile={ {
					value: captionTopMarginMobile,
					label: 'captionTopMarginMobile',
				} }
				valueRightMobile={ {
					value: captionRightMarginMobile,
					label: 'captionRightMarginMobile',
				} }
				valueBottomMobile={ {
					value: captionBottomMarginMobile,
					label: 'captionBottomMarginMobile',
				} }
				valueLeftMobile={ {
					value: captionLeftMarginMobile,
					label: 'captionLeftMarginMobile',
				} }
				unit={ {
					value: captionMarginUnit,
					label: 'captionMarginUnit',
				} }
				mUnit={ {
					value: captionMarginUnitMobile,
					label: 'captionMarginUnitMobile',
				} }
				tUnit={ {
					value: captionMarginUnitTablet,
					label: 'captionMarginUnitTablet',
				} }
				deviceType={ deviceType }
				attributes={ attributes }
				setAttributes={ setAttributes }
				link={ {
					value: captionMarginLink,
					label: 'captionMarginLink',
				} }
			/>
		</UAGAdvancedPanelBody>
	);

	const ImageStylePanel = (
		<UAGAdvancedPanelBody title={ __( 'Image', 'vexaltrix' ) } initialOpen={ true }>
			<ResponsiveBorder
				setAttributes={ setAttributes }
				prefix={ 'image' }
				attributes={ attributes }
				deviceType={ deviceType }
			/>

			<SpacingControl
				label={ __( 'Margin', 'vexaltrix' ) }
				valueTop={ {
					value: imageTopMargin,
					label: 'imageTopMargin',
				} }
				valueRight={ {
					value: imageRightMargin,
					label: 'imageRightMargin',
				} }
				valueBottom={ {
					value: imageBottomMargin,
					label: 'imageBottomMargin',
				} }
				valueLeft={ {
					value: imageLeftMargin,
					label: 'imageLeftMargin',
				} }
				valueTopTablet={ {
					value: imageTopMarginTablet,
					label: 'imageTopMarginTablet',
				} }
				valueRightTablet={ {
					value: imageRightMarginTablet,
					label: 'imageRightMarginTablet',
				} }
				valueBottomTablet={ {
					value: imageBottomMarginTablet,
					label: 'imageBottomMarginTablet',
				} }
				valueLeftTablet={ {
					value: imageLeftMarginTablet,
					label: 'imageLeftMarginTablet',
				} }
				valueTopMobile={ {
					value: imageTopMarginMobile,
					label: 'imageTopMarginMobile',
				} }
				valueRightMobile={ {
					value: imageRightMarginMobile,
					label: 'imageRightMarginMobile',
				} }
				valueBottomMobile={ {
					value: imageBottomMarginMobile,
					label: 'imageBottomMarginMobile',
				} }
				valueLeftMobile={ {
					value: imageLeftMarginMobile,
					label: 'imageLeftMarginMobile',
				} }
				unit={ {
					value: imageMarginUnit,
					label: 'imageMarginUnit',
				} }
				mUnit={ {
					value: imageMarginUnitMobile,
					label: 'imageMarginUnitMobile',
				} }
				tUnit={ {
					value: imageMarginUnitTablet,
					label: 'imageMarginUnitTablet',
				} }
				deviceType={ deviceType }
				attributes={ attributes }
				setAttributes={ setAttributes }
				link={ {
					value: imageMarginLink,
					label: 'imageMarginLink',
				} }
			/>
		</UAGAdvancedPanelBody>
	);

	const imageBoxShadowStylePanel = (
		<UAGAdvancedPanelBody title={ __( 'Box Shadow', 'vexaltrix' ) } initialOpen={ false }>
			<ToggleControl
				label={ __( 'Separate Hover Shadow', 'vexaltrix' ) }
				checked={ useSeparateBoxShadows }
				onChange={ () => setAttributes( { useSeparateBoxShadows: ! useSeparateBoxShadows } ) }
			/>
			{ useSeparateBoxShadows ? (
				<UAGTabsControl
					tabs={ [
						{
							name: 'normal',
							title: __( 'Normal', 'vexaltrix' ),
						},
						{
							name: 'hover',
							title: __( 'Hover', 'vexaltrix' ),
						},
					] }
					normal={
						<>
							<UAGPresets
								setAttributes={ setAttributes }
								presets={ boxShadowPresets }
								presetInputType="radioImage"
							/>
							<BoxShadowControl
								blockId={ block_id }
								setAttributes={ setAttributes }
								label={ __( 'Box Shadow', 'vexaltrix' ) }
								boxShadowColor={ {
									value: imageBoxShadowColor,
									label: 'imageBoxShadowColor',
									title: __( 'Color', 'vexaltrix' ),
								} }
								boxShadowHOffset={ {
									value: imageBoxShadowHOffset,
									label: 'imageBoxShadowHOffset',
									title: __( 'Horizontal', 'vexaltrix' ),
								} }
								boxShadowVOffset={ {
									value: imageBoxShadowVOffset,
									label: 'imageBoxShadowVOffset',
									title: __( 'Vertical', 'vexaltrix' ),
								} }
								boxShadowBlur={ {
									value: imageBoxShadowBlur,
									label: 'imageBoxShadowBlur',
									title: __( 'Blur', 'vexaltrix' ),
								} }
								boxShadowSpread={ {
									value: imageBoxShadowSpread,
									label: 'imageBoxShadowSpread',
									title: __( 'Spread', 'vexaltrix' ),
								} }
								boxShadowPosition={ {
									value: imageBoxShadowPosition,
									label: 'imageBoxShadowPosition',
									title: __( 'Position', 'vexaltrix' ),
								} }
								popup={ false }
							/>
						</>
					}
					hover={
						<>
							<UAGPresets
								setAttributes={ setAttributes }
								presets={ boxShadowHoverPresets }
								presetInputType="radioImage"
							/>
							<BoxShadowControl
								blockId={ block_id }
								setAttributes={ setAttributes }
								label={ __( 'Box Shadow', 'vexaltrix' ) }
								boxShadowColor={ {
									value: imageBoxShadowColorHover,
									label: 'imageBoxShadowColorHover',
									title: __( 'Color', 'vexaltrix' ),
								} }
								boxShadowHOffset={ {
									value: imageBoxShadowHOffsetHover,
									label: 'imageBoxShadowHOffsetHover',
									title: __( 'Horizontal', 'vexaltrix' ),
								} }
								boxShadowVOffset={ {
									value: imageBoxShadowVOffsetHover,
									label: 'imageBoxShadowVOffsetHover',
									title: __( 'Vertical', 'vexaltrix' ),
								} }
								boxShadowBlur={ {
									value: imageBoxShadowBlurHover,
									label: 'imageBoxShadowBlurHover',
									title: __( 'Blur', 'vexaltrix' ),
								} }
								boxShadowSpread={ {
									value: imageBoxShadowSpreadHover,
									label: 'imageBoxShadowSpreadHover',
									title: __( 'Spread', 'vexaltrix' ),
								} }
								boxShadowPosition={ {
									value: imageBoxShadowPositionHover,
									label: 'imageBoxShadowPositionHover',
									title: __( 'Position', 'vexaltrix' ),
								} }
								popup={ false }
							/>
						</>
					}
					disableBottomSeparator={ true }
				/>
			) : (
				<>
					<UAGPresets
						setAttributes={ setAttributes }
						presets={ boxShadowPresets }
						presetInputType="radioImage"
					/>
					<BoxShadowControl
						blockId={ block_id }
						setAttributes={ setAttributes }
						label={ __( 'Box Shadow', 'vexaltrix' ) }
						boxShadowColor={ {
							value: imageBoxShadowColor,
							label: 'imageBoxShadowColor',
							title: __( 'Color', 'vexaltrix' ),
						} }
						boxShadowHOffset={ {
							value: imageBoxShadowHOffset,
							label: 'imageBoxShadowHOffset',
							title: __( 'Horizontal', 'vexaltrix' ),
						} }
						boxShadowVOffset={ {
							value: imageBoxShadowVOffset,
							label: 'imageBoxShadowVOffset',
							title: __( 'Vertical', 'vexaltrix' ),
						} }
						boxShadowBlur={ {
							value: imageBoxShadowBlur,
							label: 'imageBoxShadowBlur',
							title: __( 'Blur', 'vexaltrix' ),
						} }
						boxShadowSpread={ {
							value: imageBoxShadowSpread,
							label: 'imageBoxShadowSpread',
							title: __( 'Spread', 'vexaltrix' ),
						} }
						boxShadowPosition={ {
							value: imageBoxShadowPosition,
							label: 'imageBoxShadowPosition',
							title: __( 'Position', 'vexaltrix' ),
						} }
						popup={ false }
					/>
				</>
			) }
		</UAGAdvancedPanelBody>
	);

	const overlayStylePanel = (
		<UAGAdvancedPanelBody title={ __( 'Overlay', 'vexaltrix' ) } initialOpen={ false }>
			<AdvancedPopColorControl
				label={ __( 'Background', 'vexaltrix' ) }
				colorValue={ overlayBackground ? overlayBackground : '' }
				data={ {
					value: overlayBackground,
					label: 'overlayBackground',
				} }
				setAttributes={ setAttributes }
			/>
			<Range
				label={ __( 'Overlay Opacity', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				value={ overlayOpacity }
				data={ {
					value: overlayOpacity,
					label: 'overlayOpacity',
				} }
				min={ 0 }
				max={ 1 }
				step={ 0.1 }
				displayUnit={ false }
			/>
			<Range
				label={ __( 'Overlay Hover Opacity', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				value={ overlayHoverOpacity }
				data={ {
					value: overlayHoverOpacity,
					label: 'overlayHoverOpacity',
				} }
				min={ 0 }
				max={ 1 }
				step={ 0.1 }
				displayUnit={ false }
			/>
		</UAGAdvancedPanelBody>
	);

	const seperatorStylePanel = (
		<UAGAdvancedPanelBody title="Separator" initialOpen={ false }>
			<Range
				label={ __( 'Width', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				value={ seperatorWidth }
				data={ {
					value: seperatorWidth,
					label: 'seperatorWidth',
				} }
				min={ 0 }
				max={ '%' === separatorWidthType ? 100 : 500 }
				unit={ {
					value: separatorWidthType,
					label: 'separatorWidthType',
				} }
				units={ [
					{
						name: __( 'Pixel', 'vexaltrix' ),
						unitValue: 'px',
					},
					{
						name: __( 'Em', 'vexaltrix' ),
						unitValue: 'em',
					},
					{
						name: __( '%', 'vexaltrix' ),
						unitValue: '%',
					},
				] }
			/>
			<Range
				label={ __( 'Thickness', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				value={ seperatorThickness }
				data={ {
					value: seperatorThickness,
					label: 'seperatorThickness',
				} }
				min={ 0 }
				max={ 10 }
				unit={ {
					value: seperatorThicknessUnit,
					label: 'seperatorThicknessUnit',
				} }
			/>
			<AdvancedPopColorControl
				label={ __( 'Color', 'vexaltrix' ) }
				colorValue={ seperatorColor ? seperatorColor : '' }
				data={ {
					value: seperatorColor,
					label: 'seperatorColor',
				} }
				setAttributes={ setAttributes }
			/>
			<SpacingControl
				{ ...props }
				label={ __( 'Margin', 'vexaltrix' ) }
				valueTop={ {
					value: seperatorTopMargin,
					label: 'seperatorTopMargin',
				} }
				valueRight={ {
					value: seperatorRightMargin,
					label: 'seperatorRightMargin',
				} }
				valueBottom={ {
					value: seperatorBottomMargin,
					label: 'seperatorBottomMargin',
				} }
				valueLeft={ {
					value: seperatorLeftMargin,
					label: 'seperatorLeftMargin',
				} }
				valueTopTablet={ {
					value: seperatorTopMarginTablet,
					label: 'seperatorTopMarginTablet',
				} }
				valueRightTablet={ {
					value: seperatorRightMarginTablet,
					label: 'seperatorRightMarginTablet',
				} }
				valueBottomTablet={ {
					value: seperatorBottomMarginTablet,
					label: 'seperatorBottomMarginTablet',
				} }
				valueLeftTablet={ {
					value: seperatorLeftMarginTablet,
					label: 'seperatorLeftMarginTablet',
				} }
				valueTopMobile={ {
					value: seperatorTopMarginMobile,
					label: 'seperatorTopMarginMobile',
				} }
				valueRightMobile={ {
					value: seperatorRightMarginMobile,
					label: 'seperatorRightMarginMobile',
				} }
				valueBottomMobile={ {
					value: seperatorBottomMarginMobile,
					label: 'seperatorBottomMarginMobile',
				} }
				valueLeftMobile={ {
					value: seperatorLeftMarginMobile,
					label: 'seperatorLeftMarginMobile',
				} }
				unit={ {
					value: seperatorMarginUnit,
					label: 'seperatorMarginUnit',
				} }
				mUnit={ {
					value: seperatorMarginUnitMobile,
					label: 'seperatorMarginUnitMobile',
				} }
				tUnit={ {
					value: seperatorMarginUnitTablet,
					label: 'seperatorMarginUnitTablet',
				} }
				deviceType={ deviceType }
				attributes={ attributes }
				setAttributes={ setAttributes }
				link={ {
					value: seperatorMarginLink,
					label: 'seperatorMarginLink',
				} }
			/>
		</UAGAdvancedPanelBody>
	);

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

	return (
		<>
			<InspectorControls>
				<InspectorTabs>
					<InspectorTab { ...UAGTabs.general } parentProps={ props }>
						{ generalPanel }
						{ shapeGeneralPanel }
						{ layout === 'overlay' && (
							<>
								{ headingGeneralPanel }
								{ descriptionGeneralPanel }
								{ seperatorGeneralPanel }
							</>
						) }
						{ 'not-installed' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status &&
							proUpgradePanel() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.style } parentProps={ props }>
						{ ImageStylePanel }
						{ 'static' === imageHoverEffect && imageBoxShadowStylePanel }
						{ layout === 'overlay' && (
							<>
								{ overlayStylePanel }
								{ headingStylePanel }
								{ captionStylePanel }
							</>
						) }
						{ enableCaption && layout !== 'overlay' && captionStylePanel }
						{ 'none' !== seperatorStyle && layout === 'overlay' && seperatorStylePanel }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.advance } parentProps={ props }>
						{ renderGBSSettings( styling, setAttributes, attributes ) }
					</InspectorTab>
				</InspectorTabs>
			</InspectorControls>
		</>
	);
}
