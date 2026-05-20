<?php
/**
 * Abstract base class for custom post type registrars.
 *
 * Subclasses declare a slug and an args array; this base wires up the
 * standard `init` hook plus optional admin list-table column hooks via
 * late static binding so each subclass resolves its own configuration.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Cpt;

/**
 * Base CPT registrar.
 *
 * @package PugPuggle
 */
abstract class Base {

	/**
	 * Return the CPT slug.
	 *
	 * @return string
	 */
	abstract protected static function slug(): string;

	/**
	 * Return the `register_post_type` args.
	 *
	 * @return array<string, mixed>
	 */
	abstract protected static function args(): array;

	/**
	 * Declare extra admin list-table columns.
	 *
	 * Override in subclasses to return a map of column_key => column_label.
	 * The default implementation returns an empty array (no extra columns).
	 *
	 * @return array<string, string>
	 */
	protected static function admin_columns(): array {
		return [];
	}

	/**
	 * Hook the registrar onto WordPress.
	 *
	 * Registers the CPT on `init` and — if the subclass declares admin
	 * columns — also wires the list-table column filter and renderer.
	 *
	 * @return void
	 */
	public static function register(): void {
		add_action( 'init', [ static::class, 'do_register' ] );

		$columns = static::admin_columns();

		if ( is_array( $columns ) && ! empty( $columns ) ) {
			$slug = static::slug();

			add_filter(
				"manage_{$slug}_posts_columns",
				[ static::class, 'filter_admin_columns' ]
			);

			add_action(
				"manage_{$slug}_posts_custom_column",
				[ static::class, 'do_render_admin_column' ],
				10,
				2
			);
		}
	}

	/**
	 * Actually call `register_post_type` with the subclass's config.
	 *
	 * @return void
	 */
	public static function do_register(): void {
		register_post_type( static::slug(), static::args() );
	}

	/**
	 * Merge the subclass-declared admin columns into the default set.
	 *
	 * @param array<string, string> $columns Existing column map.
	 * @return array<string, string>
	 */
	public static function filter_admin_columns( $columns ): array {
		if ( ! is_array( $columns ) ) {
			$columns = [];
		}

		$extra = static::admin_columns();

		if ( ! is_array( $extra ) ) {
			return $columns;
		}

		return array_merge( $columns, $extra );
	}

	/**
	 * Dispatch the column render to the subclass.
	 *
	 * @param string $column  Column key.
	 * @param int    $post_id Post ID.
	 * @return void
	 */
	public static function do_render_admin_column( $column, $post_id ): void {
		if ( ! is_string( $column ) ) {
			return;
		}

		static::render_admin_column( $column, (int) $post_id );
	}

	/**
	 * Render a single admin column value.
	 *
	 * Default implementation is a no-op; subclasses override to emit markup.
	 *
	 * @param string $column  Column key.
	 * @param int    $post_id Post ID.
	 * @return void
	 */
	public static function render_admin_column( string $column, int $post_id ): void {
		unset( $column, $post_id );
	}
}
