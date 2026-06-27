/**
 * BLOCK: Modal
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import './style.scss';
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import deprecated from './deprecated';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let modalCommonData = {};
modalCommonData = applyFilters( 'vexaltrix/modal', addCommonDataToVexaltrixBlocks( modalCommonData ) );
registerBlockType( 'vexaltrix/modal', {
	...modalCommonData,
	title: __( 'Modal', 'vexaltrix' ),
	description: __( 'This block allows you to add modal popup.', 'vexaltrix' ),
	icon: VXT_Block_Icons.modal,
	keywords: [ __( 'modal', 'vexaltrix' ), __( 'popup', 'vexaltrix' ) ],
	supports: {
		anchor: true,
	},

	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="modal" /> : <Edit { ...props } /> ),
	save,
	deprecated,
} );
