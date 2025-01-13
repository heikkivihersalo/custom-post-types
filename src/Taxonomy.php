<?php
/**
 * Abstract class for registering custom taxonomies
 *
 * @link       https://www.kotisivu.dev
 * @since      0.1.0
 *
 * @package    HeikkiVihersalo\CustomPostTypes
 */

namespace HeikkiVihersalo\CustomPostTypes;

use HeikkiVihersalo\CustomPostTypes\Interfaces\TaxonomyInterface;

/**
 * Abstract class for registering custom taxonomies
 *
 * @since      0.1.0
 * @package    HeikkiVihersalo\CustomPostTypes
 * @author     Heikki Vihersalo <heikki@vihersalo.fi>
 */
abstract class Taxonomy implements TaxonomyInterface {
	/**
	 * Taxonomy type slug.
	 *
	 * @since 0.1.0
	 * @access public
	 * @var string
	 */
	public $slug;

	/**
	 * Taxonomy type name.
	 *
	 * @since 0.1.0
	 * @access public
	 * @var string
	 */
	public $name;

	/**
	 * Constructor
	 *
	 * @since    0.1.0
	 * @access   public
	 */
	public function __construct( string $slug, string $name ) {
		$this->slug = $slug;
		$this->name = $name;
	}

	/**
	 * @inheritDoc
	 */
	public function register_custom_taxonomy(): void {
		register_taxonomy(
			$this->slug,
			$this->object_types(),
			$this->get_arguments()
		);
	}

	/**
	 * @inheritDoc
	 */
	public function labels() {
		return array();
	}

	/**
	 * @inheritDoc
	 */
	public function public(): bool {
		return true;
	}

	/**
	 * @inheritDoc
	 */
	public function hierarchical(): bool {
		return true;
	}

	/**
	 * @inheritDoc
	 */
	public function rewrite(): bool|array {
		return array(
			'slug'         => $this->slug,
			'with_front'   => true,
			'hierarchical' => false,
		);
	}

	/**
	 * @inheritDoc
	 */
	public function show_admin_column(): bool {
		return true;
	}

	/**
	 * @inheritDoc
	 */
	public function get_arguments(): array {
		$args = array(
			'public'            => $this->public(),
			'show_admin_column' => $this->show_admin_column(),
			'hierarchical'      => $this->hierarchical(),
			'rewrite'           => $this->rewrite(),
		);

		if ( count( $this->labels() ) !== 0 ) {
			$args['labels'] = $this->labels();
		}

		return $args;
	}

	/**
	 * Register taxonomy
	 *
	 * @since 0.1.0
	 * @access protected
	 * @return void
	 */
	abstract protected function register(): void;

	/**
	 * Object types
	 *
	 * @since 0.1.0
	 * @access public
	 * @return string|array
	 */
	abstract protected function object_types(): string|array;
}
