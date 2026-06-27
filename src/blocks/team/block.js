/**
 * BLOCK: Team
 */

import VXT_Block_Icons from '@Controls/block-icons';
import Edit from './edit';
import save from './save';
import deprecated from './deprecated';
import attributes from './attributes';
import './style.scss';

import { __ } from '@wordpress/i18n';

import { registerBlockType } from '@wordpress/blocks';
import PreviewImage from '@Controls/previewImage';
import { applyFilters } from '@wordpress/hooks';
import addCommonDataToVexaltrixBlocks from '@Controls/addCommonDataToVexaltrixBlocks';
let teamCommonData = {};
teamCommonData = applyFilters( 'vexaltrix/team', addCommonDataToVexaltrixBlocks( teamCommonData ) );
registerBlockType( 'vexaltrix/team', {
	...teamCommonData,
	title: __( 'Team', 'vexaltrix' ),
	description: __( 'Showcase your team by displaying info and social media profiles.', 'vexaltrix' ),
	icon: VXT_Block_Icons.team,
	keywords: [ __( 'team', 'vexaltrix' ), __( 'members', 'vexaltrix' ), __( 'uag', 'vexaltrix' ) ],
	supports: {
		anchor: true,
	},
	attributes,
	category: vxt_ultimate_gutenberg_blocks_blocks_info.category,
	edit: ( props ) => ( props.attributes.isPreview ? <PreviewImage image="team" /> : <Edit { ...props } /> ),
	save,
	deprecated,
} );
