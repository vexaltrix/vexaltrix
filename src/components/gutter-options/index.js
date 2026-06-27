import { __ } from '@wordpress/i18n';

const gutterOptions = [
	{
		value: '0',
		label: __( 'None', 'vexaltrix' ),
		shortName: __( 'None', 'vexaltrix' ),
	},
	{
		value: '5',
		/* translators: abbreviation for small size */
		label: __( 'S', 'vexaltrix' ),
		tooltip: __( 'Small', 'vexaltrix' ),
	},
	{
		value: '10',
		/* translators: abbreviation for medium size */
		label: __( 'M', 'vexaltrix' ),
		tooltip: __( 'Medium', 'vexaltrix' ),
	},
	{
		value: '15',
		/* translators: abbreviation for large size */
		label: __( 'L', 'vexaltrix' ),
		tooltip: __( 'Large', 'vexaltrix' ),
	},
	{
		value: '20',
		/* translators: abbreviation for largest size */
		label: __( 'XL', 'vexaltrix' ),
		tooltip: __( 'Huge', 'vexaltrix' ),
	},
];

export default gutterOptions;
