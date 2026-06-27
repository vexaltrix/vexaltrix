import { useBlockProps } from '@wordpress/block-editor';
import { applyFilters } from '@wordpress/hooks';

import CountdownBox from '../../components/CountdownBox';

export default function Save( props ) {
	const {
		attributes: { block_id, showLabels, labelDays, labelHours, labelMinutes, labelSeconds, timerEndAction },
		name,
	} = props;

	const blockProps = useBlockProps.save( {
		className: `vxt-block-${ block_id } wp-block-vxt-countdown`,
	} );

	const innerblocks_structure = 'not-installed' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status &&
		timerEndAction === 'content' && (
			<div className={ `vxt-block-countdown-innerblocks-${ block_id } wp-block-vxt-countdown-innerblocks` }>
				{ applyFilters( 'vexaltrix.countdown.save-innerblocks', '', name ) }
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
}
