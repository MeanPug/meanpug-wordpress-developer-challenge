<?php
/**
 * ACF: Options Page + Global Firm Settings
 *
 * Registers the global options page and its field group.
 *
 * Why an options page?
 *   Fields like firm phone, address, and social profiles are used in schema
 *   generators on every page. Storing them once in an options page (not on a
 *   single post) is the correct pattern — one place to update, zero duplication.
 *
 * The field names here MUST remain stable — they are consumed by:
 *   - mp_generate_local_business_schema()  → contact_phone, contact_email,
 *                                            contact_main_address, social_profiles
 *   - mp_generate_testimonials_schema()    → schema_aggregate_rating (option)
 *   - hooks.php mpdcontent action          → ask_a_question_form_id
 *   - filters.php Google Maps filter       → technical_google_maps_api_key
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

// Register the options page — requires ACF Pro.
if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page( array(
        'page_title' => __( 'Firm Settings', 'inf' ),
        'menu_title' => __( 'Firm Settings', 'inf' ),
        'menu_slug'  => 'firm-settings',
        'capability' => 'manage_options',
        'icon_url'   => 'dashicons-building',
        'position'   => 2,
        'redirect'   => false,
    ) );
}

// Field group for the options page.
acf_add_local_field_group( array(
    'key'      => 'group_inf_options',
    'title'    => __( 'Firm Settings', 'inf' ),
    'fields'   => array(

        // ── Contact ──────────────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_opt_tab_contact',
            'label' => __( 'Contact', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'          => 'field_inf_opt_contact_phone',
            'label'        => __( 'Main Phone', 'inf' ),
            'name'         => 'contact_phone',
            'type'         => 'group',
            'instructions' => __( 'Global firm phone displayed in header and schema.', 'inf' ),
            'sub_fields'   => array(
                array(
                    'key'   => 'field_inf_opt_contact_phone_title',
                    'label' => __( 'Display Number', 'inf' ),
                    'name'  => 'title',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_inf_opt_contact_phone_value',
                    'label' => __( 'Tel: Value (no spaces)', 'inf' ),
                    'name'  => 'value',
                    'type'  => 'text',
                ),
            ),
        ),
        array(
            'key'          => 'field_inf_opt_contact_email',
            'label'        => __( 'Main Email', 'inf' ),
            'name'         => 'contact_email',
            'type'         => 'group',
            'instructions' => __( 'Global firm email for schema output.', 'inf' ),
            'sub_fields'   => array(
                array(
                    'key'   => 'field_inf_opt_contact_email_title',
                    'label' => __( 'Display Email', 'inf' ),
                    'name'  => 'title',
                    'type'  => 'email',
                ),
            ),
        ),
        array(
            'key'          => 'field_inf_opt_contact_main_address',
            'label'        => __( 'Headquarters Address', 'inf' ),
            'name'         => 'contact_main_address',
            'type'         => 'google_map',
            'instructions' => __( 'Primary firm address. Used in global LocalBusiness schema.', 'inf' ),
            'center_lat'   => '40.7128',
            'center_lng'   => '-74.0060',
            'zoom'         => 14,
            'height'       => 400,
        ),

        // ── Social ───────────────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_opt_tab_social',
            'label' => __( 'Social Profiles', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'          => 'field_inf_opt_social_profiles',
            'label'        => __( 'Social Profiles', 'inf' ),
            'name'         => 'social_profiles',
            'type'         => 'repeater',
            'instructions' => __( 'Add each social media URL. Used in sameAs schema property.', 'inf' ),
            'min'          => 0,
            'layout'       => 'table',
            'button_label' => __( 'Add Profile', 'inf' ),
            'sub_fields'   => array(
                array(
                    'key'   => 'field_inf_opt_social_profiles_label',
                    'label' => __( 'Platform', 'inf' ),
                    'name'  => 'label',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_inf_opt_social_profiles_url',
                    'label' => __( 'URL', 'inf' ),
                    'name'  => 'url',
                    'type'  => 'url',
                ),
            ),
        ),

        // ── Schema ───────────────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_opt_tab_schema',
            'label' => __( 'Schema', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'          => 'field_inf_opt_schema_aggregate_rating',
            'label'        => __( 'Aggregate Rating', 'inf' ),
            'name'         => 'schema_aggregate_rating',
            'type'         => 'group',
            'instructions' => __( 'Global aggregate rating used in testimonials schema.', 'inf' ),
            'sub_fields'   => array(
                array(
                    'key'   => 'field_inf_opt_schema_agg_value',
                    'label' => __( 'Rating Value (e.g. 4.9)', 'inf' ),
                    'name'  => 'value',
                    'type'  => 'number',
                    'step'  => 0.1,
                    'min'   => 0,
                    'max'   => 5,
                ),
                array(
                    'key'   => 'field_inf_opt_schema_agg_count',
                    'label' => __( 'Review Count', 'inf' ),
                    'name'  => 'count',
                    'type'  => 'number',
                    'min'   => 0,
                ),
            ),
        ),

        // ── Technical ────────────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_opt_tab_technical',
            'label' => __( 'Technical', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'   => 'field_inf_opt_gmaps_api_key',
            'label' => __( 'Google Maps API Key', 'inf' ),
            'name'  => 'technical_google_maps_api_key',
            'type'  => 'text',
        ),
        array(
            'key'          => 'field_inf_opt_ask_form_id',
            'label'        => __( 'Ask a Question — Gravity Form ID', 'inf' ),
            'name'         => 'ask_a_question_form_id',
            'type'         => 'number',
            'instructions' => __( 'The numeric ID of the Gravity Form used for the Ask a Question widget.', 'inf' ),
            'min'          => 1,
        ),

    ),
    'location' => array(
        array(
            array(
                'param'    => 'options_page',
                'operator' => '==',
                'value'    => 'firm-settings',
            ),
        ),
    ),
    'menu_order'         => 0,
    'position'           => 'normal',
    'style'              => 'default',
    'label_placement'    => 'top',
    'instruction_placement' => 'label',
) );
