<?php
/**
 * Custom Post Type: Attorney
 *
 * Registers the `attorney` CPT.
 *
 * Why a CPT and not a page?
 *   - Attorneys are structured data, not free-form pages. They need queryable
 *     meta (bar admissions, offices, specialties) and appear in filtered lists
 *     (e.g. "All Spanish-speaking attorneys in California"). A CPT gives us
 *     archive URLs, query-ability, and a clean separation from marketing pages.
 *
 * Slug: `attorney` — intentionally singular, follows WP convention.
 * Archive URL: /attorneys/
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Attorney CPT.
 *
 * @return void
 */
function inf_register_cpt_attorney(): void {
    $labels = array(
        'name'                  => _x( 'Attorneys', 'post type general name', 'inf' ),
        'singular_name'         => _x( 'Attorney', 'post type singular name', 'inf' ),
        'menu_name'             => _x( 'Attorneys', 'admin menu', 'inf' ),
        'name_admin_bar'        => _x( 'Attorney', 'add new on admin bar', 'inf' ),
        'add_new'               => _x( 'Add New', 'attorney', 'inf' ),
        'add_new_item'          => __( 'Add New Attorney', 'inf' ),
        'new_item'              => __( 'New Attorney', 'inf' ),
        'edit_item'             => __( 'Edit Attorney', 'inf' ),
        'view_item'             => __( 'View Attorney', 'inf' ),
        'all_items'             => __( 'All Attorneys', 'inf' ),
        'search_items'          => __( 'Search Attorneys', 'inf' ),
        'parent_item_colon'     => __( 'Parent Attorneys:', 'inf' ),
        'not_found'             => __( 'No attorneys found.', 'inf' ),
        'not_found_in_trash'    => __( 'No attorneys found in Trash.', 'inf' ),
        'featured_image'        => __( 'Attorney Headshot', 'inf' ),
        'set_featured_image'    => __( 'Set headshot', 'inf' ),
        'remove_featured_image' => __( 'Remove headshot', 'inf' ),
        'use_featured_image'    => __( 'Use as headshot', 'inf' ),
        'archives'              => __( 'Attorney Archives', 'inf' ),
        'insert_into_item'      => __( 'Insert into attorney bio', 'inf' ),
        'uploaded_to_this_item' => __( 'Uploaded to this attorney', 'inf' ),
        'items_list'            => __( 'Attorneys list', 'inf' ),
        'items_list_navigation' => __( 'Attorneys list navigation', 'inf' ),
        'filter_items_list'     => __( 'Filter attorneys list', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Individual attorney profiles including bio, specialties, bar admissions, and office locations.', 'inf' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array(
            'slug'       => 'attorneys',
            'with_front' => false,
        ),
        'capability_type'    => 'post',
        'has_archive'        => 'attorneys',
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-businessman',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        'show_in_rest'       => true, // Enables Gutenberg + REST API access.
        'taxonomies'         => array( 'attorney-specialty', 'jurisdiction', 'language', 'office-location' ),
    );

    register_post_type( 'attorney', $args );
}
add_action( 'init', 'inf_register_cpt_attorney' );
