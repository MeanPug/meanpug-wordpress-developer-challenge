<?php
/**
 * Taxonomy: region
 *
 * Geographic scope (state, metro area, jurisdiction). Drives geo-
 * filtering across offices, attorneys, practice-area landing pages,
 * and case-result archives; also used by the LocalBusiness schema.
 *
 * @package pnp
 */

add_action( 'init', function () {
	register_taxonomy( 'region', array( 'office', 'attorney', 'practice_area', 'case_result', 'testimonial' ), array(
		'labels' => array(
			'name'          => __( 'Regions', 'pnp' ),
			'singular_name' => __( 'Region', 'pnp' ),
			'menu_name'     => __( 'Regions', 'pnp' ),
		),
		'public'            => true,
		'hierarchical'      => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'region', 'with_front' => false ),
	) );
} );
