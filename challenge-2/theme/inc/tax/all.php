<?php
/**
 * Taxonomy Loader
 *
 * Requires all taxonomy registration files.
 * Taxonomies must be registered before CPTs that reference them — WordPress
 * handles this gracefully since both run on `init`, but alphabetical order
 * keeps things predictable.
 *
 * To add a new taxonomy: create `inc/tax/{slug}.php` and require it here.
 *
 * @package inf
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/attorney-specialty.php';
require_once __DIR__ . '/case-type.php';
require_once __DIR__ . '/faq-category.php';
require_once __DIR__ . '/jurisdiction.php';
require_once __DIR__ . '/language.php';
require_once __DIR__ . '/office-location.php';
require_once __DIR__ . '/practice-type.php';
