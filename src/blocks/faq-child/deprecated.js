/**
 * BLOCK: FAQ-Child - Deprecated Block
 */

import classnames from 'classnames';
import renderSVG from '@Controls/deprecatedRenderIcon';
import attributes from './attributes';
import { RichText } from '@wordpress/block-editor';
import savev2_11_2 from './v2.11.2/save';
import save2_13_3 from './v2.13.3/save';
import attributes2_13_3 from './v2.13.3/attributes';

const deprecated = [
	{
		attributes,
		save( props ) {
			const { className } = props;
			const { block_id, question, answer, icon, iconActive, layout } = props.attributes;

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
					<div className="vxt-faq-child__wrapper">
						<div className="vxt-faq-item">
							<div className="vxt-faq-questions-button vxt-faq-questions">
								{ 'accordion' === layout && faqRenderIcon() }
								<RichText.Content tagName="span" value={ question } className="vxt-question" />
							</div>
							<div className="vxt-faq-content">
								<span>
									<RichText.Content tagName="p" value={ answer } />
								</span>
							</div>
						</div>
					</div>
				);
			};
			return (
				<div className={ classnames( className, 'vxt-faq-child__outer-wrap', `vxt-block-${ block_id }` ) }>
					{ faqRenderAccordion() }
				</div>
			);
		},
	},
	{
		attributes,
		save( props ) {
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
					<div className="vxt-faq-child__wrapper">
						<div className="vxt-faq-item" role="tab" tabIndex="0">
							<div className="vxt-faq-questions-button vxt-faq-questions">
								{ 'accordion' === layout && faqRenderIcon() }
								<RichText.Content tagName={ headingTag } value={ question } className="vxt-question" />
							</div>
							<div className="vxt-faq-content">
								<span>
									<RichText.Content tagName="p" value={ answer } />
								</span>
							</div>
						</div>
					</div>
				);
			};
			return (
				<div className={ classnames( className, 'vxt-faq-child__outer-wrap', `vxt-block-${ block_id }` ) }>
					{ faqRenderAccordion() }
				</div>
			);
		},
	},
	{
		attributes,
		save: savev2_11_2,
	},
	{
		attributes: attributes2_13_3,
		save: save2_13_3,
	},
];

export default deprecated;
