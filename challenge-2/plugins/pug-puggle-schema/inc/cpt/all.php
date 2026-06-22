<?php
/**
 * Custom post type loader.
 *
 * One file per entity (greppable, individually disable-able, mirrors the theme's
 * own inc/widgets pattern). This loader wires them all to a single `init` hook.
 *
 * @package PugPuggleSchema
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/practice-area.php';
require_once __DIR__ . '/team.php';
require_once __DIR__ . '/office.php';
require_once __DIR__ . '/local.php';
require_once __DIR__ . '/testimonials.php';
require_once __DIR__ . '/case-result.php';

/**
 * Register every Pug & Puggle post type.
 *
 * Hooked on `init` for normal page loads, and called directly on plugin
 * activation (before flushing rewrite rules).
 *
 * @return void
 */
function pps_register_post_types() {
	pps_register_practice_area_cpt();
	pps_register_team_cpt();
	pps_register_office_cpt();
	pps_register_local_cpt();
	pps_register_testimonials_cpt();
	pps_register_case_result_cpt();
}
add_action( 'init', 'pps_register_post_types' );
