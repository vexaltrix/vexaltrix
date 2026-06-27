import classnames from 'classnames';
import renderSVG from '@Controls/renderIcon';
import { RichText, InnerBlocks } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';

export default function Save( props ) {
	const {
		block_id,
		modalTrigger,
		triggerText,
		icon,
		iconImage,
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
		inheritFromTheme,
		buttonType,
	} = props.attributes;

	const textHTML = (
		<RichText.Content value={ triggerText } tagName="span" className="vxt-modal-text vxt-modal-trigger" />
	);

	const isPro = vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status;

	const iconHTML = <div className="vxt-modal-trigger">{ '' !== icon && renderSVG( icon ) }</div>;

	const defaultedAlt = iconImage && iconImage?.alt ? iconImage?.alt : '';
	let imageIconHtml = '';

	if ( iconImage && iconImage.url ) {
		let url = iconImage.url;
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
		buttonIconOutput = renderSVG( buttonIcon );
	}

	const inheritAstraSecondary = inheritFromTheme && 'secondary' === buttonType;
	const buttonTypeClass = inheritAstraSecondary ? 'ast-outline-button' : 'wp-block-button__link';
	//border-width is added to revert the border related styles by default.
	const borderStyle = inheritAstraSecondary ? { borderWidth: 'revert-layer' } : {};

	const buttonClasses = `vxt-modal-button-link ${ buttonTypeClass } vxt-modal-trigger`;

	const buttonHTML = (
		<div className={ classnames( 'vxt-button-wrapper', 'wp-block-button' ) }>
			<a
				className={ buttonClasses }
				href={ '#' }
				onClick={ 'return false;' }
				target="_self"
				rel="noopener noreferrer"
				style={ borderStyle }
			>
				<span className="vxt-modal-content-wrapper">
					{ showBtnIcon && buttonIconPosition === 'before' && buttonIconOutput }
					<RichText.Content tagName="span" value={ buttonText } className="vxt-inline-editing" />
					{ showBtnIcon && buttonIconPosition === 'after' && buttonIconOutput }
				</span>
			</a>
		</div>
	);

	return (
		<div
			className={ classnames( `vxt-block-${ block_id }`, 'vxt-modal-wrapper' ) }
			data-escpress={ escPress ? 'enable' : 'disable' }
			data-overlayclick={ overlayClick ? 'enable' : 'disable' }
		>
			{ 'text' === modalTrigger && textHTML }
			{ 'icon' === modalTrigger && iconHTML }
			{ 'image' === modalTrigger && imageIconHtml }
			{ 'button' === modalTrigger && buttonHTML }
			<div
				className={ classnames( `${ appearEffect }`, 'vxt-modal-popup', `vxt-block-${ block_id }`, {
					[ `vxt-modal-type-${ openModalAs }` ]: isPro,
					[ `vxt-modal-position-${ modalPosition }` ]: isPro && 'popup' === openModalAs,
				} ) }
			>
				<div className="vxt-modal-popup-wrap">
					<div className="vxt-modal-popup-content">
						<InnerBlocks.Content />
					</div>
					{ ( 'popup-top-left' === closeIconPosition || 'popup-top-right' === closeIconPosition ) && (
						<button className="vxt-modal-popup-close" aria-label={ __( 'Close Modal', 'vexaltrix' ) }>
							{ '' !== closeIcon && renderSVG( closeIcon ) }
						</button>
					) }
				</div>
				{ isPro && ( 'window-top-left' === closeIconPosition || 'window-top-right' === closeIconPosition ) && (
					<button
						className={ classnames( 'vxt-modal-popup-close', closeIconPosition ) }
						aria-label={ __( 'Close Modal', 'vexaltrix' ) }
					>
						{ '' !== closeIcon && renderSVG( closeIcon ) }
					</button>
				) }
			</div>
		</div>
	);
}
