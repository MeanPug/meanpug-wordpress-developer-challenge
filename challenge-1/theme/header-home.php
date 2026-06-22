<?php
/**
 * The bespoke header for "The Dog House" front page.
 *
 * Loaded via get_header( 'home' ) from front-page.php. Unlike the firm's default
 * header.php — which renders the legal-practice navigation and calls ACF's
 * get_field() unguarded — this header is intentionally lean: the document
 * <head>, an accessibility skip link, and the AirPnP-style sticky chrome
 * (info banner, brand bar, category nav, search) composed from data-driven
 * partials in template-parts/front-page/.
 *
 * Keeping this header ACF-free means the front page renders from a clean
 * `docker compose up` even before the firm's plugins are configured.
 *
 * @package infra
 */

defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'doghouse' ); ?>>

<a class="sr-only focus:not-sr-only focus:absolute focus:z-50 focus:top-3 focus:left-3 focus:bg-white focus:text-doghouse-ink focus:px-4 focus:py-2 focus:rounded-lg focus:shadow-lg focus:font-semibold" href="#main">
	<?php esc_html_e( 'Skip to main content', 'inf' ); ?>
</a>

<header class="doghouse-chrome sticky top-0 z-30 bg-white shadow-sm">
	<?php
	get_template_part( 'template-parts/front-page/banner' );
	get_template_part( 'template-parts/front-page/site-header' );
	get_template_part( 'template-parts/front-page/category-tabs' );
	get_template_part( 'template-parts/front-page/search-bar' );
	?>
</header>

<div id="page" class="site">

	<div id="content" class="site-content">
