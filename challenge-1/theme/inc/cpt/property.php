<?php
/**
 * Custom post type: `property` (a "stay").
 *
 * Backs the front-page listings grid. Registered on `init` with no external
 * dependencies (no ACF required), so the front page is reproducible from a clean
 * `docker compose up`. Listing details live in post meta (see
 * inc/data/seed-properties.php) and are read back in listing-grid.php.
 *
 * @package infra
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the `property` post type.
 *
 * @return void
 */
function inf_register_property_cpt() {
	$labels = array(
		'name'               => _x( 'Stays', 'post type general name', 'inf' ),
		'singular_name'      => _x( 'Stay', 'post type singular name', 'inf' ),
		'menu_name'          => _x( 'Stays', 'admin menu', 'inf' ),
		'name_admin_bar'     => _x( 'Stay', 'add new on admin bar', 'inf' ),
		'add_new'            => __( 'Add New', 'inf' ),
		'add_new_item'       => __( 'Add New Stay', 'inf' ),
		'new_item'           => __( 'New Stay', 'inf' ),
		'edit_item'          => __( 'Edit Stay', 'inf' ),
		'view_item'          => __( 'View Stay', 'inf' ),
		'all_items'          => __( 'All Stays', 'inf' ),
		'search_items'       => __( 'Search Stays', 'inf' ),
		'not_found'          => __( 'No stays found.', 'inf' ),
		'not_found_in_trash' => __( 'No stays found in Trash.', 'inf' ),
	);

	$args = array(
		'labels'       => $labels,
		'public'       => true,
		'show_in_rest' => true,
		'has_archive'  => false,
		'menu_icon'    => 'dashicons-admin-home',
		'supports'     => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
		'rewrite'      => array( 'slug' => 'stays' ),
	);

	register_post_type( 'property', $args );
}
add_action( 'init', 'inf_register_property_cpt' );
