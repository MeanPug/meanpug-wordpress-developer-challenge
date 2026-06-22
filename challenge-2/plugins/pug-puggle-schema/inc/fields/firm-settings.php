<?php
/**
 * Firm Global Settings field group.
 *
 * Bound to the theme's existing "Theme Settings" options page (registered in the
 * theme at inc/settings/all.php). These are the firm's structured identity —
 * the Name/Address/Phone, social profiles, and aggregate rating that power the
 * site-wide LocalBusiness schema in inc/utils/seo/schema.php. NAP data is content,
 * not presentation, so it lives here with the rest of the schema.
 *
 * Field names below are not arbitrary — each one mirrors exactly what the theme
 * reads via get_field( '…', 'option' ).
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the firm global settings fields.
 *
 * @return void
 */
function pps_register_firm_settings_fields() {
	acf_add_local_field_group(
		array(
			'key'                   => 'group_pps_firm_settings',
			'title'                 => __( 'Firm Settings (Schema)', 'pug-puggle-schema' ),
			'fields'                => array(
				// --- Contact tab ---------------------------------------------.
				array(
					'key'   => 'field_pps_fs_tab_contact',
					'label' => __( 'Contact', 'pug-puggle-schema' ),
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_pps_fs_contact_phone',
					'label'        => __( 'Primary Phone', 'pug-puggle-schema' ),
					'name'         => 'contact_phone',
					'type'         => 'link',
					'instructions' => __( 'The number that appears in the header and the LocalBusiness schema (the link text is used as the phone number).', 'pug-puggle-schema' ),
					'return_format' => 'array',
				),
				array(
					'key'           => 'field_pps_fs_contact_email',
					'label'         => __( 'Primary Email', 'pug-puggle-schema' ),
					'name'          => 'contact_email',
					'type'          => 'link',
					'instructions'  => __( 'The firm email used in schema (the link text is used as the address).', 'pug-puggle-schema' ),
					'return_format' => 'array',
				),
				array(
					'key'        => 'field_pps_fs_contact_main_address',
					'label'      => __( 'Main Address', 'pug-puggle-schema' ),
					'name'       => 'contact_main_address',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'       => 'field_pps_fs_addr_street_number',
							'label'     => __( 'Street Number', 'pug-puggle-schema' ),
							'name'      => 'street_number',
							'type'      => 'text',
							'wrapper'   => array( 'width' => '25' ),
						),
						array(
							'key'     => 'field_pps_fs_addr_street_name',
							'label'   => __( 'Street Name', 'pug-puggle-schema' ),
							'name'    => 'street_name',
							'type'    => 'text',
							'wrapper' => array( 'width' => '75' ),
						),
						array(
							'key'     => 'field_pps_fs_addr_city',
							'label'   => __( 'City', 'pug-puggle-schema' ),
							'name'    => 'city',
							'type'    => 'text',
							'wrapper' => array( 'width' => '40' ),
						),
						array(
							'key'     => 'field_pps_fs_addr_state',
							'label'   => __( 'State', 'pug-puggle-schema' ),
							'name'    => 'state',
							'type'    => 'text',
							'wrapper' => array( 'width' => '30' ),
						),
						array(
							'key'     => 'field_pps_fs_addr_post_code',
							'label'   => __( 'Postal Code', 'pug-puggle-schema' ),
							'name'    => 'post_code',
							'type'    => 'text',
							'wrapper' => array( 'width' => '30' ),
						),
						array(
							'key'          => 'field_pps_fs_addr_lat',
							'label'        => __( 'Latitude', 'pug-puggle-schema' ),
							'name'         => 'lat',
							'type'         => 'text',
							'instructions' => __( 'Decimal degrees, e.g. 27.9506', 'pug-puggle-schema' ),
							'wrapper'      => array( 'width' => '50' ),
						),
						array(
							'key'          => 'field_pps_fs_addr_lng',
							'label'        => __( 'Longitude', 'pug-puggle-schema' ),
							'name'         => 'lng',
							'type'         => 'text',
							'instructions' => __( 'Decimal degrees, e.g. -82.4572', 'pug-puggle-schema' ),
							'wrapper'      => array( 'width' => '50' ),
						),
					),
				),
				array(
					'key'           => 'field_pps_fs_contact_offices',
					'label'         => __( 'Offices', 'pug-puggle-schema' ),
					'name'          => 'contact_offices',
					'type'          => 'relationship',
					'instructions'  => __( 'Offices surfaced by the location navigator.', 'pug-puggle-schema' ),
					'post_type'     => array( 'office' ),
					'return_format' => 'object',
				),
				// --- Social tab ----------------------------------------------.
				array(
					'key'   => 'field_pps_fs_tab_social',
					'label' => __( 'Social', 'pug-puggle-schema' ),
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_pps_fs_social_profiles',
					'label'        => __( 'Social Profiles', 'pug-puggle-schema' ),
					'name'         => 'social_profiles',
					'type'         => 'repeater',
					'instructions' => __( 'Output as schema sameAs links.', 'pug-puggle-schema' ),
					'layout'       => 'table',
					'button_label' => __( 'Add Profile', 'pug-puggle-schema' ),
					'sub_fields'   => array(
						array(
							'key'     => 'field_pps_fs_social_network',
							'label'   => __( 'Network', 'pug-puggle-schema' ),
							'name'    => 'network',
							'type'    => 'text',
							'wrapper' => array( 'width' => '30' ),
						),
						array(
							'key'     => 'field_pps_fs_social_url',
							'label'   => __( 'URL', 'pug-puggle-schema' ),
							'name'    => 'url',
							'type'    => 'url',
							'wrapper' => array( 'width' => '70' ),
						),
					),
				),
				// --- Reviews tab ---------------------------------------------.
				array(
					'key'   => 'field_pps_fs_tab_reviews',
					'label' => __( 'Reviews', 'pug-puggle-schema' ),
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_pps_fs_schema_aggregate_rating',
					'label'        => __( 'Aggregate Rating', 'pug-puggle-schema' ),
					'name'         => 'schema_aggregate_rating',
					'type'         => 'group',
					'instructions' => __( 'Feeds AggregateRating on practice-area and testimonials schema.', 'pug-puggle-schema' ),
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'           => 'field_pps_fs_agg_value',
							'label'         => __( 'Rating Value', 'pug-puggle-schema' ),
							'name'          => 'value',
							'type'          => 'number',
							'min'           => 0,
							'max'           => 5,
							'step'          => 0.1,
							'wrapper'       => array( 'width' => '50' ),
						),
						array(
							'key'     => 'field_pps_fs_agg_count',
							'label'   => __( 'Review Count', 'pug-puggle-schema' ),
							'name'    => 'count',
							'type'    => 'number',
							'min'     => 0,
							'wrapper' => array( 'width' => '50' ),
						),
					),
				),
				// --- Technical tab -------------------------------------------.
				array(
					'key'   => 'field_pps_fs_tab_technical',
					'label' => __( 'Technical', 'pug-puggle-schema' ),
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_pps_fs_google_maps_api_key',
					'label'        => __( 'Google Maps API Key', 'pug-puggle-schema' ),
					'name'         => 'technical_google_maps_api_key',
					'type'         => 'text',
					'instructions' => __( 'Used by the polygon map / location modules and the ACF map field.', 'pug-puggle-schema' ),
				),
				array(
					'key'          => 'field_pps_fs_ask_question_form_id',
					'label'        => __( 'Ask-a-Question Form ID', 'pug-puggle-schema' ),
					'name'         => 'ask_a_question_form_id',
					'type'         => 'number',
					'instructions' => __( 'Gravity Forms form ID wired to the ask-a-question submission hook.', 'pug-puggle-schema' ),
				),
				array(
					'key'          => 'field_pps_fs_default_eval_form_header',
					'label'        => __( 'Default Evaluation Form Header', 'pug-puggle-schema' ),
					'name'         => 'default_evaluation_form_header',
					'type'         => 'text',
					'instructions' => __( 'Heading shown above the case-evaluation form in the gallery template.', 'pug-puggle-schema' ),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'theme-general-settings',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'active'                => true,
			'description'           => __( 'Firm identity and structured-data settings.', 'pug-puggle-schema' ),
		)
	);
}
