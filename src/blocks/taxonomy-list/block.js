/**
 * BLOCK: Vexaltrix - Taxonomy List
 */

// Import block dependencies and components
import VXT_Block_Icons from '@Controls/block-icons';

//  Import CSS.
import './style.scss';
import Edit from './edit';

// Components
import { __ } from '@wordpress/i18n';

// Register block controls
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let taxonomyListCommonData = {};
taxonomyListCommonData = applyFilters(
	'vexaltrix/taxonomy-list',
	addCommonDataToVexaltrixBlocks( taxonomyListCommonData )
);
// Register the block
registerBlockType( 'vexaltrix/taxonomy-list', {
	...taxonomyListCommonData,
	title: __( 'Taxonomy List', 'vexaltrix' ),
	description: __( 'Display your content categorized as per post type.', 'vexaltrix' ),
	icon: VXT_Block_Icons.taxonomy_list,
	keywords: [ __( 'post', 'vexaltrix' ), __( 'taxonomy', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="taxonomy-list" /> : <Edit { ...props } /> ),
	// Render via PHP
	save: () => null,
} );
