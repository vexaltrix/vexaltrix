import { getFallbackNumber } from '@Controls/getAttributeFallback';
import { memo } from '@wordpress/element';
const Excerpt = ( props ) => {
	const { post, attributes } = props;
	const contentSpaceFallback = getFallbackNumber( attributes.contentSpace, 'contentSpace', 'post-timeline' );
	const exerptLengthFallback = getFallbackNumber( attributes.exerptLength, 'exerptLength', 'post-timeline' );
	let trimmed_excerpt;
	if ( attributes.displayPostExcerpt && post.vxt_ultimate_gutenberg_blocks_excerpt ) {
		trimmed_excerpt = post.vxt_ultimate_gutenberg_blocks_excerpt
			.split( /\s+/ )
			.slice( 0, exerptLengthFallback )
			.join( ' ' );

		let margin_var = '';
		if ( attributes.displayPostLink ) {
			margin_var = contentSpaceFallback + 'px';
		}
		return (
			<div
				className="vxt-timeline-desc-content"
				dangerouslySetInnerHTML={ { __html: trimmed_excerpt } }
				style={ {
					marginBottom: margin_var,
				} }
			/>
		);
	}
	return null;
};

export default memo( Excerpt );
