<?php
/**
 * FAQ custom post type.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Cpt;

/**
 * Registers the `faq` CPT.
 *
 * Admin-only: `public` is false, but `show_ui` / `show_in_menu` are true so
 * editors can manage entries without exposing a public archive or singular.
 *
 * @package PugPuggle
 */
class Faq extends Base {

	/**
	 * Return the CPT slug.
	 *
	 * @return string
	 */
	protected static function slug(): string {
		return 'faq';
	}

	/**
	 * Return the `register_post_type` args.
	 *
	 * @return array<string, mixed>
	 */
	protected static function args(): array {
		return [
			'labels'        => [
				'name'               => __( 'FAQs', 'inf' ),
				'singular_name'      => __( 'FAQ', 'inf' ),
				'menu_name'          => __( 'FAQs', 'inf' ),
				'name_admin_bar'     => __( 'FAQ', 'inf' ),
				'add_new'            => __( 'Add New', 'inf' ),
				'add_new_item'       => __( 'Add New FAQ', 'inf' ),
				'new_item'           => __( 'New FAQ', 'inf' ),
				'edit_item'          => __( 'Edit FAQ', 'inf' ),
				'view_item'          => __( 'View FAQ', 'inf' ),
				'all_items'          => __( 'All FAQs', 'inf' ),
				'search_items'       => __( 'Search FAQs', 'inf' ),
				'not_found'          => __( 'No FAQs found.', 'inf' ),
				'not_found_in_trash' => __( 'No FAQs found in Trash.', 'inf' ),
			],
			'public'        => false,
			'show_ui'       => true,
			'show_in_menu'  => true,
			'has_archive'   => false,
			'supports'      => [ 'title', 'editor' ],
			'show_in_rest'  => true,
			'menu_icon'     => 'dashicons-editor-help',
			'menu_position' => 25,
		];
	}
}
