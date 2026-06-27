import classnames from 'classnames';
import { memo, useCallback } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

const ALLOWED_BLOCKS = [
	'vexaltrix/forms-name',
	'vexaltrix/forms-email',
	'vexaltrix/forms-hidden',
	'vexaltrix/forms-phone',
	'vexaltrix/forms-textarea',
	'vexaltrix/forms-url',
	'vexaltrix/forms-select',
	'vexaltrix/forms-radio',
	'vexaltrix/forms-checkbox',
	'vexaltrix/forms-toggle',
	'vexaltrix/forms-date',
	'vexaltrix/forms-accept',
];

import { InnerBlocks, RichText } from '@wordpress/block-editor';

const Render = ( props ) => {
	const { attributes, setAttributes, deviceType } = props;
	const {
		block_id,
		submitButtonText,
		formLabel,
		buttonSize,
		reCaptchaEnable,
		reCaptchaType,
		submitButtonType,
		inheritFromTheme,
	} = attributes;

	const inheritAstraSecondary = inheritFromTheme && 'secondary' === submitButtonType;
	const buttonTypeClass = inheritAstraSecondary ? 'ast-outline-button' : 'wp-block-button__link';
	//border-width is added to revert the border related styles by default.
	const borderStyle = inheritAstraSecondary ? { borderWidth: 'revert-layer' } : {};

	const submitBtnClass = `vxt-forms-main-submit-button ${ buttonTypeClass }`;

	const CustomTag = inheritAstraSecondary ? 'div' : 'button';

	const onSubmitClick = useCallback( ( e ) => {
		e.preventDefault();
	} );

	const renderButtonHtml = () => {
		return (
			<CustomTag onClick={ onSubmitClick } className={ submitBtnClass } style={ borderStyle }>
				<RichText
					tagName="div"
					placeholder={ __( 'Submit', 'vexaltrix' ) }
					value={ submitButtonText.replace( /<(?!br\s*V?)[^>]+>/g, '' ) }
					onChange={ ( value ) =>
						setAttributes( {
							submitButtonText: value,
						} )
					}
					className="vxt-forms-main-submit-button-text"
					multiline={ false }
					allowedFormats={ [] } // Removed the WP default link/bold/italic from the toolbar for button.
				/>
			</CustomTag>
		);
	};

	return (
		<>
			<div
				className={ classnames(
					'vxt-forms__outer-wrap',
					`vxt-block-${ block_id }`,
					`vxt-forms__${ buttonSize }-btn`,
					`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`
				) }
			>
				<form className="vxt-forms-main-form" name={ `vxt-form-${ block_id }` }>
					<InnerBlocks allowedBlocks={ ALLOWED_BLOCKS } />
					<div className="vxt-forms-form-hidden-data">
						{ reCaptchaEnable && (
							<input type="hidden" id="g-recaptcha-response" className="vxt-forms-recaptcha" />
						) }
						<input
							type="hidden"
							name="vxt_ultimate_gutenberg_blocks_forms_form_label"
							value={ formLabel }
						/>
						<input
							type="hidden"
							name="vxt_ultimate_gutenberg_blocks_forms_form_id"
							value={ `vxt-form-${ block_id }` }
						/>
					</div>

					{ reCaptchaEnable && 'v2' === reCaptchaType && (
						<>
							<div className="g-recaptcha vxt-forms-field-set" data-sitekey=""></div>
						</>
					) }
					<div className={ `vxt-form-reacaptcha-error-${ block_id }` }></div>
					<div className="vxt-forms-main-submit-button-wrap wp-block-button">{ renderButtonHtml() }</div>
				</form>
			</div>
		</>
	);
};

export default memo( Render );
