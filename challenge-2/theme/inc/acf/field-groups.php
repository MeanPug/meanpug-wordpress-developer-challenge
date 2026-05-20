<?php
/**
 * PHP-defined ACF field groups for the PugPuggle CPTs.
 *
 * Shipped in PHP (rather than only as JSON exports) so the demo content
 * seeder and Schema layer can rely on a known field structure with zero
 * manual setup by a reviewer.
 *
 * Loaded from functions.php; guarded by `function_exists('acf_add_local_field_group')`.
 *
 * @package PugPuggle
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

add_action( 'acf/init', 'pugpuggle_register_acf_field_groups' );

if ( ! function_exists( 'pugpuggle_register_acf_field_groups' ) ) :

	/**
	 * Register every field group needed by the PugPuggle CPTs.
	 *
	 * @return void
	 */
	function pugpuggle_register_acf_field_groups() {

		// -------------------------------------------------------------------
		// Attorney
		// -------------------------------------------------------------------
		acf_add_local_field_group(
			[
				'key'    => 'group_pp_attorney',
				'title'  => __( 'Attorney Profile', 'inf' ),
				'fields' => [
					[
						'key'   => 'field_pp_attorney_position',
						'label' => __( 'Position / Title', 'inf' ),
						'name'  => 'position',
						'type'  => 'text',
					],
					[
						'key'   => 'field_pp_attorney_role',
						'label' => __( 'Role', 'inf' ),
						'name'  => 'role',
						'type'  => 'text',
					],
					[
						'key'   => 'field_pp_attorney_phone',
						'label' => __( 'Phone', 'inf' ),
						'name'  => 'phone',
						'type'  => 'text',
					],
					[
						'key'   => 'field_pp_attorney_email',
						'label' => __( 'Email', 'inf' ),
						'name'  => 'email',
						'type'  => 'email',
					],
					[
						'key'   => 'field_pp_attorney_linkedin',
						'label' => __( 'LinkedIn URL', 'inf' ),
						'name'  => 'linkedin_url',
						'type'  => 'url',
					],
					[
						'key'   => 'field_pp_attorney_featured_quote',
						'label' => __( 'Featured Quote', 'inf' ),
						'name'  => 'featured_quote',
						'type'  => 'textarea',
						'rows'  => 3,
					],
					[
						'key'   => 'field_pp_attorney_education',
						'label' => __( 'Education', 'inf' ),
						'name'  => 'education',
						'type'  => 'textarea',
						'rows'  => 3,
					],
					[
						'key'   => 'field_pp_attorney_bar_admissions',
						'label' => __( 'Bar Admissions', 'inf' ),
						'name'  => 'bar_admissions',
						'type'  => 'textarea',
						'rows'  => 3,
					],
				],
				'location' => [
					[
						[
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'attorney',
						],
					],
				],
			]
		);

		// -------------------------------------------------------------------
		// Office
		// -------------------------------------------------------------------
		acf_add_local_field_group(
			[
				'key'    => 'group_pp_office',
				'title'  => __( 'Office Details', 'inf' ),
				'fields' => [
					[
						'key'        => 'field_pp_office_address',
						'label'      => __( 'Address', 'inf' ),
						'name'       => 'address',
						'type'       => 'group',
						'sub_fields' => [
							[
								'key'   => 'field_pp_office_street',
								'label' => __( 'Street', 'inf' ),
								'name'  => 'street',
								'type'  => 'text',
							],
							[
								'key'   => 'field_pp_office_city',
								'label' => __( 'City', 'inf' ),
								'name'  => 'city',
								'type'  => 'text',
							],
							[
								'key'   => 'field_pp_office_state',
								'label' => __( 'State', 'inf' ),
								'name'  => 'state',
								'type'  => 'text',
							],
							[
								'key'   => 'field_pp_office_zip',
								'label' => __( 'ZIP', 'inf' ),
								'name'  => 'zip',
								'type'  => 'text',
							],
						],
					],
					[
						'key'   => 'field_pp_office_city_top',
						'label' => __( 'City (denormalised for admin column)', 'inf' ),
						'name'  => 'city',
						'type'  => 'text',
					],
					[
						'key'   => 'field_pp_office_state_top',
						'label' => __( 'State (denormalised)', 'inf' ),
						'name'  => 'state',
						'type'  => 'text',
					],
					[
						'key'   => 'field_pp_office_phone',
						'label' => __( 'Phone', 'inf' ),
						'name'  => 'phone',
						'type'  => 'text',
					],
					[
						'key'   => 'field_pp_office_email',
						'label' => __( 'Email', 'inf' ),
						'name'  => 'email',
						'type'  => 'email',
					],
					[
						'key'        => 'field_pp_office_geopoint',
						'label'      => __( 'Geopoint', 'inf' ),
						'name'       => 'geopoint',
						'type'       => 'group',
						'sub_fields' => [
							[
								'key'   => 'field_pp_office_lat',
								'label' => __( 'Latitude', 'inf' ),
								'name'  => 'lat',
								'type'  => 'number',
							],
							[
								'key'   => 'field_pp_office_lng',
								'label' => __( 'Longitude', 'inf' ),
								'name'  => 'lng',
								'type'  => 'number',
							],
						],
					],
					[
						'key'   => 'field_pp_office_latitude',
						'label' => __( 'Latitude (legacy)', 'inf' ),
						'name'  => 'latitude',
						'type'  => 'number',
					],
					[
						'key'   => 'field_pp_office_longitude',
						'label' => __( 'Longitude (legacy)', 'inf' ),
						'name'  => 'longitude',
						'type'  => 'number',
					],
					[
						'key'        => 'field_pp_office_hours',
						'label'      => __( 'Hours', 'inf' ),
						'name'       => 'hours',
						'type'       => 'repeater',
						'button_label' => __( 'Add row', 'inf' ),
						'sub_fields' => [
							[
								'key'     => 'field_pp_office_hours_day',
								'label'   => __( 'Day', 'inf' ),
								'name'    => 'day',
								'type'    => 'select',
								'choices' => [
									'Monday'    => __( 'Monday', 'inf' ),
									'Tuesday'   => __( 'Tuesday', 'inf' ),
									'Wednesday' => __( 'Wednesday', 'inf' ),
									'Thursday'  => __( 'Thursday', 'inf' ),
									'Friday'    => __( 'Friday', 'inf' ),
									'Saturday'  => __( 'Saturday', 'inf' ),
									'Sunday'    => __( 'Sunday', 'inf' ),
								],
							],
							[
								'key'   => 'field_pp_office_hours_open',
								'label' => __( 'Opens', 'inf' ),
								'name'  => 'open',
								'type'  => 'text',
								'placeholder' => '09:00',
							],
							[
								'key'   => 'field_pp_office_hours_close',
								'label' => __( 'Closes', 'inf' ),
								'name'  => 'close',
								'type'  => 'text',
								'placeholder' => '17:00',
							],
						],
					],
				],
				'location' => [
					[
						[
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'office',
						],
					],
				],
			]
		);

		// -------------------------------------------------------------------
		// Case Result
		// -------------------------------------------------------------------
		acf_add_local_field_group(
			[
				'key'    => 'group_pp_case_result',
				'title'  => __( 'Case Result', 'inf' ),
				'fields' => [
					[
						'key'   => 'field_pp_cr_amount',
						'label' => __( 'Amount (display)', 'inf' ),
						'name'  => 'amount_display',
						'type'  => 'text',
						'placeholder' => '$1.2M',
					],
					[
						'key'     => 'field_pp_cr_result_type',
						'label'   => __( 'Result Type', 'inf' ),
						'name'    => 'result_type',
						'type'    => 'select',
						'choices' => [
							'Settlement' => __( 'Settlement', 'inf' ),
							'Verdict'    => __( 'Verdict', 'inf' ),
							'Award'      => __( 'Award', 'inf' ),
						],
					],
					[
						'key'   => 'field_pp_cr_year',
						'label' => __( 'Case Year', 'inf' ),
						'name'  => 'case_year',
						'type'  => 'number',
					],
					[
						'key'   => 'field_pp_cr_outcome',
						'label' => __( 'Outcome Summary', 'inf' ),
						'name'  => 'outcome_summary',
						'type'  => 'textarea',
						'rows'  => 3,
					],
					[
						'key'           => 'field_pp_cr_lead_attorney',
						'label'         => __( 'Lead Attorney', 'inf' ),
						'name'          => 'lead_attorney',
						'type'          => 'post_object',
						'post_type'     => [ 'attorney' ],
						'return_format' => 'id',
					],
					[
						'key'           => 'field_pp_cr_practice_area',
						'label'         => __( 'Practice Area', 'inf' ),
						'name'          => 'practice_area',
						'type'          => 'post_object',
						'post_type'     => [ 'practice-area' ],
						'return_format' => 'id',
					],
				],
				'location' => [
					[
						[
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'case-result',
						],
					],
				],
			]
		);

		// -------------------------------------------------------------------
		// Testimonial
		// -------------------------------------------------------------------
		acf_add_local_field_group(
			[
				'key'    => 'group_pp_testimonial',
				'title'  => __( 'Testimonial', 'inf' ),
				'fields' => [
					[
						'key'     => 'field_pp_testimonial_rating',
						'label'   => __( 'Rating', 'inf' ),
						'name'    => 'rating',
						'type'    => 'number',
						'min'     => 1,
						'max'     => 5,
						'default_value' => 5,
					],
					[
						'key'        => 'field_pp_testimonial_reviewer',
						'label'      => __( 'Reviewer', 'inf' ),
						'name'       => 'reviewer',
						'type'       => 'group',
						'sub_fields' => [
							[
								'key'   => 'field_pp_reviewer_name',
								'label' => __( 'Name', 'inf' ),
								'name'  => 'name',
								'type'  => 'text',
							],
							[
								'key'   => 'field_pp_reviewer_location',
								'label' => __( 'Location', 'inf' ),
								'name'  => 'location',
								'type'  => 'text',
							],
						],
					],
				],
				'location' => [
					[
						[
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'testimonials',
						],
					],
				],
			]
		);

		// -------------------------------------------------------------------
		// Practice Area
		// -------------------------------------------------------------------
		acf_add_local_field_group(
			[
				'key'    => 'group_pp_practice_area',
				'title'  => __( 'Practice Area', 'inf' ),
				'fields' => [
					[
						'key'   => 'field_pp_pa_featured_quote',
						'label' => __( 'Featured Quote', 'inf' ),
						'name'  => 'featured_quote',
						'type'  => 'textarea',
						'rows'  => 3,
					],
					[
						'key'   => 'field_pp_pa_overview',
						'label' => __( 'Overview Content', 'inf' ),
						'name'  => 'overview_content',
						'type'  => 'wysiwyg',
					],
				],
				'location' => [
					[
						[
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'practice-area',
						],
					],
				],
			]
		);
	}

endif;
