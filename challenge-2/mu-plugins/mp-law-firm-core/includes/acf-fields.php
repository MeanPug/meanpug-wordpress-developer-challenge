<?php
/**
 * Optional ACF field groups for the law firm content model.
 *
 * The data model itself is registered with native WordPress post meta.
 * These ACF field groups provide an editorial UI when ACF is available.
 *
 * @package MeanPugLawFirmCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers optional ACF local field groups.
 *
 * @return void
 */
function mp_law_firm_core_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_mp_attorney_details',
			'title'                 => 'Attorney Details',
			'fields'                => array(
				array(
					'key'   => 'field_mp_attorney_title',
					'label' => 'Title / Position',
					'name'  => '_mp_attorney_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_mp_attorney_email',
					'label' => 'Email',
					'name'  => '_mp_attorney_email',
					'type'  => 'email',
				),
				array(
					'key'   => 'field_mp_attorney_phone',
					'label' => 'Phone',
					'name'  => '_mp_attorney_phone',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_mp_attorney_bar_admissions',
					'label' => 'Bar Admissions',
					'name'  => '_mp_attorney_bar_admissions',
					'type'  => 'textarea',
				),
				array(
					'key'   => 'field_mp_attorney_education',
					'label' => 'Education',
					'name'  => '_mp_attorney_education',
					'type'  => 'textarea',
				),
				array(
					'key'           => 'field_mp_attorney_related_practice_areas',
					'label'         => 'Related Practice Areas',
					'name'          => '_mp_related_practice_areas',
					'type'          => 'relationship',
					'post_type'     => array( 'practice-area' ),
					'return_format' => 'id',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'attorney',
					),
				),
			),
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_mp_practice_area_details',
			'title'                 => 'Practice Area Details',
			'fields'                => array(
				array(
					'key'   => 'field_mp_practice_headline',
					'label' => 'Short Headline',
					'name'  => '_mp_practice_headline',
					'type'  => 'text',
				),
				array(
					'key'           => 'field_mp_practice_priority',
					'label'         => 'Display Priority',
					'name'          => '_mp_practice_priority',
					'type'          => 'number',
					'instructions'  => 'Optional priority value for custom ordering.',
					'default_value' => 0,
				),
				array(
					'key'           => 'field_mp_practice_related_attorneys',
					'label'         => 'Related Attorneys',
					'name'          => '_mp_related_attorneys',
					'type'          => 'relationship',
					'post_type'     => array( 'attorney' ),
					'return_format' => 'id',
				),
				array(
					'key'           => 'field_mp_practice_related_faqs',
					'label'         => 'Related FAQs',
					'name'          => '_mp_related_faqs',
					'type'          => 'relationship',
					'post_type'     => array( 'faq' ),
					'return_format' => 'id',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'practice-area',
					),
				),
			),
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_mp_case_result_details',
			'title'                 => 'Case Result Details',
			'fields'                => array(
				array(
					'key'   => 'field_mp_case_result_amount',
					'label' => 'Result Amount',
					'name'  => '_mp_case_result_amount',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_mp_case_result_label',
					'label' => 'Result Label',
					'name'  => '_mp_case_result_label',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_mp_case_result_summary',
					'label' => 'Case Summary',
					'name'  => '_mp_case_result_summary',
					'type'  => 'textarea',
				),
				array(
					'key'           => 'field_mp_case_result_related_practice_areas',
					'label'         => 'Related Practice Areas',
					'name'          => '_mp_related_practice_areas',
					'type'          => 'relationship',
					'post_type'     => array( 'practice-area' ),
					'return_format' => 'id',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'case-result',
					),
				),
			),
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_mp_testimonial_details',
			'title'                 => 'Testimonial Details',
			'fields'                => array(
				array(
					'key'   => 'field_mp_testimonial_author_name',
					'label' => 'Author Name',
					'name'  => '_mp_testimonial_author_name',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_mp_testimonial_author_title',
					'label' => 'Author Title',
					'name'  => '_mp_testimonial_author_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_mp_testimonial_source',
					'label' => 'Source',
					'name'  => '_mp_testimonial_source',
					'type'  => 'text',
				),
				array(
					'key'           => 'field_mp_testimonial_related_practice_areas',
					'label'         => 'Related Practice Areas',
					'name'          => '_mp_related_practice_areas',
					'type'          => 'relationship',
					'post_type'     => array( 'practice-area' ),
					'return_format' => 'id',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'testimonials',
					),
				),
			),
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_mp_location_details',
			'title'                 => 'Location Details',
			'fields'                => array(
				array(
					'key'   => 'field_mp_location_street',
					'label' => 'Street Address',
					'name'  => '_mp_location_street',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_mp_location_city',
					'label' => 'City',
					'name'  => '_mp_location_city',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_mp_location_state',
					'label' => 'State',
					'name'  => '_mp_location_state',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_mp_location_zip',
					'label' => 'ZIP Code',
					'name'  => '_mp_location_zip',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_mp_location_phone',
					'label' => 'Phone',
					'name'  => '_mp_location_phone',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_mp_location_latitude',
					'label' => 'Latitude',
					'name'  => '_mp_location_latitude',
					'type'  => 'number',
					'step'  => 'any',
				),
				array(
					'key'   => 'field_mp_location_longitude',
					'label' => 'Longitude',
					'name'  => '_mp_location_longitude',
					'type'  => 'number',
					'step'  => 'any',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'office',
					),
				),
			),
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_mp_faq_details',
			'title'                 => 'FAQ Details',
			'fields'                => array(
				array(
					'key'   => 'field_mp_faq_answer',
					'label' => 'Answer',
					'name'  => '_mp_faq_answer',
					'type'  => 'wysiwyg',
				),
				array(
					'key'           => 'field_mp_faq_related_practice_areas',
					'label'         => 'Related Practice Areas',
					'name'          => '_mp_related_practice_areas',
					'type'          => 'relationship',
					'post_type'     => array( 'practice-area' ),
					'return_format' => 'id',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'faq',
					),
				),
			),
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);
}
add_action( 'acf/init', 'mp_law_firm_core_register_acf_fields' );