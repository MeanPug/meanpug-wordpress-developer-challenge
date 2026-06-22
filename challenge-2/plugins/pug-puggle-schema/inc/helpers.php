<?php
/**
 * Shared label builders.
 *
 * Personal injury firms have a lot of post types, and every one of them needs a
 * dozen-odd admin labels. Rather than copy/paste that boilerplate six times, we
 * generate it once. Greppable, translatable, and DRY.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

/**
 * Build a full set of post type labels from a singular/plural pair.
 *
 * @param string $singular Singular display name, e.g. "Attorney".
 * @param string $plural   Plural display name, e.g. "Attorneys".
 * @return array<string, string> Label array for register_post_type().
 */
function pps_post_type_labels( $singular, $plural ) {
	$lower_plural = strtolower( $plural );

	return array(
		'name'                  => $plural,
		'singular_name'         => $singular,
		'menu_name'             => $plural,
		'name_admin_bar'        => $singular,
		/* translators: %s: Post type singular name. */
		'add_new_item'          => sprintf( __( 'Add New %s', 'pug-puggle-schema' ), $singular ),
		/* translators: %s: Post type singular name. */
		'new_item'              => sprintf( __( 'New %s', 'pug-puggle-schema' ), $singular ),
		/* translators: %s: Post type singular name. */
		'edit_item'             => sprintf( __( 'Edit %s', 'pug-puggle-schema' ), $singular ),
		/* translators: %s: Post type singular name. */
		'view_item'             => sprintf( __( 'View %s', 'pug-puggle-schema' ), $singular ),
		/* translators: %s: Post type plural name. */
		'view_items'            => sprintf( __( 'View %s', 'pug-puggle-schema' ), $plural ),
		/* translators: %s: Post type plural name. */
		'all_items'             => sprintf( __( 'All %s', 'pug-puggle-schema' ), $plural ),
		/* translators: %s: Post type plural name. */
		'search_items'          => sprintf( __( 'Search %s', 'pug-puggle-schema' ), $plural ),
		/* translators: %s: Post type singular name. */
		'parent_item_colon'     => sprintf( __( 'Parent %s:', 'pug-puggle-schema' ), $singular ),
		/* translators: %s: Post type plural name, lowercased. */
		'not_found'             => sprintf( __( 'No %s found.', 'pug-puggle-schema' ), $lower_plural ),
		/* translators: %s: Post type plural name, lowercased. */
		'not_found_in_trash'    => sprintf( __( 'No %s found in Trash.', 'pug-puggle-schema' ), $lower_plural ),
		/* translators: %s: Post type plural name, lowercased. */
		'archives'              => sprintf( __( '%s Archives', 'pug-puggle-schema' ), $singular ),
		/* translators: %s: Post type singular name. */
		'featured_image'        => sprintf( __( '%s Image', 'pug-puggle-schema' ), $singular ),
		/* translators: %s: Post type singular name. */
		'set_featured_image'    => sprintf( __( 'Set %s image', 'pug-puggle-schema' ), $singular ),
	);
}

/**
 * Build a full set of taxonomy labels from a singular/plural pair.
 *
 * @param string $singular Singular display name, e.g. "Area Served".
 * @param string $plural   Plural display name, e.g. "Areas Served".
 * @return array<string, string> Label array for register_taxonomy().
 */
function pps_taxonomy_labels( $singular, $plural ) {
	return array(
		'name'              => $plural,
		'singular_name'     => $singular,
		'menu_name'         => $plural,
		/* translators: %s: Taxonomy plural name. */
		'all_items'         => sprintf( __( 'All %s', 'pug-puggle-schema' ), $plural ),
		/* translators: %s: Taxonomy singular name. */
		'edit_item'         => sprintf( __( 'Edit %s', 'pug-puggle-schema' ), $singular ),
		/* translators: %s: Taxonomy singular name. */
		'view_item'         => sprintf( __( 'View %s', 'pug-puggle-schema' ), $singular ),
		/* translators: %s: Taxonomy singular name. */
		'update_item'       => sprintf( __( 'Update %s', 'pug-puggle-schema' ), $singular ),
		/* translators: %s: Taxonomy singular name. */
		'add_new_item'      => sprintf( __( 'Add New %s', 'pug-puggle-schema' ), $singular ),
		/* translators: %s: Taxonomy singular name. */
		'new_item_name'     => sprintf( __( 'New %s Name', 'pug-puggle-schema' ), $singular ),
		/* translators: %s: Taxonomy plural name. */
		'search_items'      => sprintf( __( 'Search %s', 'pug-puggle-schema' ), $plural ),
		/* translators: %s: Taxonomy plural name, lowercased. */
		'not_found'         => sprintf( __( 'No %s found.', 'pug-puggle-schema' ), strtolower( $plural ) ),
	);
}
