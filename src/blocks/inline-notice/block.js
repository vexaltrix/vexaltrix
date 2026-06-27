/**
 * BLOCK: Inline Notice Block.
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
let inlineNoticeCommonData = {};
inlineNoticeCommonData = applyFilters(
	'vexaltrix/inline-notice',
	addCommonDataToVexaltrixBlocks( inlineNoticeCommonData )
);
registerBlockType( 'vexaltrix/inline-notice', {
	...inlineNoticeCommonData,
	title: __( 'Inline Notice', 'vexaltrix' ),
	description: __( 'Highlight important information using inline notice block.', 'vexaltrix' ),
	icon: VXT_Block_Icons.inline_notice,

	keywords: [ __( 'inline notice', 'vexaltrix' ), __( 'notice', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	supports: {
		anchor: true,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="inline-notice" /> : <Edit { ...props } /> ),
	save,
	deprecated,
} );
