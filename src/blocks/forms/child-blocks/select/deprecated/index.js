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
	selectName: {
		type: 'string',
		default: __( 'Select Title', 'vexaltrix' ),
	},
	selectRequired: {
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

const deprecated = [
	{
		attributes,
		save( props ) {
			const {
				attributes: { block_id, selectRequired, options, selectName },
			} = props;

			const isRequired = selectRequired ? __( 'required', 'vexaltrix' ) : '';

			return (
				<div
					className={ classnames(
						'vxt-forms-select-wrap',
						'vxt-forms-field-set',
						`vxt-block-${ block_id }`
					) }
				>
					<RichText.Content
						tagName="div"
						value={ selectName }
						className={ `vxt-forms-select-label ${ isRequired } vxt-forms-input-label` }
						id={ block_id }
					/>
					<select
						className="vxt-forms-select-box vxt-forms-input"
						required={ selectRequired }
						name={ block_id }
					>
						<option value="" disabled selected>
							Select your option
						</option>
						{ options.map( ( o, index ) => {
							return (
								<option key={ index } value={ o.optionvalue }>
									{ o.optiontitle }
								</option>
							);
						} ) }
					</select>
				</div>
			);
		},
	},
];

export default deprecated;
