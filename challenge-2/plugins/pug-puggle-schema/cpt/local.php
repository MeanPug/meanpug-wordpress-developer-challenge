<?php
/**
 * CPT: Local (Area Served)
 *
 * Geographic landing pages (e.g. /areas-served/dallas/car-accidents).
 * Hierarchical to support parent="region" / child="city + practice area"
 * which the commented cross-PA logic in services/locations.php expects.
 *
 * Note the slug stays "local" because:
 *   - inf_canonical_post_type_name() can be extended to map it
 *   - existing widgets/services already use is_singular('local') and
 *     get_posts(['post_type' => 'local'])
 *
 * @package infra
 */

function inf_register_local_cpt() {
    $labels = array(
        'name'               => _x( 'Areas Served', 'post type general name', 'inf' ),
        'singular_name'      => _x( 'Area Served', 'post type singular name', 'inf' ),
        'menu_name'          => _x( 'Areas Served', 'admin menu', 'inf' ),
        'add_new'            => _x( 'Add New', 'area served', 'inf' ),
        'add_new_item'       => __( 'Add New Area Served', 'inf' ),
        'edit_item'          => __( 'Edit Area Served', 'inf' ),
        'new_item'           => __( 'New Area Served', 'inf' ),
        'view_item'          => __( 'View Area Served', 'inf' ),
        'search_items'       => __( 'Search Areas Served', 'inf' ),
        'not_found'          => __( 'No areas served found', 'inf' ),
        'not_found_in_trash' => __( 'No areas served found in trash', 'inf' ),
        'parent_item_colon'  => __( 'Parent Area:', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-admin-site-alt3',
        'menu_position'      => 24,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'areas-served', 'with_front' => false ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'revisions' ),
        'taxonomies'         => array( 'category' ),
    );

    register_post_type( 'local', $args );
}
add_action( 'init', 'inf_register_local_cpt' );
