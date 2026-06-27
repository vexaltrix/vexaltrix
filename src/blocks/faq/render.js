/**
 * BLOCK: FAQ
 */

import classnames from 'classnames';
import { InnerBlocks } from '@wordpress/block-editor';
import { useLayoutEffect, memo, useMemo } from '@wordpress/element';

import styles from './editor.lazy.scss';
const ALLOWED_BLOCKS = [ 'vexaltrix/faq-child' ];

const faq = [];
const faqCount = 2;

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const { attributes, deviceType } = props;
	const { equalHeight, block_id } = attributes;

	const getFaqChildTemplate = useMemo( () => {
		const childFaq = [];

		for ( let i = 0; i < faqCount; i++ ) {
			childFaq.push( [ 'vexaltrix/faq-child', faq[ i ] ] );
		}

		return childFaq;
	}, [ faqCount, faq ] );

	const equalHeightClass = equalHeight ? 'vxt-faq-equal-height' : '';

	return (
		<div
			className={ classnames(
				'vxt-faq__outer-wrap',
				`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
				`vxt-block-${ block_id }`,
				`vxt-faq-icon-${ attributes.iconAlign }`,
				`vxt-faq-layout-${ attributes.layout }`,
				`vxt-faq-expand-first-${ attributes.expandFirstItem }`,
				`vxt-faq-inactive-other-${ attributes.inactiveOtherItems }`,
				equalHeightClass
			) }
			data-faqtoggle={ attributes.enableToggle }
			role="tablist"
		>
			<InnerBlocks
				template={ getFaqChildTemplate }
				templateLock={ false }
				allowedBlocks={ ALLOWED_BLOCKS }
				__experimentalMoverDirection={ 'vertical' }
			/>
		</div>
	);
};

export default memo( Render );
