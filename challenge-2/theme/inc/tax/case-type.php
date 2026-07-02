<?php
/**
 * Taxonomy: Case Type
 *
 * Slug: `case-type` — flat (non-hierarchical).
 *
 * Why?
 *   Case types ("Class Action", "Mass Tort", "Personal Injury Verdict") tag
 *   both Case Results and Testimonials. This shared taxonomy lets the archive
 *   filter both content types simultaneously. For example, a "Mass Tort" page
 *   can display case results AND testimonials tagged with the same term.
 *   Stored as a taxonomy (not meta) so it appears in admin columns on both
 *   CPT list screens and is URL-queryable without a custom query.
 *
 *   Registered on: `case-result`, `testimonials`
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Case Type taxonomy.
 *
 * @return void
 */
function inf_register_tax_case_type(): void {
    $labels = array(
        'name'          => _x( 'Case Types', 'taxonomy general name', 'inf' ),
        'singular_name' => _x( 'Case Type', 'taxonomy singular name', 'inf' ),
        'search_items'  => __( 'Search Case Types', 'inf' ),
        'all_items'     => __( 'All Case Types', 'inf' ),
        'edit_item'     => __( 'Edit Case Type', 'inf' ),
        'update_item'   => __( 'Update Case Type', 'inf' ),
        'add_new_item'  => __( 'Add New Case Type', 'inf' ),
        'new_item_name' => __( 'New Case Type', 'inf' ),
        'menu_name'     => __( 'Case Types', 'inf' ),
        'not_found'     => __( 'No case types found.', 'inf' ),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => false,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'case-type', 'with_front' => false ),
    );

    register_taxonomy( 'case-type', array( 'case-result', 'testimonials' ), $args );
}
add_action( 'init', 'inf_register_tax_case_type' );
