<?php
/**
 * Attorney Specialty taxonomy.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Tax;

/**
 * Registers the `attorney-specialty` taxonomy.
 *
 * @package PugPuggle
 */
class Attorney_Specialty extends Base {

	/**
	 * Return the taxonomy slug.
	 *
	 * @return string
	 */
	protected static function slug(): string {
		return 'attorney-specialty';
	}

	/**
	 * Return the post type slugs this taxonomy attaches to.
	 *
	 * @return array<int, string>
	 */
	protected static function object_types(): array {
		return [ 'attorney' ];
	}

	/**
	 * Return the `register_taxonomy` args.
	 *
	 * @return array<string, mixed>
	 */
	protected static function args(): array {
		return [
			'labels'            => [
				'name'                       => __( 'Specialties', 'inf' ),
				'singular_name'              => __( 'Specialty', 'inf' ),
				'menu_name'                  => __( 'Specialties', 'inf' ),
				'all_items'                  => __( 'All Specialties', 'inf' ),
				'new_item_name'              => __( 'New Specialty Name', 'inf' ),
				'add_new_item'               => __( 'Add New Specialty', 'inf' ),
				'edit_item'                  => __( 'Edit Specialty', 'inf' ),
				'update_item'                => __( 'Update Specialty', 'inf' ),
				'view_item'                  => __( 'View Specialty', 'inf' ),
				'separate_items_with_commas' => __( 'Separate specialties with commas', 'inf' ),
				'add_or_remove_items'        => __( 'Add or remove specialties', 'inf' ),
				'choose_from_most_used'      => __( 'Choose from the most used specialties', 'inf' ),
				'popular_items'              => __( 'Popular Specialties', 'inf' ),
				'search_items'               => __( 'Search Specialties', 'inf' ),
				'not_found'                  => __( 'No specialties found.', 'inf' ),
				'no_terms'                   => __( 'No specialties', 'inf' ),
				'items_list_navigation'      => __( 'Specialties list navigation', 'inf' ),
				'items_list'                 => __( 'Specialties list', 'inf' ),
				'back_to_items'              => __( '&larr; Back to Specialties', 'inf' ),
			],
			'public'            => true,
			'hierarchical'      => false,
			'show_admin_column' => true,
			'show_in_rest'      => true,
			'rewrite'           => [
				'slug'       => 'attorney-specialty',
				'with_front' => false,
			],
		];
	}
}
