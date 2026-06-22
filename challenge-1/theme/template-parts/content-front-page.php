<?php
/**
 * Front page content — "The Dog House" orchestrator.
 *
 * Intentionally logic-free: it composes the data-driven partials that make up
 * the AirPnP-style landing experience. The sticky top chrome (info banner,
 * brand header, category nav, search bar) lives in header-home.php; this file
 * owns the main content region (hero + listings grid).
 *
 * @package infra
 */

defined( 'ABSPATH' ) || exit;

get_template_part( 'template-parts/front-page/hero' );
get_template_part( 'template-parts/front-page/listing-grid' );
