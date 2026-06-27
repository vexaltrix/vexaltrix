/**
 * BLOCK: Forms - Block
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import './style.scss';
import { variations } from './variations';
import deprecated from './deprecated';
import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let formsCommonData = {};
formsCommonData = applyFilters( 'vexaltrix/forms', addCommonDataToVexaltrixBlocks( formsCommonData ) );
registerBlockType( 'vexaltrix/forms', {
	...formsCommonData,
	title: __( 'Form', 'vexaltrix' ),
	description: __( 'Add easily customizable forms to gather information.', 'vexaltrix' ),
	icon: VXT_Block_Icons.forms,

	keywords: [ __( 'forms', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	variations,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="form" /> : <Edit { ...props } /> ),
	supports: {
		anchor: true,
		html: false,
	},
	deprecated,
	save,
} );
