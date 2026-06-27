import classnames from 'classnames';
import { __ } from '@wordpress/i18n';
import { memo } from '@wordpress/element';
import { RichText } from '@wordpress/block-editor';

const Render = ( props ) => {
	const { attributes, setAttributes } = props;

	const { block_id, required, name, placeholder } = attributes;

	const isRequired = required ? 'required' : '';

	return (
		<>
			<div className={ classnames( 'vxt-forms-url-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }>
				<RichText
					tagName="div"
					placeholder={ __( 'URL Name', 'vexaltrix' ) }
					value={ name }
					onChange={ ( value ) => setAttributes( { name: value } ) }
					className={ `vxt-forms-url-label ${ isRequired } vxt-forms-input-label` }
					multiline={ false }
					id={ block_id }
				/>
				<input
					type="url"
					name={ block_id }
					placeholder={ placeholder }
					required={ required }
					className="vxt-forms-url-input vxt-forms-input"
				/>
			</div>
		</>
	);
};
export default memo( Render );
