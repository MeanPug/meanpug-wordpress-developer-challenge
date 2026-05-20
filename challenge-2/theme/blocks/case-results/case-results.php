<?php
/**
 * Case Results render template.
 *
 * @package PugPuggle
 *
 * @var array $attributes
 */

if ( class_exists( '\\PugPuggle\\Assets' ) ) {
	\PugPuggle\Assets::enqueue_block( 'case-results' );
}

$heading       = isset( $attributes['heading'] ) ? (string) $attributes['heading'] : __( 'Recent Results', 'inf' );
$limit         = isset( $attributes['limit'] ) ? (int) $attributes['limit'] : 6;
$practice_area = isset( $attributes['practiceArea'] ) ? (int) $attributes['practiceArea'] : 0;

$args = array( 'limit' => $limit );
if ( $practice_area > 0 ) {
	$args['practice_area'] = $practice_area;
}

$post_ids = array();
if ( class_exists( '\\PugPuggle\\Queries\\Case_Results' ) ) {
	$post_ids = (array) \PugPuggle\Queries\Case_Results::recent( $args );
}

// Prime post/meta/term caches in a single round-trip — avoids per-iteration N+1 queries.
if ( ! empty( $post_ids ) ) {
	_prime_post_caches( array_map( 'intval', $post_ids ), true, true );
}
?>
<section class="inf-block inf-case-results py-16 px-6 max-w-7xl mx-auto">
	<?php if ( '' !== $heading ) : ?>
		<h2 class="text-3xl md:text-4xl font-bold text-center"><?php echo esc_html( $heading ); ?></h2>
	<?php endif; ?>

	<?php if ( ! empty( $post_ids ) ) : ?>
		<div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-6">
			<?php
			foreach ( $post_ids as $post_id ) :
				$card_post = get_post( (int) $post_id );
				if ( ! $card_post ) {
					continue;
				}
				set_query_var( 'card_post', $card_post );
				get_template_part( 'template-parts/cards/content-case-result-card' );
			endforeach;
			?>
		</div>
	<?php else : ?>
		<p class="mt-10 text-center text-stone-600"><?php esc_html_e( 'No case results found.', 'inf' ); ?></p>
	<?php endif; ?>
</section>
