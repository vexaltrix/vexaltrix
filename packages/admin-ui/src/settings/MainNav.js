import { Link, useLocation } from 'react-router-dom';
import { __ } from '@wordpress/i18n';
import { ArrowUpRight } from 'lucide-react';

const Navigation = () => {
	const menus = [
		{
			name: __( 'Dashboard', 'vexaltrix' ),
			slug: vexaltrixAdmin.home_slug,
			path: '',
		},
		{
			name: __( 'Blocks', 'vexaltrix' ),
			slug: vexaltrixAdmin.home_slug,
			path: 'blocks',
		},
		{
			name: __( 'Settings', 'vexaltrix' ),
			slug: vexaltrixAdmin.home_slug,
			path: 'settings',
		},
	];

	// Add Learn tab.
	menus.push( {
		name: __( 'Learn', 'vexaltrix' ),
		slug: vexaltrixAdmin.home_slug,
		path: 'learn',
	} );

	// Conditionally add the Free vs Pro menu item
	if ( vexaltrixAdmin.pro_plugin_status === 'Install' ) {
		menus.push( {
			name: __( 'Free vs Pro', 'vexaltrix' ),
			slug: vexaltrixAdmin.home_slug,
			path: 'free-vs-pro',
		} );
	}

	// Only add the AI Features tab before settings if Zip AI data was successfully localized.
	if ( vexaltrixAdmin?.zip_ai_admin_nonce ) {
		menus.splice( 2, 0, {
			name: __( 'AI Features', 'vexaltrix' ),
			slug: vexaltrixAdmin.home_slug,
			path: 'ai-features',
		} );
	}

	const query = new URLSearchParams( useLocation()?.search );
	const activePage = query.get( 'page' ) ? query.get( 'page' ) : vexaltrixAdmin.home_slug;
	const activePath = query.get( 'path' ) ? query.get( 'path' ) : '';

	return (
		<>
			{ menus.map( ( menu, key ) => (
				<Link
					index={ key }
					key={ `?page=${ menu.slug }&path=${ menu.path }` }
					to={ {
						pathname: 'admin.php',
						search: `?page=${ menu.slug }${ '' !== menu.path ? '&path=' + menu.path : '' }`,
					} }
					className={ `content-center no-underline relative h-full py-0 px-1 m-0 bg-transparent outline-none shadow-none border-0 focus:outline-none ${
						activePage === menu.slug && activePath === menu.path ? 'text-text-primary' : 'text-[#4B5563]'
					} text-sm font-medium cursor-pointer` }
				>
					{ menu.name }
					{ activePage === menu.slug && activePath === menu.path && (
						<span className="absolute md:bottom-0 -bottom-6 left-0 w-full h-px bg-brand-primary-600 lg:block hidden"></span>
					) }
				</Link>
			) ) }
			{ vexaltrixAdmin.pro_plugin_status === 'Install' && !!vexaltrixAdmin.vxt_links?.topBar && (
				<a
					className="content-center no-underline h-full inline-flex items-center py-0 px-1 m-0 bg-transparent outline-none shadow-none border-0 focus:outline-none cursor-pointer text-sm font-semibold text-brand-primary-600"
					href={vexaltrixAdmin.vxt_links?.topBar}
					target="_blank"
					rel="noreferrer"
				>
					<span>Unlock Pro Features</span>
					<ArrowUpRight className="size-5" strokeWidth="1.5" />
				</a>
			) }
		</>
	);
};

export default Navigation;
