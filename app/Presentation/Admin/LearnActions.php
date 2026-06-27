<?php
/**
 * Vexaltrix Learn Actions
 * Handles interactive actions for learn functionality steps
 *
 * @package Vexaltrix
 */

namespace Vexaltrix\Presentation\Admin;

use Vexaltrix\Core\Contracts\ServiceInterface;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Vexaltrix\Presentation\Admin\\LearnActions' ) ) {

	/**
	 * Class \Vexaltrix\Presentation\Admin\LearnActions
	 */
	class LearnActions implements ServiceInterface {

		/**
		 * Instance
		 *
		 * @access private
		 * @var self|null Class object.
		 * @since 3.0.0
		 */
		private static $instance = null;

		/**
		 * Get instance.
		 *
		 * @since 3.0.0
		 * @return self initialized object of class.
		 */
		public static function getInstance() {
		return \Vexaltrix\Core\Container::getInstance()->get( self::class );
	}

		/**
		 * Constructor.
		 *
		 * @since 3.0.0
		 */
		

		/**
		 * Enqueue JavaScript for learn actions functionality.
		 *
		 * @since 3.0.0
		 * @return void
		 */
		public function enqueueLearnActionsScript() {
			global $pagenow;

			// Only add script on block editor screens.
			if ( ! in_array( $pagenow, [ 'post.php', 'post-new.php' ], true ) ) {
				return;
			}

			$screen = get_current_screen();
			if ( ! $screen || ! $screen->is_block_editor() ) {
				return;
			}

			// Check user capability.
			if ( ! current_user_can( 'edit_posts' ) ) {
				return;
			}

			// Check if URL has learn action hash fragments.
			$inlineScript = "
			( function() {
				'use strict';

				// Global flag to prevent multiple executions
				if (window.uagbLearnActionsExecuted) {
					return;
				}
				window.uagbLearnActionsExecuted = true;

				// State management
				var learnActionState = {
					executed: false,
					currentAction: null
				};

				/**
				 * Check if distraction-free mode is active
				 */
				function isDistractionFreeMode() {
					try {
					if (typeof wp !== 'undefined' && wp.data && wp.data.select && wp.data.select('core/block-editor')) {
						return wp?.data?.select('core/block-editor')?.getSettings()?.isDistractionFree === true;
					}
					} catch (error) {
						return false;
					}
				}

				/**
				 * Check if style tab is currently open
				 */
				function isStyleTabOpen() {
					try {
						var styleButton = document.querySelectorAll('.block-editor-block-inspector__tabs')[0]?.childNodes[0]?.childNodes[1];
						return styleButton && styleButton.classList.contains('is-active');
					} catch (error) {
						return false;
					}
				}

				/**
				 * Wait for the WordPress editor to be fully loaded
				 */
				function waitForEditor(callback) {
				
					if (typeof wp !== 'undefined' && wp.data && wp.data.select && wp.data.select('core/block-editor') && (document.readyState === 'complete' || document.readyState === 'interactive') ) {
						callback();
					} else {
						setTimeout(() => waitForEditor(callback), 100);
					}
				}

				/**
				 * Wait for element to be available in the DOM
				 */
				function waitForElement(selector, callback, timeout) {
					timeout = timeout || 10000; // 10 second timeout
					var startTime = Date.now();

					function checkElement() {
						var element = document.querySelector(selector);
						
						if (element) {
							callback(element);
						} else if (Date.now() - startTime < timeout) {
							setTimeout(checkElement, 100);
						}
					}
					
					checkElement();
				}

				/**
				 * Add tooltip to highlighted element
				 */
				function highlightElement(element, duration, tooltipText) {
					duration = duration || 3000;
					tooltipText = tooltipText || '" . esc_js( __( 'This is the element you need to interact with', 'vexaltrix' ) ) . "';
					
					// Get element position and dimensions
					var rect = element.getBoundingClientRect();
					
					// Create tooltip
					var tooltip = document.createElement('div');
					tooltip.className = 'vxt-learn-tooltip';
					
					// Create tooltip content container
					var tooltipContent = document.createElement('div');
					tooltipContent.className = 'vxt-learn-tooltip-content';
					tooltipContent.textContent = tooltipText;
					
					// Create close button
					var closeButton = document.createElement('button');
					closeButton.className = 'vxt-learn-tooltip-close';
					closeButton.innerHTML = '×';
					closeButton.setAttribute('aria-label', '" . esc_attr( __( 'Close tooltip', 'vexaltrix' ) ) . "');
					
					// Create arrow
					var arrow = document.createElement('div');
					arrow.className = 'vxt-learn-tooltip-arrow';
					
					// Append content and close button to tooltip
					tooltip.appendChild(tooltipContent);
					tooltip.appendChild(closeButton);
					tooltip.appendChild(arrow);
					
					// Position tooltip - try above first, then sides
					var tooltipTop, tooltipLeft, position = 'top';
					
					// Try positioning above
					if (rect.top >= 70) {
						tooltipTop = rect.top - 60;
						tooltipLeft = rect.left + (rect.width / 2) - 100;
						position = 'top';
					}
					// If no space above, try right side
					else if (rect.right + 220 <= window.innerWidth) {
						tooltipTop = rect.top + (rect.height / 2) - 25;
						tooltipLeft = rect.right + 15;
						position = 'right';
					}
					// If no space on right, try left side
					else if (rect.left >= 220) {
						tooltipTop = rect.top + (rect.height / 2) - 25;
						tooltipLeft = rect.left - 215;
						position = 'left';
					}
					// Last resort: center above even if it goes off screen
					else {
						tooltipTop = rect.top - 60;
						tooltipLeft = rect.left + (rect.width / 2) - 100;
						position = 'top';
					}
					
					// Final boundary adjustments for top position
					if (position === 'top') {
						if (tooltipLeft < 10) tooltipLeft = 10;
						if (tooltipLeft + 200 > window.innerWidth) tooltipLeft = window.innerWidth - 210;
					}
					
					tooltip.style.cssText = 'position: fixed; top: ' + tooltipTop + 'px; left: ' + tooltipLeft + 'px; width: 200px; padding: 10px 15px 10px 10px; background: #333; color: #fff; border-radius: 6px; font-size: 14px; font-family: -apple-system, BlinkMacSystemFont, \"Segoe UI\", Roboto, sans-serif; z-index: 1000000; box-shadow: 0 4px 12px #333; opacity: 0; transform: translateY(10px); transition: all 0.3s ease; pointer-events: auto;';
					
					// Add tooltip CSS if not exists
					if (!document.getElementById('learn-actions-css')) {
						var style = document.createElement('style');
						style.id = 'learn-actions-css';
						style.textContent = '.vxt-learn-tooltip { position: relative; } .vxt-learn-tooltip-content { margin-right: 20px; } .vxt-learn-tooltip-close { position: absolute; top: 5px; right: 8px; background: none; border: none; color: #fff; font-size: 18px; line-height: 1; cursor: pointer; padding: 0; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; border-radius: 50%; transition: background-color 0.2s; } .vxt-learn-tooltip-close:hover { background-color: rgba(255, 255, 255, 0.1); } .vxt-learn-tooltip-close:focus { outline: 1px solid #fff; outline-offset: 1px; } .vxt-learn-tooltip-arrow { position: absolute; width: 0; height: 0; } .vxt-learn-tooltip.position-top .vxt-learn-tooltip-arrow { bottom: -8px; left: 50%; transform: translateX(-50%); border-left: 8px solid transparent; border-right: 8px solid transparent; border-top: 8px solid #333; } .vxt-learn-tooltip.position-right .vxt-learn-tooltip-arrow { left: -8px; top: 50%; transform: translateY(-50%); border-top: 8px solid transparent; border-bottom: 8px solid transparent; border-right: 8px solid #333; } .vxt-learn-tooltip.position-left .vxt-learn-tooltip-arrow { right: -8px; top: 50%; transform: translateY(-50%); border-top: 8px solid transparent; border-bottom: 8px solid transparent; border-left: 8px solid #333; } button.block-editor-tabbed-sidebar__tab::after { outline: none; }';
						document.head.appendChild(style);
					}
					
					document.body.appendChild(tooltip);
					
					// Add position class for arrow styling
					tooltip.classList.add('position-' + position);
					
					// Function to remove tooltip with animation
					function removeTooltip() {
						if (tooltip && tooltip.parentNode) {
							tooltip.style.opacity = '0';
							var exitTransform;
							if (position === 'right') {
								exitTransform = 'translateX(-10px)';
							} else if (position === 'left') {
								exitTransform = 'translateX(10px)';
							} else {
								exitTransform = 'translateY(-10px)';
							}
							tooltip.style.transform = exitTransform;
							setTimeout(() => {
								if (tooltip.parentNode) {
									tooltip.parentNode.removeChild(tooltip);
								}
							}, 300);
						}
					}
					
					// Add click handler for close button
					closeButton.addEventListener('click', removeTooltip);
					
					// Add click handler to close tooltip on any body click
					function handleBodyClick(event) {
						removeTooltip();
						document.removeEventListener('click', handleBodyClick);
					}
					
					// Add the body click listener after a small delay to prevent immediate closure
					setTimeout(() => {
						document.addEventListener('click', handleBodyClick);
					}, 100);
					
					// Set initial transform based on position
					var initialTransform, finalTransform;
					if (position === 'right') {
						initialTransform = 'translateX(-10px)';
						finalTransform = 'translateX(0)';
					} else if (position === 'left') {
						initialTransform = 'translateX(10px)';
						finalTransform = 'translateX(0)';
					} else {
						initialTransform = 'translateY(10px)';
						finalTransform = 'translateY(0)';
					}
					
					tooltip.style.transform = initialTransform;
					
					// Animate in
					setTimeout(() => {
						tooltip.style.opacity = '1';
						tooltip.style.transform = finalTransform;
					}, 100);

					// Tooltip stays until manually closed - no automatic removal
				}

				/**
				 * Insert Vexaltrix block using block editor
				 */
				function insertVexaltrixBlock(blockName, attributes) {
					if (typeof wp === 'undefined' || !wp.blocks || !wp.data) {
						return false;
					}

					if (isDistractionFreeMode()) {
						return;
					}

					try {
						var blockType = wp.blocks.getBlockType(blockName);
						if (!blockType) {
							return false;
						}

						var block = wp.blocks.createBlock(blockName, attributes || {});
						var blocks = wp.data.select('core/block-editor').getBlocks();
						
						// Insert at the end
						wp.data.dispatch('core/block-editor').insertBlocks([block], blocks.length);
						
						// Select the new block
						setTimeout(() => {
							wp.data.dispatch('core/block-editor').selectBlock(block.clientId);
						}, 100);

						return true;
					} catch (error) {
						console.error('Error inserting block:', error);
						return false;
					}
				}

				/**
				 * Find and select existing Vexaltrix block
				 */
				function selectVexaltrixBlock(blockName) {
					if (typeof wp === 'undefined' || !wp.data) {
						return false;
					}

					if (isDistractionFreeMode()) {
						return;
					}

					try {
						var blocks = wp.data.select('core/block-editor').getBlocks();
						
						function findBlock(blockList) {
							for (var i = 0; i < blockList.length; i++) {
								var block = blockList[i];
								if (block.name === blockName) {
									return block;
								}
								if (block.innerBlocks && block.innerBlocks.length > 0) {
									var innerBlock = findBlock(block.innerBlocks);
									if (innerBlock) return innerBlock;
								}
							}
							return null;
						}

						var targetBlock = findBlock(blocks);
						if (targetBlock) {
							wp.data.dispatch('core/block-editor').selectBlock(targetBlock.clientId);
							return true;
						}
						
						return false;
					} catch (error) {
						console.error('Error selecting block:', error);
						return false;
					}
				}

				/**
				 * Find and select individual button within buttons block
				 */
				function selectButtonChild() {
					if (typeof wp === 'undefined' || !wp.data) {
						return false;
					}

					if (isDistractionFreeMode()) {
						return;
					}

					try {
						var blocks = wp.data.select('core/block-editor').getBlocks();
						
						function findButtonsBlock(blockList) {
							for (var i = 0; i < blockList.length; i++) {
								var block = blockList[i];
								if (block.name === 'vexaltrix/buttons') {
									// Look for button children within buttons block
									if (block.innerBlocks && block.innerBlocks.length > 0) {
										for (var j = 0; j < block.innerBlocks.length; j++) {
											var innerBlock = block.innerBlocks[j];
											if (innerBlock.name === 'vexaltrix/buttons-child') {
												return innerBlock; // Return the first button child
											}
										}
									}
									return block; // Return buttons block if no button children found
								}
								if (block.innerBlocks && block.innerBlocks.length > 0) {
									var foundBlock = findButtonsBlock(block.innerBlocks);
									if (foundBlock) return foundBlock;
								}
							}
							return null;
						}

						var targetBlock = findButtonsBlock(blocks);
						if (targetBlock) {
							wp.data.dispatch('core/block-editor').selectBlock(targetBlock.clientId);
							return true;
						}
						
						return false;
					} catch (error) {
						console.error('Error selecting button child:', error);
						return false;
					}
				}

				/**
				 * Check if any Vexaltrix block with rich text content exists on the page
				 */
				function hasVexaltrixRichTextBlock() {
					if (isDistractionFreeMode()) {
						return;
					}
					return new Promise(function(resolve) {
						try {
							function checkForVexaltrixElements() {
								var foundVexaltrixClass = false;
								var editableElements = [];
								
								// First, check if DOM is ready and try main document
								if (document.readyState === 'complete' || document.readyState === 'interactive') {
									editableElements = document.querySelectorAll('.block-editor-rich-text__editable');
								}
								// If no elements found in main document, check iframe editor-canvas
								if (editableElements.length === 0) {
									var iframeElement = document.querySelector('iframe[name=\"editor-canvas\"]');
									
									if (iframeElement) {
										// Check if iframe is fully loaded
										function checkIframeContent() {
											try {
												if (iframeElement.contentDocument && 
													iframeElement.contentDocument.readyState === 'complete') {
													editableElements = iframeElement.contentDocument.querySelectorAll('.block-editor-rich-text__editable');
													
													// Process the found elements
													processVexaltrixElements();
												} else {
													// Iframe not fully loaded yet, wait for it
													if (iframeElement.contentDocument) {
														iframeElement.contentDocument.addEventListener('DOMContentLoaded', function() {
															setTimeout(checkIframeContent, 100);
														});
													}
													// Also try onload event on iframe itself
													iframeElement.addEventListener('load', function() {
														setTimeout(checkIframeContent, 100);
													});
													
													// Fallback timeout check
													setTimeout(checkIframeContent, 1000);
												}
											} catch (e) {
												resolve(foundVexaltrixClass);
											}
										}
										
										// Start checking iframe content
										checkIframeContent();
										return; // Exit early, will resolve via iframe checking
									}
								}
								
								// Process elements from main document
								processVexaltrixElements();
								
								function processVexaltrixElements() {
									// Check elements for Vexaltrix classes
									if (editableElements.length > 0) {
										editableElements.forEach(function(element) {
										
											var hasVexaltrixClass = Array.from(element.classList).some(function(className) {
												return className.includes('wp-block-vxt-');
											});
											
											if (hasVexaltrixClass) {
												foundVexaltrixClass = true;
											}
										});
									}
									
									resolve(foundVexaltrixClass);
								}
							}
							
							// Check DOM readiness
							if (document.readyState === 'complete') {
								checkForVexaltrixElements();
							} else {
								document.addEventListener('DOMContentLoaded', function() {
									setTimeout(checkForVexaltrixElements, 100);
								});
								
								// Also listen for load event as backup
								window.addEventListener('load', function() {
									setTimeout(checkForVexaltrixElements, 100);
								});
							}
							
						} catch (error) {
							resolve(false);
						}
					});
				}

				/**
				 * Open block inserter panel
				 */
				function openBlockInserter() {
				// Don't run any learn actions if distraction-free mode is active
					if (isDistractionFreeMode()) {
						return;
					}
					var inserterButton = document.querySelector('.editor-document-tools__inserter-toggle');
					var targetElement = null;
					if (inserterButton && typeof inserterButton.click === 'function') {
						inserterButton.click();
						setTimeout(() => {
							// Check in vexaltrixProCategoryIcon first
							var vexaltrixProCategoryIcon = document.querySelector('.block-editor-inserter__insertable-blocks-at-selection .block-editor-inserter__panel-header .vexaltrix-pro-category-icon');
							if (vexaltrixProCategoryIcon) {
								targetElement = vexaltrixProCategoryIcon;
							} else {
								targetElement = document.querySelector('.block-editor-inserter__insertable-blocks-at-selection .block-editor-inserter__panel-header .vexaltrix-category-icon');
							}
							// Scroll to the target element
							targetElement?.scrollIntoView({ 
								behavior: 'smooth', 
								block: 'start' 
							});
						}, 1000); // Wait 1 second for panel to load
						highlightElement( inserterButton, 5000, '" . esc_js( __( 'To open the block inserter click here.', 'vexaltrix' ) ) . "' );
						return true;
					}
					return false;
				}

				/**
				 * Open preview panel
				 */
				function openPreviewPanel() {
					if (isDistractionFreeMode()) {
						return;
					}
					var previewButton = document.querySelector('.editor-preview-dropdown__toggle');
					if (previewButton && typeof previewButton.click === 'function') {
						previewButton.click();
						highlightElement( previewButton, 5000, '" . esc_js( __( 'To preview your page changes click here.', 'vexaltrix' ) ) . "' );
						return true;
					}
					return false;
				}

				/**
				 * Open General tab and expand Content panel with tooltip
				 */
				function openContentPanel() {
					setTimeout(function() {
						var generalTab = document.querySelector('.vxt-inspector-tabs > div:first-child');
						if (generalTab && !generalTab.classList.contains('vxt-active')) {
							generalTab.click();
						}
						setTimeout(function() {
							var panelHeaders = document.querySelectorAll('.components-panel__body-title button');
							for (var i = 0; i < panelHeaders.length; i++) {
								if (panelHeaders[i].textContent.trim() === '" . esc_js( __( 'Content', 'vexaltrix' ) ) . "') {
									if (panelHeaders[i].getAttribute('aria-expanded') !== 'true') {
										panelHeaders[i].click();
									}
									var panel = panelHeaders[i].closest('.components-panel__body');
									if (panel) {
										setTimeout(function() {
											panel.scrollIntoView({ behavior: 'smooth', block: 'center' });
										}, 300);
									}
									return;
								}
							}
						}, 500);
					}, 500);
				}

				/**
				 * Open Style settings for selected block
				 */
				function openStyleSettings(skipTooltip) {
					if (isDistractionFreeMode()) {
						return;
					}
					if (typeof wp !== 'undefined' && wp.data) {
						var selectedBlockId = wp.data.select('core/block-editor').getSelectedBlockClientId();
						if (!selectedBlockId) {
							return false;
						}
					}

					try {
						// Try Vexaltrix Style tab first (General / Style / Advance).
						var uagbStyleTab = document.querySelector('.vxt-inspector-tabs > div:nth-child(2)');
						if (uagbStyleTab) {
							uagbStyleTab.click();
							var sidebarPanel = uagbStyleTab.closest('.components-panel');
							if (sidebarPanel) {
								sidebarPanel.setAttribute('data-vxt-tab', 'style');
							}
							if (!skipTooltip) {
								highlightElement( uagbStyleTab, 5000, '" . esc_js( __( 'To open style settings click here.', 'vexaltrix' ) ) . "');
							}
							return true;
						}

						// Fallback: WordPress native Styles tab.
						var styleButton = document.querySelectorAll('.block-editor-block-inspector__tabs')[0].childNodes[0].childNodes[1];
						if (styleButton && typeof styleButton.click === 'function') {
							styleButton.click();
							if (!skipTooltip && !isStyleTabOpen()) {
								highlightElement( styleButton, 5000, '" . esc_js( __( 'To open style settings click here.', 'vexaltrix' ) ) . "');
							}
							return true;
						}
					} catch (error) {
						console.error('Error opening style settings:', error);
					}

					return false;
				}

				/**
				 * Handle specific learn actions
				 */
				function executeLearnAction(action) {
					if (learnActionState.executed && learnActionState.currentAction === action) {
						return; // Already processed
					}			

					learnActionState.executed = true;
					learnActionState.currentAction = action;

					switch (action) {
						case 'add-your-first-block':
							waitForEditor(() => {
								setTimeout(() => {
									if (openBlockInserter()) {
										// Remove hash after successful execution
										setTimeout(() => {
											if (window.history && window.history.replaceState) {
												window.history.replaceState({}, document.title, window.location.pathname + window.location.search);
											}
										}, 500);
									}
								}, 2000);
							});
							break;

						case 'insert-ready-made-sections':
							waitForEditor(() => {
								setTimeout(() => {
									waitForElement('#ast-block-templates-button-wrap', (element) => {
										if (isDistractionFreeMode()) {
											return;
										}
										highlightElement( element, 5000, '" . esc_js( __( 'To access design library click here.', 'vexaltrix' ) ) . "' );
										
										// Remove hash after successful execution
										setTimeout(() => {
											if (window.history && window.history.replaceState) {
												window.history.replaceState({}, document.title, window.location.pathname + window.location.search);
											}
										}, 500);
									}, 1000);
								}, 2000);
							});
							break;

						case 'replace-placeholder-content':
							waitForEditor(() => {
								setTimeout(() => {
									// Select existing info-box or insert one
									if (!selectVexaltrixBlock('vexaltrix/info-box')) {
										insertVexaltrixBlock('vexaltrix/info-box');
									}
									openContentPanel();
									// Remove hash after successful execution
									setTimeout(() => {
										if (window.history && window.history.replaceState) {
											window.history.replaceState({}, document.title, window.location.pathname + window.location.search);
										}
									}, 2000);
								}, 2000);
							});
							break;

						case 'customize-cta-sections':
							waitForEditor(() => {
								setTimeout(() => {
									// Try to select existing button child, if not found, add buttons block
									if (!selectButtonChild()) {
										// No buttons block found, create one
										if (insertVexaltrixBlock('vexaltrix/buttons')) {
											// After inserting, try to select the button child
											setTimeout(() => {
												selectButtonChild();
											}, 200);
										}
									}
									openContentPanel();
									// Remove hash after successful execution
									setTimeout(() => {
										if (window.history && window.history.replaceState) {
											window.history.replaceState({}, document.title, window.location.pathname + window.location.search);
										}
									}, 500);
								}, 2000);
							});
							break;

						case 'block-settings-styles':
							waitForEditor(() => {
								setTimeout(() => {
									// Select existing info-box or insert one
									if (!selectVexaltrixBlock('vexaltrix/info-box')) {
										insertVexaltrixBlock('vexaltrix/info-box');
									}

									// Open style tab after block is selected
									setTimeout(() => {
										openStyleSettings();
									}, 500);

									// Remove hash
									setTimeout(() => {
										if (window.history && window.history.replaceState) {
											window.history.replaceState({}, document.title, window.location.pathname + window.location.search);
										}
									}, 1000);
								}, 2000);
							});
							break;

						case 'find-global-styles-in-block-settings':
							waitForEditor(() => {
								setTimeout(() => {
									if (isDistractionFreeMode()) {
										return;
									}

									// Try to find and select an existing Vexaltrix block.
									var blocks = wp.data.select('core/block-editor').getBlocks();
									var foundVexaltrix = false;

									function findFirstVexaltrixBlock(blockList) {
										for (var i = 0; i < blockList.length; i++) {
											var block = blockList[i];
											if (block.name && block.name.startsWith('vexaltrix/')) {
												return block;
											}
											if (block.innerBlocks && block.innerBlocks.length > 0) {
												var inner = findFirstVexaltrixBlock(block.innerBlocks);
												if (inner) return inner;
											}
										}
										return null;
									}

									var vexaltrixBlock = findFirstVexaltrixBlock(blocks);
									if (vexaltrixBlock) {
										wp.data.dispatch('core/block-editor').selectBlock(vexaltrixBlock.clientId);
										foundVexaltrix = true;
									} else {
										// No Vexaltrix block found — insert a container as fallback.
										foundVexaltrix = insertVexaltrixBlock('vexaltrix/container');
									}

									if (!foundVexaltrix) {
										// Clean up hash even on failure.
										if (window.history && window.history.replaceState) {
											window.history.replaceState({}, document.title, window.location.pathname + window.location.search);
										}
										return;
									}

									// Wait for the inspector sidebar to update, then find the Global Styles ToolsPanel.
									setTimeout(() => {
										waitForElement('.components-tools-panel-header h2', (firstH2) => {
											// Iterate all ToolsPanel headers to find \"Global Styles\".
											var headers = document.querySelectorAll('.components-tools-panel-header h2');
											var globalStylesPanel = null;

											for (var i = 0; i < headers.length; i++) {
												if (headers[i].textContent.trim() === 'Global Styles') {
													globalStylesPanel = headers[i].closest('.components-tools-panel');
													break;
												}
											}

											if (globalStylesPanel) {
												globalStylesPanel.scrollIntoView({ behavior: 'smooth', block: 'center' });
												setTimeout(() => {
													highlightElement(globalStylesPanel, 5000, '" . esc_js( __( 'Apply Global Styles classes to blocks from this panel.', 'vexaltrix' ) ) . "');
												}, 300);
											}

											// Clean up hash.
											setTimeout(() => {
												if (window.history && window.history.replaceState) {
													window.history.replaceState({}, document.title, window.location.pathname + window.location.search);
												}
											}, 500);
										}, 8000);
									}, 1000);
								}, 2000);
							});
							break;

						case 'preveiw-your-changes':
							waitForEditor(() => {
								setTimeout(() => {
									if (openPreviewPanel()) {
										// Remove hash after successful execution
										setTimeout(() => {
											if (window.history && window.history.replaceState) {
												window.history.replaceState({}, document.title, window.location.pathname + window.location.search);
											}
										}, 500);
									}
								}, 2000);
							});
							break;

						case 'publish-your-page':
							waitForEditor(() => {
								setTimeout(() => {
									waitForElement('.editor-post-publish-button', (element) => {
										if (isDistractionFreeMode()) {
											return;
										}
										highlightElement( element, 5000, '" . esc_js( __( 'To publish/save your page click here.', 'vexaltrix' ) ) . "' );
										
										// Remove hash after successful execution
										setTimeout(() => {
											if (window.history && window.history.replaceState) {
												window.history.replaceState({}, document.title, window.location.pathname + window.location.search);
											}
										}, 500);
									}, 5000);
								}, 2000);
							});
							break;
					}
				}

				/**
				 * Main initialization function
				 */
				function init() {
					var hash = window.location.hash;
					
					// Check if hash matches any learn action
					var learnActions = [
						'add-your-first-block',
						'edit-block-settings',
						'insert-ready-made-sections',
						'replace-placeholder-content',
						'customize-cta-sections',
						'block-settings-styles',
						'find-global-styles-in-block-settings',
						'preveiw-your-changes',
						'publish-your-page'
					];

					var action = hash.replace('#learn-', '');
					if (learnActions.includes(action)) {
						executeLearnAction(action);
					}
				}

				// Run when script loads
				init();

				// Also listen for hash changes in case user navigates
				window.addEventListener('hashchange', function() {
					learnActionState.executed = false; // Reset state for new hash
					init();
				});

			} )();
			";

			wp_add_inline_script( 'wp-edit-post', $inlineScript );
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
			add_action( 'admin_enqueue_scripts', [ $this, 'enqueueLearnActionsScript' ] );
	}

}
}
