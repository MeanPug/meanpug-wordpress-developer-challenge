<?php
/**
 * Taxonomy template for `area-served`.
 *
 * Local landing page that surfaces what we offer in this geographic area.
 *
 * @package infra
 */

get_header();

$queried_term = get_queried_object();
$term_id      = ( $queried_term instanceof WP_Term ) ? (int) $queried_term->term_id : 0;
$taxonomy     = ( $queried_term instanceof WP_Term ) ? $queried_term->taxonomy : 'area-served';

/**
 * Build a sub-query for a given CPT scoped to the current term.
 *
 * @param string $post_type Post type slug.
 * @param int    $term_id   Term ID.
 * @param string $taxonomy  Taxonomy slug.
 * @return WP_Query
 */
$inf_build_area_sub_query = function ( $post_type, $term_id, $taxonomy ) {
    return new WP_Query(
        array(
            'post_type'      => $post_type,
            'posts_per_page' => 6,
            'no_found_rows'  => true,
            'tax_query'      => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'term_id',
                    'terms'    => $term_id,
                ),
            ),
        )
    );
};
?>

<main id="main" role="main" tabindex="-1">
    <header class="bg-stone-900 text-white px-6 py-16">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold">
                <?php single_term_title( '', true ); ?>
            </h1>
            <div class="mt-4 text-lg text-stone-200 max-w-2xl">
                <?php the_archive_description(); ?>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 py-12 space-y-16">
        <?php
        $practice_areas_query = $inf_build_area_sub_query( 'practice-area', $term_id, $taxonomy );
        ?>
        <section aria-labelledby="area-practice-areas-heading">
            <div class="flex items-end justify-between mb-6">
                <h2 id="area-practice-areas-heading" class="text-2xl md:text-3xl font-bold text-gray-900">
                    <?php esc_html_e( 'Practice Areas in this region', 'inf' ); ?>
                </h2>
                <a
                    href="<?php echo esc_url( get_post_type_archive_link( 'practice-area' ) ); ?>"
                    class="text-sm font-semibold text-blue-700 hover:underline"
                >
                    <?php esc_html_e( 'View all', 'inf' ); ?> &rarr;
                </a>
            </div>

            <?php if ( $practice_areas_query->have_posts() ) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    foreach ( $practice_areas_query->posts as $sub_post ) {
                        set_query_var( 'card_post', $sub_post );
                        get_template_part( 'template-parts/cards/content-practice-area-card' );
                    }
                    set_query_var( 'card_post', null );
                    ?>
                </div>
            <?php else : ?>
                <p class="text-gray-600">
                    <?php esc_html_e( 'No practice areas found for this region.', 'inf' ); ?>
                </p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </section>

        <?php
        $attorneys_query = $inf_build_area_sub_query( 'attorney', $term_id, $taxonomy );
        ?>
        <section aria-labelledby="area-attorneys-heading">
            <div class="flex items-end justify-between mb-6">
                <h2 id="area-attorneys-heading" class="text-2xl md:text-3xl font-bold text-gray-900">
                    <?php esc_html_e( 'Attorneys serving this area', 'inf' ); ?>
                </h2>
                <a
                    href="<?php echo esc_url( get_post_type_archive_link( 'attorney' ) ); ?>"
                    class="text-sm font-semibold text-blue-700 hover:underline"
                >
                    <?php esc_html_e( 'View all', 'inf' ); ?> &rarr;
                </a>
            </div>

            <?php if ( $attorneys_query->have_posts() ) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    foreach ( $attorneys_query->posts as $sub_post ) {
                        set_query_var( 'card_post', $sub_post );
                        get_template_part( 'template-parts/cards/content-attorney-card' );
                    }
                    set_query_var( 'card_post', null );
                    ?>
                </div>
            <?php else : ?>
                <p class="text-gray-600">
                    <?php esc_html_e( 'No attorneys found for this region.', 'inf' ); ?>
                </p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </section>

        <?php
        $offices_query = $inf_build_area_sub_query( 'office', $term_id, $taxonomy );
        ?>
        <section aria-labelledby="area-offices-heading">
            <div class="flex items-end justify-between mb-6">
                <h2 id="area-offices-heading" class="text-2xl md:text-3xl font-bold text-gray-900">
                    <?php esc_html_e( 'Our Offices', 'inf' ); ?>
                </h2>
                <a
                    href="<?php echo esc_url( get_post_type_archive_link( 'office' ) ); ?>"
                    class="text-sm font-semibold text-blue-700 hover:underline"
                >
                    <?php esc_html_e( 'View all', 'inf' ); ?> &rarr;
                </a>
            </div>

            <?php if ( $offices_query->have_posts() ) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php
                    foreach ( $offices_query->posts as $sub_post ) {
                        set_query_var( 'card_post', $sub_post );
                        get_template_part( 'template-parts/cards/content-office-card' );
                    }
                    set_query_var( 'card_post', null );
                    ?>
                </div>
            <?php else : ?>
                <p class="text-gray-600">
                    <?php esc_html_e( 'No offices found for this region.', 'inf' ); ?>
                </p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </section>
    </div>
</main>

<?php
get_footer();
