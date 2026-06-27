/**
 * BLOCK: Forms - Name - Save Block
 */

import classnames from 'classnames';
import { RichText } from '@wordpress/block-editor';

export default function save( props ) {
	const { attributes } = props;

	const { block_id, nameRequired, name, placeholder, autocomplete } = attributes;

	const isRequired = nameRequired ? 'required' : '';

	return (
		<div className={ classnames( 'vxt-forms-name-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }>
			<RichText.Content
				tagName="div"
				value={ name }
				className={ `vxt-forms-name-label ${ isRequired } vxt-forms-input-label` }
				id={ block_id }
			/>
			<input
				type="text"
				placeholder={ placeholder }
				required={ nameRequired }
				className="vxt-forms-name-input vxt-forms-input"
				name={ block_id }
				autoComplete={ autocomplete }
			/>
		</div>
	);
}
