import classnames from 'classnames';
import Prefix from '../.././components/Prefix';
import Title from '../.././components/Title';
import InfoBoxDesc from '../InfoBoxDescDeprecated';
import Icon from '../.././components/Icons';
import InfoBoxPositionClasses from '../.././style-classes';
import InfoBoxSeparator from '../.././components/Separator';
import CallToAction from './CTA';
import InfoBoxIconImage from '../.././components/IconImages';

export default function save( props ) {
	const {
		iconimgPosition,
		block_id,
		source_type,
		seperatorStyle,
		ctaType,
		ctaLink,
		ctaTarget,
		prefixTitle,
		infoBoxTitle,
		headingDesc,
		showPrefix,
		showTitle,
		showDesc,
		icon,
		seperatorPosition,
	} = props.attributes;

	// Get icon/Image components.
	let isImage = '';

	if ( source_type === 'icon' && icon !== '' ) {
		isImage = <Icon attributes={ props.attributes } />;
	} else {
		isImage = <InfoBoxIconImage attributes={ props.attributes } />;
	}

	let iconImageHtml = isImage;
	let position = seperatorPosition;
	const seperatorHtml = <InfoBoxSeparator attributes={ props.attributes } />;
	let showSeperator = true;

	if ( position === 'after_icon' && ( iconimgPosition === 'above-title' || iconimgPosition === 'below-title' ) ) {
		showSeperator = false;
		iconImageHtml = (
			<>
				{ isImage }
				{ 'none' !== seperatorStyle && seperatorHtml }
			</>
		);
	}

	if (
		position === 'after_icon' &&
		( iconimgPosition === 'left-title' ||
			iconimgPosition === 'right-title' ||
			iconimgPosition === 'left' ||
			iconimgPosition === 'right' )
	) {
		position = 'after_title';
	}

	if ( iconimgPosition === 'below-title' && position === 'after_title' ) {
		showSeperator = false;
		iconImageHtml = (
			<>
				{ 'none' !== seperatorStyle && seperatorHtml }
				{ isImage }
			</>
		);
	}
	// Get description and seperator components.
	const desc = (
		<>
			{ 'none' !== seperatorStyle && position === 'after_title' && showSeperator && seperatorHtml }
			{ showDesc && '' !== headingDesc && (
				<InfoBoxDesc attributes={ props.attributes } setAttributes="not_set" />
			) }
			{ 'none' !== seperatorStyle && position === 'after_desc' && seperatorHtml }
			{ ctaType !== 'none' && <CallToAction attributes={ props.attributes } /> }
		</>
	);

	// Get Title and Prefix components.
	const titleText = (
		<div className="vxt-ifb-title-wrap">
			{ showPrefix && '' !== prefixTitle && <Prefix attributes={ props.attributes } setAttributes="not_set" /> }
			{ 'none' !== seperatorStyle && position === 'after_prefix' && seperatorHtml }
			{ showTitle && '' !== infoBoxTitle && <Title attributes={ props.attributes } setAttributes="not_set" /> }
		</div>
	);

	const output = (
		<>
			{ iconimgPosition === 'left' && iconImageHtml }
			<div className="vxt-ifb-content">
				{ iconimgPosition === 'above-title' && iconImageHtml }

				{ ( iconimgPosition === 'above-title' || iconimgPosition === 'below-title' ) && titleText }

				{ iconimgPosition === 'below-title' && iconImageHtml }

				{ ( iconimgPosition === 'above-title' || iconimgPosition === 'below-title' ) && desc }

				{ iconimgPosition === 'left-title' && (
					<>
						<div className="vxt-ifb-left-title-image">
							{ iconImageHtml }
							{ titleText }
						</div>
						{ desc }
					</>
				) }

				{ iconimgPosition === 'right-title' && (
					<>
						<div className="vxt-ifb-right-title-image">
							{ titleText }
							{ iconImageHtml }
						</div>
						{ desc }
					</>
				) }

				{ ( iconimgPosition === 'left' || iconimgPosition === 'right' ) && (
					<>
						{ titleText }
						{ desc }
					</>
				) }
			</div>

			{ iconimgPosition === 'right' && iconImageHtml }
		</>
	);

	let target = '_self';
	if ( ctaTarget ) {
		target = '_blank';
	}

	return (
		<div
			className={ classnames(
				`vxt-block-${ block_id }`,
				'vxt-infobox__content-wrap',
				ctaType === 'all' ? ' vxt-infobox_cta-type-all' : '',
				...InfoBoxPositionClasses( props.attributes )
			) }
		>
			{ ctaType === 'all' && (
				<a // eslint-disable-line jsx-a11y/anchor-has-content
					href={ ctaLink }
					className={
						! ctaLink
							? 'vxt-infobox-link-wrap vxt-infbox__link-to-all vxt-disable-link'
							: 'vxt-infobox-link-wrap vxt-infbox__link-to-all'
					}
					target={ target }
					aria-label={ 'Infobox Link' }
					rel="noopener noreferrer"
				></a>
			) }
			{ output }
		</div>
	);
}
