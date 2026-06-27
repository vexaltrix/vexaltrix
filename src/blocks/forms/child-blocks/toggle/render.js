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

	const { block_id, toggleRequired, name, toggleStatus, layout, trueValue, falseValue } = attributes;

	const isRequired = toggleRequired ? 'required' : '';

	return (
		<>
			<div className={ classnames( 'vxt-forms-toggle-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }>
				<RichText
					tagName="div"
					placeholder={ __( 'Name', 'vexaltrix' ) }
					value={ name }
					onChange={ ( value ) => setAttributes( { name: value } ) }
					className={ `vxt-forms-toggle-label ${ isRequired } vxt-forms-input-label` }
					multiline={ false }
					id={ block_id }
				/>
				<label htmlFor={ block_id } className="vxt-switch">
					<input
						type="hidden"
						className="vxt-forms-toggle-input"
						checked={ toggleStatus }
						data-truestate={ trueValue }
						data-falsestate={ falseValue }
						value={ toggleStatus ? trueValue : falseValue }
						required={ toggleRequired }
						name={ block_id }
					/>
					<input
						type="checkbox"
						className="vxt-forms-toggle-input"
						readOnly
						checked={ toggleStatus }
						data-truestate={ trueValue }
						data-falsestate={ falseValue }
						value={ toggleStatus ? trueValue : falseValue }
						required={ toggleRequired }
						name={ block_id }
					/>
					<span className={ `vxt-slider ${ layout }` }></span>
				</label>
			</div>
		</>
	);
};
export default memo( Render );
