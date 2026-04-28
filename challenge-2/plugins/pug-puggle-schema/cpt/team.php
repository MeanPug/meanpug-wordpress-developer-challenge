<?php
/**
 * CPT: Team (Attorneys)
 *
 * Slug "team" is kept for code consistency — the canonical map in
 * inf_canonical_post_type_name() already returns "Attorney" as the
 * display label, and the existing widget queries `is_singular('team')`.
 *
 * @package infra
 */

function inf_register_team_cpt() {
    $labels = array(
        'name'               => _x( 'Attorneys', 'post type general name', 'inf' ),
        'singular_name'      => _x( 'Attorney', 'post type singular name', 'inf' ),
        'menu_name'          => _x( 'Attorneys', 'admin menu', 'inf' ),
        'add_new'            => _x( 'Add New', 'attorney', 'inf' ),
        'add_new_item'       => __( 'Add New Attorney', 'inf' ),
        'edit_item'          => __( 'Edit Attorney', 'inf' ),
        'new_item'           => __( 'New Attorney', 'inf' ),
        'view_item'          => __( 'View Attorney', 'inf' ),
        'search_items'       => __( 'Search Attorneys', 'inf' ),
        'not_found'          => __( 'No attorneys found', 'inf' ),
        'not_found_in_trash' => __( 'No attorneys found in trash', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-businessperson',
        'menu_position'      => 21,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'attorneys', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => 'attorneys',
        'hierarchical'       => false,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
    );

    register_post_type( 'team', $args );
}
add_action( 'init', 'inf_register_team_cpt' );
