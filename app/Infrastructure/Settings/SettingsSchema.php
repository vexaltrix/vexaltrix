<?php
/**
 * Settings Schema — defines defaults, types, and validation for plugin settings.
 *
 * @package Vexaltrix\Infrastructure\Settings
 * @since x.x.x
 */

declare(strict_types=1);

namespace Vexaltrix\Infrastructure\Settings;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Centralised schema for every plugin option.
 *
 * Each entry maps a setting key (without prefix) to its metadata:
 *   'default'   — default value
 *   'type'      — 'string' | 'int' | 'bool' | 'array'
 *   'sanitize'  — (optional) callable for custom sanitisation
 *
 * The raw schema is filterable via 'vexaltrix/settings/schema' so
 * add-ons can register their own keys.
 *
 * @since x.x.x
 */
final class SettingsSchema {

	/**
	 * Cached resolved schema.
	 *
	 * @var array<string, array{default: mixed, type: string, sanitize?: callable}>|null
	 */
	private ?array $schema = null;

	/**
	 * Return the full schema array.
	 *
	 * @since x.x.x
	 * @return array<string, array{default: mixed, type: string, sanitize?: callable}>
	 */
	public function defaults(): array {
		if ( null !== $this->schema ) {
			return $this->schema;
		}

		$raw = [
			'file_generation'                         => [ 'default' => 'disabled', 'type' => 'string' ],
			'enable_templates_button'                  => [ 'default' => 'yes',      'type' => 'string' ],
			'enable_on_page_css_button'                => [ 'default' => 'yes',      'type' => 'string' ],
			'enable_block_condition'                   => [ 'default' => 'disabled', 'type' => 'string' ],
			'enable_masonry_gallery'                   => [ 'default' => 'enabled',  'type' => 'string' ],
			'enable_block_responsive'                  => [ 'default' => 'enabled',  'type' => 'string' ],
			'enable_dynamic_content'                   => [ 'default' => 'enabled',  'type' => 'string' ],
			'enable_animations_extension'              => [ 'default' => 'enabled',  'type' => 'string' ],
			'enable_gbs_extension'                     => [ 'default' => 'enabled',  'type' => 'string' ],
			'enable_quick_action_sidebar'              => [ 'default' => 'enabled',  'type' => 'string' ],
			'load_font_awesome_5'                      => [ 'default' => 'disabled', 'type' => 'string' ],
			'auto_block_recovery'                      => [ 'default' => 'disabled', 'type' => 'string' ],
			'enable_legacy_blocks'                     => [ 'default' => 'no',       'type' => 'string' ],
			'content_width'                            => [ 'default' => 1140,       'type' => 'int' ],
			'container_global_padding'                 => [ 'default' => 10,         'type' => 'int' ],
			'container_global_elements_gap'            => [ 'default' => 20,         'type' => 'int' ],
			'btn_inherit_from_theme'                   => [ 'default' => 'disabled', 'type' => 'string' ],
			'btn_inherit_from_theme_fallback'          => [ 'default' => 'enabled',  'type' => 'string' ],
			'visibility_mode'                          => [ 'default' => 'disabled', 'type' => 'string' ],
			'visibility_page'                          => [ 'default' => '',         'type' => 'string' ],
			'selected_preset'                          => [ 'default' => 'default',  'type' => 'string' ],
			'social_login'                             => [ 'default' => 'disabled', 'type' => 'string' ],
			'recaptcha_site_key_v2'                    => [ 'default' => '',         'type' => 'string' ],
			'recaptcha_secret_key_v2'                  => [ 'default' => '',         'type' => 'string' ],
			'recaptcha_site_key_v3'                    => [ 'default' => '',         'type' => 'string' ],
			'recaptcha_secret_key_v3'                  => [ 'default' => '',         'type' => 'string' ],
			'blocks_editor_spacing'                    => [ 'default' => '',         'type' => 'string' ],
			'load_fse_font_globally'                   => [ 'default' => 'disabled', 'type' => 'string' ],
			'enable_coming_soon_mode'                  => [ 'default' => 'disabled', 'type' => 'string' ],
			'coming_soon_page'                         => [ 'default' => '',         'type' => 'string' ],
			'_vxt_ultimate_gutenberg_blocks_blocks'    => [ 'default' => [],         'type' => 'array' ],
			'allow_file_generation'                    => [ 'default' => 'disabled', 'type' => 'string' ],
		];

		/**
		 * Filter the settings schema so add-ons can register new keys.
		 *
		 * @since x.x.x
		 *
		 * @param array<string, array{default: mixed, type: string, sanitize?: callable}> $raw Schema entries.
		 */
		$this->schema = apply_filters( 'vexaltrix/settings/schema', $raw );

		return $this->schema;
	}

	/**
	 * Get the default value for a single key.
	 *
	 * @since x.x.x
	 *
	 * @param string $key Setting key (without prefix).
	 * @return mixed Default value, or null if key is unknown.
	 */
	public function defaultFor( string $key ): mixed {
		$schema = $this->defaults();
		return $schema[ $key ]['default'] ?? null;
	}

	/**
	 * Validate and coerce a value according to its schema entry.
	 *
	 * @since x.x.x
	 *
	 * @param string $key   Setting key (without prefix).
	 * @param mixed  $value Raw value to validate.
	 * @return mixed Coerced / sanitised value.
	 */
	public function validate( string $key, mixed $value ): mixed {
		$schema = $this->defaults();

		if ( ! isset( $schema[ $key ] ) ) {
			return $value;
		}

		$entry = $schema[ $key ];

		// Type coercion.
		$value = match ( $entry['type'] ) {
			'string' => (string) $value,
			'int'    => (int) $value,
			'bool'   => (bool) $value,
			'array'  => is_array( $value ) ? $value : (array) $value,
			default  => $value,
		};

		// Optional custom sanitiser.
		if ( isset( $entry['sanitize'] ) && is_callable( $entry['sanitize'] ) ) {
			$value = call_user_func( $entry['sanitize'], $value );
		}

		return $value;
	}

	/**
	 * Return all registered setting keys.
	 *
	 * @since x.x.x
	 * @return string[]
	 */
	public function keys(): array {
		return array_keys( $this->defaults() );
	}

	/**
	 * Check whether a key exists in the schema.
	 *
	 * @since x.x.x
	 *
	 * @param string $key Setting key (without prefix).
	 * @return bool
	 */
	public function has( string $key ): bool {
		return array_key_exists( $key, $this->defaults() );
	}
}
