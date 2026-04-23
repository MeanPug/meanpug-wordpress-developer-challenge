<?php
/**
 * CPT: attorney
 *
 * Bios for each lawyer at the firm. Linked to practice_area via the
 * `practice-area-group` taxonomy and to `office` via post meta.
 *
 * @package pnp
 */

add_action( 'init', function () {
	register_post_type( 'attorney', array(
		'labels' => array(
			'name'               => __( 'Attorneys', 'pnp' ),
			'singular_name'      => __( 'Attorney', 'pnp' ),
			'menu_name'          => __( 'Attorneys', 'pnp' ),
			'add_new_item'       => __( 'Add New Attorney', 'pnp' ),
			'edit_item'          => __( 'Edit Attorney', 'pnp' ),
			'new_item'           => __( 'New Attorney', 'pnp' ),
			'view_item'          => __( 'View Attorney', 'pnp' ),
			'search_items'       => __( 'Search Attorneys', 'pnp' ),
			'not_found'          => __( 'No attorneys found', 'pnp' ),
			'not_found_in_trash' => __( 'No attorneys in trash', 'pnp' ),
		),
		'public'        => true,
		'has_archive'   => 'attorneys',
		'menu_icon'     => 'dashicons-businessperson',
		'menu_position' => 20,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields', 'page-attributes' ),
		'taxonomies'    => array( 'practice-area-group', 'attorney-position', 'region' ),
		'rewrite'       => array( 'slug' => 'attorneys', 'with_front' => false ),
		'show_in_rest'  => true,
		'rest_base'     => 'attorneys',
	) );
} );
