import React, { useEffect, useState } from 'react';
import { Sidebar, Menu } from '@bsf/force-ui';
import { Link, useLocation, useHistory } from 'react-router-dom';
import { useDispatch, useSelector } from 'react-redux';
import { ChevronDown } from 'lucide-react';

const UagbSidebar = ( { navigation } ) => {
	const query = new URLSearchParams( useLocation()?.search );
	const dispatch = useDispatch();
	const history = useHistory();

	const [ isMobile, setIsMobile ] = useState( window.innerWidth < 1024 );

	const activeSettingsNavigationTab = useSelector( ( state ) => state.activeSettingsNavigationTab );
	const initialStateSetFlag = useSelector( ( state ) => state.initialStateSetFlag );

	useEffect( () => {
		const handleResize = () => {
			setIsMobile( window.innerWidth < 1024 );
		};

		window.addEventListener( 'resize', handleResize );

		return () => {
			window.removeEventListener( 'resize', handleResize );
		};
	}, [] );

	useEffect( () => {
		// Activate Setting Active Tab from "settingsTab" Hash in the URl is present.
		const activePath = query.get( 'path' );
		const activeHash = query.get( 'settings' );
		let activeSettingsTabFromHash = activeHash && 'settings' === activePath ? activeHash : 'global-settings';
		if ( vexaltrixAdmin.vexaltrix_pro_status && vexaltrixAdmin.vexaltrix_pro_licensing && ! vexaltrixAdmin.license_status ) {
			activeSettingsTabFromHash = activeHash && 'settings' === activePath ? activeHash : 'license';
			history.push( {
				pathname: 'admin.php',
				search: `?page=vexaltrix&path=settings&settings=${ activeSettingsTabFromHash }`,
			} );
		}
		dispatch( { type: 'UPDATE_SETTINGS_ACTIVE_NAVIGATION_TAB', payload: activeSettingsTabFromHash } );
	}, [ initialStateSetFlag ] );

	return (
		<div className="h-full">
			<Sidebar borderOn className="lg:w-64 vxt-settings-sidebar">
				<Sidebar.Body>
					<Sidebar.Item>
						<Menu className="w-full p-0 gap-4" size="md">
							{ navigation.map( ( menuList ) => {
								const heading = ! isMobile && menuList.name ? (
									<div className="relative flex items-center w-full min-w-[13rem] pr-5">
										<span>{ menuList.name }</span>
										<ChevronDown
											className="absolute right-0 top-1/2 -translate-y-1/2"
											size={ 14 }
											strokeWidth={ 1.5 }
										/>
									</div>
								) : '';

								return (
									<Menu.List key={ menuList.name || menuList.children[ 0 ]?.slug } heading={ heading } open>
										{ menuList.children.map( ( item ) => (
											<Link
												to={ {
													pathname: 'admin.php',
													search: `?page=vexaltrix&path=settings&settings=${ item.slug }`,
												} }
												key={ item.name }
												onClick={ () => {
													dispatch( {
														type: 'UPDATE_SETTINGS_ACTIVE_NAVIGATION_TAB',
														payload: item.slug,
													} );
												} }
												className="no-underline"
											>
												<Menu.Item active={ activeSettingsNavigationTab === item.slug }>
													{ item.icon }
													<div className="lg:block hidden text-sm">{ item.name }</div>
												</Menu.Item>
											</Link>
										) ) }
									</Menu.List>
								);
							} ) }
						</Menu>
					</Sidebar.Item>
				</Sidebar.Body>
			</Sidebar>
		</div>
	);
};

export default UagbSidebar;
