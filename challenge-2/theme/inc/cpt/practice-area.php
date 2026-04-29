<?php

/**
 * Register practice area custom post type.
 */
function inf_register_cpt_practice_area() {
	$labels = array(
		'name'               => esc_html__( 'Practice Areas', 'inf' ),
		'singular_name'      => esc_html__( 'Practice Area', 'inf' ),
		'add_new'            => esc_html__( 'Add New', 'inf' ),
		'add_new_item'       => esc_html__( 'Add New Practice Area', 'inf' ),
		'edit_item'          => esc_html__( 'Edit Practice Area', 'inf' ),
		'new_item'           => esc_html__( 'New Practice Area', 'inf' ),
		'view_item'          => esc_html__( 'View Practice Area', 'inf' ),
		'search_items'       => esc_html__( 'Search Practice Areas', 'inf' ),
		'not_found'          => esc_html__( 'No practice areas found', 'inf' ),
		'not_found_in_trash' => esc_html__( 'No practice areas found in Trash', 'inf' ),
		'all_items'          => esc_html__( 'All Practice Areas', 'inf' ),
		'menu_name'          => esc_html__( 'Practice Areas', 'inf' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'show_in_rest'       => true,
		'menu_icon'          => 'dashicons-portfolio',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
		'has_archive'        => true,
		'rewrite'            => array( 'slug' => 'practice-areas' ),
	);

	register_post_type( 'practice_area', $args );
}
add_action( 'init', 'inf_register_cpt_practice_area' );
