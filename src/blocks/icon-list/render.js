// Import classes
import classnames from 'classnames';
import { InnerBlocks } from '@wordpress/block-editor';
import { useLayoutEffect, memo, useMemo } from '@wordpress/element';
import styles from './editor.lazy.scss';

const ALLOWED_BLOCKS = [ 'vexaltrix/icon-list-child' ];

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const { attributes, deviceType } = props;

	const { className, icon_count, block_id } = attributes;

	const getIconTemplate = useMemo( () => {
		const childIconList = [];

		for ( let i = 0; i < icon_count; i++ ) {
			childIconList.push( [ 'vexaltrix/icon-list-child', { id: i + 1 } ] );
		}

		return childIconList;
	}, [ icon_count ] );

	return (
		<div
			className={ classnames(
				className,
				`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
				`vxt-block-${ block_id }`
			) }
		>
			<div className="vxt-icon-list__wrap">
				<InnerBlocks template={ getIconTemplate } templateLock={ false } allowedBlocks={ ALLOWED_BLOCKS } />
			</div>
		</div>
	);
};
export default memo( Render );
