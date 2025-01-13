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
interface TaxonomyInterface {
	/**
	 * Register custom taxonomy
	 *
	 * @since 0.1.0
	 * @access public
	 * @return void
	 */
	public function register_custom_taxonomy(): void;

	/**
	 * Custom Post Type Labels for post type
	 *
	 * @since 0.1.0
	 * @access public
	 * @return array
	 */
	public function labels();

	/**
	 * Whether a taxonomy is intended for use publicly either via the admin interface or by front-end users.
	 * The default settings of $publicly_queryable, $show_ui, and $show_in_nav_menus are inherited from $public
	 *
	 * @since 0.1.0
	 * @access public
	 * @return bool
	 */
	public function public(): bool;

	/**
	 * Hierarchical
	 *
	 * @since 0.1.0
	 * @access public
	 * @return bool
	 */
	public function hierarchical(): bool;

	/**
	 * Rewrite
	 *
	 * @since 0.1.0
	 * @access public
	 * @return string
	 */
	public function rewrite(): bool|array;

	/**
	 * Show admin column
	 *
	 * @since 0.1.0
	 * @access public
	 * @return bool
	 */
	public function show_admin_column(): bool;

	/**
	 * Get arguments
	 *
	 * @since 0.1.0
	 * @access public
	 * @return array
	 */
	public function get_arguments(): array;
}
