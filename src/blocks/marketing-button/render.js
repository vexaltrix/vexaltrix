import classnames from 'classnames';
import renderSVG from '@Controls/renderIcon';
import { useLayoutEffect, memo } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';
import styles from './editor.lazy.scss';

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const { attributes, setAttributes, className, mergeBlocks, insertBlocksAfter, createBlock, onReplace, deviceType } =
		props;

	const {
		block_id,
		align,
		textAlign,
		heading,
		prefix,
		icon,
		iconPosition,
		titleTag,
		showDescription,
		inheritFromTheme,
		buttonType,
	} = attributes;

	const inheritAstraSecondary = inheritFromTheme && 'secondary' === buttonType;
	const buttonTypeClass = inheritAstraSecondary ? 'ast-outline-button' : 'wp-block-button__link';
	//border-width is added to revert the border related styles by default.
	const borderStyle = inheritAstraSecondary ? { borderWidth: 'revert-layer' } : {};

	const marketingBtnClass = `vxt-marketing-btn__link ${ buttonTypeClass }`;

	const CustomTag = inheritAstraSecondary ? 'div' : 'a';

	const iconHTML = <>{ '' !== icon && renderSVG( icon, setAttributes ) }</>;
	const titleHTML = (
		<>
			<RichText
				placeholder={ __( 'Add Button Title…', 'vexaltrix' ) }
				value={ heading.replace( /<(?!br\s*V?)[^>]+>/g, '' ) }
				allowedFormats={ [] } // Removed the WP default link/bold/italic from the toolbar for button.
				tagName={ titleTag }
				onChange={ ( value ) => setAttributes( { heading: value } ) }
				className="vxt-marketing-btn__title"
				onRemove={ () => onReplace( [] ) }
				multiline={ false }
				onMerge={ mergeBlocks }
				onSplit={
					insertBlocksAfter
						? ( before, after, ...blocks ) => {
								setAttributes( {
									content: before,
								} );
								insertBlocksAfter( [
									...blocks,
									createBlock( 'core/paragraph', {
										content: after,
									} ),
								] );
						  }
						: undefined
				}
			/>
		</>
	);

	return (
		<div
			className={ classnames(
				className,
				`vxt-marketing-btn__align-${ align }`,
				`vxt-marketing-btn__align-text-${ textAlign }`,
				`vxt-marketing-btn__icon-${ iconPosition }`,
				`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
				`vxt-block-${ block_id }`,
				'wp-block-button'
			) }
		>
			<CustomTag className={ marketingBtnClass } style={ borderStyle }>
				{ 'before' === iconPosition && (
					<>
						{ iconHTML }
						{ titleHTML }
					</>
				) }
				{ 'after' === iconPosition && (
					<>
						{ titleHTML }
						{ iconHTML }
					</>
				) }
				{ showDescription && (
					<RichText
						placeholder={ __( 'Add Button Description…', 'vexaltrix' ) }
						value={ prefix }
						tagName="p"
						onChange={ ( value ) => setAttributes( { prefix: value } ) }
						className="vxt-marketing-btn__prefix"
						onRemove={ () => onReplace( [] ) }
						multiline={ false }
						onMerge={ mergeBlocks }
						onSplit={
							insertBlocksAfter
								? ( before, after, ...blocks ) => {
										setAttributes( {
											content: before,
										} );
										insertBlocksAfter( [
											...blocks,
											createBlock( 'core/paragraph', {
												content: after,
											} ),
										] );
								  }
								: undefined
						}
					/>
				) }
			</CustomTag>
		</div>
	);
};
export default memo( Render );
