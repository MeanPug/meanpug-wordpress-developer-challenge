<?php
/**
 * Archive template for the `attorney` CPT.
 *
 * @package infra
 */

get_header();

$specialty_terms = get_terms(
    array(
        'taxonomy'   => 'attorney-specialty',
        'hide_empty' => true,
    )
);
?>

<main id="main" role="main" tabindex="-1">
    <header class="bg-stone-900 text-white px-6 py-16">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold">
                <?php esc_html_e( 'Attorneys', 'inf' ); ?>
            </h1>
            <p class="mt-4 text-lg text-stone-200 max-w-2xl">
                <?php esc_html_e( 'Meet the attorneys who fight for our clients.', 'inf' ); ?>
            </p>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <?php if ( ! is_wp_error( $specialty_terms ) && ! empty( $specialty_terms ) ) : ?>
            <nav class="mb-8 flex flex-wrap gap-2" aria-label="<?php esc_attr_e( 'Filter attorneys by specialty', 'inf' ); ?>">
                <?php foreach ( $specialty_terms as $specialty_term ) : ?>
                    <?php $term_link = get_term_link( $specialty_term ); ?>
                    <?php if ( is_wp_error( $term_link ) ) { continue; } ?>
                    <a
                        href="<?php echo esc_url( $term_link ); ?>"
                        class="inline-block px-4 py-2 text-sm font-semibold rounded-full bg-stone-100 text-stone-900 hover:bg-stone-200 transition"
                    >
                        <?php echo esc_html( $specialty_term->name ); ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        <?php endif; ?>

        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/cards/content-attorney-card' ); ?>
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
                <?php esc_html_e( 'No attorneys found.', 'inf' ); ?>
            </p>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
