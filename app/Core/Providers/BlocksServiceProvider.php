<?php
/**
 * Blocks service provider.
 *
 * @package Vexaltrix
 * @since x.x.x
 */

namespace Vexaltrix\Core\Providers;

use Vexaltrix\Core\Base\ServiceProvider;
use Vexaltrix\Core\Blocks\Block;
use Vexaltrix\Core\Blocks\BlockModule;
use Vexaltrix\Core\Blocks\BlockPrioritization;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers block services.
 *
 * @since x.x.x
 */
class BlocksServiceProvider extends ServiceProvider {

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register() {
		$this->container->singleton( Block::class, Block::class );
		$this->container->singleton( BlockModule::class, BlockModule::class );
		$this->container->singleton( BlockPrioritization::class, BlockPrioritization::class );
	}
}
