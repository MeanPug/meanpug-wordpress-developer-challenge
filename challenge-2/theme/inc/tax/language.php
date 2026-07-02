<?php
/**
 * Taxonomy: Language
 *
 * Slug: `language` — flat (non-hierarchical).
 *
 * Why?
 *   Large law firms serving diverse communities advertise bilingual attorneys.
 *   This is a user-facing filter ("Find a Spanish-speaking attorney") and an
 *   accessibility feature. As a taxonomy it is queryable, shows in the admin
 *   column, and is easy to extend (add "Mandarin", "Portuguese") without
 *   schema changes. Flat because languages have no hierarchy.
 *
 *   Registered on: `attorney`
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Language taxonomy.
 *
 * @return void
 */
function inf_register_tax_language(): void {
    $labels = array(
        'name'          => _x( 'Languages', 'taxonomy general name', 'inf' ),
        'singular_name' => _x( 'Language', 'taxonomy singular name', 'inf' ),
        'search_items'  => __( 'Search Languages', 'inf' ),
        'all_items'     => __( 'All Languages', 'inf' ),
        'edit_item'     => __( 'Edit Language', 'inf' ),
        'update_item'   => __( 'Update Language', 'inf' ),
        'add_new_item'  => __( 'Add New Language', 'inf' ),
        'new_item_name' => __( 'New Language', 'inf' ),
        'menu_name'     => __( 'Languages', 'inf' ),
        'not_found'     => __( 'No languages found.', 'inf' ),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => false,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'language', 'with_front' => false ),
    );

    register_taxonomy( 'language', array( 'attorney' ), $args );
}
add_action( 'init', 'inf_register_tax_language' );
