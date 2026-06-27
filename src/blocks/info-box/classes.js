/**
 * Returns Dynamic Generated Classes
 */

function InfoBoxPositionClasses( attributes ) {
	let sourceClass = 'vxt-infobox-has-image';
	if ( attributes.source_type === 'icon' ) {
		sourceClass = 'vxt-infobox-has-icon';
	}

	let iconimgStyleClass = '';

	iconimgStyleClass += 'vxt-infobox' + ' ';
	iconimgStyleClass += sourceClass + ' ';
	iconimgStyleClass += 'vxt-infobox-icon-' + attributes.iconimgPosition + ' ';

	if ( attributes.iconimgPosition === 'left' || attributes.iconimgPosition === 'left-title' ) {
		iconimgStyleClass += 'vxt-infobox-left' + ' ';
	}

	if ( attributes.iconimgPosition === 'right' || attributes.iconimgPosition === 'right-title' ) {
		iconimgStyleClass += 'vxt-infobox-right' + ' ';
	}

	if (
		( attributes.iconimgPosition === 'left' || attributes.iconimgPosition === 'right' ) &&
		attributes.stack !== 'none'
	) {
		iconimgStyleClass += 'vxt-infobox-stacked-' + attributes.stack + ' ';
		if ( attributes.iconimgPosition === 'right' ) {
			iconimgStyleClass += 'vxt-infobox-reverse-order-' + attributes.stack + ' ';
		}
	}

	if ( attributes.iconimgPosition !== 'above-title' || attributes.iconimgPosition !== 'below-title' ) {
		iconimgStyleClass += 'vxt-infobox-image-valign-' + attributes.sourceAlign + ' ';
	}

	if ( attributes.enableBorder ) {
		iconimgStyleClass += 'vxt-infobox-enable-border' + ' ';
	}

	iconimgStyleClass += 'vxt-infobox-enable-border-radius' + ' ';

	return [ iconimgStyleClass ];
}

export default InfoBoxPositionClasses;
