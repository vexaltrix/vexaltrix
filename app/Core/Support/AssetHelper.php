<?php
/**
 * Asset Helper — static utility for module asset loading.
 *
 * @package Vexaltrix\Core\Support
 * @since x.x.x
 */

declare(strict_types=1);

namespace Vexaltrix\Core\Support;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Static utility for loading and referencing build assets.
 *
 * @since x.x.x
 */
final class AssetHelper {

	/**
	 * Load asset metadata from a .asset.php file.
	 *
	 * @param string $relativePath Relative path within assets/build/ (without extension).
	 * @return array{dependencies: string[], version: string}
	 */
	public static function assetData( string $relativePath ): array {
		$assetFile = VXT_DIR . "assets/build/{$relativePath}.asset.php";

		return file_exists( $assetFile )
			? require $assetFile
			: [ 'dependencies' => [], 'version' => VXT_VER ];
	}

	/**
	 * Get the URL for a built asset file.
	 *
	 * @param string $relativePath Relative path within assets/build/.
	 * @return string Full URL.
	 */
	public static function buildUrl( string $relativePath ): string {
		return VXT_URL . "assets/build/{$relativePath}";
	}
}
