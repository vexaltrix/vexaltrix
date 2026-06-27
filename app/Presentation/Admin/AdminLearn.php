<?php
/**
 * Vexaltrix Learn Helper Class
 *
 * @package Vexaltrix
 * @since 3.0.0
 */

namespace Vexaltrix\Presentation\Admin;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * \Vexaltrix\Presentation\Admin\AdminLearn class.
 *
 * @since 3.0.0
 */
class AdminLearn implements ServiceInterface {
	/**
	 * Get default learn chapters structure.
	 *
	 * Returns the complete structure of all available chapters and their steps.
	 * This serves as the source of truth for chapter definitions used across
	 * the theme for both frontend display and analytics validation.
	 *
	 * @return array Array of chapter objects with their steps.
	 * @since 3.0.0
	 */
	public static function getChaptersStructure() {
		// Add Edit Your Homepage chapter as the last item.
		$homepageId  = intval( get_option( 'page_on_front', 0 ) ); // @phpstan-ignore-line as get_option returns mixed.
		$homepageUrl = $homepageId ? admin_url( 'post.php?post=' . $homepageId . '&action=edit' ) : admin_url( 'options-reading.php' );
		$chapters     = [
			[
				'id'          => 'editor-basics',
				'title'       => __( 'Editor Basics', 'vexaltrix' ),
				'description' => __( 'Edit your pages using Vexaltrix with step-by-step guide and make them live with confidence.', 'vexaltrix' ),
				'url'         => 'https://wpvexaltrix.com/docs/getting-started-vexaltrix/',
				'steps'       => [
					[
						'id'          => 'add-your-first-block',
						'title'       => __( 'Add Your First Block', 'vexaltrix' ),
						'description' => __( 'Use the plus icon to insert a block like a heading, image, or button. Its the quickest way to start shaping your page.', 'vexaltrix' ),
						'learn'       => [
							'type'    => 'dialog',
							'content' => [
								'type' => 'image',
								'data' => [
									'src' => 'https://wpvexaltrix.com/wp-content/uploads/2026/04/Add-Your-First-Block.png',
									'alt' => __( 'Add Your First Vexaltrix Block in Editor', 'vexaltrix' ),
								],
							],
						],
						'action'      => [
							'label'      => __( 'Set Up', 'vexaltrix' ),
							'url'        => $homepageUrl . '#learn-add-your-first-block',
							'isExternal' => true,
						],
						'completed'   => false,
					],
					[
						'id'          => 'insert-ready-made-sections',
						'title'       => __( 'Insert Ready-Made Sections', 'vexaltrix' ),
						'description' => __( 'Add pre-designed Vexaltrix patterns to build sections faster without starting from scratch.', 'vexaltrix' ),
						'learn'       => [
							'type'    => 'dialog',
							'content' => [
								'type' => 'image',
								'data' => [
									'src' => 'https://wpvexaltrix.com/wp-content/uploads/2026/04/Insert-Ready-Made-Sections.png',
									'alt' => __( 'Inseart the Ready-Made Vexaltrix sections in Editor', 'vexaltrix' ),
								],
							],
						],
						'action'      => [
							'label'      => __( 'Set Up', 'vexaltrix' ),
							'url'        => ( 'yes' === \Vexaltrix\Presentation\Admin\AdminSettings::get( 'vxt_enable_templates_button', 'yes' ) ? $homepageUrl . '#learn-insert-ready-made-sections' : admin_url( 'admin.php?page=vexaltrix&path=settings&settings=editor-enhancements' ) ),
							'isExternal' => true,
						],
						'completed'   => false,
					],
				],
			],
			[
				'id'          => 'design-essentials',
				'title'       => __( 'Design Essentials', 'vexaltrix' ),
				'description' => __( 'Create clean, consistent sections that reflect your brand and message', 'vexaltrix' ),
				'url'         => 'https://wpvexaltrix.com/docs/import-pages-patterns-and-kits/',
				'steps'       => [
					[
						'id'          => 'replace-placeholder-content',
						'title'       => __( 'Replace Placeholder Content', 'vexaltrix' ),
						'description' => __( 'Swap out demo text and images with your own to make every section feel authentic and relevant to your business.', 'vexaltrix' ),
						'learn'       => [
							'type'    => 'dialog',
							'content' => [
								'type' => 'image',
								'data' => [
									'src' => 'https://wpvexaltrix.com/wp-content/uploads/2026/04/Replace-Placeholder-Content.png',
									'alt' => __( 'Replace Placeholder Content', 'vexaltrix' ),
								],
							],
						],
						'action'      => [
							'label'      => __( 'Set Up', 'vexaltrix' ),
							'url'        => $homepageUrl . '#learn-replace-placeholder-content',
							'isExternal' => true,
						],
						'completed'   => false,
					],
					[
						'id'          => 'customize-cta-sections',
						'title'       => __( 'Customize CTA Sections', 'vexaltrix' ),
						'description' => __( 'Edit buttons, links, and calls to action so visitors know exactly where to go next.', 'vexaltrix' ),
						'learn'       => [
							'type'    => 'dialog',
							'content' => [
								'type' => 'image',
								'data' => [
									'src' => 'https://wpvexaltrix.com/wp-content/uploads/2026/04/Customize-CTA-Sections.png',
									'alt' => __( 'Customize CTA Sections in Astra', 'vexaltrix' ),
								],
							],
						],
						'action'      => [
							'label'      => __( 'Set Up', 'vexaltrix' ),
							'url'        => $homepageUrl . '#learn-customize-cta-sections',
							'isExternal' => true,
						],
						'completed'   => false,
					],
					[
						'id'          => 'block-settings-styles',
						'title'       => __( 'Block Settings & Styles', 'vexaltrix' ),
						'description' => __( 'Open the Settings and Styles panels to shape each block the way you want. Small changes in spacing, colors, and typography can make your page feel instantly more refined.', 'vexaltrix' ),
						'learn'       => [
							'type'    => 'dialog',
							'content' => [
								'type' => 'image',
								'data' => [
									'src' => 'https://wpvexaltrix.com/wp-content/uploads/2026/04/Block-Settings-Styles.png',
									'alt' => __( 'Block Settings & Styles', 'vexaltrix' ),
								],
							],
						],
						'action'      => [
							'label'      => __( 'Set Up', 'vexaltrix' ),
							'url'        => $homepageUrl . '#learn-block-settings-styles',
							'isExternal' => true,
						],
						'isPro'       => false,
						'completed'   => false,
					],
				],
			],
		];

		if ( defined( 'ASTRA_THEME_VERSION' ) ) {
			$chapters[] = [
				'id'          => 'page-layout-settings',
				'title'       => __( 'Page Layout Settings', 'vexaltrix' ),
				'description' => __( 'Control how your page looks from edge to edge using layout options powered by Astra', 'vexaltrix' ),
				'url'         => 'https://wpastra.com/docs/understanding-container-style-in-astra-theme-customizing-your-containers-look/',
				'steps'       => [
					[
						'id'          => 'choose-page-layout',
						'title'       => __( 'Choose Page Layout', 'vexaltrix' ),
						'description' => __( 'Pick from Full Width, Boxed, or other layouts to create the structure that suits your design best.', 'vexaltrix' ),
						'learn'       => [
							'type'    => 'dialog',
							'content' => [
								'type' => 'image',
								'data' => [
									'src' => 'https://wpvexaltrix.com/wp-content/uploads/2026/04/Change-Page-Layout.png',
									'alt' => __( 'Choose Page Layout', 'vexaltrix' ),
								],
							],
						],
						'action'      => [
							'label'      => __( 'Set Up', 'vexaltrix' ),
							'url'        => $homepageUrl . '#astra-container-layout',
							'isExternal' => true,
						],
						'completed'   => false,
					],
					[
						'id'          => 'show-hide-elements',
						'title'       => __( 'Show or Hide Elements', 'vexaltrix' ),
						'description' => __( 'Toggle the header, footer, or page title visibility when you need a clean, distraction-free look.', 'vexaltrix' ),
						'learn'       => [
							'type'    => 'dialog',
							'content' => [
								'type' => 'image',
								'data' => [
									'src' => 'https://wpvexaltrix.com/wp-content/uploads/2026/04/Show-and-Hide-Elements.png',
									'alt' => __( 'Show or Hide Elements', 'vexaltrix' ),
								],
							],
						],
						'action'      => [
							'label'      => __( 'Set Up', 'vexaltrix' ),
							'url'        => $homepageUrl . '#astra-disable-elements',
							'isExternal' => true,
						],
						'completed'   => false,
					],
				],
			];
		}

		$chapters[] = [
			'id'          => 'make-your-page-live',
			'title'       => __( 'Make Your Page Live', 'vexaltrix' ),
			'description' => __( 'Review, save, and publish your work with confidence', 'vexaltrix' ),
			'url'         => 'https://wpvexaltrix.com/docs/preview-options-classics/',
			'steps'       => [
				[
					'id'          => 'preveiw-your-changes',
					'title'       => __( 'Preview Your Changes', 'vexaltrix' ),
					'description' => __( 'Keep your progress safe by saving your draft as you refine your design and preview how your page looks to the world!', 'vexaltrix' ),
					'learn'       => [
						'type'    => 'dialog',
						'content' => [
							'type' => 'image',
							'data' => [
								'src' => 'https://wpvexaltrix.com/wp-content/uploads/2026/04/Preview-Your-Changes.png',
								'alt' => __( 'Preview Your Changes', 'vexaltrix' ),
							],
						],
					],
					'action'      => [
						'label'      => __( 'Set Up', 'vexaltrix' ),
						'url'        => $homepageUrl . '#learn-preveiw-your-changes',
						'isExternal' => true,
					],
					'completed'   => false,
				],
				[
					'id'          => 'publish-your-page',
					'title'       => __( 'Publish Your Page', 'vexaltrix' ),
					'description' => __( 'Make your homepage live and ready for visitors. Celebrate your first win.', 'vexaltrix' ),
					'learn'       => [
						'type'    => 'dialog',
						'content' => [
							'type' => 'image',
							'data' => [
								'src' => 'https://wpvexaltrix.com/wp-content/uploads/2026/04/Publish-Your-Page.png',
								'alt' => __( 'Publish Your Page', 'vexaltrix' ),
							],
						],
					],
					'action'      => [
						'label'      => __( 'Set Up', 'vexaltrix' ),
						'url'        => $homepageUrl . '#learn-publish-your-page',
						'isExternal' => true,
					],
					'completed'   => false,
				],
			],
		];

		/**
		 * Filter learn chapters structure.
		 *
		 * @param array $chapters Learn chapters data.
		 * @since 3.0.0
		 */
		return (array) apply_filters( 'vexaltrix_learn_chapters', (array) $chapters );
	}

