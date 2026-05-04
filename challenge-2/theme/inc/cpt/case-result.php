<?php
function pug_register_cpt_case_result() {
    $labels = [
        'name'          => 'Case Results',
        'singular_name' => 'Case Result',
        'add_new_item'  => 'Add New Case Result',
        'edit_item'     => 'Edit Case Result',
        'all_items'     => 'All Case Results',
    ];

        register_post_type('case_result', [
        'labels'        => $labels,
        'public'        => true,
        'hierarchical'  => true,
        'supports'      => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'menu_icon'     => 'dashicons-category',
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'case-results'],
        'show_in_rest'  => true,
    ]);
}
add_action('init', 'pug_register_cpt_case_result');