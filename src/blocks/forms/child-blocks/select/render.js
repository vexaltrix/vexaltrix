import classnames from 'classnames';
import { useLayoutEffect, memo } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import styles from './editor.lazy.scss';
import { Button } from '@wordpress/components';
import { RichText } from '@wordpress/block-editor';

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const { attributes, setAttributes, isSelected } = props;

	const { block_id, selectRequired, options, selectName } = attributes;

	const addOption = () => {
		const newOption = {
			optiontitle: __( 'Option Name', 'vexaltrix' ) + `${ options.length + 1 }`,
			optionvalue: __( 'Option Value', 'vexaltrix' ) + `${ options.length + 1 }`,
		};
		options[ options.length ] = newOption;
		const addnewOptions = options.map( ( item ) => item );

		setAttributes( { options: addnewOptions } );
	};

	const editView = options.map( ( s, index ) => {
		return (
			<div key={ index } className="vxt-form-select-option">
				<input
					className="vxt-inner-input-view"
					aria-label={ s.optiontitle }
					onChange={ ( e ) =>
						changeOption(
							{
								optiontitle: e.target.value,
								optionvalue: e.target.value,
							},
							index
						)
					}
					type="text"
					value={ s.optiontitle }
				/>
				<input
					className="vxt-inner-input-view"
					aria-label={ s.optionvalue }
					onChange={ ( e ) => changeOption( { optionvalue: e.target.value }, index ) }
					type="text"
					value={ s.optionvalue }
				/>
				<Button
					className="vxt-form-select-option-delete"
					icon="trash"
					label="Remove"
					onClick={ () => deleteOption( index ) }
				/>
			</div>
		);
	} );

	const SelectView = () => {
		const showoptionsField = options.map( ( o, index ) => {
			return (
				<option key={ index } value={ o.optionvalue }>
					{ o.optiontitle }
				</option>
			);
		} );

		return (
			<select
				className="vxt-forms-select-box vxt-forms-input"
				required={ selectRequired }
				name={ block_id }
				defaultValue=""
			>
				<option value="" disabled>
					{ __( 'Select your option', 'vexaltrix' ) }
				</option>
				{ showoptionsField }
			</select>
		);
	};

	const changeOption = ( e, index ) => {
		const editOptions = options.map( ( item, thisIndex ) => {
			if ( index === thisIndex ) {
				item = { ...item, ...e };
			}
			return item;
		} );

		setAttributes( { options: editOptions } );
	};

	const deleteOption = ( index ) => {
		const deleteCurrentOptions = options.map( ( item, thisIndex ) => {
			if ( index === thisIndex ) {
				options.splice( index, 1 );
				item = { options };
			}
			return item;
		} );

		setAttributes( { deleteCurrentOptions } );
	};

	const isRequired = selectRequired ? 'required' : '';

	return (
		<>
			<div className={ classnames( 'vxt-forms-select-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }>
				<RichText
					tagName="div"
					placeholder={ __( 'Select Title', 'vexaltrix' ) }
					value={ selectName }
					onChange={ ( value ) => setAttributes( { selectName: value } ) }
					className={ `vxt-forms-select-label ${ isRequired } vxt-forms-input-label` }
					multiline={ false }
					id={ block_id }
				/>
				{ isSelected && (
					<>
						{ editView }
						<div className="vxt-forms-select-controls">
							<div>
								<Button isSecondary onClick={ addOption }>
									{ __( '+ Add Option', 'vexaltrix' ) }
								</Button>
							</div>
						</div>
					</>
				) }

				{ ! isSelected && <SelectView /> }
			</div>
		</>
	);
};
export default memo( Render );
