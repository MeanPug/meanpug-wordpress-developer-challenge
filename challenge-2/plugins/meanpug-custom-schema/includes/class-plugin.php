<?php
declare( strict_types=1 );

namespace MeanPug\CustomSchema;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Plugin {

    private static ?Plugin $instance = null;

    public static function get_instance(): static {
        if ( null === static::$instance ) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    private function __construct() {}

    public function init(): void {
        $this->load_dependencies();
        $this->register_hooks();
    }

    private function load_dependencies(): void {
        require_once MEANPUG_SCHEMA_DIR . 'includes/class-activator.php';
        require_once MEANPUG_SCHEMA_DIR . 'includes/class-post-types.php';
        require_once MEANPUG_SCHEMA_DIR . 'includes/class-taxonomies.php';
        require_once MEANPUG_SCHEMA_DIR . 'includes/class-meta-boxes.php';
        require_once MEANPUG_SCHEMA_DIR . 'includes/class-database.php';
        require_once MEANPUG_SCHEMA_DIR . 'includes/class-rest-api.php';
    }

    private function register_hooks(): void {
        $post_types = new Post_Types();
        add_action( 'init', [ $post_types, 'register' ] );

        $taxonomies = new Taxonomies();
        add_action( 'init', [ $taxonomies, 'register' ] );

        $meta_boxes = new Meta_Boxes();
        add_action( 'add_meta_boxes', [ $meta_boxes, 'register' ] );
        add_action( 'save_post', [ $meta_boxes, 'save' ], 10, 2 );

        $database = new Database();
        add_action( 'init', [ $database, 'init' ] );

        $rest_api = new Rest_API();
        add_action( 'rest_api_init', [ $rest_api, 'register_routes' ] );

        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_assets' ] );
    }

    public function enqueue_admin_assets( string $hook ): void {
        $allowed_hooks = [ 'post.php', 'post-new.php' ];

        if ( ! in_array( $hook, $allowed_hooks, true ) ) {
            return;
        }

        wp_enqueue_style(
            'meanpug-admin',
            MEANPUG_SCHEMA_URL . 'assets/css/admin.css',
            [],
            MEANPUG_SCHEMA_VERSION
        );

        wp_enqueue_script(
            'meanpug-admin',
            MEANPUG_SCHEMA_URL . 'assets/js/admin.js',
            [ 'jquery' ],
            MEANPUG_SCHEMA_VERSION,
            true
        );
    }
}