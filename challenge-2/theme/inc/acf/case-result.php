<?php
/**
 * ACF Field Group: Case Result
 *
 * Why these fields?
 *   Case results need a structured `amount` string (not a number — "$4.5M" is
 *   more readable than 4500000), a linked practice area (for filtering on PA
 *   pages), and optional attorney relationship (for filtering on bio pages).
 *   `is_featured` drives homepage and practice area hero spotlights.
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

acf_add_local_field_group( array(
    'key'   => 'group_inf_case_result',
    'title' => __( 'Case Result Details', 'inf' ),
    'fields' => array(

        array(
            'key'          => 'field_inf_cr_amount',
            'label'        => __( 'Settlement / Verdict Amount', 'inf' ),
            'name'         => 'amount',
            'type'         => 'text',
            'required'     => 1,
            'instructions' => __( 'Display string, e.g. "$4.5 Million", "$750,000". Not a number field — allows formatting flexibility.', 'inf' ),
            'placeholder'  => '$0,000,000',
        ),
        array(
            'key'          => 'field_inf_cr_case_description',
            'label'        => __( 'Case Description', 'inf' ),
            'name'         => 'case_description',
            'type'         => 'textarea',
            'rows'         => 3,
            'required'     => 1,
            'instructions' => __( 'Brief factual summary of the case. 1–3 sentences. No client names.', 'inf' ),
        ),
        array(
            'key'          => 'field_inf_cr_practice_area',
            'label'        => __( 'Practice Area', 'inf' ),
            'name'         => 'practice_area',
            'type'         => 'post_object',
            'post_type'    => array( 'practice-area' ),
            'return_format' => 'object',
            'ui'           => 1,
            'required'     => 1,
            'instructions' => __( 'Link to the practice area this result belongs to. Used in reverse queries on practice area pages.', 'inf' ),
        ),
        array(
            'key'          => 'field_inf_cr_attorneys',
            'label'        => __( 'Attorney(s)', 'inf' ),
            'name'         => 'attorneys',
            'type'         => 'relationship',
            'post_type'    => array( 'attorney' ),
            'filters'      => array( 'search' ),
            'return_format' => 'object',
            'instructions' => __( 'Optional. Select the attorney(s) who worked on this case.', 'inf' ),
        ),
        array(
            'key'          => 'field_inf_cr_is_featured',
            'label'        => __( 'Feature on Homepage / Practice Area Hero', 'inf' ),
            'name'         => 'is_featured',
            'type'         => 'true_false',
            'message'      => __( 'Yes — promote this result to featured placements.', 'inf' ),
            'default_value' => 0,
            'ui'           => 1,
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
    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
) );
