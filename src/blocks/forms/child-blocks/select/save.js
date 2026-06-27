/**
 * BLOCK: Forms - Select - Save Block
 */

import classnames from 'classnames';

import { __ } from '@wordpress/i18n';

import { RichText } from '@wordpress/block-editor';

export default function save( props ) {
	const { attributes } = props;

	const { block_id, selectRequired, options, selectName } = attributes;

	const isRequired = selectRequired ? 'required' : '';

	return (
		<div className={ classnames( 'vxt-forms-select-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }>
			<RichText.Content
				tagName="div"
				value={ selectName }
				className={ `vxt-forms-select-label ${ isRequired } vxt-forms-input-label` }
				id={ block_id }
			/>
			<select className="vxt-forms-select-box vxt-forms-input" required={ selectRequired } name={ block_id }>
				<option value="" disabled selected>
					{ __( 'Select your option', 'vexaltrix' ) }
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
}
