<?php
function pug_register_cpt_office() {
    $labels = [
        'name'          => 'Offices',
        'singular_name' => 'Office',
        'add_new_item'  => 'Add New Office',
        'edit_item'     => 'Edit Office',
        'all_items'     => 'All Offices',
    ];

        register_post_type('office', [
        'labels'        => $labels,
        'public'        => true,
        'hierarchical'  => true,
        'supports'      => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'menu_icon'     => 'dashicons-category',
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'offices'],
        'show_in_rest'  => true,
    ]);
}
add_action('init', 'pug_register_cpt_office');