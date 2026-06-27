import { useEffect, useState, useRef } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { BaseControl } from '@wordpress/components';
import { MediaUpload } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { getIdFromString, getPanelIdFromRef } from '@Utils/Helpers';
import VXT_Block_Icons from '@Controls/block-icons';
import getUAGEditorStateLocalStorage from '@Controls/getUAGEditorStateLocalStorage';
import UAGConfirmPopup from '../popup-confirm';
import UAGHelpText from '@Components/help-text';
import { applyFilters } from '@wordpress/hooks';

import getApiData from '@Controls/getApiData';

const UAGMediaPicker = ( props ) => {
	const [ panelNameForHook, setPanelNameForHook ] = useState( null );
	const panelRef = useRef( null );

	const selectedBlock = useSelect( ( select ) => {
		return select( 'core/block-editor' ).getSelectedBlock();
	}, [] );

	const uagLocalStorage = getUAGEditorStateLocalStorage();
	const blockNameForHook = selectedBlock?.name.split( '/' ).pop();

	useEffect( () => {
		setPanelNameForHook( getPanelIdFromRef( panelRef ) );
	}, [ blockNameForHook ] );

	const [ isOpen, setOpen ] = useState( false );

	const {
		onSelectImage,
		backgroundImage,
		onRemoveImage,
		slug = 'image',
		label = __( 'Image', 'vexaltrix' ),
		disableLabel = false,
		disableRemove = false,
		allow = [ 'image' ],
		disableDynamicContent = false,
		help = false,
	} = props;

	// This is used to render an icon in place of the background image when needed.
	let placeholderIcon;

	// These are the localized texts that will show on the Select / Change Button and Popup.
	let selectMediaLabel, replaceMediaLabel;

	switch ( slug ) {
		case 'video':
			selectMediaLabel = __( 'Select Video', 'vexaltrix' );
			replaceMediaLabel = __( 'Change Video', 'vexaltrix' );
			placeholderIcon = VXT_Block_Icons.video_placeholder;
			break;
		case 'lottie':
			selectMediaLabel = __( 'Select Lottie Animation', 'vexaltrix' );
			replaceMediaLabel = __( 'Change Lottie Animation', 'vexaltrix' );
			placeholderIcon = VXT_Block_Icons.lottie;
			break;
		case 'svg':
			selectMediaLabel = __( 'Upload SVG', 'vexaltrix' );
			replaceMediaLabel = __( 'Change SVG', 'vexaltrix' );
			break;
		default:
			selectMediaLabel = __( 'Select Image', 'vexaltrix' );
			replaceMediaLabel = __( 'Change Image', 'vexaltrix' );
	}

	const registerImageExtender = disableDynamicContent
		? null
		: applyFilters( 'uagb.registerImageExtender', '', selectedBlock?.name, onSelectImage );
	const registerImageLinkExtender = disableDynamicContent
		? null
		: applyFilters( 'uagb.registerImageLinkExtender', '', selectedBlock?.name, 'bgImageLink', 'url' );

	const isShowImageUploader = () => {
		if ( disableDynamicContent ) {
			return true;
		}
		const dynamicContent = selectedBlock?.attributes?.dynamicContent;
		if ( dynamicContent && dynamicContent?.bgImage?.enable === true ) {
			return false;
		}
		return true;
	};

	const onConfirm = ( open ) => {
		// Create an object with the svg_nonce and confirmation properties
		const data = {
			svg_nonce: vxt_ultimate_gutenberg_blocks_blocks_info.vxt_ultimate_gutenberg_blocks_svg_confirmation_nonce,
			confirmation: 'yes',
		};
		// Call the getApiData function with the specified parameters
		const getApiFetchData = getApiData( {
			url: vxt_ultimate_gutenberg_blocks_blocks_info.ajax_url,
			action: 'vxt_ultimate_gutenberg_blocks_svg_confirmation',
			data,
		} );
		// Wait for the API call to complete, then update uagLocalstorage
		getApiFetchData.then( ( response ) => {
			if ( response.success ) {
				uagLocalStorage.setItem( 'uagSvgConfirmation', JSON.stringify( 'yes' ) );
				open();
			}
		} );
	};

	const OpenMediaUploader = ( open ) => {
		const svgConfirmation = getUAGEditorStateLocalStorage( 'uagSvgConfirmation' );
		if ( slug !== 'svg' || svgConfirmation === 'yes' ) {
			open();
			return;
		}

		setOpen( true );
	};

	const renderMediaUploader = ( open ) => {
		const uploadType = backgroundImage?.url ? 'replace' : 'add';
		return (
			<>
				{ 'add' === uploadType && (
					<button
						className={ `vexaltrix-media-control__clickable vexaltrix-media-control__clickable--${ uploadType }` }
						onClick={ () => OpenMediaUploader( open ) }
					>
						{ renderButton( uploadType ) }
					</button>
				) }
				<div className="vexaltrix-media-control__footer">
					<button className="uag-control-label" onClick={ () => OpenMediaUploader( open ) }>
						{ replaceMediaLabel }
					</button>
					{ registerImageExtender }
				</div>
				{ slug === 'svg' && (
					<UAGConfirmPopup
						isOpen={ isOpen }
						setOpen={ setOpen }
						onConfirm={ onConfirm }
						title={ __( 'Upload SVG?', 'vexaltrix' ) }
						description={ __( 'Upload SVG can be potentially risky. Are you sure?', 'vexaltrix' ) }
						confirmLabel={ __( 'Upload Anyway', 'vexaltrix' ) }
						cancelLabel={ __( 'Cancel', 'vexaltrix' ) }
						executable={ open }
					/>
				) }
			</>
		);
	};

	const renderButton = ( buttonType ) => (
		<div className={ `vexaltrix-media-control__button vexaltrix-media-control__button--${ buttonType }` }>
			{ VXT_Block_Icons[ buttonType ] }
		</div>
	);

	// This Can Be Deprecated.
	const generateBackground = ( media ) => {
		const regex = /(?:\.([^.]+))?$/;
		let mediaURL = media;
		switch ( regex.exec( String( mediaURL ) )[ 1 ] ) {
			// For Lottie JSON Files.
			case 'json':
				mediaURL = '';
				break;
			// For Videos.
			case 'avi':
			case 'mpg':
			case 'mp4':
			case 'm4v':
			case 'mov':
			case 'ogv':
			case 'vtt':
			case 'wmv':
			case '3gp':
			case '3g2':
				mediaURL = '';
				break;
		}
		return mediaURL;
	};

	const controlName = getIdFromString( props?.label );
	const controlBeforeDomElement = applyFilters(
		`vexaltrix.${ blockNameForHook }.${ panelNameForHook }.${ controlName }.before`,
		'',
		blockNameForHook
	);
	const controlAfterDomElement = applyFilters(
		`vexaltrix.${ blockNameForHook }.${ panelNameForHook }.${ controlName }`,
		'',
		blockNameForHook
	);

	return (
		<div ref={ panelRef } className="components-base-control">
			{ controlBeforeDomElement }
			<BaseControl
				className="vexaltrix-media-control"
				id={ `vxt-option-selector-${ slug }` }
				label={ label }
				hideLabelFromVision={ disableLabel }
			>
				{ isShowImageUploader() ? (
					<>
						<div
							className="vexaltrix-media-control__wrapper"
							style={ {
								backgroundImage:
									! placeholderIcon &&
									backgroundImage?.url &&
									! backgroundImage?.svg &&
									`url("${ generateBackground( backgroundImage?.url ) }")`,
							} }
						>
							{ placeholderIcon && backgroundImage?.url && (
								<div className="vexaltrix-media-control__icon vexaltrix-media-control__icon--stroke">
									{ placeholderIcon }
								</div>
							) }
							{ backgroundImage?.svg && (
								<div
									className="vexaltrix-media-control__icon vexaltrix-media-control__icon--stroke"
									dangerouslySetInnerHTML={ { __html: backgroundImage.svg } }
								></div>
							) }
							<MediaUpload
								title={ selectMediaLabel }
								onSelect={ onSelectImage }
								allowedTypes={ allow }
								value={ backgroundImage?.id }
								render={ ( { open } ) => renderMediaUploader( open ) }
							/>
							{ ! disableRemove && backgroundImage?.url && (
								<button
									className="vexaltrix-media-control__clickable vexaltrix-media-control__clickable--close"
									onClick={ onRemoveImage }
								>
									{ renderButton( 'close' ) }
								</button>
							) }
						</div>
						<UAGHelpText text={ help } />
					</>
				) : (
					registerImageExtender
				) }
			</BaseControl>
			{ registerImageLinkExtender }
			{ controlAfterDomElement }
		</div>
	);
};

export default UAGMediaPicker;
