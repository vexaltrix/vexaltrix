/**
 * BLOCK: Image Gallery
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import './style.scss';
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
import transforms from './transforms';
let imageGalleryCommonData = {};
imageGalleryCommonData = applyFilters(
	'vexaltrix/image-gallery',
	addCommonDataToVexaltrixBlocks( imageGalleryCommonData )
);
registerBlockType( 'vexaltrix/image-gallery', {
	...imageGalleryCommonData,
	title: __( 'Image Gallery', 'vexaltrix' ),
	description: __( 'Create a highly customizable image gallery', 'vexaltrix' ),
	icon: VXT_Block_Icons.image_gallery,
	keywords: [
		__( 'image', 'vexaltrix' ),
		__( 'gallery', 'vexaltrix' ),
		__( 'grid', 'vexaltrix' ),
		__( 'masonry', 'vexaltrix' ),
		__( 'carousel', 'vexaltrix' ),
		__( 'tiled', 'vexaltrix' ),
		__( 'uag', 'vexaltrix' ),
		__( 'ultimate', 'vexaltrix' ),
		__( 'addon', 'vexaltrix' ),
		__( 'vexaltrix', 'vexaltrix' ),
	],
	supports: {
		anchor: true,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="image-gallery" /> : <Edit { ...props } /> ),
	save() {
		return null;
	},
	transforms,
} );
