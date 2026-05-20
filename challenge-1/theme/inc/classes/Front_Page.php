<?php
/**
 * Front_Page class
 *
 * @package Airpnp
 */

namespace Airpnp;

/**
 * Front page listing-card data layer.
 *
 * Performs a single lightweight WP_Query, caches the shaped result in a
 * transient, and busts the cache on any post lifecycle event (save, trash,
 * untrash, delete).
 *
 * @package Airpnp
 */
class Front_Page {

	const TRANSIENT_KEY = 'airpnp_front_cards';
	const TTL           = HOUR_IN_SECONDS;

	/**
	 * Return shaped listing-card data for the front-page grid.
	 *
	 * @param int $limit Max cards to return. Default 3.
	 * @return array<int, array{id:int, title:string, permalink:string, thumb:string|false}>
	 */
	public static function get_listing_cards( int $limit = 3 ): array {
		$cached = get_transient( self::TRANSIENT_KEY );
		if ( false !== $cached ) {
			return $cached;
		}

		$q = new \WP_Query(
			array(
				'post_type'              => 'post',
				'posts_per_page'         => $limit,
				'no_found_rows'          => true,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false,
				'fields'                 => 'ids',
				'ignore_sticky_posts'    => true,
			)
		);

		$cards = array_map(
			fn( $id ) => array(
				'id'        => (int) $id,
				'title'     => get_the_title( $id ),
				'permalink' => get_permalink( $id ),
				'thumb'     => get_the_post_thumbnail_url( $id, 'medium_large' ),
			),
			$q->posts
		);

		set_transient( self::TRANSIENT_KEY, $cards, self::TTL );
		return $cards;
	}

	/**
	 * Invalidate the listing-card transient on any post lifecycle event.
	 */
	public static function bust_cache(): void {
		delete_transient( self::TRANSIENT_KEY );
	}
}

add_action( 'save_post', array( 'Airpnp\\Front_Page', 'bust_cache' ) );
add_action( 'deleted_post', array( 'Airpnp\\Front_Page', 'bust_cache' ) );
add_action( 'trashed_post', array( 'Airpnp\\Front_Page', 'bust_cache' ) );
add_action( 'untrashed_post', array( 'Airpnp\\Front_Page', 'bust_cache' ) );
