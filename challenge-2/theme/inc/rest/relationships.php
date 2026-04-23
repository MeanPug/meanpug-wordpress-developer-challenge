<?php
/**
 * REST — relationship fields
 *
 * Many of the cross-links between CPTs are stored as arrays of post IDs
 * in meta (e.g. practice_area.practice_area_attorney_ids). The REST
 * representation is more useful when those IDs are hydrated with a
 * minimal post summary on read. These register_rest_field() calls do
 * that at the /wp-json layer without denormalising storage.
 *
 * @package pnp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function pnp_post_summary( $post_id ) {
	$post = get_post( $post_id );
	if ( ! $post || 'publish' !== $post->post_status ) {
		return null;
	}
	return array(
		'id'        => $post->ID,
		'title'     => get_the_title( $post ),
		'slug'      => $post->post_name,
		'link'      => get_permalink( $post ),
		'type'      => $post->post_type,
		'thumbnail' => get_the_post_thumbnail_url( $post, 'medium' ) ?: null,
	);
}

function pnp_get_id_list( $post_id, $key ) {
	$raw = get_post_meta( $post_id, $key, true );
	if ( empty( $raw ) ) {
		return array();
	}
	// Be lenient with legacy rows (single=false) that may still be in the DB.
	$flat = array();
	foreach ( (array) $raw as $item ) {
		if ( is_array( $item ) ) {
			foreach ( $item as $inner ) {
				$flat[] = (int) $inner;
			}
		} else {
			$flat[] = (int) $item;
		}
	}
	return $flat;
}

function pnp_hydrate_ids( $ids ) {
	if ( empty( $ids ) || ! is_array( $ids ) ) {
		return array();
	}
	return array_values( array_filter( array_map( 'pnp_post_summary', array_map( 'intval', $ids ) ) ) );
}

add_action( 'rest_api_init', function () {
	register_rest_field( 'practice_area', 'related', array(
		'get_callback' => function ( $obj ) {
			return array(
				'attorneys' => pnp_hydrate_ids( pnp_get_id_list( $obj['id'], 'practice_area_attorney_ids' ) ),
				'faqs'      => pnp_hydrate_ids( pnp_get_id_list( $obj['id'], 'practice_area_faq_ids' ) ),
			);
		},
		'schema' => array(
			'description' => __( 'Hydrated related posts (attorneys, FAQs).', 'pnp' ),
			'type'        => 'object',
		),
	) );

	register_rest_field( 'attorney', 'related', array(
		'get_callback' => function ( $obj ) {
			return array(
				'offices' => pnp_hydrate_ids( pnp_get_id_list( $obj['id'], 'attorney_office_ids' ) ),
			);
		},
		'schema' => array(
			'description' => __( 'Hydrated related posts (offices).', 'pnp' ),
			'type'        => 'object',
		),
	) );

	register_rest_field( 'case_result', 'related', array(
		'get_callback' => function ( $obj ) {
			return array(
				'attorneys'      => pnp_hydrate_ids( pnp_get_id_list( $obj['id'], 'case_result_attorney_ids' ) ),
				'practice_areas' => pnp_hydrate_ids( pnp_get_id_list( $obj['id'], 'case_result_practice_area_ids' ) ),
			);
		},
		'schema' => array(
			'description' => __( 'Hydrated related posts.', 'pnp' ),
			'type'        => 'object',
		),
	) );

	register_rest_field( 'case_result', 'amount_formatted', array(
		'get_callback' => function ( $obj ) {
			$cents = (int) get_post_meta( $obj['id'], 'case_result_amount_cents', true );
			$label = get_post_meta( $obj['id'], 'case_result_amount_label', true );
			if ( $label ) {
				return $label;
			}
			if ( ! $cents ) {
				return null;
			}
			return '$' . number_format( $cents / 100, 0 );
		},
		'schema' => array(
			'description' => __( 'Human-readable case-result amount.', 'pnp' ),
			'type'        => 'string',
		),
	) );
} );
