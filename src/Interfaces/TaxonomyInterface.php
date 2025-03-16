<?php
/**
 * Post Type Interface
 * @package Kotisivu\BlockTheme
 * @since 0.1.0
 */

namespace HeikkiVihersalo\CustomPostTypes\Interfaces;

use WP_Term;

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
	 * Register custom taxonomy callbacks
	 *
	 * @since 0.2.0
	 * @access public
	 * @return void
	 */
	public function register_custom_taxonomy_callbacks(): void;

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
	 * Whether the taxonomy is publicly queryable.
	 *
	 * @since 0.2.0
	 * @access public
	 * @return bool
	 */
	public function publicly_queryable(): bool;

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
	 * Show in quick edit
	 *
	 * @since 0.2.0
	 * @access public
	 * @return bool
	 */
	public function show_in_quick_edit(): bool;

	/**
	 * Meta box callback
	 *
	 * @since 0.2.0
	 * @access public
	 * @return string
	 */
	public function meta_box_cb(): string;

	/**
	 * Object types
	 *
	 * @since 0.2.0
	 * @access public
	 * @return string|array
	 */
	public function object_types(): string|array;

	/**
	 * Show image field
	 *
	 * @since 0.2.0
	 * @access public
	 * @return bool
	 */
	public function show_image_field(): bool;

	/**
	 * Get term image html
	 *
	 * @since 0.2.0
	 * @access public
	 * @param WP_Term $term Term object.
	 * @return void
	 */
	public function get_term_image_html( WP_Term $term ): void;

	/**
	 * Add term image
	 *
	 * @since 0.2.0
	 * @access public
	 * @param int $term_id Term ID.
	 * @param int $term_taxonomy_id Term taxonomy ID.
	 * @return void
	 */
	public function add_term_image( int $term_id, int $term_taxonomy_id ): void;


	/**
	 * Update term image
	 *
	 * @since 0.2.0
	 * @access public
	 * @param int $term_id Term ID.
	 * @param int $term_taxonomy_id Term taxonomy ID.
	 * @return void
	 */
	public function update_term_image( int $term_id, int $term_taxonomy_id ): void;

	/**
	 * Get arguments
	 *
	 * @since 0.1.0
	 * @access public
	 * @return array
	 */
	public function get_arguments(): array;
}
