<?php
/**
 * Registers native post meta fields for the law firm content model.
 *
 * These fields define the data structure independently from any UI plugin.
 *
 * @package MeanPugLawFirmCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sanitizes an array of post IDs.
 *
 * @param mixed $value Meta value.
 * @return array
 */
function mp_law_firm_core_sanitize_id_array( $value ) {
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
 * Sanitizes a numeric meta value.
 *
 * @param mixed $value Meta value.
 * @return float
 */
function mp_law_firm_core_sanitize_number( $value ) {
	return is_numeric( $value ) ? (float) $value : 0;
}

/**
 * Builds standard meta registration args.
 *
 * @param string   $type              Meta type.
 * @param callable $sanitize_callback Sanitization callback.
 * @param mixed    $default           Default value.
 * @param array    $rest_schema       Optional REST schema override.
 * @return array
 */
function mp_law_firm_core_get_meta_args( $type = 'string', $sanitize_callback = 'sanitize_text_field', $default = '', $rest_schema = array() ) {
	$args = array(
		'single'            => true,
		'type'              => $type,
		'sanitize_callback' => $sanitize_callback,
		'auth_callback'     => function () {
			return current_user_can( 'edit_posts' );
		},
		'default'           => $default,
		'show_in_rest'      => true,
	);

	if ( ! empty( $rest_schema ) ) {
		$args['show_in_rest'] = array(
			'schema' => $rest_schema,
		);
	}

	return $args;
}

/**
 * Registers law firm post meta fields.
 *
 * @return void
 */
function mp_law_firm_core_register_post_meta_fields() {
	$id_array_schema = array(
		'type'    => 'array',
		'items'   => array(
			'type' => 'integer',
		),
		'default' => array(),
	);

	$meta_fields = array(
		'attorney'      => array(
			'_mp_attorney_title'         => mp_law_firm_core_get_meta_args(),
			'_mp_attorney_email'         => mp_law_firm_core_get_meta_args( 'string', 'sanitize_email' ),
			'_mp_attorney_phone'         => mp_law_firm_core_get_meta_args(),
			'_mp_attorney_bar_admissions' => mp_law_firm_core_get_meta_args(),
			'_mp_attorney_education'     => mp_law_firm_core_get_meta_args(),
			'_mp_related_practice_areas' => mp_law_firm_core_get_meta_args( 'array', 'mp_law_firm_core_sanitize_id_array', array(), $id_array_schema ),
		),
		'practice-area' => array(
			'_mp_practice_headline'      => mp_law_firm_core_get_meta_args(),
			'_mp_practice_priority'      => mp_law_firm_core_get_meta_args( 'number', 'mp_law_firm_core_sanitize_number', 0 ),
			'_mp_related_attorneys'      => mp_law_firm_core_get_meta_args( 'array', 'mp_law_firm_core_sanitize_id_array', array(), $id_array_schema ),
			'_mp_related_faqs'           => mp_law_firm_core_get_meta_args( 'array', 'mp_law_firm_core_sanitize_id_array', array(), $id_array_schema ),
		),
		'case-result'   => array(
			'_mp_case_result_amount'     => mp_law_firm_core_get_meta_args(),
			'_mp_case_result_label'      => mp_law_firm_core_get_meta_args(),
			'_mp_case_result_summary'    => mp_law_firm_core_get_meta_args( 'string', 'wp_kses_post' ),
			'_mp_related_practice_areas' => mp_law_firm_core_get_meta_args( 'array', 'mp_law_firm_core_sanitize_id_array', array(), $id_array_schema ),
		),
		'testimonials'  => array(
			'_mp_testimonial_author_name'  => mp_law_firm_core_get_meta_args(),
			'_mp_testimonial_author_title' => mp_law_firm_core_get_meta_args(),
			'_mp_testimonial_source'       => mp_law_firm_core_get_meta_args(),
			'_mp_related_practice_areas'   => mp_law_firm_core_get_meta_args( 'array', 'mp_law_firm_core_sanitize_id_array', array(), $id_array_schema ),
		),
		'office'        => array(
			'_mp_location_street'    => mp_law_firm_core_get_meta_args(),
			'_mp_location_city'      => mp_law_firm_core_get_meta_args(),
			'_mp_location_state'     => mp_law_firm_core_get_meta_args(),
			'_mp_location_zip'       => mp_law_firm_core_get_meta_args(),
			'_mp_location_phone'     => mp_law_firm_core_get_meta_args(),
			'_mp_location_latitude'  => mp_law_firm_core_get_meta_args( 'number', 'mp_law_firm_core_sanitize_number', 0 ),
			'_mp_location_longitude' => mp_law_firm_core_get_meta_args( 'number', 'mp_law_firm_core_sanitize_number', 0 ),
		),
		'faq'           => array(
			'_mp_faq_answer'              => mp_law_firm_core_get_meta_args( 'string', 'wp_kses_post' ),
			'_mp_related_practice_areas'  => mp_law_firm_core_get_meta_args( 'array', 'mp_law_firm_core_sanitize_id_array', array(), $id_array_schema ),
		),
	);

	foreach ( $meta_fields as $post_type => $fields ) {
		foreach ( $fields as $meta_key => $args ) {
			register_post_meta( $post_type, $meta_key, $args );
		}
	}
}
add_action( 'init', 'mp_law_firm_core_register_post_meta_fields' );