<?php
/**
 * Archive template for the `office` CPT.
 *
 * @package infra
 */

get_header();

// Collect map data for all offices in the current archive query.
$office_map_data = array();
if ( have_posts() ) {
    foreach ( $wp_query->posts as $office_post ) {
        if ( ! $office_post instanceof WP_Post ) {
            continue;
        }
        $latitude  = '';
        $longitude = '';
        if ( function_exists( 'get_field' ) ) {
            $latitude  = (string) get_field( 'latitude', $office_post->ID );
            $longitude = (string) get_field( 'longitude', $office_post->ID );
        }
        if ( '' === $latitude || '' === $longitude ) {
            continue;
        }
        $office_map_data[] = array(
            'lat'   => (float) $latitude,
            'lng'   => (float) $longitude,
            'title' => get_the_title( $office_post->ID ),
            'url'   => get_permalink( $office_post->ID ),
        );
    }
}
?>

<main id="main" role="main" tabindex="-1">
    <header class="bg-stone-900 text-white px-6 py-16">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold">
                <?php esc_html_e( 'Offices', 'inf' ); ?>
            </h1>
            <p class="mt-4 text-lg text-stone-200 max-w-2xl">
                <?php esc_html_e( 'Find one of our offices near you.', 'inf' ); ?>
            </p>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 py-12">
        <?php if ( ! empty( $office_map_data ) ) : ?>
            <section class="mb-12" aria-labelledby="offices-map-heading">
                <h2 id="offices-map-heading" class="sr-only">
                    <?php esc_html_e( 'Map of all offices', 'inf' ); ?>
                </h2>
                <div
                    id="offices-map"
                    class="w-full h-96 rounded-lg bg-gray-100"
                    role="region"
                    aria-label="<?php esc_attr_e( 'Map showing all office locations', 'inf' ); ?>"
                ></div>

                <?php if ( function_exists( 'mp_load_google_maps_sdk' ) ) : ?>
                    <?php mp_load_google_maps_sdk(); ?>
                <?php endif; ?>

                <script>
                    window.officesMapData = <?php echo wp_json_encode( $office_map_data ); ?>;
                </script>
            </section>
        <?php endif; ?>

        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/cards/content-office-card' ); ?>
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
                <?php esc_html_e( 'No offices found.', 'inf' ); ?>
            </p>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
