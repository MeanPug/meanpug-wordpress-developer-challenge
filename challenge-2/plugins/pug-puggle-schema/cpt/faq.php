<?php
/**
 * CPT: FAQ
 *
 * Editor-managed Q&A items grouped by faq-category taxonomy.
 * Drives FAQPage schema via mp_generate_faq_page_schema().
 *
 * Title is the question; the answer is an ACF wysiwyg field
 * (kept in ACF rather than the_content so it serializes cleanly
 * into JSON-LD without block-editor markup).
 *
 * @package infra
 */

function inf_register_faq_cpt() {
    $labels = array(
        'name'               => _x( 'FAQs', 'post type general name', 'inf' ),
        'singular_name'      => _x( 'FAQ', 'post type singular name', 'inf' ),
        'menu_name'          => _x( 'FAQs', 'admin menu', 'inf' ),
        'add_new'            => _x( 'Add New', 'faq', 'inf' ),
        'add_new_item'       => __( 'Add New FAQ', 'inf' ),
        'edit_item'          => __( 'Edit FAQ', 'inf' ),
        'new_item'           => __( 'New FAQ', 'inf' ),
        'view_item'          => __( 'View FAQ', 'inf' ),
        'search_items'       => __( 'Search FAQs', 'inf' ),
        'not_found'          => __( 'No FAQs found', 'inf' ),
        'not_found_in_trash' => __( 'No FAQs found in trash', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-editor-help',
        'menu_position'      => 26,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'faqs', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'supports'           => array( 'title', 'revisions' ),
    );

    register_post_type( 'faq', $args );
}
add_action( 'init', 'inf_register_faq_cpt' );
