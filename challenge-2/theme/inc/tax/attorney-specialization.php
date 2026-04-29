<?php

/**
 * Register attorney specialization taxonomy.
 */
function inf_register_tax_attorney_specialization() {
	$labels = array(
		'name'          => esc_html__( 'Attorney Specializations', 'inf' ),
		'singular_name' => esc_html__( 'Attorney Specialization', 'inf' ),
		'search_items'  => esc_html__( 'Search Specializations', 'inf' ),
		'all_items'     => esc_html__( 'All Specializations', 'inf' ),
		'edit_item'     => esc_html__( 'Edit Specialization', 'inf' ),
		'update_item'   => esc_html__( 'Update Specialization', 'inf' ),
		'add_new_item'  => esc_html__( 'Add New Specialization', 'inf' ),
		'new_item_name' => esc_html__( 'New Specialization Name', 'inf' ),
		'menu_name'     => esc_html__( 'Specializations', 'inf' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_rest'      => true,
		'hierarchical'      => true,
		'show_admin_column' => true,
		'rewrite'           => array( 'slug' => 'attorney-specialization' ),
	);

	register_taxonomy( 'attorney_specialization', array( 'attorney' ), $args );
}
add_action( 'init', 'inf_register_tax_attorney_specialization' );
