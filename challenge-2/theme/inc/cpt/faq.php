<?php
function pug_register_cpt_faq() {
    $labels = [
        'name'          => 'FAQs',
        'singular_name' => 'FAQ',
        'add_new_item'  => 'Add New FAQ',
        'edit_item'     => 'Edit FAQ',
        'all_items'     => 'All FAQs',
    ];

        register_post_type('faq', [
        'labels'        => $labels,
        'public'        => true,
        'hierarchical'  => true,
        'supports'      => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'menu_icon'     => 'dashicons-category',
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'faqs'],
        'show_in_rest'  => true,
    ]);
}
add_action('init', 'pug_register_cpt_faq');