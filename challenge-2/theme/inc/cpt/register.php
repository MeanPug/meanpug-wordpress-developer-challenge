<?php
/**
 * Register custom post types from config.
 *
 * @package infra
 */

/**
 * @param array<string, mixed> $config CPT config entry.
 * @return array<string, string>
 */
function inf_cpt_labels( $config ) {
	$name          = $config['name'];
	$singular_name = $config['singular_name'];

	return array(
		'name'               => $name,
		'singular_name'      => $singular_name,
		'menu_name'          => $name,
		'name_admin_bar'     => $singular_name,
		'add_new'            => sprintf( 'Add New %s', $singular_name ),
		'add_new_item'       => sprintf( 'Add New %s', $singular_name ),
		'new_item'           => sprintf( 'New %s', $singular_name ),
		'edit_item'          => sprintf( 'Edit %s', $singular_name ),
		'view_item'          => sprintf( 'View %s', $singular_name ),
		'all_items'          => sprintf( 'All %s', $name ),
		'search_items'       => sprintf( 'Search %s', $name ),
		'parent_item_colon'  => sprintf( 'Parent %s:', $singular_name ),
		'not_found'          => sprintf( 'No %s found.', strtolower( $name ) ),
		'not_found_in_trash' => sprintf( 'No %s found in Trash.', strtolower( $name ) ),
	);
}

/**
 * Register all configured custom post types.
 */
function inf_register_custom_post_types() {
	$configs = inf_post_types_config();

	foreach ( $configs as $config ) {
		register_post_type(
			$config['slug'],
			array(
				'labels'              => inf_cpt_labels( $config ),
				'public'              => true,
				'publicly_queryable'  => true,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_rest'        => true,
				'menu_icon'           => $config['dashicon'] ?? 'dashicons-admin-post',
				'menu_position'       => $config['menu_position'] ?? null,
				'hierarchical'        => $config['hierarchical'] ?? false,
				'has_archive'         => $config['has_archive'] ?? false,
				'rewrite'             => $config['rewrite'] ?? array( 'slug' => $config['slug'] ),
				'supports'            => $config['supports'] ?? array( 'title', 'editor' ),
				'capability_type'     => 'post',
				'exclude_from_search' => false,
			)
		);
	}
}
add_action( 'init', 'inf_register_custom_post_types' );

/**
 * Flush rewrite rules once after CPT registration changes.
 */
function inf_maybe_flush_rewrite_rules() {
	$flush_version = 3;

	if ( (int) get_option( 'inf_cpt_rewrite_flushed' ) >= $flush_version ) {
		return;
	}

	flush_rewrite_rules( false );
	update_option( 'inf_cpt_rewrite_flushed', $flush_version );
}
add_action( 'init', 'inf_maybe_flush_rewrite_rules', 20 );
