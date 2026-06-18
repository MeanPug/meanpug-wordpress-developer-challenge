<?php
/**
 * Office CPT.
 *
 * Physical firm locations. `inc/hooks.php` calls `mp_generate_office_schema()`
 * on `is_singular('office')`, which reads the ACF `address` group and
 * `geopoint` to emit LocalBusiness schema. Distinct from `local` (Areas Served
 * are SEO landing pages; offices are real bricks-and-mortar locations).
 *
 * @package infra
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the `office` post type.
 *
 * @return void
 */
function inf_register_office_cpt() {
	inf_register_post_type(
		'office',
		esc_html__( 'Office', 'inf' ),
		esc_html__( 'Offices', 'inf' ),
		array(
			'menu_icon' => 'dashicons-bank',
			'supports'  => array( 'title', 'editor', 'thumbnail' ),
			'rewrite'   => array( 'slug' => 'offices' ),
		)
	);
}
add_action( 'init', 'inf_register_office_cpt' );
