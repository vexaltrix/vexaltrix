/**
 * BLOCK: Modal - Save File - v2.12.3
 */

import classnames from 'classnames';
import renderSVG from '@Controls/renderIcon';
import { RichText, InnerBlocks } from '@wordpress/block-editor';

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

	const buttonClasses = 'vxt-modal-button-link wp-block-button__link vxt-modal-trigger';

	const buttonHTML = (
		<div className={ classnames( 'vxt-button-wrapper', 'wp-block-button' ) }>
			<a // eslint-disable-line jsx-a11y/anchor-is-valid
				className={ buttonClasses }
				href={ '#' }
				onClick={ 'return false;' }
				target="_self"
				rel="noopener noreferrer"
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
				{ isPro && ( 'window-top-left' === closeIconPosition || 'window-top-right' === closeIconPosition ) && (
					<div className={ classnames( 'vxt-modal-popup-close', closeIconPosition ) }>
						{ '' !== closeIcon && renderSVG( closeIcon ) }
					</div>
				) }
				<div className="vxt-modal-popup-wrap">
					<div className="vxt-modal-popup-content">
						<InnerBlocks.Content />
					</div>
					{ ( 'popup-top-left' === closeIconPosition || 'popup-top-right' === closeIconPosition ) && (
						<div className="vxt-modal-popup-close">{ '' !== closeIcon && renderSVG( closeIcon ) }</div>
					) }
				</div>
			</div>
		</div>
	);
}
