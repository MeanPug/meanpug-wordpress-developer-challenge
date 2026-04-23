<?php
/**
 * Taxonomy: practice-area-group
 *
 * Groups practice areas into top-level buckets (e.g. "Personal Injury",
 * "Mass Torts", "Class Actions"). Also attached to attorneys, case
 * results, testimonials, and FAQs so the whole graph can be pivoted
 * by legal-service category.
 *
 * @package pnp
 */

add_action( 'init', function () {
	register_taxonomy( 'practice-area-group', array( 'practice_area', 'attorney', 'case_result', 'testimonial', 'faq' ), array(
		'labels' => array(
			'name'          => __( 'Practice-Area Groups', 'pnp' ),
			'singular_name' => __( 'Practice-Area Group', 'pnp' ),
			'menu_name'     => __( 'Groups', 'pnp' ),
			'add_new_item'  => __( 'Add Group', 'pnp' ),
			'edit_item'     => __( 'Edit Group', 'pnp' ),
		),
		'public'            => true,
		'hierarchical'      => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'practice-area-group', 'with_front' => false ),
	) );
} );
