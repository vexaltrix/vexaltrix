/**
 * BLOCK: Column - Editor Render.
 */

import classnames from 'classnames';
import { InnerBlocks } from '@wordpress/block-editor';
import { useLayoutEffect, memo } from '@wordpress/element';

import styles from './editor.lazy.scss';

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const {
		attributes: { align, backgroundType, alignMobile, alignTablet, block_id },
		isSelected,
		className,
		deviceType,
	} = props;

	const active = isSelected ? 'active' : 'not-active';

	const alignClass = 'center' === align ? '' : `vxt-column__align-${ align }`;
	const alignClassMobile = '' === alignMobile ? '' : `vxt-column__align-mobile-${ alignMobile }`;
	const alignClassTablet = '' === alignTablet ? '' : `vxt-column__align-tablet-${ alignTablet }`;

	return (
		<div
			className={ classnames(
				className,
				'vxt-column__wrap',
				`vxt-column__background-${ backgroundType }`,
				`vxt-column__edit-${ active }`,
				alignClass,
				alignClassMobile,
				alignClassTablet,
				`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
				`vxt-block-${ block_id }`
			) }
		>
			<div className="vxt-column__overlay"></div>
			<InnerBlocks templateLock={ false } />
		</div>
	);
};

export default memo( Render );
