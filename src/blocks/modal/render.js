import { useEffect, useLayoutEffect, memo } from '@wordpress/element';
import classnames from 'classnames';
import { __ } from '@wordpress/i18n';
import renderSVG from '@Controls/renderIcon';
import { RichText, InnerBlocks } from '@wordpress/block-editor';
import styles from './editor.lazy.scss';
import getImageHeightWidth from '@Controls/getImageHeightWidth';
import { useDispatch } from '@wordpress/data';
import { createBlocksFromInnerBlocksTemplate } from '@wordpress/blocks';
import { excludeBlocks, defaultContent } from './modalConfig';

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );
	const { attributes, setAttributes, clientId, deviceType } = props;

	const {
		block_id,
		triggerText,
		icon,
		iconImage,
		modalTrigger,
		imageSize,
		buttonText,
		buttonIcon,
		buttonIconPosition,
		appearEffect,
		closeIconPosition,
		escPress,
		overlayClick,
		closeIcon,
		imgTagWidth,
		imgTagHeight,
		showBtnIcon,
		openModalAs,
		modalPosition,
		defaultTemplate,
		inheritFromTheme,
		buttonType,
	} = attributes;

	const { replaceInnerBlocks } = useDispatch( 'core/block-editor' );
	const isPro = vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status;

	const inheritAstraSecondary = inheritFromTheme && 'secondary' === buttonType;
	const buttonTypeClass = inheritAstraSecondary ? 'ast-outline-button' : 'wp-block-button__link';
	//border-width is added to revert the border related styles by default.
	const borderStyle = inheritAstraSecondary ? { borderWidth: 'revert-layer' } : {};

	const ALLOWED_BLOCKS = wp.blocks
		.getBlockTypes()
		.map( ( block ) => block.name )
		.filter( ( blockName ) => ! excludeBlocks.includes( blockName ) );

	const TEMPLATE = [ [ 'core/paragraph', { placeholder: 'Type / to choose a block' } ] ];

	useEffect( () => {
		getImageHeightWidth( url, setAttributes );
	}, [ imageSize ] );

	useEffect( () => {
		if ( ! defaultTemplate ) {
			replaceInnerBlocks( clientId, createBlocksFromInnerBlocksTemplate( defaultContent ) );
			setAttributes( { defaultTemplate: true } );
		}
	}, [] );

	const textHTML = (
		<RichText
			tagName="span"
			placeholder={ __( 'Add Your Text Here', 'vexaltrix' ) }
			value={ triggerText }
			className="vxt-modal-text vxt-modal-trigger"
			onChange={ ( value ) => setAttributes( { triggerText: value } ) }
		/>
	);

	const iconHTML = <div className="vxt-modal-trigger">{ '' !== icon && renderSVG( icon, setAttributes ) }</div>;

	const defaultedAlt = iconImage?.alt ? iconImage.alt : '';
	let imageIconHtml = '';
	let url = '';

	if ( iconImage?.url ) {
		url = iconImage.url;
		const size = iconImage.sizes;
		const imageSizes = imageSize;

		if ( typeof size !== 'undefined' && typeof size[ imageSizes ] !== 'undefined' ) {
			url = size[ imageSizes ].url;
		}

		imageIconHtml = (
			<img
				src={ url }
				alt={ defaultedAlt }
				className="vxt-modal-trigger"
				width={ imgTagWidth }
				height={ imgTagHeight }
				loading="lazy"
			/>
		);
	}

	let buttonIconOutput = '';
	if ( buttonIcon !== '' ) {
		buttonIconOutput = renderSVG( buttonIcon, setAttributes );
	}

	const buttonClasses = `vxt-modal-button-link ${ buttonTypeClass } vxt-modal-trigger`;

	const buttonHTML = (
		<div className={ classnames( 'vxt-button-wrapper', 'wp-block-button' ) }>
			<div className={ buttonClasses } target="_self" rel="noopener noreferrer" style={ borderStyle }>
				<span className="vxt-modal-content-wrapper">
					{ showBtnIcon && buttonIconPosition === 'before' && buttonIconOutput }
					<RichText
						tagName="span"
						placeholder={ __( 'Click Here', 'vexaltrix' ) }
						value={ buttonText }
						className="vxt-inline-editing"
						onChange={ ( value ) => setAttributes( { buttonText: value } ) }
						allowedFormats={ [] } // Removed the WP default link/bold/italic from the toolbar for button.
					/>
					{ showBtnIcon && buttonIconPosition === 'after' && buttonIconOutput }
				</span>
			</div>
		</div>
	);

	return (
		<>
			<div
				className={ classnames(
					`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
					`vxt-block-${ block_id }`,
					'vxt-modal-wrapper'
				) }
				data-escpress={ escPress ? 'enable' : 'disable' }
				data-overlayclick={ overlayClick ? 'enable' : 'disable' }
			>
				<div className="vxt-editor-wrap">
					{ 'text' === modalTrigger && textHTML }
					{ 'icon' === modalTrigger && iconHTML }
					{ 'image' === modalTrigger && imageIconHtml }
					{ 'button' === modalTrigger && buttonHTML }
				</div>
				<div
					className={ classnames( `${ appearEffect }`, 'vxt-modal-popup', `vxt-block-${ block_id }`, {
						[ `vxt-modal-type-${ openModalAs }` ]: isPro,
						[ `vxt-modal-position-${ modalPosition }` ]: isPro && 'popup' === openModalAs,
					} ) }
				>
					<div className="vxt-modal-popup-wrap">
						<div className="vxt-modal-popup-content">
							<InnerBlocks
								template={ TEMPLATE }
								allowedBlocks={ ALLOWED_BLOCKS }
								renderAppender={ InnerBlocks.DefaultBlockAppender }
							/>
						</div>
						{ ( 'popup-top-left' === closeIconPosition || 'popup-top-right' === closeIconPosition ) && (
							<button className="vxt-modal-popup-close" aria-label={ __( 'Close Modal', 'vexaltrix' ) }>
								{ '' !== closeIcon && renderSVG( closeIcon, setAttributes ) }
							</button>
						) }
					</div>
					{ isPro &&
						( 'window-top-left' === closeIconPosition || 'window-top-right' === closeIconPosition ) && (
							<button
								className={ classnames( 'vxt-modal-popup-close', closeIconPosition ) }
								aria-label={ __( 'Close Modal', 'vexaltrix' ) }
							>
								{ '' !== closeIcon && renderSVG( closeIcon ) }
							</button>
						) }
				</div>
			</div>
		</>
	);
};
export default memo( Render );
