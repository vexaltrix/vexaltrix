import { useLayoutEffect, memo } from '@wordpress/element';
import styles from './editor.lazy.scss';
import { useBlockProps } from '@wordpress/block-editor';
import { applyFilters } from '@wordpress/hooks';

import CountdownBox from './components/CountdownBox';

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const countdownRef = props.countdownRef;
	const {
		attributes: { block_id, name, showLabels, labelDays, labelHours, labelMinutes, labelSeconds, timerEndAction },
		deviceType,
	} = props;

	const blockProps = useBlockProps( {
		className: `vxt-block-${ block_id } vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
		ref: countdownRef,
	} );

	const innerblocks_structure = 'active' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status &&
		timerEndAction === 'content' && (
			<div className={ `vxt-block-countdown-innerblocks-${ block_id } wp-block-vxt-countdown-innerblocks` }>
				{ applyFilters( 'vexaltrix.countdown.render-innerblocks', '', name ) }
			</div>
		);

	return (
		<>
			<div { ...blockProps }>
				<CountdownBox unitType="days" showLabels={ showLabels } label={ labelDays } />
				<CountdownBox unitType="hours" showLabels={ showLabels } label={ labelHours } />
				<CountdownBox unitType="minutes" showLabels={ showLabels } label={ labelMinutes } />
				<CountdownBox unitType="seconds" showLabels={ showLabels } label={ labelSeconds } />
				{ innerblocks_structure }
			</div>
		</>
	);
};

export default memo( Render );
