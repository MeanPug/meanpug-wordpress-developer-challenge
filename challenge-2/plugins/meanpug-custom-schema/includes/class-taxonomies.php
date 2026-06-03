<?php
declare( strict_types=1 );

namespace MeanPug\CustomSchema;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Taxonomies {

    public function register(): void {
        $this->register_practice_area_type();
        $this->register_state_bar();
    }

    private function register_practice_area_type(): void {
        $labels = [
            'name'              => 'Practice Area Types',
            'singular_name'     => 'Practice Area Type',
            'search_items'      => 'Search Practice Area Types',
            'all_items'         => 'All Practice Area Types',
            'parent_item'       => 'Parent Practice Area Type',
            'parent_item_colon' => 'Parent Practice Area Type:',
            'edit_item'         => 'Edit Practice Area Type',
            'update_item'       => 'Update Practice Area Type',
            'add_new_item'      => 'Add New Practice Area Type',
            'new_item_name'     => 'New Practice Area Type Name',
            'menu_name'         => 'Practice Area Types',
        ];

        $args = [
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_in_rest'      => true,
            'rewrite'           => [ 'slug' => 'practice-area-type' ],
        ];

        register_taxonomy( 'practice_area_type', [ 'practice_area', 'attorney', 'case_result' ], $args );
    }

    private function register_state_bar(): void {
        $labels = [
            'name'                       => 'State Bars',
            'singular_name'              => 'State Bar',
            'search_items'               => 'Search State Bars',
            'all_items'                  => 'All State Bars',
            'edit_item'                  => 'Edit State Bar',
            'update_item'                => 'Update State Bar',
            'add_new_item'               => 'Add New State Bar',
            'new_item_name'              => 'New State Bar Name',
            'menu_name'                  => 'State Bars',
        ];

        $args = [
            'labels'       => $labels,
            'hierarchical' => false,
            'public'       => true,
            'show_in_rest' => true,
            'rewrite'      => [ 'slug' => 'state-bar' ],
        ];

        register_taxonomy( 'state_bar', [ 'attorney' ], $args );
    }
}