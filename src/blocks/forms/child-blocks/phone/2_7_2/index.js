/**
 * BLOCK: Forms - Phone - Deprecared
 */
import classnames from 'classnames';
import countryOptions from '../country-option';
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
	phoneName: {
		type: 'string',
		default: __( 'Phone', 'vexaltrix' ),
	},
	phoneRequired: {
		type: 'boolean',
		default: false,
	},
	pattern: {
		type: 'string',
		default: __( '[0–9]{3}s?[0–9]{3}s?[0–9]{4}', 'vexaltrix' ),
	},
	selectPhoneCode: {
		type: 'string',
		default: '+44',
	},
	autocomplete: {
		type: 'string',
		default: 'tel-national',
	},
};

const deprecated = [
	{
		attributes,
		save( props ) {
			const {
				attributes: { block_id, phoneRequired, phoneName, pattern, selectPhoneCode, autocomplete },
			} = props;

			let placeholder = '';
			if ( pattern === '[0-9]{3}-?[0-9]{2}-?[0-9]{3}' ) {
				placeholder = __( '123–45–678', 'vexaltrix' );
			} else if ( pattern === '[0-9]{3}-?[0-9]{3}-?[0-9]{4}' ) {
				placeholder = __( '123–456–7890', 'vexaltrix' );
			} else if ( pattern === '[0-9]{3}s?[0-9]{3}s?[0-9]{4}' ) {
				placeholder = __( '123 456 7890', 'vexaltrix' );
			}

			let phone_html = '';
			if ( pattern !== '' ) {
				phone_html = (
					<input
						type="tel"
						placeholder={ placeholder }
						pattern={ pattern }
						required={ phoneRequired }
						className="vxt-forms-phone-input vxt-forms-input"
						name={ `${ phoneName }[]` }
						autoComplete={ autocomplete }
					/>
				);
			} else {
				phone_html = (
					<input
						type="tel"
						required={ phoneRequired }
						className="vxt-forms-phone-input vxt-forms-input"
						name={ `${ phoneName }[]` }
						autoComplete={ autocomplete }
					/>
				);
			}

			const isRequired = phoneRequired ? __( 'required', 'vexaltrix' ) : '';
			return (
				<div
					className={ classnames( 'vxt-forms-phone-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }
				>
					<RichText.Content
						tagName="div"
						value={ phoneName }
						className={ `vxt-forms-phone-label ${ isRequired } vxt-forms-input-label` }
						id={ block_id }
					/>

					<div className="vxt-forms-phone-flex">
						<select
							className="vxt-forms-input vxt-form-phone-country"
							id={ `vxt-form-country-${ block_id }` }
							name={ `${ phoneName }[]` }
						>
							{ countryOptions.map( ( o, index ) => (
								<option
									value={ o.props.value }
									key={ index }
									selected={ o.props.value === selectPhoneCode }
								>
									{ o.props.children }
								</option>
							) ) }
						</select>
						{ phone_html }
					</div>
				</div>
			);
		},
	},
];

export default deprecated;
