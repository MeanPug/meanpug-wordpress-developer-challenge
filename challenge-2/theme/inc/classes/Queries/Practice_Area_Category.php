<?php
/**
 * Cached query helpers for the `practice-area-category` taxonomy.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle\Queries;

/**
 * Returns transient-cached lists of practice-area-category terms.
 *
 * @package PugPuggle
 */
class Practice_Area_Category {

	private const TRANSIENT_PREFIX = 'pp_q_pacat_';

	/**
	 * Hook cache invalidation callbacks.
	 *
	 * @return void
	 */
	public static function register(): void {
		add_action( 'edited_practice-area-category', [ self::class, 'flush' ] );
		add_action( 'delete_practice-area-category', [ self::class, 'flush' ] );
		add_action( 'created_practice-area-category', [ self::class, 'flush' ] );
		add_action( 'save_post_practice-area', [ self::class, 'flush' ] );
		add_action( 'delete_post', [ self::class, 'flush' ] );
	}

	/**
	 * Return every category as `{id,count}` pairs, ordered alphabetically by name.
	 *
	 * @return array<array{id:int,count:int}>
	 */
	public static function all_with_counts(): array {
		$key    = self::TRANSIENT_PREFIX . 'all_with_counts';
		$cached = get_transient( $key );
		if ( false !== $cached ) {
			return (array) $cached;
		}

		$terms = get_terms(
			[
				'taxonomy'   => 'practice-area-category',
				'orderby'    => 'name',
				'order'      => 'ASC',
				'hide_empty' => false,
			]
		);

		$result = [];
		if ( ! is_wp_error( $terms ) ) {
			foreach ( (array) $terms as $term ) {
				$result[] = [
					'id'    => (int) $term->term_id,
					'count' => (int) $term->count,
				];
			}
		}

		set_transient( $key, $result, HOUR_IN_SECONDS );

		return $result;
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
