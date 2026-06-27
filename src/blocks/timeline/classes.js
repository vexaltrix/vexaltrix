/**
 * Returns Dynamic Generated Classes
 */

function ContentTmClasses( attributes, deviceType ) {
	/* Arrow position */
	let arrowAlignClass = 'vxt-timeline__arrow-top' + ' ';
	if ( attributes.arrowlinAlignment === 'center' ) {
		arrowAlignClass = 'vxt-timeline__arrow-center' + ' ';
	} else if ( attributes.arrowlinAlignment === 'bottom' ) {
		arrowAlignClass = 'vxt-timeline__arrow-bottom' + ' ';
	}

	let device = deviceType;

	// For desktop, attribute name does not have `desktop` suffix to support backward compatibility.
	if ( 'Desktop' === deviceType ) {
		device = '';
	}

	const timelinAlignment =
		'undefined' !== typeof attributes[ 'timelinAlignment' + device ]
			? attributes[ 'timelinAlignment' + device ]
			: attributes.timelinAlignment;

	/* Alignmnet */
	let alignClass = 'vxt-timeline__center-block ' + ' ';
	if ( timelinAlignment === 'left' ) {
		alignClass = 'vxt-timeline__left-block' + ' ';
	} else if ( timelinAlignment === 'right' ) {
		alignClass = 'vxt-timeline__right-block' + ' ';
	}
	alignClass += arrowAlignClass + '';
	alignClass += ' vxt-timeline';

	return [ alignClass ];
}

export default ContentTmClasses;
