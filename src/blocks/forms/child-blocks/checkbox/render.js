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

	const { block_id, checkboxRequired, options, checkboxName } = attributes;

	const isRequired = checkboxRequired ? 'required' : '';

	const addOption = () => {
		const newOption = {
			optiontitle: __( 'Option Name', 'vexaltrix' ) + `${ options.length + 1 }`,
			optionvalue: __( 'Option Value', 'vexaltrix' ) + `${ options.length + 1 }`,
		};
		const addNewOptions = [ ...options, newOption ];
		setAttributes( { options: addNewOptions } );
	};

	const editView = options.map( ( option, index ) => {
		return (
			<div key={ index } className="vxt-form-checkbox-option">
				<input
					type="checkbox"
					name={ `checkbox-${ block_id }` }
					value={ option.optiontitle }
					id={ option.optiontitle }
					required={ checkboxRequired }
				/>
				<label htmlFor={ option.optiontitle }> </label>
				<input
					className="vxt-inner-input-view"
					aria-label={ option.optiontitle }
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
					value={ option.optiontitle }
					required={ checkboxRequired }
				/>
				<input
					className="vxt-inner-input-view"
					aria-label={ option.optionvalue }
					onChange={ ( e ) => changeOption( { optionvalue: e.target.value }, index ) }
					type="text"
					value={ option.optionvalue }
					required={ checkboxRequired }
				/>
				<Button
					className="vxt-form-checkbox-option-delete"
					icon="trash"
					label="Remove"
					onClick={ () => deleteOption( index ) }
				/>
			</div>
		);
	} );

	const CheckboxView = () => {
		return options.map( ( option ) => {
			const optionvalue = option.optionvalue;
			const value = optionvalue.replace( /\s+/g, '-' ).toLowerCase();
			return (
				<>
					<input
						type="checkbox"
						className="vxt-forms-checkbox"
						id={ `checkbox-${ value }-${ block_id }` }
						name={ `${ checkboxName }[]` }
						value={ value }
						required={ checkboxRequired }
					/>
					<label htmlFor={ `checkbox-${ value }-${ block_id }` }>{ option.optiontitle }</label>
					<br />
				</>
			);
		} );
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
		const deleteOptions = options.map( ( item, thisIndex ) => {
			if ( index === thisIndex ) {
				options.splice( index, 1 );
				item = { options };
			}
			return item;
		} );

		setAttributes( { deleteOptions } );
	};

	return (
		<>
			<div
				className={ classnames( 'vxt-forms-checkbox-wrap', 'vxt-forms-field-set', `vxt-block-${ block_id }` ) }
			>
				<RichText
					tagName="div"
					placeholder={ __( 'Checkbox Title', 'vexaltrix' ) }
					value={ checkboxName }
					onChange={ ( value ) => setAttributes( { checkboxName: value } ) }
					className={ `vxt-forms-checkbox-label ${ isRequired } vxt-forms-input-label` }
					multiline={ false }
					id={ block_id }
				/>
				{ isSelected && (
					<>
						{ editView }
						<div className="vxt-forms-checkbox-controls">
							<div>
								<Button isSecondary onClick={ addOption }>
									{ __( '+ Add Option', 'vexaltrix' ) }
								</Button>
							</div>
						</div>
					</>
				) }

				{ ! isSelected && <CheckboxView /> }
			</div>
		</>
	);
};

export default memo( Render );
