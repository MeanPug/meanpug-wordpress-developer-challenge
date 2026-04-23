<?php
/**
 * infra / challenge-1-theme functions
 *
 * A slimmed-down functions file that keeps theme supports intact while
 * dropping third-party plugin dependencies (ACF, Gravity Forms, MP
 * internal modules) that aren't installed in the challenge environment.
 *
 * @package infra
 */

if ( ! function_exists( 'inf_setup' ) ) :
	function inf_setup() {
		load_theme_textdomain( 'inf', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		register_nav_menus( array(
			'nav'        => esc_html__( 'Nav', 'inf' ),
			'mobile-nav' => esc_html__( 'Mobile Nav', 'inf' ),
			'footer'     => esc_html__( 'Footer', 'inf' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'inf_setup' );

function inf_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'inf_content_width', 1200 );
}
add_action( 'after_setup_theme', 'inf_content_width', 0 );

function inf_scripts() {
	wp_enqueue_style( 'inf-theme-style', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
}
add_action( 'wp_enqueue_scripts', 'inf_scripts' );
