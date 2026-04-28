<?php
/**
 * Taxonomy: FAQ Category
 *
 * Groups FAQ posts by topic (e.g. "Billing", "Case Process", "Fees").
 * Hierarchical to allow nested topic structures.
 *
 * Drives the FAQPage schema generator's grouping in seo/schema.php
 * docblock note about "FAQ Category: FAQ".
 *
 * @package infra
 */

function inf_register_faq_category_taxonomy() {
    $labels = array(
        'name'              => _x( 'FAQ Categories', 'taxonomy general name', 'inf' ),
        'singular_name'     => _x( 'FAQ Category', 'taxonomy singular name', 'inf' ),
        'menu_name'         => __( 'FAQ Categories', 'inf' ),
        'all_items'         => __( 'All FAQ Categories', 'inf' ),
        'parent_item'       => __( 'Parent FAQ Category', 'inf' ),
        'parent_item_colon' => __( 'Parent FAQ Category:', 'inf' ),
        'edit_item'         => __( 'Edit FAQ Category', 'inf' ),
        'update_item'       => __( 'Update FAQ Category', 'inf' ),
        'add_new_item'      => __( 'Add New FAQ Category', 'inf' ),
        'new_item_name'     => __( 'New FAQ Category Name', 'inf' ),
        'search_items'      => __( 'Search FAQ Categories', 'inf' ),
        'not_found'         => __( 'No FAQ categories found', 'inf' ),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'faq-category', 'with_front' => false ),
    );

    register_taxonomy( 'faq-category', array( 'faq' ), $args );
}
add_action( 'init', 'inf_register_faq_category_taxonomy' );
