<?php
/**
 * CPT: Testimonial
 *
 * Drives Schema.org Review markup via mp_generate_testimonial_schema().
 * Linked to practice areas via an ACF relationship field.
 *
 * @package infra
 */

function inf_register_testimonial_cpt() {
    $labels = array(
        'name'               => _x( 'Testimonials', 'post type general name', 'inf' ),
        'singular_name'      => _x( 'Testimonial', 'post type singular name', 'inf' ),
        'menu_name'          => _x( 'Testimonials', 'admin menu', 'inf' ),
        'add_new'            => _x( 'Add New', 'testimonial', 'inf' ),
        'add_new_item'       => __( 'Add New Testimonial', 'inf' ),
        'edit_item'          => __( 'Edit Testimonial', 'inf' ),
        'new_item'           => __( 'New Testimonial', 'inf' ),
        'view_item'          => __( 'View Testimonial', 'inf' ),
        'search_items'       => __( 'Search Testimonials', 'inf' ),
        'not_found'          => __( 'No testimonials found', 'inf' ),
        'not_found_in_trash' => __( 'No testimonials found in trash', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-format-quote',
        'menu_position'      => 22,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonials', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'supports'           => array( 'title', 'editor', 'revisions' ),
    );

    register_post_type( 'testimonial', $args );
}
add_action( 'init', 'inf_register_testimonial_cpt' );
