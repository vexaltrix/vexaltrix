/**
 * BLOCK: Forms - Date - Deprecared
 */

import classnames from 'classnames';
import { __ } from '@wordpress/i18n';
import attributes from './attributes';

const deprecated = [
	{
		attributes,
		save( props ) {
			const { block_id, hidden_field_value } = props.attributes;
			return (
				<div className={ classnames( 'vxt-forms-hidden-wrap', `vxt-block-${ block_id }` ) }>
					<input type="hidden" className="vxt-forms-hidden-input" value={ hidden_field_value } />
				</div>
			);
		},
	},
];

export default deprecated;
