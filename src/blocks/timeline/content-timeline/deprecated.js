/**
 * BLOCK: Testimonial - Deprecated Block
 */

import classnames from 'classnames';
import attributes from './attributes';
import ContentTmClasses from '.././classes';
import AlignClass from '.././align-classes';
import DayAlignClass from '.././day-align-classes';
import renderSVG from '@Controls/deprecatedRenderIcon';
import { InnerBlocks, RichText } from '@wordpress/block-editor';
import { dateI18n, getSettings } from '@wordpress/date';

function DeprecatedContentTmClasses( attributes ) {
	/* Arrow position */
	let arrow_align_class = 'vxt-timeline__arrow-top' + ' ';
	if ( attributes.arrowlinAlignment == 'center' ) {
		arrow_align_class = 'vxt-timeline__arrow-center' + ' ';
	} else if ( attributes.arrowlinAlignment == 'bottom' ) {
		arrow_align_class = 'vxt-timeline__arrow-bottom' + ' ';
	}

	/* Alignmnet */
	let align_class = 'vxt-timeline__center-block ' + ' ';
	if ( attributes.timelinAlignment == 'left' ) {
		align_class = 'vxt-timeline__left-block' + ' ';
	} else if ( attributes.timelinAlignment == 'right' ) {
		align_class = 'vxt-timeline__right-block' + ' ';
	}
	align_class += arrow_align_class + '';
	align_class += 'vxt-timeline__responsive-' + attributes.stack + ' vxt-timeline';

	return [ align_class ];
}

