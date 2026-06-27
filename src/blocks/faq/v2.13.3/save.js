/**
 * BLOCK: FAQ - Save Block
 */

import classnames from 'classnames';

import { InnerBlocks } from '@wordpress/block-editor';

export default function save( props ) {
	const { className } = props;
	const { block_id, schema, enableSchemaSupport, equalHeight } = props.attributes;

	const renderSchema = () => {
		if ( true === enableSchemaSupport ) {
			return <script type="application/ld+json">{ schema }</script>;
		}

		return '';
	};

	const equalHeightClass = equalHeight ? 'vxt-faq-equal-height' : '';

	return (
		<div
			className={ classnames(
				className,
				'vxt-faq__outer-wrap',
				`vxt-block-${ block_id }`,
				`vxt-faq-icon-${ props.attributes.iconAlign }`,
				`vxt-faq-layout-${ props.attributes.layout }`,
				`vxt-faq-expand-first-${ props.attributes.expandFirstItem }`,
				`vxt-faq-inactive-other-${ props.attributes.inactiveOtherItems }`,
				'vxt-faq__wrap',
				'vxt-buttons-layout-wrap',
				equalHeightClass
			) }
			data-faqtoggle={ props.attributes.enableToggle }
			role="tablist"
		>
			{ renderSchema() }
			<InnerBlocks.Content />
		</div>
	);
}
