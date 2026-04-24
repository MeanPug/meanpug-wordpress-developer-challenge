<?php
/**
 * Custom Taxonomies for Law Firm Theme
 */

// Register Case Type Taxonomy
function register_case_type_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Case Types', 'taxonomy general name', 'inf' ),
        'singular_name'              => _x( 'Case Type', 'taxonomy singular name', 'inf' ),
        'search_items'               => __( 'Search Case Types', 'inf' ),
        'popular_items'              => __( 'Popular Case Types', 'inf' ),
        'all_items'                  => __( 'All Case Types', 'inf' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Case Type', 'inf' ),
        'update_item'                => __( 'Update Case Type', 'inf' ),
        'add_new_item'               => __( 'Add New Case Type', 'inf' ),
        'new_item_name'              => __( 'New Case Type Name', 'inf' ),
        'separate_items_with_commas' => __( 'Separate case types with commas', 'inf' ),
        'add_or_remove_items'        => __( 'Add or remove case types', 'inf' ),
        'choose_from_most_used'      => __( 'Choose from the most used case types', 'inf' ),
        'not_found'                  => __( 'No case types found.', 'inf' ),
        'menu_name'                  => __( 'Case Types', 'inf' ),
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'case-type' ),
        'show_in_rest'          => true,
    );

    register_taxonomy( 'case_type', 'case', $args );
}
add_action( 'init', 'register_case_type_taxonomy' );

// Register Location Taxonomy
function register_location_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Locations', 'taxonomy general name', 'inf' ),
        'singular_name'              => _x( 'Location', 'taxonomy singular name', 'inf' ),
        'search_items'               => __( 'Search Locations', 'inf' ),
        'popular_items'              => __( 'Popular Locations', 'inf' ),
        'all_items'                  => __( 'All Locations', 'inf' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Location', 'inf' ),
        'update_item'                => __( 'Update Location', 'inf' ),
        'add_new_item'               => __( 'Add New Location', 'inf' ),
        'new_item_name'              => __( 'New Location Name', 'inf' ),
        'separate_items_with_commas' => __( 'Separate locations with commas', 'inf' ),
        'add_or_remove_items'        => __( 'Add or remove locations', 'inf' ),
        'choose_from_most_used'      => __( 'Choose from the most used locations', 'inf' ),
        'not_found'                  => __( 'No locations found.', 'inf' ),
        'menu_name'                  => __( 'Locations', 'inf' ),
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'location' ),
        'show_in_rest'          => true,
    );

    register_taxonomy( 'location', array( 'attorney', 'office', 'case' ), $args );
}
add_action( 'init', 'register_location_taxonomy' );

// Register Practice Area Taxonomy (for cases)
function register_practice_area_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Practice Areas', 'taxonomy general name', 'inf' ),
        'singular_name'              => _x( 'Practice Area', 'taxonomy singular name', 'inf' ),
        'search_items'               => __( 'Search Practice Areas', 'inf' ),
        'popular_items'              => __( 'Popular Practice Areas', 'inf' ),
        'all_items'                  => __( 'All Practice Areas', 'inf' ),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __( 'Edit Practice Area', 'inf' ),
        'update_item'                => __( 'Update Practice Area', 'inf' ),
        'add_new_item'               => __( 'Add New Practice Area', 'inf' ),
        'new_item_name'              => __( 'New Practice Area Name', 'inf' ),
        'separate_items_with_commas' => __( 'Separate practice areas with commas', 'inf' ),
        'add_or_remove_items'        => __( 'Add or remove practice areas', 'inf' ),
        'choose_from_most_used'      => __( 'Choose from the most used practice areas', 'inf' ),
        'not_found'                  => __( 'No practice areas found.', 'inf' ),
        'menu_name'                  => __( 'Practice Areas', 'inf' ),
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'practice-area-tax' ),
        'show_in_rest'          => true,
    );

    register_taxonomy( 'practice_area_tax', 'case', $args );
}
add_action( 'init', 'register_practice_area_taxonomy' );


