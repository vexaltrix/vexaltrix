/**
 * BLOCK: Forms - Name - Deprecared
 */
import classnames from 'classnames';
import { __ } from '@wordpress/i18n';
import { RichText } from '@wordpress/block-editor';

const attributes = {
	isPreview: {
		type: 'boolean',
		default: false,
	},
	block_id: {
		type: 'string',
	},
	radioName: {
		type: 'string',
		default: __( 'RadioBox Title', 'vexaltrix' ),
	},
	radioRequired: {
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
	layout: {
		type: 'string',
		default: 'round',
	},
};

const deprecated = [
	{
		attributes,
		save( props ) {
			const { block_id, radioRequired, options, radioName } = props.attributes;

			const isRequired = radioRequired ? __( 'required', 'vexaltrix' ) : '';

			return (
				<div
					className={ classnames( 'vxt-forms-radio-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }
				>
					<RichText.Content
						tagName="div"
						value={ radioName }
						className={ `vxt-forms-radio-label ${ isRequired } vxt-forms-input-label` }
						id={ block_id }
					/>

					{ options.map( ( o ) => {
						const optionvalue = o.optionvalue;
						const value = optionvalue.replace( /\s+/g, '-' ).toLowerCase();
						return (
							<>
								<input
									type="radio"
									id={ `radio-${ value }-${ block_id }` }
									name={ block_id }
									value={ optionvalue }
									required={ radioRequired }
								/>
								<label htmlFor={ `radio-${ value }-${ block_id }` }>{ o.optiontitle }</label>
								<br />
							</>
						);
					} ) }
				</div>
			);
		},
	},
];

export default deprecated;
