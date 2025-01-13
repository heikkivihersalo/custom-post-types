<?php
/**
 * Class for registering individual custom post type
 */

namespace MyTheme\Namespace;

use HeikkiVihersalo\CustomPostTypes\PostType;
use HeikkiVihersalo\CustomPostTypes\Interfaces\PostTypeInterface;

/**
 * Class for registering individual custom post type
 */
class Example extends PostType implements PostTypeInterface {
	/**
	 * @inheritDoc
	 */
	public function register(): void {
		$this->register_custom_post_type();
	}
}
