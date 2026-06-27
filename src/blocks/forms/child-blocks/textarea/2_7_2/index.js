/**
 * BLOCK: Forms - Textarea - Deprecared
 */
import classnames from 'classnames';
import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';
import { getFallbackNumber } from '@Controls/getAttributeFallback';

const attributes = {
	isPreview: {
		type: 'boolean',
		default: false,
	},
	block_id: {
		type: 'string',
	},
	textareaName: {
		type: 'string',
		default: __( 'Message', 'vexaltrix' ),
	},
	textareaRequired: {
		type: 'boolean',
		default: false,
	},
	rows: {
		type: 'number',
		default: 4,
	},
	placeholder: {
		type: 'string',
		default: __( 'Enter your message', 'vexaltrix' ),
	},
	autocomplete: {
		type: 'string',
		default: 'off',
	},
};

const deprecated = [
	{
		attributes,
		save( props ) {
			const blockName = 'forms-textarea';

			const {
				attributes: { block_id, textareaRequired, textareaName, rows, placeholder, autocomplete },
			} = props;

			const isRequired = textareaRequired ? __( 'required', 'vexaltrix' ) : '';

			return (
				<div
					className={ classnames(
						'vxt-forms-textarea-wrap',
						'vxt-forms-field-set',
						`vxt-block-${ block_id }`
					) }
				>
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
		},
	},
];

export default deprecated;
