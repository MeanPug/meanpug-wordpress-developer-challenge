<?php
/**
 * Taxonomy: attorney-position
 *
 * Role at the firm — Partner, Managing Partner, Senior Associate,
 * Associate, Of Counsel, Paralegal. Drives sorting on the Attorneys
 * archive and the "Leadership" template.
 *
 * @package pnp
 */

add_action( 'init', function () {
	register_taxonomy( 'attorney-position', array( 'attorney' ), array(
		'labels' => array(
			'name'          => __( 'Positions', 'pnp' ),
			'singular_name' => __( 'Position', 'pnp' ),
			'menu_name'     => __( 'Positions', 'pnp' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'position', 'with_front' => false ),
	) );
} );
