<?php
/**
 * CPT: testimonial
 *
 * Client reviews. Shown on the home page, practice-area pages, and an
 * archive. Rating + author info drive the schema.org aggregate-rating
 * output used by SEO plugins.
 *
 * @package pnp
 */

add_action( 'init', function () {
	register_post_type( 'testimonial', array(
		'labels' => array(
			'name'               => __( 'Testimonials', 'pnp' ),
			'singular_name'      => __( 'Testimonial', 'pnp' ),
			'menu_name'          => __( 'Testimonials', 'pnp' ),
			'add_new_item'       => __( 'Add New Testimonial', 'pnp' ),
			'edit_item'          => __( 'Edit Testimonial', 'pnp' ),
			'new_item'           => __( 'New Testimonial', 'pnp' ),
			'view_item'          => __( 'View Testimonial', 'pnp' ),
			'search_items'       => __( 'Search Testimonials', 'pnp' ),
			'not_found'          => __( 'No testimonials found', 'pnp' ),
			'not_found_in_trash' => __( 'No testimonials in trash', 'pnp' ),
		),
		'public'        => true,
		'has_archive'   => 'testimonials',
		'menu_icon'     => 'dashicons-format-quote',
		'menu_position' => 23,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields' ),
		'taxonomies'    => array( 'practice-area-group', 'region' ),
		'rewrite'       => array( 'slug' => 'testimonials', 'with_front' => false ),
		'show_in_rest'  => true,
		'rest_base'     => 'testimonials',
	) );
} );
