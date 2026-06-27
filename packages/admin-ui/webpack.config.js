// Load the default @wordpress/scripts config object
const path = require( 'path' );
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const newPath = path.join( __dirname, '../../' );

const commonConfig = {
	...defaultConfig,
	cache: {
		type: 'filesystem',
		buildDependencies: {
			config: [ __filename ],
		},
	},
	resolve: {
		alias: {
			...defaultConfig.resolve.alias,
			'@Admin': path.resolve( __dirname, 'src/' ),
			'@Utils': path.resolve( __dirname, 'src/utils/' ),
			'@Skeleton': path.resolve( __dirname, 'src/skeleton/' ),
			'@Settings': path.resolve(	__dirname, 'src/settings/' ),
			'@Controls': path.resolve( __dirname, 'src/blocks/controls/' ),
			'@Common': path.resolve( __dirname, 'src/common/' ),
			'@Store': path.resolve( newPath, 'src/store/' ),
			'@Learn': path.resolve( __dirname, 'src/learn/' ),
		},
	},
	module: {
		rules: [
			...defaultConfig.module.rules,
			{
				test: /\.m?js$/,
				include: /node_modules/,
				resolve: {
					fullySpecified: false,
				},
			},
			{
                test: /\.(png|jpg|jpeg|gif|ico|svg)$/,
                use: [
                    'file-loader'
                ]
            }
		]
	},
	plugins: [
		...defaultConfig.plugins.filter( function ( plugin ) {
			if ( plugin.constructor.name === 'LiveReloadPlugin' ) {
				return false;
			}

			return true;
		} ),
	],
};

// Now using the commonConfig that inherits the defaultConfig, replace the entry and output properties for each app.

// Config for the Dashboard App.
const dashboardConfig = Object.assign( {}, commonConfig, {
	name: 'dashboard',
	entry: {
		'dashboard-app': path.resolve( __dirname, 'src/Dashboard.js' )
	},
	output: {
		filename: '[name].js',
		path: path.resolve( __dirname, '../../assets/admin-ui' ),
	},
} );

// Export all the configs.
module.exports = [
	dashboardConfig,
];
