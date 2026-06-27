import classnames from 'classnames';
import './style.scss';
import { __ } from '@wordpress/i18n';
import { createBlock } from '@wordpress/blocks';
import { RichText, InnerBlocks } from '@wordpress/block-editor';
import { useLayoutEffect, memo, useEffect } from '@wordpress/element';
import styles from './editor.lazy.scss';
import { getFallbackNumber } from '@Controls/getAttributeFallback';
import getImageHeightWidth from '@Controls/getImageHeightWidth';

var ALLOWED_BLOCKS = [ 'vexaltrix/how-to-step' ]; // eslint-disable-line no-var

if ( 'yes' === vxt_ultimate_gutenberg_blocks_blocks_info.vxt_ultimate_gutenberg_blocks_old_user_less_than_2 ) {
	ALLOWED_BLOCKS = [ 'vexaltrix/info-box', 'vexaltrix/how-to-step' ];
}

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	// Setup the attributes
	const {
		className,
		attributes,
		setAttributes,
		insertBlocksAfter,
		mergeBlocks,
		onReplace,
		attributes: {
			currencyType,
			showEstcost,
			showTotaltime,
			showMaterials,
			showTools,
			toolsTitle,
			materialTitle,
			stepsTitle,
			tools,
			materials,
			timeNeeded,
			estCost,
			mainimage,
			headingTitle,
			headingDesc,
			headingTag,
			time,
			cost,
			timeInMins,
			timeInHours,
			timeInDays,
			timeInMonths,
			timeInYears,
			imgTagHeight,
			imgTagWidth,
			block_id,
		},
		deviceType,
		name,
	} = props;

	const blockName = name.replace( 'vexaltrix/', '' );

	const splitBlock = ( before, after, ...blocks ) => {
		if ( after ) {
			// Append "After" content as a new paragraph block to the end of
			// any other blocks being inserted after the current paragraph.
			blocks.push( createBlock( 'core/paragraph', { content: after } ) );
		}

		if ( blocks.length && insertBlocksAfter ) {
			insertBlocksAfter( blocks );
		}

		const { content } = attributes;
		if ( ! before ) {
			// If before content is omitted, treat as intent to delete block.
			onReplace( [] );
		} else if ( content !== before ) {
			// Only update content if it has in-fact changed. In case that user
			// has created a new paragraph at end of an existing one, the value
			// of before will be strictly equal to the current content.
			setAttributes( { content: before } );
		}
	};

	const saveMaterials = ( value, index ) => {
		const newItems = materials.map( ( item, thisIndex ) => {
			if ( index === thisIndex ) {
				item = { ...item, ...value };
			}

			return item;
		} );

		setAttributes( {
			materials: newItems,
		} );
	};

	const saveTools = ( value, index ) => {
		const newItems = tools.map( ( item, thisIndex ) => {
			if ( index === thisIndex ) {
				item = { ...item, ...value };
			}

			return item;
		} );

		setAttributes( {
			tools: newItems,
		} );
	};

	let urlChk = '';
	let title = '';
	let url = '';
	if ( 'undefined' !== typeof attributes.mainimage && null !== attributes.mainimage && '' !== attributes.mainimage ) {
		urlChk = attributes.mainimage.url;
		title = attributes.mainimage.title;
	}

	if ( '' !== urlChk ) {
		const size = attributes.mainimage.sizes;
		const imageSize = attributes.imgSize;

		if ( 'undefined' !== typeof size && 'undefined' !== typeof size[ imageSize ] ) {
			url = size[ imageSize ].url;
		} else {
			url = urlChk;
		}
	}

	const defaultedAlt = mainimage && mainimage?.alt ? mainimage?.alt : '';

	let imageIconHtml = '';

	useEffect( () => {
		getImageHeightWidth( url, setAttributes );
	}, [ url ] );

	if ( mainimage && mainimage.url ) {
		imageIconHtml = (
			<img
				className="vxt-howto__source-image"
				src={ url }
				title={ title }
				width={ imgTagWidth }
				height={ imgTagHeight }
				loading="lazy"
				alt={ defaultedAlt }
			/>
		);
	}

	const minsValue = getFallbackNumber( timeInMins, 'timeInMins', blockName )
		? getFallbackNumber( timeInMins, 'timeInMins', blockName )
		: time;

	const getStepAsChild = [
		[
			'vexaltrix/how-to-step',
			{
				name: 'Step 1',
				description: __(
					'Click here to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
					'vexaltrix'
				),
			},
		],
		[
			'vexaltrix/how-to-step',
			{
				name: 'Step 2',
				description: __(
					'Click here to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
					'vexaltrix'
				),
			},
		],
		[
			'vexaltrix/how-to-step',
			{
				name: 'Step 3',
				description: __(
					'Click here to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
					'vexaltrix'
				),
			},
		],
	];

	//Time Labels
	const yearLabel =
		getFallbackNumber( timeInYears, 'timeInYears', blockName ) > 1
			? __( 'Years', 'vexaltrix' )
			: __( 'Year', 'vexaltrix' );
	const monthLabel =
		getFallbackNumber( timeInMonths, 'timeInMonths', blockName ) > 1
			? __( 'Months', 'vexaltrix' )
			: __( 'Month', 'vexaltrix' );
	const dayLabel =
		getFallbackNumber( timeInDays, 'timeInDays', blockName ) > 1
			? __( 'Days', 'vexaltrix' )
			: __( 'Day', 'vexaltrix' );
	const hourLabel =
		getFallbackNumber( timeInHours, 'timeInHours', blockName ) > 1
			? __( 'Hours', 'vexaltrix' )
			: __( 'Hour', 'vexaltrix' );
	const minsLabel = minsValue > 1 ? __( 'Minutes', 'vexaltrix' ) : __( 'Minute', 'vexaltrix' );

	return (
		<div
			className={ classnames(
				className,
				`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
				`vxt-block-${ block_id }`,
				'vxt-how-to-main-wrap'
			) }
		>
			<RichText
				tagName={ headingTag }
				placeholder={ __( 'How to configure HowTo Schema in UAG?', 'vexaltrix' ) }
				value={ headingTitle }
				className="vxt-howto-heading-text"
				multiline={ false }
				onChange={ ( value ) => {
					setAttributes( { headingTitle: value } );
				} }
				onMerge={ mergeBlocks }
				onSplit={
					insertBlocksAfter
						? ( before, after, ...blocks ) => {
								setAttributes( { content: before } );
								insertBlocksAfter( [
									...blocks,
									createBlock( 'core/paragraph', {
										content: after,
									} ),
								] );
						  }
						: undefined
				}
				onRemove={ () => onReplace( [] ) }
			/>
			<RichText
				tagName="p"
				placeholder={ __(
					'So to get started, you will just need to drag-n-drop the How-to block in the Gutenberg editor. The How-to block can be used on pages which contain a How-to in their title and describe steps to achieve certain requirements.',
					'vexaltrix'
				) }
				value={ headingDesc }
				className="vxt-howto-desc-text"
				onChange={ ( value ) => setAttributes( { headingDesc: value } ) }
				onMerge={ mergeBlocks }
				onSplit={ splitBlock }
				onRemove={ () => onReplace( [] ) }
			/>
			{ imageIconHtml }
			<span className="vxt-howto__time-wrap">
				{ showTotaltime && (
					<RichText
						tagName="h4"
						placeholder={ __( 'Total Time Needed ( Minutes ):', 'vexaltrix' ) }
						value={ timeNeeded }
						className="vxt-howto-timeNeeded-text"
						onChange={ ( value ) => setAttributes( { timeNeeded: value } ) }
						onMerge={ mergeBlocks }
						onSplit={ splitBlock }
						onRemove={ () => onReplace( [] ) }
					/>
				) }
				{ showTotaltime && (
					<>
						{ getFallbackNumber( timeInYears, 'timeInYears', blockName ) && (
							<>
								<p className="vxt-howto-timeNeeded-value">
									{ ' ' }
									{ getFallbackNumber( timeInYears, 'timeInYears', blockName ) }
								</p>
								<p className="vxt-howto-timeINmin-text"> { yearLabel }</p>
							</>
						) }
						{ getFallbackNumber( timeInMonths, 'timeInMonths', blockName ) && (
							<>
								<p className="vxt-howto-timeNeeded-value">
									{ getFallbackNumber( timeInMonths, 'timeInMonths', blockName ) }
								</p>
								<p className="vxt-howto-timeINmin-text">{ monthLabel }</p>
							</>
						) }
						{ getFallbackNumber( timeInDays, 'timeInDays', blockName ) && (
							<>
								<p className="vxt-howto-timeNeeded-value">
									{ getFallbackNumber( timeInDays, 'timeInDays', blockName ) }
								</p>
								<p className="vxt-howto-timeINmin-text">{ dayLabel }</p>
							</>
						) }
						{ getFallbackNumber( timeInHours, 'timeInHours', blockName ) && (
							<>
								<p className="vxt-howto-timeNeeded-value">
									{ getFallbackNumber( timeInHours, 'timeInHours', blockName ) }
								</p>
								<p className="vxt-howto-timeINmin-text">{ hourLabel }</p>
							</>
						) }
						{ minsValue && (
							<>
								<p className="vxt-howto-timeNeeded-value">{ minsValue }</p>
								<p className="vxt-howto-timeINmin-text">{ minsLabel }</p>
							</>
						) }
					</>
				) }
			</span>
			<span className="vxt-howto__cost-wrap">
				{ showEstcost && (
					<RichText
						tagName="h4"
						placeholder={ __( 'Total Cost:', 'vexaltrix' ) }
						value={ estCost }
						className="vxt-howto-estcost-text"
						onChange={ ( value ) => setAttributes( { estCost: value } ) }
						onMerge={ mergeBlocks }
						onSplit={ splitBlock }
						onRemove={ () => onReplace( [] ) }
					/>
				) }
				{ showEstcost && (
					<RichText
						tagName="p"
						placeholder={ __( '30', 'vexaltrix' ) }
						value={ cost }
						className="vxt-howto-estcost-value"
						onChange={ ( value ) => setAttributes( { cost: value } ) }
						onMerge={ mergeBlocks }
						onSplit={ splitBlock }
						onRemove={ () => onReplace( [] ) }
					/>
				) }
				{ showEstcost && (
					<RichText
						tagName="p"
						placeholder={ __( 'USD', 'vexaltrix' ) }
						value={ currencyType }
						className="vxt-howto-estcost-type"
						onChange={ ( value ) => setAttributes( { currencyType: value } ) }
						onMerge={ mergeBlocks }
						onSplit={ splitBlock }
						onRemove={ () => onReplace( [] ) }
					/>
				) }
			</span>
			{ showTools && (
				<RichText
					tagName="h4"
					placeholder={ __( 'requirements tools:', 'vexaltrix' ) }
					value={ toolsTitle }
					className="vxt-howto-req-tools-text"
					onChange={ ( value ) => setAttributes( { toolsTitle: value } ) }
					onMerge={ mergeBlocks }
					onSplit={ splitBlock }
					onRemove={ () => onReplace( [] ) }
				/>
			) }
			{ showTools && (
				<>
					{ tools.map( ( tool, index ) => {
						return (
							<RichText
								tagName="div"
								placeholder={ __( 'Requirements Tools:', 'vexaltrix' ) }
								value={ tool.add_required_tools }
								onChange={ ( value ) => {
									saveTools(
										{
											add_required_tools: value,
										},
										index
									);
								} }
								className={ `vxt-tools__label ${ index }` }
								multiline={ false }
								allowedFormats={ [ 'core/bold', 'core/italic', 'core/strikethrough' ] }
								key={ index }
							/>
						);
					} ) }
				</>
			) }
			{ showMaterials && (
				<RichText
					tagName="h4"
					placeholder={ __( 'requirements materials:', 'vexaltrix' ) }
					value={ materialTitle }
					className="vxt-howto-req-materials-text"
					onChange={ ( value ) => setAttributes( { materialTitle: value } ) }
					onMerge={ mergeBlocks }
					onSplit={ splitBlock }
					onRemove={ () => onReplace( [] ) }
				/>
			) }
			{ showMaterials && (
				<>
					{ materials.map( ( material, index ) => {
						return (
							<RichText
								tagName="div"
								placeholder={ __( 'Requirements Materials:', 'vexaltrix' ) }
								value={ material.add_required_materials }
								onChange={ ( value ) => {
									saveMaterials(
										{
											add_required_materials: value,
										},
										index
									);
								} }
								className={ `vxt-materials__label ${ index }` }
								multiline={ false }
								allowedFormats={ [ 'core/bold', 'core/italic', 'core/strikethrough' ] }
								key={ index }
							/>
						);
					} ) }
				</>
			) }
			<RichText
				tagName="h4"
				placeholder={ __( 'requirements Steps:', 'vexaltrix' ) }
				value={ stepsTitle }
				className="vxt-howto-req-steps-text"
				onChange={ ( value ) => setAttributes( { stepsTitle: value } ) }
				onMerge={ mergeBlocks }
				onSplit={ splitBlock }
				onRemove={ () => onReplace( [] ) }
			/>
			<InnerBlocks template={ getStepAsChild } allowedBlocks={ ALLOWED_BLOCKS } />
		</div>
	);
};

export default memo( Render );
