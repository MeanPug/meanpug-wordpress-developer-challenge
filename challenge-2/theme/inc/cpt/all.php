<?php
/**
 * Custom Post Type registration index.
 *
 * Registers the content model the `infra` theme already expects. The theme
 * references these post types throughout its services, widgets and templates
 * (e.g. `inc/services/locations.php`, `inc/widgets/practice-areas.php`,
 * `single.php`, `inc/utils/seo/schema.php`) but they were never registered.
 *
 * NOTE: This file only registers structures. No presentation logic lives here.
 *
 * @package infra
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Thin wrapper around register_post_type() that builds a sensible, consistent
 * label set from a singular/plural name so each CPT file stays declarative.
 *
 * @param string $slug      Post type key/slug (kebab-case, kept exactly as the theme expects).
 * @param string $singular  Human readable singular label (e.g. "Practice Area").
 * @param string $plural    Human readable plural label (e.g. "Practice Areas").
 * @param array  $overrides Arguments merged over (and overriding) the defaults.
 * @return WP_Post_Type|WP_Error
 */
function inf_register_post_type( $slug, $singular, $plural, array $overrides = array() ) {
	$labels = array(
		'name'                  => $plural,
		'singular_name'         => $singular,
		'menu_name'             => $plural,
		'name_admin_bar'        => $singular,
		'add_new'               => esc_html__( 'Add New', 'inf' ),
		/* translators: %s: singular post type label. */
		'add_new_item'          => sprintf( esc_html__( 'Add New %s', 'inf' ), $singular ),
		/* translators: %s: singular post type label. */
		'new_item'              => sprintf( esc_html__( 'New %s', 'inf' ), $singular ),
		/* translators: %s: singular post type label. */
		'edit_item'             => sprintf( esc_html__( 'Edit %s', 'inf' ), $singular ),
		/* translators: %s: singular post type label. */
		'view_item'             => sprintf( esc_html__( 'View %s', 'inf' ), $singular ),
		/* translators: %s: plural post type label. */
		'view_items'            => sprintf( esc_html__( 'View %s', 'inf' ), $plural ),
		/* translators: %s: plural post type label. */
		'all_items'             => sprintf( esc_html__( 'All %s', 'inf' ), $plural ),
		/* translators: %s: plural post type label. */
		'search_items'          => sprintf( esc_html__( 'Search %s', 'inf' ), $plural ),
		/* translators: %s: plural post type label. */
		'not_found'             => sprintf( esc_html__( 'No %s found.', 'inf' ), strtolower( $plural ) ),
		/* translators: %s: plural post type label. */
		'not_found_in_trash'    => sprintf( esc_html__( 'No %s found in Trash.', 'inf' ), strtolower( $plural ) ),
		'featured_image'        => esc_html__( 'Featured Image', 'inf' ),
		'set_featured_image'    => esc_html__( 'Set featured image', 'inf' ),
		'remove_featured_image' => esc_html__( 'Remove featured image', 'inf' ),
		'use_featured_image'    => esc_html__( 'Use as featured image', 'inf' ),
	);

	$defaults = array(
		'labels'       => $labels,
		'public'       => true,
		'show_ui'      => true,
		'show_in_menu' => true,
		'show_in_rest' => true, // Gutenberg + REST.
		'has_archive'  => true,
		'hierarchical' => false,
		'rewrite'      => array( 'slug' => $slug ),
		'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'menu_icon'    => 'dashicons-admin-post',
	);

	// Labels passed in $overrides should merge with, not clobber, the generated set.
	if ( isset( $overrides['labels'] ) ) {
		$overrides['labels'] = array_merge( $labels, $overrides['labels'] );
	}

	return register_post_type( $slug, array_merge( $defaults, $overrides ) );
}

require_once __DIR__ . '/practice-area.php';
require_once __DIR__ . '/testimonials.php';
require_once __DIR__ . '/local.php';
require_once __DIR__ . '/team.php';
require_once __DIR__ . '/office.php';
require_once __DIR__ . '/case-result.php';
