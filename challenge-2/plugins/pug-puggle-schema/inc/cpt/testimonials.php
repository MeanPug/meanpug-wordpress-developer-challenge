<?php
/**
 * Testimonials post type.
 *
 * Keyed `testimonials` (plural) because that is the exact string the theme uses
 * in hooks.php (`is_post_type_archive( 'testimonials' )`) and schema.php. Each
 * entry becomes a Schema.org Review via mp_generate_testimonial_schema(), which
 * reads the `reviewer` group and `rating` field from inc/fields/testimonials.php.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the `testimonials` post type.
 *
 * @return void
 */
function pps_register_testimonials_cpt() {
	register_post_type(
		'testimonials',
		array(
			'labels'        => pps_post_type_labels(
				__( 'Testimonial', 'pug-puggle-schema' ),
				__( 'Testimonials', 'pug-puggle-schema' )
			),
			'public'        => true,
			'hierarchical'  => false,
			'has_archive'   => true,
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-format-quote',
			'menu_position' => 25,
			'supports'      => array( 'title', 'editor', 'thumbnail', 'revisions' ),
			'rewrite'       => array(
				'slug'       => 'testimonials',
				'with_front' => false,
			),
		)
	);
}
