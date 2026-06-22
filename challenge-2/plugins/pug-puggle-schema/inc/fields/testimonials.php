<?php
/**
 * Testimonials field group.
 *
 * Read by `mp_generate_testimonial_schema()`, which pulls the `reviewer` group
 * (specifically reviewer['name']) and the post body to build a Schema.org
 * Review. We also surface a `rating` field — the review-import hook in the
 * theme's hooks.php writes it via update_field( 'rating', … ).
 *
 * Note: that same import hook writes a flat `reviewer_name`, whereas the schema
 * generator reads the grouped `reviewer.name`. We expose the grouped field that
 * the *output* side reads; reconciling the import path is flagged in the README.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the testimonials fields.
 *
 * @return void
 */
function pps_register_testimonials_fields() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_pps_testimonials',
			'title'    => __( 'Testimonial Details', 'pug-puggle-schema' ),
			'fields'   => array(
				array(
					'key'        => 'field_pps_testimonial_reviewer',
					'label'      => __( 'Reviewer', 'pug-puggle-schema' ),
					'name'       => 'reviewer',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'   => 'field_pps_testimonial_reviewer_name',
							'label' => __( 'Name', 'pug-puggle-schema' ),
							'name'  => 'name',
							'type'  => 'text',
						),
					),
				),
				array(
					'key'           => 'field_pps_testimonial_rating',
					'label'         => __( 'Rating', 'pug-puggle-schema' ),
					'name'          => 'rating',
					'type'          => 'number',
					'instructions'  => __( 'Star rating from 0 to 5.', 'pug-puggle-schema' ),
					'default_value' => 5,
					'min'           => 0,
					'max'           => 5,
					'step'          => 0.5,
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'testimonials',
					),
				),
			),
			'active'   => true,
		)
	);
}
