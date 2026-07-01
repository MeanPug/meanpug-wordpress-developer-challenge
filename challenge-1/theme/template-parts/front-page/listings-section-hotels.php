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
        'title'       => __( 'Hotel Ronda Lesseps', 'inf' ),
        'subtitle'    => __( 'S/ 1,459 for 2 nights', 'inf' ),
        'rating'      => '4.78',
        'is_favorite' => false,
    ),
    array(
        'image_url'   => inf_get_asset_url( 'images/listings/hotel-2.png' ),
        'image_alt'   => __( 'Elegant rooftop terrace with Barcelona city views at sunset', 'inf' ),
        'title'       => __( 'Sercotel Amister Art Hotel', 'inf' ),
        'subtitle'    => __( 'S/ 1,579 for 2 nights', 'inf' ),
        'rating'      => '4.86',
        'is_favorite' => true,
    ),
    array(
        'image_url'   => inf_get_asset_url( 'images/listings/hotel-3.png' ),
        'image_alt'   => __( 'Charming boutique hotel lobby with Moroccan tiles', 'inf' ),
        'title'       => __( 'Sercotel Cornellà Barcelona', 'inf' ),
        'subtitle'    => __( 'S/ 1,424 for 2 nights', 'inf' ),
        'rating'      => '4.68',
        'is_favorite' => false,
    ),
    array(
        'image_url'   => inf_get_asset_url( 'images/listings/hotel-4.png' ),
        'image_alt'   => __( 'Luxury hotel room with ocean view', 'inf' ),
        'title'       => __( 'Eco-Boutique Hostal Grau', 'inf' ),
        'subtitle'    => __( 'S/ 1,893 for 2 nights', 'inf' ),
        'rating'      => '4.84',
        'is_favorite' => true,
        'badge_label' => __( 'Prices include all fees', 'inf' ),
    ),
    array(
        'image_url'   => inf_get_asset_url( 'images/listings/hotel-1.png' ),
        'image_alt'   => __( 'Boutique hotel with modern chic styling', 'inf' ),
        'title'       => __( 'chic&basic Habana Hoose', 'inf' ),
        'subtitle'    => __( 'S/ 1,688 for 2 nights', 'inf' ),
        'rating'      => '4.8',
        'is_favorite' => false,
    ),
    array(
        'image_url'   => inf_get_asset_url( 'images/listings/hotel-2.png' ),
        'image_alt'   => __( 'Luxury suites at Sercotel Barcelona El Prat', 'inf' ),
        'title'       => __( 'Sercotel Barcelona El Prat', 'inf' ),
        'subtitle'    => __( 'S/ 1,233 for 2 nights', 'inf' ),
        'rating'      => '4.72',
        'is_favorite' => false,
    ),
    array(
        'image_url'   => inf_get_asset_url( 'images/pug-mascot.png' ),
        'image_alt'   => __( 'MeanPug — your friendly neighbourhood host', 'inf' ),
        'title'       => __( 'The MeanPug Suite', 'inf' ),
        'subtitle'    => __( 'S/ 999 for 2 nights', 'inf' ),
        'rating'      => '5.0',
        'is_favorite' => true,
        'badge_label' => __( 'Guest favorite', 'inf' ),
    ),
);
?>
<section class="max-w-[2520px] mx-auto px-6 md:px-10 lg:px-20 pb-16" aria-labelledby="hotels-section-heading">

    <header class="mb-6">
        <h2 id="hotels-section-heading" class="flex items-center gap-2 text-2xl font-bold text-[#222222] m-0 mb-1">
            <?php esc_html_e( 'Great hotels for your next trip', 'inf' ); ?>
            <a href="#" class="text-lg font-bold text-[#222222] no-underline hover:underline"
               aria-label="<?php esc_attr_e( 'See all hotels', 'inf' ); ?>">→</a>
        </h2>
        <p class="text-sm text-[#717171] m-0">
            <?php esc_html_e( 'Plus, get Airbnb credit when you stay at a featured hotel.', 'inf' ); ?>
        </p>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 2xl:grid-cols-7 gap-x-6 gap-y-10" role="list">
        <?php foreach ( $listings as $listing ) : ?>
            <div role="listitem">
                <?php get_template_part( 'template-parts/front-page/listing-card', null, $listing ); ?>
            </div>
        <?php endforeach; ?>
    </div>

</section>
