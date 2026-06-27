import { __ } from '@wordpress/i18n';
export default function save() {
	return (
		<h3 className="vxt-post__text vxt-post__title">
			<a href="/" target="_blank" rel="noopener noreferrer" alt="">
				{ ' ' }
				{ __( 'WordPress Post Title', 'vexaltrix' ) }
			</a>
		</h3>
	);
}
