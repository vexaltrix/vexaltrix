import renderSVG from '@Controls/renderIcon';
import { memo } from '@wordpress/element';
const Icon = ( props ) => {
	const { attributes } = props;

	return (
		<div className="vxt-timeline__marker vxt-timeline__out-view-icon vxt-timeline__icon-new">
			{ renderSVG( attributes.icon ) ? renderSVG( attributes.icon ) : <svg xmlns="" viewBox="0 0 256 512"></svg> }
		</div>
	);
};

export default memo( Icon );
