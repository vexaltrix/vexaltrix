#!/usr/bin/env node
/**
 * packages/scripts/i18n.mjs
 *
 * Generates the plugin's `.pot` translation file using WP-CLI
 * (`wp i18n make-pot`). Scans both PHP (app/) and built JS (assets/build)
 * to collect every string passed to __(), _e(), __('...', 'vexaltrix'), etc.
 *
 * Requires: WP-CLI installed and available in PATH.
 * Install: https://wp-cli.org/#installing
 *
 * Run: pnpm run i18n  (from the monorepo root)
 */

import { spawnSync } from 'node:child_process';
import { existsSync } from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const __dirname = path.dirname( fileURLToPath( import.meta.url ) );
const ROOT_DIR = path.resolve( __dirname, '../..' );
const OUTPUT_FILE = path.join( ROOT_DIR, 'languages', 'vexaltrix.pot' );
const DOMAIN = 'vexaltrix';

function commandExists( cmd ) {
	const result = spawnSync( cmd, [ '--version' ], { stdio: 'ignore' } );
	return result.status === 0;
}

function run() {
	if ( ! commandExists( 'wp' ) ) {
		console.error(
			'[i18n] WP-CLI was not found in PATH.\n' +
				'       Install it from: https://wp-cli.org/#installing\n' +
				'       Then re-run: pnpm run i18n'
		);
		process.exitCode = 1;
		return;
	}

	if ( ! existsSync( path.join( ROOT_DIR, 'vexaltrix.php' ) ) ) {
		console.error(
			'[i18n] Could not find vexaltrix.php at the plugin root.'
		);
		process.exitCode = 1;
		return;
	}

	console.log( '[i18n] Generating .pot file...' );

	const result = spawnSync(
		'wp',
		[
			'i18n',
			'make-pot',
			ROOT_DIR,
			OUTPUT_FILE,
			`--domain=${ DOMAIN }`,
			'--exclude=node_modules,vendor,assets/build,packages/*/node_modules',
		],
		{ stdio: 'inherit', cwd: ROOT_DIR }
	);

	if ( result.status !== 0 ) {
		console.error( '[i18n] Failed to generate the .pot file.' );
		process.exitCode = result.status ?? 1;
		return;
	}

	console.log( `[i18n] Done: ${ OUTPUT_FILE }` );
}

run();
