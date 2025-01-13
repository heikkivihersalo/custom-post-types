<?php
/**
 * Abstract class for registering custom post types
 *
 * @link       https://www.kotisivu.dev
 * @since      0.1.0
 *
 * @package    HeikkiVihersalo\CustomPostTypes
 */

namespace HeikkiVihersalo\CustomPostTypes;

use HeikkiVihersalo\CustomPostTypes\CustomFields;
use HeikkiVihersalo\CustomPostTypes\Traits\CustomPermalink;
use HeikkiVihersalo\CustomPostTypes\Interfaces\PostTypeInterface;

/**
 * Abstract class for registering custom post types
 *
 * @since      0.1.0
 * @package    HeikkiVihersalo\CustomPostTypes
 * @author     Heikki Vihersalo <heikki@vihersalo.fi>
 */
abstract class PostType implements PostTypeInterface {
	use CustomPermalink;

	/**
	 * Post type slug.
	 *
	 * @since 0.1.0
	 * @access public
	 * @var string
	 */
	public $slug;

	/**
	 * Post type name.
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
	public function register_custom_post_type(): void {
		/**
		 * Register post type
		 */
		register_post_type(
			$this->slug,
			array(
				'labels'       => $this->labels(),
				'public'       => true,
				'has_archive'  => true,
				'taxonomies'   => $this->taxonomies(),
				'rewrite'      => array(
					'slug' => ( ! empty( get_option( 'hv_custom_post_type_' . $this->slug ) ) ) ? get_option( 'hv_custom_post_type_' . $this->slug ) : $this->slug,
				),
				'supports'     => $this->supports(),
				'show_in_rest' => true,
				'menu_icon'    => $this->icon(),
			)
		);

		/**
		 * Add metaboxes
		 */
		if ( count( $this->metaboxes() ) > 0 ) {
			$custom_fields = new CustomFields(
				$this->metaboxes(),
				__( 'Custom Fields', 'heikkivihersalo-custom-post-types' ),
				array( $this->slug ),
			);

			$custom_fields->register();
		}

		/**
		 * Add permalink settings
		 */
		$this->add_permalink_setting( $this->slug, $this->name );
	}

	/**
	 * @inheritDoc
	 */
	public function labels(): array {
		return array(
			'name'               => $this->name,
			'singular_name'      => $this->name,
			'menu_name'          => $this->name,
			'name_admin_bar'     => $this->name,
			'add_new'            => 'Add New ' . $this->name,
			'add_new_item'       => 'Add New ' . $this->name,
			'new_item'           => 'New ' . $this->slug,
			'edit_item'          => 'Edit ' . $this->slug,
			'view_item'          => 'View ' . $this->slug,
			'all_items'          => 'All ' . $this->slug . 's',
			'search_items'       => 'Search ' . $this->slug . 's',
			'parent_item_colon'  => 'Parent ' . $this->slug . ':',
			'not_found'          => 'No ' . $this->slug . ' found.',
			'not_found_in_trash' => 'No ' . $this->slug . ' found in Trash.',
		);
	}

	/**
	 * @inheritDoc
	 */
	public function supports(): array {
		return array(
			'title',
			'editor',
			'thumbnail',
		);
	}

	/**
	 * @inheritDoc
	 */
	public function taxonomies(): array {
		return array();
	}

	/**
	 * @inheritDoc
	 */
	public function metaboxes(): array {
		return array(
			array(
				'id'    => 'text_input_1',
				'label' => __( 'Text Input 1', 'heikkivihersalo-custom-post-types' ),
				'type'  => 'text',
			),
			array(
				'id'    => 'textarea_input_1',
				'label' => __( 'TextArea Input', 'heikkivihersalo-custom-post-types' ),
				'type'  => 'textarea',
			),
			array(
				'id'    => 'url_input',
				'label' => __( 'URL Input', 'heikkivihersalo-custom-post-types' ),
				'type'  => 'url',
			),
			array(
				'id'    => 'number_input',
				'label' => __( 'Number Input', 'heikkivihersalo-custom-post-types' ),
				'type'  => 'number',
			),
			array(
				'id'    => 'checkbox_input',
				'label' => __( 'Checkbox Input', 'heikkivihersalo-custom-post-types' ),
				'type'  => 'checkbox',
			),
			array(
				'id'      => 'checkbox_group_input',
				'label'   => __( 'Checkbox Group Input', 'heikkivihersalo-custom-post-types' ),
				'type'    => 'checkbox-group',
				'options' => array(
					array(
						'value' => 'option1',
						'label' => 'Option 1',
					),
					array(
						'value' => 'option2',
						'label' => 'Option 2',
					),
					array(
						'value' => 'option3',
						'label' => 'Option 3',
					),
				),
			),
			array(
				'id'    => 'date_input',
				'label' => __( 'Date Input', 'heikkivihersalo-custom-post-types' ),
				'type'  => 'date',
			),
			array(
				'id'    => 'image_input',
				'label' => __( 'Image Input', 'heikkivihersalo-custom-post-types' ),
				'type'  => 'image',
			),
			array(
				'id'      => 'select_input',
				'label'   => __( 'Select Input', 'heikkivihersalo-custom-post-types' ),
				'type'    => 'select',
				'options' => array(
					array(
						'value' => 'option1',
						'label' => 'Option 1',
					),
					array(
						'value' => 'option2',
						'label' => 'Option 2',
					),
					array(
						'value' => 'option3',
						'label' => 'Option 3',
					),
				),
			),
			array(
				'id'    => 'rich_text_input',
				'label' => __( 'Rich Text Input', 'heikkivihersalo-custom-post-types' ),
				'type'  => 'rich-text',
			),
			array(
				'id'      => 'radio_group_input',
				'label'   => __( 'Radio Group Input', 'heikkivihersalo-custom-post-types' ),
				'type'    => 'radio-group',
				'options' => array(
					array(
						'value' => 'option1',
						'label' => 'Option 1',
					),
					array(
						'value' => 'option2',
						'label' => 'Option 2',
					),
					array(
						'value' => 'option3',
						'label' => 'Option 3',
					),
				),
			),
		);
	}

	/**
	 * @inheritDoc
	 */
	public function icon(): string {
		return 'dashicons-pressthis';
	}

	/**
	 * Register post type
	 *
	 * @since 0.1.0
	 * @access protected
	 * @return void
	 */
	abstract protected function register(): void;
}
