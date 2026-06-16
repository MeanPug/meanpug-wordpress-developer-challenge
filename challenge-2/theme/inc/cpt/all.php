<?php

function inf_register_custom_post_types() {

    // Practice Areas (hierarchical to support child topics)
    register_post_type('practice-area', array(
        'labels' => array(
            'name'               => 'Practice Areas',
            'singular_name'      => 'Practice Area',
            'add_new_item'       => 'Add New Practice Area',
            'edit_item'          => 'Edit Practice Area',
            'view_item'          => 'View Practice Area',
            'search_items'       => 'Search Practice Areas',
            'not_found'          => 'No Practice Areas found',
        ),
        'public'            => true,
        'hierarchical'      => true,
        'has_archive'       => true,
        'rewrite'           => array('slug' => 'practice-areas'),
        'menu_icon'         => 'dashicons-clipboard',
        'supports'          => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'show_in_rest'      => true,
    ));

    // Team (Attorneys)
    register_post_type('team', array(
        'labels' => array(
            'name'               => 'Attorneys',
            'singular_name'      => 'Attorney',
            'add_new_item'       => 'Add New Attorney',
            'edit_item'          => 'Edit Attorney',
            'view_item'          => 'View Attorney',
            'search_items'       => 'Search Attorneys',
            'not_found'          => 'No Attorneys found',
        ),
        'public'            => true,
        'hierarchical'      => false,
        'has_archive'       => true,
        'rewrite'           => array('slug' => 'attorneys'),
        'menu_icon'         => 'dashicons-businessperson',
        'supports'          => array('title', 'editor', 'thumbnail', 'author'),
        'show_in_rest'      => true,
    ));

    // Offices
    register_post_type('office', array(
        'labels' => array(
            'name'               => 'Offices',
            'singular_name'      => 'Office',
            'add_new_item'       => 'Add New Office',
            'edit_item'          => 'Edit Office',
            'view_item'          => 'View Office',
            'search_items'       => 'Search Offices',
            'not_found'          => 'No Offices found',
        ),
        'public'            => true,
        'hierarchical'      => false,
        'has_archive'       => true,
        'rewrite'           => array('slug' => 'offices'),
        'menu_icon'         => 'dashicons-location',
        'supports'          => array('title', 'editor', 'thumbnail'),
        'show_in_rest'      => true,
    ));

    // Testimonials
    register_post_type('testimonials', array(
        'labels' => array(
            'name'               => 'Testimonials',
            'singular_name'      => 'Testimonial',
            'add_new_item'       => 'Add New Testimonial',
            'edit_item'          => 'Edit Testimonial',
            'view_item'          => 'View Testimonial',
            'search_items'       => 'Search Testimonials',
            'not_found'          => 'No Testimonials found',
        ),
        'public'            => true,
        'hierarchical'      => false,
        'has_archive'       => true,
        'rewrite'           => array('slug' => 'testimonials'),
        'menu_icon'         => 'dashicons-format-quote',
        'supports'          => array('title', 'editor'),
        'show_in_rest'      => true,
    ));

    // Local (Area Served pages — supports parent/child hierarchy for state > city grouping)
    register_post_type('local', array(
        'labels' => array(
            'name'               => 'Local Pages',
            'singular_name'      => 'Local Page',
            'add_new_item'       => 'Add New Local Page',
            'edit_item'          => 'Edit Local Page',
            'view_item'          => 'View Local Page',
            'search_items'       => 'Search Local Pages',
            'not_found'          => 'No Local Pages found',
        ),
        'public'            => true,
        'hierarchical'      => true,
        'has_archive'       => true,
        'rewrite'           => array('slug' => 'locations'),
        'menu_icon'         => 'dashicons-admin-site',
        'supports'          => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
        'show_in_rest'      => true,
    ));

    // Case Results / Verdicts
    register_post_type('case-result', array(
        'labels' => array(
            'name'               => 'Case Results',
            'singular_name'      => 'Case Result',
            'add_new_item'       => 'Add New Case Result',
            'edit_item'          => 'Edit Case Result',
            'view_item'          => 'View Case Result',
            'search_items'       => 'Search Case Results',
            'not_found'          => 'No Case Results found',
        ),
        'public'            => true,
        'hierarchical'      => false,
        'has_archive'       => true,
        'rewrite'           => array('slug' => 'case-results'),
        'menu_icon'         => 'dashicons-awards',
        'supports'          => array('title', 'editor'),
        'show_in_rest'      => true,
    ));

    // FAQs
    register_post_type('faq', array(
        'labels' => array(
            'name'               => 'FAQs',
            'singular_name'      => 'FAQ',
            'add_new_item'       => 'Add New FAQ',
            'edit_item'          => 'Edit FAQ',
            'view_item'          => 'View FAQ',
            'search_items'       => 'Search FAQs',
            'not_found'          => 'No FAQs found',
        ),
        'public'            => true,
        'hierarchical'      => false,
        'has_archive'       => true,
        'rewrite'           => array('slug' => 'faqs'),
        'menu_icon'         => 'dashicons-editor-help',
        'supports'          => array('title', 'editor'),
        'show_in_rest'      => true,
    ));

    // Awards
    register_post_type('award', array(
        'labels' => array(
            'name'               => 'Awards',
            'singular_name'      => 'Award',
            'add_new_item'       => 'Add New Award',
            'edit_item'          => 'Edit Award',
            'view_item'          => 'View Award',
            'search_items'       => 'Search Awards',
            'not_found'          => 'No Awards found',
        ),
        'public'            => true,
        'hierarchical'      => false,
        'has_archive'       => true,
        'rewrite'           => array('slug' => 'awards'),
        'menu_icon'         => 'dashicons-star-filled',
        'supports'          => array('title', 'editor', 'thumbnail'),
        'show_in_rest'      => true,
    ));

}
add_action('init', 'inf_register_custom_post_types');