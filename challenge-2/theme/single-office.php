<?php
/**
 * The template for displaying single `office` posts.
 *
 * @package infra
 */

get_header();
?>

<main id="main" role="main" class="max-w-7xl mx-auto px-6 py-12">
    <?php while ( have_posts() ) : the_post(); ?>
        <?php
        $post_id = get_the_ID();

        $address       = array();
        $hours         = array();
        $latitude      = '';
        $longitude     = '';
        $lead_attorney = null;
        if ( function_exists( 'get_field' ) ) {
            $address       = (array) get_field( 'address', $post_id );
            $hours         = (array) get_field( 'hours', $post_id );
            $latitude      = (string) get_field( 'latitude', $post_id );
            $longitude     = (string) get_field( 'longitude', $post_id );
            $lead_attorney = get_field( 'lead_attorney', $post_id );
        }

        $formatted_address = '';
        if ( ! empty( $address ) && function_exists( 'inf_format_address' ) ) {
            $formatted_address = inf_format_address(
                isset( $address['postal_code'] ) ? $address['postal_code'] : '',
                isset( $address['state'] ) ? $address['state'] : '',
                isset( $address['city'] ) ? $address['city'] : '',
                isset( $address['street'] ) ? $address['street'] : '',
                isset( $address['street2'] ) ? $address['street2'] : ''
            );
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
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'office' ) ); ?>" class="hover:text-blue-700 hover:underline">
                        <?php esc_html_e( 'Offices', 'inf' ); ?>
                    </a>
                </li>
                <li aria-hidden="true">/</li>
                <li aria-current="page" class="text-gray-900 font-semibold">
                    <?php echo esc_html( get_the_title() ); ?>
                </li>
            </ol>
        </nav>

        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-8">
            <?php the_title(); ?>
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <section class="bg-white rounded-lg shadow p-6" aria-labelledby="address-heading">
                <h2 id="address-heading" class="text-xl font-bold text-gray-900 mb-4">
                    <?php esc_html_e( 'Address', 'inf' ); ?>
                </h2>
                <?php if ( $formatted_address ) : ?>
                    <address class="not-italic text-gray-700 leading-relaxed">
                        <?php echo wp_kses_post( $formatted_address ); ?>
                    </address>
                <?php endif; ?>
            </section>

            <section class="bg-white rounded-lg shadow p-6" aria-labelledby="hours-heading">
                <h2 id="hours-heading" class="text-xl font-bold text-gray-900 mb-4">
                    <?php esc_html_e( 'Hours', 'inf' ); ?>
                </h2>
                <?php if ( ! empty( $hours ) ) : ?>
                    <table class="w-full text-left text-gray-700">
                        <tbody>
                            <?php foreach ( $hours as $row ) : ?>
                                <?php
                                $day   = isset( $row['day'] ) ? (string) $row['day'] : '';
                                $open  = isset( $row['open'] ) ? (string) $row['open'] : '';
                                $close = isset( $row['close'] ) ? (string) $row['close'] : '';
                                if ( ! $day ) {
                                    continue;
                                }
                                $value = ( $open && $close ) ? sprintf( '%s &ndash; %s', $open, $close ) : __( 'Closed', 'inf' );
                                ?>
                                <tr class="border-b border-gray-100 last:border-0">
                                    <th scope="row" class="py-2 pr-4 font-semibold">
                                        <?php echo esc_html( $day ); ?>
                                    </th>
                                    <td class="py-2 text-right">
                                        <?php echo wp_kses_post( $value ); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p class="text-gray-600">
                        <?php esc_html_e( 'Hours not available.', 'inf' ); ?>
                    </p>
                <?php endif; ?>
            </section>
        </div>

        <?php if ( $latitude && $longitude ) : ?>
            <section class="mt-12" aria-labelledby="map-heading">
                <h2 id="map-heading" class="text-2xl font-bold text-gray-900 mb-4">
                    <?php esc_html_e( 'Location', 'inf' ); ?>
                </h2>
                <div id="office-map" class="w-full h-96 rounded-lg bg-gray-100" role="region" aria-label="<?php esc_attr_e( 'Office map', 'inf' ); ?>"></div>

                <?php if ( function_exists( 'mp_load_google_maps_sdk' ) ) : ?>
                    <?php mp_load_google_maps_sdk(); ?>
                <?php endif; ?>

                <script>
                    window.officeMapData = <?php echo wp_json_encode(
                        array(
                            'lat'   => (float) $latitude,
                            'lng'   => (float) $longitude,
                            'title' => get_the_title(),
                        )
                    ); ?>;
                </script>
            </section>
        <?php endif; ?>

        <?php if ( $lead_attorney instanceof WP_Post ) : ?>
            <section class="mt-12" aria-labelledby="lead-attorney-heading">
                <h2 id="lead-attorney-heading" class="text-2xl font-bold text-gray-900 mb-6">
                    <?php esc_html_e( 'Lead Attorney', 'inf' ); ?>
                </h2>
                <div class="max-w-sm">
                    <?php
                    set_query_var( 'card_post', $lead_attorney );
                    get_template_part( 'template-parts/cards/content', 'attorney-card' );
                    set_query_var( 'card_post', null );
                    ?>
                </div>
            </section>
        <?php endif; ?>

        <?php
        $related_pa_ids = \PugPuggle\Queries\Practice_Areas::cards(
            array(
                'limit' => 3,
            )
        );
        ?>
        <?php if ( ! empty( $related_pa_ids ) ) : ?>
            <section class="mt-12" aria-labelledby="related-practice-areas-heading">
                <h2 id="related-practice-areas-heading" class="text-2xl font-bold text-gray-900 mb-6">
                    <?php esc_html_e( 'Related Practice Areas', 'inf' ); ?>
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php foreach ( $related_pa_ids as $pa_id ) : ?>
                        <?php
                        $pa_post = get_post( (int) $pa_id );
                        if ( ! $pa_post instanceof WP_Post ) {
                            continue;
                        }
                        set_query_var( 'card_post', $pa_post );
                        get_template_part( 'template-parts/cards/content', 'practice-area-card' );
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
