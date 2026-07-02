<?php
/**
 * Taxonomy: Attorney Specialty
 *
 * Slug: `attorney-specialty` — flat (non-hierarchical).
 *
 * Why?
 *   Flat tags for specific legal specialties (e.g. "Mass Tort", "Class Action",
 *   "Medical Malpractice"). These are not parent/child — an attorney can hold
 *   any combination. This taxonomy powers "Find an attorney by specialty"
 *   filtering on the attorney archive and is distinct from Practice Type which
 *   governs practice area URL structure.
 *
 *   Registered on: `attorney`
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Attorney Specialty taxonomy.
 *
 * @return void
 */
function inf_register_tax_attorney_specialty(): void {
    $labels = array(
        'name'          => _x( 'Specialties', 'taxonomy general name', 'inf' ),
        'singular_name' => _x( 'Specialty', 'taxonomy singular name', 'inf' ),
        'search_items'  => __( 'Search Specialties', 'inf' ),
        'all_items'     => __( 'All Specialties', 'inf' ),
        'edit_item'     => __( 'Edit Specialty', 'inf' ),
        'update_item'   => __( 'Update Specialty', 'inf' ),
        'add_new_item'  => __( 'Add New Specialty', 'inf' ),
        'new_item_name' => __( 'New Specialty', 'inf' ),
        'menu_name'     => __( 'Specialties', 'inf' ),
        'not_found'     => __( 'No specialties found.', 'inf' ),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => false, // Tag-style: any combination allowed.
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'specialty', 'with_front' => false ),
    );

    register_taxonomy( 'attorney-specialty', array( 'attorney' ), $args );
}
add_action( 'init', 'inf_register_tax_attorney_specialty' );
