import classnames from 'classnames';
import { useLayoutEffect, memo } from '@wordpress/element';
import styles from './editor.lazy.scss';

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const { attributes } = props;

	const { block_id, acceptRequired, acceptText, showLink, linkLabel, link, linkInNewTab } = attributes;

	const isRequired = acceptRequired ? 'required' : '';
	const target = linkInNewTab ? '_blank' : '_self';

	return (
		<>
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
					id={ `vxt-forms-accept-${ block_id }` }
					className="vxt-forms-checkbox"
					name={ block_id }
					required={ acceptRequired }
					value="Agree"
				/>
				<label
					name={ block_id }
					htmlFor={ `vxt-forms-accept-${ block_id }` }
					className={ `vxt-forms-accept-label ${ isRequired }` }
				>
					{ acceptText }
				</label>
				<br></br>
			</div>
		</>
	);
};

export default memo( Render );
