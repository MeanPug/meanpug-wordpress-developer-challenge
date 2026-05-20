<?php
/**
 * Practice Area custom post type.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Cpt;

/**
 * Registers the `practice-area` CPT.
 *
 * @package PugPuggle
 */
class Practice_Area extends Base {

	/**
	 * Return the CPT slug.
	 *
	 * @return string
	 */
	protected static function slug(): string {
		return 'practice-area';
	}

	/**
	 * Return the `register_post_type` args.
	 *
	 * @return array<string, mixed>
	 */
	protected static function args(): array {
		return [
			'labels'        => [
				'name'               => __( 'Practice Areas', 'inf' ),
				'singular_name'      => __( 'Practice Area', 'inf' ),
				'menu_name'          => __( 'Practice Areas', 'inf' ),
				'name_admin_bar'     => __( 'Practice Area', 'inf' ),
				'add_new'            => __( 'Add New', 'inf' ),
				'add_new_item'       => __( 'Add New Practice Area', 'inf' ),
				'new_item'           => __( 'New Practice Area', 'inf' ),
				'edit_item'          => __( 'Edit Practice Area', 'inf' ),
				'view_item'          => __( 'View Practice Area', 'inf' ),
				'all_items'          => __( 'All Practice Areas', 'inf' ),
				'search_items'       => __( 'Search Practice Areas', 'inf' ),
				'not_found'          => __( 'No practice areas found.', 'inf' ),
				'not_found_in_trash' => __( 'No practice areas found in Trash.', 'inf' ),
				'parent_item_colon'  => __( 'Parent Practice Area:', 'inf' ),
			],
			'public'        => true,
			'hierarchical'  => true,
			'has_archive'   => 'practice-areas',
			'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'revisions' ],
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-portfolio',
			'rewrite'       => [
				'slug'       => 'practice-areas',
				'with_front' => false,
			],
			'menu_position' => 20,
		];
	}

	/**
	 * Declare extra admin list-table columns.
	 *
	 * @return array<string, string>
	 */
	protected static function admin_columns(): array {
		return [
			'featured_image' => __( 'Image', 'inf' ),
		];
	}

	/**
	 * Render the admin column value for a single post.
	 *
	 * @param string $column  Column key.
	 * @param int    $post_id Post ID.
	 * @return void
	 */
	public static function render_admin_column( string $column, int $post_id ): void {
		if ( 'featured_image' === $column ) {
			echo wp_kses_post( get_the_post_thumbnail( $post_id, [ 60, 60 ] ) );
		}
	}
}
