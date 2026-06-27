/* eslint-disable no-nested-ternary */
import { __ } from '@wordpress/i18n';
import renderSVG from '@Controls/renderIcon';
import { useEffect, memo } from '@wordpress/element';
import { doAction } from '@wordpress/hooks';
import getMatrixAlignment from '@Controls/getMatrixAlignment';
import TypographyControl from '@Components/typography';
import AdvancedPopColorControl from '@Components/color-control/advanced-pop-color-control.js';
import ImageSizeControl from '@Components/image-size-control';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import SpacingControl from '@Components/spacing-control';
import Range from '@Components/range/Range.js';
import ResponsiveSlider from '@Components/responsive-slider';
import ResponsiveBorder from '@Components/responsive-border';
import MultiMediaSelector from '@Components/multimedia-select';
import MultiButtonsControl from '@Components/multi-buttons-control';
import VexaltrixMatrixControl from '@Components/matrix-alignment-control';
import UAGIconPicker from '@Components/icon-picker';
import UAGTabsControl from '@Components/tabs';
import UAGTextControl from '@Components/text-control';
import UAGSelectControl from '@Components/select-control';
import BoxShadowControl from '@Components/box-shadow';
import UAGPresets from '@Components/presets';
import { useSelect } from '@wordpress/data';
import { store as blockEditorStore, InspectorControls } from '@wordpress/block-editor';
import { ToggleControl, Icon } from '@wordpress/components';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import { boxShadowPresets, boxShadowHoverPresets } from './presets';
import UpgradeComponent from '@Components/upgrade-to-pro-cta';

const MAX_IMAGE_COLUMNS = 8;

