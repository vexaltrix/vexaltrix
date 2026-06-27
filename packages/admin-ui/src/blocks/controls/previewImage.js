const PreviewImage = ( { image, isChildren = false } ) => {
	if ( ! image ) {
		console.error( __( 'Please add preview image.', 'vexaltrix' ) ); // eslint-disable-line
	}

	let imgUrl = vxt_ultimate_gutenberg_blocks_blocks_info.vxt_ultimate_gutenberg_blocks_url;
	imgUrl += '/assets/images/block-previews/';
	if ( isChildren ) {
		imgUrl += 'children/';
	}
	imgUrl += image + '.svg';
	return <img width="100%" src={ imgUrl } alt="" />;
};

export default PreviewImage;
