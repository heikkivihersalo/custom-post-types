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
use HeikkiVihersalo\CustomPostTypes\Traits\FilePaths;

/**
 * Functionality for registering and handling custom post types
 *
 * @since      0.1.0
 * @package    HeikkiVihersalo\CustomPostTypes
 * @author     Heikki Vihersalo <heikki@vihersalo.fi>
 */
class CPTLoader {
	use FilePaths;

	/**
	 * Constructor
	 *
	 * @since 0.1.0
	 * @access public
	 * @param string $base_path Base path for the plugin.
	 * @param string $base_uri Base URI for the plugin.
	 * @return void
	 */
	public function __construct( string $base_path, string $base_uri, string $base_namespace ) {
		$this->base_path      = $base_path;
		$this->base_uri       = $base_uri;
		$this->base_namespace = $base_namespace;
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
		$classes = scandir( $this->get_path() . $folder );

		foreach ( $classes as $class ) {
			// Remove unnecessary files (e.g. .gitignore, .DS_Store, ., .. etc.)
			if ( '.' === $class || '..' === $class || '.DS_Store' === $class || strpos( $class, '.' ) === true ) {
				continue;
			}

			$path  = $this->get_path() . $folder . '/' . $class;
			$class = Utils::remove_file_extension( $class );
			$slug  = Utils::camelcase_to_kebabcase( $class );

			$classname = $this->get_namespace() . '\\' . $class;

			// Get the class file, only try to require if not already imported
			if ( ! class_exists( $classname ) ) {
				require $path;
			}

			if ( ! class_exists( $classname ) ) {
				return;
			}

			$class_instance = new $classname( $slug, $class );
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
	public function build_post_types(): void {
		$this->load_classes_dynamically( 'inc/post-types' );
	}

	/**
	 * Build custom taxonomies
	 *
	 * @since 0.1.0
	 * @access public
	 * @return void
	 */
	public function build_taxonomies(): void {
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
		$enqueue = new Enqueue( $this->base_path, $this->base_uri );
		add_action( 'admin_enqueue_scripts', array( $enqueue, 'enqueue_editor_assets' ) );
	}
}
