<?php
/**
 * Taxonomy: Area Served
 *
 * Geographic tagging shared between Areas Served (local) and Practice
 * Areas. Hierarchical so editors can model "West Coast → California →
 * Los Angeles" — useful for grouping local pages on regional archives.
 *
 * Referenced by the commented cross-PA logic in services/locations.php
 * which expects `tax_query` against this taxonomy.
 *
 * @package infra
 */

function inf_register_area_served_taxonomy() {
    $labels = array(
        'name'              => _x( 'Areas Served', 'taxonomy general name', 'inf' ),
        'singular_name'     => _x( 'Area Served', 'taxonomy singular name', 'inf' ),
        'menu_name'         => __( 'Areas Served', 'inf' ),
        'all_items'         => __( 'All Areas Served', 'inf' ),
        'parent_item'       => __( 'Parent Area', 'inf' ),
        'parent_item_colon' => __( 'Parent Area:', 'inf' ),
        'edit_item'         => __( 'Edit Area Served', 'inf' ),
        'update_item'       => __( 'Update Area Served', 'inf' ),
        'add_new_item'      => __( 'Add New Area Served', 'inf' ),
        'new_item_name'     => __( 'New Area Served Name', 'inf' ),
        'search_items'      => __( 'Search Areas Served', 'inf' ),
        'not_found'         => __( 'No areas served found', 'inf' ),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'area-served', 'with_front' => false ),
    );

    register_taxonomy( 'area-served', array( 'local', 'practice-area' ), $args );
}
add_action( 'init', 'inf_register_area_served_taxonomy' );
