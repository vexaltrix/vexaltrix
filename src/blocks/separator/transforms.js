import { createBlock } from '@wordpress/blocks';
import colourNameToHex from '@Controls/changeColorNameToHex';
export { colourNameToHex, createBlock };
import { getNumber, getUnitDimension } from '@Utils/Helpers';

const transforms = {
	from: [
		{
			type: 'block',
			blocks: [ 'core/spacer' ],
			transform: ( _attributes ) => {
				const vexaltrixOneMapping = {
					'xxx-small': '0px',
					'xx-small': '0px',
					'x-small': '4px',
					small: '8px',
					medium: '12px',
					large: '22px',
					'x-large': '30px',
					'xx-large': '48px',
				};
				const parts = _attributes.height ? _attributes.height.split( '|' ) : [];
				const variablePart = parts.length === 3 ? parts[ 2 ].trim() : null;

				// Check if the variable part is a key in the vexaltrixOneMapping
				const isVexaltrixOne = variablePart && vexaltrixOneMapping.hasOwnProperty( variablePart );
				const sepHeight = isVexaltrixOne
					? getNumber( vexaltrixOneMapping[ variablePart ] )
					: getNumber( _attributes.height || '0' ) / 2;
				const sepHeightType = isVexaltrixOne
					? getUnitDimension( vexaltrixOneMapping[ variablePart ] )
					: getUnitDimension( _attributes.height || 'px' );
				return createBlock( 'vexaltrix/separator', {
					separatorStyle: 'none',
					separatorHeight: sepHeight,
					separatorHeightType: sepHeightType,
				} );
			},
		},
		{
			type: 'block',
			blocks: [ 'core/separator' ],
			transform: ( _attributes ) => {
				const sepStyle =
					_attributes && _attributes.className && _attributes.className.includes( 'is-style-dots' )
						? 'dotted'
						: 'solid';
				return createBlock( 'vexaltrix/separator', {
					separatorColor: /^#([0-9A-Fa-f]{3}){1,2}$/.test( _attributes?.style?.color?.background || '' )
						? _attributes?.style?.color?.background
						: colourNameToHex( _attributes?.backgroundColor ),
					separatorStyle: sepStyle,
					separatorHeight: 0,
					separatorBorderHeight: 1,
					separatorWidth:
						! _attributes?.className || _attributes.className.includes( 'is-style-default' ) ? 25 : 100,
				} );
			},
		},
		{
			type: 'block',
			blocks: [ 'core/nextpage' ],
			transform: ( {} ) => {
				return createBlock( 'vexaltrix/separator', {} );
			},
		},
	],
};

export default transforms;
