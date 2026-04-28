<?php
/**
 * CPT: Practice Area
 *
 * Hierarchical so a parent area (e.g. "Personal Injury") can contain
 * child areas (e.g. "Car Accidents"). The Related Practice Areas widget
 * already pages through children via post_parent.
 *
 * @package infra
 */

function inf_register_practice_area_cpt() {
    $labels = array(
        'name'               => _x( 'Practice Areas', 'post type general name', 'inf' ),
        'singular_name'      => _x( 'Practice Area', 'post type singular name', 'inf' ),
        'menu_name'          => _x( 'Practice Areas', 'admin menu', 'inf' ),
        'add_new'            => _x( 'Add New', 'practice area', 'inf' ),
        'add_new_item'       => __( 'Add New Practice Area', 'inf' ),
        'edit_item'          => __( 'Edit Practice Area', 'inf' ),
        'new_item'           => __( 'New Practice Area', 'inf' ),
        'view_item'          => __( 'View Practice Area', 'inf' ),
        'search_items'       => __( 'Search Practice Areas', 'inf' ),
        'not_found'          => __( 'No practice areas found', 'inf' ),
        'not_found_in_trash' => __( 'No practice areas found in trash', 'inf' ),
        'parent_item_colon'  => __( 'Parent Practice Area:', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-portfolio',
        'menu_position'      => 20,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'practice-areas', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'revisions' ),
        'taxonomies'         => array( 'category' ),
    );

    register_post_type( 'practice-area', $args );
}
add_action( 'init', 'inf_register_practice_area_cpt' );
