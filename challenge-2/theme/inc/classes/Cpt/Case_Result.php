<?php
/**
 * Case Result custom post type.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Cpt;

/**
 * Registers the `case-result` CPT.
 *
 * @package PugPuggle
 */
class Case_Result extends Base {

	/**
	 * Return the CPT slug.
	 *
	 * @return string
	 */
	protected static function slug(): string {
		return 'case-result';
	}

	/**
	 * Return the `register_post_type` args.
	 *
	 * @return array<string, mixed>
	 */
	protected static function args(): array {
		return [
			'labels'        => [
				'name'               => __( 'Case Results', 'inf' ),
				'singular_name'      => __( 'Case Result', 'inf' ),
				'menu_name'          => __( 'Case Results', 'inf' ),
				'name_admin_bar'     => __( 'Case Result', 'inf' ),
				'add_new'            => __( 'Add New', 'inf' ),
				'add_new_item'       => __( 'Add New Case Result', 'inf' ),
				'new_item'           => __( 'New Case Result', 'inf' ),
				'edit_item'          => __( 'Edit Case Result', 'inf' ),
				'view_item'          => __( 'View Case Result', 'inf' ),
				'all_items'          => __( 'All Case Results', 'inf' ),
				'search_items'       => __( 'Search Case Results', 'inf' ),
				'not_found'          => __( 'No case results found.', 'inf' ),
				'not_found_in_trash' => __( 'No case results found in Trash.', 'inf' ),
			],
			'public'        => true,
			'has_archive'   => 'case-results',
			'supports'      => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-awards',
			'rewrite'       => [
				'slug'       => 'case-results',
				'with_front' => false,
			],
			'menu_position' => 24,
		];
	}

	/**
	 * Declare extra admin list-table columns.
	 *
	 * @return array<string, string>
	 */
	protected static function admin_columns(): array {
		return [
			'amount_display' => __( 'Amount', 'inf' ),
			'result_type'    => __( 'Result Type', 'inf' ),
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
		if ( 'amount_display' === $column ) {
			$amount = get_field( 'amount_display', $post_id );
			echo esc_html( ! empty( $amount ) ? (string) $amount : '—' );
			return;
		}

		if ( 'result_type' === $column ) {
			$result_type = get_field( 'result_type', $post_id );
			echo esc_html( ! empty( $result_type ) ? (string) $result_type : '—' );
		}
	}
}
