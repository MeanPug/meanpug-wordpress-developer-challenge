<?php
/**
 * Idempotent seeder for the `property` CPT.
 *
 * Populates the demo stays from inc/data/listings.php so the home page shows
 * real CPT-backed content out of the box. Designed to be safe to run repeatedly:
 *
 *  - Each stay has a stable slug; an existing slug is skipped (no duplicates).
 *  - A one-time option guard prevents re-seeding on every admin load.
 *  - Seeding only ever happens on theme activation or in wp-admin — never during
 *    a front-end pageview (listing-grid.php falls back to the data file for the
 *    very first front-end render, so the page is always populated regardless).
 *
 * @package infra
 */

defined( 'ABSPATH' ) || exit;

/**
 * Insert any demo stays that don't already exist.
 *
 * @return void
 */
function inf_seed_properties() {
	if ( ! function_exists( 'inf_get_seed_listings' ) ) {
		return;
	}

	$meta_keys = array( 'title', 'distance', 'dates', 'price', 'price_unit', 'rating', 'review_count', 'badge', 'image' );

	foreach ( inf_get_seed_listings() as $index => $listing ) {
		$slug = 'doghouse-stay-' . ( $index + 1 );

		// Idempotency: never create the same stay twice.
		if ( get_page_by_path( $slug, OBJECT, 'property' ) instanceof WP_Post ) {
			continue;
		}

		$post_id = wp_insert_post(
			array(
				'post_type'   => 'property',
				'post_status' => 'publish',
				'post_title'  => $listing['location'],
				'post_name'   => $slug,
				'menu_order'  => (int) $index,
			),
			true
		);

		if ( is_wp_error( $post_id ) || ! $post_id ) {
			continue;
		}

		foreach ( $meta_keys as $meta_key ) {
			if ( isset( $listing[ $meta_key ] ) ) {
				update_post_meta( $post_id, '_inf_' . $meta_key, $listing[ $meta_key ] );
			}
		}
	}
}
add_action( 'after_switch_theme', 'inf_seed_properties' );

/**
 * One-time seed for environments that boot with this theme already active.
 *
 * Guarded by an autoloaded option so it runs at most once, and only in wp-admin
 * so we never write to the database during a front-end request.
 *
 * @return void
 */
function inf_maybe_seed_properties() {
	if ( '1' === get_option( 'inf_properties_seeded' ) ) {
		return;
	}

	inf_seed_properties();
	update_option( 'inf_properties_seeded', '1' );
}
add_action( 'admin_init', 'inf_maybe_seed_properties' );
