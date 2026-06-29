<?php
/**
 * CPT configuration — config-driven registration.
 *
 * @package infra
 */

/**
 * @return array<int, array<string, mixed>>
 */
function inf_post_types_config() {
	return array(
		array(
			'name'          => 'Practice Areas',
			'singular_name' => 'Practice Area',
			'slug'          => 'practice-area',
			'dashicon'      => 'dashicons-hammer',
			'menu_position' => 5,
			'hierarchical'  => true,
			'has_archive'   => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'revisions' ),
			'rewrite'       => array(
				'slug'       => 'practice-area',
				'with_front' => false,
			),
			'taxonomies'    => array(
				array(
					'name'          => 'Practice Categories',
					'singular_name' => 'Practice Category',
					'slug'          => 'practice-category',
					'hierarchical'  => true,
				),
			),
		),
		array(
			'name'          => 'Attorneys',
			'singular_name' => 'Attorney',
			'slug'          => 'team',
			'dashicon'      => 'dashicons-businessman',
			'menu_position' => 6,
			'hierarchical'  => false,
			'has_archive'   => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author', 'revisions' ),
			'rewrite'       => array(
				'slug'       => 'attorney',
				'with_front' => false,
			),
			'taxonomies'    => array(
				array(
					'name'          => 'Attorney Departments',
					'singular_name' => 'Attorney Department',
					'slug'          => 'attorney-department',
					'hierarchical'  => true,
				),
			),
		),
		array(
			'name'          => 'Locals',
			'singular_name' => 'Local',
			'slug'          => 'local',
			'dashicon'      => 'dashicons-location',
			'menu_position' => 7,
			'hierarchical'  => true,
			'has_archive'   => true,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'revisions' ),
			'rewrite'       => array(
				'slug'       => 'local',
				'with_front' => false,
			),
		),
		array(
			'name'          => 'Testimonials',
			'singular_name' => 'Testimonial',
			'slug'          => 'testimonials',
			'dashicon'      => 'dashicons-format-quote',
			'menu_position' => 8,
			'hierarchical'  => false,
			'has_archive'   => true,
			'supports'      => array( 'title', 'editor', 'revisions' ),
			'rewrite'       => array(
				'slug'       => 'testimonials',
				'with_front' => false,
			),
			'taxonomies'    => array(
				array(
					'name'          => 'Testimonial Sources',
					'singular_name' => 'Testimonial Source',
					'slug'          => 'testimonial-source',
					'hierarchical'  => false,
				),
			),
		),
	);
}
