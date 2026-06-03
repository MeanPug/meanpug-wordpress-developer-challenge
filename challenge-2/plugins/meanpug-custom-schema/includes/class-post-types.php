<?php
declare( strict_types=1 );

namespace MeanPug\CustomSchema;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Post_Types {

    public function register(): void {
        $this->register_attorney();
        $this->register_practice_area();
        $this->register_case_result();
    }

    private function register_attorney(): void {
        $labels = [
            'name'               => 'Attorneys',
            'singular_name'      => 'Attorney',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Attorney',
            'edit_item'          => 'Edit Attorney',
            'new_item'           => 'New Attorney',
            'view_item'          => 'View Attorney',
            'search_items'       => 'Search Attorneys',
            'not_found'          => 'No attorneys found',
            'not_found_in_trash' => 'No attorneys found in trash',
            'menu_name'          => 'Attorneys',
        ];

        $args = [
            'labels'       => $labels,
            'public'       => true,
            'has_archive'  => true,
            'show_in_rest' => true,
            'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
            'rewrite'      => [ 'slug' => 'attorneys' ],
            'menu_icon'    => 'dashicons-id',
        ];

        register_post_type( 'attorney', $args );
    }

    private function register_practice_area(): void {
        $labels = [
            'name'               => 'Practice Areas',
            'singular_name'      => 'Practice Area',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Practice Area',
            'edit_item'          => 'Edit Practice Area',
            'new_item'           => 'New Practice Area',
            'view_item'          => 'View Practice Area',
            'search_items'       => 'Search Practice Areas',
            'not_found'          => 'No practice areas found',
            'not_found_in_trash' => 'No practice areas found in trash',
            'menu_name'          => 'Practice Areas',
        ];

        $args = [
            'labels'       => $labels,
            'public'       => true,
            'has_archive'  => true,
            'show_in_rest' => true,
            'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
            'rewrite'      => [ 'slug' => 'practice-areas' ],
            'menu_icon'    => 'dashicons-hammer',
        ];

        register_post_type( 'practice_area', $args );
    }

    private function register_case_result(): void {
        $labels = [
            'name'               => 'Case Results',
            'singular_name'      => 'Case Result',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New Case Result',
            'edit_item'          => 'Edit Case Result',
            'new_item'           => 'New Case Result',
            'view_item'          => 'View Case Result',
            'search_items'       => 'Search Case Results',
            'not_found'          => 'No case results found',
            'not_found_in_trash' => 'No case results found in trash',
            'menu_name'          => 'Case Results',
        ];

        $args = [
            'labels'       => $labels,
            'public'       => true,
            'has_archive'  => true,
            'show_in_rest' => true,
            'supports'     => [ 'title', 'editor', 'thumbnail' ],
            'rewrite'      => [ 'slug' => 'case-results' ],
            'menu_icon'    => 'dashicons-awards',
        ];

        register_post_type( 'case_result', $args );
    }
}