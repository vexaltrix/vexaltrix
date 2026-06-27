import classnames from 'classnames';
import renderSVG from '@Controls/renderIcon';
import { RichText, InnerBlocks } from '@wordpress/block-editor';
import attributesV2_12_3 from './deprecated/v2_12_3/attributes';
import saveV2_12_3 from './deprecated/v2_12_3/save';

const deprecated = [
	{
		attributes: attributesV2_12_3,
		save: ( props ) => {
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
			} = props.attributes;

			const textHTML = (
				<RichText.Content value={ triggerText } tagName="span" className="vxt-modal-text vxt-modal-trigger" />
			);

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
					<a
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
					<div className={ classnames( `${ appearEffect }`, 'vxt-modal-popup', `vxt-block-${ block_id }` ) }>
						<div className="vxt-modal-popup-wrap">
							<div className="vxt-modal-popup-content">
								<InnerBlocks.Content />
							</div>
							{ ( 'popup-top-left' === closeIconPosition || 'popup-top-right' === closeIconPosition ) && (
								<div className="vxt-modal-popup-close">
									{ '' !== closeIcon && renderSVG( closeIcon ) }
								</div>
							) }
						</div>
					</div>
				</div>
			);
		},
	},
	{
		attributes: attributesV2_12_3,
		save: saveV2_12_3,
	},
];

export default deprecated;
