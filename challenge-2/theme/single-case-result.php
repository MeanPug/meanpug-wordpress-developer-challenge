<?php
/**
 * The template for displaying single `case-result` posts.
 *
 * @package infra
 */

get_header();
?>

<main id="main" role="main" class="max-w-5xl mx-auto px-6 py-12">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php
        $post_id = get_the_ID();

        $amount_display  = '';
        $result_type     = '';
        $practice_area   = null;
        $outcome_summary = '';
        $attorneys       = array();
        if ( function_exists( 'get_field' ) ) {
            $amount_display  = (string) get_field( 'amount_display', $post_id );
            $result_type     = (string) get_field( 'result_type', $post_id );
            $practice_area   = get_field( 'practice_area', $post_id );
            $outcome_summary = (string) get_field( 'outcome_summary', $post_id );
            $attorneys       = (array) get_field( 'attorneys', $post_id );
        }
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
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'case-result' ) ); ?>" class="hover:text-blue-700 hover:underline">
                        <?php esc_html_e( 'Case Results', 'inf' ); ?>
                    </a>
                </li>
                <li aria-hidden="true">/</li>
                <li aria-current="page" class="text-gray-900 font-semibold">
                    <?php echo esc_html( get_the_title() ); ?>
                </li>
            </ol>
        </nav>

        <?php if ( $amount_display ) : ?>
            <section class="bg-blue-700 text-white rounded-lg py-10 px-6 text-center mb-8" aria-labelledby="amount-heading">
                <span class="block text-5xl font-bold tracking-tight" id="amount-heading">
                    <?php echo esc_html( $amount_display ); ?>
                </span>
                <?php if ( $result_type ) : ?>
                    <span class="inline-block mt-4 px-4 py-1 text-sm font-semibold uppercase tracking-wide bg-white text-blue-800 rounded-full">
                        <?php echo esc_html( $result_type ); ?>
                    </span>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
            <?php the_title(); ?>
        </h1>

        <?php if ( $practice_area instanceof WP_Post ) : ?>
            <div class="mb-8">
                <a
                    href="<?php echo esc_url( get_permalink( $practice_area->ID ) ); ?>"
                    class="inline-block px-3 py-1 text-xs font-semibold uppercase tracking-wide bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition"
                >
                    <?php echo esc_html( get_the_title( $practice_area->ID ) ); ?>
                </a>
            </div>
        <?php endif; ?>

        <div class="prose max-w-none mb-8">
            <?php the_content(); ?>
        </div>

        <?php if ( $outcome_summary ) : ?>
            <section class="bg-gray-50 rounded-lg p-6 mb-12" aria-labelledby="outcome-heading">
                <h2 id="outcome-heading" class="text-2xl font-bold text-gray-900 mb-4">
                    <?php esc_html_e( 'Outcome', 'inf' ); ?>
                </h2>
                <div class="text-gray-700 leading-relaxed">
                    <?php echo wp_kses_post( $outcome_summary ); ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if ( ! empty( $attorneys ) ) : ?>
            <section aria-labelledby="attorneys-involved-heading">
                <h2 id="attorneys-involved-heading" class="text-2xl font-bold text-gray-900 mb-6">
                    <?php esc_html_e( 'Attorneys Involved', 'inf' ); ?>
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
    <?php endwhile; ?>
</main>

<?php
get_footer();
