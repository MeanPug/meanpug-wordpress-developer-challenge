<?php
/**
 * Taxonomy registration index.
 *
 * Registers the taxonomies the `infra` theme references. Only structure lives
 * here — no presentation logic.
 *
 * Relationship design note: the link between a `practice-area` and the other
 * content types (`team`, `testimonials`, `case-result`, `local`) is modelled
 * with the ACF `practice_areas` Relationship field, NOT a taxonomy, because the
 * theme already consumes it that way (`get_field('practice_areas', ...)` in
 * `inc/widgets/practice-areas.php`). See the theme README for the rationale.
 *
 * @package infra
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/area-served.php';
