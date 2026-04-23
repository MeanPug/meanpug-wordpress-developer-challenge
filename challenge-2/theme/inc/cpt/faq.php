<?php
/**
 * CPT: faq
 *
 * Question + answer entries. Attached to one or more practice_area
 * posts (via meta) so each practice-area page can surface its own FAQ
 * block and emit FAQPage schema.
 *
 * @package pnp
 */

add_action( 'init', function () {
	register_post_type( 'faq', array(
		'labels' => array(
			'name'               => __( 'FAQs', 'pnp' ),
			'singular_name'      => __( 'FAQ', 'pnp' ),
			'menu_name'          => __( 'FAQs', 'pnp' ),
			'add_new_item'       => __( 'Add New FAQ', 'pnp' ),
			'edit_item'          => __( 'Edit FAQ', 'pnp' ),
			'new_item'           => __( 'New FAQ', 'pnp' ),
			'view_item'          => __( 'View FAQ', 'pnp' ),
			'search_items'       => __( 'Search FAQs', 'pnp' ),
			'not_found'          => __( 'No FAQs found', 'pnp' ),
			'not_found_in_trash' => __( 'No FAQs in trash', 'pnp' ),
		),
		// FAQs surface inside practice-area pages rather than having
		// their own canonical URL, so they're public-queryable but
		// don't render a single template of their own.
		'public'             => true,
		'publicly_queryable' => true,
		'has_archive'        => false,
		'menu_icon'          => 'dashicons-editor-help',
		'menu_position'      => 25,
		'supports'           => array( 'title', 'editor', 'revisions', 'custom-fields', 'page-attributes' ),
		'taxonomies'         => array( 'practice-area-group' ),
		'rewrite'            => array( 'slug' => 'faqs', 'with_front' => false ),
		'show_in_rest'       => true,
		'rest_base'          => 'faqs',
	) );
} );
