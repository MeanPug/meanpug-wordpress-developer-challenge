<?php
/**
 * Free Consultation CTA widget.
 *
 * Renders a sticky call-to-action card promoting a free consultation,
 * including the firm's phone number and a button linking to the contact page.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Widgets;

/**
 * Class Free_Consultation_CTA
 *
 * WP_Widget that surfaces a free-consultation CTA in any sidebar.
 *
 * @package PugPuggle
 */
class Free_Consultation_CTA extends \WP_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		parent::__construct(
			'pugpuggle_free_consultation',
			__( 'Free Consultation CTA', 'inf' ),
			[
				'description' => __( 'Sticky free consultation call-to-action card.', 'inf' ),
			]
		);
	}

	/**
	 * Front-end widget output.
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved widget instance.
	 * @return void
	 */
	public function widget( $args, $instance ) {
		$title = ! empty( $instance['title'] )
			? (string) $instance['title']
			: __( 'Free 24/7 Consultation', 'inf' );

		$phone_field = function_exists( 'get_field' ) ? get_field( 'contact_phone', 'option' ) : null;
		$phone_url   = '';
		$phone_label = '';

		if ( is_array( $phone_field ) ) {
			$phone_url   = isset( $phone_field['url'] ) ? (string) $phone_field['url'] : '';
			$phone_label = isset( $phone_field['title'] ) ? (string) $phone_field['title'] : '';
		} elseif ( is_string( $phone_field ) && '' !== $phone_field ) {
			$phone_label = $phone_field;
			$phone_url   = 'tel:' . preg_replace( '/[^0-9+]/', '', $phone_field );
		}

		$cta_url = function_exists( 'get_field' ) ? get_field( 'contact_cta_url', 'option' ) : '';
		if ( empty( $cta_url ) ) {
			$cta_url = home_url( '/contact/' );
		}

		echo wp_kses_post( $args['before_widget'] );
		?>
		<aside class="pugpuggle-free-consultation bg-stone-100 p-6 rounded-lg shadow-md">
			<?php if ( ! empty( $title ) ) : ?>
				<h3 class="text-xl font-bold mb-3">
					<?php echo esc_html( $title ); ?>
				</h3>
			<?php endif; ?>
			<p class="mb-4 text-sm">
				<?php esc_html_e( 'Talk to a member of our team any time, day or night. Free, confidential, and no obligation.', 'inf' ); ?>
			</p>
			<?php if ( '' !== $phone_label && '' !== $phone_url ) : ?>
				<p class="mb-4 text-sm">
					<a href="<?php echo esc_url( $phone_url ); ?>" class="font-semibold text-stone-900 hover:underline">
						<?php echo esc_html( $phone_label ); ?>
					</a>
				</p>
			<?php elseif ( '' !== $phone_label ) : ?>
				<p class="mb-4 text-sm font-semibold text-stone-900">
					<?php echo esc_html( $phone_label ); ?>
				</p>
			<?php endif; ?>
			<a
				href="<?php echo esc_url( $cta_url ); ?>"
				class="inline-block bg-stone-900 text-white px-6 py-3 rounded font-semibold hover:bg-stone-800 transition"
			>
				<?php esc_html_e( 'Schedule a Call', 'inf' ); ?>
			</a>
		</aside>
		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	/**
	 * Back-end widget form.
	 *
	 * @param array $instance Previously saved instance.
	 * @return string
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? (string) $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'Title:', 'inf' ); ?>
			</label>
			<input
				class="widefat"
				id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				type="text"
				value="<?php echo esc_attr( $title ); ?>"
			>
		</p>
		<?php
		return '';
	}

	/**
	 * Sanitize widget form values before saving.
	 *
	 * @param array $new_instance Values just sent.
	 * @param array $old_instance Previously saved values.
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = isset( $new_instance['title'] )
			? sanitize_text_field( (string) $new_instance['title'] )
			: '';

		return $instance;
	}
}
