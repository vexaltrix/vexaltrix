/**
 * BLOCK: Column
 */

import { renderLegacyBlockEditorIcon } from '@Controls/block-icons';
import Edit from './edit';
import save from './save';
import deprecated from './deprecated';
import attributes from './attributes';
import './style.scss';
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let columnCommonData = {};
columnCommonData = applyFilters( 'vexaltrix/column', addCommonDataToVexaltrixBlocks( columnCommonData ) );
registerBlockType( 'vexaltrix/column', {
	...columnCommonData,
	title: __( 'Column', 'vexaltrix' ),
	description: __( 'Immediate child of Advanced Columns', 'vexaltrix' ),
	icon: renderLegacyBlockEditorIcon( 'column' ),
	parent: [ 'vexaltrix/columns' ],
	supports: {
		inserter: false,
		// Add EditorsKit block navigator toolbar
		editorsKitBlockNavigator: true,
		html: false,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) =>
		props.attributes.isPreview ? (
			<PreviewImage image="advanced-columns-child" isChildren={ true } />
		) : (
			<Edit { ...props } />
		),
	save,
	deprecated,
} );
