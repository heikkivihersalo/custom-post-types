<?php
/**
 * Class for registering individual taxonomy
 */

namespace MyTheme\Namespace;

use HeikkiVihersalo\CustomPostTypes\Taxonomy;
use HeikkiVihersalo\CustomPostTypes\Interfaces\TaxonomyInterface;

/**
 * Class for registering individual taxonomy
 */
class Example extends Taxonomy implements TaxonomyInterface {
	/**
	 * @inheritDoc
	 */
	public function register(): void {
		$this->register_custom_taxonomy();
	}

	/**
	 * @inheritDoc
	 */
	public function object_types(): string|array {
		return array(
			'example',
		);
	}
}
