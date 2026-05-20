<?php
/**
 * Testimonial custom post type.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Cpt;

/**
 * Registers the `testimonials` CPT.
 *
 * The slug is intentionally plural to remain compatible with the existing
 * review-sync hook that writes to this post type.
 *
 * @package PugPuggle
 */
class Testimonial extends Base {

	/**
	 * Return the CPT slug.
	 *
	 * @return string
	 */
	protected static function slug(): string {
		return 'testimonials';
	}

	/**
	 * Return the `register_post_type` args.
	 *
	 * @return array<string, mixed>
	 */
	protected static function args(): array {
		return [
			'labels'        => [
				'name'               => __( 'Testimonials', 'inf' ),
				'singular_name'      => __( 'Testimonial', 'inf' ),
				'menu_name'          => __( 'Testimonials', 'inf' ),
				'name_admin_bar'     => __( 'Testimonial', 'inf' ),
				'add_new'            => __( 'Add New', 'inf' ),
				'add_new_item'       => __( 'Add New Testimonial', 'inf' ),
				'new_item'           => __( 'New Testimonial', 'inf' ),
				'edit_item'          => __( 'Edit Testimonial', 'inf' ),
				'view_item'          => __( 'View Testimonial', 'inf' ),
				'all_items'          => __( 'All Testimonials', 'inf' ),
				'search_items'       => __( 'Search Testimonials', 'inf' ),
				'not_found'          => __( 'No testimonials found.', 'inf' ),
				'not_found_in_trash' => __( 'No testimonials found in Trash.', 'inf' ),
			],
			'public'        => true,
			'has_archive'   => 'testimonials',
			'supports'      => [ 'title', 'editor', 'thumbnail' ],
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-format-quote',
			'rewrite'       => [
				'slug'       => 'testimonials',
				'with_front' => false,
			],
			'menu_position' => 23,
		];
	}

	/**
	 * Declare extra admin list-table columns.
	 *
	 * @return array<string, string>
	 */
	protected static function admin_columns(): array {
		return [
			'rating' => __( 'Rating', 'inf' ),
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
		if ( 'rating' === $column ) {
			$rating = get_field( 'rating', $post_id );
			echo esc_html( ! empty( $rating ) ? (string) $rating : '—' );
		}
	}
}
