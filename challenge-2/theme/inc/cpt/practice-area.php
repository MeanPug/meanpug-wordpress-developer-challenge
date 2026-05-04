<?php
function pug_register_cpt_practice_area() {
    $labels = [
        'name'          => 'Practice Areas',
        'singular_name' => 'Practice Area',
        'add_new_item'  => 'Add New Practice Area',
        'edit_item'     => 'Edit Practice Area',
        'all_items'     => 'All Practice Areas',
    ];

        register_post_type('practice_area', [
        'labels'        => $labels,
        'public'        => true,
        'hierarchical'  => true,
        'supports'      => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'menu_icon'     => 'dashicons-category',
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'practice-areas'],
        'show_in_rest'  => true,
    ]);
}
add_action('init', 'pug_register_cpt_practice_area');