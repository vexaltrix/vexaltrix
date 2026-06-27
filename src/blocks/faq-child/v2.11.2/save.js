/**
 * BLOCK: FAQ - Child - Save Block
 */

import classnames from 'classnames';
import renderSVG from '@Controls/renderIcon';
import { RichText } from '@wordpress/block-editor';

export default function save( props ) {
	const { className } = props;
	const { block_id, question, answer, icon, iconActive, layout, headingTag } = props.attributes;

	const faqRenderIcon = () => {
		return (
			<>
				<span className="vxt-icon vxt-faq-icon-wrap">{ renderSVG( icon ) }</span>
				<span className="vxt-icon-active vxt-faq-icon-wrap">{ renderSVG( iconActive ) }</span>
			</>
		);
	};
	const faqRenderAccordion = () => {
		return (
			<>
				<div className="vxt-faq-questions-button vxt-faq-questions">
					{ 'accordion' === layout && faqRenderIcon() }
					<RichText.Content tagName={ headingTag } value={ question } className="vxt-question" />
				</div>
				<RichText.Content className="vxt-faq-content" tagName="p" value={ answer } />
			</>
		);
	};
	return (
		<div
			className={ classnames(
				className,
				'vxt-faq-child__outer-wrap',
				'vxt-faq-item',
				`vxt-block-${ block_id }`
			) }
			role="tab"
			tabIndex="0"
		>
			{ faqRenderAccordion() }
		</div>
	);
}
