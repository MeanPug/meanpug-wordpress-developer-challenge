<?php
/**
 * Custom Post Type: Case Result
 *
 * Registers the `case-result` CPT.
 *
 * Why a CPT?
 *   - Case results ("$4.5 Million Verdict — Medical Malpractice") are the
 *     strongest conversion driver on law firm websites. They need structured
 *     fields: dollar amount, case type, linked practice area, and linked
 *     attorney(s). They appear in filtered lists on practice area pages and
 *     attorney bio pages. A CPT lets us query them precisely without shortcodes
 *     or manual page management.
 *
 * Archive URL: /case-results/
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Case Result CPT.
 *
 * @return void
 */
function inf_register_cpt_case_result(): void {
    $labels = array(
        'name'                  => _x( 'Case Results', 'post type general name', 'inf' ),
        'singular_name'         => _x( 'Case Result', 'post type singular name', 'inf' ),
        'menu_name'             => _x( 'Case Results', 'admin menu', 'inf' ),
        'name_admin_bar'        => _x( 'Case Result', 'add new on admin bar', 'inf' ),
        'add_new'               => _x( 'Add New', 'case result', 'inf' ),
        'add_new_item'          => __( 'Add New Case Result', 'inf' ),
        'new_item'              => __( 'New Case Result', 'inf' ),
        'edit_item'             => __( 'Edit Case Result', 'inf' ),
        'view_item'             => __( 'View Case Result', 'inf' ),
        'all_items'             => __( 'All Case Results', 'inf' ),
        'search_items'          => __( 'Search Case Results', 'inf' ),
        'not_found'             => __( 'No case results found.', 'inf' ),
        'not_found_in_trash'    => __( 'No case results found in Trash.', 'inf' ),
        'archives'              => __( 'Case Results Archives', 'inf' ),
        'items_list'            => __( 'Case Results list', 'inf' ),
        'items_list_navigation' => __( 'Case Results list navigation', 'inf' ),
        'filter_items_list'     => __( 'Filter case results list', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Settlement and verdict results. Each result links to a practice area and optionally to attorney(s).', 'inf' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array(
            'slug'       => 'case-results',
            'with_front' => false,
        ),
        'capability_type'    => 'post',
        'has_archive'        => 'case-results',
        'hierarchical'       => false,
        'menu_position'      => 8,
        'menu_icon'          => 'dashicons-awards',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'show_in_rest'       => true,
        'taxonomies'         => array( 'case-type' ),
    );

    register_post_type( 'case-result', $args );
}
add_action( 'init', 'inf_register_cpt_case_result' );
