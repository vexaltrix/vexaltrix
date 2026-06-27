/**
 * Review Schema Notices component.
 *
 */
import { __ } from '@wordpress/i18n';
import { VXT_LINKS } from '@Store/constants';

const SchemaNotices = ( props ) => {
	const {
		enableSchema,
		itemType,
		rTitle,
		enableDescription,
		rContent,
		enableImage,
		mainimage,
		sku,
		brand,
		showAuthor,
		rAuthor,
		offerType,
		offerCurrency,
		offerPrice,
		ctaLink,
		offerExpiry,
		datepublish,
		identifier,
		isbn,
		bookAuthorName,
		directorname,
		datecreated,
		provider,
		appCategory,
		reviewPublisher,
		operatingSystem,
	} = props;

	const emptyItems = [];
	let msg;

	switch ( itemType ) {
		case 'Product':
			if ( 'undefined' === typeof sku || '' === sku ) {
				msg = __( 'Missing merchant-specific identifier for product ( SKU )', 'vexaltrix' );
				emptyItems.push( msg );
			}
			if ( 'undefined' === typeof brand || '' === brand ) {
				msg = __( 'Missing brand of the product', 'vexaltrix' );
				emptyItems.push( msg );
			}
			if ( 'undefined' === typeof offerType || '' === offerType ) {
				msg = __( 'Missing offer Type', 'vexaltrix' );
				emptyItems.push( msg );
			}
			if ( 'undefined' === typeof offerCurrency || '' === offerCurrency ) {
				msg = __( 'Missing offer currency of a product', 'vexaltrix' );
				emptyItems.push( msg );
			}
			if ( 'undefined' === typeof offerPrice || '' === offerPrice ) {
				msg = __( 'Missing offer price of a product', 'vexaltrix' );
				emptyItems.push( msg );
			}
			if ( 'undefined' === typeof offerExpiry || '' === offerExpiry ) {
				msg = __( 'Missing offer expiry of a product', 'vexaltrix' );
				emptyItems.push( msg );
			}
			if ( 'undefined' === typeof identifier || '' === identifier ) {
				msg = __( 'Missing global identifiers', 'vexaltrix' );
				emptyItems.push( msg );
			}
			break;

		case 'Book':
			if ( 'undefined' === typeof isbn || '' === isbn ) {
				msg = __( 'Missing ISBN number of a book', 'vexaltrix' );
				emptyItems.push( msg );
			}
			if ( 'undefined' === typeof bookAuthorName || '' === bookAuthorName ) {
				msg = __( 'Missing author of the book', 'vexaltrix' );
				emptyItems.push( msg );
			}
			break;

		case 'Movie':
			if ( 'undefined' === typeof datecreated || '' === datecreated ) {
				msg = __( 'Missing released date of the movie', 'vexaltrix' );
				emptyItems.push( msg );
			}
			if ( 'undefined' === typeof directorname || '' === directorname ) {
				msg = __( 'Missing director name of the movie', 'vexaltrix' );
				emptyItems.push( msg );
			}
			break;

		case 'Course':
			if ( 'undefined' === typeof provider || '' === provider ) {
				msg = __( 'Missing provider of the course', 'vexaltrix' );
				emptyItems.push( msg );
			}
			break;

		case 'SoftwareApplication':
			if ( 'undefined' === typeof appCategory || '' === appCategory ) {
				msg = __( 'Missing type of application (Application Category)', 'vexaltrix' );
				emptyItems.push( msg );
			}
			if ( 'undefined' === typeof operatingSystem || '' === operatingSystem ) {
				msg = __( 'Missing operating system(s) required', 'vexaltrix' );
				emptyItems.push( msg );
			}
			if ( 'undefined' === typeof offerType || '' === offerType ) {
				msg = __( 'Missing Offer Type', 'vexaltrix' );
				emptyItems.push( msg );
			}
			if ( 'undefined' === typeof offerPrice || '' === offerPrice ) {
				msg = __( 'Missing offer price of the application', 'vexaltrix' );
				emptyItems.push( msg );
			}
			if ( 'undefined' === typeof offerCurrency || '' === offerCurrency ) {
				msg = __( 'Missing offer currency of the application', 'vexaltrix' );
				emptyItems.push( msg );
			}
			break;

		default:
			//empty
			break;
	}

	if ( itemType ) {
		if ( 'undefined' === typeof rTitle || '' === rTitle ) {
			msg = __( 'Missing title of the review', 'vexaltrix' );
			emptyItems.push( msg );
		}
		if ( 'undefined' === typeof rContent || '' === rContent || false === enableDescription ) {
			msg = __( 'Missing review description', 'vexaltrix' );
			emptyItems.push( msg );
		}
		if (
			! mainimage ||
			mainimage === 'null' ||
			mainimage.url === 'null' ||
			mainimage.url === '' ||
			false === enableImage
		) {
			msg = __( 'Missing review Image', 'vexaltrix' );
			emptyItems.push( msg );
		}
		if ( 'undefined' === typeof ctaLink || '' === ctaLink ) {
			msg = __( 'Missing url field', 'vexaltrix' );
			emptyItems.push( msg );
		}
		if ( 'undefined' === typeof rAuthor || '' === rAuthor || false === showAuthor ) {
			msg = __( 'Missing review author name', 'vexaltrix' );
			emptyItems.push( msg );
		}
		if ( 'undefined' === typeof reviewPublisher || '' === reviewPublisher ) {
			msg = __( 'Missing review publisher', 'vexaltrix' );
			emptyItems.push( msg );
		}
		if ( 'undefined' === typeof datepublish || '' === datepublish ) {
			msg = __( 'Missing date of publish', 'vexaltrix' );
			emptyItems.push( msg );
		}
	}

	const listItems = emptyItems.map( ( item ) => <li key={ item }> { item } </li> );

	const schemaNoticeMarkup = () => {
		if ( enableSchema === true ) {
			if ( 0 !== emptyItems.length ) {
				return (
					<div className="rating-schema-notices">
						<h6>
							{ ' ' }
							{ __(
								'It seems that the following fields are empty. This may generate Schema errors / warnings for your Page, we recommend you to fill these fields.',
								'vexaltrix'
							) }{ ' ' }
						</h6>
						<ul className="rating-schema-notices-list">{ listItems }</ul>
						<p>
							{ __(
								'P.S. Note that this notice is visible only in the editor. This will not be visible in frontend. Also, once the required fields are added, this notice will go away.',
								'vexaltrix'
							) }
							&nbsp;
							<a
								href={ `${ VXT_LINKS.GOOGLE_DOCS_URL }/search/docs/data-types/review-snippet` }
								target="_blank"
								rel="noreferrer"
							>
								{ __( 'Read more.', 'vexaltrix' ) }
							</a>
						</p>
					</div>
				);
			}
		}
		return '';
	};

	return schemaNoticeMarkup();
};

export default SchemaNotices;
