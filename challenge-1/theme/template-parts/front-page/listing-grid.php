<?php
/**
 * Front page partial: the listings grid.
 *
 * Renders the "stays" cards from the `property` custom post type via a lean
 * WP_Query (no_found_rows, no sticky posts). If the CPT hasn't been seeded yet
 * — e.g. on the very first front-end render after `docker compose up`, before
 * the admin-side seeder has run — it falls back to the local data file so the
 * page is always reproducible from a clean checkout. Either way, every card is
 * fed a normalised array, so listing-card.php has exactly one shape to render.
 *
 * @package infra
 */

defined( 'ABSPATH' ) || exit;

$doghouse_listings = array();

$doghouse_query = new WP_Query(
	array(
		'post_type'           => 'property',
		'post_status'         => 'publish',
		'posts_per_page'      => 6,
		'no_found_rows'       => true,
		'ignore_sticky_posts' => true,
		'orderby'             => array(
			'menu_order' => 'ASC',
			'date'       => 'ASC',
		),
	)
);

if ( $doghouse_query->have_posts() ) {
	while ( $doghouse_query->have_posts() ) {
		$doghouse_query->the_post();
		$doghouse_id = get_the_ID();

		$doghouse_listings[] = array(
			'location'     => get_the_title(),
			'title'        => get_post_meta( $doghouse_id, '_inf_title', true ),
			'distance'     => get_post_meta( $doghouse_id, '_inf_distance', true ),
			'dates'        => get_post_meta( $doghouse_id, '_inf_dates', true ),
			'price'        => get_post_meta( $doghouse_id, '_inf_price', true ),
			'price_unit'   => get_post_meta( $doghouse_id, '_inf_price_unit', true ),
			'rating'       => get_post_meta( $doghouse_id, '_inf_rating', true ),
			'review_count' => (int) get_post_meta( $doghouse_id, '_inf_review_count', true ),
			'badge'        => get_post_meta( $doghouse_id, '_inf_badge', true ),
			'image'        => get_post_meta( $doghouse_id, '_inf_image', true ),
			'url'          => get_permalink( $doghouse_id ),
		);
	}
	wp_reset_postdata();
}

// Reproducibility fallback: no seeded posts yet → render from the data file.
if ( empty( $doghouse_listings ) && function_exists( 'inf_get_seed_listings' ) ) {
	$doghouse_listings = inf_get_seed_listings();
}

if ( empty( $doghouse_listings ) ) {
	return;
}
?>
<section class="doghouse-listings" aria-labelledby="doghouse-listings-heading">
	<div class="container mx-auto px-6 py-8">
		<h2 id="doghouse-listings-heading" class="mb-6 font-brand text-2xl font-bold text-doghouse-ink">
			<?php esc_html_e( 'Best in Show stays', 'inf' ); ?>
		</h2>
		<ul class="m-0 grid list-none grid-cols-1 gap-x-6 gap-y-9 p-0 sm:grid-cols-2 lg:grid-cols-3">
			<?php
			foreach ( $doghouse_listings as $doghouse_listing ) {
				get_template_part( 'template-parts/front-page/listing', 'card', $doghouse_listing );
			}
			?>
		</ul>
	</div>
</section>
