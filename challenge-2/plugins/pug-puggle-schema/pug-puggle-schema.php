<?php
/**
 * Plugin Name:       Pug & Puggle, ESQ — Content Schema
 * Plugin URI:        https://github.com/MeanPug/meanpug-wordpress-developer-challenge
 * Description:       Registers the custom post types, taxonomies, and ACF field groups that power the Pug & Puggle, ESQ. personal-injury firm — and, not coincidentally, every structured-data hook the infra theme already barks for. Content models that outlive the theme.
 * Version:           1.0.0
 * Requires at least: 5.9
 * Requires PHP:      7.0
 * Author:            Alfredo Prince
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       pug-puggle-schema
 *
 * @package PugPuggleSchema
 */

// No direct access — good boys stay off the table.
defined( 'ABSPATH' ) || exit;

define( 'PPS_VERSION', '1.0.0' );
define( 'PPS_PLUGIN_FILE', __FILE__ );
define( 'PPS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/*
 * Load the content models.
 *
 * Order matters only for human readers — every registrar below hooks into `init`,
 * so WordPress fires them at the right moment regardless of require order.
 */
require_once PPS_PLUGIN_DIR . 'inc/helpers.php';
require_once PPS_PLUGIN_DIR . 'inc/cpt/all.php';
require_once PPS_PLUGIN_DIR . 'inc/tax/all.php';
require_once PPS_PLUGIN_DIR . 'inc/fields/all.php';

/**
 * Flush rewrite rules on activation so our pretty permalinks resolve immediately.
 *
 * We register the post types and taxonomies first because `flush_rewrite_rules()`
 * only knows about rewrite tags that exist at the moment it runs.
 *
 * @return void
 */
function pps_activate() {
	pps_register_taxonomies();
	pps_register_post_types();
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'pps_activate' );

/**
 * Clean up rewrite rules on deactivation so we don't leave dangling routes behind.
 *
 * @return void
 */
function pps_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pps_deactivate' );

/**
 * Load the plugin's translations.
 *
 * @return void
 */
function pps_load_textdomain() {
	load_plugin_textdomain( 'pug-puggle-schema', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'init', 'pps_load_textdomain' );
