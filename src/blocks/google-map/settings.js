import { __ } from '@wordpress/i18n';
import Range from '@Components/range/Range.js';
import { InspectorControls } from '@wordpress/block-editor';
import InspectorTabs from '@Components/inspector-tabs/InspectorTabs.js';
import InspectorTab, { UAGTabs } from '@Components/inspector-tabs/InspectorTab.js';
import UAGSelectControl from '@Components/select-control';
import ResponsiveSlider from '@Components/responsive-slider';
import { ToggleControl } from '@wordpress/components';
import UAGAdvancedPanelBody from '@Components/advanced-panel-body';
import UAGTextControl from '@Components/text-control';
import { memo } from '@wordpress/element';
import UpgradeComponent from '@Components/upgrade-to-pro-cta';

const Settings = ( props ) => {
	const {
		setAttributes,
		attributes: { height, heightTablet, heightMobile, zoom, address, language, enableSatelliteView },
	} = props;

	const maxZoomRange = enableSatelliteView ? 21 : 22;
	return (
		<InspectorControls>
			<InspectorTabs tabs={ [ 'general', 'advance' ] }>
				<InspectorTab { ...UAGTabs.general }>
					<UAGAdvancedPanelBody initialOpen={ true }>
						<p className="vxt-settings-notice">
							{ __(
								"This block uses Vexaltrix's API key to display the map. You don't need to create your own API key or worry about renewing it.",
								'vexaltrix'
							) }
						</p>

						<UAGTextControl
							label={ __( 'Address', 'vexaltrix' ) }
							enableDynamicContent={ true }
							dynamicContentType="text"
							value={ address }
							name="address"
							data={ {
								value: address,
								label: 'address',
							} }
							setAttributes={ setAttributes }
							placeholder={ __( 'Type the address', 'vexaltrix' ) }
						/>
						<ToggleControl
							label={ __( 'Enable Satellite View', 'vexaltrix' ) }
							checked={ enableSatelliteView }
							onChange={ () => setAttributes( { enableSatelliteView: ! enableSatelliteView } ) }
						/>
						<Range
							label={ __( 'Zoom', 'vexaltrix' ) }
							value={ zoom }
							setAttributes={ setAttributes }
							data={ {
								value: zoom,
								label: 'zoom',
							} }
							min={ 1 }
							max={ maxZoomRange }
							displayUnit={ false }
						/>
						<ResponsiveSlider
							label={ __( 'Height', 'vexaltrix' ) }
							data={ {
								desktop: {
									value: height,
									label: 'height',
								},
								tablet: {
									value: heightTablet,
									label: 'heightTablet',
								},
								mobile: {
									value: heightMobile,
									label: 'heightMobile',
								},
							} }
							min={ 0 }
							max={ 1000 }
							displayUnit={ false }
							setAttributes={ setAttributes }
							responsive={ true }
						/>
						<UAGSelectControl
							label={ __( 'Language', 'vexaltrix' ) }
							data={ {
								value: language,
								label: 'language',
							} }
							setAttributes={ setAttributes }
							options={ [
								{
									value: 'af',
									label: __( 'Afrikaans', 'vexaltrix' ),
								},
								{
									value: 'sq',
									label: __( 'Albanian', 'vexaltrix' ),
								},
								{
									value: 'am',
									label: __( 'Amharic', 'vexaltrix' ),
								},
								{
									value: 'ar',
									label: __( 'Arabic', 'vexaltrix' ),
								},
								{
									value: 'hy',
									label: __( 'Armenian', 'vexaltrix' ),
								},
								{
									value: 'az',
									label: __( 'Azerbaijani', 'vexaltrix' ),
								},
								{
									value: 'eu',
									label: __( 'Basque', 'vexaltrix' ),
								},
								{
									value: 'be',
									label: __( 'Belarusian', 'vexaltrix' ),
								},
								{
									value: 'bn',
									label: __( 'Bengali', 'vexaltrix' ),
								},
								{
									value: 'bs',
									label: __( 'Bosnian', 'vexaltrix' ),
								},
								{
									value: 'bg',
									label: __( 'Bulgarian', 'vexaltrix' ),
								},
								{
									value: 'my',
									label: __( 'Burmese', 'vexaltrix' ),
								},
								{
									value: 'ca',
									label: __( 'Catalan', 'vexaltrix' ),
								},
								{
									value: 'zh',
									label: __( 'Chinese', 'vexaltrix' ),
								},
								{
									value: 'hr',
									label: __( 'Croatian', 'vexaltrix' ),
								},
								{
									value: 'cs',
									label: __( 'Czech', 'vexaltrix' ),
								},
								{
									value: 'da',
									label: __( 'Danish', 'vexaltrix' ),
								},
								{
									value: 'nl',
									label: __( 'Dutch', 'vexaltrix' ),
								},
								{
									value: 'en',
									label: __( 'English', 'vexaltrix' ),
								},
								{
									value: 'et',
									label: __( 'Estonian', 'vexaltrix' ),
								},
								{
									value: 'fa',
									label: __( 'Farsi', 'vexaltrix' ),
								},
								{
									value: 'fi',
									label: __( 'Finnish', 'vexaltrix' ),
								},
								{
									value: 'fr',
									label: __( 'French', 'vexaltrix' ),
								},
								{
									value: 'gl',
									label: __( 'Galician', 'vexaltrix' ),
								},
								{
									value: 'ka',
									label: __( 'Georgian', 'vexaltrix' ),
								},
								{
									value: 'de',
									label: __( 'German', 'vexaltrix' ),
								},
								{
									value: 'el',
									label: __( 'Greek', 'vexaltrix' ),
								},
								{
									value: 'gu',
									label: __( 'Gujarati', 'vexaltrix' ),
								},
								{
									value: 'iw',
									label: __( 'Hebrew', 'vexaltrix' ),
								},
								{
									value: 'hi',
									label: __( 'Hindi', 'vexaltrix' ),
								},
								{
									value: 'hu',
									label: __( 'Hungarian', 'vexaltrix' ),
								},
								{
									value: 'is',
									label: __( 'Icelandic', 'vexaltrix' ),
								},
								{
									value: 'id',
									label: __( 'Indonesian', 'vexaltrix' ),
								},
								{
									value: 'it',
									label: __( 'Italian', 'vexaltrix' ),
								},
								{
									value: 'ja',
									label: __( 'Japanese', 'vexaltrix' ),
								},
								{
									value: 'kn',
									label: __( 'Kannada', 'vexaltrix' ),
								},
								{
									value: 'kk',
									label: __( 'Kazakh', 'vexaltrix' ),
								},
								{
									value: 'km',
									label: __( 'Khmer', 'vexaltrix' ),
								},
								{
									value: 'ko',
									label: __( 'Korean', 'vexaltrix' ),
								},
								{
									value: 'ky',
									label: __( 'Kyrgyz', 'vexaltrix' ),
								},
								{
									value: 'lo',
									label: __( 'Lao', 'vexaltrix' ),
								},
								{
									value: 'lv',
									label: __( 'Latvian', 'vexaltrix' ),
								},
								{
									value: 'lt',
									label: __( 'Lithuanian', 'vexaltrix' ),
								},
								{
									value: 'mk',
									label: __( 'Macedonian', 'vexaltrix' ),
								},
								{
									value: 'ms',
									label: __( 'Malay', 'vexaltrix' ),
								},
								{
									value: 'ml',
									label: __( 'Malayalam', 'vexaltrix' ),
								},
								{
									value: 'mr',
									label: __( 'Marathi', 'vexaltrix' ),
								},
								{
									value: 'mn',
									label: __( 'Mongolian', 'vexaltrix' ),
								},
								{
									value: 'ne',
									label: __( 'Nepali', 'vexaltrix' ),
								},
								{
									value: 'no',
									label: __( 'Norwegian', 'vexaltrix' ),
								},
								{
									value: 'pl',
									label: __( 'Polish', 'vexaltrix' ),
								},
								{
									value: 'pt',
									label: __( 'Portuguese', 'vexaltrix' ),
								},
								{
									value: 'pa',
									label: __( 'Punjabi', 'vexaltrix' ),
								},
								{
									value: 'ro',
									label: __( 'Romanian', 'vexaltrix' ),
								},
								{
									value: 'ru',
									label: __( 'Russian', 'vexaltrix' ),
								},
								{
									value: 'sr',
									label: __( 'Serbian', 'vexaltrix' ),
								},
								{
									value: 'si',
									label: __( 'Sinhalese', 'vexaltrix' ),
								},
								{
									value: 'sk',
									label: __( 'Slovak', 'vexaltrix' ),
								},
								{
									value: 'sl',
									label: __( 'Slovenian', 'vexaltrix' ),
								},
								{
									value: 'es',
									label: __( 'Spanish', 'vexaltrix' ),
								},
								{
									value: 'sw',
									label: __( 'Swahili', 'vexaltrix' ),
								},
								{
									value: 'sv',
									label: __( 'Swedish', 'vexaltrix' ),
								},
								{
									value: 'ta',
									label: __( 'Tamil', 'vexaltrix' ),
								},
								{
									value: 'te',
									label: __( 'Telugu', 'vexaltrix' ),
								},
								{
									value: 'th',
									label: __( 'Thai', 'vexaltrix' ),
								},
								{
									value: 'tr',
									label: __( 'Turkish', 'vexaltrix' ),
								},
								{
									value: 'uk',
									label: __( 'Ukrainian', 'vexaltrix' ),
								},
								{
									value: 'ur',
									label: __( 'Urdu', 'vexaltrix' ),
								},
								{
									value: 'uz',
									label: __( 'Uzbek', 'vexaltrix' ),
								},
								{
									value: 'vi',
									label: __( 'Vietnamese', 'vexaltrix' ),
								},
								{
									value: 'zu',
									label: __( 'Zulu', 'vexaltrix' ),
								},
							] }
						/>
					</UAGAdvancedPanelBody>
					{ 'not-installed' === vxt_ultimate_gutenberg_blocks_blocks_info.vexaltrix_pro_status && (
						<UAGAdvancedPanelBody title={ __( 'Dynamic Content', 'vexaltrix' ) }>
							<UpgradeComponent
								control={ {
									title: __(
										'Experience dynamic content with Vexaltrix Pro. No more static displays. Personalize your user experience.',
										'vexaltrix'
									),
									renderAs: 'list',
									campaign: 'dynamic-content',
								} }
							/>
						</UAGAdvancedPanelBody>
					) }
				</InspectorTab>
				<InspectorTab { ...UAGTabs.advance } parentProps={ props }></InspectorTab>
			</InspectorTabs>
		</InspectorControls>
	);
};

export default memo( Settings );
