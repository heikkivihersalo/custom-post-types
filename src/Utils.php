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
	 * @param   string $path The path to the asset
	 * @return  string The version of the asset
	 */
	public static function get_asset_version( string $path ): string {
		if ( file_exists( $path ) ) {
			return filemtime( $path );
		}

		return '0.1.0';
	}
}
