<?php
/**
 * mirror functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mirror
 */

define('ACF_EARLY_ACCESS', '5');

if ( ! function_exists( 'mirror_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mirror_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on MeanPug, use a find and replace
		 * to change 'mirror' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'mirror', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'mirror' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'mirror_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

        /**
         * Add Post Formats support
         *
         * @link https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
	}
endif;
add_action( 'after_setup_theme', 'mirror_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mirror_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'mirror_content_width', 640 );
}
add_action( 'after_setup_theme', 'mirror_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mirror_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'mirror' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'mirror' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'mirror_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function mirror_scripts() {
	global $wp_query;

	wp_enqueue_style( 'mirror-style', get_stylesheet_uri() );

	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Lora:400,400i|Questrial' );

	wp_enqueue_script( 'underscore', get_template_directory_uri() . '/assets/js/vendor/underscore-min.js', array(), '20151216', true );

	wp_enqueue_script( 'backbone', get_template_directory_uri() . '/assets/js/vendor/backbone-min.js', array( 'underscore' ), '20151216', true );

	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/assets/js/vendor/skip-link-focus-fix.js', array(), '20151216', true );

	wp_enqueue_script( 'mirror-core', get_template_directory_uri() . '/assets/js/src/core.js', array(), '20151216', true );
}
add_action( 'wp_enqueue_scripts', 'mirror_scripts' );

require_once __DIR__ . '/inc/cpt/all.php';
require_once __DIR__ . '/inc/fields/all.php';
