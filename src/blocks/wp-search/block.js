/**
 * BLOCK: WP-Search
 */

import './style.scss';
import save from './save';
import Edit from './edit';
import attributes from './attributes';
import { renderLegacyBlockEditorIcon } from '@Controls/block-icons';
import deprecated from './deprecated';
import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let searchCommonData = {};
searchCommonData = applyFilters( 'vexaltrix/wp-search', addCommonDataToVexaltrixBlocks( searchCommonData ) );
if ( 'yes' === vxt_ultimate_gutenberg_blocks_blocks_info.enable_legacy_blocks ) {
	registerBlockType( 'vexaltrix/wp-search', {
		...searchCommonData,
		title: __( 'Search', 'vexaltrix' ),
		description: __( 'Add a search widget to let users search posts from your website.', 'vexaltrix' ),
		icon: renderLegacyBlockEditorIcon( 'wp_search' ),
		keywords: [ __( 'search', 'vexaltrix' ), __( 'wp', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
		supports: {
			anchor: true,
		},
		attributes,
		category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
		edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="wp-search" /> : <Edit { ...props } /> ),
		save,
		deprecated,
	} );
}
