/**
 * BLOCK: Forms - Textarea - Save Block
 */

import classnames from 'classnames';
import { RichText } from '@wordpress/block-editor';
import { getFallbackNumber } from '@Controls/getAttributeFallback';

export default function save( props ) {
	const blockName = 'forms-textarea';

	const { attributes } = props;

	const { block_id, textareaRequired, textareaName, rows, placeholder, autocomplete } = attributes;

	const isRequired = textareaRequired ? 'required' : '';

	return (
		<div className={ classnames( 'vxt-forms-textarea-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }>
			<RichText.Content
				tagName="div"
				value={ textareaName }
				className={ `vxt-forms-textarea-label ${ isRequired } vxt-forms-input-label` }
				id={ block_id }
			/>
			<textarea
				required={ textareaRequired }
				className="vxt-forms-textarea-input vxt-forms-input"
				rows={ getFallbackNumber( rows, 'rows', blockName ) }
				placeholder={ placeholder }
				name={ block_id }
				autoComplete={ autocomplete }
			></textarea>
		</div>
	);
}
