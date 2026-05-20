<?php
/**
 * Office custom post type.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Cpt;

/**
 * Registers the `office` CPT.
 *
 * @package PugPuggle
 */
class Office extends Base {

	/**
	 * Return the CPT slug.
	 *
	 * @return string
	 */
	protected static function slug(): string {
		return 'office';
	}

	/**
	 * Return the `register_post_type` args.
	 *
	 * @return array<string, mixed>
	 */
	protected static function args(): array {
		return [
			'labels'        => [
				'name'               => __( 'Offices', 'inf' ),
				'singular_name'      => __( 'Office', 'inf' ),
				'menu_name'          => __( 'Offices', 'inf' ),
				'name_admin_bar'     => __( 'Office', 'inf' ),
				'add_new'            => __( 'Add New', 'inf' ),
				'add_new_item'       => __( 'Add New Office', 'inf' ),
				'new_item'           => __( 'New Office', 'inf' ),
				'edit_item'          => __( 'Edit Office', 'inf' ),
				'view_item'          => __( 'View Office', 'inf' ),
				'all_items'          => __( 'All Offices', 'inf' ),
				'search_items'       => __( 'Search Offices', 'inf' ),
				'not_found'          => __( 'No offices found.', 'inf' ),
				'not_found_in_trash' => __( 'No offices found in Trash.', 'inf' ),
			],
			'public'        => true,
			'has_archive'   => 'offices',
			'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt', 'revisions' ],
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-location-alt',
			'rewrite'       => [
				'slug'       => 'offices',
				'with_front' => false,
			],
			'menu_position' => 22,
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
			'location'       => __( 'City / State', 'inf' ),
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

		if ( 'location' === $column ) {
			$city  = function_exists( 'get_field' ) ? (string) get_field( 'city', $post_id ) : '';
			$state = function_exists( 'get_field' ) ? (string) get_field( 'state', $post_id ) : '';

			if ( '' === $city && '' === $state && function_exists( 'get_field' ) ) {
				$address = get_field( 'address', $post_id );
				if ( is_array( $address ) ) {
					$city  = isset( $address['city'] ) ? (string) $address['city'] : '';
					$state = isset( $address['state'] ) ? (string) $address['state'] : '';
				}
			}

			$parts = array_filter( [ $city, $state ] );
			echo esc_html( ! empty( $parts ) ? implode( ', ', $parts ) : '—' );
		}
	}
}
