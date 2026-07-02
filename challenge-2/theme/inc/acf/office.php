<?php
/**
 * ACF Field Group: Office
 *
 * Why these fields?
 *   The `address` and `geopoint` field names are consumed by both
 *   `mp_generate_office_schema()` and `mp_generate_local_business_schema()`.
 *   They MUST remain stable.
 *
 *   Other fields (phone, fax, hours, parking, directions) provide the
 *   structured data editors need for a location page — without free-form page
 *   editing or risk of misformatting an address for schema output.
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

acf_add_local_field_group( array(
    'key'   => 'group_inf_office',
    'title' => __( 'Office Details', 'inf' ),
    'fields' => array(

        // ── Location ─────────────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_off_tab_location',
            'label' => __( 'Location', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'          => 'field_inf_off_address',
            'label'        => __( 'Address', 'inf' ),
            'name'         => 'address',  // Consumed by schema.php — do not rename.
            'type'         => 'group',
            'instructions' => __( 'Physical address for this office. Used in LocalBusiness schema.', 'inf' ),
            'sub_fields'   => array(
                array(
                    'key'      => 'field_inf_off_addr_street',
                    'label'    => __( 'Street Address', 'inf' ),
                    'name'     => 'street',
                    'type'     => 'text',
                    'required' => 1,
                ),
                array(
                    'key'   => 'field_inf_off_addr_street2',
                    'label' => __( 'Suite / Floor', 'inf' ),
                    'name'  => 'street2',
                    'type'  => 'text',
                ),
                array(
                    'key'      => 'field_inf_off_addr_city',
                    'label'    => __( 'City', 'inf' ),
                    'name'     => 'city',
                    'type'     => 'text',
                    'required' => 1,
                ),
                array(
                    'key'      => 'field_inf_off_addr_state',
                    'label'    => __( 'State', 'inf' ),
                    'name'     => 'state',
                    'type'     => 'text',
                    'required' => 1,
                ),
                array(
                    'key'      => 'field_inf_off_addr_postal',
                    'label'    => __( 'Postal Code', 'inf' ),
                    'name'     => 'postal_code',
                    'type'     => 'text',
                    'required' => 1,
                ),
            ),
        ),
        array(
            'key'          => 'field_inf_off_geopoint',
            'label'        => __( 'Map Pin', 'inf' ),
            'name'         => 'geopoint',  // Consumed by schema.php — do not rename.
            'type'         => 'google_map',
            'instructions' => __( 'Drag the pin to the exact office entrance. Used in GeoCoordinates schema.', 'inf' ),
            'center_lat'   => '40.7128',
            'center_lng'   => '-74.0060',
            'zoom'         => 15,
            'height'       => 400,
        ),
        array(
            'key'   => 'field_inf_off_directions_url',
            'label' => __( 'Directions URL', 'inf' ),
            'name'  => 'directions_url',
            'type'  => 'url',
        ),

        // ── Contact ───────────────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_off_tab_contact',
            'label' => __( 'Contact', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'   => 'field_inf_off_phone',
            'label' => __( 'Phone', 'inf' ),
            'name'  => 'phone',
            'type'  => 'text',
        ),
        array(
            'key'   => 'field_inf_off_fax',
            'label' => __( 'Fax', 'inf' ),
            'name'  => 'fax',
            'type'  => 'text',
        ),

        // ── Hours ─────────────────────────────────────────────────────────────

        array(
            'key'   => 'field_inf_off_tab_hours',
            'label' => __( 'Hours', 'inf' ),
            'type'  => 'tab',
        ),
        array(
            'key'          => 'field_inf_off_hours',
            'label'        => __( 'Office Hours', 'inf' ),
            'name'         => 'hours',
            'type'         => 'repeater',
            'instructions' => __( 'List opening hours per day. Used for schema openingHoursSpecification.', 'inf' ),
            'min'          => 0,
            'layout'       => 'table',
            'button_label' => __( 'Add Day', 'inf' ),
            'sub_fields'   => array(
                array(
                    'key'   => 'field_inf_off_hours_day',
                    'label' => __( 'Day', 'inf' ),
                    'name'  => 'day',
                    'type'  => 'select',
                    'choices' => array(
                        'Monday'    => __( 'Monday', 'inf' ),
                        'Tuesday'   => __( 'Tuesday', 'inf' ),
                        'Wednesday' => __( 'Wednesday', 'inf' ),
                        'Thursday'  => __( 'Thursday', 'inf' ),
                        'Friday'    => __( 'Friday', 'inf' ),
                        'Saturday'  => __( 'Saturday', 'inf' ),
                        'Sunday'    => __( 'Sunday', 'inf' ),
                    ),
                ),
                array(
                    'key'   => 'field_inf_off_hours_open',
                    'label' => __( 'Opens', 'inf' ),
                    'name'  => 'opens',
                    'type'  => 'time_picker',
                ),
                array(
                    'key'   => 'field_inf_off_hours_close',
                    'label' => __( 'Closes', 'inf' ),
                    'name'  => 'closes',
                    'type'  => 'time_picker',
                ),
            ),
        ),
        array(
            'key'   => 'field_inf_off_parking',
            'label' => __( 'Parking Information', 'inf' ),
            'name'  => 'parking_info',
            'type'  => 'textarea',
            'rows'  => 3,
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
    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
) );
