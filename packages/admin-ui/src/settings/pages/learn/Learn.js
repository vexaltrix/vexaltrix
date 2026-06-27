import { __ } from '@wordpress/i18n';
import { Container, Text, Button } from '@bsf/force-ui';
import BsfLearn from '@Learn';
// import AstSection from '@Settings/common/AstSection';
import { Video } from 'lucide-react';
import { useState, useRef } from 'react';
import { VXT_LINKS } from '@Store/constants';

const Learn = () => {
	const [showVideo, setShowVideo] = useState( false );
	const iframeRef = useRef( null );

	const handleToggleVideo = () => {
		setShowVideo( ( prevState ) => !prevState );
	};

	return (
		<main className="bg-background-secondary min-h-[calc(100vh_-_8rem)]">
			<h1 className="sr-only">{__( 'Learn Vexaltrix', 'vexaltrix' )}</h1>
			<Container className="md:p-8 sm:p-6 p-[0.7rem]" cols={12} containerType="grid" gap="2xl">
				<Container.Item
					className="flex flex-col gap-8"
					colSpan={{ lg: 8, md: 10, sm: 12 }}
					colStart={{ lg: 3, md: 2, sm: 0 }}
				>
					<section className="p-4 bg-background-primary rounded-xl flex flex-col gap-3 flex flex-col gap-6 sm:gap-8">
						<div className="px-1 flex items-left justify-between relative flex-col items-start gap-2">
							<Text size={16} weight={600}>{__( 'Learn Vexaltrix', 'vexaltrix' )}</Text>

							<Text size={14}>
								{__(
									'Edit your pages using Vexaltrix with step-by-step guide and make them live with confidence.',
									'vexaltrix'
								)}
							</Text>

							<Button
								className="absolute right-0 whitespace-nowrap"
								variant="ghost"
								size="xs"
								icon={<Video className="w-4 h-4" />}
								onClick={handleToggleVideo}
							>
								<span className="hidden sm:inline-block">
									{showVideo ? __( 'Hide Video', 'vexaltrix' ) : __( 'Watch Video', 'vexaltrix' )}
								</span>
							</Button>
						</div>

						<div className="w-full">
							<div
								className={`transition-all duration-700 ease-in-out ${showVideo ? 'max-h-[800px] opacity-100 mb-8' : 'max-h-0 opacity-0 mb-0'
									}`}
							>
								{showVideo && (
									<div className="relative rounded-lg shadow-lg aspect-video overflow-hidden">
										<iframe
											ref={iframeRef}
											className="w-full h-full"
											src={ `${ VXT_LINKS.YOUTUBE_EMBED }${
												'Activated' === vexaltrixAdmin.pro_plugin_status ? '3zDGUBaDwiU' : 'GLNzTxArR6Y'
											}?autoplay=1&enablejsapi=1` }
											title="Youtube Video Player"
											allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
											allowFullScreen
										></iframe>
									</div>
								)}
							</div>

							<BsfLearn
								className="bg-background-secondary p-2 rounded-lg"
								endpoints={{
									get: '/vxt-ugb/v1/admin/commonsettings/get-learn-chapters',
									set: '/vxt-ugb/v1/admin/commonsettings/update-learn-progress',
								}}
							/>
						</div>
					</section>
				</Container.Item>
			</Container>
		</main>
	);
};

export default Learn;
