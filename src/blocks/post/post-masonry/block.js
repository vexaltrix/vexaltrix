/**
 * BLOCK: Vexaltrix - post-masonry
 */

// Import block dependencies and components
import Edit from './edit';
import { renderLegacyBlockEditorIcon } from '@Controls/block-icons';

//  Import CSS.
import '.././style.scss';

// Components
import { __ } from '@wordpress/i18n';

// Register block controls
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let postMasonryCommonData = {};
postMasonryCommonData = applyFilters(
	'vexaltrix/post-masonry',
	addCommonDataToVexaltrixBlocks( postMasonryCommonData )
);
if ( 'yes' === vxt_ultimate_gutenberg_blocks_blocks_info.enable_legacy_blocks ) {
	// Register the block
	registerBlockType( 'vexaltrix/post-masonry', {
		...postMasonryCommonData,
		title: __( 'Post Masonry', 'vexaltrix' ),
		description: __( 'Display your posts in a masonary layout.', 'vexaltrix' ),
		icon: renderLegacyBlockEditorIcon( 'post_masonry' ),
		keywords: [ __( 'post', 'vexaltrix' ), __( 'masonry', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
		category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
		edit: ( props ) =>
			props.attributes.isPreview ? <PreviewImage image="post-masonry" /> : <Edit { ...props } />,
		// Render via PHP
		save: () => null,
	} );
}
