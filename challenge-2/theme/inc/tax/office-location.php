<?php
/**
 * Taxonomy: Office Location
 *
 * Slug: `office-location` — hierarchical.
 *
 * Why?
 *   Multi-state firms need a State → City location hierarchy that can drive
 *   "Attorneys in California" and "Attorneys in Los Angeles" archive pages.
 *   Hierarchical because State > City is a natural tree. Registered on both
 *   `attorney` and `career` so "Jobs in New York" is queryable without
 *   duplicating location data. The `office` CPT has its own address fields
 *   for map/schema purposes; this taxonomy serves filtering and navigation.
 *
 *   Registered on: `attorney`, `career`, `office`
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Office Location taxonomy.
 *
 * @return void
 */
function inf_register_tax_office_location(): void {
    $labels = array(
        'name'              => _x( 'Office Locations', 'taxonomy general name', 'inf' ),
        'singular_name'     => _x( 'Office Location', 'taxonomy singular name', 'inf' ),
        'search_items'      => __( 'Search Office Locations', 'inf' ),
        'all_items'         => __( 'All Locations', 'inf' ),
        'parent_item'       => __( 'Parent Location', 'inf' ),
        'parent_item_colon' => __( 'Parent Location:', 'inf' ),
        'edit_item'         => __( 'Edit Location', 'inf' ),
        'update_item'       => __( 'Update Location', 'inf' ),
        'add_new_item'      => __( 'Add New Location', 'inf' ),
        'new_item_name'     => __( 'New Location', 'inf' ),
        'menu_name'         => __( 'Locations', 'inf' ),
        'not_found'         => __( 'No locations found.', 'inf' ),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true, // Category-style: California > Los Angeles.
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'location', 'with_front' => false ),
    );

    register_taxonomy( 'office-location', array( 'attorney', 'career', 'office' ), $args );
}
add_action( 'init', 'inf_register_tax_office_location' );
