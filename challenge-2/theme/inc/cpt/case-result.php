<?php

function register_case_result_cpt() {
    $labels = array(
        'name'                  => _x('Case Results', 'Post type general name', 'meanpug'),
        'singular_name'         => _x('Case Result', 'Post type singular name', 'meanpug'),
        'menu_name'             => _x('Case Results', 'Admin Menu text', 'meanpug'),
        'name_admin_bar'        => _x('Case Result', 'Add New on Toolbar', 'meanpug'),
        'add_new'               => __('Add New', 'meanpug'),
        'add_new_item'          => __('Add New Case Result', 'meanpug'),
        'new_item'              => __('New Case Result', 'meanpug'),
        'edit_item'             => __('Edit Case Result', 'meanpug'),
        'view_item'             => __('View Case Result', 'meanpug'),
        'all_items'             => __('All Case Results', 'meanpug'),
        'search_items'          => __('Search Case Results', 'meanpug'),
        'not_found'             => __('No case results found.', 'meanpug'),
        'not_found_in_trash'    => __('No case results found in Trash.', 'meanpug'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'case-result'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-awards',
        'show_in_rest'       => true,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
    );

    register_post_type('case-result', $args);
}

add_action('init', 'register_case_result_cpt');
