<?php
/**
 * Team (Attorney) field group.
 *
 * Not consumed by the inherited theme, but no attorney profile is complete
 * without contact details and credentials. Lean by design — extend as the firm's
 * bio template grows.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the team fields.
 *
 * @return void
 */
function pps_register_team_fields() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_pps_team',
			'title'    => __( 'Attorney Details', 'pug-puggle-schema' ),
			'fields'   => array(
				array(
					'key'     => 'field_pps_team_position',
					'label'   => __( 'Position', 'pug-puggle-schema' ),
					'name'    => 'position',
					'type'    => 'text',
					'wrapper' => array( 'width' => '50' ),
				),
				array(
					'key'     => 'field_pps_team_email',
					'label'   => __( 'Email', 'pug-puggle-schema' ),
					'name'    => 'email',
					'type'    => 'email',
					'wrapper' => array( 'width' => '50' ),
				),
				array(
					'key'     => 'field_pps_team_phone',
					'label'   => __( 'Phone', 'pug-puggle-schema' ),
					'name'    => 'phone',
					'type'    => 'text',
					'wrapper' => array( 'width' => '50' ),
				),
				array(
					'key'          => 'field_pps_team_bar_admissions',
					'label'        => __( 'Bar Admissions', 'pug-puggle-schema' ),
					'name'         => 'bar_admissions',
					'type'         => 'textarea',
					'instructions' => __( 'One jurisdiction per line.', 'pug-puggle-schema' ),
					'new_lines'    => 'br',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'team',
					),
				),
			),
			'active'   => true,
		)
	);
}
