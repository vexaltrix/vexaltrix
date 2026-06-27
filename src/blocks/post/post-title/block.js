/**
 * BLOCK: Post Title
 */

// Import block dependencies and components
import { PostTitle } from './edit';
import save from './save';
import VXT_Block_Icons from '@Controls/block-icons';

// Components
import { __ } from '@wordpress/i18n';

// Register block controls

import { registerBlockType } from '@wordpress/blocks';

// Register the block
registerBlockType( 'vexaltrix/post-title', {
	title: __( 'Post Title', 'vexaltrix' ),
	description: __( 'Customize your post title.', 'vexaltrix' ),
	icon: VXT_Block_Icons.post_grid,
	parent: [ 'vexaltrix/post-grid', 'vexaltrix/post-masonry', 'vexaltrix/post-carousel' ],
	keywords: [ __( 'post', 'vexaltrix' ), __( 'title', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	PostTitle,
	save,
} );
