import { __ } from '@wordpress/i18n';
import { Button } from '@wordpress/components';
import { MediaUpload } from '@wordpress/block-editor';
import VXT_Block_Icons from '@Controls/block-icons';

const InitialSelector = ( { attributes, setAttributes } ) => {
	const { mediaGallery, mediaIDs } = attributes;

	const handleGalleryUpdate = ( media ) => {
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
		}
	};

	return (
		setAttributes !== 'inapplicable' && (
			<div className="vexaltrix-image-gallery-init-wrapper">
				<div className="vexaltrix-image-gallery-init-wrapper__title">
					{ VXT_Block_Icons.image_gallery }
					{ __( 'Image Gallery', 'vexaltrix' ) }
				</div>
				<p className="vexaltrix-image-gallery-init-wrapper__help-text">
					{ __( 'Select your images to get started', 'vexaltrix' ) }
				</p>
				<MediaUpload
					title={ __( 'Select Images', 'vexaltrix' ) }
					onSelect={ handleGalleryUpdate }
					allowedTypes={ [ 'image' ] }
					multiple={ true }
					value={ mediaIDs }
					gallery={ true }
					render={ ( { open } ) => (
						<Button isSecondary onClick={ open }>
							{ ! mediaGallery[ 0 ]?.url
								? __( 'Select Images', 'vexaltrix' )
								: __( 'Replace Images', 'vexaltrix' ) }
						</Button>
					) }
				/>
			</div>
		)
	);
};

export default InitialSelector;
