<?php
/**
 * The template for displaying single `practice-area` posts.
 *
 * @package infra
 */

get_header();
?>

<main id="main" role="main" class="max-w-7xl mx-auto px-6 py-12">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php
        $post_id   = get_the_ID();
        $ancestors = array_reverse( get_post_ancestors( $post_id ) );
        ?>

        <nav class="text-sm text-gray-600 mb-6" aria-label="<?php esc_attr_e( 'Breadcrumb', 'inf' ); ?>">
            <ol class="flex flex-wrap items-center gap-2">
                <li>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-blue-700 hover:underline">
                        <?php esc_html_e( 'Home', 'inf' ); ?>
                    </a>
                </li>
                <li aria-hidden="true">/</li>
                <li>
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'practice-area' ) ); ?>" class="hover:text-blue-700 hover:underline">
                        <?php esc_html_e( 'Practice Areas', 'inf' ); ?>
                    </a>
                </li>
                <?php foreach ( $ancestors as $ancestor_id ) : ?>
                    <li aria-hidden="true">/</li>
                    <li>
                        <a href="<?php echo esc_url( get_permalink( $ancestor_id ) ); ?>" class="hover:text-blue-700 hover:underline">
                            <?php echo esc_html( get_the_title( $ancestor_id ) ); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
                <li aria-hidden="true">/</li>
                <li aria-current="page" class="text-gray-900 font-semibold">
                    <?php echo esc_html( get_the_title() ); ?>
                </li>
            </ol>
        </nav>

        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
            <?php the_title(); ?>
        </h1>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="mb-10 overflow-hidden rounded-lg">
                <?php
                the_post_thumbnail(
                    'large',
                    array(
                        'class'   => 'w-full h-auto object-cover',
                        'loading' => 'lazy',
                    )
                );
                ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-12">
                <div class="prose max-w-none">
                    <?php the_content(); ?>
                </div>

                <?php
                $attorneys        = function_exists( 'get_field' ) ? (array) get_field( 'attorneys', $post_id ) : array();
                $case_results_acf = function_exists( 'get_field' ) ? (array) get_field( 'case_results', $post_id ) : array();
                $testimonials_acf = function_exists( 'get_field' ) ? (array) get_field( 'testimonials', $post_id ) : array();
                $faq_items        = function_exists( 'get_field' ) ? (array) get_field( 'schema_faq_items', $post_id ) : array();
                ?>

                <?php if ( ! empty( $attorneys ) ) : ?>
                    <section aria-labelledby="our-attorneys-heading">
                        <h2 id="our-attorneys-heading" class="text-2xl font-bold text-gray-900 mb-6">
                            <?php esc_html_e( 'Our Attorneys', 'inf' ); ?>
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <?php foreach ( $attorneys as $attorney ) : ?>
                                <?php
                                if ( ! $attorney instanceof WP_Post ) {
                                    continue;
                                }
                                set_query_var( 'card_post', $attorney );
                                get_template_part( 'template-parts/cards/content', 'attorney-card' );
                                set_query_var( 'card_post', null );
                                ?>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if ( ! empty( $case_results_acf ) ) : ?>
                    <section aria-labelledby="recent-results-heading">
                        <h2 id="recent-results-heading" class="text-2xl font-bold text-gray-900 mb-6">
                            <?php esc_html_e( 'Recent Results', 'inf' ); ?>
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php foreach ( $case_results_acf as $case_result ) : ?>
                                <?php
                                if ( ! $case_result instanceof WP_Post ) {
                                    continue;
                                }
                                set_query_var( 'card_post', $case_result );
                                get_template_part( 'template-parts/cards/content', 'case-result-card' );
                                set_query_var( 'card_post', null );
                                ?>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if ( ! empty( $testimonials_acf ) ) : ?>
                    <section aria-labelledby="what-clients-say-heading">
                        <h2 id="what-clients-say-heading" class="text-2xl font-bold text-gray-900 mb-6">
                            <?php esc_html_e( 'What Clients Say', 'inf' ); ?>
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <?php foreach ( $testimonials_acf as $testimonial ) : ?>
                                <?php
                                if ( ! $testimonial instanceof WP_Post ) {
                                    continue;
                                }
                                set_query_var( 'card_post', $testimonial );
                                get_template_part( 'template-parts/cards/content', 'testimonial-card' );
                                set_query_var( 'card_post', null );
                                ?>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <?php if ( ! empty( $faq_items ) ) : ?>
                    <section aria-labelledby="faq-heading">
                        <h2 id="faq-heading" class="text-2xl font-bold text-gray-900 mb-6">
                            <?php esc_html_e( 'FAQ', 'inf' ); ?>
                        </h2>
                        <dl class="space-y-4">
                            <?php foreach ( $faq_items as $faq ) : ?>
                                <?php
                                $question = isset( $faq['question'] ) ? (string) $faq['question'] : '';
                                $answer   = isset( $faq['answer'] ) ? (string) $faq['answer'] : '';
                                if ( ! $question ) {
                                    continue;
                                }
                                ?>
                                <div class="border border-gray-200 rounded-lg bg-white">
                                    <details class="group p-4">
                                        <summary class="cursor-pointer list-none flex items-center justify-between font-semibold text-gray-900">
                                            <dt class="inline">
                                                <?php echo esc_html( $question ); ?>
                                            </dt>
                                            <span class="ml-4 text-blue-700 group-open:rotate-45 transition-transform" aria-hidden="true">+</span>
                                        </summary>
                                        <dd class="mt-3 text-gray-700 leading-relaxed">
                                            <?php echo wp_kses_post( $answer ); ?>
                                        </dd>
                                    </details>
                                </div>
                            <?php endforeach; ?>
                        </dl>
                    </section>
                <?php endif; ?>
            </div>

            <aside class="lg:col-span-1">
                <?php dynamic_sidebar( 'practice-area-sidebar' ); ?>
            </aside>
        </div>
    <?php endwhile; ?>
</main>

<?php
get_footer();
