/**
 * Returns Dynamic Generated CSS
 */

import generateCSS from '@Controls/generateCSS';

function styling( attributes ) {
	const { icon_color, icon_hover_color, icon_bg_color, icon_bg_hover_color, block_id } = attributes;

	const selectors = {
		'.vxt-ss-repeater span.vxt-ss__link': {
			color: icon_color,
		},
		'.vxt-ss-repeater span.vxt-ss__link svg': {
			fill: icon_color,
		},
		'.vxt-ss-repeater:hover span.vxt-ss__link': {
			color: icon_hover_color,
		},
		'.vxt-ss-repeater:hover span.vxt-ss__link svg': {
			fill: icon_hover_color,
		},
		'.vxt-ss-repeater.vxt-ss__wrapper': {
			background: icon_bg_color,
		},
		'.vxt-ss-repeater.vxt-ss__wrapper:hover': {
			background: icon_bg_hover_color,
		},
	};

	let stylingCss = '';
	const id = `.vxt-block-${ block_id }`;

	stylingCss = generateCSS( selectors, id );

	return stylingCss;
}

export default styling;
