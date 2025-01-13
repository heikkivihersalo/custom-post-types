<?php
/**
 * Class for registering individual custom post type
 *
 * @link       https://www.kotisivu.dev
 * @since      0.1.0
 *
 * @package    HeikkiVihersalo\CustomPostTypes\PostTypes
 */

namespace HeikkiVihersalo\CustomPostTypes\PostTypes;

use HeikkiVihersalo\CustomPostTypes\PostType;

/**
 * Class for registering individual custom post type
 *
 * @since      0.1.0
 * @package    HeikkiVihersalo\CustomPostTypes\PostTypes
 * @author     Heikki Vihersalo <heikki@vihersalo.fi>
 */
class Example extends PostType {
	/**
	 * Register post type
	 *
	 * @since 0.1.0
	 * @access public
	 * @return void
	 */
	public function register(): void {
		$this->register_custom_post_type();
	}
}
