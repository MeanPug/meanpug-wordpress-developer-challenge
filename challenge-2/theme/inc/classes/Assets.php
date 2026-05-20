<?php
/**
 * Per-block asset enqueue helper.
 *
 * The auto-loader in `functions.php` registers a `blocks/{slug}-style` and
 * `blocks/{slug}-script` handle for every block under `theme/blocks/`. This
 * class exposes a tiny API that block render templates can call to promote
 * those registrations to enqueues — once per page, only when the block is
 * actually rendered.
 *
 * @package PugPuggle
 */

declare( strict_types = 1 );

namespace PugPuggle;

/**
 * Conditional, per-block asset enqueue manager.
 *
 * @package PugPuggle
 */
class Assets {

	/**
	 * Register WordPress hooks for the asset manager.
	 *
	 * Currently only wires an `init` placeholder so future global enqueues
	 * have a stable hook surface. Bootstrap calls this unconditionally.
	 *
	 * @return void
	 */
	public static function register(): void {
		add_action( 'init', [ self::class, 'on_init' ] );
	}

	/**
	 * Placeholder for global asset registration on `init`.
	 *
	 * @return void
	 */
	public static function on_init(): void {
		// Reserved for future global enqueues.
	}

	/**
	 * Enqueue the registered style and script handles for a single block.
	 *
	 * Block render templates call this with their block slug — e.g.
	 * `Assets::enqueue_block( 'hero' )` — to promote the auto-registered
	 * `blocks/hero-style` and `blocks/hero-script` handles to enqueues.
	 *
	 * @param string $block_slug The block directory slug under `theme/blocks/`.
	 * @return void
	 */
	public static function enqueue_block( string $block_slug ): void {
		$style_handle  = 'blocks/' . $block_slug . '-style';
		$script_handle = 'blocks/' . $block_slug . '-script';

		if ( wp_style_is( $style_handle, 'registered' ) ) {
			wp_enqueue_style( $style_handle );
		}

		if ( wp_script_is( $script_handle, 'registered' ) ) {
			wp_enqueue_script( $script_handle );
		}
	}
}
