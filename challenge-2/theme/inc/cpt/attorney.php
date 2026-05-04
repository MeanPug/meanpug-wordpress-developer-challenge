<?php
function pug_register_cpt_attorney() {
    $labels = [
        'name'          => 'Attorneys',
        'singular_name' => 'Attorney',
        'add_new_item'  => 'Add New Attorney',
        'edit_item'     => 'Edit Attorney',
        'all_items'     => 'All Attorneys',
    ];

    register_post_type('attorney', [
        'labels'      => $labels,
        'public'      => true,
        'supports'    => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon'   => 'dashicons-businessperson',
        'has_archive' => true,
        'rewrite'     => ['slug' => 'attorneys'],
        'show_in_rest'=> true,
    ]);
}
add_action('init', 'pug_register_cpt_attorney');