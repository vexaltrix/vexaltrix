import classnames from 'classnames';
import { useLayoutEffect, memo } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import styles from './editor.lazy.scss';
import { SelectControl, Placeholder, Spinner } from '@wordpress/components';

const Render = ( props ) => {
	// Add and remove the CSS on the drop and remove of the component.
	useLayoutEffect( () => {
		styles.use();
		return () => {
			styles.unuse();
		};
	}, [] );

	const { className, attributes, deviceType } = props;

	const {
		block_id,
		formId,
		align,
		isHtml,
		formJson,
		fieldStyle,
		buttonAlignment,
		buttonAlignmentTablet,
		buttonAlignmentMobile,
		enableOveride,
		validationMsgPosition,
		enableHighlightBorder,
	} = attributes;

	/*
	 * Event to set Image as while adding.
	 */
	const onSelectForm = ( id ) => {
		const { setAttributes } = props;

		if ( ! id ) {
			setAttributes( { isHtml: false } );
			setAttributes( { formId: null } );
			return;
		}

		setAttributes( { isHtml: false } );
		setAttributes( { formId: id } );
	};

	let html = '';

	if ( formJson && formJson.data.html ) {
		html = formJson.data.html;
	}

	if ( parseInt( formId ) === 0 ) {
		return (
			<Placeholder icon="admin-post" label={ __( 'Select a Contact Form 7', 'vexaltrix' ) }>
				<SelectControl
					value={ formId }
					onChange={ onSelectForm }
					options={ vxt_ultimate_gutenberg_blocks_blocks_info.cf7_forms }
				/>
			</Placeholder>
		);
	}

	return (
		<div
			className={ classnames(
				className,
				'vxt-cf7-styler__outer-wrap',
				`vxt-editor-preview-mode-${ deviceType.toLowerCase() }`,
				`vxt-block-${ block_id }`
			) }
		>
			<div
				className={ classnames(
					`vxt-cf7-styler__align-${ align }`,
					`vxt-cf7-styler__field-style-${ fieldStyle }`,
					`vxt-cf7-styler__btn-align-${ buttonAlignment }`,
					`vxt-cf7-styler__btn-align-tablet-${ buttonAlignmentTablet }`,
					`vxt-cf7-styler__btn-align-mobile-${ buttonAlignmentMobile }`,
					`vxt-cf7-styler__highlight-style-${ validationMsgPosition }`,
					enableOveride ? 'vxt-cf7-styler__check-style-enabled' : '',
					enableHighlightBorder ? 'vxt-cf7-styler__highlight-border' : ''
				) }
			>
				{ isHtml && <div dangerouslySetInnerHTML={ { __html: html } } /> }
				{ isHtml === false && (
					<Placeholder icon="admin-post" label={ __( 'Loading', 'vexaltrix' ) }>
						<Spinner />
					</Placeholder>
				) }
			</div>
		</div>
	);
};

export default memo( Render );
