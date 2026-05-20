<?php
/**
 * Assets class
 *
 * @package Airpnp
 */

namespace Airpnp;

/**
 * Conditional front-page asset enqueue + script localization for i18n strings.
 *
 * @package Airpnp
 */
class Assets {

	/**
	 * Enqueue compiled front-page CSS/JS only when serving the front page,
	 * and expose translation strings to the JS layer via wp_localize_script.
	 *
	 * @return void
	 */
	public static function enqueue(): void {
		if ( ! is_front_page() ) {
			return;
		}

		$theme_dir = get_stylesheet_directory();
		$theme_uri = get_stylesheet_directory_uri();

		$css_path = $theme_dir . '/front-page.css';
		$js_path  = $theme_dir . '/front-page.js';

		if ( file_exists( $css_path ) ) {
			wp_enqueue_style(
				'airpnp-front',
				$theme_uri . '/front-page.css',
				array(),
				filemtime( $css_path )
			);
		}

		if ( file_exists( $js_path ) ) {
			wp_enqueue_script(
				'airpnp-front',
				$theme_uri . '/front-page.js',
				array(),
				filemtime( $js_path ),
				true
			);

			wp_localize_script(
				'airpnp-front',
				'AIRPNP_I18N',
				array(
					'searchComingSoon' => __( 'Search coming soon 🐶', 'inf' ),
					'invalidDates'     => __( 'Check-out must be after check-in.', 'inf' ),
				)
			);
		}
	}
}

add_action( 'wp_enqueue_scripts', array( 'Airpnp\\Assets', 'enqueue' ), 20 );
