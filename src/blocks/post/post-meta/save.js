import { __ } from '@wordpress/i18n';
export default function save() {
	return (
		<>
			<span className="uagb-post__author">
				<span className="dashicons-admin-users dashicons"></span>
				{ __( 'Author Name', 'vexaltrix' ) }
			</span>

			<time className="uagb-post__date">
				<span className="dashicons-calendar dashicons"></span>
				{ __( 'Post Date', 'vexaltrix' ) }
			</time>
			<span className="uagb-post__comment">
				<span className="dashicons-admin-comments dashicons"></span>
				{ __( 'Comments', 'vexaltrix' ) }
			</span>
			<span className="uagb-post__taxonomy">
				<span className="dashicons-tag dashicons"></span>
				{ __( 'Category', 'vexaltrix' ) }
			</span>
		</>
	);
}
