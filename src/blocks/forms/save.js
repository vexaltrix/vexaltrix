/**
 * BLOCK: Forms - Save Block
 */

import classnames from 'classnames';

import { InnerBlocks, RichText } from '@wordpress/block-editor';

export default function save( props ) {
	const { attributes } = props;

	const {
		block_id,
		formLabel,
		submitButtonText,
		confirmationType,
		confirmationMessage,
		failedMessage,
		reCaptchaEnable,
		reCaptchaType,
		buttonSize,
		variationSelected,
		inheritFromTheme,
		submitButtonType,
	} = attributes;

	const inheritAstraSecondary = inheritFromTheme && 'secondary' === submitButtonType;
	const buttonTypeClass = inheritAstraSecondary ? 'ast-outline-button' : 'wp-block-button__link';
	//border-width is added to revert the border related styles by default.
	const borderStyle = inheritAstraSecondary ? { borderWidth: 'revert-layer' } : {};

	const submitBtnClass = `vxt-forms-main-submit-button ${ buttonTypeClass }`;

	const renderButtonHtml = () => {
		return (
			<button className={ submitBtnClass } style={ borderStyle }>
				<RichText.Content
					tagName="div"
					value={ submitButtonText.replace( /<(?!br\s*V?)[^>]+>/g, '' ) }
					className="vxt-forms-main-submit-button-text"
				/>
			</button>
		);
	};

	if ( ! variationSelected ) {
		// If no preset selected then return.
		return;
	}
	return (
		<div
			className={ classnames(
				'vxt-forms__outer-wrap',
				`vxt-block-${ block_id }`,
				`vxt-forms__${ buttonSize }-btn`
			) }
		>
			<form className="vxt-forms-main-form" method="post" autoComplete="on" name={ `vxt-form-${ block_id }` }>
				<InnerBlocks.Content />
				<div className="vxt-forms-form-hidden-data">
					{ reCaptchaEnable && (
						<input type="hidden" id="g-recaptcha-response" className="vxt-forms-recaptcha" />
					) }
					<input
						type="hidden"
						className="vxt_ultimate_gutenberg_blocks_forms_form_label"
						value={ formLabel }
					/>
					<input
						type="hidden"
						className="vxt_ultimate_gutenberg_blocks_forms_form_id"
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
			{ confirmationType && (
				<>
					<div
						className={ classnames(
							`vxt-forms-success-message-${ block_id }`,
							'vxt-forms-submit-message-hide'
						) }
					>
						<span>{ confirmationMessage }</span>
					</div>
					<div
						className={ classnames(
							`vxt-forms-failed-message-${ block_id }`,
							'vxt-forms-submit-message-hide'
						) }
					>
						<span>{ failedMessage }</span>
					</div>
				</>
			) }
		</div>
	);
}
