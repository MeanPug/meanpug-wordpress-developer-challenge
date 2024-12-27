<?php
function register_custom_taxonomies() {

    // Staff Type Taxonomy for Team CPT
    register_taxonomy( 'staff_type', 'team', array(
        'labels' => array(
            'name' => 'Staff Types',
            'singular_name' => 'Staff Type',
            'search_items' => 'Search Staff Types',
            'all_items' => 'All Staff Types',
            'edit_item' => 'Edit Staff Type',
            'add_new_item' => 'Add New Staff Type',
            'new_item_name' => 'New Staff Type Name',
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'rewrite' => array( 'slug' => 'staff-type' ),
    ) );

    // Practice Area Taxonomy for Team and Cases CPT
    register_taxonomy( 'practice_area', array('team', 'cases', 'locations'), array(
        'labels' => array(
            'name' => 'Practice Areas',
            'singular_name' => 'Practice Area',
            'search_items' => 'Search Practice Areas',
            'all_items' => 'All Practice Areas',
            'edit_item' => 'Edit Practice Area',
            'add_new_item' => 'Add New Practice Area',
            'new_item_name' => 'New Practice Area Name',
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'rewrite' => array( 'slug' => 'practice-area' ),
    ) );

    // State Taxonomy for Locations CPT
    register_taxonomy( 'state', 'locations', array(
        'labels' => array(
            'name' => 'States',
            'singular_name' => 'State',
            'search_items' => 'Search States',
            'all_items' => 'All States',
            'edit_item' => 'Edit State',
            'add_new_item' => 'Add New State',
            'new_item_name' => 'New State Name',
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'rewrite' => array( 'slug' => 'state' ),
    ) );

    // Cases Taxonomy for Practice Areas and Team
    register_taxonomy( 'cases', array('practice_areas', 'team'), array(
        'labels' => array(
            'name' => 'Cases',
            'singular_name' => 'Case',
            'search_items' => 'Search Cases',
            'all_items' => 'All Cases',
            'edit_item' => 'Edit Case',
            'add_new_item' => 'Add New Case',
            'new_item_name' => 'New Case Name',
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'rewrite' => array( 'slug' => 'case' ),
    ) );

    // Team Member Taxonomy for Cases and Practice Areas
    register_taxonomy( 'team_member', array('cases', 'practice_areas', 'locations'), array(
        'labels' => array(
            'name' => 'Team Member',
            'singular_name' => 'Team Member',
            'search_items' => 'Search Team Members',
            'all_items' => 'All Team Members',
            'edit_item' => 'Edit Team Member',
            'add_new_item' => 'Add New Team Member',
            'new_item_name' => 'New Team Member Name',
        ),
        'hierarchical' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'rewrite' => array( 'slug' => 'team_member' ),
    ) );

}
add_action( 'init', 'register_custom_taxonomies' );