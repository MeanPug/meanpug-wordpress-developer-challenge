<?php
/**
 * Template part: Popular Homes Listings Section
 *
 * Renders the "Popular homes in Lima" grid. Listing data is defined as a
 * structured PHP array and rendered via the shared listing-card template part.
 * Adding or removing cards only requires modifying $listings — never the markup.
 *
 * @package infra
 */

$listings = array(
    array(
        'image_url'   => inf_get_asset_url( 'images/listings/apt-1.png' ),
        'image_alt'   => __( 'Modern apartment living room with city view in Barranco, Lima', 'inf' ),
        'title'       => __( 'Apartment in Barranco', 'inf' ),
        'subtitle'    => __( 'S/ 340 for 2 nights', 'inf' ),
        'rating'      => '5.0',
        'is_favorite' => true,
    ),
    array(
        'image_url'   => inf_get_asset_url( 'images/listings/apt-2.png' ),
        'image_alt'   => __( 'Bright minimalist apartment interior in Barranco, Lima', 'inf' ),
        'title'       => __( 'Apartment in Barranco', 'inf' ),
        'subtitle'    => __( 'S/ 534 for 2 nights', 'inf' ),
        'rating'      => '4.94',
        'is_favorite' => false,
    ),
    array(
        'image_url'   => inf_get_asset_url( 'images/listings/apt-3.png' ),
        'image_alt'   => __( 'Cozy warm apartment with wooden accents in Barranco, Lima', 'inf' ),
        'title'       => __( 'Apartment in Barranco', 'inf' ),
        'subtitle'    => __( 'S/ 295 for 2 nights', 'inf' ),
        'rating'      => '4.9',
        'is_favorite' => false,
    ),
    array(
        'image_url'   => inf_get_asset_url( 'images/listings/apt-4.png' ),
        'image_alt'   => __( 'Luxury apartment bedroom with night city view in Lima', 'inf' ),
        'title'       => __( 'Vacation home in San Martin de Porres', 'inf' ),
        'subtitle'    => __( 'S/ 274 for 2 nights', 'inf' ),
        'rating'      => '4.86',
        'is_favorite' => true,
    ),
    array(
        'image_url'   => inf_get_asset_url( 'images/listings/apt-5.png' ),
        'image_alt'   => __( 'Penthouse with panoramic balcony view in San Miguel, Lima', 'inf' ),
        'title'       => __( 'Apartment in Lima', 'inf' ),
        'subtitle'    => __( 'S/ 248 for 2 nights', 'inf' ),
        'rating'      => '4.34',
        'is_favorite' => true,
    ),
    array(
        'image_url'   => inf_get_asset_url( 'images/listings/apt-1.png' ),
        'image_alt'   => __( 'Cozy modern apartment in San Miguel, Lima', 'inf' ),
        'title'       => __( 'Apartment in San Miguel', 'inf' ),
        'subtitle'    => __( 'S/ 303 for 2 nights', 'inf' ),
        'rating'      => '4.96',
        'is_favorite' => true,
    ),
    array(
        'image_url'   => inf_get_asset_url( 'images/listings/apt-2.png' ),
        'image_alt'   => __( 'Beautiful minimalist apartment in Pueblo Libre, Lima', 'inf' ),
        'title'       => __( 'Apartment in Pueblo Libre', 'inf' ),
        'subtitle'    => __( 'S/ 305 for 2 nights', 'inf' ),
        'rating'      => '4.95',
        'is_favorite' => false,
    ),
);
?>
<section class="max-w-[2520px] mx-auto px-6 md:px-10 lg:px-20 pb-12" aria-labelledby="homes-section-heading">

    <header class="mb-6">
        <h2 id="homes-section-heading" class="flex items-center gap-2 text-2xl font-bold text-[#222222] m-0">
            <?php esc_html_e( 'Popular homes in Lima', 'inf' ); ?>
            <a href="#" class="text-lg font-bold text-[#222222] no-underline hover:underline"
               aria-label="<?php esc_attr_e( 'See all popular homes in Lima', 'inf' ); ?>">→</a>
        </h2>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 2xl:grid-cols-7 gap-x-6 gap-y-10" role="list">
        <?php foreach ( $listings as $listing ) : ?>
            <div role="listitem">
                <?php get_template_part( 'template-parts/front-page/listing-card', null, $listing ); ?>
            </div>
        <?php endforeach; ?>
    </div>

</section>
