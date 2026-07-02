<?php
/**
 * Custom Post Type: FAQ
 *
 * Registers the `faq` CPT.
 *
 * Why a CPT and not a repeater field on practice areas?
 *   - FAQs stored only as ACF repeater fields on practice areas create
 *     content duplication when the same question applies to multiple areas.
 *     As a CPT, one FAQ can relate to many practice areas via a Relationship
 *     field. Edit once, appears everywhere.
 *   - Enables FAQPage schema generation per practice area dynamically.
 *
 * Archive URL: /faqs/
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the FAQ CPT.
 *
 * @return void
 */
function inf_register_cpt_faq(): void {
    $labels = array(
        'name'                  => _x( 'FAQs', 'post type general name', 'inf' ),
        'singular_name'         => _x( 'FAQ', 'post type singular name', 'inf' ),
        'menu_name'             => _x( 'FAQs', 'admin menu', 'inf' ),
        'name_admin_bar'        => _x( 'FAQ', 'add new on admin bar', 'inf' ),
        'add_new'               => _x( 'Add New', 'faq', 'inf' ),
        'add_new_item'          => __( 'Add New FAQ', 'inf' ),
        'new_item'              => __( 'New FAQ', 'inf' ),
        'edit_item'             => __( 'Edit FAQ', 'inf' ),
        'view_item'             => __( 'View FAQ', 'inf' ),
        'all_items'             => __( 'All FAQs', 'inf' ),
        'search_items'          => __( 'Search FAQs', 'inf' ),
        'not_found'             => __( 'No FAQs found.', 'inf' ),
        'not_found_in_trash'    => __( 'No FAQs found in Trash.', 'inf' ),
        'archives'              => __( 'FAQ Archives', 'inf' ),
        'items_list'            => __( 'FAQs list', 'inf' ),
        'items_list_navigation' => __( 'FAQs list navigation', 'inf' ),
        'filter_items_list'     => __( 'Filter FAQs list', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Frequently asked questions. Each FAQ can relate to multiple practice areas — managed as a firm-wide library.', 'inf' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'faqs', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => 'faqs',
        'hierarchical'       => false,
        'menu_position'      => 10,
        'menu_icon'          => 'dashicons-editor-help',
        'supports'           => array( 'title', 'editor', 'revisions' ),
        'show_in_rest'       => true,
        'taxonomies'         => array( 'faq-category' ),
    );

    register_post_type( 'faq', $args );
}
add_action( 'init', 'inf_register_cpt_faq' );
