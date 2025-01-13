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

/**
 * Abstract class for registering custom taxonomies
 *
 * @since      0.1.0
 * @package    HeikkiVihersalo\CustomPostTypes
 * @author     Heikki Vihersalo <heikki@vihersalo.fi>
 */
abstract class Taxonomy {
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
    public function __construct(string $slug, string $name) {
        $this->slug = $slug;
        $this->name = $name;
    }

    /**
     * Register custom taxonomy
     *
     * @since 0.1.0
     * @access public
     * @return void
     */
    public function register_custom_taxonomy(): void {
        register_taxonomy(
            $this->slug,
            $this->object_types(),
            $this->get_arguments()
        );
    }

    /**
     * Custom Post Type Labels for post type
     *
     * @since 0.1.0
     * @access public
     * @return array
     */
    public function labels() {
        return array();
    }

    /**
     * Whether a taxonomy is intended for use publicly either via the admin interface or by front-end users.
     * The default settings of $publicly_queryable, $show_ui, and $show_in_nav_menus are inherited from $public
     * 
     * @since 0.1.0
     * @access public
     * @return bool
     */
    public function public(): bool {
        return true;
    }

    /**
     * Hierarchical
     * 
     * @since 0.1.0
     * @access public
     * @return bool
     */
    public function hierarchical(): bool {
        return true;
    }

    /**
     * Rewrite
     *
     * @since 0.1.0
     * @access public
     * @return string
     */
    public function rewrite(): bool|array {
        return array(
            'slug' => $this->slug,
            'with_front' => true,
            'hierarchical' => false,
        );
    }

    /**
     * Show admin column
     * 
     * @since 0.1.0
     * @access public
     * @return bool
     */
    public function show_admin_column(): bool {
        return true;
    }

    /**
     * Object types
     * 
     * @since 0.1.0
     * @access public
     * @return string|array
     */
    public function object_types(): string|array {
        return array();
    }

    /**
     * Get arguments
     *
     * @since 0.1.0
     * @access public
     * @return array
     */
    public function get_arguments(): array {
        $args = array(
            'public' => $this->public(),
            'show_admin_column' => $this->show_admin_column(),
            'hierarchical' => $this->hierarchical(),
            'rewrite' => $this->rewrite(),
        );

        if (count($this->labels()) !== 0) {
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
}
