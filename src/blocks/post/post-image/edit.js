import { decodeEntities } from '@wordpress/html-entities';
import { __ } from '@wordpress/i18n';
import classnames from 'classnames';

export const PostImage = ( props ) => {
	const { post, attributes } = props;

	const target = attributes.newTab ? '_blank' : '_self';

	if (
		( attributes.displayPostImage &&
			undefined !== post.vxt_ultimate_gutenberg_blocks_featured_image_src &&
			attributes.imgSize &&
			post.vxt_ultimate_gutenberg_blocks_featured_image_src[ attributes.imgSize ] ) ||
		( attributes.displayPostImage === true && attributes.imgPosition === 'background' )
	) {
		const src = post.vxt_ultimate_gutenberg_blocks_featured_image_src[ attributes.imgSize ];

		return (
			<div className="vxt-post__image">
				{ post.vxt_ultimate_gutenberg_blocks_featured_image_src && src && src[ 0 ] && (
					<a
						href={ post.link }
						target={ target }
						rel="noopener noreferrer"
						className={ classnames(
							attributes.blockName === 'post-grid' ? `vxt-image-ratio-${ attributes.imageRatio }` : ''
						) }
					>
						<img
							src={ src[ 0 ] }
							alt={ decodeEntities( post.title.rendered.trim() ) || __( '(Untitled)', 'vexaltrix' ) }
						/>
					</a>
				) }
			</div>
		);
	}

	return null;
};
