<?php
/**
 * The template for displaying the front page.
 *
 * @package infra
 */

get_header('front');
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        while ( have_posts() ) :
            the_post();

            get_template_part( 'template-parts/content', 'front-page' );
        endwhile;
        ?>

        <!-- WordPress Property CPT Listings Grid -->
        <?php get_template_part( 'template-parts/properties/properties-grid' ); ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
