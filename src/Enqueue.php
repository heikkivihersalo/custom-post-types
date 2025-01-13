<?php
/**
 * Enqueue scripts and styles
 *
 * @link       https://www.kotisivu.dev
 * @since      0.1.0
 *
 * @package    HeikkiVihersalo\CustomPostTypes
 */

namespace HeikkiVihersalo\CustomPostTypes;

use HeikkiVihersalo\CustomPostTypes\Traits\FilePaths;
use HeikkiVihersalo\CustomPostTypes\Utils;

/**
 * Enqueue scripts and styles
 *
 * @since      0.1.0
 * @package    HeikkiVihersalo\CustomPostTypes
 * @author     Heikki Vihersalo <heikki@vihersalo.fi>
 */
class Enqueue {
	use FilePaths;

	/**
	 * Constructor
	 *
	 * @since 0.1.0
	 * @param string $base_path The base path
	 * @param string $base_uri The base URI
	 * @return void
	 */
	public function __construct( string $base_path, string $base_uri ) {
		$this->base_path = $base_path;
		$this->base_uri  = $base_uri;
	}

	/**
	 * Run the editor scripts and styles
	 *
	 * @since    0.2.0
	 * @param string $hook The current admin page
	 * @return void
	 */
	public function enqueue_editor_assets( string $hook = '' ): void {
		if ( ! Utils::is_editor_page( $hook ) ) {
			return;
		}

		wp_enqueue_script(
			'hv-custom-post-types',
			$this->get_uri( 'dist/main.js' ),
			array(),
			Utils::get_asset_version( $this->get_path( 'dist/main.js' ) ),
			true
		);

		wp_enqueue_style(
			'hv-custom-post-types',
			$this->get_uri( 'dist/main.css' ),
			array(),
			Utils::get_asset_version( $this->get_path( 'dist/main.css' ) ),
			'all'
		);
	}
}
