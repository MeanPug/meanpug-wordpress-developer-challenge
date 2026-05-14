<?php
/**
 * Register Custom Post Types & Data Architecture
 * * DATA STRUCTURE:
 * - practice_area: The main services/departments (e.g., Corporate Law).
 * - attorney: The legal specialists (The "Team").
 * * CONNECTIONS:
 * - RELATIONSHIP: 'practice_area' uses an ACF Relationship field ('related_attorneys') 
 * to manually link specific Attorneys to their expertise areas.
 * - TAXONOMY: 'specialization' is used on 'attorney' to tag their specific niche 
 * skills (e.g., Specialist in Cars, Insurance, etc.).
 */

function puggle_register_cpts() {
    register_post_type('practice_area', [
        'labels'      => ['name' => 'Practice Areas', 'singular_name' => 'Area'],
        'public'      => true,
        'menu_icon'   => 'dashicons-shield',
        'supports'    => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest' => true,
        'has_archive' => true,
        'rewrite'     => ['slug' => 'practice-areas'],
    ]);

    register_post_type('attorney', [
        'labels'      => ['name' => 'Attorneys', 'singular_name' => 'Attorney'],
        'public'      => true,
        'menu_icon'   => 'dashicons-businessman',
        'supports'    => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
    ]);
}
add_action('init', 'puggle_register_cpts');