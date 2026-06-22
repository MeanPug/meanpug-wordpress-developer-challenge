<?php
/**
 * Local (Area Served) post type.
 *
 * These are the geo landing pages — "Car Accident Lawyer in Tampa" and friends.
 * Hierarchical on purpose: the location-navigator module nests cities under
 * states via post_parent / get_children(). The theme queries these by the
 * `content_type` = "Area Served" meta and buckets them by the `area_type` field
 * (both defined in inc/fields/local.php), and the Haversine search in
 * inc/services/locations.php reads each post's `geopoint`.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the `local` post type.
 *
 * @return void
 */
function pps_register_local_cpt() {
	register_post_type(
		'local',
		array(
			'labels'        => pps_post_type_labels(
				__( 'Location', 'pug-puggle-schema' ),
				__( 'Locations', 'pug-puggle-schema' )
			),
			'public'        => true,
			'hierarchical'  => true,
			'has_archive'   => true,
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-location-alt',
			'menu_position' => 24,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'revisions' ),
			'rewrite'       => array(
				'slug'       => 'locations',
				'with_front' => false,
			),
			'taxonomies'    => array( 'area-served', 'category' ),
		)
	);
}
