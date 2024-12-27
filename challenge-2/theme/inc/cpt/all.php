<?php

// Register Custom Post Types (CPTs)
function register_custom_post_types() {

    // Team CPT
    register_post_type( 'team', array(
        'labels' => array(
            'name' => 'Team',
            'singular_name' => 'Team',
            'add_new_item' => 'Add New Team Member',
            'edit_item' => 'Edit Team Member',
            'all_items' => 'All Team Members',
            'view_item' => 'View Team Member',
            'search_items' => 'Search Team Members',
            'not_found' => 'No team members found',
        ),
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'rewrite' => array( 'slug' => 'team' ),
    ) );

    // Locations CPT
    register_post_type( 'locations', array(
        'labels' => array(
            'name' => 'Locations',
            'singular_name' => 'Location',
            'add_new_item' => 'Add New Location',
            'edit_item' => 'Edit Location',
            'all_items' => 'All Locations',
            'view_item' => 'View Location',
            'search_items' => 'Search Locations',
            'not_found' => 'No locations found',
        ),
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array( 'title', 'editor', 'custom-fields' ),
        'rewrite' => array( 'slug' => 'locations' ),
    ) );

    // Practice Areas CPT
    register_post_type( 'practice_areas', array(
        'labels' => array(
            'name' => 'Practice Areas',
            'singular_name' => 'Practice Area',
            'add_new_item' => 'Add New Practice Area',
            'edit_item' => 'Edit Practice Area',
            'all_items' => 'All Practice Areas',
            'view_item' => 'View Practice Area',
            'search_items' => 'Search Practice Areas',
            'not_found' => 'No practice areas found',
        ),
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array( 'title', 'editor' ),
        'rewrite' => array( 'slug' => 'practice-areas' ),
    ) );

    // Cases CPT
    register_post_type( 'cases', array(
        'labels' => array(
            'name' => 'Cases',
            'singular_name' => 'Case',
            'add_new_item' => 'Add New Case',
            'edit_item' => 'Edit Case',
            'all_items' => 'All Cases',
            'view_item' => 'View Case',
            'search_items' => 'Search Cases',
            'not_found' => 'No cases found',
        ),
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => true,
        'supports' => array( 'title', 'editor', 'custom-fields' ),
        'rewrite' => array( 'slug' => 'cases' ),
    ) );

}
add_action( 'init', 'register_custom_post_types' );