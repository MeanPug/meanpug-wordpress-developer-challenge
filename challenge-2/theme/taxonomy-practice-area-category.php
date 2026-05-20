<?php
/**
 * Taxonomy template for `practice-area-category`.
 *
 * @package infra
 */

get_header();

$queried_term = get_queried_object();
$term_name    = ( $queried_term instanceof WP_Term ) ? $queried_term->name : '';
?>

<main id="main" role="main" tabindex="-1">
    <header class="bg-stone-900 text-white px-6 py-16">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold">
                <?php echo esc_html( $term_name ); ?>
            </h1>
            <?php if ( $queried_term instanceof WP_Term && $queried_term->description ) : ?>
                <div class="mt-4 text-lg text-stone-200 max-w-2xl">
                    <?php echo wp_kses_post( wpautop( $queried_term->description ) ); ?>
                </div>
            <?php endif; ?>
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
                <?php esc_html_e( 'No practice areas found in this category.', 'inf' ); ?>
            </p>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
