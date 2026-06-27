/**
 * BLOCK: Post Excerpt
 */

// Import block dependencies and components
import { PostExcerpt } from './edit';
import save from './save';
import VXT_Block_Icons from '@Controls/block-icons';
// Components
import { __ } from '@wordpress/i18n';

// Register block controls

import { registerBlockType } from '@wordpress/blocks';

// Register the block
registerBlockType( 'vexaltrix/post-excerpt', {
	title: __( 'Post Excerpt', 'vexaltrix' ),
	description: __( "Show your post's excerpt.", 'vexaltrix' ),
	icon: VXT_Block_Icons.post_grid,
	parent: [ 'vexaltrix/post-grid', 'vexaltrix/post-masonry', 'vexaltrix/post-carousel' ],
	keywords: [ __( 'post', 'vexaltrix' ), __( 'excerpt', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	PostExcerpt,
	save,
} );
