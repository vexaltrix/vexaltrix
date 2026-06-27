/**
 * BLOCK: Table of Contents
 */

import VXT_Block_Icons from '@Controls/block-icons';
import attributes from './attributes';
import Edit from './edit';
import deprecated from './deprecated';
import './style.scss';

import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let tocCommonData = {};
tocCommonData = applyFilters( 'vexaltrix/table-of-contents', addCommonDataToVexaltrixBlocks( tocCommonData ) );
registerBlockType( 'vexaltrix/table-of-contents', {
	...tocCommonData,
	title: __( 'Table Of Contents', 'vexaltrix' ),
	description: __( 'Add a table of contents to allow page navigation.', 'vexaltrix' ),
	icon: VXT_Block_Icons.table_of_contents,
	keywords: [ __( 'table of contents', 'vexaltrix' ), __( 'table', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	supports: {
		anchor: true,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) =>
		props.attributes.isPreview ? <PreviewImage image="table-of-content" /> : <Edit { ...props } />,
	// Render via PHP
	save: () => null,
	deprecated,
} );
