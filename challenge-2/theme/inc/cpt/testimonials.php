<?php
/**
 * Custom Post Type: Testimonials
 *
 * Registers the `testimonials` CPT.
 *
 * Why a CPT?
 *   - Client testimonials need structured fields: reviewer name, rating, linked
 *     practice area, and case type. They power Review schema on practice area
 *     pages and the testimonials archive. Managing them as a CPT allows editors
 *     to add/edit/delete without touching page content.
 *   - Already referenced in `inc/hooks.php`, `inc/utils/schema.php`, and
 *     `inc/utils/seo/schema.php`. The slug `testimonials` must remain stable.
 *
 * IMPORTANT: Slug is `testimonials` (plural) — intentional, matches skeleton.
 * Archive URL: /testimonials/
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Testimonials CPT.
 *
 * @return void
 */
function inf_register_cpt_testimonials(): void {
    $labels = array(
        'name'                  => _x( 'Testimonials', 'post type general name', 'inf' ),
        'singular_name'         => _x( 'Testimonial', 'post type singular name', 'inf' ),
        'menu_name'             => _x( 'Testimonials', 'admin menu', 'inf' ),
        'name_admin_bar'        => _x( 'Testimonial', 'add new on admin bar', 'inf' ),
        'add_new'               => _x( 'Add New', 'testimonial', 'inf' ),
        'add_new_item'          => __( 'Add New Testimonial', 'inf' ),
        'new_item'              => __( 'New Testimonial', 'inf' ),
        'edit_item'             => __( 'Edit Testimonial', 'inf' ),
        'view_item'             => __( 'View Testimonial', 'inf' ),
        'all_items'             => __( 'All Testimonials', 'inf' ),
        'search_items'          => __( 'Search Testimonials', 'inf' ),
        'not_found'             => __( 'No testimonials found.', 'inf' ),
        'not_found_in_trash'    => __( 'No testimonials found in Trash.', 'inf' ),
        'archives'              => __( 'Testimonials Archives', 'inf' ),
        'items_list'            => __( 'Testimonials list', 'inf' ),
        'items_list_navigation' => __( 'Testimonials list navigation', 'inf' ),
        'filter_items_list'     => __( 'Filter testimonials list', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Client testimonials and reviews. Powers Review schema on practice area pages.', 'inf' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array(
            'slug'       => 'testimonials',
            'with_front' => false,
        ),
        'capability_type'    => 'post',
        'has_archive'        => 'testimonials',
        'hierarchical'       => false,
        'menu_position'      => 9,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => array( 'title', 'editor', 'author' ),
        'show_in_rest'       => true,
        'taxonomies'         => array( 'case-type' ),
    );

    register_post_type( 'testimonials', $args );
}
add_action( 'init', 'inf_register_cpt_testimonials' );
