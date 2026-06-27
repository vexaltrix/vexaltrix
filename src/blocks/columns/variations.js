/**
 * Internal dependencies
 */
import rowIcons from './icons';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';

/**
 * Template option choices for predefined form layouts.
 *
 * @constant
 * @type {Array}
 */
const variations = [
	{
		name: 'one-column',
		label: __( 'One column', 'vexaltrix' ),
		icon: rowIcons.colOne,
		attributes: {
			columns: 1,
			layout: '100',
		},
		innerBlocks: [ [ 'vexaltrix/column', { colWidth: 100 } ] ],
		scope: [ 'block' ],
	},
	{
		name: 'two-column-split',
		label: __( 'Two columns; equal split', 'vexaltrix' ),
		icon: rowIcons.layout5050,
		attributes: {
			columns: 2,
			layout: '50-50',
		},
		isDefault: true,
		innerBlocks: [
			[ 'vexaltrix/column', { colWidth: 50 } ],
			[ 'vexaltrix/column', { colWidth: 50 } ],
		],
		scope: [ 'block' ],
	},
	{
		name: 'two-columns-one-third-two-thirds',
		label: __( 'Two columns; one-third, two-thirds split', 'vexaltrix' ),
		icon: rowIcons.layout3366,
		attributes: {
			columns: 2,
		},
		innerBlocks: [
			[ 'vexaltrix/column', { colWidth: 33.33 } ],
			[ 'vexaltrix/column', { colWidth: 66.66 } ],
		],
		scope: [ 'block' ],
	},
	{
		name: 'two-columns-two-thirds-one-third',
		label: __( 'Two columns; two-thirds, one-third split', 'vexaltrix' ),
		icon: rowIcons.layout6633,
		attributes: {
			columns: 2,
		},
		innerBlocks: [
			[ 'vexaltrix/column', { colWidth: 66.66 } ],
			[ 'vexaltrix/column', { colWidth: 33.33 } ],
		],
		scope: [ 'block' ],
	},
	{
		name: 'three-columns-equal',
		label: __( 'Three columns; equal split', 'vexaltrix' ),
		icon: rowIcons.layout333333,
		attributes: {
			columns: 3,
		},
		innerBlocks: [
			[ 'vexaltrix/column', { colWidth: 33.33 } ],
			[ 'vexaltrix/column', { colWidth: 33.33 } ],
			[ 'vexaltrix/column', { colWidth: 33.33 } ],
		],
		scope: [ 'block' ],
	},
	{
		name: 'three-column-first-half',
		label: __( 'Three columns; equal split', 'vexaltrix' ),
		icon: rowIcons.layout252550,
		attributes: {
			columns: 3,
			layout: '25-25-50',
		},
		innerBlocks: [
			[ 'vexaltrix/column', { colWidth: 25 } ],
			[ 'vexaltrix/column', { colWidth: 25 } ],
			[ 'vexaltrix/column', { colWidth: 50 } ],
		],
		scope: [ 'block' ],
	},
	{
		name: 'three-column',
		label: __( 'Three columns; equal split', 'vexaltrix' ),
		icon: rowIcons.layout502525,
		attributes: {
			columns: 3,
			layout: '50-25-25',
		},
		innerBlocks: [
			[ 'vexaltrix/column', { colWidth: 50 } ],
			[ 'vexaltrix/column', { colWidth: 25 } ],
			[ 'vexaltrix/column', { colWidth: 25 } ],
		],
		scope: [ 'block' ],
	},
	{
		name: 'three-columns-wider-center',
		label: __( 'Three columns; wide center column', 'vexaltrix' ),
		icon: rowIcons.layout255025,
		attributes: {
			columns: 3,
		},
		innerBlocks: [
			[ 'vexaltrix/column', { colWidth: 25 } ],
			[ 'vexaltrix/column', { colWidth: 50 } ],
			[ 'vexaltrix/column', { colWidth: 25 } ],
		],
		scope: [ 'block' ],
	},
	{
		name: 'four-column',
		label: __( 'Four columns; equal split', 'vexaltrix' ),
		icon: rowIcons.layout25252525,
		attributes: {
			columns: 4,
			layout: '25-25-25-25',
		},
		innerBlocks: [
			[ 'vexaltrix/column', { colWidth: 25 } ],
			[ 'vexaltrix/column', { colWidth: 25 } ],
			[ 'vexaltrix/column', { colWidth: 25 } ],
			[ 'vexaltrix/column', { colWidth: 25 } ],
		],
		scope: [ 'block' ],
	},
	{
		name: 'five-column',
		label: __( 'Five columns; equal split', 'vexaltrix' ),
		icon: rowIcons.layout2525252525,
		attributes: {
			columns: 5,
			layout: '25-25-25-25-25',
		},
		innerBlocks: [
			[ 'vexaltrix/column', { colWidth: 25 } ],
			[ 'vexaltrix/column', { colWidth: 25 } ],
			[ 'vexaltrix/column', { colWidth: 25 } ],
			[ 'vexaltrix/column', { colWidth: 25 } ],
			[ 'vexaltrix/column', { colWidth: 25 } ],
		],
		scope: [ 'block' ],
	},
];

export default variations;
