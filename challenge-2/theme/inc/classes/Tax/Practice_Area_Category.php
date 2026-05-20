<?php
/**
 * Practice Area Category taxonomy.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Tax;

/**
 * Registers the `practice-area-category` taxonomy.
 *
 * @package PugPuggle
 */
class Practice_Area_Category extends Base {

	/**
	 * Return the taxonomy slug.
	 *
	 * @return string
	 */
	protected static function slug(): string {
		return 'practice-area-category';
	}

	/**
	 * Return the post type slugs this taxonomy attaches to.
	 *
	 * @return array<int, string>
	 */
	protected static function object_types(): array {
		return [ 'practice-area' ];
	}

	/**
	 * Return the `register_taxonomy` args.
	 *
	 * @return array<string, mixed>
	 */
	protected static function args(): array {
		return [
			'labels'            => [
				'name'                  => __( 'Practice Area Categories', 'inf' ),
				'singular_name'         => __( 'Practice Area Category', 'inf' ),
				'menu_name'             => __( 'Categories', 'inf' ),
				'all_items'             => __( 'All Practice Area Categories', 'inf' ),
				'parent_item'           => __( 'Parent Practice Area Category', 'inf' ),
				'parent_item_colon'     => __( 'Parent Practice Area Category:', 'inf' ),
				'new_item_name'         => __( 'New Practice Area Category Name', 'inf' ),
				'add_new_item'          => __( 'Add New Practice Area Category', 'inf' ),
				'edit_item'             => __( 'Edit Practice Area Category', 'inf' ),
				'update_item'           => __( 'Update Practice Area Category', 'inf' ),
				'view_item'             => __( 'View Practice Area Category', 'inf' ),
				'search_items'          => __( 'Search Practice Area Categories', 'inf' ),
				'not_found'             => __( 'No practice area categories found.', 'inf' ),
				'no_terms'              => __( 'No practice area categories', 'inf' ),
				'items_list_navigation' => __( 'Practice area categories list navigation', 'inf' ),
				'items_list'            => __( 'Practice area categories list', 'inf' ),
				'back_to_items'         => __( '&larr; Back to Practice Area Categories', 'inf' ),
			],
			'public'            => true,
			'hierarchical'      => true,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => [
				'slug'       => 'practice-area-category',
				'with_front' => false,
			],
		];
	}
}
