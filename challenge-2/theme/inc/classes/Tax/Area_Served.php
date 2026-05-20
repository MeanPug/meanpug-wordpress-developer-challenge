<?php
/**
 * Area Served taxonomy.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Tax;

/**
 * Registers the `area-served` taxonomy.
 *
 * @package PugPuggle
 */
class Area_Served extends Base {

	/**
	 * Return the taxonomy slug.
	 *
	 * @return string
	 */
	protected static function slug(): string {
		return 'area-served';
	}

	/**
	 * Return the post type slugs this taxonomy attaches to.
	 *
	 * @return array<int, string>
	 */
	protected static function object_types(): array {
		return [ 'practice-area', 'office', 'attorney' ];
	}

	/**
	 * Return the `register_taxonomy` args.
	 *
	 * @return array<string, mixed>
	 */
	protected static function args(): array {
		return [
			'labels'            => [
				'name'                  => __( 'Areas Served', 'inf' ),
				'singular_name'         => __( 'Area Served', 'inf' ),
				'menu_name'             => __( 'Areas Served', 'inf' ),
				'all_items'             => __( 'All Areas Served', 'inf' ),
				'parent_item'           => __( 'Parent Area Served', 'inf' ),
				'parent_item_colon'     => __( 'Parent Area Served:', 'inf' ),
				'new_item_name'         => __( 'New Area Served Name', 'inf' ),
				'add_new_item'          => __( 'Add New Area Served', 'inf' ),
				'edit_item'             => __( 'Edit Area Served', 'inf' ),
				'update_item'           => __( 'Update Area Served', 'inf' ),
				'view_item'             => __( 'View Area Served', 'inf' ),
				'search_items'          => __( 'Search Areas Served', 'inf' ),
				'not_found'             => __( 'No areas served found.', 'inf' ),
				'no_terms'              => __( 'No areas served', 'inf' ),
				'items_list_navigation' => __( 'Areas served list navigation', 'inf' ),
				'items_list'            => __( 'Areas served list', 'inf' ),
				'back_to_items'         => __( '&larr; Back to Areas Served', 'inf' ),
			],
			'public'            => true,
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => [
				'slug'       => 'areas-served',
				'with_front' => false,
			],
		];
	}
}
