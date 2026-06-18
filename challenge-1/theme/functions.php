<?php
/**
 * GW Blocks Theme
 * 
 * @package GWBlueprint
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
	exit;
}

// Define theme constants
define('GWBLUEPRINT_VERSION', time());
define('GWBLUEPRINT_THEME_DIR', get_template_directory());
define('GWBLUEPRINT_THEME_URI', get_template_directory_uri());

require_once('gw/gw-core/gw-custom-blocks/gw-custom-blocks.php');
require_once('gw/gw-core/included-blocks.php');
require_once('gw/gw-core-version.php');
require_once('gw/gw-updater.php');

require_once('inc/helpers.php');
require_once('inc/theme-blocks.php');

/**
 * Theme Setup
 * 
 * @since 1.0.0
 */
function theme_setup() {
	// Make theme available for translation
	load_theme_textdomain('gwblueprint', GWBLUEPRINT_THEME_DIR . '/languages');
	
	// Add theme support for various features
	add_theme_support('post-thumbnails');
	add_theme_support('core-block-patterns');
	add_theme_support('title-tag');

	add_theme_support('custom-logo', array(
		'height'		=> 100,
		'width'			=> 400,
		'flex-height'	=> true,
		'flex-width'	=> true,
	));

	add_theme_support('html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	));

	//REGISTER MENUS
	register_nav_menus(array(
		'header_menu'	=> __('Header Menu', 'gwblueprint'),
		'footer_menu'	=> __('Footer Menu', 'gwblueprint'),
	));
}
add_action('after_setup_theme', 'theme_setup');

/**
 * Register Block Pattern Categories
 * 
 * @since 1.0.0
 */
function theme_register_pattern_categories() {
	// Ensure posts category exists for Query Loop patterns
	if (function_exists('register_block_pattern_category')) {
		register_block_pattern_category(
			'posts',
			array('label' => __('Posts', 'gwblueprint'))
		);
	}
}
add_action('init', 'theme_register_pattern_categories');

/**
 * Enqueue scripts and styles
 * 
 * @since 1.0.0
 */
function theme_scripts() {
	// Main CSS
	wp_enqueue_style('bootstrap', GWBLUEPRINT_THEME_URI . '/assets/lib/bootstrap/bootstrap-grid.min.css',array(),'5.2');
	wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css', array(), '9.4.1', 'all');
	wp_enqueue_style('magnific-popup', GWBLUEPRINT_THEME_URI . '/assets/lib/magnific-popup/magnific-popup.css', array(), '1.1.0');
	wp_enqueue_style('main', GWBLUEPRINT_THEME_URI . '/assets/css/main.css', array(), GWBLUEPRINT_VERSION);

	// Main JS
	wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js', array('jquery'), '9.4.1', true);
	wp_enqueue_script('magnific-popup', GWBLUEPRINT_THEME_URI . '/assets/lib/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), '1.1.0', true);
	wp_enqueue_script('main', GWBLUEPRINT_THEME_URI . '/assets/js/main.js', array('jquery', 'swiper'), GWBLUEPRINT_VERSION, array('strategy'  => 'defer','in_footer' => true));
}
add_action('wp_enqueue_scripts', 'theme_scripts');
