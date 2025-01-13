<?php
/**
 * Custom Post Types
 *
 * @link       https://www.kotisivu.dev
 * @since      0.1.0
 *
 * @package    HeikkiVihersalo\CustomPostTypes
 */

namespace HeikkiVihersalo\CustomPostTypes;

use WP_Error;
use HeikkiVihersalo\CustomPostTypes\Enqueue;
use HeikkiVihersalo\CustomPostTypes\Utils;

/**
 * Functionality for registering and handling custom post types
 *
 * @since      0.1.0
 * @package    HeikkiVihersalo\CustomPostTypes
 * @author     Heikki Vihersalo <heikki@vihersalo.fi>
 */
class CPTLoader {
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
	 * Constructor
	 *
	 * @since 0.1.0
	 * @access public
	 * @return void
	 */
	public function __construct( string $base_path, string $base_uri ) {
		$this->base_path = $base_path;
		$this->base_uri  = $base_uri;
	}

	/**
	 * Load custom post type classes dynamically
	 *
	 * @since 0.1.0
	 * @access public
	 * @return void
	 * @throws WP_Error If the class file does not exist.
	 */
	public function load_classes_dynamically( string $folder ): void {
		$classes = scandir( $this->base_path . $folder );

		foreach ( $classes as $class ) {
			// Remove unnecessary files (e.g. .gitignore, .DS_Store, ., .. etc.)
			if ( '.' === $class || '..' === $class || '.DS_Store' === $class || strpos( $class, '.' ) === true ) {
				continue;
			}

			$class = Utils::remove_file_extension( $class );
			$slug  = Utils::camelcase_to_kebabcase( $class );

			$classname = __NAMESPACE__ . '\\' . $folder . '\\' . $class;

			if ( ! class_exists( $classname ) ) {
				throw new WP_Error( 'invalid-class', __( 'The class you attempting to create does not exist.', 'heikkivihersalo-custom-post-types' ), $classname );
			}

			$class_instance = new $classname();
			$class_instance->register();
		}
	}

	/**
	 * Build custom post types
	 *
	 * @since 0.1.0
	 * @access public
	 * @return void
	 */
	protected function build_post_types(): void {
		$this->load_classes_dynamically( 'inc/post-types' );
	}

	/**
	 * Build custom taxonomies
	 *
	 * @since 0.1.0
	 * @access public
	 * @return void
	 */
	protected function build_taxonomies(): void {
		$this->load_classes_dynamically( 'inc/taxonomies' );
	}

	/**
	 * Register custom post types and taxonomies
	 *
	 * @since 0.1.0
	 * @access public
	 * @return void
	 */
	public function run() {
		// Add custom post types and taxonomies
		add_action( 'after_setup_theme', array( $this, 'build_post_types' ) );
		add_action( 'after_setup_theme', array( $this, 'build_taxonomies' ) );

		// Add scripts and styles
		$enqueue = new Enqueue( $this->base_uri );
		add_action( 'admin_enqueue_scripts', array( $enqueue, 'enqueue_editor_assets' ) );
	}
}
