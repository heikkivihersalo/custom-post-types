# Custom Post Types

This is an Laravel style implementation of custom post types in WordPress. It is meant to offer file based custom post types and taxonomies, which can be easily added to a WordPress theme or plugin.

> [!NOTE]
> Please not that this package is still in development and not yet ready for production use. There can be breaking changes as the wrapper and API develops further. If you want to use this package in production, please fork the repository and use your own version.

## TODO

- [ ] Add custom callback function for taxonomies
- [ ] Add basic tests for the package to ensure functionality
- [ ] Add more complex examples for the package
- [ ] Add rest of the WP methods to the `PostType` and `Taxonomy` classes

## Installation

To install the package, run the following command:

```bash
composer require heikkivihersalo/custom-post-types
```

## Usage

To use the API, you must first register the loader method somewhere in your theme or plugin. This will load all the custom post types and taxonomies dynamically from the `inc/post-types` and `inc/taxonomies` directories.

```php
function run_custom_post_types() {
	$cpt = new CPTLoader( SITE_PATH, SITE_URI, __NAMESPACE__ );
	$cpt->run();
}

run_custom_post_types();
```

`SITE_PATH` is the path to the theme or plugin directory, `SITE_URI` is the URI to the theme or plugin directory and `__NAMESPACE__` is the namespace of the theme or plugin.

You can also create your own loader but please do note, that `image` -type metabox requires javascript to run. Basic styles are loaded from WP directly, but there are some extra styles required for `image` -type metaboxes.

### Registering a custom post type

To register a custom post type, create a new PHP file in the `inc/post-types` directory. You can find example file from the `inc/post-types` directory. Filename should follow `camelCase` convention. This will be converted to correct slugs and names in the registration process. For example, `ExamplePostType.php` will be converted to `example-post-type` and `Example` will be converted to a slug `example`.

Basic structure of the file should be as follows:

```php

namespace MyTheme\Namespace;

use HeikkiVihersalo\CustomPostTypes\PostType;
use HeikkiVihersalo\CustomPostTypes\Interfaces\PostTypeInterface;

class Example extends PostType implements PostTypeInterface {
	/**
	 * @inheritDoc
	 */
	public function register(): void {
		$this->register_custom_post_type();
	}
}

```

Basically this is everything you need to register a custom post type. For more complex implementations, you can override the methods from the `PostType` class. For example, `labels()` method can be overridden to provide custom labels for the post type or `icon()` method can be overridden to provide custom arguments for the post type. 

Eventually this will include all the methods from the `register_post_type()` function, so you can override any of the methods from the parent class.

#### Registering metaboxes

To register metaboxes for the custom post type, you can use the `metaboxes()` method in the `PostType` class. Following array will add all available metaboxes to the custom post type.

Following metaboxes are available:

- Text
- Textarea
- URL
- Number
- Checkbox
- Checkbox Group
- Date
- Image
- Select
- Rich Text
- Radio Group

```php

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
```

### Registering a custom taxonomy

To register a custom taxonomy, create a new PHP file in the `inc/taxonomies` directory. You can find example file from the `inc/taxonomies` directory. Filename should follow `camelCase` convention. This will be converted to correct slugs and names in the registration process. For example, `ExampleTaxonomy.php` will be converted to `example-taxonomy` and `Example` will be converted to a slug `example`.

Basic structure of the file should be as follows:

```php

namespace MyTheme\Namespace;

use HeikkiVihersalo\CustomPostTypes\Taxonomy;
use HeikkiVihersalo\CustomPostTypes\Interfaces\TaxonomyInterface;

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
```
