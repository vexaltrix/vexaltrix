import { RichText } from '@wordpress/block-editor';
import classnames from 'classnames';
import renderSVG from '@Controls/renderIcon';
import { __ } from '@wordpress/i18n';

const InfoBoxCta = ( props ) => {
	const { attributes, setAttributes = 'not_set' } = props;

	const ctaBtnClass = 'vxt-infobox-cta-link wp-block-button__link';

	let target = '_self';
	const rel = 'noopener noreferrer';
	if ( attributes.ctaTarget ) {
		target = '_blank';
	}

	let ctaIconOutput = '';
	if ( attributes.showCtaIcon && attributes.ctaIcon !== '' ) {
		ctaIconOutput = renderSVG( attributes.ctaIcon, setAttributes );
	}

	if ( setAttributes !== 'not_set' ) {
		return (
			<div className="vxt-ifb-cta">
				{ attributes.ctaType === 'text' && (
					<a // eslint-disable-line jsx-a11y/anchor-is-valid
						target={ target }
						className={
							! attributes.ctaLink ? 'vxt-infobox-cta-link vxt-disable-link' : 'vxt-infobox-cta-link'
						}
						rel={ rel }
					>
						{ attributes.ctaIconPosition === 'before' && ctaIconOutput }
						<RichText
							tagName="span"
							placeholder={ __( 'Read More', 'vexaltrix' ) }
							value={ attributes.ctaText.replace( /(<([^>]+)>)/gi, '' ) }
							className="vxt-inline-editing"
							multiline={ false }
							onChange={ ( value ) => {
								setAttributes( { ctaText: value } );
							} }
							allowedFormats={ [] } // Removed the WP default link/bold/italic from the toolbar for button.
						/>
						{ attributes.ctaIconPosition === 'after' && ctaIconOutput }
					</a>
				) }

				{ attributes.ctaType === 'button' && (
					<div className={ classnames( 'vxt-ifb-button-wrapper', 'wp-block-button' ) }>
						<a // eslint-disable-line jsx-a11y/anchor-is-valid
							className={ ! attributes.ctaLink ? `${ ctaBtnClass }  vxt-disable-link` : ctaBtnClass }
							target={ target }
							rel={ rel }
						>
							{ attributes.ctaIconPosition === 'before' && ctaIconOutput }
							<RichText
								tagName="span"
								placeholder={ __( 'Read More', 'vexaltrix' ) }
								value={ attributes.ctaText.replace( /(<([^>]+)>)/gi, '' ) }
								className="vxt-inline-editing"
								multiline={ false }
								onChange={ ( value ) => {
									setAttributes( { ctaText: value } );
								} }
								allowedFormats={ [] } // Removed the WP default link/bold/italic from the toolbar for button.
							/>
							{ attributes.ctaIconPosition === 'after' && ctaIconOutput }
						</a>
					</div>
				) }
			</div>
		);
	}
	return (
		<>
			<div className="vxt-ifb-button-wrapper wp-block-button">
				{ attributes.ctaType === 'text' && (
					<a
						href={ attributes.ctaLink }
						target={ target }
						className={
							! attributes.ctaLink ? 'vxt-infobox-cta-link vxt-disable-link' : 'vxt-infobox-cta-link'
						}
						rel={ rel }
						alt=""
					>
						{ attributes.ctaIconPosition === 'before' && ctaIconOutput }
						<RichText.Content
							tagName="span"
							value={ attributes.ctaText.replace( /(<([^>]+)>)/gi, '' ) }
							className="vxt-inline-editing"
						/>
						{ attributes.ctaIconPosition === 'after' && ctaIconOutput }
					</a>
				) }
				{ attributes.ctaType === 'button' && (
					<a
						href={ attributes.ctaLink }
						className={ ! attributes.ctaLink ? `${ ctaBtnClass }  vxt-disable-link` : ctaBtnClass }
						target={ target }
						rel={ rel }
						alt=""
					>
						{ attributes.ctaIconPosition === 'before' && ctaIconOutput }
						<RichText.Content
							tagName="span"
							value={ attributes.ctaText.replace( /(<([^>]+)>)/gi, '' ) }
							className="vxt-inline-editing"
						/>
						{ attributes.ctaIconPosition === 'after' && ctaIconOutput }
					</a>
				) }
			</div>
		</>
	);
};
export default InfoBoxCta;
