<?php
/**
 * Cached query helpers for the `area-served` taxonomy.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Queries;

/**
 * Returns transient-cached lists of area-served term IDs.
 *
 * @package PugPuggle
 */
class Area_Served {

	private const TRANSIENT_PREFIX = 'pp_q_area_';

	/**
	 * Hook cache invalidation callbacks.
	 *
	 * @return void
	 */
	public static function register(): void {
		add_action( 'edited_area-served', [ self::class, 'flush' ] );
		add_action( 'delete_area-served', [ self::class, 'flush' ] );
		add_action( 'created_area-served', [ self::class, 'flush' ] );
		add_action( 'save_post_office', [ self::class, 'flush' ] );
		add_action( 'save_post_attorney', [ self::class, 'flush' ] );
		add_action( 'save_post_practice-area', [ self::class, 'flush' ] );
		add_action( 'delete_post', [ self::class, 'flush' ] );
	}

	/**
	 * Return every area-served term ID, alphabetical.
	 *
	 * @return array<int>
	 */
	public static function all(): array {
		$key    = self::TRANSIENT_PREFIX . 'all';
		$cached = get_transient( $key );
		if ( false !== $cached ) {
			return (array) $cached;
		}

		$terms = get_terms(
			[
				'taxonomy'   => 'area-served',
				'orderby'    => 'name',
				'order'      => 'ASC',
				'hide_empty' => false,
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
