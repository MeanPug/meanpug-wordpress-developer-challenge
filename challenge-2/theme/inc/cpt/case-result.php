<?php
/**
 * CPT: case_result
 *
 * A tracked win/settlement shown on the "Results" archive and on
 * practice-area pages. Amount + case-type drive sorting / filtering.
 *
 * @package pnp
 */

add_action( 'init', function () {
	register_post_type( 'case_result', array(
		'labels' => array(
			'name'               => __( 'Case Results', 'pnp' ),
			'singular_name'      => __( 'Case Result', 'pnp' ),
			'menu_name'          => __( 'Case Results', 'pnp' ),
			'add_new_item'       => __( 'Add New Case Result', 'pnp' ),
			'edit_item'          => __( 'Edit Case Result', 'pnp' ),
			'new_item'           => __( 'New Case Result', 'pnp' ),
			'view_item'          => __( 'View Case Result', 'pnp' ),
			'search_items'       => __( 'Search Case Results', 'pnp' ),
			'not_found'          => __( 'No case results found', 'pnp' ),
			'not_found_in_trash' => __( 'No case results in trash', 'pnp' ),
		),
		'public'        => true,
		'has_archive'   => 'results',
		'menu_icon'     => 'dashicons-awards',
		'menu_position' => 22,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields' ),
		'taxonomies'    => array( 'case-type', 'practice-area-group', 'region' ),
		'rewrite'       => array( 'slug' => 'results', 'with_front' => false ),
		'show_in_rest'  => true,
		'rest_base'     => 'case-results',
	) );
} );
