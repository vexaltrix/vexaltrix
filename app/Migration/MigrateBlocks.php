<?php
/**
 * Vexaltrix block migrator.
 *
 * Class to execute cron event when the plugin is updated.
 *
 * @since 2.13.9
 * @package Vexaltrix
 */

namespace Vexaltrix\Migration;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class_exists( 'Vexaltrix\\Migration\\BackgroundProcess' );

/**
 * Vexaltrix_Update_Features.
 *
 * @package Vexaltrix
 * @since 2.13.9
 */
class MigrateBlocks {

	/**
	 * Member Variable
	 *
	 * @since 2.13.9
	 * @var \Vexaltrix\Migration\MigrateBlocks
	 */
	private static $instance;

	/**
	 * Info Box Mapping Array
	 * 
	 * @var array<string,array<string,bool|int>> $infoBoxMapping
	 */
	public static $infoBoxMapping;

	/**
	 * Advanced Heading Mapping Array
	 * 
	 * @var array<string,array<string,bool|string>> $advancedHeadingMapping
	 */
	public static $advancedHeadingMapping;

	/**
	 * Migration process instance.
	 *
	 * @var \Vexaltrix\Migration\BackgroundProcess
	 */
	public $migrationProcess;

	/**
	 *  Initiator
	 *
	 * @since 2.13.9
	 * @return \Vexaltrix\Migration\MigrateBlocks
	 */
	public static function getInstance() {
		return \Vexaltrix\Container::getInstance()->get( self::class );
	}

	/**
	 * Constructor function.
	 *
	 * @since 2.13.9
	 */
	public function __construct() {
		self::$infoBoxMapping         = [
			'imageWidth' => [
				'old' => 120,
			],
		];
		self::$advancedHeadingMapping = [
			'headingAlign'      => [
				'old' => 'center',
				'new' => 'left',
			],
			'headingDescToggle' => [
				'old' => true,
				'new' => false,
			],
		];

		// Initialize the background process handler.
		$this->migrationProcess = new \Vexaltrix\Migration\BackgroundProcess();

		add_action( 'vexaltrix_blocks_migration_event', [ $this, 'blocksMigration' ] );
		add_action( 'admin_init', [ $this, 'queryMigrateToNew' ] );
		add_action( 'wp_ajax_check_migration_status', [ $this, 'checkMigrationStatus' ] );
		// Removed wp_ajax_nopriv_check_migration_status - migration status should only be accessible to authenticated users.

		if ( 'yes' === get_option( 'uag_migration_status', 'no' ) && 'yes' === get_option( 'vxt-old-user-less-than-2', false ) ) {
			add_action( 'admin_footer', [ $this, 'addMigrationStatusScript' ] );
			$this->migrateBlocks();
		}
	}

