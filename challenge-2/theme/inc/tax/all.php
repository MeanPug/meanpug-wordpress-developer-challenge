<?php
/**
 * Custom Taxonomies
 * - specialization: niche tags for attorneys (e.g., Car Accidents, Insurance).
 * - office_location: attorney branch locations.
 * - usage: Provides dynamic "Expert in X" labels for UI cards in the future.
 */
function puggle_register_taxonomies() {
    
    // 1. Specializations (Focus Areas for Attorneys)
    register_taxonomy('specialization', ['attorney'], [
        'labels' => [
            'name'              => 'Specializations',
            'singular_name'     => 'Specialization',
            'search_items'      => 'Search Specializations',
            'all_items'         => 'All Specializations',
            'edit_item'         => 'Edit Specialization',
            'update_item'       => 'Update Specialization',
            'add_new_item'      => 'Add New Specialization',
            'new_item_name'     => 'New Specialization Name',
            'menu_name'         => 'Specializations',
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'specialization'],
    ]);

    // 2. Office Locations
    register_taxonomy('office_location', ['attorney'], [
        'labels'       => ['name' => 'Locations', 'singular_name' => 'Location'],
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'location'],
    ]);
}
add_action('init', 'puggle_register_taxonomies');