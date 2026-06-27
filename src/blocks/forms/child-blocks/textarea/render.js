import classnames from 'classnames';
import { __ } from '@wordpress/i18n';
import { getFallbackNumber } from '@Controls/getAttributeFallback';
import { memo } from '@wordpress/element';
import { RichText } from '@wordpress/block-editor';

const Render = ( props ) => {
	const { attributes, setAttributes, name } = props;

	const blockName = name.replace( 'vexaltrix/', '' );

	const { block_id, textareaRequired, textareaName, rows, placeholder } = attributes;

	const isRequired = textareaRequired ? 'required' : '';

	return (
		<>
			<div
				className={ classnames( 'vxt-forms-textarea-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }
			>
				<RichText
					tagName="div"
					placeholder={ __( 'Textarea Name', 'vexaltrix' ) }
					value={ textareaName }
					onChange={ ( value ) => setAttributes( { textareaName: value } ) }
					className={ `vxt-forms-textarea-label ${ isRequired } vxt-forms-input-label` }
					multiline={ false }
					id={ block_id }
				/>
				<textarea
					required={ textareaRequired }
					className="vxt-forms-textarea-input vxt-forms-input"
					rows={ getFallbackNumber( rows, 'rows', blockName ) }
					placeholder={ placeholder }
					name={ block_id }
				></textarea>
			</div>
		</>
	);
};
export default memo( Render );
