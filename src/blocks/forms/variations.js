/**
 * WordPress dependencies
 */

import { __experimentalBlockVariationPicker as BlockVariationPicker } from '@wordpress/block-editor';
import VXT_Block_Icons from '@Controls/block-icons';
import { __ } from '@wordpress/i18n';
import { useDispatch } from '@wordpress/data';
import { createBlocksFromInnerBlocksTemplate } from '@wordpress/blocks';
/**
 * Template option choices for predefined form layouts.
 *
 * @constant
 * @type {Array}
 */
export const variations = [
	{
		name: 'simple-contact-form',
		label: __( 'Simple Contact Form', 'vexaltrix' ),
		icon: VXT_Block_Icons.form1,
		title: __( 'Simple Contact Form', 'vexaltrix' ),
		attributes: {},
		isDefault: true,
		innerBlocks: [
			[
				'vexaltrix/forms-name',
				{
					name: __( 'First Name', 'vexaltrix' ),
					placeholder: __( 'John', 'vexaltrix' ),
					nameRequired: true,
					autocomplete: 'given-name',
				},
			],
			[
				'vexaltrix/forms-name',
				{
					name: __( 'Last Name', 'vexaltrix' ),
					placeholder: __( 'Doe', 'vexaltrix' ),
					nameRequired: true,
					autocomplete: 'family-name',
				},
			],
			[ 'vexaltrix/forms-email', { emailRequired: true } ],
			[ 'vexaltrix/forms-textarea', { textareaRequired: true } ],
		],
		scope: [ 'block' ],
	},
	{
		name: 'newsletter-form',
		label: __( 'Newsletter Form', 'vexaltrix' ),
		icon: VXT_Block_Icons.form2,
		title: __( 'Newsletter Form', 'vexaltrix' ),
		attributes: {},
		innerBlocks: [
			[ 'vexaltrix/forms-name', { nameRequired: true } ],
			[ 'vexaltrix/forms-email', { emailRequired: true } ],
		],
		scope: [ 'block' ],
	},
	{
		name: 'suggestion-form',
		label: __( 'Suggestion Form', 'vexaltrix' ),
		icon: VXT_Block_Icons.form3,
		title: __( 'Suggestion Form', 'vexaltrix' ),
		attributes: {},
		innerBlocks: [
			[ 'vexaltrix/forms-name', { nameRequired: true } ],
			[ 'vexaltrix/forms-email', { emailRequired: true } ],
			[
				'vexaltrix/forms-radio',
				{
					radioRequired: true,
					radioName: 'Some question with below listed option?',
					options: [
						{
							optiontitle: __( 'Option Name 1', 'vexaltrix' ),
							optionvalue: __( 'Option Value 1', 'vexaltrix' ),
						},
						{
							optiontitle: __( 'Option Name 2', 'vexaltrix' ),
							optionvalue: __( 'Option Value 2', 'vexaltrix' ),
						},
						{
							optiontitle: __( 'Option Name 3', 'vexaltrix' ),
							optionvalue: __( 'Option Value 3', 'vexaltrix' ),
						},
						{
							optiontitle: __( 'Option Name 4', 'vexaltrix' ),
							optionvalue: __( 'Option Value 4', 'vexaltrix' ),
						},
					],
				},
			],
			[
				'vexaltrix/forms-name',
				{
					name: __( 'Subject', 'vexaltrix' ),
					placeholder: __( 'Enter your subject', 'vexaltrix' ),
					nameRequired: true,
					autocomplete: 'off',
				},
			],
			[ 'vexaltrix/forms-textarea', { textareaRequired: true } ],
		],
		scope: [ 'block' ],
	},
];

export const VariationPicker = ( props ) => {
	const { clientId, setAttributes, defaultVariation } = props;
	const { replaceInnerBlocks } = useDispatch( 'core/block-editor' );

	const blockVariationPickerOnSelect = ( nextVariation = defaultVariation ) => {
		if ( nextVariation.attributes ) {
			setAttributes( nextVariation.attributes );
		}

		if ( nextVariation.innerBlocks ) {
			replaceInnerBlocks( clientId, createBlocksFromInnerBlocksTemplate( nextVariation.innerBlocks ) );
		}
	};

	return (
		<div className="vxt-forms-variations vxt-variation-picker vxt-variation-picker--fill">
			<BlockVariationPicker
				icon={ VXT_Block_Icons.forms }
				label={ __( 'Forms', 'vexaltrix' ) }
				instructions={ __( 'Select a form layout to start with.', 'vexaltrix' ) }
				variations={ variations }
				onSelect={ ( nextVariation ) => blockVariationPickerOnSelect( nextVariation ) }
			/>
		</div>
	);
};
