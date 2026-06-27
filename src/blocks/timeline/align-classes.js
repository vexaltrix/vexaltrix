/**
 * Function name: AlignClass
 *
 * @param {Object[]} attributes settign array of attributes.
 * @param {number}   index_val  index values.
 * @param {string}   deviceType device type.
 */
function AlignClass( attributes, index_val, deviceType ) {
	let alignClass = '';
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
		alignClass = 'vxt-timeline__left';
	} else if ( 'right' === timelinAlignment ) {
		alignClass = 'vxt-timeline__right';
	} else if ( 'center' === timelinAlignment ) {
		if ( index_val % 2 === 0 ) {
			alignClass = 'vxt-timeline__right';
		} else {
			alignClass = 'vxt-timeline__left';
		}
	}

	return [ alignClass ];
}

export default AlignClass;
