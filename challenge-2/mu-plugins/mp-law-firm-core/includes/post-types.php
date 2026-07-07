<?php
/**
 * Registers the custom post types for the law firm content model.
 *
 * @package MeanPugLawFirmCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Builds reusable labels for a custom post type.
 *
 * @param string $singular Singular label.
 * @param string $plural   Plural label.
 * @return array
 */
function mp_law_firm_core_get_post_type_labels( $singular, $plural ) {
	return array(
		'name'                  => _x( $plural, 'Post type general name', 'mp-law-firm-core' ),
		'singular_name'         => _x( $singular, 'Post type singular name', 'mp-law-firm-core' ),
		'menu_name'             => _x( $plural, 'Admin Menu text', 'mp-law-firm-core' ),
		'name_admin_bar'        => _x( $singular, 'Add New on Toolbar', 'mp-law-firm-core' ),
		'add_new'               => __( 'Add New', 'mp-law-firm-core' ),
		'add_new_item'          => sprintf( __( 'Add New %s', 'mp-law-firm-core' ), $singular ),
		'new_item'              => sprintf( __( 'New %s', 'mp-law-firm-core' ), $singular ),
		'edit_item'             => sprintf( __( 'Edit %s', 'mp-law-firm-core' ), $singular ),
		'view_item'             => sprintf( __( 'View %s', 'mp-law-firm-core' ), $singular ),
		'all_items'             => sprintf( __( 'All %s', 'mp-law-firm-core' ), $plural ),
		'search_items'          => sprintf( __( 'Search %s', 'mp-law-firm-core' ), $plural ),
		'not_found'             => sprintf( __( 'No %s found.', 'mp-law-firm-core' ), strtolower( $plural ) ),
		'not_found_in_trash'    => sprintf( __( 'No %s found in Trash.', 'mp-law-firm-core' ), strtolower( $plural ) ),
		'featured_image'        => sprintf( __( '%s Image', 'mp-law-firm-core' ), $singular ),
		'set_featured_image'    => sprintf( __( 'Set %s image', 'mp-law-firm-core' ), strtolower( $singular ) ),
		'remove_featured_image' => sprintf( __( 'Remove %s image', 'mp-law-firm-core' ), strtolower( $singular ) ),
		'use_featured_image'    => sprintf( __( 'Use as %s image', 'mp-law-firm-core' ), strtolower( $singular ) ),
	);
}

/**
 * Registers law firm custom post types.
 *
 * The post type keys intentionally align with common law firm content models
 * and the existing theme schema hooks where applicable.
 *
 * @return void
 */
function mp_law_firm_core_register_post_types() {
	$post_types = array(
		'attorney'      => array(
			'singular'     => 'Attorney',
			'plural'       => 'Attorneys',
			'menu_icon'    => 'dashicons-businessperson',
			'rewrite_slug' => 'attorneys',
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		),
		'practice-area' => array(
			'singular'     => 'Practice Area',
			'plural'       => 'Practice Areas',
			'menu_icon'    => 'dashicons-portfolio',
			'rewrite_slug' => 'practice-areas',
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		),
		'case-result'   => array(
			'singular'     => 'Case Result',
			'plural'       => 'Case Results',
			'menu_icon'    => 'dashicons-awards',
			'rewrite_slug' => 'case-results',
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		),
		'testimonials'  => array(
			'singular'     => 'Testimonial',
			'plural'       => 'Testimonials',
			'menu_icon'    => 'dashicons-format-quote',
			'rewrite_slug' => 'testimonials',
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		),
		'office'        => array(
			'singular'     => 'Location',
			'plural'       => 'Locations',
			'menu_icon'    => 'dashicons-location-alt',
			'rewrite_slug' => 'locations',
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		),
		'faq'           => array(
			'singular'     => 'FAQ',
			'plural'       => 'FAQs',
			'menu_icon'    => 'dashicons-editor-help',
			'rewrite_slug' => 'faqs',
			'supports'     => array( 'title', 'editor', 'revisions' ),
		),
	);

	foreach ( $post_types as $post_type => $config ) {
		register_post_type(
			$post_type,
			array(
				'labels'             => mp_law_firm_core_get_post_type_labels( $config['singular'], $config['plural'] ),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'show_in_rest'       => true,
				'query_var'          => true,
				'rewrite'            => array(
					'slug'       => $config['rewrite_slug'],
					'with_front' => false,
				),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 20,
				'menu_icon'          => $config['menu_icon'],
				'supports'           => $config['supports'],
			)
		);
	}
}
add_action( 'init', 'mp_law_firm_core_register_post_types' );