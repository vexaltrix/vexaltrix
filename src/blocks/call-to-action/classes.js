/**
 * Returns Dynamic Generated Classes
 */

function CtaPositionClasses( attributes ) {
	let iconimgStyleClass = '';

	iconimgStyleClass += 'vxt-cta__block' + ' ';
	iconimgStyleClass += 'vxt-cta__icon-position-' + attributes.ctaPosition + ' ';

	if ( attributes.ctaPosition === 'right' ) {
		iconimgStyleClass += 'vxt-cta__content-right' + ' ';
	}

	if ( attributes.ctaPosition === 'right' && attributes.stack !== 'none' ) {
		iconimgStyleClass += 'vxt-cta__content-stacked-' + attributes.stack + ' ';
	}

	if ( attributes.ctaPosition !== 'below-title' ) {
		iconimgStyleClass += 'vxt-cta__button-valign-' + attributes.buttonAlign + ' ';
	}

	if ( attributes.ctaType !== 'text' && attributes.ctaType !== 'button' ) {
		iconimgStyleClass += 'vxt-cta__button-type-none' + ' ';
	}

	return [ iconimgStyleClass ];
}

export default CtaPositionClasses;
