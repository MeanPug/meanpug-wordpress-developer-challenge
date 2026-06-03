<?php
/**
 * Plugin Name: MeanPug Custom Schema
 * Plugin URI:  https://github.com/MeanPug/meanpug-wordpress-developer-challenge
 * Description: Custom post types, taxonomies, and data structures for the Law Firm of Pug and Puggle, ESQ.
 * Version:     1.0.0
 * Author:      Andres Guevara
 * License:     GPL-2.0-or-later
 * Text Domain: meanpug-custom-schema
 */

declare( strict_types=1 );

namespace MeanPug\CustomSchema;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'MEANPUG_SCHEMA_VERSION', '1.0.0' );
define( 'MEANPUG_SCHEMA_FILE', __FILE__ );
define( 'MEANPUG_SCHEMA_DIR', plugin_dir_path( __FILE__ ) );
define( 'MEANPUG_SCHEMA_URL', plugin_dir_url( __FILE__ ) );

spl_autoload_register( function ( string $class ): void {
    $prefix   = 'MeanPug\\CustomSchema\\';
    $base_dir = MEANPUG_SCHEMA_DIR . 'includes/';

    if ( ! str_starts_with( $class, $prefix ) ) {
        return;
    }

    $relative = substr( $class, strlen( $prefix ) );
    $file     = $base_dir . 'class-' . strtolower( str_replace( '\\', '-', $relative ) ) . '.php';

    if ( file_exists( $file ) ) {
        require_once $file;
    }
} );

register_activation_hook( __FILE__, [ Activator::class, 'activate' ] );
register_deactivation_hook( __FILE__, [ Activator::class, 'deactivate' ] );

add_action( 'plugins_loaded', function (): void {
    Plugin::get_instance()->init();
} );