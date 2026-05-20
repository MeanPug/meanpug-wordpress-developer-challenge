<?php
/**
 * Testimonial Slider render template.
 *
 * @package PugPuggle
 *
 * @var array $attributes
 */

if ( class_exists( '\\PugPuggle\\Assets' ) ) {
	\PugPuggle\Assets::enqueue_block( 'testimonial-slider' );
}

$heading = isset( $attributes['heading'] ) ? (string) $attributes['heading'] : __( 'What Clients Say', 'inf' );
$limit   = isset( $attributes['limit'] ) ? (int) $attributes['limit'] : 6;

$post_ids = array();
if ( class_exists( '\\PugPuggle\\Queries\\Testimonials' ) ) {
	$post_ids = (array) \PugPuggle\Queries\Testimonials::recent( array( 'limit' => $limit ) );
}
?>
<section class="inf-block inf-testimonial-slider py-16 px-6 max-w-7xl mx-auto">
	<?php if ( '' !== $heading ) : ?>
		<h2 class="text-3xl md:text-4xl font-bold text-center"><?php echo esc_html( $heading ); ?></h2>
	<?php endif; ?>

	<?php if ( ! empty( $post_ids ) ) : ?>
		<div
			class="mt-10 flex flex-col md:flex-row md:overflow-x-auto md:snap-x md:snap-mandatory gap-6"
			data-pugpuggle-slider
		>
			<?php
			foreach ( $post_ids as $post_id ) :
				$card_post = get_post( (int) $post_id );
				if ( ! $card_post ) {
					continue;
				}
				?>
				<div class="md:snap-start md:shrink-0 md:w-80 lg:w-96">
					<?php
					set_query_var( 'card_post', $card_post );
					get_template_part( 'template-parts/cards/content-testimonial-card' );
					?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php else : ?>
		<p class="mt-10 text-center text-stone-600"><?php esc_html_e( 'No testimonials found.', 'inf' ); ?></p>
	<?php endif; ?>
</section>
