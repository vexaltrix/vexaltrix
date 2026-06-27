/**
 * BLOCK: Forms - Accept - Save Block
 */

import classnames from 'classnames';

export default function save( props ) {
	const { attributes } = props;

	const { block_id, acceptRequired, acceptText, showLink, linkLabel, link, linkInNewTab } = attributes;

	const isRequired = acceptRequired ? 'required' : '';
	const target = linkInNewTab ? '_blank' : '_self';

	return (
		<div className={ classnames( 'vxt-forms-accept-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }>
			{ showLink && (
				<div className="vxt-forms-accept-privacy-link">
					<a href={ link } target={ target } rel="noopener noreferrer">
						{ linkLabel }
					</a>
				</div>
			) }
			<input
				type="checkbox"
				name={ block_id }
				required={ acceptRequired }
				value="Agree"
				className="vxt-forms-checkbox"
				id={ `vxt-forms-accept-${ block_id }` }
			/>
			<label
				name={ block_id }
				htmlFor={ `vxt-forms-accept-${ block_id }` }
				className={ `vxt-forms-accept-label ${ isRequired }` }
				id={ block_id }
			>
				{ acceptText }
			</label>
			<br></br>
		</div>
	);
}
