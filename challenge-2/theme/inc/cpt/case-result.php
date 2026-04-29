<?php

/**
 * Register case result custom post type.
 */
function inf_register_cpt_case_result() {
	$labels = array(
		'name'               => esc_html__( 'Case Results', 'inf' ),
		'singular_name'      => esc_html__( 'Case Result', 'inf' ),
		'add_new'            => esc_html__( 'Add New', 'inf' ),
		'add_new_item'       => esc_html__( 'Add New Case Result', 'inf' ),
		'edit_item'          => esc_html__( 'Edit Case Result', 'inf' ),
		'new_item'           => esc_html__( 'New Case Result', 'inf' ),
		'view_item'          => esc_html__( 'View Case Result', 'inf' ),
		'search_items'       => esc_html__( 'Search Case Results', 'inf' ),
		'not_found'          => esc_html__( 'No case results found', 'inf' ),
		'not_found_in_trash' => esc_html__( 'No case results found in Trash', 'inf' ),
		'all_items'          => esc_html__( 'All Case Results', 'inf' ),
		'menu_name'          => esc_html__( 'Case Results', 'inf' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'show_in_rest'       => true,
		'menu_icon'          => 'dashicons-awards',
		'supports'           => array( 'title', 'editor', 'excerpt', 'revisions' ),
		'has_archive'        => true,
		'rewrite'            => array( 'slug' => 'case-results' ),
	);

	register_post_type( 'case_result', $args );
}
add_action( 'init', 'inf_register_cpt_case_result' );
