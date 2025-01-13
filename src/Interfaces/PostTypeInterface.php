<?php
/**
 * Post Type Interface
 * @package Kotisivu\BlockTheme
 * @since 0.1.0
 */

namespace HeikkiVihersalo\CustomPostTypes\Interfaces;

/**
 * Post Type Interface
 *
 * @package HeikkiVihersalo\CustomPostTypes\Interfaces
 * @since 0.1.0
 */
interface PostTypeInterface {
	/**
	 * Register post type
	 *
	 * @since 0.1.0
	 * @access public
	 * @return void
	 */
	public function register_custom_post_type(): void;

	/**
	 * Custom Post Type Labels for post type
	 *
	 * @since 0.1.0
	 * @access public
	 * @return array
	 */
	public function labels(): array;

	/**
	 * Add support for post type
	 *
	 * @since 0.1.0
	 * @access public
	 * @return array
	 */
	public function supports(): array;

	/**
	 * Taxonomies for post type
	 *
	 * @since 0.1.0
	 * @access public
	 * @return array
	 */
	public function taxonomies(): array;

	/**
	 * Add metaboxes
	 *
	 * @since 0.1.0
	 * @access public
	 * @return array
	 */
	public function metaboxes(): array;

	/**
	 * Icon for post type
	 *
	 * @since 0.1.0
	 * @access public
	 * @return string
	 */
	public function icon(): string;
}
