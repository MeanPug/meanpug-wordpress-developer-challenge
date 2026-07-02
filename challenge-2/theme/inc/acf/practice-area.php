<?php
/**
 * ACF Field Group: Practice Area
 *
 * Why these fields?
 *   Practice area pages are the firm's primary SEO landing pages. They need:
 *   - Hero content (headline, image, CTA) decoupled from the post title.
 *   - `schema_faq_items`: Repeater consumed directly by hooks.php
 *     `mp_output_additional_schema_for_post()`. Field name MUST stay stable.
 *   - `schema_aggregate_rating`: Group consumed by hooks.php
 *     `mp_output_default_schema_for_post()`. Field name MUST stay stable.
 *   - `testimonials`: Relationship consumed by `inf_add_reviews_schema_for_post()`
 *     in utils/schema.php and `mp_generate_practice_area_schema()`. MUST stay stable.
 *   - `featured_case_result`: Single post object for the hero callout result.
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

acf_add_local_field_group( array(
    'key'   => 'group_inf_practice_area',
    'title' => __( 'Practice Area', 'inf' ),
    'fields' => array(

        // ── Hero ─────────────────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_pa_tab_hero',
            'label' => __( 'Hero', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'          => 'field_inf_pa_hero_headline',
            'label'        => __( 'Hero Headline', 'inf' ),
            'name'         => 'hero_headline',
            'type'         => 'text',
            'instructions' => __( 'H1 override. If blank, the post title is used.', 'inf' ),
        ),
        array(
            'key'   => 'field_inf_pa_hero_subheading',
            'label' => __( 'Hero Subheading', 'inf' ),
            'name'  => 'hero_subheading',
            'type'  => 'textarea',
            'rows'  => 2,
        ),
        array(
            'key'           => 'field_inf_pa_hero_image',
            'label'         => __( 'Hero Background Image', 'inf' ),
            'name'          => 'hero_image',
            'type'          => 'image',
            'return_format' => 'array',
            'preview_size'  => 'medium_large',
        ),
        array(
            'key'   => 'field_inf_pa_hero_cta_label',
            'label' => __( 'CTA Button Label', 'inf' ),
            'name'  => 'hero_cta_label',
            'type'  => 'text',
        ),
        array(
            'key'   => 'field_inf_pa_hero_cta_url',
            'label' => __( 'CTA Button URL', 'inf' ),
            'name'  => 'hero_cta_url',
            'type'  => 'url',
        ),

        // ── Schema ───────────────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_pa_tab_schema',
            'label' => __( 'Schema & SEO', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'          => 'field_inf_pa_schema_faq_items',
            'label'        => __( 'FAQ Schema Items', 'inf' ),
            'name'         => 'schema_faq_items',   // Consumed by hooks.php — do not rename.
            'type'         => 'repeater',
            'instructions' => __( 'These Q&A pairs generate FAQPage schema in the page footer. Use for the most common client questions about this practice area.', 'inf' ),
            'min'          => 0,
            'layout'       => 'block',
            'button_label' => __( 'Add FAQ Item', 'inf' ),
            'sub_fields'   => array(
                array(
                    'key'      => 'field_inf_pa_faq_question',
                    'label'    => __( 'Question', 'inf' ),
                    'name'     => 'question',
                    'type'     => 'text',
                    'required' => 1,
                ),
                array(
                    'key'      => 'field_inf_pa_faq_answer',
                    'label'    => __( 'Answer', 'inf' ),
                    'name'     => 'answer',
                    'type'     => 'textarea',
                    'rows'     => 4,
                    'required' => 1,
                ),
            ),
        ),
        array(
            'key'          => 'field_inf_pa_schema_aggregate_rating',
            'label'        => __( 'Aggregate Rating (override)', 'inf' ),
            'name'         => 'schema_aggregate_rating', // Consumed by hooks.php — do not rename.
            'type'         => 'group',
            'instructions' => __( 'Overrides the global aggregate rating for this specific practice area. Leave blank to use the global value from Firm Settings.', 'inf' ),
            'sub_fields'   => array(
                array(
                    'key'   => 'field_inf_pa_agg_value',
                    'label' => __( 'Rating Value (e.g. 4.9)', 'inf' ),
                    'name'  => 'value',
                    'type'  => 'number',
                    'step'  => 0.1,
                    'min'   => 0,
                    'max'   => 5,
                ),
                array(
                    'key'   => 'field_inf_pa_agg_count',
                    'label' => __( 'Review Count', 'inf' ),
                    'name'  => 'count',
                    'type'  => 'number',
                    'min'   => 0,
                ),
            ),
        ),

        // ── Related Content ───────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_pa_tab_related',
            'label' => __( 'Related Content', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'          => 'field_inf_pa_testimonials',
            'label'        => __( 'Testimonials', 'inf' ),
            'name'         => 'testimonials', // Consumed by schema.php — do not rename.
            'type'         => 'relationship',
            'post_type'    => array( 'testimonials' ),
            'filters'      => array( 'search' ),
            'return_format' => 'object',
            'instructions' => __( 'Select testimonials to feature on this practice area page. The first is used as a Review schema sample.', 'inf' ),
        ),
        array(
            'key'          => 'field_inf_pa_featured_case_result',
            'label'        => __( 'Featured Case Result', 'inf' ),
            'name'         => 'featured_case_result',
            'type'         => 'post_object',
            'post_type'    => array( 'case-result' ),
            'return_format' => 'object',
            'ui'           => 1,
            'instructions' => __( 'Spotlight one case result in the practice area hero or sidebar.', 'inf' ),
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
    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
) );
