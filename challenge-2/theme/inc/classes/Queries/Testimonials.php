<?php
/**
 * Cached query helpers for the `testimonials` CPT.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Queries;

/**
 * Returns transient-cached lists of testimonial post IDs.
 *
 * @package PugPuggle
 */
class Testimonials {

	private const TRANSIENT_PREFIX = 'pp_q_tes_';

	/**
	 * Hook cache invalidation callbacks.
	 *
	 * @return void
	 */
	public static function register(): void {
		add_action( 'save_post_testimonials', [ self::class, 'flush' ] );
		add_action( 'delete_post', [ self::class, 'flush' ] );
	}

	/**
	 * Return cached list of recent testimonial IDs.
	 *
	 * @param array<string, mixed> $args limit, practice_area.
	 * @return array<int>
	 */
	public static function recent( array $args = [] ): array {
		$defaults = [
			'limit'         => 6,
			'practice_area' => 0,
		];

		$args = array_merge( $defaults, $args );
		$key  = self::TRANSIENT_PREFIX . 'recent_' . md5( wp_json_encode( $args ) );

		$cached = get_transient( $key );
		if ( false !== $cached ) {
			return (array) $cached;
		}

		$query_args = [
			'post_type'      => 'testimonials',
			'post_status'    => 'publish',
			'posts_per_page' => (int) $args['limit'],
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'orderby'        => 'date',
			'order'          => 'DESC',
		];

		if ( ! empty( $args['practice_area'] ) ) {
			$query_args['meta_query'] = [ // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				[
					'key'     => 'practice_area',
					'value'   => (int) $args['practice_area'],
					'compare' => '=',
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
