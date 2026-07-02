<?php
/**
 * Query Helpers
 *
 * Provides two layers:
 *   1. Generic ACF reverse-query primitives (existing).
 *   2. Named helpers that express the specific law firm relationships.
 *
 * Template authors should use the named helpers — they hide the ACF field name
 * and apply sensible defaults (post_status, orderby, number limits).
 * The generic primitives remain available for one-off queries.
 *
 * @package inf
 */

/**
 * Returns all CPT posts whose ACF post_object field points to $post_id.
 */
function mp_reverse_acf_post_object_query( $dest_post_type, $acf_post_obj_field, $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();

    return get_posts( array(
        'post_type'   => $dest_post_type,
        'meta_key'    => $acf_post_obj_field,
        'meta_value'  => $post_id,
        'post_status' => 'publish',
        'numberposts' => -1,
    ) );
}

/**
 * Returns all CPT posts whose ACF relationship field includes $post_id.
 */
function mp_reverse_acf_relationship_query( $dest_post_type, $acf_relationship_field, $post_id = null ) {
    $post_id = $post_id ?: get_the_ID();

    return get_posts( array(
        'post_type'   => $dest_post_type,
        'post_status' => 'publish',
        'numberposts' => -1,
        'meta_query'  => array(
            array(
                'key'     => $acf_relationship_field,
                'value'   => '"' . $post_id . '"',
                'compare' => 'LIKE',
            ),
        ),
    ) );
}

// ─── Named helpers ─────────────────────────────────────────────────────────────
// These express the law firm domain relationships clearly. Template authors
// call these — they never need to know underlying ACF field names.

/**
 * Returns attorneys linked to a given practice area.
 *
 * @param int|null $practice_area_id  Defaults to current post.
 * @return WP_Post[]
 */
function inf_get_attorneys_for_practice_area( ?int $practice_area_id = null ): array {
    return mp_reverse_acf_relationship_query( 'attorney', 'practice_areas', $practice_area_id );
}

/**
 * Returns case results linked to a given practice area.
 *
 * @param int|null $practice_area_id  Defaults to current post.
 * @param bool     $featured_only     If true, only return featured results.
 * @return WP_Post[]
 */
function inf_get_case_results_for_practice_area( ?int $practice_area_id = null, bool $featured_only = false ): array {
    $practice_area_id = $practice_area_id ?: get_the_ID();

    $args = array(
        'post_type'   => 'case-result',
        'post_status' => 'publish',
        'numberposts' => -1,
        'meta_query'  => array(
            array(
                'key'     => 'practice_area',
                'value'   => $practice_area_id,
                'compare' => '=',
            ),
        ),
    );

    if ( $featured_only ) {
        $args['meta_query'][] = array(
            'key'   => 'is_featured',
            'value' => '1',
        );
        $args['meta_query']['relation'] = 'AND';
    }

    return get_posts( $args );
}

/**
 * Returns FAQs linked to a given practice area.
 *
 * @param int|null $practice_area_id  Defaults to current post.
 * @return WP_Post[]
 */
function inf_get_faqs_for_practice_area( ?int $practice_area_id = null ): array {
    return mp_reverse_acf_relationship_query( 'faq', 'practice_areas', $practice_area_id );
}

/**
 * Returns attorneys based at a given office.
 *
 * @param int|null $office_id  Defaults to current post.
 * @return WP_Post[]
 */
function inf_get_attorneys_for_office( ?int $office_id = null ): array {
    return mp_reverse_acf_relationship_query( 'attorney', 'offices', $office_id );
}

/**
 * Returns active career listings, optionally filtered by office.
 *
 * "Active" means: published AND (no closing_date OR closing_date >= today).
 *
 * @param int|null $office_id  If set, only returns listings for that office.
 * @return WP_Post[]
 */
function inf_get_active_careers( ?int $office_id = null ): array {
    $today = gmdate( 'Y-m-d' );

    $args = array(
        'post_type'   => 'career',
        'post_status' => 'publish',
        'numberposts' => -1,
        'orderby'     => 'date',
        'order'       => 'DESC',
        'meta_query'  => array(
            'relation' => 'OR',
            array(
                'key'     => 'closing_date',
                'compare' => 'NOT EXISTS',
            ),
            array(
                'key'     => 'closing_date',
                'value'   => $today,
                'compare' => '>=',
                'type'    => 'DATE',
            ),
        ),
    );

    if ( $office_id ) {
        $args['meta_query'] = array(
            'relation' => 'AND',
            $args['meta_query'],
            array(
                'key'   => 'office',
                'value' => $office_id,
            ),
        );
    }

    return get_posts( $args );
}

