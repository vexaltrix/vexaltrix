const vxt_ultimate_gutenberg_blocks_deactivated_blocks =
	vxt_ultimate_gutenberg_blocks_deactivate_blocks.deactivated_blocks;
// If we are recieving an object, let's convert it into an array.
if ( vxt_ultimate_gutenberg_blocks_deactivated_blocks.length ) {
	if ( typeof wp.blocks.unregisterBlockType !== 'undefined' ) {
		for ( const block_index in vxt_ultimate_gutenberg_blocks_deactivated_blocks ) {
			const blockName = vxt_ultimate_gutenberg_blocks_deactivated_blocks[ block_index ];
			if ( 'vexaltrix/masonry-gallery' === blockName ) {
				continue;
			}

			// Check if the block is registered before attempting to unregister it
			if ( wp.blocks.getBlockType( blockName ) ) {
				wp.blocks.unregisterBlockType( blockName );
			}
		}
	}
}
