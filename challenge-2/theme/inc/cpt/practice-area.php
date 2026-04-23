<?php
/**
 * CPT: practice_area
 *
 * One post per area of law the firm handles (personal injury, medical
 * malpractice, class actions, etc.). Hierarchical so sub-practices like
 * "Auto Accidents" can nest under "Personal Injury".
 *
 * @package pnp
 */

add_action( 'init', function () {
	register_post_type( 'practice_area', array(
		'labels' => array(
			'name'               => __( 'Practice Areas', 'pnp' ),
			'singular_name'      => __( 'Practice Area', 'pnp' ),
			'menu_name'          => __( 'Practice Areas', 'pnp' ),
			'add_new_item'       => __( 'Add New Practice Area', 'pnp' ),
			'edit_item'          => __( 'Edit Practice Area', 'pnp' ),
			'new_item'           => __( 'New Practice Area', 'pnp' ),
			'view_item'          => __( 'View Practice Area', 'pnp' ),
			'search_items'       => __( 'Search Practice Areas', 'pnp' ),
			'not_found'          => __( 'No practice areas found', 'pnp' ),
			'not_found_in_trash' => __( 'No practice areas in trash', 'pnp' ),
			'parent_item_colon'  => __( 'Parent Practice Area:', 'pnp' ),
		),
		'public'        => true,
		'has_archive'   => 'practice-areas',
		'hierarchical'  => true,
		'menu_icon'     => 'dashicons-portfolio',
		'menu_position' => 21,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'custom-fields', 'page-attributes' ),
		'taxonomies'    => array( 'practice-area-group', 'region' ),
		'rewrite'       => array( 'slug' => 'practice-areas', 'with_front' => false ),
		'show_in_rest'  => true,
		'rest_base'     => 'practice-areas',
	) );
} );
