<?php
/**
 * Area Served taxonomy.
 *
 * Geographic taxonomy referenced by `inc/services/locations.php` (the
 * commented-out PA<->location tie-in queries `taxonomy => 'area-served'`) and
 * intended to group content by the geography it serves. Hierarchical so regions
 * can nest (State > County > City). Attached to the geo-aware content types.
 *
 * Slug MUST remain `area-served` to match the theme's existing tax_query usage.
 *
 * @package infra
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the `area-served` taxonomy.
 *
 * @return void
 */
function inf_register_area_served_taxonomy() {
	$labels = array(
		'name'              => esc_html__( 'Areas Served', 'inf' ),
		'singular_name'     => esc_html__( 'Area Served', 'inf' ),
		'menu_name'         => esc_html__( 'Areas Served', 'inf' ),
		'all_items'         => esc_html__( 'All Areas Served', 'inf' ),
		'edit_item'         => esc_html__( 'Edit Area Served', 'inf' ),
		'view_item'         => esc_html__( 'View Area Served', 'inf' ),
		'update_item'       => esc_html__( 'Update Area Served', 'inf' ),
		'add_new_item'      => esc_html__( 'Add New Area Served', 'inf' ),
		'new_item_name'     => esc_html__( 'New Area Served Name', 'inf' ),
		'parent_item'       => esc_html__( 'Parent Area Served', 'inf' ),
		'parent_item_colon' => esc_html__( 'Parent Area Served:', 'inf' ),
		'search_items'      => esc_html__( 'Search Areas Served', 'inf' ),
		'not_found'         => esc_html__( 'No areas served found.', 'inf' ),
	);

	register_taxonomy(
		'area-served',
		array( 'local', 'office', 'practice-area' ),
		array(
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true, // Gutenberg + REST.
			'rewrite'           => array( 'slug' => 'area-served' ),
		)
	);
}
add_action( 'init', 'inf_register_area_served_taxonomy' );
