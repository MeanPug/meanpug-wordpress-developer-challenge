<?php

/**
 * Register case type taxonomy.
 */
function inf_register_tax_case_type() {
	$labels = array(
		'name'          => esc_html__( 'Case Types', 'inf' ),
		'singular_name' => esc_html__( 'Case Type', 'inf' ),
		'search_items'  => esc_html__( 'Search Case Types', 'inf' ),
		'all_items'     => esc_html__( 'All Case Types', 'inf' ),
		'edit_item'     => esc_html__( 'Edit Case Type', 'inf' ),
		'update_item'   => esc_html__( 'Update Case Type', 'inf' ),
		'add_new_item'  => esc_html__( 'Add New Case Type', 'inf' ),
		'new_item_name' => esc_html__( 'New Case Type Name', 'inf' ),
		'menu_name'     => esc_html__( 'Case Types', 'inf' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_rest'      => true,
		'hierarchical'      => true,
		'show_admin_column' => true,
		'rewrite'           => array( 'slug' => 'case-type' ),
	);

	register_taxonomy( 'case_type', array( 'case_result' ), $args );
}
add_action( 'init', 'inf_register_tax_case_type' );
