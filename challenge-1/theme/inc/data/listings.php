<?php
/**
 * Front page seed data: the demo "stays".
 *
 * A single source of truth for the listings shown on the home page. Consumed by
 * the seeder (inc/data/seed-properties.php) to populate the `property` CPT, and
 * used directly as a reproducibility fallback by listing-grid.php when the CPT
 * hasn't been seeded yet. Image paths point at lightweight, local SVG artwork
 * shipped in assets/images/listings/ — no hotlinking, no media library needed.
 *
 * @package infra
 */

defined( 'ABSPATH' ) || exit;

/**
 * Return the demo listings as an array of normalised listing arrays.
 *
 * @return array<int, array<string, mixed>>
 */
function inf_get_seed_listings() {
	$images = get_stylesheet_directory_uri() . '/assets/images/listings/';

	return array(
		array(
			'location'     => __( 'Lake Bark Cabin', 'inf' ),
			'title'        => __( 'Entire cabin hosted by Daisy', 'inf' ),
			'distance'     => __( '42 miles away', 'inf' ),
			'dates'        => __( 'Nov 5 – 10', 'inf' ),
			'price'        => 129,
			'price_unit'   => __( 'night', 'inf' ),
			'rating'       => '4.95',
			'review_count' => 128,
			'badge'        => __( 'Best in Show', 'inf' ),
			'image'        => $images . 'listing-1.svg',
			'url'          => '#',
		),
		array(
			'location'     => __( 'The Golden Retreat', 'inf' ),
			'title'        => __( 'Lakehouse hosted by Marley', 'inf' ),
			'distance'     => __( '18 miles away', 'inf' ),
			'dates'        => __( 'Oct 22 – 27', 'inf' ),
			'price'        => 214,
			'price_unit'   => __( 'night', 'inf' ),
			'rating'       => '4.89',
			'review_count' => 96,
			'badge'        => __( 'Superhost', 'inf' ),
			'image'        => $images . 'listing-2.svg',
			'url'          => '#',
		),
		array(
			'location'     => __( 'Pawsteps Beach House', 'inf' ),
			'title'        => __( 'Beachfront home hosted by Luna', 'inf' ),
			'distance'     => __( '120 miles away', 'inf' ),
			'dates'        => __( 'Dec 1 – 6', 'inf' ),
			'price'        => 305,
			'price_unit'   => __( 'night', 'inf' ),
			'rating'       => '4.97',
			'review_count' => 211,
			'badge'        => __( 'Best in Show', 'inf' ),
			'image'        => $images . 'listing-3.svg',
			'url'          => '#',
		),
		array(
			'location'     => __( 'Wagging Tails Lodge', 'inf' ),
			'title'        => __( 'Mountain lodge hosted by Cooper', 'inf' ),
			'distance'     => __( '64 miles away', 'inf' ),
			'dates'        => __( 'Nov 12 – 17', 'inf' ),
			'price'        => 176,
			'price_unit'   => __( 'night', 'inf' ),
			'rating'       => '4.83',
			'review_count' => 74,
			'badge'        => '',
			'image'        => $images . 'listing-4.svg',
			'url'          => '#',
		),
		array(
			'location'     => __( 'Snout & About Loft', 'inf' ),
			'title'        => __( 'Downtown loft hosted by Bella', 'inf' ),
			'distance'     => __( '7 miles away', 'inf' ),
			'dates'        => __( 'Oct 30 – Nov 3', 'inf' ),
			'price'        => 142,
			'price_unit'   => __( 'night', 'inf' ),
			'rating'       => '4.91',
			'review_count' => 158,
			'badge'        => __( 'Superhost', 'inf' ),
			'image'        => $images . 'listing-5.svg',
			'url'          => '#',
		),
		array(
			'location'     => __( 'Cozy Corgi Cottage', 'inf' ),
			'title'        => __( 'Garden cottage hosted by Biscuit', 'inf' ),
			'distance'     => __( '33 miles away', 'inf' ),
			'dates'        => __( 'Nov 19 – 24', 'inf' ),
			'price'        => 98,
			'price_unit'   => __( 'night', 'inf' ),
			'rating'       => '4.78',
			'review_count' => 52,
			'badge'        => '',
			'image'        => $images . 'listing-6.svg',
			'url'          => '#',
		),
	);
}
