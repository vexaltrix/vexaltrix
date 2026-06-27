import { applyFilters } from '@wordpress/hooks';

function addCommonDataToVexaltrixBlocks( configData = {} ) {
	let data = {
		example: {
			attributes: {
				isPreview: true,
			},
		},
		usesContext: [ 'postId', 'postType' ],
	};

	if ( 'site-editor' === vxt_ultimate_gutenberg_blocks_blocks_info.is_site_editor ) {
		data = {};
	}
	return applyFilters( 'addCommonDataToVexaltrixBlocks', { ...configData, ...data } );
}

export default addCommonDataToVexaltrixBlocks;
