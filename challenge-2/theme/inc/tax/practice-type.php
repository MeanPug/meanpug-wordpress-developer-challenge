<?php
/**
 * Taxonomy: Practice Type
 *
 * Slug: `practice-type` — hierarchical.
 *
 * Why?
 *   Provides the top-level grouping for practice areas. Enables navigation
 *   like "Personal Injury → Car Accidents → Rear-End Collisions". Hierarchical
 *   because legal practice has natural parent/child categories. Drives the
 *   primary site navigation and archive URL structure.
 *
 *   Registered on: `practice-area`
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Practice Type taxonomy.
 *
 * @return void
 */
function inf_register_tax_practice_type(): void {
    $labels = array(
        'name'              => _x( 'Practice Types', 'taxonomy general name', 'inf' ),
        'singular_name'     => _x( 'Practice Type', 'taxonomy singular name', 'inf' ),
        'search_items'      => __( 'Search Practice Types', 'inf' ),
        'all_items'         => __( 'All Practice Types', 'inf' ),
        'parent_item'       => __( 'Parent Practice Type', 'inf' ),
        'parent_item_colon' => __( 'Parent Practice Type:', 'inf' ),
        'edit_item'         => __( 'Edit Practice Type', 'inf' ),
        'update_item'       => __( 'Update Practice Type', 'inf' ),
        'add_new_item'      => __( 'Add New Practice Type', 'inf' ),
        'new_item_name'     => __( 'New Practice Type Name', 'inf' ),
        'menu_name'         => __( 'Practice Types', 'inf' ),
        'not_found'         => __( 'No practice types found.', 'inf' ),
        'items_list'        => __( 'Practice Types list', 'inf' ),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true, // Category-style: Personal Injury > Car Accidents.
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'practice-type', 'with_front' => false ),
    );

    register_taxonomy( 'practice-type', array( 'practice-area' ), $args );
}
add_action( 'init', 'inf_register_tax_practice_type' );
