<?php

/**
 * Register attorney custom post type.
 */
function inf_register_cpt_attorney() {
	$labels = array(
		'name'               => esc_html__( 'Attorneys', 'inf' ),
		'singular_name'      => esc_html__( 'Attorney', 'inf' ),
		'add_new'            => esc_html__( 'Add New', 'inf' ),
		'add_new_item'       => esc_html__( 'Add New Attorney', 'inf' ),
		'edit_item'          => esc_html__( 'Edit Attorney', 'inf' ),
		'new_item'           => esc_html__( 'New Attorney', 'inf' ),
		'view_item'          => esc_html__( 'View Attorney', 'inf' ),
		'search_items'       => esc_html__( 'Search Attorneys', 'inf' ),
		'not_found'          => esc_html__( 'No attorneys found', 'inf' ),
		'not_found_in_trash' => esc_html__( 'No attorneys found in Trash', 'inf' ),
		'all_items'          => esc_html__( 'All Attorneys', 'inf' ),
		'menu_name'          => esc_html__( 'Attorneys', 'inf' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'show_in_rest'       => true,
		'menu_icon'          => 'dashicons-businessperson',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
		'has_archive'        => true,
		'rewrite'            => array( 'slug' => 'attorneys' ),
	);

	register_post_type( 'attorney', $args );
}
add_action( 'init', 'inf_register_cpt_attorney' );
