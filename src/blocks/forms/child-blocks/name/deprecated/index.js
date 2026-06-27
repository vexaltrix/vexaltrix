/**
 * BLOCK: Forms - Name - Deprecared
 */
import classnames from 'classnames';
import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';

const attributes = {
	block_id: {
		type: 'string',
	},
	nameRequired: {
		type: 'boolean',
		default: false,
	},
	name: {
		type: 'string',
		default: __( 'Name', 'vexaltrix' ),
	},
	placeholder: {
		type: 'string',
		default: __( 'John Doe', 'vexaltrix' ),
	},
};

const deprecated = [
	{
		attributes,
		save( props ) {
			const { block_id, nameRequired, name, placeholder } = props.attributes;

			const isRequired = nameRequired ? __( 'required', 'vexaltrix' ) : '';

			return (
				<div
					className={ classnames( 'vxt-forms-name-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }
				>
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
					/>
				</div>
			);
		},
	},
];

export default deprecated;
