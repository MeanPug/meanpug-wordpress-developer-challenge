<?php
/*-----------------------------------------------------------------------------------*/
/* CUSTOM POST FOR  PRACTICE AREAS
/*-----------------------------------------------------------------------------------*/
function create_post_practice_area() {
    register_post_type('practice_area', array(
        'labels' => array(
            'name'          => __('Practice Areas'),
            'singular_name' => __('Practice Area'),
            'add_new_item'  => __('Add New Practice Area'),
            'edit_item'     => __('Edit Practice Area'),
            'view_item'     => __('View Practice Area'),
            'all_items'     => __('All Practice Areas'),
            'not_found'     => __('No practice areas found'),
        ),
        'public'        => true,
        'hierarchical'  => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-awards',
        'supports'      => array(
            'title',
            'editor',
            'thumbnail',
        ),
        'taxonomies'    => array(
            'post_tag',
            'category',
        ),
        'show_in_menu'  => true,
        'rewrite'       => array('slug' => 'practice-areas'),
    ));
    register_taxonomy_for_object_type('category', 'practice_area');
    register_taxonomy_for_object_type('post_tag', 'practice_area');
}
add_action('init', 'create_post_practice_area');

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
        'key'    => 'group_practice_areas',
        'title'  => 'Practice Areas Field Group',
        'fields' => array(
            array(
                'key'         => 'field_practice_area_name',
                'label'       => 'Practice Area Name',
                'name'        => 'practice_area_name',
                'type'        => 'text',
                'required'    => 1,
                'placeholder' => 'Enter practice area name',
            ),
            array(
                'key'         => 'field_practice_slogan',
                'label'       => 'Slogan',
                'name'        => 'slogan',
                'type'        => 'text',
                'placeholder' => 'Enter slogan',
            ),
            array(
                'key'           => 'field_practice_hero_image',
                'label'         => 'Hero Image',
                'name'          => 'hero_image',
                'type'          => 'image',
                'return_format' => 'array',
                'preview_size'  => 'medium',
                'library'       => 'all',
            ),
            array(
                'key'          => 'field_practice_attorneys',
                'label'        => 'Attorneys',
                'name'         => 'attorneys',
                'type'         => 'repeater',
                'min'          => 0,
                'max'          => 0,
                'layout'       => 'table',
                'button_label' => 'Add Attorney',
                'sub_fields'   => array(
                    array(
                        'key'         => 'field_attorney_name',
                        'label'       => 'Name',
                        'name'        => 'attorney_name',
                        'type'        => 'text',
                        'placeholder' => 'Attorney full name',
                    ),
                    array(
                        'key'           => 'field_attorney_photo',
                        'label'         => 'Photo',
                        'name'          => 'attorney_photo',
                        'type'          => 'image',
                        'return_format' => 'array',
                        'preview_size'  => 'thumbnail',
                    ),
                    array(
                        'key'         => 'field_attorney_role',
                        'label'       => 'Role',
                        'name'        => 'attorney_role',
                        'type'        => 'text',
                        'placeholder' => 'e.g. Senior Partner',
                    ),
                ),
            ),
            array(
                'key'         => 'field_practice_videotestimonial',
                'label'       => 'Video Testimonial',
                'name'        => 'videotestimonial',
                'type'        => 'text',
                'placeholder' => 'Enter video URL',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'practice_area',
                ),
            ),
        ),
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'active'                => true,
    ));
}