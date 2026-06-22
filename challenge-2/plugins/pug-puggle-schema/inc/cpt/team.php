<?php
/**
 * Team (Attorney) post type.
 *
 * Internally keyed `team`, but it speaks to humans as "Attorney" — exactly the
 * canonical mapping the theme already declares in inc/utils/posts.php. single.php
 * swaps in the `attorney-sidebar` / `attorney-header` widget areas for it.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the `team` post type.
 *
 * @return void
 */
function pps_register_team_cpt() {
	register_post_type(
		'team',
		array(
			'labels'        => pps_post_type_labels(
				__( 'Attorney', 'pug-puggle-schema' ),
				__( 'Attorneys', 'pug-puggle-schema' )
			),
			'public'        => true,
			'hierarchical'  => false,
			'has_archive'   => true,
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-businessperson',
			'menu_position' => 22,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
			'rewrite'       => array(
				'slug'       => 'attorneys',
				'with_front' => false,
			),
			'taxonomies'    => array( 'attorney-role' ),
		)
	);
}
