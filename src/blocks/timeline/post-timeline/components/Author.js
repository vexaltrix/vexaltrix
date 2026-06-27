import { memo } from '@wordpress/element';
const Author = ( props ) => {
	const { post, attributes } = props;

	let target = '_self';
	if ( attributes.linkTarget ) {
		target = '_blank';
	}
	return (
		<>
			{ attributes.displayPostAuthor && undefined !== post.vxt_ultimate_gutenberg_blocks_author_info && (
				<>
					<span className="dashicons-admin-users dashicons"></span>
					<a
						className="vxt-timeline__author-link"
						target={ target }
						href={ post.vxt_ultimate_gutenberg_blocks_author_info.author_link }
						rel="noopener noreferrer"
					>
						{ post.vxt_ultimate_gutenberg_blocks_author_info.display_name }
					</a>
				</>
			) }
		</>
	);
};

export default memo( Author );
