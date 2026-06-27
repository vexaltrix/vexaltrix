import classnames from 'classnames';
import countryOptions from './country-option';
import { useLayoutEffect, memo } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import styles from './editor.lazy.scss';

import { SelectControl } from '@wordpress/components';

import { RichText } from '@wordpress/block-editor';

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const { attributes, setAttributes } = props;

	const { block_id, phoneRequired, phoneName, pattern, selectPhoneCode, autocomplete } = attributes;

	useLayoutEffect( () => {
		// Handle backward case of wrong country code.
		if ( '+42' === selectPhoneCode ) {
			setAttributes( { selectPhoneCode: '+420' } );
		}
	}, [] );
	let phone_html = '';

	let placeholder = '';
	if ( pattern === '[0-9]{3}-?[0-9]{2}-?[0-9]{3}' ) {
		placeholder = __( '123–45–678', 'vexaltrix' );
	} else if ( pattern === '[0-9]{3}-?[0-9]{3}-?[0-9]{4}' ) {
		placeholder = __( '123–456–7890', 'vexaltrix' );
	} else if ( pattern === '[0-9]{3}s?[0-9]{3}s?[0-9]{4}' ) {
		placeholder = __( '123 456 7890', 'vexaltrix' );
	}

	if ( pattern !== '' ) {
		phone_html = (
			<input
				type="tel"
				placeholder={ placeholder }
				pattern={ pattern }
				required={ phoneRequired }
				className="vxt-forms-phone-input vxt-forms-input"
				name={ block_id }
				autoComplete={ autocomplete }
			/>
		);
	} else {
		phone_html = (
			<input
				type="tel"
				required={ phoneRequired }
				className="vxt-forms-phone-input vxt-forms-input"
				name={ block_id }
				autoComplete={ autocomplete }
			/>
		);
	}
	const contryCode = [];

	countryOptions.map( ( o, index ) => contryCode.push( { value: o.props.value, label: o.props.children } ) );

	const isRequired = phoneRequired ? 'required' : '';

	return (
		<>
			<div className={ classnames( 'vxt-forms-phone-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }>
				<RichText
					tagName="div"
					placeholder={ __( 'Phone Name', 'vexaltrix' ) }
					value={ phoneName }
					onChange={ ( value ) => setAttributes( { phoneName: value } ) }
					className={ `vxt-forms-phone-label ${ isRequired } vxt-forms-input-label` }
					multiline={ false }
					id={ block_id }
				/>
				<div className="vxt-forms-phone-flex">
					<SelectControl
						className={ 'vxt-forms-input vxt-form-phone-country vxt-form-phone-country-editor' }
						options={ contryCode }
						value={ selectPhoneCode }
						onChange={ ( value ) =>
							setAttributes( {
								selectPhoneCode: value,
							} )
						}
					/>
					{ phone_html }
				</div>
			</div>
		</>
	);
};
export default memo( Render );
