<?php
/**
 * Register custom taxonomies from CPT config.
 *
 * @package infra
 */

/**
 * @param array<string, mixed> $config Taxonomy config entry.
 * @return array<string, string>
 */
function inf_tax_labels( $config ) {
	$name          = $config['name'];
	$singular_name = $config['singular_name'] ?? $name;

	return array(
		'name'                       => $name,
		'singular_name'              => $singular_name,
		'menu_name'                  => $name,
		'search_items'               => sprintf( 'Search %s', $name ),
		'all_items'                  => sprintf( 'All %s', $name ),
		'parent_item'                => sprintf( 'Parent %s', $singular_name ),
		'parent_item_colon'          => sprintf( 'Parent %s:', $singular_name ),
		'edit_item'                  => sprintf( 'Edit %s', $singular_name ),
		'update_item'                => sprintf( 'Update %s', $singular_name ),
		'add_new_item'               => sprintf( 'Add New %s', $singular_name ),
		'new_item_name'              => sprintf( 'New %s Name', $singular_name ),
		'popular_items'              => sprintf( 'Popular %s', $name ),
		'separate_items_with_commas' => sprintf( 'Separate %s with commas', strtolower( $name ) ),
		'add_or_remove_items'        => sprintf( 'Add or remove %s', strtolower( $name ) ),
		'choose_from_most_used'      => sprintf( 'Choose from the most used %s', strtolower( $name ) ),
		'not_found'                  => sprintf( 'No %s found.', strtolower( $name ) ),
		'back_to_items'              => sprintf( '← Back to %s', $name ),
	);
}

/**
 * @param array<string, mixed> $tax_config Taxonomy config entry.
 * @param array<int, string>   $post_types Post type slugs.
 */
function inf_register_taxonomy_from_config( $tax_config, $post_types ) {
	register_taxonomy(
		$tax_config['slug'],
		$post_types,
		array(
			'labels'            => inf_tax_labels( $tax_config ),
			'hierarchical'      => $tax_config['hierarchical'] ?? true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => $tax_config['rewrite_slug'] ?? $tax_config['slug'],
				'with_front' => false,
			),
		)
	);
}

/**
 * Register all configured custom taxonomies.
 */
function inf_register_custom_taxonomies() {
	$configs = inf_post_types_config();

	foreach ( $configs as $cpt_config ) {
		if ( empty( $cpt_config['taxonomies'] ) ) {
			continue;
		}

		foreach ( $cpt_config['taxonomies'] as $tax_config ) {
			inf_register_taxonomy_from_config( $tax_config, array( $cpt_config['slug'] ) );
		}
	}

	inf_register_taxonomy_from_config(
		array(
			'name'          => 'Areas Served',
			'singular_name' => 'Area Served',
			'slug'          => 'area-served',
			'hierarchical'  => true,
		),
		array( 'local', 'practice-area' )
	);

	inf_register_taxonomy_from_config(
		array(
			'name'          => 'Event Types',
			'singular_name' => 'Event Type',
			'slug'          => 'event-type',
			'hierarchical'  => true,
		),
		array( 'post' )
	);
}
add_action( 'init', 'inf_register_custom_taxonomies', 0 );
