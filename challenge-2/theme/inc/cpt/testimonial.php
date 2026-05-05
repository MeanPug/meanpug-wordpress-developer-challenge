<?php

function register_testimonial_cpt() {
    $labels = array(
        'name'                  => _x('Testimonials', 'Post type general name', 'meanpug'),
        'singular_name'         => _x('Testimonial', 'Post type singular name', 'meanpug'),
        'menu_name'             => _x('Testimonials', 'Admin Menu text', 'meanpug'),
        'name_admin_bar'        => _x('Testimonial', 'Add New on Toolbar', 'meanpug'),
        'add_new'               => __('Add New', 'meanpug'),
        'add_new_item'          => __('Add New Testimonial', 'meanpug'),
        'new_item'              => __('New Testimonial', 'meanpug'),
        'edit_item'             => __('Edit Testimonial', 'meanpug'),
        'view_item'             => __('View Testimonial', 'meanpug'),
        'all_items'             => __('All Testimonials', 'meanpug'),
        'search_items'          => __('Search Testimonials', 'meanpug'),
        'not_found'             => __('No testimonials found.', 'meanpug'),
        'not_found_in_trash'    => __('No testimonials found in Trash.', 'meanpug'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => false,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-format-quote',
        'exclude_from_search'=> true,
        'show_in_rest'       => true,
        'supports'           => array('title', 'editor'),
    );

    register_post_type('testimonial', $args);
}

add_action('init', 'register_testimonial_cpt');
