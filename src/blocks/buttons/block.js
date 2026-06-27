/**
 * BLOCK: Buttons
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import deprecated from './deprecated';
import save from './save';
import './style.scss';
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
import transforms from './transforms';
let buttonsCommonData = {};
buttonsCommonData = applyFilters( 'vexaltrix/buttons', addCommonDataToVexaltrixBlocks( buttonsCommonData ) );
registerBlockType( 'vexaltrix/buttons', {
	...buttonsCommonData,
	title: __( 'Buttons', 'vexaltrix' ),
	description: __( 'Add multiple buttons to redirect user to different webpages.', 'vexaltrix' ),
	icon: VXT_Block_Icons.buttons,
	keywords: [ __( 'buttons', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	supports: {
		anchor: true,
		html: false,
	},
	getEditWrapperProps( attribute ) {
		return { 'data-btn-width': attribute.align };
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="buttons" /> : <Edit { ...props } /> ),
	save,
	deprecated,
	transforms,
} );
