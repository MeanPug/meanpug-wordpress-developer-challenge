<?php
/**
 * Plugin Name: Pug & Puggle — Schema
 * Description: Custom post types and taxonomies for the Pug & Puggle, ESQ. site. Lives as a plugin (not in the theme) so the content schema survives a theme switch — data outlives presentation.
 * Author: MeanPug
 * Version: 1.0.0
 *
 * Why a plugin instead of theme code:
 *   - Decouples content schema from theme: swap the theme freely without
 *     losing post types, taxonomies, or stored content.
 *   - Industry-standard pattern for content infrastructure.
 *
 * Activation: handled by docker/wordpress/init.sh on first `docker compose up`,
 * via `wp plugin activate pug-puggle-schema`.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/cpt/all.php';
require_once __DIR__ . '/tax/all.php';
