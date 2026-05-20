<?php
/**
 * Cached query helpers for the `practice-area` CPT.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Queries;

/**
 * Returns transient-cached lists of practice area post IDs.
 *
 * @package PugPuggle
 */
class Practice_Areas {

	private const TRANSIENT_PREFIX = 'pp_q_pa_';

	/**
	 * Hook cache invalidation callbacks.
	 *
	 * @return void
	 */
	public static function register(): void {
		add_action( 'save_post_practice-area', [ self::class, 'flush' ] );
		add_action( 'delete_post', [ self::class, 'flush' ] );
		add_action( 'edited_practice-area-category', [ self::class, 'flush' ] );
		add_action( 'delete_practice-area-category', [ self::class, 'flush' ] );
	}

	/**
	 * Return cached list of practice area card IDs.
	 *
	 * @param array<string, mixed> $args limit, category, parent.
	 * @return array<int>
	 */
	public static function cards( array $args = [] ): array {
		$defaults = [
			'limit'    => 6,
			'category' => '',
			'parent'   => null,
		];

		$args = array_merge( $defaults, $args );
		$key  = self::TRANSIENT_PREFIX . 'cards_' . md5( wp_json_encode( $args ) );

		$cached = get_transient( $key );
		if ( false !== $cached ) {
			return (array) $cached;
		}

		$query_args = [
			'post_type'      => 'practice-area',
			'post_status'    => 'publish',
			'posts_per_page' => (int) $args['limit'],
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'orderby'        => [
				'menu_order' => 'ASC',
				'title'      => 'ASC',
			],
		];

		if ( null !== $args['parent'] ) {
			$query_args['post_parent'] = (int) $args['parent'];
		}

		if ( ! empty( $args['category'] ) ) {
			$query_args['tax_query'] = [ // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				[
					'taxonomy' => 'practice-area-category',
					'field'    => is_numeric( $args['category'] ) ? 'term_id' : 'slug',
					'terms'    => $args['category'],
				],
			];
		}

		$ids = ( new \WP_Query( $query_args ) )->posts;

		set_transient( $key, $ids, HOUR_IN_SECONDS );

		return (array) $ids;
	}

	/**
	 * Delete all cached results for this query class.
	 *
	 * Uses a direct delete on options whose name matches our transient prefix.
	 *
	 * @return void
	 */
	public static function flush(): void {
		global $wpdb;

		// phpcs:ignore WordPress.DB.DirectDatabaseQuery
		$wpdb->query(
			$wpdb->prepare(
				"DELETE FROM {$wpdb->options} WHERE option_name LIKE %s OR option_name LIKE %s",
				$wpdb->esc_like( '_transient_' . self::TRANSIENT_PREFIX ) . '%',
				$wpdb->esc_like( '_transient_timeout_' . self::TRANSIENT_PREFIX ) . '%'
			)
		);
	}
}
