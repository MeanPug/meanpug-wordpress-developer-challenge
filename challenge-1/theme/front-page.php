<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package infra
 */

get_header( 'home' );
?>
	<main id="main" class="doghouse-main site-main bg-white" tabindex="-1">

		<?php
		// The Dog House landing is entirely data-driven, so we render it once
		// rather than looping the main query. This keeps the page correct (and
		// un-duplicated) whether the site's front page is set to a static page
		// or to the latest-posts index — no Reading-settings setup required.
		get_template_part( 'template-parts/content', 'front-page' );
		?>
	</main><!-- #main -->

<?php
get_footer();
