const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
const path = require( 'path' );
const { spawn } = require( 'child_process' );

class VxtPostBuildPlugin {
	apply( compiler ) {
		compiler.hooks.afterEmit.tapAsync( 'VxtPostBuildPlugin', ( compilation, callback ) => {
			const runScript = ( scriptPath ) =>
				new Promise( ( resolve, reject ) => {
					const proc = spawn( 'node', [ scriptPath ], {
						stdio: 'inherit',
						cwd: __dirname,
					} );
					proc.on( 'close', ( code ) =>
						code === 0 ? resolve() : reject( new Error( `${ scriptPath } exited with code ${ code }` ) )
					);
					proc.on( 'error', reject );
				} );

			runScript( 'packages/scripts/generate-assets-files.js' )
				.then( () => runScript( 'packages/scripts/generate-blocks-placeholder.js' ) )
				.then( () => callback() )
				.catch( ( err ) => callback( err ) );
		} );
	}
}

const wp_rules = defaultConfig.module.rules.filter( function ( item ) {
	if ( item.test instanceof RegExp && item.test.test( 'index.jsx' ) ) {
		return true;
	}

	if ( item.test instanceof RegExp && item.test.test( 'style.scss' ) ) {
		item.exclude = [ /node_modules/, /editor/ ];
		return true;
	}
	return false;
} );

module.exports = {
	...defaultConfig,
	cache: {
		type: 'filesystem',
		buildDependencies: {
			config: [ __filename ],
		},
	},
	plugins: [ ...defaultConfig.plugins, new VxtPostBuildPlugin() ],
	entry: {
		blocks: path.resolve( __dirname, 'src/blocks.js' ),
	},
	resolve: {
		alias: {
			...defaultConfig.resolve.alias,
			'@Controls': path.resolve( __dirname, 'packages/admin-ui/src/blocks/controls/' ),
			'@Components': path.resolve( __dirname, 'src/components/' ),
			'@Utils': path.resolve( __dirname, 'packages/admin-ui/src/blocks/utils/' ),
			'@Blocks': path.resolve( __dirname, 'src/blocks/' ),
			'@Attributes': path.resolve( __dirname, 'packages/admin-ui/src/blocks/attributes/' ),
			'@Store': path.resolve( __dirname, 'src/store/' ),
		},
	},
	module: {
		rules: [
			...wp_rules,
			{
				test: /\.(scss|css)$/,
				exclude: [ /node_modules/, /style/, /common.scss/ ],
				use: [
					{
						loader: 'style-loader',
						options: {
							injectType: 'lazySingletonStyleTag',
							attributes: { id: 'vexaltrix-editor-styles' },
						},
					},
					'css-loader',
					'sass-loader',
				],
			},
		],
	},
	output: {
		...defaultConfig.output,
		path: path.resolve( __dirname, 'assets/build' ),
	},
};
