<?php
/**
 * Post-meta registrations
 *
 * Uses native register_post_meta so the schema is visible to REST, the
 * block editor, and any SEO / schema plugin that reads post meta. ACF
 * Pro can sit on top of these same keys without conflict — this file
 * guarantees a baseline schema even if ACF isn't installed.
 *
 * Storage model: every key is stored `single => true`. Lists and
 * structures are serialized into a single row as a typed array or
 * object. This avoids the double-wrap REST output you get when
 * `single => false` is combined with a custom array/object rest
 * schema (WP interprets the schema per-row, then wraps rows again).
 *
 * @package pnp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register a single meta key.
 *
 * @param string      $post_type Post type slug.
 * @param string      $key       Meta key.
 * @param string      $type      One of string|integer|number|boolean|array|object.
 * @param array|null  $schema    Optional REST schema (required when type is array/object).
 */
function pnp_register_meta( $post_type, $key, $type = 'string', $schema = null ) {
	$rest = $schema ? array( 'schema' => array_merge( array( 'type' => $type ), $schema ) ) : true;

	register_post_meta( $post_type, $key, array(
		'type'          => $type,
		'single'        => true,
		'show_in_rest'  => $rest,
		'auth_callback' => function () {
			return current_user_can( 'edit_posts' );
		},
	) );
}

add_action( 'init', function () {

	$id_list_schema     = array( 'items' => array( 'type' => 'integer' ) );
	$string_list_schema = array( 'items' => array( 'type' => 'string' ) );

	/* ---------- attorney ---------- */
	pnp_register_meta( 'attorney', 'attorney_title',            'string' );
	pnp_register_meta( 'attorney', 'attorney_email',            'string' );
	pnp_register_meta( 'attorney', 'attorney_phone',            'string' );
	pnp_register_meta( 'attorney', 'attorney_vcard_url',        'string' );
	pnp_register_meta( 'attorney', 'attorney_headshot_tall_id', 'integer' );
	pnp_register_meta( 'attorney', 'attorney_office_ids',       'array', $id_list_schema );
	pnp_register_meta( 'attorney', 'attorney_bar_admissions',   'array', $string_list_schema );
	pnp_register_meta( 'attorney', 'attorney_awards',           'array', $string_list_schema );
	pnp_register_meta( 'attorney', 'attorney_education',        'array', array(
		'items' => array(
			'type'       => 'object',
			'properties' => array(
				'school' => array( 'type' => 'string' ),
				'degree' => array( 'type' => 'string' ),
				'year'   => array( 'type' => 'string' ),
			),
		),
	) );
	pnp_register_meta( 'attorney', 'attorney_social_links',     'object', array(
		'properties' => array(
			'linkedin' => array( 'type' => 'string' ),
			'twitter'  => array( 'type' => 'string' ),
			'avvo'     => array( 'type' => 'string' ),
		),
	) );

	/* ---------- practice_area ---------- */
	pnp_register_meta( 'practice_area', 'practice_area_hero_headline', 'string' );
	pnp_register_meta( 'practice_area', 'practice_area_hero_subhead',  'string' );
	pnp_register_meta( 'practice_area', 'practice_area_cta_label',     'string' );
	pnp_register_meta( 'practice_area', 'practice_area_cta_url',       'string' );
	pnp_register_meta( 'practice_area', 'practice_area_attorney_ids',  'array', $id_list_schema );
	pnp_register_meta( 'practice_area', 'practice_area_faq_ids',       'array', $id_list_schema );
	pnp_register_meta( 'practice_area', 'practice_area_aggregate_rating', 'object', array(
		'properties' => array(
			'rating_value' => array( 'type' => 'number' ),
			'rating_count' => array( 'type' => 'integer' ),
		),
	) );

	/* ---------- case_result ---------- */
	pnp_register_meta( 'case_result', 'case_result_amount_cents',      'integer' );
	pnp_register_meta( 'case_result', 'case_result_amount_label',      'string' );
	pnp_register_meta( 'case_result', 'case_result_year',              'integer' );
	pnp_register_meta( 'case_result', 'case_result_is_featured',       'boolean' );
	pnp_register_meta( 'case_result', 'case_result_attorney_ids',      'array', $id_list_schema );
	pnp_register_meta( 'case_result', 'case_result_practice_area_ids', 'array', $id_list_schema );

	/* ---------- testimonial ---------- */
	pnp_register_meta( 'testimonial', 'testimonial_rating',            'number' );
	pnp_register_meta( 'testimonial', 'testimonial_reviewer_name',     'string' );
	pnp_register_meta( 'testimonial', 'testimonial_reviewer_city',     'string' );
	pnp_register_meta( 'testimonial', 'testimonial_source',            'string' );
	pnp_register_meta( 'testimonial', 'testimonial_source_url',        'string' );
	pnp_register_meta( 'testimonial', 'testimonial_attorney_id',       'integer' );
	pnp_register_meta( 'testimonial', 'testimonial_practice_area_id',  'integer' );

	/* ---------- office ---------- */
	pnp_register_meta( 'office', 'office_street',     'string' );
	pnp_register_meta( 'office', 'office_city',       'string' );
	pnp_register_meta( 'office', 'office_region',     'string' );
	pnp_register_meta( 'office', 'office_postcode',   'string' );
	pnp_register_meta( 'office', 'office_country',    'string' );
	pnp_register_meta( 'office', 'office_phone',      'string' );
	pnp_register_meta( 'office', 'office_fax',        'string' );
	pnp_register_meta( 'office', 'office_email',      'string' );
	pnp_register_meta( 'office', 'office_latitude',   'number' );
	pnp_register_meta( 'office', 'office_longitude',  'number' );
	pnp_register_meta( 'office', 'office_is_primary', 'boolean' );
	pnp_register_meta( 'office', 'office_hours',      'object', array(
		'properties' => array(
			'mon' => array( 'type' => 'string' ),
			'tue' => array( 'type' => 'string' ),
			'wed' => array( 'type' => 'string' ),
			'thu' => array( 'type' => 'string' ),
			'fri' => array( 'type' => 'string' ),
			'sat' => array( 'type' => 'string' ),
			'sun' => array( 'type' => 'string' ),
		),
	) );

	/* ---------- faq ---------- */
	pnp_register_meta( 'faq', 'faq_answer_summary',    'string' );
	pnp_register_meta( 'faq', 'faq_practice_area_ids', 'array', $id_list_schema );
} );
