<?php
/**
 * Custom Post Types for Law Firm Theme
 */

// Register Attorneys CPT
function register_attorneys_cpt() {
    $labels = array(
        'name'                  => _x( 'Attorneys', 'Post type general name', 'inf' ),
        'singular_name'         => _x( 'Attorney', 'Post type singular name', 'inf' ),
        'menu_name'             => _x( 'Attorneys', 'Admin Menu text', 'inf' ),
        'name_admin_bar'        => _x( 'Attorney', 'Add New on Toolbar', 'inf' ),
        'add_new'               => __( 'Add New', 'inf' ),
        'add_new_item'          => __( 'Add New Attorney', 'inf' ),
        'new_item'              => __( 'New Attorney', 'inf' ),
        'edit_item'             => __( 'Edit Attorney', 'inf' ),
        'view_item'             => __( 'View Attorney', 'inf' ),
        'all_items'             => __( 'All Attorneys', 'inf' ),
        'search_items'          => __( 'Search Attorneys', 'inf' ),
        'parent_item_colon'     => __( 'Parent Attorneys:', 'inf' ),
        'not_found'             => __( 'No attorneys found.', 'inf' ),
        'not_found_in_trash'    => __( 'No attorneys found in Trash.', 'inf' ),
        'featured_image'        => _x( 'Attorney Photo', 'Overrides the "Featured Image" phrase', 'inf' ),
        'set_featured_image'    => _x( 'Set attorney photo', 'Overrides the "Set featured image" phrase', 'inf' ),
        'remove_featured_image' => _x( 'Remove attorney photo', 'Overrides the "Remove featured image" phrase', 'inf' ),
        'use_featured_image'    => _x( 'Use as attorney photo', 'Overrides the "Use as featured image" phrase', 'inf' ),
        'archives'              => _x( 'Attorney archives', 'The post type archive label used in nav menus', 'inf' ),
        'insert_into_item'      => _x( 'Insert into attorney', 'Overrides the "Insert into post"/"Insert into page" phrase', 'inf' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this attorney', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase', 'inf' ),
        'filter_items_list'     => _x( 'Filter attorneys list', 'Screen reader text for the filter links heading on the post type listing screen', 'inf' ),
        'items_list_navigation' => _x( 'Attorneys list navigation', 'Screen reader text for the pagination heading on the post type listing screen', 'inf' ),
        'items_list'            => _x( 'Attorneys list', 'Screen reader text for the items list heading on the post type listing screen', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'attorney' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'attorney', $args );
}
add_action( 'init', 'register_attorneys_cpt' );

// Register Practice Areas CPT
function register_practice_areas_cpt() {
    $labels = array(
        'name'                  => _x( 'Practice Areas', 'Post type general name', 'inf' ),
        'singular_name'         => _x( 'Practice Area', 'Post type singular name', 'inf' ),
        'menu_name'             => _x( 'Practice Areas', 'Admin Menu text', 'inf' ),
        'name_admin_bar'        => _x( 'Practice Area', 'Add New on Toolbar', 'inf' ),
        'add_new'               => __( 'Add New', 'inf' ),
        'add_new_item'          => __( 'Add New Practice Area', 'inf' ),
        'new_item'              => __( 'New Practice Area', 'inf' ),
        'edit_item'             => __( 'Edit Practice Area', 'inf' ),
        'view_item'             => __( 'View Practice Area', 'inf' ),
        'all_items'             => __( 'All Practice Areas', 'inf' ),
        'search_items'          => __( 'Search Practice Areas', 'inf' ),
        'parent_item_colon'     => __( 'Parent Practice Areas:', 'inf' ),
        'not_found'             => __( 'No practice areas found.', 'inf' ),
        'not_found_in_trash'    => __( 'No practice areas found in Trash.', 'inf' ),
        'featured_image'        => _x( 'Practice Area Image', 'Overrides the "Featured Image" phrase', 'inf' ),
        'set_featured_image'    => _x( 'Set practice area image', 'Overrides the "Set featured image" phrase', 'inf' ),
        'remove_featured_image' => _x( 'Remove practice area image', 'Overrides the "Remove featured image" phrase', 'inf' ),
        'use_featured_image'    => _x( 'Use as practice area image', 'Overrides the "Use as featured image" phrase', 'inf' ),
        'archives'              => _x( 'Practice area archives', 'The post type archive label used in nav menus', 'inf' ),
        'insert_into_item'      => _x( 'Insert into practice area', 'Overrides the "Insert into post"/"Insert into page" phrase', 'inf' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this practice area', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase', 'inf' ),
        'filter_items_list'     => _x( 'Filter practice areas list', 'Screen reader text for the filter links heading on the post type listing screen', 'inf' ),
        'items_list_navigation' => _x( 'Practice areas list navigation', 'Screen reader text for the pagination heading on the post type listing screen', 'inf' ),
        'items_list'            => _x( 'Practice areas list', 'Screen reader text for the items list heading on the post type listing screen', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'practice-area' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'practice_area', $args );
}
add_action( 'init', 'register_practice_areas_cpt' );

// Register Cases CPT
function register_cases_cpt() {
    $labels = array(
        'name'                  => _x( 'Cases', 'Post type general name', 'inf' ),
        'singular_name'         => _x( 'Case', 'Post type singular name', 'inf' ),
        'menu_name'             => _x( 'Cases', 'Admin Menu text', 'inf' ),
        'name_admin_bar'        => _x( 'Case', 'Add New on Toolbar', 'inf' ),
        'add_new'               => __( 'Add New', 'inf' ),
        'add_new_item'          => __( 'Add New Case', 'inf' ),
        'new_item'              => __( 'New Case', 'inf' ),
        'edit_item'             => __( 'Edit Case', 'inf' ),
        'view_item'             => __( 'View Case', 'inf' ),
        'all_items'             => __( 'All Cases', 'inf' ),
        'search_items'          => __( 'Search Cases', 'inf' ),
        'parent_item_colon'     => __( 'Parent Cases:', 'inf' ),
        'not_found'             => __( 'No cases found.', 'inf' ),
        'not_found_in_trash'    => __( 'No cases found in Trash.', 'inf' ),
        'featured_image'        => _x( 'Case Image', 'Overrides the "Featured Image" phrase', 'inf' ),
        'set_featured_image'    => _x( 'Set case image', 'Overrides the "Set featured image" phrase', 'inf' ),
        'remove_featured_image' => _x( 'Remove case image', 'Overrides the "Remove featured image" phrase', 'inf' ),
        'use_featured_image'    => _x( 'Use as case image', 'Overrides the "Use as featured image" phrase', 'inf' ),
        'archives'              => _x( 'Case archives', 'The post type archive label used in nav menus', 'inf' ),
        'insert_into_item'      => _x( 'Insert into case', 'Overrides the "Insert into post"/"Insert into page" phrase', 'inf' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this case', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase', 'inf' ),
        'filter_items_list'     => _x( 'Filter cases list', 'Screen reader text for the filter links heading on the post type listing screen', 'inf' ),
        'items_list_navigation' => _x( 'Cases list navigation', 'Screen reader text for the pagination heading on the post type listing screen', 'inf' ),
        'items_list'            => _x( 'Cases list', 'Screen reader text for the items list heading on the post type listing screen', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'case' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'case', $args );
}
add_action( 'init', 'register_cases_cpt' );

// Register Offices CPT
function register_offices_cpt() {
    $labels = array(
        'name'                  => _x( 'Offices', 'Post type general name', 'inf' ),
        'singular_name'         => _x( 'Office', 'Post type singular name', 'inf' ),
        'menu_name'             => _x( 'Offices', 'Admin Menu text', 'inf' ),
        'name_admin_bar'        => _x( 'Office', 'Add New on Toolbar', 'inf' ),
        'add_new'               => __( 'Add New', 'inf' ),
        'add_new_item'          => __( 'Add New Office', 'inf' ),
        'new_item'              => __( 'New Office', 'inf' ),
        'edit_item'             => __( 'Edit Office', 'inf' ),
        'view_item'             => __( 'View Office', 'inf' ),
        'all_items'             => __( 'All Offices', 'inf' ),
        'search_items'          => __( 'Search Offices', 'inf' ),
        'parent_item_colon'     => __( 'Parent Offices:', 'inf' ),
        'not_found'             => __( 'No offices found.', 'inf' ),
        'not_found_in_trash'    => __( 'No offices found in Trash.', 'inf' ),
        'featured_image'        => _x( 'Office Image', 'Overrides the "Featured Image" phrase', 'inf' ),
        'set_featured_image'    => _x( 'Set office image', 'Overrides the "Set featured image" phrase', 'inf' ),
        'remove_featured_image' => _x( 'Remove office image', 'Overrides the "Remove featured image" phrase', 'inf' ),
        'use_featured_image'    => _x( 'Use as office image', 'Overrides the "Use as featured image" phrase', 'inf' ),
        'archives'              => _x( 'Office archives', 'The post type archive label used in nav menus', 'inf' ),
        'insert_into_item'      => _x( 'Insert into office', 'Overrides the "Insert into post"/"Insert into page" phrase', 'inf' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this office', 'Overrides the "Uploaded to this post"/"Uploaded to this page" phrase', 'inf' ),
        'filter_items_list'     => _x( 'Filter offices list', 'Screen reader text for the filter links heading on the post type listing screen', 'inf' ),
        'items_list_navigation' => _x( 'Offices list navigation', 'Screen reader text for the pagination heading on the post type listing screen', 'inf' ),
        'items_list'            => _x( 'Offices list', 'Screen reader text for the items list heading on the post type listing screen', 'inf' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'office' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'office', $args );
}
add_action( 'init', 'register_offices_cpt' );


