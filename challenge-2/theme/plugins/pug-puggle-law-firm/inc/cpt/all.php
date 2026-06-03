<?php

function pplf_register_post_types() {
    $post_types = array(
        'practice-area' => array(
            'label'               => __('Practice Areas', 'pug-puggle-law'),
            'singular_name'       => __('Practice Area', 'pug-puggle-law'),
            'description'         => __('Legal practice areas', 'pug-puggle-law'),
            'public'              => true,
            'hierarchical'        => true,
            'has_archive'         => true,
            'rewrite'             => array('slug' => 'practice-areas', 'with_front' => false),
            'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
            'menu_icon'           => 'dashicons-portfolio',
            'show_in_rest'        => true,
        ),
        'team' => array(
            'label'               => __('Attorneys', 'pug-puggle-law'),
            'singular_name'       => __('Attorney', 'pug-puggle-law'),
            'description'         => __('Firm attorneys and staff', 'pug-puggle-law'),
            'public'              => true,
            'hierarchical'        => false,
            'has_archive'         => true,
            'rewrite'             => array('slug' => 'attorneys', 'with_front' => false),
            'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
            'menu_icon'           => 'dashicons-groups',
            'show_in_rest'        => true,
        ),
        'office' => array(
            'label'               => __('Offices', 'pug-puggle-law'),
            'singular_name'       => __('Office', 'pug-puggle-law'),
            'description'         => __('Physical office locations', 'pug-puggle-law'),
            'public'              => true,
            'hierarchical'        => false,
            'has_archive'         => true,
            'rewrite'             => array('slug' => 'offices', 'with_front' => false),
            'supports'            => array('title', 'editor', 'thumbnail'),
            'menu_icon'           => 'dashicons-building',
            'show_in_rest'        => true,
        ),
        'local' => array(
            'label'               => __('Areas Served', 'pug-puggle-law'),
            'singular_name'       => __('Area Served', 'pug-puggle-law'),
            'description'         => __('Geographic areas the firm serves', 'pug-puggle-law'),
            'public'              => true,
            'hierarchical'        => true,
            'has_archive'         => true,
            'rewrite'             => array('slug' => 'locations', 'with_front' => false),
            'supports'            => array('title', 'editor', 'page-attributes'),
            'menu_icon'           => 'dashicons-location',
            'show_in_rest'        => true,
        ),
        'testimonials' => array(
            'label'               => __('Testimonials', 'pug-puggle-law'),
            'singular_name'       => __('Testimonial', 'pug-puggle-law'),
            'description'         => __('Client reviews and case results', 'pug-puggle-law'),
            'public'              => true,
            'hierarchical'        => false,
            'has_archive'         => true,
            'rewrite'             => array('slug' => 'testimonials', 'with_front' => false),
            'supports'            => array('title', 'editor'),
            'menu_icon'           => 'dashicons-star-filled',
            'show_in_rest'        => true,
        ),
    );

    foreach ($post_types as $slug => $args) {
        $defaults = array(
            'labels'              => array(
                'name'          => $args['label'],
                'singular_name' => $args['singular_name'],
                'add_new_item'  => sprintf(__('Add New %s', 'pug-puggle-law'), $args['singular_name']),
                'edit_item'     => sprintf(__('Edit %s', 'pug-puggle-law'), $args['singular_name']),
                'view_item'     => sprintf(__('View %s', 'pug-puggle-law'), $args['singular_name']),
                'search_items'  => sprintf(__('Search %s', 'pug-puggle-law'), $args['label']),
                'not_found'     => sprintf(__('No %s found', 'pug-puggle-law'), $args['label']),
            ),
            'public'              => true,
            'hierarchical'        => false,
            'has_archive'         => true,
            'show_in_rest'        => true,
            'supports'            => array('title', 'editor'),
            'menu_position'       => 20,
        );

        register_post_type($slug, wp_parse_args($args, $defaults));
    }
}
add_action('init', 'pplf_register_post_types');