const deprecated = [
	{
		attributes,
		save( props ) {
			const {
				block_id,
				headingTag,
				timelinAlignment,
				displayPostDate,
				icon,
				tm_content,
				t_date,
				stack,
				className,
			} = props.attributes;

			const hasItems = Array.isArray( tm_content ) && tm_content.length;

			const dateFormat = getSettings().formats.date;

			let content_align_class = AlignClass( props.attributes, 0 ); // Get classname for layout alignment
			let day_align_class = DayAlignClass( props.attributes, 0 ); //

			const data_copy = [ ...tm_content ];
			let display_inner_date = false;

			return (
				<div className={ classnames( className, 'vxt-timeline__outer-wrap' ) } id={ `vxt-ctm-${ block_id }` }>
					<div
						className={ classnames(
							'vxt-timeline__content-wrap',
							...ContentTmClasses( props.attributes )
						) }
					>
						<div className="vxt-timeline-wrapper">
							<div className="vxt-timeline__main">
								<div className="vxt-timeline__days">
									{ tm_content.map( ( post, index ) => {
										const second_index = 'vxt-' + index;
										if ( timelinAlignment == 'center' ) {
											display_inner_date = true;
											content_align_class = AlignClass( props.attributes, index ); // Get classname for layout alignment
											day_align_class = DayAlignClass( props.attributes, index ); //
										}
										const Tag = headingTag;
										const icon_class = 'vxt-timeline__icon-new out-view-vxt-timeline__icon ' + icon;

										return (
											<article
												className="vxt-timeline__field vxt-timeline__animate-border"
												key={ index }
											>
												<div className={ classnames( ...content_align_class ) }>
													<div className="vxt-timeline__marker out-view-vxt-timeline__icon">
														<span className={ icon_class }></span>
													</div>

													<div className={ classnames( ...day_align_class ) }>
														<div className="vxt-events-new">
															<div className="vxt-timeline__events-inner-new">
																<div className="vxt-timeline__date-hide vxt-timeline__date-inner">
																	{ displayPostDate && t_date[ index ].title && (
																		<div
																			className={ 'vxt-timeline__inner-date-new' }
																		>
																			{ dateI18n(
																				dateFormat,
																				t_date[ index ].title
																			) }
																		</div>
																	) }
																</div>

																<div className="vxt-timeline-content">
																	<div className="vxt-timeline__heading-text">
																		<RichText.Content
																			tagName={ headingTag }
																			value={ post.time_heading }
																			className="vxt-timeline__heading"
																		/>
																	</div>

																	<RichText.Content
																		tagName="p"
																		value={ post.time_desc }
																		className="vxt-timeline-desc-content"
																	/>

																	<div className="vxt-timeline__arrow"></div>
																</div>
															</div>
														</div>
													</div>

													{ display_inner_date && (
														<div className="vxt-timeline__date-new">
															{ displayPostDate && t_date[ index ].title && (
																<div className={ 'vxt-timeline__date-new' }>
																	{ dateI18n( dateFormat, t_date[ index ].title ) }
																</div>
															) }
														</div>
													) }
												</div>
											</article>
										);
									} ) }
								</div>
								<div className="vxt-timeline__line">
									<div className="vxt-timeline__line__inner"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			);
		},
	},
	{
		attributes,
		save( props ) {
			const {
				block_id,
				headingTag,
				timelinAlignment,
				displayPostDate,
				icon,
				tm_content,
				t_date,
				stack,
				className,
			} = props.attributes;

			const hasItems = Array.isArray( tm_content ) && tm_content.length;

			const dateFormat = getSettings().formats.date;

			let content_align_class = AlignClass( props.attributes, 0 ); // Get classname for layout alignment
			let day_align_class = DayAlignClass( props.attributes, 0 ); //

			const data_copy = [ ...tm_content ];
			let display_inner_date = false;

			return (
				<div className={ classnames( className, 'vxt-timeline__outer-wrap' ) } id={ `vxt-ctm-${ block_id }` }>
					<div
						className={ classnames(
							'vxt-timeline__content-wrap',
							...ContentTmClasses( props.attributes )
						) }
					>
						<div className="vxt-timeline-wrapper">
							<div className="vxt-timeline__main">
								<div className="vxt-timeline__days">
									{ tm_content.map( ( post, index ) => {
										const second_index = 'vxt-' + index;
										if ( timelinAlignment == 'center' ) {
											display_inner_date = true;
											content_align_class = AlignClass( props.attributes, index ); // Get classname for layout alignment
											day_align_class = DayAlignClass( props.attributes, index ); //
										}
										const Tag = headingTag;
										const icon_class = 'vxt-timeline__icon-new out-view-vxt-timeline__icon ' + icon;
										let post_date = dateI18n( dateFormat, t_date[ index ].title );
										if ( post_date === 'Invalid date' ) {
											post_date = t_date[ index ].title;
										}
										return (
											<article
												className="vxt-timeline__field vxt-timeline__field-wrap"
												key={ index }
											>
												<div className={ classnames( ...content_align_class ) }>
													<div className="vxt-timeline__marker out-view-vxt-timeline__icon">
														<span className={ icon_class }></span>
													</div>

													<div className={ classnames( ...day_align_class ) }>
														<div className="vxt-events-new">
															<div className="vxt-timeline__events-inner-new">
																<div className="vxt-timeline__date-hide vxt-timeline__date-inner">
																	{ displayPostDate && t_date[ index ].title && (
																		<div
																			className={ 'vxt-timeline__inner-date-new' }
																		>
																			{ post_date }
																		</div>
																	) }
																</div>

																<div className="vxt-timeline-content">
																	<div className="vxt-timeline__heading-text">
																		<RichText.Content
																			tagName={ headingTag }
																			value={ post.time_heading }
																			className="vxt-timeline__heading"
																		/>
																	</div>

																	<RichText.Content
																		tagName="p"
																		value={ post.time_desc }
																		className="vxt-timeline-desc-content"
																	/>

																	<div className="vxt-timeline__arrow"></div>
																</div>
															</div>
														</div>
													</div>

													{ display_inner_date && (
														<div className="vxt-timeline__date-new">
															{ displayPostDate && t_date[ index ].title && (
																<div className={ 'vxt-timeline__date-new' }>
																	{ post_date }
																</div>
															) }
														</div>
													) }
												</div>
											</article>
										);
									} ) }
								</div>
								<div className="vxt-timeline__line">
									<div className="vxt-timeline__line__inner"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			);
		},
	},
	{
		attributes,
		save( props ) {
			const {
				block_id,
				headingTag,
				timelinAlignment,
				displayPostDate,
				icon,
				tm_content,
				t_date,
				date_icon,
				stack,
				timelineItem,
			} = props.attributes;

			const hasItems = Array.isArray( tm_content ) && tm_content.length;

			const dateFormat = getSettings().formats.date;

			let content_align_class = AlignClass( props.attributes, 0 ); // Get classname for layout alignment
			let day_align_class = DayAlignClass( props.attributes, 0 ); //

			let display_inner_date = false;

			return (
				<div
					className={ classnames( props.className, 'vxt-timeline__outer-wrap' ) }
					id={ `vxt-ctm-${ block_id }` }
				>
					<div
						className={ classnames(
							'vxt-timeline__content-wrap',
							...ContentTmClasses( props.attributes )
						) }
					>
						<div className="vxt-timeline-wrapper">
							<div className="vxt-timeline__main">
								<div className="vxt-timeline__days">
									{ tm_content.map( ( post, index ) => {
										if ( timelineItem <= index ) {
											return;
										}

										const second_index = 'vxt-' + index;
										if ( timelinAlignment == 'center' ) {
											display_inner_date = true;
											content_align_class = AlignClass( props.attributes, index ); // Get classname for layout alignment
											day_align_class = DayAlignClass( props.attributes, index ); //
										}
										const Tag = headingTag;
										const icon_class = 'vxt-timeline__icon-new out-view-vxt-timeline__icon ';
										let post_date = dateI18n( dateFormat, t_date[ index ].title );
										if ( post_date === 'Invalid date' ) {
											post_date = t_date[ index ].title;
										}
										return (
											<article
												className="vxt-timeline__field vxt-timeline__field-wrap"
												key={ index }
											>
												<div className={ classnames( ...content_align_class ) }>
													<div className="vxt-timeline__marker out-view-vxt-timeline__icon">
														<span className={ icon_class }>{ renderSVG( icon ) }</span>
													</div>

													<div className={ classnames( ...day_align_class ) }>
														<div className="vxt-events-new">
															<div className="vxt-timeline__events-inner-new">
																<div className="vxt-timeline__date-hide vxt-timeline__date-inner">
																	{ displayPostDate && t_date[ index ].title && (
																		<div
																			className={ 'vxt-timeline__inner-date-new' }
																		>
																			{ post_date }
																		</div>
																	) }
																</div>

																<div className="vxt-timeline-content">
																	<div className="vxt-timeline__heading-text">
																		<RichText.Content
																			tagName={ headingTag }
																			value={ post.time_heading }
																			className="vxt-timeline__heading"
																		/>
																	</div>

																	<RichText.Content
																		tagName="p"
																		value={ post.time_desc }
																		className="vxt-timeline-desc-content"
																	/>

																	<div className="vxt-timeline__arrow"></div>
																</div>
															</div>
														</div>
													</div>

													{ display_inner_date && (
														<div className="vxt-timeline__date-new">
															{ displayPostDate && t_date[ index ].title && (
																<div className={ 'vxt-timeline__date-new' }>
																	{ post_date }
																</div>
															) }
														</div>
													) }
												</div>
											</article>
										);
									} ) }
								</div>
								<div className="vxt-timeline__line">
									<div className="vxt-timeline__line__inner"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			);
		},
	},
	{
		//deprecated
		attributes,
		save( props ) {
			const {
				block_id,
				headingTag,
				timelinAlignment,
				displayPostDate,
				icon,
				tm_content,
				t_date,
				date_icon,
				stack,
				timelineItem,
				dateFormat,
			} = props.attributes;

			const hasItems = Array.isArray( tm_content ) && tm_content.length;

			let content_align_class = AlignClass( props.attributes, 0 ); // Get classname for layout alignment
			let day_align_class = DayAlignClass( props.attributes, 0 ); //

			let display_inner_date = false;

			return (
				<div className={ classnames( props.className, 'vxt-timeline__outer-wrap', `vxt-block-${ block_id }` ) }>
					<div
						className={ classnames(
							'vxt-timeline__content-wrap',
							...ContentTmClasses( props.attributes )
						) }
					>
						<div className="vxt-timeline-wrapper">
							<div className="vxt-timeline__main">
								<div className="vxt-timeline__days">
									{ tm_content.map( ( post, index ) => {
										if ( timelineItem <= index ) {
											return;
										}

										const second_index = 'vxt-' + index;
										if ( timelinAlignment == 'center' ) {
											display_inner_date = true;
											content_align_class = AlignClass( props.attributes, index ); // Get classname for layout alignment
											day_align_class = DayAlignClass( props.attributes, index ); //
										}
										const Tag = headingTag;
										const icon_class = 'vxt-timeline__icon-new out-view-vxt-timeline__icon ';
										let post_date = t_date[ index ].title;
										if ( 'custom' != dateFormat ) {
											post_date = dateI18n( dateFormat, t_date[ index ].title );
											if ( post_date === 'Invalid date' ) {
												post_date = t_date[ index ].title;
											}
										}
										return (
											<article
												className="vxt-timeline__field vxt-timeline__field-wrap"
												key={ index }
											>
												<div className={ classnames( ...content_align_class ) }>
													<div className="vxt-timeline__marker out-view-vxt-timeline__icon">
														<span className={ icon_class }>{ renderSVG( icon ) }</span>
													</div>

													<div className={ classnames( ...day_align_class ) }>
														<div className="vxt-events-new">
															<div className="vxt-timeline__events-inner-new">
																<div className="vxt-timeline__date-hide vxt-timeline__date-inner">
																	{ displayPostDate && t_date[ index ].title && (
																		<div
																			className={ 'vxt-timeline__inner-date-new' }
																		>
																			{ post_date }
																		</div>
																	) }
																</div>

																<div className="vxt-timeline-content">
																	<div className="vxt-timeline__heading-text">
																		<RichText.Content
																			tagName={ headingTag }
																			value={ post.time_heading }
																			className="vxt-timeline__heading"
																		/>
																	</div>

																	<RichText.Content
																		tagName="p"
																		value={ post.time_desc }
																		className="vxt-timeline-desc-content"
																	/>

																	<div className="vxt-timeline__arrow"></div>
																</div>
															</div>
														</div>
													</div>

													{ display_inner_date && (
														<div className="vxt-timeline__date-new">
															{ displayPostDate && t_date[ index ].title && (
																<div className={ 'vxt-timeline__date-new' }>
																	{ post_date }
																</div>
															) }
														</div>
													) }
												</div>
											</article>
										);
									} ) }
								</div>
								<div className="vxt-timeline__line">
									<div className="vxt-timeline__line__inner"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			);
		},
	},
	{
		attributes,
		save( props ) {
			const { block_id } = props.attributes;

			return (
				<div className={ classnames( props.className, 'vxt-timeline__outer-wrap', `vxt-block-${ block_id }` ) }>
					<div
						className={ classnames(
							'vxt-timeline__content-wrap',
							...DeprecatedContentTmClasses( props.attributes )
						) }
					>
						<div className="vxt-timeline-wrapper">
							<div className="vxt-timeline__main">
								<div className="vxt-timeline__days">
									<InnerBlocks.Content />
								</div>
								<div className="vxt-timeline__line">
									<div className="vxt-timeline__line__inner"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			);
		},
	},
];

export default deprecated;
