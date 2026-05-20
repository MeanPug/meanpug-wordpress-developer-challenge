<?php
/**
 * Airpnp class loader (manual require, no composer).
 *
 * @package Airpnp
 */

$airpnp_classes = array(
	'Airpnp\\Front_Page' => __DIR__ . '/Front_Page.php',
	'Airpnp\\Assets'     => __DIR__ . '/Assets.php',
	'Airpnp\\Seo'        => __DIR__ . '/Seo.php',
	'Airpnp\\Patterns'   => __DIR__ . '/Patterns.php',
);

foreach ( $airpnp_classes as $class => $path ) {
	if ( ! class_exists( $class ) && is_readable( $path ) ) {
		require_once $path;
	}
}
unset( $airpnp_classes, $class, $path );
