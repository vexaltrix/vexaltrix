/**
 * BLOCK: Forms - URL - Save Block
 */

import classnames from 'classnames';
import { RichText } from '@wordpress/block-editor';
export default function save( props ) {
	const { attributes } = props;

	const { block_id, required, name, placeholder, autocomplete } = attributes;

	const isRequired = required ? 'required' : '';

	return (
		<div className={ classnames( 'vxt-forms-url-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }>
			<RichText.Content
				tagName="div"
				value={ name }
				className={ `vxt-forms-url-label ${ isRequired } vxt-forms-input-label` }
				id={ block_id }
			/>
			<input
				type="url"
				name={ block_id }
				required={ required }
				placeholder={ placeholder }
				className="vxt-forms-url-input vxt-forms-input"
				autoComplete={ autocomplete }
			/>
		</div>
	);
}
