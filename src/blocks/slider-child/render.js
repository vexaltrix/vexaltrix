import { useInnerBlocksProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { memo } from '@wordpress/element';

const Render = ( props ) => {
	const { slideIndex } = props;

	// Only parent blocks.
	const parentBlocks = wp.blocks.getBlockTypes().filter( function ( item ) {
		return ! item.parent;
	} );

	const TEMPLATE = [
		[
			'vexaltrix/container',
			{ variationSelected: true },
			[
				[
					'vexaltrix/info-box',
					{
						showIcon: false,
						ctaType: 'button',
						infoBoxTitle: __( 'Slide', 'vexaltrix' ) + parseInt( slideIndex + 1 ),
						showCtaIcon: false,
						paddingBtnTop: 12,
						paddingBtnRight: 24,
						paddingBtnBottom: 12,
						paddingBtnLeft: 24,
					},
				],
			],
		],
	];

	// Hide slider block.
	const ALLOWED_BLOCKS = parentBlocks
		.map( ( block ) => block.name )
		.filter(
			( blockName ) =>
				[ 'vexaltrix/slider', 'vexaltrix/post-carousel', 'vexaltrix/testimonial' ].indexOf( blockName ) === -1
		);

	const innerBlockOptions = {
		allowedBlocks: ALLOWED_BLOCKS,
		template: TEMPLATE,
	};

	const innerBlocksProps = useInnerBlocksProps(
		{
			className: `swiper-content`,
			slot: 'container-start',
		},
		innerBlockOptions
	);

	return <div { ...innerBlocksProps } />;
};

export default memo( Render );
