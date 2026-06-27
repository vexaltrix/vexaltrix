import classnames from 'classnames';
import renderSVG from '@Controls/renderIcon';
import { __ } from '@wordpress/i18n';
import styles from './editor.lazy.scss';
import { RichText } from '@wordpress/block-editor';
import { useLayoutEffect, memo } from '@wordpress/element';
const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const { attributes, setAttributes, state, isSelected } = props;
	const { question, answer, icon, iconActive, layout, headingTag, block_id } = attributes;

	// Reset the heading tag to it's default if it somehow has a value other than the valid tag types.
	const validHeadingTags = [ 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'span', 'p' ];
	const childHeadingTag = validHeadingTags.includes( headingTag ) ? headingTag : 'span';

	const faqRenderIcon = () => {
		return (
			<>
				<span className="vxt-icon vxt-faq-icon-wrap">{ renderSVG( icon, setAttributes ) }</span>
				<span className="vxt-icon-active vxt-faq-icon-wrap">{ renderSVG( iconActive, setAttributes ) }</span>
			</>
		);
	};

	const faqRenderHtml = () => {
		return (
			<>
				<div className="vxt-faq-questions-button vxt-faq-questions">
					{ 'accordion' === layout && faqRenderIcon() }
					<RichText
						tagName={ 'span' !== childHeadingTag ? childHeadingTag : 'div' }
						placeholder={ __( 'Question', 'vexaltrix' ) }
						value={ question }
						onChange={ ( value ) => setAttributes( { question: value } ) }
						className="vxt-question"
						multiline={ false }
						allowedFormats={ [ 'core/bold', 'core/italic', 'core/strikethrough' ] }
					/>
				</div>
				<RichText
					className="vxt-faq-content"
					tagName="p"
					placeholder={ __( 'Answer', 'vexaltrix' ) }
					value={ answer }
					onChange={ ( value ) => setAttributes( { answer: value } ) }
					multiline={ false }
					allowedFormats={ [ 'core/bold', 'core/italic', 'core/strikethrough', 'core/link' ] }
				/>
			</>
		);
	};

	return (
		<div
			className={ classnames(
				'vxt-faq-child__outer-wrap',
				'vxt-faq-item',
				`vxt-block-${ block_id }`,
				isSelected && false !== state.isFocused ? 'vxt-faq__active' : ''
			) }
			role="tab"
			tabIndex="0"
		>
			{ faqRenderHtml() }
		</div>
	);
};

export default memo( Render );
