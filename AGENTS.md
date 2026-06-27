# AGENTS.md

This file provides guidance to Codex when working with vexaltrix.

## Project Overview

**Vexaltrix Ultimate Gutenberg Blocks** is a fresh, standalone WordPress Gutenberg block plugin built on the V3 architecture using the WordPress Interactivity API.

- **Plugin slug:** `vexaltrix`
- **Text domain:** `vexaltrix`
- **PHP namespace:** `Vexaltrix\` (V3 classes in includes/)
- **Block prefix:** `vexaltrix/` (e.g., `vexaltrix/container`)
- **Block categories:** `vxt-gutenberg-blocks`, `vxt-gutenberg-blocks-inner`
- **Option prefix:** `vxt_wp_blocks_` (e.g., `vxt_wp_blocks_file_generation`)
- **PHP class prefix:** `Vexaltrix_Blocks_` (legacy classes, now migrated to PSR-4 namespaces in `app/`)
- **Function prefix:** `vxt_wp_blocks_` (global functions)
- **Requires:** PHP 8.1+, WordPress 6.6+

## Tech Stack

| Layer | Technology |
|-------|------------|
| PHP Backend | WordPress plugin, PSR-4 autoloading (Composer), PHP >= 8.1 |
| JS Frontend | React, WordPress Interactivity API, @wordpress/scripts (webpack) |
| PHP Testing | PHPUnit |
| E2E Testing | Playwright |

## Directory Structure

```
vexaltrix.php                    Main plugin entry point
app/Core/                        Plugin Engine: container, contracts, events, module system, service discovery
app/Infrastructure/              System plumbing: cache, migration, install, settings repository + schema
app/Domain/                      Business logic & rules: analytics, display conditions
app/Integration/                 Third-party compatibility & integrations
app/Presentation/                UI output: admin dashboard controllers, blocks registration, assets loader
app/Transport/                   I/O endpoints: ajax handlers, REST API controllers, WP-CLI commands
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

## Development Commands

```bash
# Install dependencies
pnpm install
composer install           # Requires SSH access to github.com/brainstormforce private repos

# Build
pnpm build:admin           # Build dashboard into assets/admin-ui/
pnpm build                 # Production build, including assets/build/
pnpm start                 # Dev watch mode

# Code quality
pnpm lint:js
pnpm lint:css
composer lint              # PHPCS
```

## Key Conventions

### Block Registration
- Editor blocks are registered from `src/blocks/**/block.js`
- PHP block definitions and shared configuration live in `includes/blocks/` and `includes/blocks-config/`
- Block names: `vexaltrix/{block-name}` (e.g., `vexaltrix/container`)
- Categories: `vxt-gutenberg-blocks` (main), `vxt-gutenberg-blocks-inner` (child blocks)

### Settings
Use `Vexaltrix_Blocks_Settings::get/update/delete()` -- wraps `get_option()` with `vxt_wp_blocks_` prefix.

### Backward Content Compatibility
The following block attribute names are intentionally kept with UAG prefix for backward compatibility with saved post content. Do NOT rename these:
- UAGDisplayConditions, UAGUserRole, UAGBrowser, UAGSystem, UAGDay
- UAGHideDesktop, UAGHideMob, UAGHideTab, UAGLoggedIn, UAGLoggedOut
- UAGAnimationType, UAGAnimationTime, UAGAnimationDelay, UAGAnimationEasing
- UAGAnimationRepeat, UAGAnimationDelayInterval, UAGAnimationDoNotApplyToContainer
- UAGPosition, UAGResponsiveConditions

### JS Globals
- `window.vxt_wp_blocks_info` - Plugin configuration (url, rtl, etc.)
- `window.vexaltrixBlocksSvgIcons` - SVG icon library
- `window.vexaltrixBlocksIconCategoryList` - Icon categories
- Import from `@vexaltrix-config` for typed accessors

### Admin Dashboard
- URL: `wp-admin/admin.php?page=vexaltrix`
- REST namespace: `vexaltrix/v1`
- AJAX prefix: `ugb_` (`uag_` remains registered for backward compatibility)
- Mount ID: `vxt-dashboard-app`
- Built assets: `assets/admin-ui/dashboard-app.{js,css,asset.php}`

### Architecture Patterns

**Services** (Infrastructure, Domain, Integration, Presentation, Transport) implement `ServiceInterface` and are auto-discovered by `ServiceDiscovery`:
```php
namespace Vexaltrix\Presentation\Admin;

use Vexaltrix\Core\Contracts\ServiceInterface;

class BetaUpdates implements ServiceInterface {
    public static function group(): string    { return 'presentation'; }
    public static function context(): string  { return 'admin'; }
    public static function priority(): int    { return 10; }

    public function boot(): void {
        add_filter( 'pre_set_site_transient_update_plugins', [ $this, 'my_hook' ] );
    }
}
```

**Events System** allows decoupling hook listeners without modifying base:
```php
use Vexaltrix\Core\Events\EventDispatcher;
use Vexaltrix\Infrastructure\Settings\Events\SettingChanged;

$dispatcher->listen( SettingChanged::class, function( SettingChanged $e ) {
    // React to settings change.
} );
```

**Settings System** wraps WP options with schema validation:
```php
use Vexaltrix\Core\Contracts\SettingsInterface;
// Get option using SettingsRepository (automatically injects schema defaults + prefix):
$width = $container->get( SettingsInterface::class )->get( 'content_width' );
```

### PHPDoc / JSDoc
- For the `@since` tag, always use `x.x.x` for new or modified code

### Dynamic CSS
- Use CSS variables instead of enqueueing additional CSS files
- Variables are scoped globally but can be overridden per block
- CSS Variables: `--vexaltrix-{attribute-name}`
- CSS Classes: `vexaltrix-{attribute-name}`

### Naming Reference

| Type | Convention | Example |
|------|-----------|---------|
| Block name | `vexaltrix/{name}` | `vexaltrix/container` |
| Option key | `vxt_wp_blocks_{name}` | `vxt_wp_blocks_file_generation` |
| Script handle | `vxt-gutenberg-blocks-{name}` | `vxt-gutenberg-blocks-aos-js` |
| AJAX action | `vxt_{name}` | `vxt_check_beta_update_available` |
| Nonce name | `vxt_{name}` | `vxt_check_beta_update_available` |
| Filter/action | `vxt_wp_blocks_{name}` | `vxt_wp_blocks_after_cache_purge` |
| Constants | `VXT_{NAME}` | `VXT_VER` |

## Testing

```bash
# PHP Unit Tests
./vendor/bin/phpunit                            # Full suite
./vendor/bin/phpunit --filter TestClassName     # Single test class

# E2E Tests (Playwright)
npx playwright test                             # Full suite
npx playwright test --ui                        # Interactive UI mode
npx playwright test tests/e2e/block-name        # Single test file
npx playwright codegen http://localhost:8888    # Record new test
```

## Environment Setup

> Local WP environment must be running before E2E tests. Recommended: `wp-env` or Local by Flywheel.
> Plugin requires WordPress 6.6+ and PHP 8.1+.
> SSH access to `github.com/brainstormforce` is required for `composer install`.

## Current Focus

> Update this section each sprint or feature cycle.
>
> - [ ] <!-- active task or feature being worked on -->
