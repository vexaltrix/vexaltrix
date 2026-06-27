/**
 * BLOCK: Forms - toggle - deprecated Block
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
	toggleRequired: {
		type: 'boolean',
		default: false,
	},
	name: {
		type: 'string',
		default: __( 'Toggle', 'vexaltrix' ),
	},
	toggleStatus: {
		type: 'boolean',
		default: false,
	},
	layout: {
		type: 'string',
		default: 'round',
	},
	trueValue: {
		type: 'string',
		default: 'on',
	},
	falseValue: {
		type: 'string',
		default: 'off',
	},
};

const deprecated = {
	attributes,
	save: ( props ) => {
		const {
			attributes: { block_id, toggleRequired, name, toggleStatus, layout, trueValue, falseValue },
		} = props;

		const isRequired = toggleRequired ? __( 'required', 'vexaltrix' ) : '';
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
	},
};

export default deprecated;
