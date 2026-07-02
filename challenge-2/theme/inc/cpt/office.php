<?php
/**
 * Custom Post Type: Office
 *
 * Registers the `office` CPT.
 *
 * Why a CPT?
 *   - Each physical office needs its own LocalBusiness + LegalService schema
 *     block, map coordinates, hours, phone number, and address. These are
 *     structured fields — not free-form pages. The CPT gives us a clean
 *     archive of all locations and per-office schema output.
 *   - Already referenced in `inc/hooks.php` (`is_singular('office')`) and
 *     `inc/utils/seo/schema.php` (`mp_generate_office_schema()`).
 *     The slug `office` must remain stable.
 *
 * Archive URL: /offices/
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the Office CPT.
 *
 * @return void
 */
function inf_register_cpt_office(): void {
    $labels = array(
        'name'                  => _x( 'Offices', 'post type general name', 'inf' ),
        'singular_name'         => _x( 'Office', 'post type singular name', 'inf' ),
        'menu_name'             => _x( 'Offices', 'admin menu', 'inf' ),
        'name_admin_bar'        => _x( 'Office', 'add new on admin bar', 'inf' ),
        'add_new'               => _x( 'Add New', 'office', 'inf' ),
        'add_new_item'          => __( 'Add New Office', 'inf' ),
        'new_item'              => __( 'New Office', 'inf' ),
        'edit_item'             => __( 'Edit Office', 'inf' ),
        'view_item'             => __( 'View Office', 'inf' ),
        'all_items'             => __( 'All Offices', 'inf' ),
        'search_items'          => __( 'Search Offices', 'inf' ),
        'not_found'             => __( 'No offices found.', 'inf' ),
        'not_found_in_trash'    => __( 'No offices found in Trash.', 'inf' ),
        'archives'              => __( 'Office Archives', 'inf' ),
        'items_list'            => __( 'Offices list', 'inf' ),
        'items_list_navigation' => __( 'Offices list navigation', 'inf' ),
        'filter_items_list'     => __( 'Filter offices list', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Physical office locations including address, phone, hours, and map coordinates.', 'inf' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array(
            'slug'       => 'offices',
            'with_front' => false,
        ),
        'capability_type'    => 'post',
        'has_archive'        => 'offices',
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-location-alt',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'show_in_rest'       => true,
        'taxonomies'         => array( 'office-location' ),
    );

    register_post_type( 'office', $args );
}
add_action( 'init', 'inf_register_cpt_office' );
