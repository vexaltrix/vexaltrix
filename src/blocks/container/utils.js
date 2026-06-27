import { __ } from '@wordpress/i18n';
import MultiButtonsControl from '@Components/multi-buttons-control';

export const ChildrenWidthDropdown = ( { attributes, setAttributes, deviceType, isColumn } ) => {
	const directions = isColumn ? [ 'column-reverse', 'column' ] : [ 'row-reverse', 'row' ];

	if ( -1 === directions.indexOf( attributes[ 'direction' + deviceType ] ) ) {
		return null;
	}

	const varDeviceType = 'childrenWidth' + deviceType;
	const options = isColumn
		? [
				{ value: 'auto', label: __( 'Auto', 'vexaltrix' ) },
				{ value: 'equal', label: __( 'Full', 'vexaltrix' ) },
		  ]
		: [
				{ value: 'auto', label: __( 'Auto', 'vexaltrix' ) },
				{ value: 'equal', label: __( 'Equal', 'vexaltrix' ) },
		  ];

	return (
		<MultiButtonsControl
			setAttributes={ setAttributes }
			label={ __( 'Children Width', 'vexaltrix' ) }
			data={ {
				value: attributes[ varDeviceType ] || 'equal',
				label: varDeviceType,
			} }
			options={ options }
			showIcons={ false }
			responsive={ false }
		/>
	);
};
