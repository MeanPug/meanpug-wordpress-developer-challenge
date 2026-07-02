<?php
/**
 * ACF Field Groups Loader
 *
 * Loads all ACF field group registration files.
 * All groups are registered via acf_add_local_field_group() — no UI clicks
 * required. The acf-json/ directory handles sync for the UI.
 *
 * Loading order: options page first (global fields), then CPT groups
 * alphabetically. The options page must exist before CPTs reference its fields.
 *
 * To add a new field group: create `inc/acf/{name}.php` and require it here.
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

// ACF must be active — bail silently if not.
if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
}

require_once __DIR__ . '/options.php';
require_once __DIR__ . '/attorney.php';
require_once __DIR__ . '/career.php';
require_once __DIR__ . '/case-result.php';
require_once __DIR__ . '/faq.php';
require_once __DIR__ . '/office.php';
require_once __DIR__ . '/practice-area.php';
require_once __DIR__ . '/testimonials.php';
