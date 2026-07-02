<?php
/**
 * ACF Field Group: Testimonials
 *
 * Why these fields?
 *   The `reviewer` group with sub-field `name`, and `rating`, are consumed
 *   directly by `mp_generate_testimonial_schema()` in seo/schema.php.
 *   These field names MUST remain stable.
 *
 *   `practice_area` enables reverse queries: "show testimonials for this
 *   practice area" without storing duplicates on the PA post itself.
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

acf_add_local_field_group( array(
    'key'   => 'group_inf_testimonials',
    'title' => __( 'Testimonial Details', 'inf' ),
    'fields' => array(

        array(
            'key'          => 'field_inf_test_reviewer',
            'label'        => __( 'Reviewer', 'inf' ),
            'name'         => 'reviewer',  // Consumed by schema.php — do not rename.
            'type'         => 'group',
            'instructions' => __( 'Client information for schema output.', 'inf' ),
            'sub_fields'   => array(
                array(
                    'key'      => 'field_inf_test_reviewer_name',
                    'label'    => __( 'Name', 'inf' ),
                    'name'     => 'name',   // Consumed by schema.php — do not rename.
                    'type'     => 'text',
                    'required' => 1,
                    'instructions' => __( 'First name + last initial only, e.g. "John D." — avoid using full last names.', 'inf' ),
                ),
                array(
                    'key'   => 'field_inf_test_reviewer_location',
                    'label' => __( 'City / State', 'inf' ),
                    'name'  => 'location',
                    'type'  => 'text',
                ),
            ),
        ),
        array(
            'key'          => 'field_inf_test_rating',
            'label'        => __( 'Rating', 'inf' ),
            'name'         => 'rating',    // Consumed by hooks.php — do not rename.
            'type'         => 'number',
            'required'     => 1,
            'min'          => 1,
            'max'          => 5,
            'default_value' => 5,
            'instructions' => __( 'Star rating 1–5. Outputs ratingValue in Review schema.', 'inf' ),
        ),
        array(
            'key'          => 'field_inf_test_practice_area',
            'label'        => __( 'Practice Area', 'inf' ),
            'name'         => 'practice_area',
            'type'         => 'post_object',
            'post_type'    => array( 'practice-area' ),
            'return_format' => 'object',
            'ui'           => 1,
            'instructions' => __( 'Link to the practice area this testimonial relates to. Used in PA page reverse queries.', 'inf' ),
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
    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
) );
