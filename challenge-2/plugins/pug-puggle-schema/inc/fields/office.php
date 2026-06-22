<?php
/**
 * Office field group.
 *
 * Read by `mp_generate_office_schema()`, which consumes `address`
 * (city/state/postal_code/street/street2) and `geopoint` (lat/lng) off each
 * office. These field names and the sub-field keys map 1:1 to what that
 * generator expects.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the office fields.
 *
 * @return void
 */
function pps_register_office_fields() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_pps_office',
			'title'    => __( 'Office Details', 'pug-puggle-schema' ),
			'fields'   => array(
				array(
					'key'        => 'field_pps_office_address',
					'label'      => __( 'Address', 'pug-puggle-schema' ),
					'name'       => 'address',
					'type'       => 'group',
					'layout'     => 'block',
					'sub_fields' => array(
						array(
							'key'     => 'field_pps_office_street',
							'label'   => __( 'Street', 'pug-puggle-schema' ),
							'name'    => 'street',
							'type'    => 'text',
							'wrapper' => array( 'width' => '50' ),
						),
						array(
							'key'     => 'field_pps_office_street2',
							'label'   => __( 'Street (line 2)', 'pug-puggle-schema' ),
							'name'    => 'street2',
							'type'    => 'text',
							'wrapper' => array( 'width' => '50' ),
						),
						array(
							'key'     => 'field_pps_office_city',
							'label'   => __( 'City', 'pug-puggle-schema' ),
							'name'    => 'city',
							'type'    => 'text',
							'wrapper' => array( 'width' => '40' ),
						),
						array(
							'key'     => 'field_pps_office_state',
							'label'   => __( 'State', 'pug-puggle-schema' ),
							'name'    => 'state',
							'type'    => 'text',
							'wrapper' => array( 'width' => '30' ),
						),
						array(
							'key'     => 'field_pps_office_postal_code',
							'label'   => __( 'Postal Code', 'pug-puggle-schema' ),
							'name'    => 'postal_code',
							'type'    => 'text',
							'wrapper' => array( 'width' => '30' ),
						),
					),
				),
				array(
					'key'          => 'field_pps_office_geopoint',
					'label'        => __( 'Geo Point', 'pug-puggle-schema' ),
					'name'         => 'geopoint',
					'type'         => 'group',
					'instructions' => __( 'Coordinates used for the GeoCoordinates schema and proximity search.', 'pug-puggle-schema' ),
					'layout'       => 'block',
					'sub_fields'   => array(
						array(
							'key'          => 'field_pps_office_lat',
							'label'        => __( 'Latitude', 'pug-puggle-schema' ),
							'name'         => 'lat',
							'type'         => 'text',
							'instructions' => __( 'Decimal degrees, e.g. 27.9506', 'pug-puggle-schema' ),
							'wrapper'      => array( 'width' => '50' ),
						),
						array(
							'key'          => 'field_pps_office_lng',
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
						'value'    => 'office',
					),
				),
			),
			'active'   => true,
		)
	);
}
