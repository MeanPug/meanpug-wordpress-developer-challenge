<?php
/**
 * Practice Area post type.
 *
 * Hierarchical so areas can nest (e.g. "Car Accidents" → "Rideshare Accidents"),
 * which the theme's single.php "child topics explorer" and the practice-areas
 * widget both rely on. Drives the Product/Review schema in inc/utils/seo/schema.php
 * and is routed by archive.php (`is_post_type_archive( 'practice-area' )`).
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the `practice-area` post type.
 *
 * @return void
 */
function pps_register_practice_area_cpt() {
	register_post_type(
		'practice-area',
		array(
			'labels'       => pps_post_type_labels(
				__( 'Practice Area', 'pug-puggle-schema' ),
				__( 'Practice Areas', 'pug-puggle-schema' )
			),
			'public'       => true,
			'hierarchical' => true,
			'has_archive'  => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-portfolio',
			'menu_position' => 21,
			'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'revisions' ),
			'rewrite'      => array(
				'slug'       => 'practice-areas',
				'with_front' => false,
			),
			'taxonomies'   => array( 'area-served', 'category' ),
		)
	);
}
