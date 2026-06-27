/**
 * BLOCK: Section
 */

import { renderLegacyBlockEditorIcon } from '@Controls/block-icons';
import './style.scss';
import attributes from './attributes';
import Edit from './edit';
import save from './save';
import deprecated from './deprecated';
import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let sectionCommonData = {};
sectionCommonData = applyFilters( 'vexaltrix/section', addCommonDataToVexaltrixBlocks( sectionCommonData ) );
if ( 'yes' === vxt_ultimate_gutenberg_blocks_blocks_info.enable_legacy_blocks ) {
	registerBlockType( 'vexaltrix/section', {
		...sectionCommonData,
		title: __( 'Advanced Row', 'vexaltrix' ),
		description: __( 'Outer wrap section that allows you to add other blocks within it.', 'vexaltrix' ),
		icon: renderLegacyBlockEditorIcon( 'section' ),
		keywords: [ __( 'advanced row', 'vexaltrix' ), __( 'wrapper', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
		supports: {
			anchor: true,
			html: false,
		},
		attributes,
		category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
		edit: ( props ) =>
			props.attributes.isPreview ? <PreviewImage image="advanced-row" /> : <Edit { ...props } />,
		getEditWrapperProps( attribute ) {
			const { align, contentWidth } = attribute;
			if ( 'left' === align || 'right' === align || 'wide' === align || 'full' === align ) {
				if ( 'full_width' === contentWidth ) {
					return { 'data-align': align };
				}
			}
		},
		save,
		deprecated,
	} );
}
