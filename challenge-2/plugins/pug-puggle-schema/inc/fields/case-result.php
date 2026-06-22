<?php
/**
 * Case Result field group.
 *
 * The numbers that build trust: the award amount, whether it was a verdict or a
 * settlement, the year, and which practice area it belongs to.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the case-result fields.
 *
 * @return void
 */
function pps_register_case_result_fields() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_pps_case_result',
			'title'    => __( 'Case Result Details', 'pug-puggle-schema' ),
			'fields'   => array(
				array(
					'key'          => 'field_pps_cr_amount',
					'label'        => __( 'Amount', 'pug-puggle-schema' ),
					'name'         => 'amount',
					'type'         => 'text',
					'instructions' => __( 'Display value, e.g. "$4.2M".', 'pug-puggle-schema' ),
					'wrapper'      => array( 'width' => '40' ),
				),
				array(
					'key'           => 'field_pps_cr_result_type',
					'label'         => __( 'Result Type', 'pug-puggle-schema' ),
					'name'          => 'result_type',
					'type'          => 'select',
					'choices'       => array(
						'Verdict'    => __( 'Verdict', 'pug-puggle-schema' ),
						'Settlement' => __( 'Settlement', 'pug-puggle-schema' ),
					),
					'default_value' => 'Settlement',
					'return_format' => 'value',
					'wrapper'       => array( 'width' => '30' ),
				),
				array(
					'key'     => 'field_pps_cr_year',
					'label'   => __( 'Year', 'pug-puggle-schema' ),
					'name'    => 'year',
					'type'    => 'number',
					'min'     => 1950,
					'max'     => 2100,
					'wrapper' => array( 'width' => '30' ),
				),
				array(
					'key'           => 'field_pps_cr_practice_area',
					'label'         => __( 'Practice Area', 'pug-puggle-schema' ),
					'name'          => 'related_practice_area',
					'type'          => 'post_object',
					'post_type'     => array( 'practice-area' ),
					'return_format' => 'object',
					'allow_null'    => 1,
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'case-result',
					),
				),
			),
			'active'   => true,
		)
	);
}
