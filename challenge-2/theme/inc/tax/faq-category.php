<?php
/**
 * Taxonomy: FAQ Category
 *
 * Slug: `faq-category` — hierarchical.
 *
 * Why?
 *   Groups FAQs into browsable categories (e.g. "Filing Deadlines",
 *   "Compensation", "The Legal Process") that can each generate their own
 *   FAQPage schema block. Hierarchical because categories may have
 *   sub-groupings. Enables a dedicated FAQ archive that is browsable by
 *   topic — superior UX and SEO to a single wall of questions.
 *
 *   Registered on: `faq`
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the FAQ Category taxonomy.
 *
 * @return void
 */
function inf_register_tax_faq_category(): void {
    $labels = array(
        'name'              => _x( 'FAQ Categories', 'taxonomy general name', 'inf' ),
        'singular_name'     => _x( 'FAQ Category', 'taxonomy singular name', 'inf' ),
        'search_items'      => __( 'Search FAQ Categories', 'inf' ),
        'all_items'         => __( 'All FAQ Categories', 'inf' ),
        'parent_item'       => __( 'Parent FAQ Category', 'inf' ),
        'parent_item_colon' => __( 'Parent FAQ Category:', 'inf' ),
        'edit_item'         => __( 'Edit FAQ Category', 'inf' ),
        'update_item'       => __( 'Update FAQ Category', 'inf' ),
        'add_new_item'      => __( 'Add New FAQ Category', 'inf' ),
        'new_item_name'     => __( 'New FAQ Category', 'inf' ),
        'menu_name'         => __( 'FAQ Categories', 'inf' ),
        'not_found'         => __( 'No FAQ categories found.', 'inf' ),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true, // Category-style: allows topic grouping.
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'faq-category', 'with_front' => false ),
    );

    register_taxonomy( 'faq-category', array( 'faq' ), $args );
}
add_action( 'init', 'inf_register_tax_faq_category' );
