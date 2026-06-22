<?php
/**
 * Plugin Name: Pug & Puggle Schema Loader
 * Description: Must-use bootstrap that loads the Pug & Puggle schema plugin without manual activation.
 * Author: Alfredo Prince
 * Version: 1.0.0
 *
 * @package PugPuggleSchema
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$pps_plugin_file = WPMU_PLUGIN_DIR . '/pug-puggle-schema/pug-puggle-schema.php';

if ( file_exists( $pps_plugin_file ) && ! defined( 'PPS_VERSION' ) ) {
	require_once $pps_plugin_file;
}
