<?php
/**
 * Custom Post Type: Practice Area
 *
 * Registers the `practice-area` CPT.
 *
 * Why a CPT?
 *   - Practice areas are the primary SEO landing pages for a law firm.
 *     Each area (e.g. "Car Accidents", "Medical Malpractice") needs its own
 *     URL, hero, body content, FAQs, related attorneys, case results, and
 *     testimonials — none of which fit the native post or page model cleanly.
 *   - Already referenced in `inc/hooks.php` and `inc/utils/seo/schema.php`.
 *     The slug `practice-area` must remain stable.
 *
 * Archive URL: /practice-areas/
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Practice Area CPT.
 *
 * @return void
 */
function inf_register_cpt_practice_area(): void {
    $labels = array(
        'name'                  => _x( 'Practice Areas', 'post type general name', 'inf' ),
        'singular_name'         => _x( 'Practice Area', 'post type singular name', 'inf' ),
        'menu_name'             => _x( 'Practice Areas', 'admin menu', 'inf' ),
        'name_admin_bar'        => _x( 'Practice Area', 'add new on admin bar', 'inf' ),
        'add_new'               => _x( 'Add New', 'practice area', 'inf' ),
        'add_new_item'          => __( 'Add New Practice Area', 'inf' ),
        'new_item'              => __( 'New Practice Area', 'inf' ),
        'edit_item'             => __( 'Edit Practice Area', 'inf' ),
        'view_item'             => __( 'View Practice Area', 'inf' ),
        'all_items'             => __( 'All Practice Areas', 'inf' ),
        'search_items'          => __( 'Search Practice Areas', 'inf' ),
        'parent_item_colon'     => __( 'Parent Practice Area:', 'inf' ),
        'not_found'             => __( 'No practice areas found.', 'inf' ),
        'not_found_in_trash'    => __( 'No practice areas found in Trash.', 'inf' ),
        'archives'              => __( 'Practice Area Archives', 'inf' ),
        'items_list'            => __( 'Practice Areas list', 'inf' ),
        'items_list_navigation' => __( 'Practice Areas list navigation', 'inf' ),
        'filter_items_list'     => __( 'Filter practice areas list', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Legal practice areas and specialties. Primary SEO landing pages for the firm.', 'inf' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array(
            'slug'       => 'practice-areas',
            'with_front' => false,
        ),
        'capability_type'    => 'post',
        'has_archive'        => 'practice-areas',
        'hierarchical'       => true, // Allows parent/child: Personal Injury > Car Accidents.
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-hammer',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'revisions' ),
        'show_in_rest'       => true,
        'taxonomies'         => array( 'practice-type' ),
    );

    register_post_type( 'practice-area', $args );
}
add_action( 'init', 'inf_register_cpt_practice_area' );
