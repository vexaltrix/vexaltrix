/**
 * BLOCK: Forms - Email - Deprecared
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
		default: __( 'Email', 'vexaltrix' ),
	},
	required: {
		type: 'boolean',
		default: false,
	},
	placeholder: {
		type: 'string',
		default: __( 'example@mail.com', 'vexaltrix' ),
	},
};

const deprecated = {
	attributes,
	save( props ) {
		const { block_id, name, required, placeholder } = props.attributes;

		const isRequired = required ? __( 'required', 'vexaltrix' ) : '';

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
				/>
			</div>
		);
	},
};

export default deprecated;
