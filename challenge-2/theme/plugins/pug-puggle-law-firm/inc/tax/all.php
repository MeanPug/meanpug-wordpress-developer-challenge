<?php

function pplf_register_taxonomies() {
    $taxonomies = array(
        'area-served' => array(
            'label'             => __('Areas Served', 'pug-puggle-law'),
            'singular_name'     => __('Area Served', 'pug-puggle-law'),
            'hierarchical'      => true,
            'rewrite'           => array('slug' => 'area-served', 'with_front' => false),
            'show_in_rest'      => true,
            'post_types'        => array('practice-area', 'local', 'office'),
        ),
    );

    foreach ($taxonomies as $slug => $args) {
        $post_types = $args['post_types'];
        unset($args['post_types']);

        $defaults = array(
            'labels' => array(
                'name'          => $args['label'],
                'singular_name' => $args['singular_name'],
                'add_new_item'  => sprintf(__('Add New %s', 'pug-puggle-law'), $args['singular_name']),
                'edit_item'     => sprintf(__('Edit %s', 'pug-puggle-law'), $args['singular_name']),
                'search_items'  => sprintf(__('Search %s', 'pug-puggle-law'), $args['label']),
            ),
            'show_in_rest' => true,
        );

        register_taxonomy($slug, $post_types, wp_parse_args($args, $defaults));
    }
}
add_action('init', 'pplf_register_taxonomies');

function pplf_flush_rewrites() {
    pplf_register_post_types();
    pplf_register_taxonomies();
    flush_rewrite_rules();
}
