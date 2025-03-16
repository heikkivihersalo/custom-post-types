<?php

namespace HeikkiVihersalo\CustomPostTypes\CustomFields\Fields;

use HeikkiVihersalo\CustomPostTypes\CustomFields\CustomField;
use HeikkiVihersalo\CustomPostTypes\Interfaces\CustomFieldInterface;

/**
 *
 *
 * @package Kotisivu\BlockTheme
 * @since 1.0.0
 */
class TaxonomyRadioField extends CustomField implements CustomFieldInterface {
	/**
	 * @inheritDoc
	 */
	public function get_html(): string {
		if ( empty( $this->id ) ) {
			return __( 'ID is required', 'heikkivihersalo-custom-post-types' );
		}

		if ( empty( $this->taxonomy ) ) {
			return __( 'Taxonomy is required', 'heikkivihersalo-custom-post-types' );
		}

		$terms = get_terms(
			array(
				'taxonomy'   => $this->taxonomy,
				'hide_empty' => false, // Retrieve all terms
			)
		);

		ob_start();
		?>

		<tr>
			<th scope="row">
				<label for="<?php echo $this->taxonomy; ?>"><?php echo $this->get_label(); ?></label>
			</th>
			<td>
				<fieldset>
					<legend class="screen-reader-text">
						<span><?php echo $this->get_label(); ?></span>
					</legend>
					<?php if ( ! $terms ) : ?>
						<p><?php _e( 'No options', 'heikkivihersalo-custom-post-types' ); ?></p>
					<?php else : ?>
						<?php foreach ( $terms as $term ) : ?>
							<label for="<?php echo $term->slug; ?>">
								<input id="<?php echo $term->slug; ?>" type="radio" class="regular-text" name="tax_input[<?php echo $this->taxonomy; ?>][]" value="<?php echo $term->term_id; ?>" <?php checked( $this->get_taxonomy_value(), $term->term_id ); ?>>
								<?php echo $term->name; ?>
							</label>
						<?php endforeach; ?>
					<?php endif; ?>
				</fieldset>
			</td>
		</tr>

		<?php
		return ob_get_clean();
	}
}
