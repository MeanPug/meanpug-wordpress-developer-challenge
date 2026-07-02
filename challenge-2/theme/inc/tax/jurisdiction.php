<?php
/**
 * Taxonomy: Jurisdiction
 *
 * Slug: `jurisdiction` — flat (non-hierarchical).
 *
 * Why?
 *   Law firms operating across multiple states need to surface "Which attorneys
 *   are licensed in California?" Storing this as a taxonomy (rather than a
 *   repeater meta field) makes it queryable via standard WP_Query tax_query,
 *   works with archive URLs, and allows editors to manage the list of valid
 *   jurisdictions in one place. Critical for compliance — you cannot advertise
 *   an attorney in a state where they are not barred.
 *
 *   Terms: US states, federal courts, international jurisdictions as needed.
 *   Registered on: `attorney`
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Jurisdiction taxonomy.
 *
 * @return void
 */
function inf_register_tax_jurisdiction(): void {
    $labels = array(
        'name'          => _x( 'Jurisdictions', 'taxonomy general name', 'inf' ),
        'singular_name' => _x( 'Jurisdiction', 'taxonomy singular name', 'inf' ),
        'search_items'  => __( 'Search Jurisdictions', 'inf' ),
        'all_items'     => __( 'All Jurisdictions', 'inf' ),
        'edit_item'     => __( 'Edit Jurisdiction', 'inf' ),
        'update_item'   => __( 'Update Jurisdiction', 'inf' ),
        'add_new_item'  => __( 'Add New Jurisdiction', 'inf' ),
        'new_item_name' => __( 'New Jurisdiction', 'inf' ),
        'menu_name'     => __( 'Jurisdictions', 'inf' ),
        'not_found'     => __( 'No jurisdictions found.', 'inf' ),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => false,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'jurisdiction', 'with_front' => false ),
    );

    register_taxonomy( 'jurisdiction', array( 'attorney' ), $args );
}
add_action( 'init', 'inf_register_tax_jurisdiction' );
