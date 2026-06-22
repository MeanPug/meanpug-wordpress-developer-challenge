<?php
/**
 * Area Served taxonomy.
 *
 * This is the taxonomy the theme has been quietly waiting for: the commented-out
 * tax_query in inc/services/locations.php expects `area-served` to tie practice
 * areas to their local counterparts (a "Car Accidents" page in "Tampa"). We
 * register it for real and attach it to the geo-aware post types.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the `area-served` taxonomy.
 *
 * @return void
 */
function pps_register_area_served_taxonomy() {
	register_taxonomy(
		'area-served',
		array( 'local', 'practice-area', 'office', 'case-result' ),
		array(
			'labels'            => pps_taxonomy_labels(
				__( 'Area Served', 'pug-puggle-schema' ),
				__( 'Areas Served', 'pug-puggle-schema' )
			),
			'public'            => true,
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => 'area-served',
				'with_front' => false,
			),
		)
	);
}
