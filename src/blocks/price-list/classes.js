/**
 * Returns Dynamic Generated Classes
 */

import { getFallbackNumber } from '@Controls/getAttributeFallback';
function PositionClasses( attributes, name = 'vexaltrix/restaurant-menu' ) {
	const { columns, tcolumns, mcolumns } = attributes;

	let iconimgStyleClass = '';
	let imgeCount = 0;
	const image = attributes.image;

	if ( typeof attributes.rest_menu_item_arr !== 'undefined' ) {
		attributes.rest_menu_item_arr.map( ( item ) => {
			const image_arr = item.image;
			if ( image_arr && typeof image_arr !== 'undefined' ) {
				imgeCount++;
			}
		} );
	}

	if ( typeof image !== 'undefined' && image !== null && image !== '' ) {
		imgeCount++;
	}

	if ( imgeCount > 0 ) {
		iconimgStyleClass += 'vxt-rm__image-position-' + attributes.imagePosition + ' ';
	}

	iconimgStyleClass += ' vxt-rm__align-' + attributes.headingAlign + ' ';

	if ( 'left' === attributes.imagePosition || 'right' === attributes.imagePosition ) {
		iconimgStyleClass += 'vxt-rm__image-aligned-' + attributes.imageAlignment + ' ';
		if ( attributes.stack !== 'none' ) {
			iconimgStyleClass += 'vxt-rm-stacked-' + attributes.stack + ' ';
			if ( attributes.imagePosition === 'right' ) {
				iconimgStyleClass += 'vxt-rm-reverse-order-' + attributes.stack + ' ';
			}
		}
	}
	const blockName = name.replace( 'vexaltrix/', '' );

	const columnsFallback = getFallbackNumber( columns, 'columns', blockName );
	const tcolumnsFallback = getFallbackNumber( tcolumns, 'tcolumns', blockName );
	const mcolumnsFallback = getFallbackNumber( mcolumns, 'mcolumns', blockName );

	iconimgStyleClass += 'vxt-rm__desk-column-' + columnsFallback + ' ';
	iconimgStyleClass += 'vxt-rm__tablet-column-' + tcolumnsFallback + ' ';
	iconimgStyleClass += 'vxt-rm__mobile-column-' + mcolumnsFallback + ' ';

	return [ iconimgStyleClass ];
}

export default PositionClasses;
