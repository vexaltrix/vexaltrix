import classnames from 'classnames';
import ContentTmClasses from '.././classes';
import { useMemo, useLayoutEffect, memo } from '@wordpress/element';
import { InnerBlocks } from '@wordpress/block-editor';
import styles from './editor.lazy.scss';

const ALLOWED_BLOCKS = [ 'vexaltrix/content-timeline-child' ];

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	// Setup the attributes.
	const {
		className,
		attributes: { tm_content, timelineItem, block_id },
		attributes,
		deviceType,
	} = props;

	const getContentTimelineTemplate = useMemo( () => {
		const childTimeline = [];

		for ( let i = 0; i < timelineItem; i++ ) {
			childTimeline.push( [ 'vexaltrix/content-timeline-child', tm_content[ i ] ] );
		}

		return childTimeline;
	}, [ timelineItem, tm_content ] );

	return (
		<div
			className={ classnames(
				className,
				'vxt-timeline__outer-wrap',
				`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
				`vxt-block-${ block_id }`,
				'vxt-timeline__content-wrap',
				...ContentTmClasses( attributes, deviceType )
			) }
		>
			<InnerBlocks
				template={ getContentTimelineTemplate }
				templateLock={ false }
				allowedBlocks={ ALLOWED_BLOCKS }
			/>
			<div className="vxt-timeline__line">
				<div className="vxt-timeline__line__inner"></div>
			</div>
		</div>
	);
};

export default memo( Render );
