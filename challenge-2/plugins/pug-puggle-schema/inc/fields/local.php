<?php
/**
 * Local (Area Served) field group.
 *
 * The location navigator buckets these posts by `area_type` and finds them by the
 * `content_type` = "Area Served" meta; the Haversine search reads `geopoint`.
 * Every field name here matches a get_field()/meta_key the theme already uses.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the local fields.
 *
 * @return void
 */
function pps_register_local_fields() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_pps_local',
			'title'    => __( 'Area Served Details', 'pug-puggle-schema' ),
			'fields'   => array(
				array(
					'key'           => 'field_pps_local_content_type',
					'label'         => __( 'Content Type', 'pug-puggle-schema' ),
					'name'          => 'content_type',
					'type'          => 'select',
					'instructions'  => __( 'Leave as "Area Served" so the location navigator can find this page.', 'pug-puggle-schema' ),
					'choices'       => array(
						'Area Served' => __( 'Area Served', 'pug-puggle-schema' ),
					),
					'default_value' => 'Area Served',
					'return_format' => 'value',
					'allow_null'    => 0,
				),
				array(
					'key'           => 'field_pps_local_area_type',
					'label'         => __( 'Area Type', 'pug-puggle-schema' ),
					'name'          => 'area_type',
					'type'          => 'select',
					'instructions'  => __( 'How the location navigator groups this area (e.g. By State / By City).', 'pug-puggle-schema' ),
					'choices'       => array(
						'State'        => __( 'State', 'pug-puggle-schema' ),
						'City'         => __( 'City', 'pug-puggle-schema' ),
						'Region'       => __( 'Region', 'pug-puggle-schema' ),
						'Neighborhood' => __( 'Neighborhood', 'pug-puggle-schema' ),
					),
					'default_value' => 'City',
					'return_format' => 'value',
					'allow_null'    => 0,
				),
				array(
					'key'        => 'field_pps_local_geopoint',
					'label'      => __( 'Geo Point', 'pug-puggle-schema' ),
					'name'       => 'geopoint',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'          => 'field_pps_local_lat',
							'label'        => __( 'Latitude', 'pug-puggle-schema' ),
							'name'         => 'lat',
							'type'         => 'text',
							'instructions' => __( 'Decimal degrees, e.g. 27.9506', 'pug-puggle-schema' ),
							'wrapper'      => array( 'width' => '50' ),
						),
						array(
							'key'          => 'field_pps_local_lng',
							'label'        => __( 'Longitude', 'pug-puggle-schema' ),
							'name'         => 'lng',
							'type'         => 'text',
							'instructions' => __( 'Decimal degrees, e.g. -82.4572', 'pug-puggle-schema' ),
							'wrapper'      => array( 'width' => '50' ),
						),
					),
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'local',
					),
				),
			),
			'active'   => true,
		)
	);
}
