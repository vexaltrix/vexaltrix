/**
 * BLOCK: Post Taxonomy
 */

// Import block dependencies and components
import { PostTaxonomy } from './edit';
import save from './save';
import VXT_Block_Icons from '@Controls/block-icons';
// Components
import { __ } from '@wordpress/i18n';

// Register block controls

import { registerBlockType } from '@wordpress/blocks';

// Register the block
registerBlockType( 'vexaltrix/post-taxonomy', {
	title: __( 'Post Taxonomy', 'vexaltrix' ),
	description: __( "Show your post's under categories.", 'vexaltrix' ),
	icon: VXT_Block_Icons.post_grid,
	parent: [ 'vexaltrix/post-grid', 'vexaltrix/post-masonry', 'vexaltrix/post-carousel' ],
	keywords: [ __( 'tags', 'vexaltrix' ), __( 'taxonomy', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	PostTaxonomy,
	save,
} );
