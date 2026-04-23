<?php
/**
 * CPT: office
 *
 * Physical office locations. Each has an address, hours, phone, map
 * coordinates (used by LocalBusiness schema and store-locator UI).
 *
 * @package pnp
 */

add_action( 'init', function () {
	register_post_type( 'office', array(
		'labels' => array(
			'name'               => __( 'Offices', 'pnp' ),
			'singular_name'      => __( 'Office', 'pnp' ),
			'menu_name'          => __( 'Offices', 'pnp' ),
			'add_new_item'       => __( 'Add New Office', 'pnp' ),
			'edit_item'          => __( 'Edit Office', 'pnp' ),
			'new_item'           => __( 'New Office', 'pnp' ),
			'view_item'          => __( 'View Office', 'pnp' ),
			'search_items'       => __( 'Search Offices', 'pnp' ),
			'not_found'          => __( 'No offices found', 'pnp' ),
			'not_found_in_trash' => __( 'No offices in trash', 'pnp' ),
		),
		'public'        => true,
		'has_archive'   => 'offices',
		'menu_icon'     => 'dashicons-location-alt',
		'menu_position' => 24,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields' ),
		'taxonomies'    => array( 'region' ),
		'rewrite'       => array( 'slug' => 'offices', 'with_front' => false ),
		'show_in_rest'  => true,
		'rest_base'     => 'offices',
	) );
} );
