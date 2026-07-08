<?php
/**
 * Helper functions for the law firm content model.
 *
 * @package MeanPugLawFirmCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Normalizes a meta value into an array of post IDs.
 *
 * @param mixed $value Raw meta value.
 * @return array
 */
function mp_law_firm_core_normalize_id_array( $value ) {
	if ( empty( $value ) ) {
		return array();
	}

	if ( is_string( $value ) ) {
		$value = array_filter( array_map( 'trim', explode( ',', $value ) ) );
	}

	if ( ! is_array( $value ) ) {
		return array();
	}

	return array_values(
		array_filter(
			array_map( 'absint', $value )
		)
	);
}

/**
 * Gets related post IDs from a relationship meta field.
 *
 * @param int    $post_id  Post ID.
 * @param string $meta_key Relationship meta key.
 * @return array
 */
function mp_law_firm_core_get_related_ids( $post_id, $meta_key ) {
	$post_id = absint( $post_id );

	if ( ! $post_id || empty( $meta_key ) ) {
		return array();
	}

	return mp_law_firm_core_normalize_id_array( get_post_meta( $post_id, $meta_key, true ) );
}

/**
 * Gets related posts from a relationship meta field.
 *
 * @param int          $post_id   Post ID.
 * @param string       $meta_key  Relationship meta key.
 * @param string|array $post_type Optional post type filter.
 * @return array
 */
function mp_law_firm_core_get_related_posts( $post_id, $meta_key, $post_type = 'any' ) {
	$related_ids = mp_law_firm_core_get_related_ids( $post_id, $meta_key );

	if ( empty( $related_ids ) ) {
		return array();
	}

	return get_posts(
		array(
			'post_type'      => $post_type,
			'post__in'       => $related_ids,
			'orderby'        => 'post__in',
			'posts_per_page' => -1,
		)
	);
}

/**
 * Gets practice areas related to an attorney.
 *
 * @param int $attorney_id Attorney post ID.
 * @return array
 */
function mp_law_firm_core_get_attorney_practice_areas( $attorney_id ) {
	return mp_law_firm_core_get_related_posts(
		$attorney_id,
		'_mp_related_practice_areas',
		'practice-area'
	);
}

/**
 * Gets attorneys related to a practice area.
 *
 * @param int $practice_area_id Practice area post ID.
 * @return array
 */
function mp_law_firm_core_get_practice_area_attorneys( $practice_area_id ) {
	return mp_law_firm_core_get_related_posts(
		$practice_area_id,
		'_mp_related_attorneys',
		'attorney'
	);
}

/**
 * Gets FAQs related to a practice area.
 *
 * @param int $practice_area_id Practice area post ID.
 * @return array
 */
function mp_law_firm_core_get_practice_area_faqs( $practice_area_id ) {
	return mp_law_firm_core_get_related_posts(
		$practice_area_id,
		'_mp_related_faqs',
		'faq'
	);
}

/**
 * Builds a structured address array for a location.
 *
 * @param int $location_id Location post ID.
 * @return array
 */
function mp_law_firm_core_get_location_address( $location_id ) {
	$location_id = absint( $location_id );

	if ( ! $location_id ) {
		return array();
	}

	return array(
		'street' => get_post_meta( $location_id, '_mp_location_street', true ),
		'city'   => get_post_meta( $location_id, '_mp_location_city', true ),
		'state'  => get_post_meta( $location_id, '_mp_location_state', true ),
		'zip'    => get_post_meta( $location_id, '_mp_location_zip', true ),
		'phone'  => get_post_meta( $location_id, '_mp_location_phone', true ),
	);
}

/**
 * Builds a schema-ready PostalAddress array for a location.
 *
 * @param int $location_id Location post ID.
 * @return array
 */
function mp_law_firm_core_get_location_schema_address( $location_id ) {
	$address = mp_law_firm_core_get_location_address( $location_id );

	if ( empty( $address ) ) {
		return array();
	}

	return array(
		'@type'           => 'PostalAddress',
		'streetAddress'   => $address['street'],
		'addressLocality' => $address['city'],
		'addressRegion'   => $address['state'],
		'postalCode'      => $address['zip'],
	);
}

/**
 * Gets coordinates for a location.
 *
 * @param int $location_id Location post ID.
 * @return array
 */
function mp_law_firm_core_get_location_coordinates( $location_id ) {
	$latitude  = get_post_meta( $location_id, '_mp_location_latitude', true );
	$longitude = get_post_meta( $location_id, '_mp_location_longitude', true );

	if ( '' === $latitude || '' === $longitude ) {
		return array();
	}

	return array(
		'latitude'  => (float) $latitude,
		'longitude' => (float) $longitude,
	);
}

/**
 * Gets a formatted case result label.
 *
 * @param int $case_result_id Case result post ID.
 * @return string
 */
function mp_law_firm_core_get_case_result_display_label( $case_result_id ) {
	$amount = get_post_meta( $case_result_id, '_mp_case_result_amount', true );
	$label  = get_post_meta( $case_result_id, '_mp_case_result_label', true );

	if ( $amount && $label ) {
		return sprintf(
			'%1$s %2$s',
			esc_html( $amount ),
			esc_html( $label )
		);
	}

	if ( $amount ) {
		return esc_html( $amount );
	}

	if ( $label ) {
		return esc_html( $label );
	}

	return '';
}

/**
 * Queries practice areas ordered by custom priority.
 *
 * @param int $limit Number of items to return.
 * @return array
 */
function mp_law_firm_core_get_featured_practice_areas( $limit = 6 ) {
	return get_posts(
		array(
			'post_type'      => 'practice-area',
			'posts_per_page' => absint( $limit ),
			'meta_key'       => '_mp_practice_priority',
			'orderby'        => array(
				'meta_value_num' => 'ASC',
				'title'          => 'ASC',
			),
			'order'          => 'ASC',
		)
	);
}