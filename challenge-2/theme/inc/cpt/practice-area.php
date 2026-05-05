<?php

function register_practice_area_cpt() {
    $labels = array(
        'name'                  => _x('Practice Areas', 'Post type general name', 'meanpug'),
        'singular_name'         => _x('Practice Area', 'Post type singular name', 'meanpug'),
        'menu_name'             => _x('Practice Areas', 'Admin Menu text', 'meanpug'),
        'name_admin_bar'        => _x('Practice Area', 'Add New on Toolbar', 'meanpug'),
        'add_new'               => __('Add New', 'meanpug'),
        'add_new_item'          => __('Add New Practice Area', 'meanpug'),
        'new_item'              => __('New Practice Area', 'meanpug'),
        'edit_item'             => __('Edit Practice Area', 'meanpug'),
        'view_item'             => __('View Practice Area', 'meanpug'),
        'all_items'             => __('All Practice Areas', 'meanpug'),
        'search_items'          => __('Search Practice Areas', 'meanpug'),
        'not_found'             => __('No practice areas found.', 'meanpug'),
        'not_found_in_trash'    => __('No practice areas found in Trash.', 'meanpug'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'practice-area'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-portfolio',
        'show_in_rest'       => true,
        'supports'           => array('title', 'editor', 'thumbnail', 'page-attributes'),
    );

    register_post_type('practice-area', $args);
}

add_action('init', 'register_practice_area_cpt');
