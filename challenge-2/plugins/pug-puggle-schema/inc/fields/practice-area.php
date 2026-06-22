<?php
/**
 * Practice Area field group.
 *
 * Read by `mp_generate_practice_area_schema()`, which consumes the
 * `testimonials` relationship to attach a sample Review to the practice area's
 * Product schema. (FAQ markup for practice areas is handled by the shared
 * `schema_faq_items` group in faq.php.)
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the practice-area fields.
 *
 * @return void
 */
function pps_register_practice_area_fields() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_pps_practice_area',
			'title'    => __( 'Practice Area Details', 'pug-puggle-schema' ),
			'fields'   => array(
				array(
					'key'           => 'field_pps_pa_testimonials',
					'label'         => __( 'Related Testimonials', 'pug-puggle-schema' ),
					'name'          => 'testimonials',
					'type'          => 'relationship',
					'instructions'  => __( 'Testimonials attached to this practice area; the first becomes the sample Review in schema.', 'pug-puggle-schema' ),
					'post_type'     => array( 'testimonials' ),
					'filters'       => array( 'search' ),
					'return_format' => 'object',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'practice-area',
					),
				),
			),
			'active'   => true,
		)
	);
}
