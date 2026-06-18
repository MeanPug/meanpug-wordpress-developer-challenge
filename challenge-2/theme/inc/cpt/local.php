<?php
/**
 * Local / Areas Served CPT.
 *
 * Geo landing pages. `inc/services/locations.php` and the location-navigator
 * module/widget query `post_type = 'local'` filtered by the `content_type`
 * meta = "Area Served", then read the ACF `geopoint` ({lat,lng}) for distance
 * matching. Hierarchical because the navigator groups areas by parent (state
 * -> city) via `wp_get_post_parent_id()`.
 *
 * @package infra
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the `local` post type.
 *
 * @return void
 */
function inf_register_local_cpt() {
	inf_register_post_type(
		'local',
		esc_html__( 'Location', 'inf' ),
		esc_html__( 'Locations', 'inf' ),
		array(
			'hierarchical' => true,
			'menu_icon'    => 'dashicons-location-alt',
			'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
			'rewrite'      => array( 'slug' => 'locations' ),
			'labels'       => array(
				'menu_name' => esc_html__( 'Locations', 'inf' ),
				'all_items' => esc_html__( 'All Locations', 'inf' ),
			),
		)
	);
}
add_action( 'init', 'inf_register_local_cpt' );
