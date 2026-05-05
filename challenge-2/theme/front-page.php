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

get_header();
?>
	<div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php
            // Since ACF PRO is not available for ACF Blocks, we natively include the sections
            // 1. Hero Banner
            include get_template_directory() . '/blocks/hero-banner/hero-banner.php';

            // 2. Verdicts
            include get_template_directory() . '/blocks/verdicts/verdicts.php';

            // 3. Featured Attorneys
            include get_template_directory() . '/blocks/featured-attorneys/featured-attorneys.php';
            ?>
        </main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