const Settings = ( props ) => {
	const { lightboxPreview, setLightboxPreview, attributes, setAttributes, clientId, deviceType } = props;

	const {
		block_id,
		readyToRender,

		mediaGallery,
		mediaIDs,
		feedLayout,
		imageDisplayCaption,
		galleryImageSize,
		galleryImageSizeTablet,
		galleryImageSizeMobile,
		imageClickEvent,

		lightboxDisplayCaptions,
		lightboxThumbnails,
		lightboxDisplayCount,
		lightboxCloseIcon,
		lightboxCaptionHeight,
		lightboxCaptionHeightTablet,
		lightboxCaptionHeightMobile,
		lightboxIconSize,
		lightboxIconSizeTablet,
		lightboxIconSizeMobile,

		columnsDesk,
		columnsTab,
		columnsMob,
		gridImageGap,
		gridImageGapTab,
		gridImageGapMob,
		gridImageGapUnit,
		gridImageGapUnitTab,
		gridImageGapUnitMob,

		captionVisibility,
		captionDisplayType,
		imageCaptionAlignment,
		imageCaptionAlignment01,
		imageCaptionAlignment02,
		imageDefaultCaption,
		captionPaddingTop,
		captionPaddingRight,
		captionPaddingBottom,
		captionPaddingLeft,
		captionPaddingTopTab,
		captionPaddingRightTab,
		captionPaddingBottomTab,
		captionPaddingLeftTab,
		captionPaddingTopMob,
		captionPaddingRightMob,
		captionPaddingBottomMob,
		captionPaddingLeftMob,
		captionPaddingUnit,
		captionPaddingUnitTab,
		captionPaddingUnitMob,
		captionPaddingUnitLink,
		captionGap,
		captionGapUnit,

		feedMarginTop,
		feedMarginRight,
		feedMarginBottom,
		feedMarginLeft,
		feedMarginTopTab,
		feedMarginRightTab,
		feedMarginBottomTab,
		feedMarginLeftTab,
		feedMarginTopMob,
		feedMarginRightMob,
		feedMarginBottomMob,
		feedMarginLeftMob,
		feedMarginUnit,
		feedMarginUnitTab,
		feedMarginUnitMob,
		feedMarginUnitLink,

		carouselStartAt,
		carouselSquares,
		carouselLoop,
		carouselAutoplay,
		carouselAutoplaySpeed,
		carouselPauseOnHover,
		carouselTransitionSpeed,

		feedPagination,
		paginateUseArrows,
		paginateUseDots,
		paginateUseLoader,
		paginateLimit,
		paginateButtonAlign,
		paginateButtonPaddingTop,
		paginateButtonPaddingRight,
		paginateButtonPaddingBottom,
		paginateButtonPaddingLeft,
		paginateButtonPaddingTopTab,
		paginateButtonPaddingRightTab,
		paginateButtonPaddingBottomTab,
		paginateButtonPaddingLeftTab,
		paginateButtonPaddingTopMob,
		paginateButtonPaddingRightMob,
		paginateButtonPaddingBottomMob,
		paginateButtonPaddingLeftMob,
		paginateButtonPaddingUnit,
		paginateButtonPaddingUnitTab,
		paginateButtonPaddingUnitMob,
		paginateButtonPaddingUnitLink,

		imageEnableZoom,
		imageZoomType,
		captionBackgroundEnableBlur,
		captionBackgroundBlurAmount,
		captionBackgroundBlurAmountHover,

		lightboxEdgeDistance,
		lightboxEdgeDistanceTablet,
		lightboxEdgeDistanceMobile,
		lightboxBackgroundEnableBlur,
		lightboxBackgroundBlurAmount,
		lightboxBackgroundColor,
		lightboxCaptionColor,
		lightboxCaptionBackgroundColor,
		lightboxIconColor,

		captionLoadGoogleFonts,
		captionFontFamily,
		captionFontWeight,
		captionFontStyle,
		captionTransform,
		captionDecoration,
		captionFontSizeType,
		captionFontSize,
		captionFontSizeMob,
		captionFontSizeTab,
		captionLineHeightType,
		captionLineHeight,
		captionLineHeightMob,
		captionLineHeightTab,

		loadMoreLoadGoogleFonts,
		loadMoreFontFamily,
		loadMoreFontWeight,
		loadMoreFontStyle,
		loadMoreTransform,
		loadMoreDecoration,
		loadMoreFontSizeType,
		loadMoreFontSize,
		loadMoreFontSizeMob,
		loadMoreFontSizeTab,
		loadMoreLineHeightType,
		loadMoreLineHeight,
		loadMoreLineHeightMob,
		loadMoreLineHeightTab,

		lightboxLoadGoogleFonts,
		lightboxFontFamily,
		lightboxFontWeight,
		lightboxFontStyle,
		lightboxTransform,
		lightboxDecoration,
		lightboxFontSizeType,
		lightboxFontSize,
		lightboxFontSizeMob,
		lightboxFontSizeTab,
		lightboxLineHeightType,
		lightboxLineHeight,
		lightboxLineHeightMob,
		lightboxLineHeightTab,

		captionBackgroundEffect,
		captionBackgroundEffectHover,
		captionBackgroundEffectAmount,
		captionBackgroundEffectAmountHover,
		captionColor,
		captionColorHover,
		captionBackgroundColor,
		captionBackgroundColorHover,
		overlayColor,
		overlayColorHover,
		captionSeparateColors,

		paginateArrowDistance,
		paginateArrowDistanceUnit,
		paginateArrowSize,
		paginateDotDistance,
		paginateDotDistanceUnit,
		paginateLoaderSize,
		paginateButtonTextColor,
		paginateButtonTextColorHover,
		paginateColor,
		paginateColorHover,

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
		disableLazyLoad,
	} = attributes;

	// Get the Image Sizes Available.
	const { imageSizes } = useSelect(
		( select ) => {
			const { getSettings } = select( blockEditorStore );

			const { imageSizes } = getSettings();
			return { imageSizes };
		},
		[ clientId ]
	);

	// Set the Image Size Options.
	const imageSizeOptions = imageSizes.reduce( ( acc, item ) => {
		acc.push( { label: item.name, value: item.slug } );
		return acc;
	}, [] );

	// Internationilized Dynamic Labels.
	let labelForCaptionBgColor;
	let labelForBgEffectAmount;
	let labelForHoverBgEffectAmount;
	let labelForLayoutPanel;
	const labelForPaginationColor =
		'masonry' === feedLayout && ! paginateUseLoader
			? __( 'Background Color', 'vexaltrix' )
			: __( 'Color', 'vexaltrix' );

	// Assigning Internationilized Dynamic Label.
	switch ( captionDisplayType ) {
		case 'overlay':
			labelForCaptionBgColor = __( 'Overlay Color', 'vexaltrix' );
			break;
		case 'bar-inside':
		case 'bar-outside':
			labelForCaptionBgColor = __( 'Bar Color', 'vexaltrix' );
			break;
		default:
			labelForCaptionBgColor = __( 'Background Color', 'vexaltrix' );
	}
	switch ( captionBackgroundEffect ) {
		case 'grayscale':
			labelForBgEffectAmount = __( 'Grayscale Amount', 'vexaltrix' );
			break;
		case 'sepia':
			labelForBgEffectAmount = __( 'Sepia Amount', 'vexaltrix' );
			break;
		default:
			labelForBgEffectAmount = __( 'Effect Amount', 'vexaltrix' );
	}
	switch ( captionBackgroundEffectHover ) {
		case 'grayscale':
			labelForHoverBgEffectAmount = __( 'Grayscale Amount', 'vexaltrix' );
			break;
		case 'sepia':
			labelForHoverBgEffectAmount = __( 'Sepia Amount', 'vexaltrix' );
			break;
		default:
			labelForHoverBgEffectAmount = __( 'Effect Amount', 'vexaltrix' );
	}
	switch ( feedLayout ) {
		case 'carousel':
			labelForLayoutPanel = __( 'Carousel', 'vexaltrix' );
			break;
		case 'tiled':
			labelForLayoutPanel = __( 'Tiled', 'vexaltrix' );
			break;
		default:
			labelForLayoutPanel = __( 'Pagination', 'vexaltrix' );
	}

	// Combine Alignment to Matrix.
	useEffect( () => {
		setAttributes( { imageCaptionAlignment: `${ imageCaptionAlignment01 } ${ imageCaptionAlignment02 }` } );
	}, [ imageCaptionAlignment01, imageCaptionAlignment02 ] );

	// Update the Media Gallery.
	const updateMediaGallery = ( media ) => {
		let goodToGo = true;
		const updatedIDs = [];
		media.forEach( ( image ) => {
			if ( ! image || ! image.url || ! image.type || 'image' !== image.type ) {
				goodToGo = false;
			} else {
				updatedIDs.push( image.id );
			}
		} );
		if ( goodToGo ) {
			setAttributes( {
				mediaGallery: media,
				mediaIDs: updatedIDs,
				readyToRender: true,
			} );
		} else {
			setAttributes( {
				mediaGallery,
				mediaIDs,
				readyToRender: mediaIDs ? true : false,
			} );
		}
	};

	// Split Up Alignment Matrix.
	const updateSplitAlignments = ( matrixValue ) => {
		setAttributes( {
			// imageCaptionAlignment: matrixValue,
			imageCaptionAlignment01: getMatrixAlignment( matrixValue, 1 ),
			imageCaptionAlignment02: getMatrixAlignment( matrixValue, 2 ),
		} );
	};

	// Switch from Bar Outside to Bar Inside for Unsupported Layouts.
	// Update the Min Column Values for Tiled Layout.
	useEffect( () => {
		if ( 'bar-outside' === captionDisplayType && ( 'tiled' === feedLayout || 'grid' === feedLayout ) ) {
			setAttributes( { captionDisplayType: 'bar-inside' } );
		}
	}, [ feedLayout ] );

	// Update Caption Visibility and Position when Bar is Outside.
	useEffect( () => {
		if ( 'bar-outside' === captionDisplayType ) {
			setAttributes( { captionVisibility: 'always' } );
			if ( 'center' === imageCaptionAlignment01 ) {
				setAttributes( { imageCaptionAlignment01: 'bottom' } );
			}
		}
	}, [ captionDisplayType ] );

	// Disable the Lightbox Preview when the Image Click Event is updated.
	useEffect( () => {
		if ( 'lightbox' !== imageClickEvent ) {
			setLightboxPreview( false );
		}
	}, [ imageClickEvent ] );

	// Bar Option Generation.
	const generateBarOptions = () =>
		'grid' === feedLayout || 'tiled' === feedLayout
			? [
					{
						label: __( 'Overlay', 'vexaltrix' ),
						value: 'overlay',
					},
					{
						label: __( 'Bar Over Image', 'vexaltrix' ),
						value: 'bar-inside',
					},
			  ]
			: [
					{
						label: __( 'Overlay', 'vexaltrix' ),
						value: 'overlay',
					},
					{
						label: __( 'Bar Over Image', 'vexaltrix' ),
						value: 'bar-inside',
					},
					{
						label: __( 'Bar Outside Image', 'vexaltrix' ),
						value: 'bar-outside',
					},
			  ];

	// Do any other actions needed before rendering.
	doAction( 'vexaltrix.image-gallery.settings.actions', attributes, setAttributes );

	const renderCaptionDisplay = ( isHover ) => (
		<>
			<AdvancedPopColorControl
				label={ __( 'Text Color', 'vexaltrix' ) }
				colorValue={
					isHover ? ( captionColorHover ? captionColorHover : '' ) : captionColor ? captionColor : ''
				}
				data={ {
					value: isHover ? captionColorHover : captionColor,
					label: isHover ? 'captionColorHover' : 'captionColor',
				} }
				setAttributes={ setAttributes }
			/>
			<AdvancedPopColorControl
				label={ labelForCaptionBgColor }
				colorValue={
					isHover
						? captionBackgroundColorHover
							? captionBackgroundColorHover
							: ''
						: captionBackgroundColor
						? captionBackgroundColor
						: ''
				}
				data={ {
					value: isHover ? captionBackgroundColorHover : captionBackgroundColor,
					label: isHover ? 'captionBackgroundColorHover' : 'captionBackgroundColor',
				} }
				setAttributes={ setAttributes }
			/>
		</>
	);

	const renderOverlayDisplay = ( isHover ) => (
		<>
			{ captionBackgroundEnableBlur && (
				<Range
					label={ __( 'Blur Amount', 'vexaltrix' ) }
					setAttributes={ setAttributes }
					value={ isHover ? captionBackgroundBlurAmountHover : captionBackgroundBlurAmount }
					data={ {
						value: isHover ? captionBackgroundBlurAmountHover : captionBackgroundBlurAmount,
						label: isHover ? 'captionBackgroundBlurAmountHover' : 'captionBackgroundBlurAmount',
					} }
					min={ 0 }
					max={ 10 }
					displayUnit={ false }
				/>
			) }
			{ /* The entire section below can be created into a component if required in the future */ }
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ __( 'Effect', 'vexaltrix' ) }
				data={ {
					value: isHover ? captionBackgroundEffectHover : captionBackgroundEffect,
					label: isHover ? 'captionBackgroundEffectHover' : 'captionBackgroundEffect',
				} }
				options={ [
					{
						value: 'none',
						label: __( 'None', 'vexaltrix' ),
					},
					{
						value: 'grayscale',
						label: __( 'Grayscale', 'vexaltrix' ),
					},
					{
						value: 'sepia',
						label: __( 'Sepia', 'vexaltrix' ),
					},
				] }
			/>
			{ renderBackgroundEffectSettings(
				isHover ? captionBackgroundEffectHover : captionBackgroundEffect,
				isHover
			) }
			{ /* The entire section above can be created into a component  if required in the future */ }
			{ ! imageDisplayCaption && (
				<AdvancedPopColorControl
					label={ __( 'Overlay Color', 'vexaltrix' ) }
					colorValue={
						isHover ? ( overlayColorHover ? overlayColorHover : '' ) : overlayColor ? overlayColor : ''
					}
					data={ {
						value: isHover ? overlayColorHover : overlayColor,
						label: isHover ? 'overlayColorHover' : 'overlayColor',
					} }
					setAttributes={ setAttributes }
				/>
			) }
		</>
	);

	const renderBackgroundEffectSettings = ( bgEffect, isHover ) => {
		switch ( bgEffect ) {
			case 'grayscale':
			case 'sepia':
				return (
					<Range
						label={ isHover ? labelForHoverBgEffectAmount : labelForBgEffectAmount }
						setAttributes={ setAttributes }
						value={ isHover ? captionBackgroundEffectAmountHover : captionBackgroundEffectAmount }
						data={ {
							value: isHover ? captionBackgroundEffectAmountHover : captionBackgroundEffectAmount,
							label: isHover ? 'captionBackgroundEffectAmountHover' : 'captionBackgroundEffectAmount',
						} }
						min={ 0 }
						max={ 100 }
						displayUnit={ false }
					/>
				);
		}
	};

	const renderPaginationColors = ( isHover ) => (
		<>
			<AdvancedPopColorControl
				label={ labelForPaginationColor }
				colorValue={
					isHover ? ( paginateColorHover ? paginateColorHover : '' ) : paginateColor ? paginateColor : ''
				}
				data={ {
					value: isHover ? paginateColorHover : paginateColor,
					label: isHover ? 'paginateColorHover' : 'paginateColor',
				} }
				setAttributes={ setAttributes }
			/>
			{ 'masonry' === feedLayout && ! paginateUseLoader && (
				<>
					<AdvancedPopColorControl
						label={ __( 'Text Color', 'vexaltrix' ) }
						colorValue={
							isHover
								? paginateButtonTextColorHover
									? paginateButtonTextColorHover
									: ''
								: paginateButtonTextColor
								? paginateButtonTextColor
								: ''
						}
						data={ {
							value: isHover ? paginateButtonTextColorHover : paginateButtonTextColor,
							label: isHover ? 'paginateButtonTextColorHover' : 'paginateButtonTextColor',
						} }
						setAttributes={ setAttributes }
					/>
				</>
			) }
		</>
	);

	// Panel Component Renders

	const initialSettings = () => (
		<p style={ { padding: '16px' } }>{ __( 'Upload images to enable settings', 'vexaltrix' ) }</p>
	);

	const captionSettings = () => (
		<UAGAdvancedPanelBody title={ __( 'Caption', 'vexaltrix' ) } initialOpen={ false }>
			<ToggleControl
				label={ __( 'Enable Captions', 'vexaltrix' ) }
				checked={ imageDisplayCaption }
				onChange={ () => setAttributes( { imageDisplayCaption: ! imageDisplayCaption } ) }
			/>
			{ imageDisplayCaption && (
				<>
					<UAGSelectControl
						label={ __( 'Type', 'vexaltrix' ) }
						data={ {
							value: captionDisplayType,
							label: 'captionDisplayType',
						} }
						setAttributes={ setAttributes }
						options={ generateBarOptions() }
					/>
					{ captionDisplayType !== 'bar-outside' ? (
						<>
							<UAGSelectControl
								label={ __( 'Visibility', 'vexaltrix' ) }
								data={ {
									value: captionVisibility,
									label: 'captionVisibility',
								} }
								setAttributes={ setAttributes }
							>
								<option value="hover">Show on hover</option>
								<option value="antiHover">Hide on hover</option>
								<option value="always">Always Visible</option>
							</UAGSelectControl>
							<VexaltrixMatrixControl
								data={ {
									label: 'imageCaptionAlignment',
									value: imageCaptionAlignment,
								} }
								onChange={ ( value ) => updateSplitAlignments( value ) }
							/>
						</>
					) : (
						<>
							<MultiButtonsControl
								setAttributes={ setAttributes }
								label={ __( 'Alignment', 'vexaltrix' ) }
								data={ {
									value: imageCaptionAlignment02,
									label: 'imageCaptionAlignment02',
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
							<MultiButtonsControl
								setAttributes={ setAttributes }
								label={ __( 'Bar Position', 'vexaltrix' ) }
								data={ {
									value: imageCaptionAlignment01,
									label: 'imageCaptionAlignment01',
								} }
								options={ [
									{
										value: 'top',
										label: __( 'Above', 'vexaltrix' ),
									},
									{
										value: 'bottom',
										label: __( 'Below', 'vexaltrix' ),
									},
								] }
								showIcons={ false }
							/>
							<Range
								label={ __( 'Gap', 'vexaltrix' ) }
								setAttributes={ setAttributes }
								value={ captionGap }
								data={ {
									value: captionGap,
									label: 'captionGap',
								} }
								min={ 0 }
								max={ 100 }
								unit={ {
									value: captionGapUnit,
									label: 'captionGapUnit',
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
						</>
					) }
					<UAGTextControl
						label={ __( 'Default', 'vexaltrix' ) }
						data={ {
							value: imageDefaultCaption,
							label: 'imageDefaultCaption',
						} }
						setAttributes={ setAttributes }
						value={ imageDefaultCaption }
						variant={ 'inline' }
					/>
				</>
			) }
		</UAGAdvancedPanelBody>
	);

	const isProActivated = Boolean( vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status );
	// Options from Free and Pro
	const freeAndProOptions = [
		{ label: __( 'None', 'vexaltrix' ), value: 'none', disabled: false },
		{ label: __( 'Lightbox', 'vexaltrix' ), value: 'lightbox', disabled: false },
		{ label: __( 'Open Image', 'vexaltrix' ), value: 'image', disabled: false },
		{
			label: __( 'Custom URL (Vexaltrix Pro)', 'vexaltrix' ),
			value: 'url',
			disabled: ! isProActivated,
		},
	];

	const layoutSettings = () => (
		<UAGAdvancedPanelBody title={ __( 'Layout', 'vexaltrix' ) } initialOpen={ true }>
			<MultiMediaSelector
				slug={ 'gallery' }
				label={ __( 'Update Gallery', 'vexaltrix' ) }
				disableLabel={ true }
				mediaType={ 'images' }
				onSelectMedia={ updateMediaGallery }
				mediaGallery={ mediaGallery }
				mediaIDs={ mediaIDs }
				allowedTypes={ [ 'image' ] }
				createGallery={ true }
			/>
			<ToggleControl
				label={ __( 'Disable Lazy Loading', 'vexaltrix' ) }
				checked={ disableLazyLoad }
				onChange={ () => {
					setAttributes( { disableLazyLoad: ! disableLazyLoad } );
				} }
			/>
			<UAGSelectControl
				label={ __( 'Type', 'vexaltrix' ) }
				data={ {
					value: feedLayout,
					label: 'feedLayout',
				} }
				setAttributes={ setAttributes }
				options={ [
					{
						label: __( 'Grid', 'vexaltrix' ),
						value: 'grid',
					},
					{
						label: __( 'Masonry', 'vexaltrix' ),
						value: 'masonry',
					},
					{
						label: __( 'Carousel', 'vexaltrix' ),
						value: 'carousel',
					},
					{
						label: __( 'Tiled', 'vexaltrix' ),
						value: 'tiled',
					},
				] }
			/>
			<ImageSizeControl
				data={ {
					sizeSlug: {
						label: 'galleryImageSize',
						value: galleryImageSize,
					},
					sizeSlugTablet: {
						label: 'galleryImageSizeTablet',
						value: galleryImageSizeTablet,
					},
					sizeSlugMobile: {
						label: 'galleryImageSizeMobile',
						value: galleryImageSizeMobile,
					},
				} }
				setAttributes={ setAttributes }
				imageSizeOptions={ imageSizeOptions }
				isResizable={ false }
			/>
			<ResponsiveSlider
				label={ __( 'Columns', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: columnsDesk,
						label: 'columnsDesk',
					},
					tablet: {
						value: columnsTab,
						label: 'columnsTab',
					},
					mobile: {
						value: columnsMob,
						label: 'columnsMob',
					},
				} }
				min={ 1 }
				max={
					'carousel' === feedLayout ? Math.min( MAX_IMAGE_COLUMNS, mediaGallery.length ) : MAX_IMAGE_COLUMNS
				}
				displayUnit={ false }
				setAttributes={ setAttributes }
			/>
			<UAGSelectControl
				label={ __( 'Click Event', 'vexaltrix' ) }
				data={ {
					value: imageClickEvent,
					label: 'imageClickEvent',
				} }
				setAttributes={ setAttributes }
				options={ freeAndProOptions }
			/>
		</UAGAdvancedPanelBody>
	);

	const lightboxSettings = () => (
		<UAGAdvancedPanelBody panelId={ 'lightbox' } title={ __( 'Lightbox', 'vexaltrix' ) } initialOpen={ false }>
			<ToggleControl
				label={ __( 'Preview Lightbox (Desktop)', 'vexaltrix' ) }
				checked={ 'Desktop' === deviceType ? lightboxPreview : false }
				disabled={ 'Desktop' === deviceType ? undefined : true }
				onChange={ () => setLightboxPreview( ! lightboxPreview ) }
				help={
					'Desktop' === deviceType
						? __(
								'Note: The lightbox preview will automatically close when the page reloads, and it will be displayed in fullscreen mode on the front end.',
								'vexaltrix'
						  )
						: __( 'To preview this in the editor, use Desktop mode.', 'vexaltrix' )
				}
			/>
			<UAGIconPicker
				label={ __( 'Close Icon', 'vexaltrix' ) }
				value={ lightboxCloseIcon }
				onChange={ ( value ) => setAttributes( { lightboxCloseIcon: value } ) }
			/>
			<ToggleControl
				label={ __( 'Display Image Number', 'vexaltrix' ) }
				checked={ lightboxDisplayCount }
				onChange={ () => setAttributes( { lightboxDisplayCount: ! lightboxDisplayCount } ) }
			/>
			<ToggleControl
				label={ __( 'Display Captions', 'vexaltrix' ) }
				checked={ lightboxDisplayCaptions }
				onChange={ () => setAttributes( { lightboxDisplayCaptions: ! lightboxDisplayCaptions } ) }
			/>
			<ToggleControl
				label={ __( 'Display Thumbnails', 'vexaltrix' ) }
				checked={ lightboxThumbnails }
				onChange={ () => setAttributes( { lightboxThumbnails: ! lightboxThumbnails } ) }
			/>
			{ ( lightboxCloseIcon || lightboxDisplayCount ) && (
				<ResponsiveSlider
					label={ __( 'Icon/Number Size', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: lightboxIconSize,
							label: 'lightboxIconSize',
						},
						tablet: {
							value: lightboxIconSizeTablet,
							label: 'lightboxIconSizeTablet',
						},
						mobile: {
							value: lightboxIconSizeMobile,
							label: 'lightboxIconSizeMobile',
						},
					} }
					min={ 0 }
					max={ 100 }
					displayUnit={ false }
					setAttributes={ setAttributes }
				/>
			) }
			{ lightboxDisplayCaptions && (
				<ResponsiveSlider
					label={ __( 'Caption Min Height', 'vexaltrix' ) }
					data={ {
						desktop: {
							value: lightboxCaptionHeight,
							label: 'lightboxCaptionHeight',
						},
						tablet: {
							value: lightboxCaptionHeightTablet,
							label: 'lightboxCaptionHeightTablet',
						},
						mobile: {
							value: lightboxCaptionHeightMobile,
							label: 'lightboxCaptionHeightMobile',
						},
					} }
					min={ 0 }
					max={ 300 }
					displayUnit={ false }
					setAttributes={ setAttributes }
				/>
			) }
		</UAGAdvancedPanelBody>
	);

	const layoutSpecificSettings = () => (
		<UAGAdvancedPanelBody title={ labelForLayoutPanel } initialOpen={ false }>
			{ feedLayout === 'carousel' && (
				<>
					<Range
						label={ __( 'Starting Image', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						value={ carouselStartAt + 1 }
						data={ {
							value: carouselStartAt,
							label: 'carouselStartAt',
						} }
						onChange={ ( value ) => setAttributes( { carouselStartAt: value - 1 } ) }
						min={ 1 }
						max={ mediaGallery.length }
						displayUnit={ false }
					/>
					<Range
						label={ __( 'Transition Speed (ms)', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						value={ carouselTransitionSpeed }
						data={ {
							value: carouselTransitionSpeed,
							label: 'carouselTransitionSpeed',
						} }
						min={ 0 }
						max={ 9999 }
						displayUnit={ false }
					/>
					<ToggleControl
						label={ __( 'Crop Images to Squares', 'vexaltrix' ) }
						checked={ carouselSquares }
						onChange={ () => setAttributes( { carouselSquares: ! carouselSquares } ) }
					/>
					<ToggleControl
						label={ __( 'Infinite Carousel', 'vexaltrix' ) }
						checked={ carouselLoop }
						onChange={ () => setAttributes( { carouselLoop: ! carouselLoop } ) }
					/>
					<ToggleControl
						label={ __( 'Display Dots', 'vexaltrix' ) }
						checked={ paginateUseDots }
						onChange={ () => setAttributes( { paginateUseDots: ! paginateUseDots } ) }
					/>
					<ToggleControl
						label={ __( 'Display Arrows', 'vexaltrix' ) }
						checked={ paginateUseArrows }
						onChange={ () => setAttributes( { paginateUseArrows: ! paginateUseArrows } ) }
					/>
					<ToggleControl
						label={ __( 'Autoplay', 'vexaltrix' ) }
						checked={ carouselAutoplay }
						onChange={ () => setAttributes( { carouselAutoplay: ! carouselAutoplay } ) }
					/>
					{ carouselAutoplay && (
						<>
							<Range
								label={ __( 'Autoplay Speed (ms)', 'vexaltrix' ) }
								setAttributes={ setAttributes }
								value={ carouselAutoplaySpeed }
								data={ {
									value: carouselAutoplaySpeed,
									label: 'carouselAutoplaySpeed',
								} }
								min={ 0 }
								max={ 5000 }
								displayUnit={ false }
							/>
							<ToggleControl
								label={ __( 'Pause on Hover', 'vexaltrix' ) }
								checked={ carouselPauseOnHover }
								onChange={ () => setAttributes( { carouselPauseOnHover: ! carouselPauseOnHover } ) }
							/>
						</>
					) }
				</>
			) }
			{ ( feedLayout === 'grid' || feedLayout === 'masonry' ) && (
				<>
					<ToggleControl
						label={ __( 'Pagination', 'vexaltrix' ) }
						checked={ feedPagination }
						onChange={ () => {
							switch ( feedLayout ) {
								case 'grid':
									return setAttributes( {
										paginateUseArrows: ! feedPagination,
										paginateUseDots: ! feedPagination,
										feedPagination: ! feedPagination,
									} );
								case 'masonry':
									return setAttributes( {
										paginateUseLoader: ! feedPagination,
										feedPagination: ! feedPagination,
									} );
							}
						} }
					/>
					{ feedPagination && (
						<>
							<Range
								label={ __( 'Images Per Page', 'vexaltrix' ) }
								setAttributes={ setAttributes }
								value={ paginateLimit }
								data={ {
									value: paginateLimit,
									label: 'paginateLimit',
								} }
								min={ 1 }
								max={ 100 }
								displayUnit={ false }
							/>
							{ feedLayout === 'masonry' && (
								<>
									<MultiButtonsControl
										setAttributes={ setAttributes }
										label={ __( 'Pagination Type', 'vexaltrix' ) }
										data={ {
											value: paginateUseLoader,
											label: 'paginateUseLoader',
										} }
										options={ [
											{
												value: true,
												label: __( 'Loader', 'vexaltrix' ),
											},
											{
												value: false,
												label: __( 'Button', 'vexaltrix' ),
											},
										] }
									/>
									{ ! paginateUseLoader && (
										<>
											<MultiButtonsControl
												setAttributes={ setAttributes }
												label={ __( 'Button Alignment', 'vexaltrix' ) }
												data={ {
													value: paginateButtonAlign,
													label: 'paginateButtonAlign',
												} }
												className="vxt-multi-button-alignment-control"
												options={ [
													{
														value: 'flex-start',
														icon: <Icon icon={ renderSVG( 'fa fa-align-left' ) } />,
														tooltip: __( 'Left', 'vexaltrix' ),
													},
													{
														value: 'center',
														icon: <Icon icon={ renderSVG( 'fa fa-align-center' ) } />,
														tooltip: __( 'Center', 'vexaltrix' ),
													},
													{
														value: 'flex-end',
														icon: <Icon icon={ renderSVG( 'fa fa-align-right' ) } />,
														tooltip: __( 'Right', 'vexaltrix' ),
													},
												] }
												showIcons={ true }
											/>
										</>
									) }
								</>
							) }
						</>
					) }
				</>
			) }
		</UAGAdvancedPanelBody>
	);

	const imageStyling = () => (
		<UAGAdvancedPanelBody title={ __( 'Image', 'vexaltrix' ) } initialOpen={ true }>
			<ToggleControl
				label={ __( 'Enable Hover Zoom', 'vexaltrix' ) }
				checked={ imageEnableZoom }
				onChange={ () => setAttributes( { imageEnableZoom: ! imageEnableZoom } ) }
			/>
			{ imageEnableZoom && (
				<MultiButtonsControl
					setAttributes={ setAttributes }
					label={ __( 'Zoom Type', 'vexaltrix' ) }
					data={ {
						value: imageZoomType,
						label: 'imageZoomType',
					} }
					options={ [
						{
							value: 'zoom-in',
							label: __( 'Zoom In', 'vexaltrix' ),
						},
						{
							value: 'zoom-out',
							label: __( 'Zoom Out', 'vexaltrix' ),
						},
					] }
				/>
			) }
			<ToggleControl
				label={ __( 'Enable Blur Overlay', 'vexaltrix' ) }
				checked={ captionBackgroundEnableBlur }
				onChange={ () => setAttributes( { captionBackgroundEnableBlur: ! captionBackgroundEnableBlur } ) }
			/>
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
				normal={ renderOverlayDisplay( false ) }
				hover={ renderOverlayDisplay( true ) }
				// disableBottomSeparator={ false }
			/>
			<ResponsiveBorder
				setAttributes={ setAttributes }
				prefix={ 'image' }
				attributes={ attributes }
				deviceType={ deviceType }
			/>
			<ResponsiveSlider
				label={ __( 'Gap Between Images', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: gridImageGap,
						label: 'gridImageGap',
						unit: {
							value: gridImageGapUnit,
							label: 'gridImageGapUnit',
						},
					},
					tablet: {
						value: gridImageGapTab,
						label: 'gridImageGapTab',
						unit: {
							value: gridImageGapUnitTab,
							label: 'gridImageGapUnitTab',
						},
					},
					mobile: {
						value: gridImageGapMob,
						label: 'gridImageGapMob',
						unit: {
							value: gridImageGapUnitMob,
							label: 'gridImageGapUnitMob',
						},
					},
				} }
				min={ 0 }
				max={ 100 }
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
				setAttributes={ setAttributes }
			/>
		</UAGAdvancedPanelBody>
	);

	const boxShadow = () => (
		<UAGAdvancedPanelBody title={ __( 'Box Shadow', 'vexaltrix' ) } initialOpen={ false }>
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
						/>
					</>
				}
				disableBottomSeparator={ true }
			/>
		</UAGAdvancedPanelBody>
	);

	const spacing = () => (
		<UAGAdvancedPanelBody title={ __( 'Spacing', 'vexaltrix' ) } initialOpen={ false }>
			<SpacingControl
				{ ...props }
				label={ __( 'Padding', 'vexaltrix' ) }
				valueTop={ {
					value: feedMarginTop,
					label: 'feedMarginTop',
				} }
				valueRight={ {
					value: feedMarginRight,
					label: 'feedMarginRight',
				} }
				valueBottom={ {
					value: feedMarginBottom,
					label: 'feedMarginBottom',
				} }
				valueLeft={ {
					value: feedMarginLeft,
					label: 'feedMarginLeft',
				} }
				valueTopTablet={ {
					value: feedMarginTopTab,
					label: 'feedMarginTopTab',
				} }
				valueRightTablet={ {
					value: feedMarginRightTab,
					label: 'feedMarginRightTab',
				} }
				valueBottomTablet={ {
					value: feedMarginBottomTab,
					label: 'feedMarginBottomTab',
				} }
				valueLeftTablet={ {
					value: feedMarginLeftTab,
					label: 'feedMarginLeftTab',
				} }
				valueTopMobile={ {
					value: feedMarginTopMob,
					label: 'feedMarginTopMob',
				} }
				valueRightMobile={ {
					value: feedMarginRightMob,
					label: 'feedMarginRightMob',
				} }
				valueBottomMobile={ {
					value: feedMarginBottomMob,
					label: 'feedMarginBottomMob',
				} }
				valueLeftMobile={ {
					value: feedMarginLeftMob,
					label: 'feedMarginLeftMob',
				} }
				unit={ {
					value: feedMarginUnit,
					label: 'feedMarginUnit',
				} }
				tUnit={ {
					value: feedMarginUnitTab,
					label: 'feedMarginUnitTab',
				} }
				mUnit={ {
					value: feedMarginUnitMob,
					label: 'feedMarginUnitMob',
				} }
				attributes={ attributes }
				setAttributes={ setAttributes }
				link={ {
					value: feedMarginUnitLink,
					label: 'feedMarginUnitLink',
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
		</UAGAdvancedPanelBody>
	);

	const lightboxStyling = () => (
		<UAGAdvancedPanelBody panelId={ 'lightbox' } title={ __( 'Lightbox', 'vexaltrix' ) } initialOpen={ false }>
			{ ( lightboxDisplayCaptions || lightboxDisplayCount ) && (
				<TypographyControl
					label={ __( 'Typography', 'vexaltrix' ) }
					attributes={ attributes }
					setAttributes={ setAttributes }
					loadGoogleFonts={ {
						value: lightboxLoadGoogleFonts,
						label: 'lightboxLoadGoogleFonts',
					} }
					fontFamily={ {
						value: lightboxFontFamily,
						label: 'lightboxFontFamily',
					} }
					fontWeight={ {
						value: lightboxFontWeight,
						label: 'lightboxFontWeight',
					} }
					fontStyle={ {
						value: lightboxFontStyle,
						label: 'lightboxFontStyle',
					} }
					transform={ {
						value: lightboxTransform,
						label: 'lightboxTransform',
					} }
					decoration={ {
						value: lightboxDecoration,
						label: 'lightboxDecoration',
					} }
					fontSizeType={ {
						value: lightboxFontSizeType,
						label: 'lightboxFontSizeType',
					} }
					fontSize={ {
						value: lightboxFontSize,
						label: 'lightboxFontSize',
					} }
					fontSizeMobile={ {
						value: lightboxFontSizeMob,
						label: 'lightboxFontSizeMob',
					} }
					fontSizeTablet={ {
						value: lightboxFontSizeTab,
						label: 'lightboxFontSizeTab',
					} }
					lineHeightType={ {
						value: lightboxLineHeightType,
						label: 'lightboxLineHeightType',
					} }
					lineHeight={ {
						value: lightboxLineHeight,
						label: 'lightboxLineHeight',
					} }
					lineHeightMobile={ {
						value: lightboxLineHeightMob,
						label: 'lightboxLineHeightMob',
					} }
					lineHeightTablet={ {
						value: lightboxLineHeightTab,
						label: 'lightboxLineHeightTab',
					} }
				/>
			) }
			<ToggleControl
				label={ __( 'Blur Background', 'vexaltrix' ) }
				checked={ lightboxBackgroundEnableBlur }
				onChange={ () => setAttributes( { lightboxBackgroundEnableBlur: ! lightboxBackgroundEnableBlur } ) }
			/>
			<AdvancedPopColorControl
				label={ __( 'Background Color', 'vexaltrix' ) }
				colorValue={ lightboxBackgroundColor ? lightboxBackgroundColor : '' }
				data={ {
					value: lightboxBackgroundColor,
					label: 'lightboxBackgroundColor',
				} }
				setAttributes={ setAttributes }
			/>
			<AdvancedPopColorControl
				label={ __( 'Accent Color', 'vexaltrix' ) }
				colorValue={ lightboxIconColor ? lightboxIconColor : '' }
				data={ {
					value: lightboxIconColor,
					label: 'lightboxIconColor',
				} }
				setAttributes={ setAttributes }
				hint={ __( 'This color affects the Image Count, Close Button, and Arrows', 'vexaltrix' ) }
			/>
			{ lightboxDisplayCaptions && (
				<>
					<AdvancedPopColorControl
						label={ __( 'Caption Color', 'vexaltrix' ) }
						colorValue={ lightboxCaptionColor ? lightboxCaptionColor : '' }
						data={ {
							value: lightboxCaptionColor,
							label: 'lightboxCaptionColor',
						} }
						setAttributes={ setAttributes }
					/>
					<AdvancedPopColorControl
						label={ __( 'Caption Background', 'vexaltrix' ) }
						colorValue={ lightboxCaptionBackgroundColor ? lightboxCaptionBackgroundColor : '' }
						data={ {
							value: lightboxCaptionBackgroundColor,
							label: 'lightboxCaptionBackgroundColor',
						} }
						setAttributes={ setAttributes }
					/>
				</>
			) }
			{ lightboxBackgroundEnableBlur && (
				<Range
					label={ __( 'Blur Amount', 'vexaltrix' ) }
					setAttributes={ setAttributes }
					value={ lightboxBackgroundBlurAmount }
					data={ {
						value: lightboxBackgroundBlurAmount,
						label: 'lightboxBackgroundBlurAmount',
					} }
					min={ 0 }
					max={ 10 }
					displayUnit={ false }
				/>
			) }
			<ResponsiveSlider
				label={ __( 'Edge Distance', 'vexaltrix' ) }
				data={ {
					desktop: {
						value: lightboxEdgeDistance,
						label: 'lightboxEdgeDistance',
					},
					tablet: {
						value: lightboxEdgeDistanceTablet,
						label: 'lightboxEdgeDistanceTablet',
					},
					mobile: {
						value: lightboxEdgeDistanceMobile,
						label: 'lightboxEdgeDistanceMobile',
					},
				} }
				min={ 0 }
				max={ 100 }
				displayUnit={ false }
				setAttributes={ setAttributes }
			/>
		</UAGAdvancedPanelBody>
	);

	const captionStyling = () => (
		<UAGAdvancedPanelBody title={ __( 'Caption', 'vexaltrix' ) } initialOpen={ false }>
			{ captionVisibility === 'always' && (
				<ToggleControl
					label={ __( 'Hover Colors', 'vexaltrix' ) }
					checked={ captionSeparateColors }
					onChange={ () => setAttributes( { captionSeparateColors: ! captionSeparateColors } ) }
				/>
			) }
			{ captionVisibility === 'always' && captionSeparateColors ? (
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
					normal={ renderCaptionDisplay( false ) }
					hover={ renderCaptionDisplay( true ) }
					disableBottomSeparator={ 'overlay' === captionDisplayType }
				/>
			) : (
				<>
					<AdvancedPopColorControl
						label={ __( 'Text Color', 'vexaltrix' ) }
						colorValue={ captionColor ? captionColor : '' }
						data={ {
							value: captionColor,
							label: 'captionColor',
						} }
						setAttributes={ setAttributes }
					/>
					<AdvancedPopColorControl
						label={ labelForCaptionBgColor }
						colorValue={ captionBackgroundColor ? captionBackgroundColor : '' }
						data={ {
							value: captionBackgroundColor,
							label: 'captionBackgroundColor',
						} }
						setAttributes={ setAttributes }
					/>
				</>
			) }
			<TypographyControl
				label={ __( 'Typography', 'vexaltrix' ) }
				attributes={ attributes }
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
				fontSize={ {
					value: captionFontSize,
					label: 'captionFontSize',
				} }
				fontSizeMobile={ {
					value: captionFontSizeMob,
					label: 'captionFontSizeMob',
				} }
				fontSizeTablet={ {
					value: captionFontSizeTab,
					label: 'captionFontSizeTab',
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
					value: captionLineHeightMob,
					label: 'captionLineHeightMob',
				} }
				lineHeightTablet={ {
					value: captionLineHeightTab,
					label: 'captionLineHeightTab',
				} }
			/>
			<SpacingControl
				{ ...props }
				label={ __( 'Caption Padding', 'vexaltrix' ) }
				valueTop={ {
					value: captionPaddingTop,
					label: 'captionPaddingTop',
				} }
				valueRight={ {
					value: captionPaddingRight,
					label: 'captionPaddingRight',
				} }
				valueBottom={ {
					value: captionPaddingBottom,
					label: 'captionPaddingBottom',
				} }
				valueLeft={ {
					value: captionPaddingLeft,
					label: 'captionPaddingLeft',
				} }
				valueTopTablet={ {
					value: captionPaddingTopTab,
					label: 'captionPaddingTopTab',
				} }
				valueRightTablet={ {
					value: captionPaddingRightTab,
					label: 'captionPaddingRightTab',
				} }
				valueBottomTablet={ {
					value: captionPaddingBottomTab,
					label: 'captionPaddingBottomTab',
				} }
				valueLeftTablet={ {
					value: captionPaddingLeftTab,
					label: 'captionPaddingLeftTab',
				} }
				valueTopMobile={ {
					value: captionPaddingTopMob,
					label: 'captionPaddingTopMob',
				} }
				valueRightMobile={ {
					value: captionPaddingRightMob,
					label: 'captionPaddingRightMob',
				} }
				valueBottomMobile={ {
					value: captionPaddingBottomMob,
					label: 'captionPaddingBottomMob',
				} }
				valueLeftMobile={ {
					value: captionPaddingLeftMob,
					label: 'captionPaddingLeftMob',
				} }
				unit={ {
					value: captionPaddingUnit,
					label: 'captionPaddingUnit',
				} }
				tUnit={ {
					value: captionPaddingUnitTab,
					label: 'captionPaddingUnitTab',
				} }
				mUnit={ {
					value: captionPaddingUnitMob,
					label: 'captionPaddingUnitMob',
				} }
				attributes={ attributes }
				setAttributes={ setAttributes }
				link={ {
					value: captionPaddingUnitLink,
					label: 'captionPaddingUnitLink',
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
			{ 'overlay' !== captionDisplayType && (
				<ResponsiveBorder
					setAttributes={ setAttributes }
					prefix={ 'mainTitle' }
					attributes={ attributes }
					deviceType={ deviceType }
					disableBottomSeparator={ true }
				/>
			) }
		</UAGAdvancedPanelBody>
	);

	const paginationStyling = () => (
		<UAGAdvancedPanelBody
			title={ 'carousel' === feedLayout ? __( 'Arrows & Dots', 'vexaltrix' ) : __( 'Pagination', 'vexaltrix' ) }
			initialOpen={ false }
		>
			{ /* Grid Pagination */ }
			{ 'grid' === feedLayout && (
				<>
					<Range
						label={ __( 'Top Margin', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						value={ paginateDotDistance }
						data={ {
							value: paginateDotDistance,
							label: 'paginateDotDistance',
						} }
						min={ 0 }
						max={ 100 }
						unit={ {
							value: paginateDotDistanceUnit,
							label: 'paginateDotDistanceUnit',
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
						normal={ renderPaginationColors( false ) }
						hover={ renderPaginationColors( true ) }
						disableBottomSeparator={ true }
					/>
				</>
			) }
			{ /* Carousel Pagination */ }
			{ paginateUseArrows && 'carousel' === feedLayout && (
				<>
					<Range
						label={ __( 'Arrow Position', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						value={ paginateArrowDistance }
						data={ {
							value: paginateArrowDistance,
							label: 'paginateArrowDistance',
						} }
						min={ -100 }
						max={ 100 }
						unit={ {
							value: paginateArrowDistanceUnit,
							label: 'paginateArrowDistanceUnit',
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
						label={ __( 'Arrow Size', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						value={ paginateArrowSize }
						data={ {
							value: paginateArrowSize,
							label: 'paginateArrowSize',
						} }
						min={ 0 }
						max={ 50 }
						displayUnit={ false }
					/>
				</>
			) }
			{ paginateUseDots && 'carousel' === feedLayout && (
				<Range
					label={ __( 'Dot Position', 'vexaltrix' ) }
					setAttributes={ setAttributes }
					value={ paginateDotDistance }
					data={ {
						value: paginateDotDistance,
						label: 'paginateDotDistance',
					} }
					min={ 0 }
					max={ 100 }
					displayUnit={ false }
				/>
			) }
			{ ( paginateUseArrows || paginateUseDots ) && 'carousel' === feedLayout && (
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
					normal={ renderPaginationColors( false ) }
					hover={ renderPaginationColors( true ) }
					disableBottomSeparator={ ! paginateUseArrows }
				/>
			) }
			{ paginateUseArrows && 'carousel' === feedLayout && (
				<ResponsiveBorder
					setAttributes={ setAttributes }
					prefix={ 'arrow' }
					attributes={ attributes }
					deviceType={ deviceType }
					disableBottomSeparator={ true }
				/>
			) }
			{ /* Masonry Pagination */ }
			{ 'masonry' === feedLayout && (
				<>
					<Range
						label={ __( 'Top Margin', 'vexaltrix' ) }
						setAttributes={ setAttributes }
						value={ paginateDotDistance }
						data={ {
							value: paginateDotDistance,
							label: 'paginateDotDistance',
						} }
						min={ 0 }
						max={ 100 }
						unit={ {
							value: paginateDotDistanceUnit,
							label: 'paginateDotDistanceUnit',
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
					{ paginateUseLoader ? (
						<>
							<Range
								label={ __( 'Loader Size', 'vexaltrix' ) }
								setAttributes={ setAttributes }
								value={ paginateLoaderSize }
								data={ {
									value: paginateLoaderSize,
									label: 'paginateLoaderSize',
								} }
								min={ 0 }
								max={ 50 }
								displayUnit={ false }
							/>
							{ renderPaginationColors( false ) }
						</>
					) : (
						<>
							<TypographyControl
								label={ __( 'Typography', 'vexaltrix' ) }
								attributes={ attributes }
								setAttributes={ setAttributes }
								loadGoogleFonts={ {
									value: loadMoreLoadGoogleFonts,
									label: 'loadMoreLoadGoogleFonts',
								} }
								fontFamily={ {
									value: loadMoreFontFamily,
									label: 'loadMoreFontFamily',
								} }
								fontWeight={ {
									value: loadMoreFontWeight,
									label: 'loadMoreFontWeight',
								} }
								fontStyle={ {
									value: loadMoreFontStyle,
									label: 'loadMoreFontStyle',
								} }
								transform={ {
									value: loadMoreTransform,
									label: 'loadMoreTransform',
								} }
								decoration={ {
									value: loadMoreDecoration,
									label: 'loadMoreDecoration',
								} }
								fontSizeType={ {
									value: loadMoreFontSizeType,
									label: 'loadMoreFontSizeType',
								} }
								fontSize={ {
									value: loadMoreFontSize,
									label: 'loadMoreFontSize',
								} }
								fontSizeMobile={ {
									value: loadMoreFontSizeMob,
									label: 'loadMoreFontSizeMob',
								} }
								fontSizeTablet={ {
									value: loadMoreFontSizeTab,
									label: 'loadMoreFontSizeTab',
								} }
								lineHeightType={ {
									value: loadMoreLineHeightType,
									label: 'loadMoreLineHeightType',
								} }
								lineHeight={ {
									value: loadMoreLineHeight,
									label: 'loadMoreLineHeight',
								} }
								lineHeightMobile={ {
									value: loadMoreLineHeightMob,
									label: 'loadMoreLineHeightMob',
								} }
								lineHeightTablet={ {
									value: loadMoreLineHeightTab,
									label: 'loadMoreLineHeightTab',
								} }
							/>
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
								normal={ renderPaginationColors( false ) }
								hover={ renderPaginationColors( true ) }
							/>
							<ResponsiveBorder
								setAttributes={ setAttributes }
								prefix={ 'btn' }
								attributes={ attributes }
								deviceType={ deviceType }
								disableBottomSeparator={ ! paginateUseLoader ? false : true }
							/>
						</>
					) }
				</>
			) }
			{ ! paginateUseLoader && (
				<>
					<SpacingControl
						{ ...props }
						label={ __( 'Button Padding', 'vexaltrix' ) }
						valueTop={ {
							value: paginateButtonPaddingTop,
							label: 'paginateButtonPaddingTop',
						} }
						valueRight={ {
							value: paginateButtonPaddingRight,
							label: 'paginateButtonPaddingRight',
						} }
						valueBottom={ {
							value: paginateButtonPaddingBottom,
							label: 'paginateButtonPaddingBottom',
						} }
						valueLeft={ {
							value: paginateButtonPaddingLeft,
							label: 'paginateButtonPaddingLeft',
						} }
						valueTopTablet={ {
							value: paginateButtonPaddingTopTab,
							label: 'paginateButtonPaddingTopTab',
						} }
						valueRightTablet={ {
							value: paginateButtonPaddingRightTab,
							label: 'paginateButtonPaddingRightTab',
						} }
						valueBottomTablet={ {
							value: paginateButtonPaddingBottomTab,
							label: 'paginateButtonPaddingBottomTab',
						} }
						valueLeftTablet={ {
							value: paginateButtonPaddingLeftTab,
							label: 'paginateButtonPaddingLeftTab',
						} }
						valueTopMobile={ {
							value: paginateButtonPaddingTopMob,
							label: 'paginateButtonPaddingTopMob',
						} }
						valueRightMobile={ {
							value: paginateButtonPaddingRightMob,
							label: 'paginateButtonPaddingRightMob',
						} }
						valueBottomMobile={ {
							value: paginateButtonPaddingBottomMob,
							label: 'paginateButtonPaddingBottomMob',
						} }
						valueLeftMobile={ {
							value: paginateButtonPaddingLeftMob,
							label: 'paginateButtonPaddingLeftMob',
						} }
						unit={ {
							value: paginateButtonPaddingUnit,
							label: 'paginateButtonPaddingUnit',
						} }
						tUnit={ {
							value: paginateButtonPaddingUnitTab,
							label: 'paginateButtonPaddingUnitTab',
						} }
						mUnit={ {
							value: paginateButtonPaddingUnitMob,
							label: 'paginateButtonPaddingUnitMob',
						} }
						attributes={ attributes }
						setAttributes={ setAttributes }
						link={ {
							value: paginateButtonPaddingUnitLink,
							label: 'paginateButtonPaddingUnitLink',
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
				</>
			) }
		</UAGAdvancedPanelBody>
	);

	return (
		<>
			<InspectorControls>
				<InspectorTabs>
					<InspectorTab { ...UAGTabs.general }>
						{ ! readyToRender && initialSettings() }
						{ readyToRender && layoutSettings() }
						{ readyToRender && 'tiled' !== feedLayout && layoutSpecificSettings() }
						{ readyToRender && 'lightbox' === imageClickEvent && lightboxSettings() }
						{ readyToRender && captionSettings() }
						{ 'not-installed' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status && (
							<UAGAdvancedPanelBody className="block-editor-block-inspector__upgrade_pro vxt-upgrade_pro-tab">
								<UpgradeComponent
									control={ {
										title: __(
											'Take Image Gallery Block to the next level with powerful features',
											'vexaltrix'
										),
										choices: [
											{
												title: __( 'Custom URLs for click events', 'vexaltrix' ),
												description: '',
											},
										],
										renderAs: 'list',
										campaign: 'image-gallery',
									} }
								/>
							</UAGAdvancedPanelBody>
						) }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.style }>
						{ ! readyToRender && initialSettings() }
						{ readyToRender && imageStyling() }
						{ readyToRender && 'lightbox' === imageClickEvent && lightboxStyling() }
						{ readyToRender && imageDisplayCaption && captionStyling() }
						{ /* This Condition Below Renders the Arrows and Dots Panel ONLY if:
						1. Images are readyToRender AND
							1.1. feedPagination is needed OR
							1.2. The feedLayout is a carousel AND
								1.2.1 the carousel either has Arrows OR Dots. */ }
						{ readyToRender &&
							'tiled' !== feedLayout &&
							( ( feedPagination && 'carousel' !== feedLayout ) ||
								( 'carousel' === feedLayout && ( paginateUseArrows || paginateUseDots ) ) ) &&
							paginationStyling() }
						{ readyToRender && boxShadow() }
						{ readyToRender && spacing() }
					</InspectorTab>
					<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
				</InspectorTabs>
			</InspectorControls>
		</>
	);
};

export default memo( Settings );
