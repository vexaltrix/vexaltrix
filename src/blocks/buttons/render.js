import classnames from 'classnames';
import { useInnerBlocksProps } from '@wordpress/block-editor';
import { useLayoutEffect, useMemo, memo } from '@wordpress/element';

import styles from './editor.lazy.scss';

const AllowedBlocks = [ 'vexaltrix/buttons-child' ];

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const { attributes, deviceType } = props;
	const {
		className,
		btn_count,
		buttons,
		stack,
		buttonSize,
		buttonSizeTablet,
		buttonSizeMobile,
		block_id,
		inheritGap,
	} = attributes;

	const getButtonTemplate = useMemo( () => {
		const childButtons = [];

		for ( let i = 0; i < btn_count; i++ ) {
			childButtons.push( [ 'vexaltrix/buttons-child', buttons[ i ] ] );
		}

		return childButtons;
	}, [ btn_count, buttons ] );

	const moverDirection = 'desktop' === stack ? 'vertical' : 'horizontal';
	const innerBlockOptions = {
		template: getButtonTemplate,
		templateLock: false,
		allowedBlocks: AllowedBlocks,
		__experimentalMoverDirection: moverDirection,
	};

	const innerBlocksProps = useInnerBlocksProps(
		{
			className: inheritGap ? 'is-layout-flex' : '',
		},
		innerBlockOptions
	);

	return (
		<div
			className={ classnames(
				className,
				'vxt-buttons__outer-wrap',
				`vxt-btn__${ buttonSize }-btn`,
				`vxt-btn-tablet__${ buttonSizeTablet }-btn`,
				`vxt-btn-mobile__${ buttonSizeMobile }-btn`,
				`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
				`vxt-block-${ block_id }`
			) }
		>
			<div className={ classnames( 'vxt-buttons__wrap', `vxt-buttons-stack-${ stack }` ) }>
				<div className="block-editor-inner-blocks">
					<div { ...innerBlocksProps } />
				</div>
			</div>
		</div>
	);
};

export default memo( Render );
