<?php
/**
 * CPT Loader
 *
 * Requires all Custom Post Type registration files.
 * Order matters only where one CPT depends on another's slug existing first —
 * there are no such dependencies here, so alphabetical order is fine.
 *
 * To add a new CPT: create `inc/cpt/{slug}.php` and require it here.
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/attorney.php';
require_once __DIR__ . '/career.php';
require_once __DIR__ . '/case-result.php';
require_once __DIR__ . '/faq.php';
require_once __DIR__ . '/office.php';
require_once __DIR__ . '/practice-area.php';
require_once __DIR__ . '/testimonials.php';
