# Vexaltrix Ultimate Gutenberg Blocks

Standalone WordPress Gutenberg block plugin using the Vexaltrix V3 architecture and WordPress Interactivity API.

## Structure

```text
vexaltrix.php                    Main plugin entry point
classes/                         WordPress plugin infrastructure
classes/Core/Analytics/          Block usage analytics and event tracking
classes/Core/Base/               Base controllers and service provider contracts
classes/Core/Blocks/             Block registration, assets, and helpers
classes/Core/Cache/              Cache purge integrations
classes/Core/Commands/           WP-CLI commands
includes/                        Block PHP, configuration, and integrations
src/                             Block editor JS/SCSS source
packages/admin-ui/               Admin dashboard React source
assets/admin-ui/                 Generated admin dashboard bundles
assets/build/                    Generated block bundles
assets/css/                      Generated and shared CSS assets
assets/js/                       Shared JavaScript assets
assets/admin/                    Static admin assets
scripts/                         Build and maintenance scripts
tests/                           Automated tests
```

## Development

```bash
pnpm install
composer install
```

## Build

```bash
pnpm build:admin
pnpm build
```

`pnpm build:admin` compiles `packages/admin-ui/src/Dashboard.js` into `assets/admin-ui/dashboard-app.*`.

`pnpm build` runs the admin build, regenerates block assets, placeholders, RTL CSS, and minified static assets.

## Code Quality

```bash
pnpm lint
pnpm format
pnpm check-engines
composer lint
```

Generated bundles in `assets/admin-ui/` are ignored by formatter and linters; lint the source in `packages/admin-ui/src/` instead.
