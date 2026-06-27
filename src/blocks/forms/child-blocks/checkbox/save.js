/**
 * BLOCK: Forms - Checkbox - Save Block
 */

import classnames from 'classnames';
import { RichText } from '@wordpress/block-editor';
import { Fragment } from '@wordpress/element';

export default function save( props ) {
	const { attributes } = props;

	const { block_id, checkboxRequired, options, checkboxName } = attributes;

	const isRequired = checkboxRequired ? 'required' : '';

	return (
		<div className={ classnames( 'vxt-forms-checkbox-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }>
			<RichText.Content
				tagName="div"
				value={ checkboxName }
				className={ `vxt-forms-checkbox-label ${ isRequired } vxt-forms-input-label` }
				id={ block_id }
			/>

			{ options.map( ( o, index ) => {
				const optionvalue = o.optionvalue;
				const value = optionvalue.replace( /\s+/g, '-' ).toLowerCase();
				return (
					<Fragment key={ index }>
						<input
							type="checkbox"
							className="vxt-forms-checkbox"
							id={ `checkbox-${ value }-${ block_id }` }
							name={ `${ checkboxName }[]` }
							value={ optionvalue }
							required={ checkboxRequired }
						/>
						<label htmlFor={ `checkbox-${ value }-${ block_id }` }>{ o.optiontitle }</label>
						<br />
					</Fragment>
				);
			} ) }
		</div>
	);
}
