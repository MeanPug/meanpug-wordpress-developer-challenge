<?php

function inf_register_taxonomies() {

    // Practice Area Type
    // Shared across team, local, and testimonials for cross-referencing content
    register_taxonomy('practice-area-type', array('team', 'local', 'testimonials', 'case-result', 'faq'), array(
        'labels' => array(
            'name'              => 'Practice Area Types',
            'singular_name'     => 'Practice Area Type',
            'search_items'      => 'Search Practice Area Types',
            'all_items'         => 'All Practice Area Types',
            'edit_item'         => 'Edit Practice Area Type',
            'update_item'       => 'Update Practice Area Type',
            'add_new_item'      => 'Add New Practice Area Type',
            'new_item_name'     => 'New Practice Area Type',
            'menu_name'         => 'Practice Area Types',
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'practice-area-type'),
    ));

    // Area Served
    // Geographic taxonomy linking local pages to practice areas
    // Referenced in location navigator widget and services/locations.php queries
    register_taxonomy('area-served', array('local', 'practice-area'), array(
        'labels' => array(
            'name'              => 'Areas Served',
            'singular_name'     => 'Area Served',
            'search_items'      => 'Search Areas Served',
            'all_items'         => 'All Areas Served',
            'edit_item'         => 'Edit Area Served',
            'update_item'       => 'Update Area Served',
            'add_new_item'      => 'Add New Area Served',
            'new_item_name'     => 'New Area Served',
            'menu_name'         => 'Areas Served',
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'area-served'),
    ));

    // Case Type
    // Used for categorizing case results and filtering by injury type
    register_taxonomy('case-type', array('post'), array(
        'labels' => array(
            'name'              => 'Case Types',
            'singular_name'     => 'Case Type',
            'search_items'      => 'Search Case Types',
            'all_items'         => 'All Case Types',
            'edit_item'         => 'Edit Case Type',
            'update_item'       => 'Update Case Type',
            'add_new_item'      => 'Add New Case Type',
            'new_item_name'     => 'New Case Type',
            'menu_name'         => 'Case Types',
        ),
        'hierarchical'      => true,
        'public'            => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'case-type'),
    ));

}
add_action('init', 'inf_register_taxonomies');