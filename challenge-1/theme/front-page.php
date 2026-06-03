<?php
/**
 * Front page template
 *
 * @package infra
 */

get_header();
?>

<main id="main" class="airbnb-main" role="main" tabindex="-1">
  <?php get_template_part( 'template-parts/content', 'front-page' ); ?>
</main>

<?php
get_footer();