<?php
declare( strict_types=1 );

namespace MeanPug\CustomSchema;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Rest_API {

    private const NAMESPACE = 'meanpug/v1';

    public function register_routes(): void {
        register_rest_route(
            self::NAMESPACE,
            '/attorneys',
            [
                'methods'             => \WP_REST_Server::READABLE,
                'callback'            => [ $this, 'get_attorneys' ],
                'permission_callback' => '__return_true',
            ]
        );

        register_rest_route(
            self::NAMESPACE,
            '/practice-areas',
            [
                'methods'             => \WP_REST_Server::READABLE,
                'callback'            => [ $this, 'get_practice_areas' ],
                'permission_callback' => '__return_true',
            ]
        );

        register_rest_route(
            self::NAMESPACE,
            '/case-results',
            [
                'methods'             => \WP_REST_Server::READABLE,
                'callback'            => [ $this, 'get_case_results' ],
                'permission_callback' => '__return_true',
                'args'                => [
                    'practice_area_type' => [
                        'required'          => false,
                        'sanitize_callback' => 'sanitize_text_field',
                    ],
                ],
            ]
        );
    }

    public function get_attorneys( \WP_REST_Request $request ): \WP_REST_Response {
        $posts = get_posts( [
            'post_type'      => 'attorney',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ] );

        $data = array_map( [ $this, 'format_attorney' ], $posts );

        return new \WP_REST_Response( $data, 200 );
    }

    public function get_practice_areas( \WP_REST_Request $request ): \WP_REST_Response {
        $posts = get_posts( [
            'post_type'      => 'practice_area',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ] );

        $data = array_map( [ $this, 'format_practice_area' ], $posts );

        return new \WP_REST_Response( $data, 200 );
    }

    public function get_case_results( \WP_REST_Request $request ): \WP_REST_Response {
        $args = [
            'post_type'      => 'case_result',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ];

        $practice_area_type = $request->get_param( 'practice_area_type' );

        if ( ! empty( $practice_area_type ) ) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'practice_area_type',
                    'field'    => 'slug',
                    'terms'    => $practice_area_type,
                ],
            ];
        }

        $posts = get_posts( $args );
        $data  = array_map( [ $this, 'format_case_result' ], $posts );

        return new \WP_REST_Response( $data, 200 );
    }

    private function format_attorney( \WP_Post $post ): array {
        return [
            'id'               => $post->ID,
            'name'             => $post->post_title,
            'slug'             => $post->post_name,
            'bio'              => wp_strip_all_tags( $post->post_content ),
            'designation'      => get_post_meta( $post->ID, '_attorney_designation', true ),
            'bar_year'         => get_post_meta( $post->ID, '_attorney_bar_year', true ),
            'law_school'       => get_post_meta( $post->ID, '_attorney_law_school', true ),
            'graduation_year'  => get_post_meta( $post->ID, '_attorney_graduation_year', true ),
            'phone'            => get_post_meta( $post->ID, '_attorney_phone', true ),
            'email'            => get_post_meta( $post->ID, '_attorney_email', true ),
            'linkedin'         => get_post_meta( $post->ID, '_attorney_linkedin', true ),
            'years_experience' => get_post_meta( $post->ID, '_attorney_years_experience', true ),
            'state_bars'       => wp_get_post_terms( $post->ID, 'state_bar', [ 'fields' => 'names' ] ),
            'practice_areas'   => wp_get_post_terms( $post->ID, 'practice_area_type', [ 'fields' => 'names' ] ),
        ];
    }

    private function format_practice_area( \WP_Post $post ): array {
        return [
            'id'                => $post->ID,
            'title'             => $post->post_title,
            'slug'              => $post->post_name,
            'description'       => wp_strip_all_tags( $post->post_content ),
            'summary'           => get_post_meta( $post->ID, '_practice_area_summary', true ),
            'icon'              => get_post_meta( $post->ID, '_practice_area_icon', true ),
            'free_consultation' => get_post_meta( $post->ID, '_practice_area_free_consultation', true ),
            'types'             => wp_get_post_terms( $post->ID, 'practice_area_type', [ 'fields' => 'names' ] ),
        ];
    }

    private function format_case_result( \WP_Post $post ): array {
        return [
            'id'           => $post->ID,
            'title'        => $post->post_title,
            'slug'         => $post->post_name,
            'description'  => wp_strip_all_tags( $post->post_content ),
            'amount'       => get_post_meta( $post->ID, '_case_result_amount', true ),
            'case_type'    => get_post_meta( $post->ID, '_case_result_case_type', true ),
            'court'        => get_post_meta( $post->ID, '_case_result_court', true ),
            'year'         => get_post_meta( $post->ID, '_case_result_year', true ),
            'is_featured'  => get_post_meta( $post->ID, '_case_result_is_featured', true ),
            'practice_areas' => wp_get_post_terms( $post->ID, 'practice_area_type', [ 'fields' => 'names' ] ),
        ];
    }
}