/**
 * BLOCK: How-To Schema
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import './style.scss';
import deprecated from './deprecated';
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let howToCommonData = {};
howToCommonData = applyFilters( 'vexaltrix/how-to', addCommonDataToVexaltrixBlocks( howToCommonData ) );
registerBlockType( 'vexaltrix/how-to', {
	...howToCommonData,
	title: __( 'How To', 'vexaltrix' ),
	description: __( 'Add instructions/steps on processes using how to block.', 'vexaltrix' ),
	icon: VXT_Block_Icons.how_to,
	keywords: [ __( 'how to', 'vexaltrix' ), __( 'schema', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	supports: {
		anchor: true,
		html: false,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="how-to" /> : <Edit { ...props } /> ),
	save,
	deprecated,
} );
