/**
 * BLOCK: Post Image
 */

// Import block dependencies and components
import { PostImage } from './edit';
import save from './save';
import VXT_Block_Icons from '@Controls/block-icons';
// Components
import { __ } from '@wordpress/i18n';

// Register block controls

import { registerBlockType } from '@wordpress/blocks';

// Register the block
registerBlockType( 'vexaltrix/post-image', {
	title: __( 'Post Image', 'vexaltrix' ),
	description: __( 'Customize your post image.', 'vexaltrix' ),
	icon: VXT_Block_Icons.post_grid,
	parent: [ 'vexaltrix/post-grid', 'vexaltrix/post-masonry', 'vexaltrix/post-carousel' ],
	keywords: [ __( 'post', 'vexaltrix' ), __( 'image', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	PostImage,
	save,
} );
