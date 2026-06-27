import classnames from 'classnames';

import renderSVG from '@Controls/deprecatedRenderIcon';

const CTA = ( props ) => {
	const { attributes, setAttributes } = props;

	let target = '_self';
	const rel = 'noopener noreferrer';
	if ( attributes.ctaTarget ) {
		target = '_blank';
	}

	let ctaIconOutput = '';
	if ( attributes.ctaIcon !== '' ) {
		ctaIconOutput = (
			<span
				className={ classnames(
					`vxt-cta-${ attributes.ctaType }-icon`,
					`vxt-cta__align-button-${ attributes.ctaIconPosition }`,
					'vxt-cta-with-svg'
				) }
			>
				{ renderSVG( attributes.ctaIcon ) }
			</span>
		);
	}

	let link = '/';
	if ( setAttributes === 'not_set' ) {
		link = attributes.ctaLink;
	}
	return (
		<div className="vxt-cta__link-wrapper vxt-cta__block-link-style">
			{ ( attributes.ctaType === 'button' || attributes.ctaType === 'text' ) && (
				<div
					className={ classnames(
						'vxt-cta__button-wrapper',
						attributes.inheritFromTheme && attributes.ctaType === 'button' ? 'wp-block-button' : null
					) }
				>
					<a
						href={ link }
						className={ classnames(
							'vxt-cta__button-link-wrapper',
							! attributes.inheritFromTheme ? 'vxt-cta__block-link' : null,
							! attributes.inheritFromTheme ? `vxt-cta-typeof-${ attributes.ctaType }` : null,
							attributes.inheritFromTheme && attributes.ctaType === 'button'
								? 'wp-block-button__link'
								: null
						) }
						target={ target }
						rel={ rel }
					>
						{ attributes.ctaIconPosition === 'before' && ctaIconOutput }
						<span className="vxt-cta__link-content-inner">
							<span>{ attributes.ctaText }</span>
						</span>
						{ attributes.ctaIconPosition === 'after' && ctaIconOutput }
					</a>
				</div>
			) }
		</div>
	);
};

export default CTA;
