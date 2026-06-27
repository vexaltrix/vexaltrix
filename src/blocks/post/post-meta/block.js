/**
 * BLOCK: Post Meta
 */

// Import block dependencies and components
import { PostMeta } from './edit';
import save from './save';
import VXT_Block_Icons from '@Controls/block-icons';
// Components
import { __ } from '@wordpress/i18n';

// Register block controls

import { registerBlockType } from '@wordpress/blocks';

// Register the block
registerBlockType( 'vexaltrix/post-meta', {
	title: __( 'Post Meta', 'vexaltrix' ),
	description: __( 'Show your post meta details.', 'vexaltrix' ),
	icon: VXT_Block_Icons.post_grid,
	parent: [ 'vexaltrix/post-grid', 'vexaltrix/post-masonry', 'vexaltrix/post-carousel' ],
	keywords: [ __( 'post', 'vexaltrix' ), __( 'meta', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	PostMeta,
	save,
} );
