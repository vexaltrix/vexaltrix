/**
 * BLOCK: Post Timeline Js.
 */
import VXT_Block_Icons from '@Controls/block-icons';
import '.././style.scss';
import Edit from './edit';

// Components.
import { __ } from '@wordpress/i18n';

// Register block controls.
import { registerBlockType } from '@wordpress/blocks';

export const name = 'core/latest-posts';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let postTimelineCommonData = {};
postTimelineCommonData = applyFilters(
	'vexaltrix/post-timeline',
	addCommonDataToVexaltrixBlocks( postTimelineCommonData )
);
// Register the block.
registerBlockType( 'vexaltrix/post-timeline', {
	...postTimelineCommonData,
	title: __( 'Post Timeline', 'vexaltrix' ),
	description: __( 'Create an attractive timeline to display your posts.', 'vexaltrix' ),
	icon: VXT_Block_Icons.post_timeline,
	keywords: [ __( 'post', 'vexaltrix' ), __( 'timeline', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="post-timeline" /> : <Edit { ...props } /> ),
	// Render via PHP
	save: () => null,
} );
