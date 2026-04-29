<?php

/**
 * Register law firm ACF field groups in code.
 */
function inf_register_law_firm_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'    => 'group_inf_attorney_fields',
			'title'  => 'Attorney Details',
			'fields' => array(
				array(
					'key'   => 'field_inf_attorney_full_name',
					'label' => 'Full Name',
					'name'  => 'attorney_full_name',
					'type'  => 'text',
				),
				array(
					'key'           => 'field_inf_attorney_photo',
					'label'         => 'Professional Photo',
					'name'          => 'attorney_photo',
					'type'          => 'image',
					'return_format' => 'id',
					'preview_size'  => 'medium',
					'library'       => 'all',
				),
				array(
					'key'          => 'field_inf_attorney_bio',
					'label'        => 'Attorney Bio',
					'name'         => 'attorney_bio',
					'type'         => 'wysiwyg',
					'tabs'         => 'all',
					'toolbar'      => 'basic',
					'media_upload' => 0,
				),
				array(
					'key'          => 'field_inf_attorney_years_experience',
					'label'        => 'Years of Experience',
					'name'         => 'attorney_years_experience',
					'type'         => 'number',
					'min'          => 0,
					'max'          => 80,
					'step'         => 1,
					'append'       => 'years',
				),
				array(
					'key'        => 'field_inf_attorney_education',
					'label'      => 'Education',
					'name'       => 'attorney_education',
					'type'       => 'repeater',
					'layout'     => 'row',
					'button_label' => 'Add Education Entry',
					'sub_fields' => array(
						array(
							'key'   => 'field_inf_attorney_education_school',
							'label' => 'Institution',
							'name'  => 'institution',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_inf_attorney_education_degree',
							'label' => 'Degree',
							'name'  => 'degree',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_inf_attorney_education_year',
							'label' => 'Graduation Year',
							'name'  => 'graduation_year',
							'type'  => 'number',
							'min'   => 1900,
							'max'   => 2100,
						),
					),
				),
				array(
					'key'          => 'field_inf_attorney_bar_admissions',
					'label'        => 'Bar Admissions',
					'name'         => 'attorney_bar_admissions',
					'type'         => 'repeater',
					'layout'       => 'table',
					'button_label' => 'Add Bar Admission',
					'sub_fields'   => array(
						array(
							'key'   => 'field_inf_attorney_bar_admission_jurisdiction',
							'label' => 'Jurisdiction',
							'name'  => 'jurisdiction',
							'type'  => 'text',
						),
						array(
							'key'   => 'field_inf_attorney_bar_admission_year',
							'label' => 'Admission Year',
							'name'  => 'admission_year',
							'type'  => 'number',
							'min'   => 1900,
							'max'   => 2100,
						),
					),
				),
				array(
					'key'          => 'field_inf_attorney_related_practice_areas',
					'label'        => 'Related Practice Areas',
					'name'         => 'attorney_related_practice_areas',
					'type'         => 'relationship',
					'post_type'    => array( 'practice_area' ),
					'filters'      => array( 'search' ),
					'return_format'=> 'id',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'attorney',
					),
				),
			),
		)
	);

	acf_add_local_field_group(
		array(
			'key'    => 'group_inf_practice_area_fields',
			'title'  => 'Practice Area Details',
			'fields' => array(
				array(
					'key'   => 'field_inf_practice_area_description',
					'label' => 'Practice Area Description',
					'name'  => 'practice_area_description',
					'type'  => 'wysiwyg',
				),
				array(
					'key'          => 'field_inf_practice_area_related_attorneys',
					'label'        => 'Related Attorneys',
					'name'         => 'practice_area_related_attorneys',
					'type'         => 'relationship',
					'post_type'    => array( 'attorney' ),
					'filters'      => array( 'search' ),
					'return_format'=> 'id',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'practice_area',
					),
				),
			),
		)
	);

	acf_add_local_field_group(
		array(
			'key'    => 'group_inf_case_result_fields',
			'title'  => 'Case Result Details',
			'fields' => array(
				array(
					'key'   => 'field_inf_case_result_settlement_amount',
					'label' => 'Settlement Amount',
					'name'  => 'case_result_settlement_amount',
					'type'  => 'text',
					'instructions' => 'Examples: $2.4M or Confidential Settlement',
				),
				array(
					'key'   => 'field_inf_case_result_summary',
					'label' => 'Case Summary',
					'name'  => 'case_result_summary',
					'type'  => 'textarea',
					'rows'  => 4,
				),
				array(
					'key'          => 'field_inf_case_result_date',
					'label'        => 'Resolution Date',
					'name'         => 'case_result_date',
					'type'         => 'date_picker',
					'display_format' => 'F j, Y',
					'return_format'  => 'Ymd',
					'first_day'      => 1,
				),
				array(
					'key'          => 'field_inf_case_result_related_practice_areas',
					'label'        => 'Related Practice Areas',
					'name'         => 'case_result_related_practice_areas',
					'type'         => 'relationship',
					'post_type'    => array( 'practice_area' ),
					'filters'      => array( 'search' ),
					'return_format'=> 'id',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'case_result',
					),
				),
			),
		)
	);

	acf_add_local_field_group(
		array(
			'key'    => 'group_inf_testimonial_fields',
			'title'  => 'Testimonial Details',
			'fields' => array(
				array(
					'key'   => 'field_inf_testimonial_client_name',
					'label' => 'Client Name',
					'name'  => 'testimonial_client_name',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_inf_testimonial_quote',
					'label' => 'Client Quote',
					'name'  => 'testimonial_quote',
					'type'  => 'textarea',
					'rows'  => 4,
				),
				array(
					'key'   => 'field_inf_testimonial_rating',
					'label' => 'Rating',
					'name'  => 'testimonial_rating',
					'type'  => 'number',
					'min'   => 1,
					'max'   => 5,
					'step'  => 1,
				),
				array(
					'key'          => 'field_inf_testimonial_related_practice_areas',
					'label'        => 'Related Practice Areas (Optional)',
					'name'         => 'testimonial_related_practice_areas',
					'type'         => 'relationship',
					'post_type'    => array( 'practice_area' ),
					'filters'      => array( 'search' ),
					'return_format'=> 'id',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'testimonial',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'inf_register_law_firm_acf_fields' );
