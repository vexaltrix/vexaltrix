import {
	DEFAULT_POST_LIST_LAYOUT,
	getBlockMap,
	getPostLayoutConfig,
	InnerBlockLayoutContextProvider,
} from '../function';

import { createBlock } from '@wordpress/blocks';
import { InnerBlocks } from '@wordpress/block-editor';
import { Placeholder, Button, Tip } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import { useLayoutEffect, memo } from '@wordpress/element';

import styles from '.././editor.lazy.scss';

import Blog from './blog';

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const { state, setState, togglePreview, categoriesList, latestPosts, replaceInnerBlocks, block } = props;

	const { attributes, deviceType, name, setAttributes, clientId, className } = props;

	const renderEditMode = () => {
		const onDone = () => {
			setAttributes( {
				layoutConfig: getPostLayoutConfig( block ),
			} );
			setState( { innerBlocks: block } );
			togglePreview();
		};

		const onCancel = () => {
			const { innerBlocks } = state;
			replaceInnerBlocks( clientId, innerBlocks );
			togglePreview();
		};

		const onReset = () => {
			const newBlocks = [];

			DEFAULT_POST_LIST_LAYOUT.map( ( [ name, attribute ] ) => {
				newBlocks.push( createBlock( name, attribute ) );
				return true;
			} );
			replaceInnerBlocks( clientId, newBlocks );
			setState( { innerBlocks: block } );
		};

		const InnerBlockProps = {
			template: props.attributes.layoutConfig,
			templateLock: false,
			allowedBlocks: Object.keys( getBlockMap( 'vexaltrix/post-masonry' ) ),
		};
		if ( props.attributes.layoutConfig.length !== 0 ) {
			InnerBlockProps.renderAppender = false;
		}
		return (
			<Placeholder label="Post Masonry Layout">
				<div className="vxt-post-grid vxt-block-all-post-grid-item-template">
					<Tip>
						{ __(
							'Edit the blocks inside the preview below to change the content displayed for each post within the post grid.',
							'vexaltrix'
						) }
					</Tip>
					<InnerBlockLayoutContextProvider
						parentName="vexaltrix/post-masonry"
						parentClassName="vxt-block-grid"
					>
						<article className="vxt-post__inner-wrap vxt-post__edit-mode">
							<div className="vxt-post__text">
								<InnerBlocks { ...InnerBlockProps } />
							</div>
						</article>
					</InnerBlockLayoutContextProvider>
					<div className="vxt-block-all-post__actions">
						<Button className="vxt-block-all-post__done-button" isPrimary onClick={ onDone }>
							{ __( 'Done', 'vexaltrix' ) }
						</Button>
						<Button className="vxt-block-all-post__cancel-button" isTertiary onClick={ onCancel }>
							{ __( 'Cancel', 'vexaltrix' ) }
						</Button>
						<Button className="vxt-block-all-post__reset-button" onClick={ onReset }>
							{ __( 'Reset Layout', 'vexaltrix' ) }
						</Button>
					</div>
				</div>
			</Placeholder>
		);
	};

	const renderViewMode = (
		<Blog
			attributes={ attributes }
			className={ className }
			latestPosts={ latestPosts }
			block_id={ attributes.block_id }
			categoriesList={ categoriesList }
			deviceType={ deviceType }
			name={ name }
			setAttributes={ setAttributes }
		/>
	);

	return <>{ state.isEditing ? renderEditMode() : renderViewMode }</>;
};

export default memo( Render );
