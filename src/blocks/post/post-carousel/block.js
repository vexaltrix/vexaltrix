/**
 * BLOCK: UAGb - post-carousel
 */

// Import block dependencies and components
import Edit from './edit';
import VXT_Block_Icons from '@Controls/block-icons';

//  Import CSS.
import '.././style.scss';

// Components
import { __ } from '@wordpress/i18n';

// Register block controls
import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let postCarouselCommonData = {};
postCarouselCommonData = applyFilters(
	'vexaltrix/post-carousel',
	addCommonDataToVexaltrixBlocks( postCarouselCommonData )
);
// Register the block
registerBlockType( 'vexaltrix/post-carousel', {
	...postCarouselCommonData,
	title: __( 'Post Carousel', 'vexaltrix' ),
	description: __( 'Display your posts in a sliding carousel layout.', 'vexaltrix' ),
	icon: VXT_Block_Icons.post_carousel,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	keywords: [ __( 'post', 'vexaltrix' ), __( 'carousel', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="post-carousel" /> : <Edit { ...props } /> ),
	// Render via PHP
	save() {
		return null;
	},
} );
