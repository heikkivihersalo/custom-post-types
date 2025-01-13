<?php
/**
 * Utility functions
 *
 * @link       https://www.kotisivu.dev
 * @since      0.1.0
 *
 * @package    Kotisivu\BlockTheme\Theme\Common\Utils
 */

namespace HeikkiVihersalo\CustomPostTypes;

/**
 * Utility functions
 *
 * @since      0.1.0
 * @package    Kotisivu\BlockTheme\Theme\Common\Utils
 * @author     Heikki Vihersalo <heikki@vihersalo.fi>
 */
final class Utils {
	/**
	 * This utility class should never be instantiated.
	 */
	private function __construct() {
	}

	/**
	 * Write code on Method
	 *
	 * @since 0.1.0
	 * @access public
	 * @param  string $file String to convert
	 * @return string
	 */
	public static function camelcase_to_kebabcase( string $file ) {
		return strtolower( preg_replace( '/(?<!^)[A-Z]/', '-$0', $file ) );
	}

	/**
	 * Remove file extension from string
	 *
	 * @since 0.1.0
	 * @access public
	 * @param  string $file String to convert
	 * @return string
	 */
	public static function remove_file_extension( string $file ) {
		return str_replace( '.php', '', $file );
	}

	/**
	 * Check if the current page is the plugin's editor page
	 *
	 * @since    0.1.0
	 * @access   public
	 * @param string $hook The current admin page
	 * @return bool
	 */
	public static function is_editor_page( string $hook ): bool {
		return str_contains( $hook, 'post-new.php' ) || str_contains( $hook, 'post.php' );
	}

	/**
	 * Get the asset version
	 *
	 * @since   0.1.0
	 * @access  public
	 * @param   string $base_uri The base URI for the assets
	 * @param   string $name The name of the asset
	 * @return  string The version of the asset
	 */
	public static function get_asset_version( string $base_uri, string $name ): string {
		if ( file_exists( $base_uri . $name ) ) {
			return filemtime( $base_uri . $name );
		}

		return '0.1.0';
	}

	/**
	 * Returns the base URI for the custom post types, depending on whether it is used in a theme or a plugin.
	 * Note that function returns the path with a trailing slash.
	 *
	 * @since   0.1.0
	 * @access  public
	 * @return  string
	 */
	public static function get_base_path( string $package_name ): string {
		// If the library is used in a theme, get
		$file_to_check = get_stylesheet_directory() . '/vendor/' . $package_name . '/dist/main.js';

		if ( file_exists( $file_to_check ) ) {
			return get_stylesheet_directory();
		}

		// If the library is used in a plugin, use plugin_dir_path( __FILE__ ) instead
		$file_to_check = plugin_dir_path( __FILE__ ) . 'vendor/' . $package_name . '/dist/main.js';

		if ( file_exists( $file_to_check ) ) {
			return plugin_dir_path( __FILE__ ) . '/';
		}
	}

	/**
	 * Get the base URI for the assets
	 *
	 * @since   0.1.0
	 * @return  string
	 */
	public static function get_base_uri( string $package_name ): string {
		// If the library is used in a theme, get_stylesheet_directory_uri() should be used instead
		$folder = get_stylesheet_directory_uri() . '/vendor/' . $package_name . '/dist/';

		if ( file_exists( $folder . 'main.js' ) ) {
			return $folder;
		}

		// If the library is used in a plugin, use plugin_dir_url( __FILE__ ) instead
		$folder = plugin_dir_url( __FILE__ ) . 'vendor/' . $package_name . '/dist/';

		if ( file_exists( $folder . 'main.js' ) ) {
			return $folder;
		}
	}
}
