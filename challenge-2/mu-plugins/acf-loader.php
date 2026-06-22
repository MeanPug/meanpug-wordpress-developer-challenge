<?php
/**
 * Plugin Name: ACF Loader
 * Description: Boots the Composer-installed Advanced Custom Fields as a must-use plugin so the infra theme's get_field() calls work with no manual activation.
 * Author: Alfredo Prince
 * Version: 1.0.0
 *
 * @package PugPuggleSchema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$acf_bootstrap = __DIR__ . '/advanced-custom-fields/acf.php';

if ( file_exists( $acf_bootstrap ) && ! class_exists( 'ACF' ) ) {
	// ACF cannot resolve its own asset URL from inside mu-plugins, so point it
	// at the bundled copy explicitly (per ACF's documented mu-plugin setup).
	if ( ! defined( 'PPS_ACF_URL' ) ) {
		define( 'PPS_ACF_URL', content_url( '/mu-plugins/advanced-custom-fields/' ) );
	}

	include_once $acf_bootstrap;

	add_filter(
		'acf/settings/url',
		function () {
			return PPS_ACF_URL;
		}
	);
}
