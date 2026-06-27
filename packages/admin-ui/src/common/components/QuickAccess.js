import { __ } from '@wordpress/i18n';
import { Container, Label, Badge } from '@bsf/force-ui';
import { Headset, CircleHelp, MessageSquare, Star, Rocket } from 'lucide-react';
import { VXT_LINKS } from '@Store/constants';

const QuickAccess = () => {
	return (
		<Container
			className="bg-white border border-solid border-border-subtle rounded-lg p-3"
			containerType="flex"
			direction="column"
			gap="xs"
		>
			<Container.Item className="md:w-full lg:w-full p-1">
				<Label className="font-semibold text-text-primary">
					{ __( 'Quick Access', 'vexaltrix' ) }
				</Label>
			</Container.Item>
			<Container.Item className="flex flex-col md:w-full lg:w-full bg-field-primary-background gap-1 p-1 rounded-lg">
				<div className="p-2 gap-1 items-center flex bg-background-primary rounded-md shadow-soft-shadow-inner">
					<a
						className="no-underline hover:underline hover:text-field-label"
						href={ vexaltrixAdmin.admin_url + '?page=vxt-onboarding' }
					>
						<Container align="center" className="gap-1 p-1" containerType="flex" direction="row">
							<Container.Item className="flex">
								<Rocket size={ 14 } className="m-1 no-underline text-text-primary" />
							</Container.Item>
							<Container.Item className="flex">
								<Label className="py-0 px-1 font-normal cursor-pointer">{ __( 'Setup Wizard', 'vexaltrix' ) }</Label>
							</Container.Item>
						</Container>
					</a>
				</div>
				<div className="p-2 gap-1 items-center flex bg-background-primary rounded-md shadow-soft-shadow-inner">
					<a
						className="no-underline hover:underline hover:text-field-label"
						href={vexaltrixAdmin.vxt_links?.vipPrioritySupportUrl}
						target="_blank"
						rel="noreferrer"
					>
						<Container align="center" className="gap-1 p-1" containerType="flex" direction="row">
							<Container.Item className="flex">
								<Headset size={ 14 } className="m-1 no-underline text-text-primary" />
							</Container.Item>
							<Container.Item className="flex">
								<Label className="py-0 px-1 font-normal cursor-pointer">{ __( 'VIP Support', 'vexaltrix' ) }</Label>
							</Container.Item>
							{ vexaltrixAdmin.pro_plugin_status !== 'Activated' && (
								<Container.Item>
									<Badge icon={ null } label="PRO" size="xxs" variant="inverse" />
								</Container.Item>
							) }
						</Container>
					</a>
				</div>
				<div className="p-2 gap-1 flex items-center bg-background-primary rounded-md shadow-soft-shadow-inner">
					<a
						className="no-underline hover:underline hover:text-field-label"
						href={vexaltrixAdmin.vxt_links?.docsUrl}
						target="_blank"
						rel="noreferrer"
					>
						<Container align="center" className="gap-1 p-1" containerType="flex" direction="row">
							<Container.Item className="flex">
								<CircleHelp size={ 14 } className="m-1 no-underline text-text-primary" />
							</Container.Item>
							<Container.Item className="flex">
								<Label className="py-0 px-1 font-normal cursor-pointer">{ __( 'Help Center', 'vexaltrix' ) }</Label>
							</Container.Item>
						</Container>
					</a>
				</div>
				<div className="p-2 gap-1 flex items-center bg-background-primary rounded-md shadow-soft-shadow-inner">
					<a
						className="no-underline hover:underline hover:text-field-label"
						href={ VXT_LINKS.COMMUNITY }
						target="_blank"
						rel="noreferrer"
					>
						<Container align="center" className="gap-1 p-1" containerType="flex" direction="row">
							<Container.Item className="flex">
								<MessageSquare size={ 14 } className="m-1 no-underline text-text-primary" />
							</Container.Item>
							<Container.Item className="flex">
								<Label className="py-0 px-1 font-normal cursor-pointer">{ __( 'Join The Community', 'vexaltrix' ) }</Label>
							</Container.Item>
						</Container>
					</a>
				</div>
				<div className="p-2 gap-1 flex items-center bg-background-primary rounded-md shadow-soft-shadow-inner">
					<a
						className="no-underline hover:underline hover:text-field-label"
						href={ VXT_LINKS.REVIEW }
						target="_blank"
						rel="noreferrer"
					>
						<Container align="center" className="gap-1 p-1" containerType="flex" direction="row">
							<Container.Item className="flex">
								<Star size={ 14 } className="m-1 no-underline text-text-primary" />
							</Container.Item>
							<Container.Item className="flex">
								<Label className="py-0 px-1 font-normal cursor-pointer">{ __( 'Rate Us', 'vexaltrix' ) }</Label>
							</Container.Item>
						</Container>
					</a>
				</div>
			</Container.Item>
		</Container>
	);
};

export default QuickAccess;
