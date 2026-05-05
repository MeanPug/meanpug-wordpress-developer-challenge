<?php

function register_office_location_taxonomy() {
    $labels = array(
        'name'                       => _x('Office Locations', 'taxonomy general name', 'meanpug'),
        'singular_name'              => _x('Office Location', 'taxonomy singular name', 'meanpug'),
        'search_items'               => __('Search Office Locations', 'meanpug'),
        'popular_items'              => __('Popular Office Locations', 'meanpug'),
        'all_items'                  => __('All Office Locations', 'meanpug'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Office Location', 'meanpug'),
        'update_item'                => __('Update Office Location', 'meanpug'),
        'add_new_item'               => __('Add New Office Location', 'meanpug'),
        'new_item_name'              => __('New Office Location Name', 'meanpug'),
        'separate_items_with_commas' => __('Separate office locations with commas', 'meanpug'),
        'add_or_remove_items'        => __('Add or remove office locations', 'meanpug'),
        'choose_from_most_used'      => __('Choose from the most used office locations', 'meanpug'),
        'not_found'                  => __('No office locations found.', 'meanpug'),
        'menu_name'                  => __('Office Locations', 'meanpug'),
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array('slug' => 'office-location'),
        'show_in_rest'          => true,
    );

    register_taxonomy('office-location', array('attorney', 'practice-area'), $args);
}

add_action('init', 'register_office_location_taxonomy');
