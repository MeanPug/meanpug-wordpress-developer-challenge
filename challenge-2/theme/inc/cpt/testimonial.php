<?php
function pug_register_cpt_testimonial() {
    $labels = [
        'name'          => 'Testimonials',
        'singular_name' => 'Testimonial',
        'add_new_item'  => 'Add New Testimonial',
        'edit_item'     => 'Edit Testimonial',
        'all_items'     => 'All Testimonials',
    ];

        register_post_type('testimonial', [
        'labels'        => $labels,
        'public'        => true,
        'hierarchical'  => true,
        'supports'      => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'menu_icon'     => 'dashicons-category',
        'has_archive'   => true,
        'rewrite'       => ['slug' => 'testimonials'],
        'show_in_rest'  => true,
    ]);
}
add_action('init', 'pug_register_cpt_testimonial');