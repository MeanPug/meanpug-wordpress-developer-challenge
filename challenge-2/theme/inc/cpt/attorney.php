<?php

function register_attorney_cpt() {
    $labels = array(
        'name'                  => _x('Attorneys', 'Post type general name', 'meanpug'),
        'singular_name'         => _x('Attorney', 'Post type singular name', 'meanpug'),
        'menu_name'             => _x('Attorneys', 'Admin Menu text', 'meanpug'),
        'name_admin_bar'        => _x('Attorney', 'Add New on Toolbar', 'meanpug'),
        'add_new'               => __('Add New', 'meanpug'),
        'add_new_item'          => __('Add New Attorney', 'meanpug'),
        'new_item'              => __('New Attorney', 'meanpug'),
        'edit_item'             => __('Edit Attorney', 'meanpug'),
        'view_item'             => __('View Attorney', 'meanpug'),
        'all_items'             => __('All Attorneys', 'meanpug'),
        'search_items'          => __('Search Attorneys', 'meanpug'),
        'not_found'             => __('No attorneys found.', 'meanpug'),
        'not_found_in_trash'    => __('No attorneys found in Trash.', 'meanpug'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'attorney'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-businessman',
        'show_in_rest'       => true,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
    );

    register_post_type('attorney', $args);
}

add_action('init', 'register_attorney_cpt');
