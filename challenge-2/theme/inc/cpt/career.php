<?php
/**
 * Custom Post Type: Career
 *
 * Registers the `career` CPT.
 *
 * Why a CPT?
 *   - Job listings have a distinct lifecycle (open → filled → expired) and
 *     structured fields (employment type, salary range, closing date, remote
 *     option) that differ completely from marketing content. Isolating careers
 *     prevents editorial confusion and allows JobPosting schema output.
 *   - A `closing_date` field allows programmatic expiration queries.
 *   - Links to an Office post for location — zero address duplication.
 *
 * Archive URL: /careers/
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Career CPT.
 *
 * @return void
 */
function inf_register_cpt_career(): void {
    $labels = array(
        'name'                  => _x( 'Careers', 'post type general name', 'inf' ),
        'singular_name'         => _x( 'Career', 'post type singular name', 'inf' ),
        'menu_name'             => _x( 'Careers', 'admin menu', 'inf' ),
        'name_admin_bar'        => _x( 'Career', 'add new on admin bar', 'inf' ),
        'add_new'               => _x( 'Add New', 'career', 'inf' ),
        'add_new_item'          => __( 'Add New Job Listing', 'inf' ),
        'new_item'              => __( 'New Job Listing', 'inf' ),
        'edit_item'             => __( 'Edit Job Listing', 'inf' ),
        'view_item'             => __( 'View Job Listing', 'inf' ),
        'all_items'             => __( 'All Job Listings', 'inf' ),
        'search_items'          => __( 'Search Job Listings', 'inf' ),
        'not_found'             => __( 'No job listings found.', 'inf' ),
        'not_found_in_trash'    => __( 'No job listings found in Trash.', 'inf' ),
        'archives'              => __( 'Careers', 'inf' ),
        'items_list'            => __( 'Job Listings list', 'inf' ),
        'items_list_navigation' => __( 'Job Listings list navigation', 'inf' ),
        'filter_items_list'     => __( 'Filter job listings', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Job listings for the firm. Each listing links to an office for location and supports JobPosting schema.', 'inf' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'careers', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => 'careers',
        'hierarchical'       => false,
        'menu_position'      => 11,
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'excerpt', 'revisions' ),
        'show_in_rest'       => true,
        'taxonomies'         => array( 'office-location' ),
    );

    register_post_type( 'career', $args );
}
add_action( 'init', 'inf_register_cpt_career' );
