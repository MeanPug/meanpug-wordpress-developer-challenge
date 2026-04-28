<?php
/**
 * CPT: Result (Case Result)
 *
 * Verdicts and settlements ("$1.2M jury verdict, motorcycle accident").
 * Standard for trial-firm marketing sites.
 *
 * @package infra
 */

function inf_register_result_cpt() {
    $labels = array(
        'name'               => _x( 'Case Results', 'post type general name', 'inf' ),
        'singular_name'      => _x( 'Case Result', 'post type singular name', 'inf' ),
        'menu_name'          => _x( 'Case Results', 'admin menu', 'inf' ),
        'add_new'            => _x( 'Add New', 'case result', 'inf' ),
        'add_new_item'       => __( 'Add New Case Result', 'inf' ),
        'edit_item'          => __( 'Edit Case Result', 'inf' ),
        'new_item'           => __( 'New Case Result', 'inf' ),
        'view_item'          => __( 'View Case Result', 'inf' ),
        'search_items'       => __( 'Search Case Results', 'inf' ),
        'not_found'          => __( 'No case results found', 'inf' ),
        'not_found_in_trash' => __( 'No case results found in trash', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-awards',
        'menu_position'      => 25,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'case-results', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ),
    );

    register_post_type( 'result', $args );
}
add_action( 'init', 'inf_register_result_cpt' );
