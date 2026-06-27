/**
 * BLOCK: Forms - Accept - Save Block
 */

import classnames from 'classnames';
import { __ } from '@wordpress/i18n';
const attributes = {
	isPreview: {
		type: 'boolean',
		default: false,
	},
	block_id: {
		type: 'string',
	},
	acceptRequired: {
		type: 'boolean',
		default: false,
	},
	acceptText: {
		type: 'string',
		default: __( 'I have read and agree to the Privacy Policy.', 'vexaltrix' ),
	},
	showLink: {
		type: 'boolean',
		default: false,
	},
	linkLabel: {
		type: 'string',
		default: __( 'Privacy Policy', 'vexaltrix' ),
	},
	link: {
		type: 'string',
		default: '#',
	},
	linkInNewTab: {
		type: 'boolean',
		default: true,
	},
};

const deprecated = {
	attributes,
	save: ( props ) => {
		const {
			attributes: { block_id, acceptRequired, acceptText, showLink, linkLabel, link, linkInNewTab },
		} = props;

		const isRequired = acceptRequired ? __( 'required', 'vexaltrix' ) : '';
		const target = linkInNewTab ? __( '_blank', 'vexaltrix' ) : __( '_self', 'vexaltrix' );

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
	},
};
export default deprecated;
