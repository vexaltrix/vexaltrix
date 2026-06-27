/**
 * BLOCK: Vexaltrix - post-grid
 */

// Import block dependencies and components
import Edit from './edit';
import VXT_Block_Icons from '@Controls/block-icons';

//  Import CSS.
import '.././style.scss';

import { __ } from '@wordpress/i18n';

// Register block controls
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let postGridCommonData = {};
postGridCommonData = applyFilters( 'vexaltrix/post-grid', addCommonDataToVexaltrixBlocks( postGridCommonData ) );
// Register the block
registerBlockType( 'vexaltrix/post-grid', {
	...postGridCommonData,
	title: __( 'Post Grid', 'vexaltrix' ),
	description: __( 'Display your posts in a structured grid-based layout.', 'vexaltrix' ),
	icon: VXT_Block_Icons.post_grid,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	keywords: [ __( 'post', 'vexaltrix' ), __( 'grid', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="post-grid" /> : <Edit { ...props } /> ),
	// Render via PHP
	save: () => null,
} );
