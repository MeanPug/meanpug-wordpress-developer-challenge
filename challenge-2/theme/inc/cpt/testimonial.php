<?php

/**
 * Register testimonial custom post type.
 */
function inf_register_cpt_testimonial() {
	$labels = array(
		'name'               => esc_html__( 'Testimonials', 'inf' ),
		'singular_name'      => esc_html__( 'Testimonial', 'inf' ),
		'add_new'            => esc_html__( 'Add New', 'inf' ),
		'add_new_item'       => esc_html__( 'Add New Testimonial', 'inf' ),
		'edit_item'          => esc_html__( 'Edit Testimonial', 'inf' ),
		'new_item'           => esc_html__( 'New Testimonial', 'inf' ),
		'view_item'          => esc_html__( 'View Testimonial', 'inf' ),
		'search_items'       => esc_html__( 'Search Testimonials', 'inf' ),
		'not_found'          => esc_html__( 'No testimonials found', 'inf' ),
		'not_found_in_trash' => esc_html__( 'No testimonials found in Trash', 'inf' ),
		'all_items'          => esc_html__( 'All Testimonials', 'inf' ),
		'menu_name'          => esc_html__( 'Testimonials', 'inf' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'show_in_rest'       => true,
		'menu_icon'          => 'dashicons-format-quote',
		'supports'           => array( 'title', 'editor', 'revisions' ),
		'has_archive'        => true,
		'rewrite'            => array( 'slug' => 'testimonials' ),
	);

	register_post_type( 'testimonial', $args );
}
add_action( 'init', 'inf_register_cpt_testimonial' );
