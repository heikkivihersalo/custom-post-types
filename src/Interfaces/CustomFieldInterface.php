<?php
/**
 * Custom field interface
 *
 * @package Kotisivu\BlockTheme
 * @since 0.1.0
 */

namespace HeikkiVihersalo\CustomPostTypes\Interfaces;

/**
 * Custom field interface
 *
 * @package HeikkiVihersalo\CustomPostTypes\Interfaces
 * @since 0.1.0
 */
interface CustomFieldInterface {
	/**
	 * Constructor
	 *
	 * @param string   $id    ID for field
	 * @param string   $label Label for field
	 * @param \WP_Post $post   WP_Post object
	 * @param array    $options Array of options for field
	 * @return void
	 */
	public function __construct( string $id, string $label = '', \WP_Post $post = null, array $options = array() );

	/**
	 * Get id
	 *
	 * @since 0.1.0
	 * @access public
	 * @return string
	 */
	public function get_id(): string;

	/**
	 * Get label
	 *
	 * @since 0.1.0
	 * @access public
	 * @return string
	 */
	public function get_label(): string;

	/**
	 * Get post
	 *
	 * @since 0.1.0
	 * @access public
	 * @return \WP_Post
	 */
	public function get_post(): \WP_Post;

	/**
	 * Get options
	 *
	 * @since 0.1.0
	 * @access public
	 * @return array
	 */
	public function get_options(): array;

	/**
	 * Get current value of field
	 *
	 * @since 0.1.0
	 * @access public
	 * @return string
	 */
	public function get_value(): string;

	/**
	 * Get field html
	 *
	 * @since 0.1.0
	 * @access public
	 * @param array  $field Data for field
	 * @param string $value Field value
	 * @return void
	 */
	public function get_html();

	/**
	 * Sanitize field
	 *
	 * @since 0.1.0
	 * @access public
	 * @param string $value Field value
	 * @return string
	 */
	public function sanitize( string $value ): string;

	/**
	 * Save field
	 *
	 * @since 0.1.0
	 * @access public
	 * @param int $post_id Post ID
	 * @return int
	 */
	public function save( int $post_id, array $options = array() ): void;

	/**
	 * Register rest field
	 *
	 * @since 0.1.0
	 * @access public
	 * @return void
	 */
	public function register_rest_field(): void;
}
