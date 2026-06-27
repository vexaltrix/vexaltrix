/**
 * BLOCK: Forms - URL - Deprecared
 */
import classnames from 'classnames';
import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';

const attributes = {
	block_id: {
		type: 'string',
	},
	name: {
		type: 'string',
		default: __( 'URL', 'vexaltrix' ),
	},
	required: {
		type: 'boolean',
		default: false,
	},
	placeholder: {
		type: 'string',
		default: __( 'https://example.com', 'vexaltrix' ),
	},
};

const deprecated = [
	{
		attributes,
		save( props ) {
			const { block_id, required, name, placeholder } = props.attributes;

			const isRequired = required ? __( 'required', 'vexaltrix' ) : '';

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
					/>
				</div>
			);
		},
	},
];

export default deprecated;
