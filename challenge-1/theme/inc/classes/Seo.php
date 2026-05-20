<?php
/**
 * Seo class
 *
 * @package Airpnp
 */

namespace Airpnp;

/**
 * Front-page SEO output: description, canonical, Open Graph, Twitter card.
 *
 * Only emits tags on the front page so other templates keep their defaults.
 *
 * @package Airpnp
 */
class Seo {

	/**
	 * Output meta tags in `<head>` for the front page only.
	 *
	 * @return void
	 */
	public static function head(): void {
		if ( ! is_front_page() ) {
			return;
		}

		$title       = get_bloginfo( 'name' );
		$description = get_bloginfo( 'description' )
			? get_bloginfo( 'description' )
			: __( 'Find unique places to stay with AirPnP, the pug-powered home rental.', 'inf' );
		$image       = esc_url( get_stylesheet_directory_uri() . '/assets/images/airpnp-pug.png' );
		$canonical   = esc_url( home_url( '/' ) );
		?>
		<meta name="description" content="<?php echo esc_attr( $description ); ?>">
		<link rel="canonical" href="<?php echo $canonical; ?>">
		<meta property="og:type" content="website">
		<meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
		<meta property="og:description" content="<?php echo esc_attr( $description ); ?>">
		<meta property="og:url" content="<?php echo $canonical; ?>">
		<meta property="og:image" content="<?php echo $image; ?>">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>">
		<meta name="twitter:description" content="<?php echo esc_attr( $description ); ?>">
		<meta name="twitter:image" content="<?php echo $image; ?>">
		<?php
	}
}

add_action( 'wp_head', array( 'Airpnp\\Seo', 'head' ) );
