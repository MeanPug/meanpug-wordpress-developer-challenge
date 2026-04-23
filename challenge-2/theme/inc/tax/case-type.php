<?php
/**
 * Taxonomy: case-type
 *
 * Distinct from practice-area-group — a case type is the specific
 * procedural classification (Verdict, Settlement, Arbitration Award,
 * Appellate Win) that shapes how a result is presented.
 *
 * @package pnp
 */

add_action( 'init', function () {
	register_taxonomy( 'case-type', array( 'case_result' ), array(
		'labels' => array(
			'name'          => __( 'Case Types', 'pnp' ),
			'singular_name' => __( 'Case Type', 'pnp' ),
			'menu_name'     => __( 'Case Types', 'pnp' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'case-type', 'with_front' => false ),
	) );
} );
