<?php
/**
 *  Template Name: Home Jorge Robles
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

get_header();
echo do_blocks('<!-- wp:acf/topribbon /-->');
echo do_blocks('<!-- wp:acf/header /-->');
echo do_blocks('<!-- wp:acf/searchbar /-->');
echo do_blocks('<!-- wp:acf/hero /-->');
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'front-page' );
			endwhile;
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
