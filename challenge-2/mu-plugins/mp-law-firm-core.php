<?php
/**
 * Plugin Name: MeanPug Law Firm Core
 * Description: Core content model for the Law Firm of Pug and Puggle, ESQ.
 * Author: Daniel Pulgarin
 * Version: 1.0.0
 *
 * @package MeanPugLawFirmCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'MP_LAW_FIRM_CORE_PATH', plugin_dir_path( __FILE__ ) . 'mp-law-firm-core/' );

$mp_law_firm_core_files = array(
	'includes/post-types.php',
	'includes/taxonomies.php',
	'includes/meta.php',
	'includes/acf-fields.php',
	'includes/helpers.php',
);

foreach ( $mp_law_firm_core_files as $file ) {
	$file_path = MP_LAW_FIRM_CORE_PATH . $file;

	if ( file_exists( $file_path ) ) {
		require_once $file_path;
	}
}