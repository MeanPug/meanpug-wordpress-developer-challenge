<?php
/**
 * Cached query helpers for the `attorney-specialty` taxonomy.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Queries;

/**
 * Returns transient-cached lists of attorney-specialty term IDs.
 *
 * @package PugPuggle
 */
class Attorney_Specialty {

	private const TRANSIENT_PREFIX = 'pp_q_attspec_';

	/**
	 * Hook cache invalidation callbacks.
	 *
	 * @return void
	 */
	public static function register(): void {
		add_action( 'edited_attorney-specialty', [ self::class, 'flush' ] );
		add_action( 'delete_attorney-specialty', [ self::class, 'flush' ] );
		add_action( 'created_attorney-specialty', [ self::class, 'flush' ] );
		add_action( 'save_post_attorney', [ self::class, 'flush' ] );
		add_action( 'delete_post', [ self::class, 'flush' ] );
	}

	/**
	 * Return top-N specialty term IDs ranked by attorney count.
	 *
	 * @param int $limit Max number of term IDs to return.
	 * @return array<int>
	 */
	public static function popular( int $limit = 6 ): array {
		$key    = self::TRANSIENT_PREFIX . 'popular_' . $limit;
		$cached = get_transient( $key );
		if ( false !== $cached ) {
			return (array) $cached;
		}

		$terms = get_terms(
			[
				'taxonomy'   => 'attorney-specialty',
				'orderby'    => 'count',
				'order'      => 'DESC',
				'number'     => $limit,
				'hide_empty' => true,
				'fields'     => 'ids',
			]
		);

		$ids = is_wp_error( $terms ) ? [] : array_map( 'intval', (array) $terms );

		set_transient( $key, $ids, HOUR_IN_SECONDS );

		return $ids;
	}

	/**
	 * Delete all cached results for this query class.
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
