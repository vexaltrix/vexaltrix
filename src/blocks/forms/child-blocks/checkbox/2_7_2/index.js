/**
 * BLOCK: Forms - Checkbox - Deprecared
 */
import classnames from 'classnames';
import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';

const attributes = {
	isPreview: {
		type: 'boolean',
		default: false,
	},
	block_id: {
		type: 'string',
	},
	checkboxName: {
		type: 'string',
		default: __( 'Checkbox Title', 'vexaltrix' ),
	},
	checkboxRequired: {
		type: 'boolean',
		default: false,
	},
	options: {
		type: 'array',
		default: [
			{
				optiontitle: __( 'Option Name 1', 'vexaltrix' ),
				optionvalue: __( 'Option Value 1', 'vexaltrix' ),
			},
		],
	},
};

const deprecated = {
	attributes,
	save: ( props ) => {
		const {
			attributes: { block_id, checkboxRequired, options, checkboxName },
		} = props;

		const isRequired = checkboxRequired ? __( 'required', 'vexaltrix' ) : '';

		return (
			<div
				className={ classnames( 'vxt-forms-checkbox-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }
			>
				<RichText.Content
					tagName="div"
					value={ checkboxName }
					className={ `vxt-forms-checkbox-label ${ isRequired } vxt-forms-input-label` }
					id={ block_id }
				/>

				{ options.map( ( o, index ) => {
					const optionvalue = o.optionvalue;
					const value = optionvalue.replace( /\s+/g, '-' ).toLowerCase();
					return (
						<Fragment key={ index }>
							<input
								type="checkbox"
								className="vxt-forms-checkbox"
								id={ `checkbox-${ value }-${ block_id }` }
								name={ `${ checkboxName }[]` }
								value={ optionvalue }
								required={ checkboxRequired }
							/>
							<label htmlFor={ `checkbox-${ value }-${ block_id }` }>{ o.optiontitle }</label>
							<br />
						</Fragment>
					);
				} ) }
			</div>
		);
	},
};
export default deprecated;
