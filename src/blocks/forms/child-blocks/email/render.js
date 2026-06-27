import classnames from 'classnames';
import { useLayoutEffect, memo } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import styles from './editor.lazy.scss';

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

	const { block_id, name, required, placeholder } = attributes;

	const isRequired = required ? 'required' : '';

	return (
		<>
			<div className={ classnames( 'vxt-forms-email-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }>
				<RichText
					tagName="div"
					placeholder={ __( 'Email', 'vexaltrix' ) }
					value={ name }
					onChange={ ( value ) => setAttributes( { name: value } ) }
					className={ `vxt-forms-email-label ${ isRequired } vxt-forms-input-label` }
					multiline={ false }
					id={ block_id }
				/>
				<input
					type="text"
					className="vxt-forms-email-input vxt-forms-input"
					placeholder={ placeholder }
					required={ required }
					name={ block_id }
				/>
			</div>
		</>
	);
};
export default memo( Render );
