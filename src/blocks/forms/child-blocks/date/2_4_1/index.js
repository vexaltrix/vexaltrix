/**
 * BLOCK: Forms - Checkbox - Deprecared
 */
import classnames from 'classnames';

import { __ } from '@wordpress/i18n';

import { RichText } from '@wordpress/block-editor';

const attributes = {
	block_id: {
		type: 'string',
	},
	dateRequired: {
		type: 'boolean',
		default: false,
	},
	name: {
		type: 'string',
		default: __( 'Date', 'vexaltrix' ),
	},
	additonalVal: {
		type: 'boolean',
		default: false,
	},
	minYear: {
		type: 'string',
		default: '',
	},
	minMonth: {
		type: 'string',
		default: '',
	},
	minDay: {
		type: 'string',
		default: '',
	},
	maxYear: {
		type: 'string',
		default: '',
	},
	maxMonth: {
		type: 'string',
		default: '',
	},
	maxDay: {
		type: 'string',
		default: '',
	},
};

const deprecated = {
	attributes,
	save: ( props ) => {
		const {
			attributes: {
				block_id,
				dateRequired,
				name,
				additonalVal,
				minYear,
				minMonth,
				minDay,
				maxYear,
				maxMonth,
				maxDay,
				autocomplete,
			},
		} = props;

		let validation_min_value = '';
		let validation_max_value = '';

		if ( minYear && minMonth && minDay ) {
			validation_min_value = minYear + '-' + minMonth + '-' + minDay;
		}

		if ( maxYear && maxMonth && maxDay ) {
			validation_max_value = maxYear + '-' + maxMonth + '-' + maxDay;
		}

		let date_html = '';
		if ( additonalVal ) {
			date_html = (
				<input
					type="date"
					className="vxt-forms-date-input vxt-forms-input"
					required={ dateRequired }
					min={ validation_min_value }
					max={ validation_max_value }
					name={ block_id }
					autoComplete={ autocomplete }
				/>
			);
		} else {
			date_html = (
				<input
					type="date"
					className="vxt-forms-date-input vxt-forms-input"
					required={ dateRequired }
					name={ block_id }
					autoComplete={ autocomplete }
				/>
			);
		}
		const isRequired = dateRequired ? __( 'required', 'vexaltrix' ) : '';

		return (
			<div className={ classnames( 'vxt-forms-date-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }>
				<RichText.Content
					tagName="div"
					value={ name }
					className={ `vxt-forms-date-label ${ isRequired } vxt-forms-input-label` }
					id={ block_id }
				/>
				{ date_html }
			</div>
		);
	},
};
export default deprecated;
