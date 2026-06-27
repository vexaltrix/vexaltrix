import classnames from 'classnames';

import { useDeviceType } from '@Controls/getPreviewType';
import { useEffect, useRef } from '@wordpress/element';
import { getFallbackNumber } from '@Controls/getAttributeFallback';
import Masonry from 'react-masonry-component';

import { InnerBlockLayoutContextProvider, renderPostLayout } from '.././function';

function Blog( props ) {
	const blockName = props.name.replace( 'vexaltrix/', '' );
	const article = useRef();
	const { attributes, className, latestPosts, block_id, setAttributes } = props;
	const deviceType = useDeviceType();
	const {
		columns,
		tcolumns,
		mcolumns,
		imgPosition,
		postsToShow,
		paginationEventType,
		buttonText,
		paginationType,
		layoutConfig,
		rowGap,
	} = attributes;

	const postsToShowFallback = getFallbackNumber( postsToShow, 'postsToShow', blockName );
	const columnsFallback = getFallbackNumber( columns, 'columns', blockName );
	const tcolumnsFallback = getFallbackNumber( tcolumns, 'tcolumns', blockName );
	const mcolumnsFallback = getFallbackNumber( mcolumns, 'mcolumns', blockName );
	const rowGapFallback = getFallbackNumber( rowGap, 'rowGap', blockName );
	const isImageEnabled =
		attributes.displayPostImage === true ? 'vxt-post__image-enabled' : 'vxt-post__image-disabled';

	const updateImageBgWidth = () => {
		setTimeout( () => {
			if ( article?.current ) {
				const articleWidth = article?.current?.offsetWidth;
				const imageWidth = 100 - ( rowGapFallback / articleWidth ) * 100;
				const parent = article?.current?.parentNode;

				if ( parent && parent.classList.contains( 'vxt-post__image-position-background' ) ) {
					const images = parent?.getElementsByClassName( 'vxt-post__image' );
					for ( const image of images ) {
						if ( image ) {
							image.style.width = imageWidth + '%';
							image.style.marginLeft = rowGapFallback / 2 + 'px';
						}
					}
				}
			}
		}, 100 );
	};

	useEffect( () => {
		updateImageBgWidth();
	}, [] );

	useEffect( () => {
		updateImageBgWidth();
	}, [ props ] );

	useEffect( () => {
		updateImageBgWidth();
	}, [ article ] );

	useEffect( () => {
		updateImageBgWidth();
	}, [ imgPosition ] );

	// Removing posts from display should be instant.
	const displayPosts =
		latestPosts.length > postsToShowFallback ? latestPosts.slice( 0, postsToShowFallback ) : latestPosts;

	const paginationRender = () => {
		if ( 'infinite' === paginationType ) {
			if ( 'scroll' === paginationEventType ) {
				return (
					<div className="vxt-post-inf-loader">
						<div className="vxt-post-loader-1"></div>
						<div className="vxt-post-loader-2"></div>
						<div className="vxt-post-loader-3"></div>
					</div>
				);
			}
			if ( 'button' === paginationEventType ) {
				return (
					<div className="vxt-post__load-more-wrap">
						<span className="vxt-post-pagination-button">
							<a className="vxt-post__load-more">{ buttonText }</a>
						</span>
					</div>
				);
			}
		}
	};

	return (
		<div
			className={ classnames(
				className,
				'vxt-post-grid',
				'vxt-post__arrow-outside',
				`vxt-post__image-position-${ imgPosition }`,
				`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
				`vxt-block-${ block_id }`
			) }
			data-blog-id={ block_id }
		>
			<Masonry
				className={ classnames(
					'is-masonry',
					`vxt-post__columns-${ columnsFallback }`,
					`vxt-post__columns-tablet-${ tcolumnsFallback }`,
					`vxt-post__columns-mobile-${ mcolumnsFallback }`,
					'vxt-post__items',
					className,
					isImageEnabled,
					'vxt-post-grid',
					'vxt-post__arrow-outside',
					`vxt-post__image-position-${ imgPosition }`,
					`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
					`vxt-block-${ block_id }`
				) }
				data-blog-id={ block_id }
			>
				<InnerBlockLayoutContextProvider parentName="vexaltrix/post-masonry" parentClassName="vxt-block-grid">
					{ displayPosts.map( ( post, i ) => (
						<article ref={ article } key={ i } className="vxt-post__inner-wrap">
							{ renderPostLayout(
								'vexaltrix/post-masonry',
								post,
								layoutConfig,
								props.attributes,
								props.categoriesList,
								setAttributes
							) }
						</article>
					) ) }
				</InnerBlockLayoutContextProvider>
			</Masonry>

			{ paginationRender() }
		</div>
	);
}

export default Blog;
