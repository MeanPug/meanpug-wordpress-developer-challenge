<?php
/**
 * Template part: Hotels Listings Section
 *
 * Renders the "Great hotels for your next trip" grid.
 * Listing data is a structured PHP array rendered via the shared listing-card
 * template part. The MeanPug pug easter egg appears as a "Guest Favorite" card
 * naturally within the grid.
 *
 * @package infra
 */

$listings = array(
    array(
        'image_url'   => inf_get_asset_url( 'images/listings/hotel-1.png' ),
        'image_alt'   => __( 'Luxury boutique hotel with pool in Barcelona', 'inf' ),
        'title'       => __( 'Sercotel Amister Art Hotel', 'inf' ),
        'subtitle'    => __( 'S/ 1,329 for 2 nights · ★ 4.68', 'inf' ),
        'rating'      => '4.68',
        'is_favorite' => false,
    ),
    array(
        'image_url'   => inf_get_asset_url( 'images/listings/hotel-2.png' ),
        'image_alt'   => __( 'Elegant rooftop terrace with Barcelona city views at sunset', 'inf' ),
        'title'       => __( 'Sercotel Barcelona El Prat', 'inf' ),
        'subtitle'    => __( 'S/ 1,253 for 2 nights · ★ 4.72', 'inf' ),
        'rating'      => '4.72',
        'is_favorite' => false,
    ),
    array(
        'image_url'   => inf_get_asset_url( 'images/listings/hotel-3.png' ),
        'image_alt'   => __( 'Charming boutique hotel lobby with Moroccan tiles', 'inf' ),
        'title'       => __( 'Eco-Boutique Hostal Grau', 'inf' ),
        'subtitle'    => __( 'S/ 1,003 for 2 nights · ★ 4.84', 'inf' ),
        'rating'      => '4.84',
        'is_favorite' => true,
        'badge_label' => __( 'Prices include all fees', 'inf' ),
    ),
    array(
        'image_url'   => inf_get_asset_url( 'images/listings/hotel-4.png' ),
        'image_alt'   => __( 'Luxury hotel room with ocean view', 'inf' ),
        'title'       => __( 'Yurbban Ramblas Boutique Hotel', 'inf' ),
        'subtitle'    => __( 'S/ 2,087 for 2 nights · ★ 5.0', 'inf' ),
        'rating'      => '5.0',
        'is_favorite' => false,
    ),
    array(
        'image_url'   => inf_get_asset_url( 'images/pug-mascot.png' ),
        'image_alt'   => __( 'MeanPug — your friendly neighbourhood host', 'inf' ),
        'title'       => __( 'The MeanPug Suite', 'inf' ),
        'subtitle'    => __( 'S/ 999 for 2 nights · ★ 5.0', 'inf' ),
        'rating'      => '5.0',
        'is_favorite' => true,
        'badge_label' => __( 'Guest favorite', 'inf' ),
    ),
);
?>
<section class="max-w-7xl mx-auto px-6 pb-12" aria-labelledby="hotels-section-heading">

    <header class="mb-5">
        <h2 id="hotels-section-heading" class="flex items-center gap-2 text-xl font-bold text-gray-900 m-0 mb-1">
            <?php esc_html_e( 'Great hotels for your next trip', 'inf' ); ?>
            <a href="#" class="text-base font-bold text-gray-900 no-underline hover:underline"
               aria-label="<?php esc_attr_e( 'See all hotels', 'inf' ); ?>">→</a>
        </h2>
        <p class="text-sm text-gray-500 m-0">
            <?php esc_html_e( 'Plus, get Airbnb credit when you stay at a featured hotel.', 'inf' ); ?>
        </p>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5" role="list">
        <?php foreach ( $listings as $listing ) : ?>
            <div role="listitem">
                <?php get_template_part( 'template-parts/front-page/listing-card', null, $listing ); ?>
            </div>
        <?php endforeach; ?>
    </div>

</section>
