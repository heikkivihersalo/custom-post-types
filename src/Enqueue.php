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

use HeikkiVihersalo\CustomPostTypes\Utils;

/**
 * Enqueue scripts and styles
 *
 * @since      0.1.0
 * @package    HeikkiVihersalo\CustomPostTypes
 * @author     Heikki Vihersalo <heikki@vihersalo.fi>
 */
class Enqueue {
	/**
	 * Asset base URI
	 *
	 * @since   0.1.0
	 * @var     string
	 * @access  public
	 */
	public string $asset_base_uri;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->asset_base_uri = Utils::get_base_uri( 'heikkivihersalo/custom-post-types' );
	}

	/**
	 * Run the editor scripts and styles
	 *
	 * @since    0.2.0
	 * @param string $hook The current admin page
	 * @return void
	 */
	public function enqueue_scripts_and_styles( string $hook = '' ): void {
		if ( ! Utils::is_editor_page( $hook ) ) {
			return;
		}

		if ( ! $this->asset_base_uri ) {
			return;
		}

		wp_enqueue_script(
			'hv-custom-post-types',
			$this->asset_base_uri . 'main.js',
			array(),
			Utils::get_asset_version( $this->asset_base_uri, 'main.js' ),
			true
		);
		wp_enqueue_style(
			'hv-custom-post-types',
			$this->asset_base_uri . 'main.css',
			array(),
			Utils::get_asset_version( $this->asset_base_uri, 'main.css' ),
			'all'
		);
	}
}
