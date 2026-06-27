/**
 * BLOCK: Content timeline child - Save Block
 */

import classnames from 'classnames';
import renderSVG from '@Controls/renderIcon';

import { format } from '@wordpress/date';

import { RichText } from '@wordpress/block-editor';

export default function save( props ) {
	const { block_id, headingTag, displayPostDate, icon, t_date, dateFormat, time_heading, time_desc } =
		props.attributes;

	const displayInnerDate = true;
	let postDate = t_date;
	if ( 'custom' !== dateFormat ) {
		postDate = format( dateFormat, t_date );
		if ( format( dateFormat, postDate ) === 'Invalid date' ) {
			postDate = t_date;
		}
	}

	let contentClass = '';
	let dayalignClass = '';

	if ( props.attributes.dayalign_class !== 'undefined' && props.attributes.content_class !== 'undefined' ) {
		contentClass = props.attributes.content_class;
		dayalignClass = props.attributes.dayalign_class;
	}
	return (
		<article className={ classnames( 'vxt-timeline__field', `vxt-timeline-child-${ block_id }`, contentClass ) }>
			<div className={ classnames( 'vxt-timeline__marker out-view-vxt-timeline__icon' ) }>
				{ renderSVG( icon ) ? renderSVG( icon ) : <svg xmlns="" viewBox="0 0 256 512"></svg> }
			</div>

			<div className={ classnames( dayalignClass, 'vxt-timeline__events-inner-new' ) }>
				<div className="vxt-timeline__events-inner--content">
					{ displayPostDate !== true && t_date && (
						<div className={ 'vxt-timeline__date-hide vxt-timeline__inner-date-new' }>
							{ ( 'custom' !== dateFormat && format( dateFormat, postDate ) ) || postDate }
						</div>
					) }
					<RichText.Content tagName={ headingTag } value={ time_heading } className="vxt-timeline__heading" />

					<RichText.Content tagName="p" value={ time_desc } className="vxt-timeline-desc-content" />

					<div className="vxt-timeline__arrow"></div>
				</div>
			</div>
			{ displayInnerDate && (
				<div className="vxt-timeline__date-new">
					{ displayPostDate !== true && t_date && (
						<>{ ( 'custom' !== dateFormat && format( dateFormat, postDate ) ) || postDate }</>
					) }
				</div>
			) }
		</article>
	);
}
