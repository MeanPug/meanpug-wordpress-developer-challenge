<?php
/**
 * Attorney custom post type.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Cpt;

/**
 * Registers the `attorney` CPT.
 *
 * @package PugPuggle
 */
class Attorney extends Base {

	/**
	 * Return the CPT slug.
	 *
	 * @return string
	 */
	protected static function slug(): string {
		return 'attorney';
	}

	/**
	 * Return the `register_post_type` args.
	 *
	 * @return array<string, mixed>
	 */
	protected static function args(): array {
		return [
			'labels'        => [
				'name'               => __( 'Attorneys', 'inf' ),
				'singular_name'      => __( 'Attorney', 'inf' ),
				'menu_name'          => __( 'Attorneys', 'inf' ),
				'name_admin_bar'     => __( 'Attorney', 'inf' ),
				'add_new'            => __( 'Add New', 'inf' ),
				'add_new_item'       => __( 'Add New Attorney', 'inf' ),
				'new_item'           => __( 'New Attorney', 'inf' ),
				'edit_item'          => __( 'Edit Attorney', 'inf' ),
				'view_item'          => __( 'View Attorney', 'inf' ),
				'all_items'          => __( 'All Attorneys', 'inf' ),
				'search_items'       => __( 'Search Attorneys', 'inf' ),
				'not_found'          => __( 'No attorneys found.', 'inf' ),
				'not_found_in_trash' => __( 'No attorneys found in Trash.', 'inf' ),
			],
			'public'        => true,
			'has_archive'   => 'attorneys',
			'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ],
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-businessperson',
			'rewrite'       => [
				'slug'       => 'attorneys',
				'with_front' => false,
			],
			'menu_position' => 21,
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
			'position'       => __( 'Position', 'inf' ),
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
			return;
		}

		if ( 'position' === $column ) {
			$position = get_field( 'position', $post_id );
			echo esc_html( ! empty( $position ) ? (string) $position : '—' );
		}
	}
}
