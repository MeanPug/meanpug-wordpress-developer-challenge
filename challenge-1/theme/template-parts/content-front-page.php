<?php
/**
 * Template part for displaying the front page content.
 *
 * Thin composition layer — delegates all rendering to focused template parts.
 * No markup or business logic lives here.
 *
 * @package infra
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'w-full pt-8' ); ?>>

    <div class="w-full">
        <?php get_template_part( 'template-parts/front-page/listings-section', 'homes' ); ?>
        <?php get_template_part( 'template-parts/front-page/listings-section', 'hotels' ); ?>
    </div>

</article>
