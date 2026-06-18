<?php
/**
 * Testimonials CPT.
 *
 * Client reviews. Surfaced through the Related Practice Areas widget and the
 * testimonials archive (`is_post_type_archive('testimonials')` in
 * `inc/hooks.php`) which emits Review/Product schema via
 * `inc/utils/seo/schema.php`. The slug MUST stay `testimonials` to match the
 * theme's existing queries.
 *
 * @package infra
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the `testimonials` post type.
 *
 * @return void
 */
function inf_register_testimonials_cpt() {
	inf_register_post_type(
		'testimonials',
		esc_html__( 'Testimonial', 'inf' ),
		esc_html__( 'Testimonials', 'inf' ),
		array(
			'menu_icon'   => 'dashicons-format-quote',
			// The review body lives in the editor; the reviewer is an ACF group.
			'supports'    => array( 'title', 'editor', 'thumbnail' ),
			'has_archive' => true,
		)
	);
}
add_action( 'init', 'inf_register_testimonials_cpt' );
