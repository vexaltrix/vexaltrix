import classnames from 'classnames';
import { useLayoutEffect, memo } from '@wordpress/element';
import renderSVG from '@Controls/renderIcon';
import { __ } from '@wordpress/i18n';
import styles from './editor.lazy.scss';
import { RichText } from '@wordpress/block-editor';

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const { attributes, setAttributes, deviceType } = props;

	const { block_id, layout, placeholder, buttonType, buttonText } = attributes;

	const renderClassic = () => {
		if ( 'input-button' === layout ) {
			return (
				<form
					className="vxt-search-wrapper"
					onSubmit={ ( e ) => e.preventDefault() }
					role="search"
					action={ vxt_ultimate_gutenberg_blocks_blocks_info.vxt_ultimate_gutenberg_blocks_home_url }
					method="get"
				>
					<div className="vxt-search-form__container wp-block-button" role="tablist">
						<input
							placeholder={ placeholder }
							className="vxt-search-form__input"
							type="search"
							name="s"
							title="Search"
						/>

						<button className="vxt-search-submit wp-block-button__link" type="submit">
							{ 'icon' === buttonType && (
								<span className="vxt-wp-search-button-icon-wrap">{ renderSVG( 'fas fa-search' ) }</span>
							) }
							{ 'text' === buttonType && (
								<RichText
									tagName="span"
									placeholder={ __( 'Search', 'vexaltrix' ) }
									value={ buttonText }
									onChange={ ( value ) =>
										setAttributes( {
											buttonText: value,
										} )
									}
									className="vxt-wp-search-button-text"
									multiline={ false }
									allowedFormats={ [ 'core/bold', 'core/italic', 'core/strikethrough' ] }
								/>
							) }
						</button>
					</div>
				</form>
			);
		}

		return '';
	};

	const renderMinimal = () => {
		if ( 'input' === layout ) {
			return (
				<form
					className="vxt-search-wrapper"
					onSubmit={ ( e ) => e.preventDefault() }
					role="search"
					action={ vxt_ultimate_gutenberg_blocks_blocks_info.vxt_ultimate_gutenberg_blocks_home_url }
					method="get"
				>
					<div className="vxt-search-form__container" role="tablist">
						<span className="vxt-wp-search-icon-wrap">{ renderSVG( 'fas fa-search' ) }</span>
						<input
							placeholder={ placeholder }
							className="vxt-search-form__input"
							type="search"
							name="s"
							title="Search"
						/>
					</div>
				</form>
			);
		}

		return '';
	};

	return (
		<div
			className={ classnames(
				'vxt-wp-search__outer-wrap',
				`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
				`vxt-block-${ block_id }`,
				`vxt-layout-${ layout }`
			) }
		>
			{ renderClassic() }
			{ renderMinimal() }
		</div>
	);
};

export default memo( Render );