	/**
	 * Trigger migration via query parameter.
	 *
	 * @since 2.13.9
	 * @return void
	 */
	public function queryMigrateToNew() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		// Sanitize and check if the nonce is valid.
		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : '';
		if ( ! wp_verify_nonce( $nonce, 'wp_vexaltrix_blocks_migration' ) ) {
			$migrateToNew = isset( $_GET['migrate_to_new'] ) ? sanitize_text_field( $_GET['migrate_to_new'] ) : false;

			if ( 'yes' === $migrateToNew ) {
				vexaltrix_log( 'Migration triggered via query parameter by an authorized user.' );
					$this->migrateBlocks();
			}
		}
	}

	/**
	 * Schedule and run blocks migration.
	 *
	 * @since 2.13.9
	 * @return void
	 */
	public function migrateBlocks() {
		if ( 'yes' !== get_option( 'vxt-old-user-less-than-2', false ) ) {
			return;
		}
		if ( ! wp_next_scheduled( 'vexaltrix_blocks_migration_event' ) ) {
			wp_schedule_single_event( time(), 'vexaltrix_blocks_migration_event' );
		}
		update_option( 'uag_enable_legacy_blocks', 'yes' );
		update_option( 'uag_load_font_awesome_5', 'enabled' );
	}

	/**
	 * Execute blocks migration process.
	 *
	 * @since 2.13.9
	 * @return void
	 */
	public function blocksMigration() {

		$postsPerPage = 100;
		$page           = 1;

		$postTypes = get_post_types( [ 'public' => true ], 'names' );

		do {
			$query = new WP_Query(
				[
					'post_type'      => $postTypes,
					'post_status'    => 'any',
					'posts_per_page' => $postsPerPage,
					'paged'          => $page,
					// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query -- Reason: Necessary for migration process.
					'meta_query'     => [
						[
							'key'     => '_uag_migration_processed',
							'compare' => 'NOT EXISTS',
						],
					],
				]
			);

			foreach ( $query->posts as $post ) {
				if ( ! $post instanceof WP_Post ) {
					vexaltrix_log( 'Skipped post ID: ' . ( is_object( $post ) ? $post->ID : 'Invalid post type' ) );
					continue;
				}

				$this->migrationProcess->push_to_queue( $post->ID );
				vexaltrix_log( 'Queued post ID: ' . ( is_object( $post ) ? $post->ID : 'Invalid post type' ) );
			}

			$page++;
		} while ( $query->max_num_pages >= $page );

		$this->migrationProcess->save()->dispatch();
	}

	/**
	 * Check the status of the migration process.
	 *
	 * @since 2.13.9
	 * @return void
	 */
	public function checkMigrationStatus() {
		// Check user capability first.
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error(
				[
					'status' => 'fail',
					'type'   => 'error',
					'msg'    => 'Unauthorized access',
				]
			);
			return;
		}

		// Sanitize and check if the nonce is valid.
		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : '';
		if ( ! wp_verify_nonce( $nonce, 'check_migration_status_nonce' ) ) {
			wp_send_json_error(
				[
					'status' => 'fail',
					'type'   => 'error',
					'msg'    => 'Invalid nonce',
				]
			);
			return;
		}
	
		$migrationComplete     = get_option( 'uag_migration_complete', 'no' );
		$migrationNeedsReload = get_transient( 'uag_migration_needs_reload' ) ? 'yes' : 'no';
	
		// If migration is complete and reload is needed, delete the transient to avoid repeated reloads.
		if ( 'yes' === $migrationComplete && 'yes' === $migrationNeedsReload ) {
			delete_transient( 'uag_migration_needs_reload' );
		}
	
		// Check if the migration status retrieval failed.
		if ( 'fail' === $migrationComplete ) {
			wp_send_json_error(
				[
					'status' => 'fail',
					'type'   => 'error',
					'msg'    => "We couldn't catch current tasks, please try again",
				]
			);
		} else {
			wp_send_json_success(
				[
					'complete' => $migrationComplete,
					'reload'   => $migrationNeedsReload,
				]
			);
		}
	}
	
	/**
	 * Add migration status checking script to admin footer.
	 *
	 * @since 2.13.9
	 * @return void
	 */
	public function addMigrationStatusScript() {
		$ajaxNonce = wp_create_nonce( 'check_migration_status_nonce' );
		?>
		<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			let reloadDone = false; // Flag to track if reload has been done.
			function checkMigrationStatus() {
				if (reloadDone) {
					return; // Exit function if reloadDone is true.
				}

				fetch('<?php echo esc_html( admin_url( 'admin-ajax.php' ) ); ?>', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded',
					},
					body: new URLSearchParams({
						action: 'checkMigrationStatus',
						nonce: '<?php echo esc_js( $ajaxNonce ); ?>',
					}),
				})
				.then(response => response.json())
				.then(data => {
					if ( data.success ) {
						if ( data.data.reload === 'yes' ) {
							reloadDone = true; // Set reloadDone flag to true.
							location.reload();
						} else {
							setTimeout(checkMigrationStatus, 10000); // Retry after 10 seconds.
						}
					} else {
						console.error('Error:', data);
						setTimeout(checkMigrationStatus, 10000); // Retry after 10 seconds.
					}
				})
				.catch(error => {
					console.error('Fetch error:', error);
					setTimeout(checkMigrationStatus, 10000); // Retry after 10 seconds.
				});
			}
			checkMigrationStatus(); // Initial call to start checking.
		});
		</script>
		<?php
	}
	


	/**
	 * Update the content blocks.
	 *
	 * @since 2.13.9
	 * @param string $content Content to be updated.
	 * @return array<string|string> Array of whether migration is required, and the updated content.
	 */
	public function getUpdatedContent( $content ) {
		$isMigrationNeeded = false;
		$blocks              = parse_blocks( $content );
		$blocks              = $this->getUpdatedBlocks( $blocks, $isMigrationNeeded );
		return [
			'requires_migration' => $isMigrationNeeded,
			'content'            => serialize_blocks( $blocks ),
		];
	}

	/**
	 * Update blocks with new attributes.
	 *
	 * @param array   $blocks Blocks to be updated.
	 * @param boolean $isMigrationNeeded Whether the page needs migration or not.
	 * @since 2.13.9
	 * @return array Updated blocks.
	 */
	public function getUpdatedBlocks( array $blocks, &$isMigrationNeeded ) {
		foreach ( $blocks as &$block ) {
			if ( isset( $block['blockName'] ) && is_string( $block['blockName'] ) && 0 === strpos( $block['blockName'], 'uagb/' ) ) {
				$block['blockName']   = 'vexaltrix/' . substr( $block['blockName'], strlen( 'uagb/' ) );
				$isMigrationNeeded = true;
			}

			if ( ! empty( $block['innerBlocks'] ) ) {
				$block['innerBlocks'] = $this->getUpdatedBlocks( $block['innerBlocks'], $isMigrationNeeded );
			} else {
				if ( ! isset( $block['blockName'] ) ) {
					continue;
				}
				if ( 'vexaltrix/info-box' === $block['blockName'] ) {
					$isMigrationNeeded = true;
					$attributes          = $block['attrs'];
					foreach ( self::$infoBoxMapping as $key => $value ) {
						if ( ! isset( $attributes[ $key ] ) ) { // Meaning this is set to default, so no need to update.
							$attributes[ $key ] = $value['old'];
						}
					}
					$block['attrs'] = $attributes;
				}
				if ( 'vexaltrix/advanced-heading' === $block['blockName'] ) {
					$isMigrationNeeded = true;
					$attributes          = $block['attrs'];
					foreach ( self::$advancedHeadingMapping as $key => $value ) {
						if ( ! isset( $attributes[ $key ] ) ) { // Meaning this is set to default, so no need to update.
							$attributes[ $key ] = $value['old'];
						}
					}
					$block['attrs'] = $attributes;
				}
			}
		}
		return $blocks;
	}
}

/**
 * Prepare if class 'Vexaltrix\\Core\\Blocks\\InitBlocks' exist.
 * Kicking this off by calling 'get_instance()' method.
 *
 * @since 2.13.9
 */

