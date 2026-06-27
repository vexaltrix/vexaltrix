/**
 * ADVANCED SETTINGS: Position - Sticky Position Settings.
 */

import { __ } from '@wordpress/i18n';
import { ToggleControl } from '@wordpress/components';
import MultiButtonsControl from '@Components/multi-buttons-control';
import Range from '@Components/range/Range.js';

const StickyPositionalSettings = ( props ) => {
	const {
		attributes: { UAGStickyLocation, UAGStickyRestricted, UAGStickyOffset, isBlockRootParent },
		setAttributes,
	} = props;

	return (
		<>
			<MultiButtonsControl
				setAttributes={ setAttributes }
				label={ __( 'Stick at', 'vexaltrix' ) }
				data={ {
					value: UAGStickyLocation,
					label: 'UAGStickyLocation',
				} }
				options={ [
					{
						value: 'top',
						label: __( 'Top', 'vexaltrix' ),
					},
					{
						value: 'bottom',
						label: __( 'Bottom', 'vexaltrix' ),
					},
				] }
			/>
			<Range
				label={ __( 'Offset', 'vexaltrix' ) }
				setAttributes={ setAttributes }
				value={ UAGStickyOffset }
				data={ {
					value: UAGStickyOffset,
					label: 'UAGStickyOffset',
				} }
				min={ 0 }
				max={ 500 }
				units={ [
					{
						name: __( 'Pixel', 'vexaltrix' ),
						unitValue: 'px',
					},
				] }
			/>
			{ 'top' === UAGStickyLocation && ! isBlockRootParent && (
				<ToggleControl
					label={ __( 'Keep Inside Parent', 'vexaltrix' ) }
					checked={ UAGStickyRestricted }
					onChange={ () => setAttributes( { UAGStickyRestricted: ! UAGStickyRestricted } ) }
				/>
			) }
		</>
	);
};

export default StickyPositionalSettings;
