<?php
/**
 * ACF Field Group: FAQ
 *
 * Why these fields?
 *   - `answer`: WYSIWYG for rich formatted answers visible on the front-end.
 *   - `schema_answer`: Plain-text version for FAQPage schema. Schema spec
 *     requires plain text; stripping HTML in the schema generator is brittle.
 *     Giving editors a dedicated plain-text field is safer and explicit.
 *   - `practice_areas`: Relationship — one FAQ can belong to many practice
 *     areas. This is the core architectural advantage of the FAQ CPT over
 *     a repeater field.
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

acf_add_local_field_group( array(
    'key'   => 'group_inf_faq',
    'title' => __( 'FAQ Details', 'inf' ),
    'fields' => array(

        array(
            'key'          => 'field_inf_faq_answer',
            'label'        => __( 'Answer', 'inf' ),
            'name'         => 'answer',
            'type'         => 'wysiwyg',
            'required'     => 1,
            'toolbar'      => 'basic',
            'media_upload' => 0,
            'instructions' => __( 'Full answer displayed on the front-end. May contain links, lists, and bold text.', 'inf' ),
        ),
        array(
            'key'          => 'field_inf_faq_schema_answer',
            'label'        => __( 'Schema Answer (plain text)', 'inf' ),
            'name'         => 'schema_answer',
            'type'         => 'textarea',
            'rows'         => 4,
            'required'     => 1,
            'instructions' => __( 'Plain-text version of the answer for FAQPage schema. No HTML. Must be ≥ 50 characters for Google to display it in rich results.', 'inf' ),
        ),
        array(
            'key'          => 'field_inf_faq_practice_areas',
            'label'        => __( 'Practice Areas', 'inf' ),
            'name'         => 'practice_areas',
            'type'         => 'relationship',
            'post_type'    => array( 'practice-area' ),
            'filters'      => array( 'search' ),
            'return_format' => 'object',
            'instructions' => __( 'Select all practice areas this FAQ is relevant to. The FAQ will appear in FAQPage schema on each selected area.', 'inf' ),
        ),

    ),
    'location' => array(
        array(
            array(
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'faq',
            ),
        ),
    ),
    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
) );
