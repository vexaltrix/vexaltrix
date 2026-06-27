<?php
/**
 * Vexaltrix block migrator.
 *
 * Class to execute cron event when the plugin is updated.
 *
 * @since 2.13.9
 * @package Vexaltrix
 */

namespace Vexaltrix\Infrastructure\Migration;

use WP_Background_Process;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'WP_Async_Request' ) ) {
	require_once VXT_DIR . 'app/lib/batch-processing/class-wp-async-request.php';
}

if ( ! class_exists( 'WP_Background_Process' ) ) {
	require_once VXT_DIR . 'app/lib/batch-processing/class-wp-background-process.php';
}

/**
 * Vexaltrix migration log.
 *
 * @since 2.13.9
 * @package Vexaltrix
 *
 * @param string $message The message to log.
 * @return void
 */
if ( ! function_exists( 'vexaltrixLog' ) ) {
	function vexaltrixLog( $message ) {
		$logFile = ABSPATH . 'wp-content/uploads/migration-log.txt';
		$file     = fopen( $logFile, 'a' ); //phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_fopen

		if ( $file ) {
			fwrite( $file, gmdate( 'Y-m-d H:i:s' ) . ' - ' . $message . PHP_EOL ); //phpcs:ignore WordPressVIPMinimum.Functions.RestrictedFunctions.file_ops_fwrite
			fclose( $file ); // Close the file after writing.
		}
	}
}

/**
 * Prevents the modification of the post modified date.
 *
 * This function ensures that the post modified date is not updated.
 *
 * @param array $new The new post data.
 * @param array $old The old post data.
 * @since 2.14.1
 * @return array The modified post data with the original modified date.
 */
if ( ! function_exists( 'vexaltrixStopModifiedDateUpdate' ) ) {
	function vexaltrixStopModifiedDateUpdate( $new, $old ) {
		$new['post_modified']     = $old['post_modified'];
		$new['post_modified_gmt'] = $old['post_modified_gmt'];
		return $new;
	}
}

if ( ! class_exists( 'Vexaltrix\Infrastructure\Migration\\BackgroundProcess' ) ) {

	/**
	 * Class \Vexaltrix\Infrastructure\Migration\BackgroundProcess
	 *
	 * Handles background processing for block migrations.
	 *
	 * @since 2.13.9
	 * @package Vexaltrix
	 */
	class BackgroundProcess extends WP_Background_Process {

		/**
		 * Action name.
		 *
		 * @var string
		 */
		protected $action = 'vexaltrix_blocks_migration';

		/**
		 * Task to be performed for each post.
		 *
		 * @param int $postId Post ID to be processed.
		 * @return bool|mixed False if the task is complete, or the post ID for further processing.
		 */
		protected function task( $postId ) {
			if ( get_post_meta( $postId, '_vxt_migration_processed', true ) ) {
				vexaltrix_log( 'Skipping already processed post ID: ' . $postId );
				return false;
			}

			$post = get_post( $postId );

			if ( ! is_object( $post ) || ! is_a( $post, 'WP_Post' ) ) {
				return false;
			}

			$migrationDetails = \Vexaltrix\Infrastructure\Migration\MigrateBlocks::getInstance()->getUpdatedContent( $post->post_content );

			// Only update when the post needs to be updated - if it has any blocks that needed to be migrated.
			if ( ! empty( $migrationDetails['requires_migration'] ) && ! empty( $migrationDetails['content'] ) && is_string( $migrationDetails['content'] ) ) {
				add_filter( 'wp_insert_post_data', 'vexaltrixStopModifiedDateUpdate', 99999, 2 );
				$updatedPostId = wp_update_post(
					[
						'ID'           => $post->ID,
						'post_content' => wp_slash( $migrationDetails['content'] ),
					]
				);

				remove_filter( 'wp_insert_post_data', 'vexaltrixStopModifiedDateUpdate', 99999 );
	
				// If the Post ID is correct ( which means the update was successful ) - Update the Post Meta and add to the log.
				if ( ! empty( $updatedPostId ) ) {
					update_post_meta( $post->ID, '_vxt_migration_processed', '1' );
					vexaltrix_log( 'Migration processed post ID: ' . $updatedPostId );
				} else {
					vexaltrix_log( 'Migration not processed for post ID: ' . $postId );
				}
			} else {
				update_post_meta( $post->ID, '_vxt_migration_processed', '1' );
				vexaltrix_log( 'Migration not required for post ID: ' . $postId );
			}

			return false;
		}

		/**
		 * Complete the migration process.
		 * 
		 * @since 2.13.9
		 * @return void
		 */
		protected function complete() {
			parent::complete();
		
			$postTypes = get_post_types( [ 'public' => true ], 'names' );

			$query = new WP_Query(
				[
					'post_type'   => $postTypes,
					'post_status' => 'any',
                    // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query -- Reason: Necessary for migration process.
					'meta_query'  => [
						[
							'key'     => '_vxt_migration_processed',
							'compare' => 'NOT EXISTS',
						],
					],
				]
			);

			if ( ! $query->have_posts() ) {
				// Delete the option once the migration progress is complete as it is not required.
				delete_option( 'vxt_migration_progress_status' );
				update_option( 'vxt_migration_complete', 'yes' );
				delete_option( 'vxt-old-user-less-than-2' );
				vexaltrix_log( 'End of blocks migration' );
				set_transient( 'vxt_migration_needs_reload', true );
			} else {
				update_option( 'vxt_migration_complete', 'no' );
			}
			
		}
	}
}
