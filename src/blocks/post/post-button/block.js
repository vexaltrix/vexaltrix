/**
 * BLOCK: Post Button
 */

// Import block dependencies and components
import { PostButton } from './edit';
import save from './save';
import VXT_Block_Icons from '@Controls/block-icons';

// Components
import { __ } from '@wordpress/i18n';

// Register block controls
import { registerBlockType } from '@wordpress/blocks';

// Register the block
registerBlockType( 'vexaltrix/post-button', {
	title: __( 'Post Button', 'vexaltrix' ),
	description: __( 'Customize this post button.', 'vexaltrix' ),
	icon: VXT_Block_Icons.post_grid,
	parent: [ 'vexaltrix/post-grid', 'vexaltrix/post-masonry', 'vexaltrix/post-carousel' ],
	keywords: [ __( 'post', 'vexaltrix' ), __( 'button', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	PostButton,
	save,
} );
