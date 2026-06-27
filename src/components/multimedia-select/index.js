import { __ } from '@wordpress/i18n';
import { BaseControl } from '@wordpress/components';
import { MediaUpload } from '@wordpress/block-editor';
import VXT_Block_Icons from '@Controls/block-icons';
import UAGHelpText from '@Components/help-text';

const MultiMediaSelector = ( props ) => {
	const {
		slug = 'media',
		label = __( 'Media', 'vexaltrix' ),
		disableLabel = false,
		mediaType,
		onSelectMedia,
		mediaGallery,
		mediaIDs,
		onRemoveMedia,
		allowedTypes,
		createGallery,
		help = false,
	} = props;

	const placeholderIcon = VXT_Block_Icons.gallery_placeholder;

	let selectorLabel, replacerLabel;

	switch ( mediaType ) {
		case 'images':
			selectorLabel = __( 'Select Images', 'vexaltrix' );
			replacerLabel = __( 'Replace Images', 'vexaltrix' );
			break;
		default:
			selectorLabel = __( 'Select Media', 'vexaltrix' );
			replacerLabel = __( 'Replace Media', 'vexaltrix' );
	}

	if ( createGallery ) {
		replacerLabel = __( 'Edit Gallery', 'vexaltrix' );
	}

	const renderMediaUploader = ( open ) => {
		const uploadType = mediaGallery[ 0 ]?.url ? 'replace' : 'add';
		return (
			<button
				className={ `vexaltrix-media-control__clickable vexaltrix-media-control__clickable--${ uploadType }` }
				onClick={ open }
			>
				{ 'add' === uploadType ? (
					renderButton( uploadType )
				) : (
					<div className="uag-control-label">{ replacerLabel }</div>
				) }
			</button>
		);
	};

	const renderButton = ( buttonType ) => (
		<div className={ `vexaltrix-media-control__button vexaltrix-media-control__button--${ buttonType }` }>
			{ VXT_Block_Icons[ buttonType ] }
		</div>
	);

	return (
		<BaseControl
			className="vexaltrix-media-control"
			id={ `vxt-option-selector-${ slug }` }
			label={ label }
			hideLabelFromVision={ disableLabel }
		>
			<div className="vexaltrix-media-control__wrapper">
				{ mediaGallery[ 0 ]?.url && (
					<div className={ 'vexaltrix-media-control__icon vexaltrix-media-control__icon--stroke' }>
						{ placeholderIcon }
					</div>
				) }
				<MediaUpload
					title={ selectorLabel }
					onSelect={ onSelectMedia }
					allowedTypes={ allowedTypes ? allowedTypes : [ 'image', 'video', 'audio' ] }
					multiple={ true }
					value={ mediaIDs }
					gallery={ createGallery }
					render={ ( { open } ) => renderMediaUploader( open ) }
				/>
				{ onRemoveMedia && mediaGallery[ 0 ]?.url && (
					<button
						className="vexaltrix-media-control__clickable vexaltrix-media-control__clickable--close"
						onClick={ onRemoveMedia }
					>
						{ renderButton( 'close' ) }
					</button>
				) }
			</div>
			<UAGHelpText text={ help } />
		</BaseControl>
	);
};

export default MultiMediaSelector;
