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
use HeikkiVihersalo\CustomPostTypes\Interfaces\PostTypeInterface;

/**
 * Class for registering individual custom post type
 *
 * @since      0.1.0
 * @package    HeikkiVihersalo\CustomPostTypes\PostTypes
 * @author     Heikki Vihersalo <heikki@vihersalo.fi>
 */
class Example extends PostType implements PostTypeInterface {
	/**
	 * @inheritDoc
	 */
	public function register(): void {
		$this->register_custom_post_type();
	}
}
