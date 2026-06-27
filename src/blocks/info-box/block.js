/**
 * BLOCK: Info Box
 */

import VXT_Block_Icons from '@Controls/block-icons';
import Edit from './edit';
import save from './save';
import attributes from './attributes';
import deprecated from './deprecated';
import './style.scss';
import transforms from './transforms';
import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let infoBoxCommonData = {};
infoBoxCommonData = applyFilters( 'vexaltrix/info-box', addCommonDataToVexaltrixBlocks( infoBoxCommonData ) );
registerBlockType( 'vexaltrix/info-box', {
	...infoBoxCommonData,
	title: __( 'Info Box', 'vexaltrix' ),
	description: __( 'Add image/icon, separator and text description using a single block.', 'vexaltrix' ),
	icon: VXT_Block_Icons.info_box,
	keywords: [ __( 'info box', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	supports: {
		anchor: true,
	},
	usesContext: [ 'postId', 'postType' ],
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="info-box" /> : <Edit { ...props } /> ),
	save,
	deprecated,
	transforms,
} );