	/**
	 * Get learn chapters with user progress merged.
	 *
	 * @param int $userId Optional. User ID to get progress for. Defaults to current user.
	 * @return array Chapters array with progress data merged.
	 * @since 3.0.0
	 */
	public static function getLearnChapters( $userId = 0 ) {
		if ( ! $userId ) {
			$userId = get_current_user_id();
		}

		// Get chapters structure.
		$chapters = (array) self::getChaptersStructure();

		// Get saved progress from user meta.
		$savedProgress = get_user_meta( $userId, 'vexaltrix_learn_progress', true );
		if ( ! is_array( $savedProgress ) ) {
			$savedProgress = [];
		}

		// Merge saved progress with chapters.
		foreach ( $chapters as &$chapter ) {
			// Validate chapter structure.
			if ( ! isset( $chapter['id'], $chapter['steps'] ) || ! is_array( $chapter['steps'] ) ) {
				continue;
			}

			$chapterId = $chapter['id'];

			foreach ( $chapter['steps'] as &$step ) {
				if ( ! isset( $step['id'] ) ) {
					continue;
				}

				$stepId = $step['id'];
				if ( isset( $savedProgress[ $chapterId ][ $stepId ] ) ) {
					$step['completed'] = $savedProgress[ $chapterId ][ $stepId ];
				}
			}
		}

		return $chapters;
	}

	/**
	 * Service group.
	 *
	 * @return string
	 */
	public static function group(): string {
		return 'presentation';
	}

	/**
	 * Service context.
	 *
	 * @return string
	 */
	public static function context(): string {
		return 'admin';
	}

	/**
	 * Boot priority.
	 *
	 * @return int
	 */
	public static function priority(): int {
		return 15;
	}

	/**
	 * Register actions and filters.
	 *
	 * @return void
	 */
	public function boot(): void {
		// Auto-generated boot method.
	}

}
