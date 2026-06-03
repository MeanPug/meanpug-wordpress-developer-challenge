<?php
/**
 * PHPUnit bootstrap for infra theme tests.
 *
 * Requires the WordPress test suite (WP_TESTS_DIR) to be configured.
 * If not available, provides a minimal bootstrap for unit-level tests
 * that don't need a full WordPress environment.
 */

$wp_tests_dir = getenv( 'WP_TESTS_DIR' );

if ( $wp_tests_dir && file_exists( $wp_tests_dir . '/includes/functions.php' ) ) {
    require_once $wp_tests_dir . '/includes/functions.php';
    require_once $wp_tests_dir . '/includes/bootstrap.php';
} else {
    // Minimal bootstrap for tests that don't need WordPress
    if ( ! defined( 'ABSPATH' ) ) {
        define( 'ABSPATH', dirname( __DIR__ ) . '/' );
    }
}
