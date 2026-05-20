<?php
/**
 * Cached query helpers for the `office` CPT.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Queries;

/**
 * Returns transient-cached lists of office post IDs.
 *
 * @package PugPuggle
 */
class Offices {

	private const TRANSIENT_PREFIX = 'pp_q_off_';

	/**
	 * Hook cache invalidation callbacks.
	 *
	 * @return void
	 */
	public static function register(): void {
		add_action( 'save_post_office', [ self::class, 'flush' ] );
		add_action( 'delete_post', [ self::class, 'flush' ] );
		add_action( 'edited_area-served', [ self::class, 'flush' ] );
		add_action( 'delete_area-served', [ self::class, 'flush' ] );
	}

	/**
	 * Return cached list of every published office.
	 *
	 * @return array<int>
	 */
	public static function all(): array {
		$key = self::TRANSIENT_PREFIX . 'all';

		$cached = get_transient( $key );
		if ( false !== $cached ) {
			return (array) $cached;
		}

		$query_args = [
			'post_type'      => 'office',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'orderby'        => 'title',
			'order'          => 'ASC',
		];

		$ids = ( new \WP_Query( $query_args ) )->posts;

		set_transient( $key, $ids, HOUR_IN_SECONDS );

		return (array) $ids;
	}

	/**
	 * Return cached list of office card IDs.
	 *
	 * @param array<string, mixed> $args limit, area_served.
	 * @return array<int>
	 */
	public static function cards( array $args = [] ): array {
		$defaults = [
			'limit'       => 6,
			'area_served' => '',
		];

		$args = array_merge( $defaults, $args );
		$key  = self::TRANSIENT_PREFIX . 'cards_' . md5( wp_json_encode( $args ) );

		$cached = get_transient( $key );
		if ( false !== $cached ) {
			return (array) $cached;
		}

		$query_args = [
			'post_type'      => 'office',
			'post_status'    => 'publish',
			'posts_per_page' => (int) $args['limit'],
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'orderby'        => [
				'menu_order' => 'ASC',
				'title'      => 'ASC',
			],
		];

		if ( ! empty( $args['area_served'] ) ) {
			$query_args['tax_query'] = [ // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				[
					'taxonomy' => 'area-served',
					'field'    => is_numeric( $args['area_served'] ) ? 'term_id' : 'slug',
					'terms'    => $args['area_served'],
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
