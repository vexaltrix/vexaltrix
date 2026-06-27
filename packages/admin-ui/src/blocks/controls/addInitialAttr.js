import { useEffect } from '@wordpress/element';
import { select } from '@wordpress/data';

const headingDescToggleDefault =
	'yes' === vxt_ultimate_gutenberg_blocks_blocks_info.vxt_ultimate_gutenberg_blocks_old_user_less_than_2;

const getUniqId = ( blocks ) =>
	blocks.reduce(
		( result, block ) => {
			if ( block?.attributes?.block_id && block.name.includes( 'uagb' ) ) {
				result.blockIds.push( block.attributes.block_id );
				result.clientIds.push( block.clientId );
			}

			if ( block.innerBlocks ) {
				const { blockIds, clientIds } = getUniqId( block.innerBlocks );
				result.blockIds = [ ...result.blockIds, ...blockIds ];
				result.clientIds = [ ...result.clientIds, ...clientIds ];
			}

			return result;
		},
		{ blockIds: [], clientIds: [] }
	);

const checkDuplicate = ( blockIds, block_id, currentIndex ) => {
	const getFiltered = blockIds.filter( ( el ) => el === block_id );
	return getFiltered.length > 1 && currentIndex === blockIds.lastIndexOf( block_id );
};

const addInitialAttr = ( ChildComponent ) => {
	const WrappedComponent = ( props ) => {
		const {
			name,
			setAttributes,
			clientId,
			attributes: { block_id },
		} = props;

		const listOfParentBlock = [
			'vexaltrix/faq',
			'vexaltrix/buttons',
			'vexaltrix/icon-list',
			'vexaltrix/restaurant-menu',
			'vexaltrix/social-share',
			'vexaltrix/content-timeline',
			'vexaltrix/tabs',
			'vexaltrix/how-to',
		]; // Add all parent block name here who's getting issue in customize preview.

		useEffect( () => {
			if (
				vxt_ultimate_gutenberg_blocks_blocks_info.is_customize_preview &&
				( '0' === block_id || undefined === block_id ) &&
				listOfParentBlock.includes( name )
			) {
				document.addEventListener(
					`UAG-${ name }-${ clientId.substr( 0, 8 ) }-BlockCustomizeWidgetEditor`,
					function ( e ) {
						setAttributes( {
							block_id: e.detail.id,
							classMigrate: e.detail.classMigrate,
							childMigrate: e.detail.childMigrate,
						} );
					}
				);
			}
		}, [] );

		useEffect( () => {
			if (
				vxt_ultimate_gutenberg_blocks_blocks_info.is_customize_preview &&
				( '0' === block_id || undefined === block_id ) &&
				listOfParentBlock.includes( name )
			) {
				const loadCustomEvent = new CustomEvent(
					`UAG-${ name }-${ clientId.substr( 0, 8 ) }-BlockCustomizeWidgetEditor`,
					{ detail: { id: clientId.substr( 0, 8 ), classMigrate: true, childMigrate: true } }
				);
				document.dispatchEvent( loadCustomEvent );
			}
		}, [ props.attributes ] );

		useEffect( () => {
			const listOfClassMigrate = [
				'vexaltrix/advanced-heading',
				'vexaltrix/blockquote',
				'vexaltrix/buttons',
				'vexaltrix/call-to-action',
				'vexaltrix/column',
				'vexaltrix/columns',
				'vexaltrix/icon-list',
				'vexaltrix/marketing-button',
				'vexaltrix/image-gallery',
				'vexaltrix/info-box',
				'vexaltrix/lottie',
				'vexaltrix/restaurant-menu',
				'vexaltrix/section',
				'vexaltrix/social-share',
				'vexaltrix/content-timeline',
				'vexaltrix/table-of-contents',
				'vexaltrix/team',
				'vexaltrix/testimonial',
				'vexaltrix/instagram-feed',
				'vexaltrix/login',
				'vexaltrix/register',
			];

			const listOfChildMigrate = [
				'vexaltrix/buttons',
				'vexaltrix/icon-list',
				'vexaltrix/restaurant-menu',
				'vexaltrix/social-share',
				'vexaltrix/content-timeline',
				'vexaltrix/instagram-feed',
			];

			const listOfIsHtml = [ 'vexaltrix/cf7-styler', 'vexaltrix/gf-styler' ];

			const listOfEditorInnerblocksPreview = [ 'vexaltrix/countdown' ];

			const listOfAllTaxonomyStore = [ 'vexaltrix/post-carousel', 'vexaltrix/post-grid', 'vexaltrix/post-masonry' ];

			const attributeObject = { block_id: clientId.substr( 0, 8 ) };

			if ( listOfAllTaxonomyStore.includes( name ) ) {
				attributeObject.allTaxonomyStore = undefined;
			}

			// editorInnerblocksPreview: This attribute is used to display innerblocks preview for 'Replace with Content' mode.
			if ( listOfEditorInnerblocksPreview.includes( name ) ) {
				attributeObject.editorInnerblocksPreview = false;
			}

			if ( listOfIsHtml.includes( name ) ) {
				attributeObject.isHtml = false;
			}

			if ( listOfChildMigrate.includes( name ) ) {
				attributeObject.childMigrate = true;
			}

			if ( listOfClassMigrate.includes( name ) ) {
				attributeObject.classMigrate = true;
			}

			if ( 'vexaltrix/advanced-heading' === name ) {
				attributeObject.headingDescToggle = headingDescToggleDefault;
			}

			const getStore = select( 'core/block-editor' );
			const getAllBlocks = getStore?.getBlocks ? getStore.getBlocks() : null;
			const { blockIds, clientIds } = getAllBlocks ? getUniqId( getAllBlocks ) : { blockIds: [], clientIds: [] };
			if (
				'not_set' === block_id ||
				'0' === block_id ||
				! block_id ||
				checkDuplicate( blockIds, block_id, clientIds.indexOf( clientId ) )
			) {
				setAttributes( attributeObject );
			}
		}, [ clientId ] );

		return <ChildComponent { ...props } />;
	};

	return WrappedComponent;
};
export default addInitialAttr;
