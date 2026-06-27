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

	const { block_id, nameRequired, name, placeholder } = attributes;

	const isRequired = nameRequired ? 'required' : '';

	return (
		<>
			<div className={ classnames( 'vxt-forms-name-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }>
				<RichText
					tagName="div"
					placeholder={ __( 'Name', 'vexaltrix' ) }
					value={ name }
					onChange={ ( value ) => setAttributes( { name: value } ) }
					className={ `vxt-forms-name-label ${ isRequired } vxt-forms-input-label` }
					multiline={ false }
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
		</>
	);
};
export default memo( Render );
