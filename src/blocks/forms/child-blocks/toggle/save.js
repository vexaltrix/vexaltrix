/**
 * BLOCK: Forms - Toggle - Save Block
 */

import classnames from 'classnames';
import { RichText } from '@wordpress/block-editor';

export default function save( props ) {
	const { attributes } = props;

	const { block_id, toggleRequired, name, toggleStatus, layout, trueValue, falseValue } = attributes;

	const isRequired = toggleRequired ? 'required' : '';

	return (
		<div className={ classnames( 'vxt-forms-toggle-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }>
			<RichText.Content
				tagName="div"
				value={ name }
				className={ `vxt-forms-toggle-label ${ isRequired } vxt-forms-input-label` }
				id={ block_id }
			/>
			<label className="vxt-switch" id="uag-form">
				<input
					type="hidden"
					className="vxt-forms-toggle-input"
					checked={ toggleStatus }
					data-truestate={ trueValue }
					data-falsestate={ falseValue }
					value={ toggleStatus ? trueValue : falseValue }
					required={ toggleRequired }
					name={ block_id }
					aria-label={ name }
				/>
				<input
					type="checkbox"
					className="vxt-forms-toggle-input"
					checked={ toggleStatus }
					data-truestate={ trueValue }
					data-falsestate={ falseValue }
					value={ toggleStatus ? trueValue : falseValue }
					required={ toggleRequired }
					name={ block_id }
					aria-label={ name }
				/>
				<span className={ `vxt-slider ${ layout }` }></span>
			</label>
		</div>
	);
}
