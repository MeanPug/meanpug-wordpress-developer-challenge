<?php
/**
 * Office post type.
 *
 * Each office is a physical location and drives a LocalBusiness/LegalService
 * schema block via mp_generate_office_schema() (it reads the `address` and
 * `geopoint` ACF groups defined in inc/fields/office.php). is_singular( 'office' )
 * in the theme's hooks.php is what routes that schema.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the `office` post type.
 *
 * @return void
 */
function pps_register_office_cpt() {
	register_post_type(
		'office',
		array(
			'labels'        => pps_post_type_labels(
				__( 'Office', 'pug-puggle-schema' ),
				__( 'Offices', 'pug-puggle-schema' )
			),
			'public'        => true,
			'hierarchical'  => false,
			'has_archive'   => true,
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-building',
			'menu_position' => 23,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'revisions' ),
			'rewrite'       => array(
				'slug'       => 'offices',
				'with_front' => false,
			),
			'taxonomies'    => array( 'area-served' ),
		)
	);
}
