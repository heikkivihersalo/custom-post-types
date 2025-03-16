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
class TaxonomyCheckboxGroupField extends CustomField implements CustomFieldInterface {
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

		$selected = get_the_terms( get_the_ID(), $this->taxonomy );

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
								<input id="<?php echo $term->slug; ?>" type="checkbox" class="regular-text" name="tax_input[<?php echo $this->taxonomy; ?>][]" value="<?php echo $term->term_id; ?>" <?php echo $this->is_term_checked( $term->term_id, $selected ); ?>>
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

	/**
	 * @inheritDoc
	 */
	public function save( int $post_id, array $options = array() ): void {
		if ( empty( $this->taxonomy ) ) {
			return;
		}

		if ( isset( $_POST['tax_input'][ $this->taxonomy ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Missing
			$term_ids = array_map( 'intval', $_POST['tax_input'][ $this->taxonomy ] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
			wp_set_object_terms( $post_id, $term_ids, $this->taxonomy );
		} else {
			wp_set_object_terms( $post_id, array(), $this->taxonomy );
		}
	}
}
