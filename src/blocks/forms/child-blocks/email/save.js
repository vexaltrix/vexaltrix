/**
 * BLOCK: Forms - Email - Save Block
 */

import classnames from 'classnames';
import { RichText } from '@wordpress/block-editor';

export default function save( props ) {
	const { attributes } = props;

	const { block_id, name, required, placeholder, autocomplete } = attributes;

	const isRequired = required ? 'required' : '';

	return (
		<div className={ classnames( 'vxt-forms-email-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }>
			<RichText.Content
				tagName="div"
				value={ name }
				className={ `vxt-forms-email-label ${ isRequired } vxt-forms-input-label` }
				id={ block_id }
			/>
			<input
				type="email"
				className="vxt-forms-email-input vxt-forms-input"
				placeholder={ placeholder }
				required={ required }
				name={ block_id }
				autoComplete={ autocomplete }
			/>
		</div>
	);
}
