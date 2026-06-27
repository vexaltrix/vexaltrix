import classnames from 'classnames';
import { useLayoutEffect, memo, useEffect } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import styles from './editor.lazy.scss';
import { RichText } from '@wordpress/block-editor';
import { createBlock } from '@wordpress/blocks';
import getImageHeightWidth from '@Controls/getImageHeightWidth';

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const { attributes, setAttributes, mergeBlocks, insertBlocksAfter, onReplace, deviceType } = props;

	const {
		block_id,
		name,
		description,
		url,
		urlType,
		image,
		imageSize,
		urlText,
		urlTarget,
		imgPosition,
		imgTagHeight,
		imgTagWidth,
	} = attributes;

	let urlCheck = '';
	if ( typeof image !== 'undefined' && image !== null && image !== '' ) {
		urlCheck = image.url;
	}

	let imageUrl = '';
	if ( urlCheck !== '' ) {
		const size = image.sizes;

		if ( typeof size !== 'undefined' && typeof size[ imageSize ] !== 'undefined' ) {
			imageUrl = size[ imageSize ].url;
		} else {
			imageUrl = urlCheck;
		}
	}
	let target = '_self';
	if ( urlTarget ) {
		target = '_blank';
	}

	useEffect( () => {
		getImageHeightWidth( imageUrl, setAttributes );
	}, [ imageUrl ] );

	const defaultedAlt = image?.alt || '';

	const imageMarkup = (
		<img
			className="vxt-how-to-step-image"
			src={ imageUrl }
			alt={ defaultedAlt }
			width={ imgTagWidth }
			height={ imgTagHeight }
			loading="lazy"
		/>
	);
	const contentMarkup = (
		<div className="vxt-step-content-wrap">
			<RichText
				tagName="div"
				className="vxt-how-to-step-name"
				placeholder={ __( 'Name', 'vexaltrix' ) }
				value={ name }
				onChange={ ( value ) => setAttributes( { name: value } ) }
				multiline={ false }
			/>
			<RichText
				tagName="p"
				value={ description }
				placeholder={ __( 'Write a Description', 'vexaltrix' ) }
				className="vxt-how-to-step-description"
				onChange={ ( value ) => setAttributes( { description: value } ) }
				onMerge={ mergeBlocks }
				onSplit={
					insertBlocksAfter
						? ( before, after, ...blocks ) => {
								setAttributes( { description: before } );
								insertBlocksAfter( [
									...blocks,
									createBlock( 'core/paragraph', {
										description: after,
									} ),
								] );
						  }
						: undefined
				}
				onRemove={ () => onReplace( [] ) }
			/>
			{ 'text' === urlType && (
				<>
					{ '' !== url ? (
						<a href={ url } target={ target } className="vxt-step-link" rel="noopener noreferrer">
							<span className="vxt-step-link-text">{ urlText }</span>
						</a>
					) : (
						<span className="vxt-step-link-text">{ urlText }</span>
					) }
				</>
			) }
		</div>
	);
	return (
		<div
			className={ classnames(
				'vxt-how-to-step-wrap',
				`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
				`vxt-block-${ block_id }`
			) }
		>
			{ ( 'all' === urlType || 'none' === urlType ) && (
				<>
					{ '' !== url && 'all' === urlType && (
						<a
							className="vxt-step-link"
							aria-label={ 'Step Link' }
							rel="noopener noreferrer"
							target={ target }
						></a>
					) }
					<div className={ `vxt-step-image-content-wrap uag-image-position-${ imgPosition }` }>
						{ imageUrl && imageMarkup }

						{ contentMarkup }
					</div>
				</>
			) }
			{ 'text' === urlType && (
				<div className={ `vxt-step-image-content-wrap uag-image-position-${ imgPosition }` }>
					{ imageUrl && imageMarkup }
					{ contentMarkup }
				</div>
			) }
		</div>
	);
};
export default memo( Render );
