<?php

/**
 * Register attorney location taxonomy.
 */
function inf_register_tax_attorney_location() {
	$labels = array(
		'name'          => esc_html__( 'Attorney Locations', 'inf' ),
		'singular_name' => esc_html__( 'Attorney Location', 'inf' ),
		'search_items'  => esc_html__( 'Search Locations', 'inf' ),
		'all_items'     => esc_html__( 'All Locations', 'inf' ),
		'edit_item'     => esc_html__( 'Edit Location', 'inf' ),
		'update_item'   => esc_html__( 'Update Location', 'inf' ),
		'add_new_item'  => esc_html__( 'Add New Location', 'inf' ),
		'new_item_name' => esc_html__( 'New Location Name', 'inf' ),
		'menu_name'     => esc_html__( 'Locations', 'inf' ),
	);

	$args = array(
		'labels'            => $labels,
		'public'            => true,
		'show_in_rest'      => true,
		'hierarchical'      => true,
		'show_admin_column' => true,
		'rewrite'           => array( 'slug' => 'attorney-location' ),
	);

	register_taxonomy( 'attorney_location', array( 'attorney' ), $args );
}
add_action( 'init', 'inf_register_tax_attorney_location' );
