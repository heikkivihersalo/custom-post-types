<?php
/**
 * Trait for file paths
 *
 * @link       https://www.kotisivu.dev
 * @since      0.1.0
 *
 * @package    HeikkiVihersalo\CustomPostTypes\Traits
 */

namespace HeikkiVihersalo\CustomPostTypes\Traits;

/**
 * Trait for file paths
 *
 * @since      0.1.0
 * @package    HeikkiVihersalo\CustomPostTypes\Traits
 * @author     Heikki Vihersalo <heikki@vihersalo.fi>
 */
trait FilePaths {
	/**
	 * Base path for files
	 * This is used to determine where the custom post type and taxonomy classes are located.
	 * E.g.
	 *  - If the library is used in a theme, the base path would be the theme directory.
	 *  - And if the library is used in a plugin, the base path would be the plugin directory.
	 *
	 * @since   0.1.0
	 * @var     string
	 * @access  public
	 */
	public string $base_path;

	/**
	 * Base URI for files
	 * This is used to determine where the custom post type and taxonomy classes are located.
	 * E.g.
	 *  - If the library is used in a theme, the base URI would be the theme directory URI.
	 *  - And if the library is used in a plugin, the base URI would be the plugin directory URI.
	 *
	 * @since   0.1.0
	 * @var     string
	 * @access  public
	 */
	public string $base_uri;

	/**
	 * Base namespace for files
	 * This is used to determine the namespace for the custom post type and taxonomy classes.
	 *
	 * @since   0.1.0
	 * @var     string
	 * @access  public
	 */
	public string $base_namespace;

	/**
	 * Get URI for file
	 *
	 * @since 0.1.0
	 * @access public
	 * @param  string $path Path to append to base path
	 * @return string
	 */
	public function get_uri( string $path = '' ): string {
		return rtrim( $this->base_uri, '/\\' ) . '/' . $path;
	}

	/**
	 * Get path for file
	 *
	 * @since 0.1.0
	 * @access public
	 * @param  string $path Path to append to base path
	 * @return string
	 */
	public function get_path( string $path = '' ): string {
		return rtrim( $this->base_path, '/\\' ) . '/' . $path;
	}

	/**
	 * Get namespace for file
	 *
	 * @since 0.1.0
	 * @access public
	 * @return string
	 */
	public function get_namespace(): string {
		return $this->base_namespace;
	}
}
