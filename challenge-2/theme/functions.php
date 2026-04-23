<?php
/**
 * Pug & Puggle, ESQ. — theme functions & schema loader
 *
 * @package pnp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PNP_THEME_DIR', get_template_directory() );

if ( ! function_exists( 'pnp_setup' ) ) :
	function pnp_setup() {
		load_theme_textdomain( 'pnp', PNP_THEME_DIR . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
		add_theme_support( 'custom-logo' );

		add_image_size( 'attorney-headshot-square', 720, 720, true );
		add_image_size( 'attorney-headshot-tall', 600, 800, true );
		add_image_size( 'practice-area-hero', 1600, 900, true );
		add_image_size( 'office-card', 800, 600, true );

		register_nav_menus( array(
			'primary'        => esc_html__( 'Primary Nav', 'pnp' ),
			'practice-areas' => esc_html__( 'Practice Areas Mega-Menu', 'pnp' ),
			'footer'         => esc_html__( 'Footer', 'pnp' ),
			'utility'        => esc_html__( 'Utility (Client Portal, Pay Bill)', 'pnp' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'pnp_setup' );

function pnp_enqueue_assets() {
	wp_enqueue_style( 'pnp-style', get_stylesheet_uri(), array(), filemtime( PNP_THEME_DIR . '/style.css' ) );
}
add_action( 'wp_enqueue_scripts', 'pnp_enqueue_assets' );

// Flush rewrite rules once on activation so CPT permalinks work.
register_activation_hook( __FILE__, function () {
	flush_rewrite_rules();
} );

// Schema / backend structure.
require_once PNP_THEME_DIR . '/inc/cpt/all.php';
require_once PNP_THEME_DIR . '/inc/tax/all.php';
require_once PNP_THEME_DIR . '/inc/meta/all.php';
require_once PNP_THEME_DIR . '/inc/meta/meta-boxes.php';
require_once PNP_THEME_DIR . '/inc/plugins/recommended.php';
require_once PNP_THEME_DIR . '/inc/rest/relationships.php';
