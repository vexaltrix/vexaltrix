/**
 * BLOCK: Social Share - Save Block
 */

// Import block dependencies and components.
import classnames from 'classnames';
import renderSVG from '@Controls/renderIcon';
import links from './links';

export default function save( props ) {
	const { className } = props;

	const { type, image_icon, icon, image, block_id, parentSize, imgTagHeight } = props.attributes;

	const url = links[ type ];

	const defaultedAlt = image && image?.alt ? image?.alt : '';

	let imageIconHtml = '';

	if ( image_icon === 'icon' ) {
		if ( icon ) {
			imageIconHtml = <span className="vxt-ss__source-icon">{ renderSVG( icon ) }</span>;
		}
	} else if ( image && image.url ) {
		imageIconHtml = (
			<img
				className="vxt-ss__source-image"
				src={ image.url }
				alt={ defaultedAlt }
				width={ parentSize }
				height={ imgTagHeight }
				loading="lazy"
			/>
		);
	}
	return (
		<div className={ classnames( 'vxt-ss-repeater', 'vxt-ss__wrapper', className, `vxt-block-${ block_id }` ) }>
			<span className="vxt-ss__link" data-href={ url } tabIndex={ 0 } role="button" aria-label={ type }>
				<span className="vxt-ss__source-wrap">{ imageIconHtml }</span>
			</span>
		</div>
	);
}
