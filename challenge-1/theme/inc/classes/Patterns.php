<?php
/**
 * Patterns class
 *
 * @package Airpnp
 */

namespace Airpnp;

/**
 * Block-pattern registration.
 *
 * Patterns are pre-built block markup that editors can drop into a post via
 * the patterns inserter — letting non-technical users reuse the home-page
 * composition without writing block syntax by hand.
 *
 * @package Airpnp
 */
class Patterns {

	/**
	 * Register block patterns + a custom category.
	 *
	 * @return void
	 */
	public static function register(): void {
		if ( ! function_exists( 'register_block_pattern_category' ) || ! function_exists( 'register_block_pattern' ) ) {
			return;
		}

		register_block_pattern_category(
			'airpnp',
			array( 'label' => __( 'AirPnP', 'inf' ) )
		);

		register_block_pattern(
			'airpnp/home',
			array(
				'title'       => __( 'AirPnP Home Page', 'inf' ),
				'description' => __( 'Full Home Page composition: listing-cards grid.', 'inf' ),
				'categories'  => array( 'airpnp' ),
				'content'     => '<!-- wp:airpnp/listing-cards /-->',
			)
		);
	}

	/**
	 * Ensure the `child-theme-blocks` block category is registered through the
	 * modern `block_categories_all` filter.
	 *
	 * The theme's existing registration at `inc/hooks.php:4` uses the deprecated
	 * `block_categories` filter (replaced in WP 5.8 by `block_categories_all`),
	 * so WP 6.5+ silently drops it. Without the category, any block declaring
	 * `category: "child-theme-blocks"` in its block.json may be hidden from the
	 * inserter. Adding it through the modern filter is additive and idempotent
	 * — we leave the old hook in place to avoid touching unrelated code.
	 *
	 * @param array<int, array{slug:string, title:string}> $categories Existing categories.
	 * @return array<int, array{slug:string, title:string}>
	 */
	public static function register_block_categories( array $categories ): array {
		foreach ( $categories as $cat ) {
			if ( 'child-theme-blocks' === ( $cat['slug'] ?? '' ) ) {
				return $categories;
			}
		}
		$categories[] = array(
			'slug'  => 'child-theme-blocks',
			'title' => __( 'inf Formatting Blocks', 'inf' ),
		);
		return $categories;
	}
}

add_action( 'init', array( 'Airpnp\\Patterns', 'register' ) );
add_filter( 'block_categories_all', array( 'Airpnp\\Patterns', 'register_block_categories' ) );
