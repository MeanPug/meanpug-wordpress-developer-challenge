<?php
/**
 * Attorney Grid render template.
 *
 * @package PugPuggle
 *
 * @var array $attributes
 */

if ( class_exists( '\\PugPuggle\\Assets' ) ) {
	\PugPuggle\Assets::enqueue_block( 'attorney-grid' );
}

$heading   = isset( $attributes['heading'] ) ? (string) $attributes['heading'] : __( 'Our Attorneys', 'inf' );
$intro     = isset( $attributes['intro'] ) ? (string) $attributes['intro'] : '';
$limit     = isset( $attributes['limit'] ) ? (int) $attributes['limit'] : 6;
$specialty = isset( $attributes['specialty'] ) ? (int) $attributes['specialty'] : 0;

$args = array( 'limit' => $limit );
if ( $specialty > 0 ) {
	$args['specialty'] = $specialty;
}

$post_ids = array();
if ( class_exists( '\\PugPuggle\\Queries\\Attorneys' ) ) {
	$post_ids = (array) \PugPuggle\Queries\Attorneys::cards( $args );
}

// Prime post/meta/term caches in a single round-trip — avoids per-iteration N+1 queries.
if ( ! empty( $post_ids ) ) {
	_prime_post_caches( array_map( 'intval', $post_ids ), true, true );
}
?>
<section class="inf-block inf-attorney-grid py-16 px-6 max-w-7xl mx-auto">
	<?php if ( '' !== $heading ) : ?>
		<h2 class="text-3xl md:text-4xl font-bold text-center"><?php echo esc_html( $heading ); ?></h2>
	<?php endif; ?>

	<?php if ( '' !== $intro ) : ?>
		<p class="mt-4 text-lg text-center max-w-3xl mx-auto"><?php echo esc_html( $intro ); ?></p>
	<?php endif; ?>

	<?php if ( ! empty( $post_ids ) ) : ?>
		<div class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
			<?php
			foreach ( $post_ids as $post_id ) :
				$card_post = get_post( (int) $post_id );
				if ( ! $card_post ) {
					continue;
				}
				set_query_var( 'card_post', $card_post );
				get_template_part( 'template-parts/cards/content-attorney-card' );
			endforeach;
			?>
		</div>
	<?php else : ?>
		<p class="mt-10 text-center text-stone-600"><?php esc_html_e( 'No attorneys found.', 'inf' ); ?></p>
	<?php endif; ?>
</section>
