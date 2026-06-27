/**
 * Returns Dynamic Generated Classes
 */

function DayAlignClass( attributes, index_val, deviceType ) {
	let dayAlignClass = '';
	let device = deviceType;

	// For desktop, attribute name does not have `desktop` suffix to support backward compatibility.
	if ( 'Desktop' === deviceType ) {
		device = '';
	}

	const timelinAlignment =
		'undefined' !== typeof attributes[ 'timelinAlignment' + device ]
			? attributes[ 'timelinAlignment' + device ]
			: attributes.timelinAlignment;

	if ( 'left' === timelinAlignment ) {
		dayAlignClass = 'vxt-timeline__day-new vxt-timeline__day-left';
	} else if ( 'right' === timelinAlignment ) {
		dayAlignClass = 'vxt-timeline__day-new vxt-timeline__day-right';
	} else if ( 'center' === timelinAlignment ) {
		if ( index_val % 2 === 0 ) {
			dayAlignClass = 'vxt-timeline__day-new vxt-timeline__day-right';
		} else {
			dayAlignClass = 'vxt-timeline__day-new vxt-timeline__day-left';
		}
	}

	return [ dayAlignClass ];
}

export default DayAlignClass;
