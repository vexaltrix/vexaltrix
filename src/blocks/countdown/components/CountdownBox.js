import { uagbClassNames } from '@Utils/Helpers';

const CountdownBox = ( props ) => {
	return (
		<div
			className={ uagbClassNames( [
				'wp-block-vxt-countdown__box',
				'wp-block-vxt-countdown__box-' + props.unitType,
			] ) }
		>
			<div
				role={ props.role }
				aria-live={ props.ariaLiveType }
				className={ uagbClassNames( [
					'wp-block-vxt-countdown__time',
					'wp-block-vxt-countdown__time-' + props.unitType,
				] ) }
			>
				-
			</div>
			{ props.showLabels && <div className="wp-block-vxt-countdown__label">{ props.label }</div> }
		</div>
	);
};

export default CountdownBox;
