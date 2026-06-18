<?php
/**
 * Team (Attorneys) CPT.
 *
 * Attorney profiles. The theme already references this content type as `team`:
 * `inc/utils/posts.php` maps `'team' => 'Attorney'`, `single.php` wires the
 * `attorney-sidebar` / `attorney-header` for it, and
 * `inc/widgets/practice-areas.php` branches on `is_singular('team')`. The user
 * <-> attorney link is the ACF `team_profile` user field.
 *
 * Slug is intentionally `team` (not `attorney`) to honour the theme's existing
 * expectations — see brief decision notes in the theme README.
 *
 * @package infra
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the `team` post type.
 *
 * @return void
 */
function inf_register_team_cpt() {
	inf_register_post_type(
		'team',
		esc_html__( 'Attorney', 'inf' ),
		esc_html__( 'Attorneys', 'inf' ),
		array(
			'menu_icon' => 'dashicons-groups',
			// Headshot = featured image; bio = editor; role/email/phone = ACF.
			'supports'  => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
			'rewrite'   => array( 'slug' => 'attorneys' ),
		)
	);
}
add_action( 'init', 'inf_register_team_cpt' );
