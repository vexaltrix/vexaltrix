/**
 * BLOCK: WP Search - Save Block
 */

import classnames from 'classnames';
import renderSVG from '@Controls/renderIcon';

import { RichText } from '@wordpress/block-editor';

export default function save( props ) {
	const { block_id, layout, placeholder, buttonType, buttonText } = props.attributes;

	const renderClassic = () => {
		if ( 'input-button' === layout ) {
			return (
				<form
					className="vxt-search-wrapper"
					role="search"
					action={ vxt_ultimate_gutenberg_blocks_blocks_info.vxt_ultimate_gutenberg_blocks_home_url }
					method="get"
				>
					<div className="vxt-search-form__container" role="tablist">
						<input
							placeholder={ placeholder }
							className="vxt-search-form__input"
							type="search"
							name="s"
							title="Search"
						/>

						<button className="vxt-search-submit" type="submit">
							{ 'icon' === buttonType && (
								<span className="vxt-wp-search-button-icon-wrap">{ renderSVG( 'fas fa-search' ) }</span>
							) }
							{ 'text' === buttonType && (
								<RichText.Content
									tagName="span"
									value={ buttonText }
									className="vxt-wp-search-button-text"
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
			className={ classnames( 'vxt-wp-search__outer-wrap', `vxt-block-${ block_id }`, `vxt-layout-${ layout }` ) }
		>
			{ renderClassic() }
			{ renderMinimal() }
		</div>
	);
}
