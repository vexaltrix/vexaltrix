#!/usr/bin/env node
/**
 * packages/scripts/zip.mjs
 *
 * Packages the plugin into a `vexaltrix-<version>.zip` file ready to be
 * uploaded to WordPress (Plugins → Add New → Upload Plugin) or submitted to WP.org.
 *
 * Only includes the files required to RUN the plugin (excludes src/, packages/,
 * node_modules, dev config, etc.). Requires `pnpm build` to have been run first
 * so that assets/build/ is up to date.
 *
 * Run: pnpm run zip  (from the monorepo root)
 */

import { createWriteStream, existsSync, readFileSync } from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';
import archiver from 'archiver';
import fg from 'fast-glob';

const __dirname = path.dirname( fileURLToPath( import.meta.url ) );
const ROOT_DIR = path.resolve( __dirname, '../..' );

/** Patterns that will be included in the zip file (relative to ROOT_DIR). */
const INCLUDE_PATTERNS = [
	'vexaltrix.php',
	'uninstall.php',
	'composer.json',
	'app/**/*',
	'includes/**/*',
	'assets/**/*',
	'templates/**/*',
	'languages/**/*',
	'vendor/**/*',
	'readme.txt',
];

/** Patterns to explicitly exclude even if matched by an include pattern above. */
const EXCLUDE_PATTERNS = [ '**/node_modules/**', '**/*.map', '**/.DS_Store' ];

function getPluginVersion() {
	const pluginFile = path.join( ROOT_DIR, 'vexaltrix.php' );
	const content = readFileSync( pluginFile, 'utf8' );
	const match = content.match( /Version:\s*([\w.\-]+)/i );
	return match ? match[ 1 ] : '0.0.0';
}

async function buildZip() {
	if ( ! existsSync( path.join( ROOT_DIR, 'assets', 'build' ) ) ) {
		console.error(
			'[zip] assets/build was not found — run `pnpm build` before zipping.'
		);
		process.exitCode = 1;
		return;
	}

	const version = getPluginVersion();
	const outputName = `vexaltrix-${ version }.zip`;
	const outputPath = path.join( ROOT_DIR, outputName );

	const files = await fg( INCLUDE_PATTERNS, {
		cwd: ROOT_DIR,
		ignore: EXCLUDE_PATTERNS,
		dot: false,
		onlyFiles: true,
	} );

	if ( files.length === 0 ) {
		console.error( '[zip] No files found to package.' );
		process.exitCode = 1;
		return;
	}

	console.log(
		`[zip] Packaging ${ files.length } files into ${ outputName } ...`
	);

	await new Promise( ( resolve, reject ) => {
		const output = createWriteStream( outputPath );
		const archive = archiver( 'zip', { zlib: { level: 9 } } );

		output.on( 'close', resolve );
		archive.on( 'error', reject );
		archive.pipe( output );

		for ( const file of files ) {
			const absolutePath = path.join( ROOT_DIR, file );
			// Place every file inside a "vexaltrix/" subfolder in the zip, matching
			// the structure WordPress expects when extracted into wp-content/plugins.
			archive.file( absolutePath, {
				name: path.join( 'vexaltrix', file ),
			} );
		}

		archive.finalize();
	} );

	console.log( `[zip] Done: ${ outputPath }` );
}

buildZip().catch( ( err ) => {
	console.error( '[zip] Error:', err );
	process.exitCode = 1;
} );
