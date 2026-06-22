<?php
/**
 * Related Practice Areas field group.
 *
 * The practice-areas widget calls get_field( 'practice_areas', $current_page_id )
 * to show hand-picked related areas on posts, pages, and area-served (local)
 * pages. Defined once with an OR'd location rule to keep the `name` unique.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the related practice-areas field.
 *
 * @return void
 */
function pps_register_related_fields() {
	acf_add_local_field_group(
		array(
			'key'      => 'group_pps_related',
			'title'    => __( 'Related Practice Areas', 'pug-puggle-schema' ),
			'fields'   => array(
				array(
					'key'           => 'field_pps_related_practice_areas',
					'label'         => __( 'Practice Areas', 'pug-puggle-schema' ),
					'name'          => 'practice_areas',
					'type'          => 'relationship',
					'instructions'  => __( 'Hand-picked practice areas surfaced by the sidebar widget.', 'pug-puggle-schema' ),
					'post_type'     => array( 'practice-area' ),
					'filters'       => array( 'search' ),
					'return_format' => 'object',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'post',
					),
				),
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
					),
				),
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
