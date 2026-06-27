/**
 * BLOCK: Image
 */

import Edit from './edit';
import save from './save';
import attributes from './attributes';
import VXT_Block_Icons from '@Controls/block-icons';
import { __ } from '@wordpress/i18n';
import './style.scss';
import { registerBlockType } from '@wordpress/blocks';
import deprecated from './deprecated';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
import transforms from './transforms';
let imageCommonData = {};
imageCommonData = applyFilters( 'vexaltrix/image', addCommonDataToVexaltrixBlocks( imageCommonData ) );
registerBlockType( 'vexaltrix/image', {
	...imageCommonData,
	title: __( 'Image', 'vexaltrix' ),
	description: __( 'Add images on your webpage with multiple customization options.', 'vexaltrix' ),
	icon: VXT_Block_Icons.image,
	keywords: [
		__( 'image', 'vexaltrix' ),
		__( 'advance image', 'vexaltrix' ),
		__( 'caption', 'vexaltrix' ),
		__( 'overlay image', 'vexaltrix' ),
	],
	supports: {
		anchor: true,
		color: {
			__experimentalDuotone: 'img',
			text: false,
			background: false,
		},
		align: true,
	},

	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="image" /> : <Edit { ...props } /> ),
	save,
	__experimentalLabel: ( atts, { context } ) => {
		if ( context === 'list-view' && atts?.metadata?.name && atts.metadata.name ) {
			return atts.metadata.name;
		}

		return applyFilters( 'uag_loop_data_source_label', __( 'Image', 'vexaltrix' ), atts );
	},
	usesContext: [ 'postId', 'postType' ],
	deprecated,
	transforms,
} );
