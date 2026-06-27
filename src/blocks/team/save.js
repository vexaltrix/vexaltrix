/**
 * BLOCK: Table of Contents - Save Block
 */

import classnames from 'classnames';
import renderSVG from '@Controls/renderIcon';
import { RichText } from '@wordpress/block-editor';

function social_html( icon, link, target ) {
	const target_value = target ? '_blank' : '_self';
	return (
		<li className="vxt-team__social-icon">
			<a href={ link } aria-label={ icon } target={ target_value } title="" rel="noopener noreferrer">
				{ renderSVG( icon ) }
			</a>
		</li>
	);
}

export default function save( props ) {
	const {
		block_id,
		align,
		tag,
		title,
		prefix,
		description_text,
		image,
		imgSize,
		imgStyle,
		imgPosition,
		twitterIcon,
		fbIcon,
		linkedinIcon,
		pinIcon,
		twitterLink,
		fbLink,
		linkedinLink,
		pinLink,
		socialTarget,
		socialEnable,
		stack,
		imgWidth,
	} = props.attributes;

	let size = '';
	let img_url = '';

	if ( image ) {
		size = image.sizes;
		if ( image.sizes ) {
			img_url = size[ imgSize ] ? size[ imgSize ].url : image.url;
		} else {
			img_url = image.url;
		}
	}

	let image_html = '';

	if ( '' !== img_url ) {
		image_html = (
			<img
				className={ `vxt-team__image-crop-${ imgStyle }` }
				src={ img_url }
				alt={ image.alt ? image.alt : '' }
				height={ imgWidth }
				width={ imgWidth }
				loading="lazy"
			/>
		);
	}

	return (
		<div
			className={ classnames(
				props.className,
				`vxt-team__image-position-${ imgPosition }`,
				`vxt-team__align-${ align }`,
				`vxt-team__stack-${ stack }`,
				`vxt-block-${ block_id }`
			) }
		>
			{ imgPosition === 'left' && image_html }

			<div className="vxt-team__content">
				{ imgPosition === 'above' && image_html }
				<RichText.Content tagName={ tag } value={ title } className="vxt-team__title" />
				<RichText.Content tagName="span" value={ prefix } className="vxt-team__prefix" />
				<RichText.Content tagName="p" value={ description_text } className="vxt-team__desc" />
				{ socialEnable && (
					<ul className="vxt-team__social-list">
						{ '' !== twitterIcon && social_html( twitterIcon, twitterLink, socialTarget ) }
						{ '' !== fbIcon && social_html( fbIcon, fbLink, socialTarget ) }
						{ '' !== linkedinIcon && social_html( linkedinIcon, linkedinLink, socialTarget ) }
						{ '' !== pinIcon && social_html( pinIcon, pinLink, socialTarget ) }
					</ul>
				) }
			</div>

			{ imgPosition === 'right' && image_html }
		</div>
	);
}
