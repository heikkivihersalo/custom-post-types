<?php

/**
 * Class for registering individual taxonomy
 *
 * @link       https://www.kotisivu.dev
 * @since      0.1.0
 *
 * @package    HeikkiVihersalo\CustomPostTypes\Taxonomies
 */

namespace HeikkiVihersalo\CustomPostTypes\Taxonomies;

use HeikkiVihersalo\CustomPostTypes\Taxonomy;

/**
 * Class for registering individual taxonomy
 *
 * @since      0.1.0
 * @package    HeikkiVihersalo\CustomPostTypes\Taxonomies
 * @author     Heikki Vihersalo <heikki@vihersalo.fi>
 */
class Example extends Taxonomy {
	/**
	 * Register taxonomy
	 *
	 * @since 0.1.0
	 * @access public
	 * @return void
	 */
	public function register(): void {
		$this->register_custom_taxonomy();
	}

	/**
	 * Object types
	 * 
	 * @since 0.1.0
	 * @access public
	 * @return string|array
	 */
	public function object_types(): string|array {
		return array(
			'example',
		);
	}
}
