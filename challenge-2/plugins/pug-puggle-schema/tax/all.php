<?php
/**
 * Custom Taxonomy registrations.
 *
 * Each taxonomy has its own file mirroring the inc/cpt/ pattern.
 * The built-in `category` taxonomy is attached to practice-area and
 * local via their CPT registrations (see inc/cpt/practice-area.php
 * and inc/cpt/local.php), so it is not redeclared here.
 *
 * @package infra
 */

require_once __DIR__ . '/area-served.php';
require_once __DIR__ . '/faq-category.php';
require_once __DIR__ . '/attorney-role.php';
