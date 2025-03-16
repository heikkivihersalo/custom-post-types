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
class TaxonomySelectField extends CustomField implements CustomFieldInterface {
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
				<label for="<?php echo $this->taxonomy; ?>">
					<?php echo $this->get_label(); ?>
				</label>
			</th>
			<td>
				<?php if ( ! $terms ) : ?>
					<p><?php _e( 'No options', 'heikkivihersalo-custom-post-types' ); ?></p>
				<?php else : ?>
					<select name="tax_input[<?php echo $this->taxonomy; ?>][]" id="<?php echo $this->taxonomy; ?>">
						<option value="" <?php echo selected( $this->get_taxonomy_value(), '' ); ?> disabled>
							<?php _e( 'Set Value', 'heikkivihersalo-custom-post-types' ); ?>
						</option>
						<?php foreach ( $terms as $term ) : ?>
							<option value="<?php echo $term->term_id; ?>" <?php echo selected( $this->get_taxonomy_value(), $term->term_id ); ?>>
								<?php echo $term->name; ?>
							</option>
						<?php endforeach; ?>
					</select>
				<?php endif; ?>
			</td>
		</tr>

		<?php
		return ob_get_clean();
	}
}
