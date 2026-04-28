<?php
/**
 * CPT: Office
 *
 * Physical firm locations. Distinct from `local` (Area Served pages).
 * Drives LocalBusiness schema via mp_generate_office_schema().
 *
 * @package infra
 */

function inf_register_office_cpt() {
    $labels = array(
        'name'               => _x( 'Offices', 'post type general name', 'inf' ),
        'singular_name'      => _x( 'Office', 'post type singular name', 'inf' ),
        'menu_name'          => _x( 'Offices', 'admin menu', 'inf' ),
        'add_new'            => _x( 'Add New', 'office', 'inf' ),
        'add_new_item'       => __( 'Add New Office', 'inf' ),
        'edit_item'          => __( 'Edit Office', 'inf' ),
        'new_item'           => __( 'New Office', 'inf' ),
        'view_item'          => __( 'View Office', 'inf' ),
        'search_items'       => __( 'Search Offices', 'inf' ),
        'not_found'          => __( 'No offices found', 'inf' ),
        'not_found_in_trash' => __( 'No offices found in trash', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-location',
        'menu_position'      => 23,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'offices', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'revisions' ),
    );

    register_post_type( 'office', $args );
}
add_action( 'init', 'inf_register_office_cpt' );
