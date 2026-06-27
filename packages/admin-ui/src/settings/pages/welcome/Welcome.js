import { Container } from '@bsf/force-ui';

import UnlockProFeatures from '@Common/components/UnlockProFeatures';
import ExtendYourWebsite from '@Common/components/ExtendYourWebsite';
import BuildWebsite from '@Common/components/BuildWebsite';
import QuickAccess from '@Common/components/QuickAccess';

import Blocks from './Blocks/Blocks';
import ProFeatures from './ProFeatures/ProFeatures';
import BetaUpdateNotice from './BetaUpdateNotice/BetaUpdateNotice';

const Welcome = () => {
	return (
		<div className="bg-background-secondary">
			<Container className="md:p-8 sm:p-6 p-[0.7rem]" cols={ 12 } containerType="grid" gap="2xl">
				<Container.Item className="flex flex-col gap-8" colSpan={ { lg: 8, md: 12, sm: 12 } }>

					<Blocks />

					<BetaUpdateNotice />

				</Container.Item>

				<Container.Item className="flex flex-col gap-8" colSpan={ { lg: 4, md: 12, sm: 12 } }>

					<QuickAccess />
					<ExtendYourWebsite />

				</Container.Item>
			</Container>
		</div>
	);
};

export default Welcome;
