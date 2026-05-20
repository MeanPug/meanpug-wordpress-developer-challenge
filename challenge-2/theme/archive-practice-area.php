<?php
/**
 * Archive template for the `practice-area` CPT.
 *
 * @package infra
 */

get_header();
?>

<main id="main" role="main" tabindex="-1">
    <header class="bg-stone-900 text-white px-6 py-16">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold">
                <?php esc_html_e( 'Practice Areas', 'inf' ); ?>
            </h1>
            <p class="mt-4 text-lg text-stone-200 max-w-2xl">
                <?php esc_html_e( 'Explore the legal practice areas in which our firm represents clients.', 'inf' ); ?>
            </p>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/cards/content-practice-area-card' ); ?>
                <?php endwhile; ?>
            </div>

            <?php
            the_posts_pagination(
                array(
                    'mid_size'  => 2,
                    'prev_text' => esc_html__( '← Previous', 'inf' ),
                    'next_text' => esc_html__( 'Next →', 'inf' ),
                    'class'     => 'mt-12 flex justify-center gap-2',
                )
            );
            ?>
        <?php else : ?>
            <p class="text-gray-600">
                <?php esc_html_e( 'No practice areas found.', 'inf' ); ?>
            </p>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
