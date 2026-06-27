<?php
/**
 * Contract every module must fulfil.
 *
 * @package Vexaltrix\Core\Module
 * @author  Huu Ha <huuhadev@gmail.com>
 * @link    https://vexaltrix.com
 */
declare(strict_types=1);

namespace Vexaltrix\Core\Module;

interface ModuleInterface {

    /**
     * Unique slug used as option key, asset handle prefix, REST namespace suffix.
     * e.g. 'example', 'contact-form', 'analytics'
     */
    public function slug(): string;

    /**
     * Human-readable label shown in the Modules settings UI.
     */
    public function label(): string;

    /**
     * Short description shown in the Modules settings UI.
     */
    public function description(): string;

    /**
     * Module version — shown in the UI and used for asset versioning.
     */
    public function version(): string;

    /**
     * Slugs of other modules this module depends on.
     * Registry prevents enabling this module unless all deps are also enabled.
     *
     * @return string[]
     */
    public function dependencies(): array;

    /**
     * Called once by the registry when the module is enabled and WP is ready.
     * Register actions, filters, REST routes, blocks, post types, etc. here.
     */
    public function boot(): void;

    /**
     * Return JS asset metadata for the admin settings panel.
     * The returned script is loaded on the Vexaltrix admin page
     * so the module can render its own React settings card.
     *
     * @return array{url: string, deps: string[], version: string}|null
     */
    public function adminAssets(): ?array;
}
