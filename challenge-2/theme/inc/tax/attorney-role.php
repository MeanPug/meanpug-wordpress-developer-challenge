<?php
/**
 * Taxonomy: Attorney Role
 *
 * Tags attorneys with their position at the firm: Partner, Associate,
 * Of Counsel, Paralegal, etc. Non-hierarchical because the role list
 * is flat — no parent/child relationships needed.
 *
 * Used to filter and order the Attorneys archive (e.g. show all
 * Partners first) and to provide editorial grouping.
 *
 * @package infra
 */

function inf_register_attorney_role_taxonomy() {
    $labels = array(
        'name'                       => _x( 'Attorney Roles', 'taxonomy general name', 'inf' ),
        'singular_name'              => _x( 'Attorney Role', 'taxonomy singular name', 'inf' ),
        'menu_name'                  => __( 'Roles', 'inf' ),
        'all_items'                  => __( 'All Roles', 'inf' ),
        'edit_item'                  => __( 'Edit Role', 'inf' ),
        'update_item'                => __( 'Update Role', 'inf' ),
        'add_new_item'               => __( 'Add New Role', 'inf' ),
        'new_item_name'              => __( 'New Role Name', 'inf' ),
        'search_items'               => __( 'Search Roles', 'inf' ),
        'popular_items'              => __( 'Popular Roles', 'inf' ),
        'separate_items_with_commas' => __( 'Separate roles with commas', 'inf' ),
        'add_or_remove_items'        => __( 'Add or remove roles', 'inf' ),
        'choose_from_most_used'      => __( 'Choose from the most used roles', 'inf' ),
        'not_found'                  => __( 'No roles found', 'inf' ),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'hierarchical'      => false,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'attorney-role', 'with_front' => false ),
    );

    register_taxonomy( 'attorney-role', array( 'team' ), $args );
}
add_action( 'init', 'inf_register_attorney_role_taxonomy' );
