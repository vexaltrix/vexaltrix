/**
 * BLOCK: Columns
 */

import { renderLegacyBlockEditorIcon } from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import deprecated from './deprecated';
import variations from './variations';
import './style.scss';
import save from './save';

import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let columnsCommonData = {};
columnsCommonData = applyFilters( 'vexaltrix/columns', addCommonDataToVexaltrixBlocks( columnsCommonData ) );
if ( 'yes' === vxt_ultimate_gutenberg_blocks_blocks_info.enable_legacy_blocks ) {
	registerBlockType( 'vexaltrix/columns', {
		...columnsCommonData,
		title: __( 'Advanced Columns', 'vexaltrix' ),
		description: __( 'Insert a number of columns within a single row.', 'vexaltrix' ),
		icon: renderLegacyBlockEditorIcon( 'columns' ),
		keywords: [ __( 'columns', 'vexaltrix' ), __( 'rows', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
		attributes,
		category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
		variations,
		edit: ( props ) =>
			props.attributes.isPreview ? <PreviewImage image="advanced-columns" /> : <Edit { ...props } />,
		getEditWrapperProps( attribute ) {
			return {
				'data-align': attribute.align,
				'data-valign': attribute.vAlign,
			};
		},
		supports: {
			// Add EditorsKit block navigator toolbar
			editorsKitBlockNavigator: true,
			anchor: true,
			html: false,
		},
		save,
		deprecated,
	} );
}
