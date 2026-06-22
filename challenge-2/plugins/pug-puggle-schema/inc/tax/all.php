<?php
/**
 * Custom taxonomy loader.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/area-served.php';
require_once __DIR__ . '/attorney-role.php';

/**
 * Register every Pug & Puggle taxonomy.
 *
 * Hooked on `init` at priority 9 — a hair before the post types (priority 10) so
 * the object-type relationships are guaranteed to be in place when the CPTs
 * reference them.
 *
 * @return void
 */
function pps_register_taxonomies() {
	pps_register_area_served_taxonomy();
	pps_register_attorney_role_taxonomy();
}
add_action( 'init', 'pps_register_taxonomies', 9 );
