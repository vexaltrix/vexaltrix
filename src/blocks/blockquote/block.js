/**
 * BLOCK: Quote
 */

import VXT_Block_Icons from '@Controls/block-icons';
import Edit from './edit';
import save from './save';
import './style.scss';
import deprecated from './deprecated';
import attributes from './attributes';
import { __ } from '@wordpress/i18n';
import transforms from './transforms';
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let blockquoteCommonData = {};
blockquoteCommonData = applyFilters( 'vexaltrix/blockquote', addCommonDataToVexaltrixBlocks( blockquoteCommonData ) );
registerBlockType( 'vexaltrix/blockquote', {
	...blockquoteCommonData,
	title: __( 'Blockquote', 'vexaltrix' ),
	description: __( 'Display qoutes/quoted texts using blockquote.', 'vexaltrix' ),
	icon: VXT_Block_Icons.blockquote,
	keywords: [ __( 'blockquote', 'vexaltrix' ), __( 'quote', 'vexaltrix' ), __( 'uagb', 'vexaltrix' ) ],
	supports: {
		anchor: true,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="blockquote" /> : <Edit { ...props } /> ),
	save,
	deprecated,
	transforms,
} );
