<?php
/**
 * Template part: front page listing grid
 *
 * @package infra
 */

$listings = array(
  array(
    'location' => 'Maldives',
    'distance' => '8,329 miles away',
    'dates'    => 'Dec 1 - 6',
    'price'    => '$580',
    'rating'   => '4.97',
    'badge'    => 'Guest favorite',
    'image'    => 'https://images.unsplash.com/photo-1514282401047-d79a71a590e8?w=720&q=80&auto=format&fit=crop',
  ),
  array(
    'location' => 'Tuscany, Italy',
    'distance' => '5,741 miles away',
    'dates'    => 'Nov 28 - Dec 3',
    'price'    => '$310',
    'rating'   => '4.95',
    'badge'    => 'Guest favorite',
    'image'    => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?w=720&q=80&auto=format&fit=crop',
  ),
  array(
    'location' => 'Kyoto, Japan',
    'distance' => '6,740 miles away',
    'dates'    => 'Dec 5 - 10',
    'price'    => '$245',
    'rating'   => '4.99',
    'badge'    => '',
    'image'    => 'https://images.unsplash.com/photo-1545569341-9eb8b30979d9?w=720&q=80&auto=format&fit=crop',
  ),
  array(
    'location' => 'Santorini, Greece',
    'distance' => '6,112 miles away',
    'dates'    => 'Nov 30 - Dec 5',
    'price'    => '$420',
    'rating'   => '4.96',
    'badge'    => 'Guest favorite',
    'image'    => 'https://images.unsplash.com/photo-1570077188670-e3a8d69ac5ff?w=720&q=80&auto=format&fit=crop',
  ),
  array(
    'location' => 'Bali, Indonesia',
    'distance' => '9,215 miles away',
    'dates'    => 'Dec 8 - 13',
    'price'    => '$195',
    'rating'   => '4.93',
    'badge'    => '',
    'image'    => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=720&q=80&auto=format&fit=crop',
  ),
  array(
    'location' => 'Patagonia, Argentina',
    'distance' => '7,831 miles away',
    'dates'    => 'Dec 2 - 7',
    'price'    => '$340',
    'rating'   => '4.98',
    'badge'    => 'Guest favorite',
    'image'    => 'https://images.unsplash.com/photo-1501854140801-50d01698950b?w=720&q=80&auto=format&fit=crop',
  ),
  array(
    'location' => 'Amalfi Coast, Italy',
    'distance' => '5,698 miles away',
    'dates'    => 'Dec 10 - 15',
    'price'    => '$390',
    'rating'   => '4.94',
    'badge'    => 'Guest favorite',
    'image'    => 'https://images.unsplash.com/photo-1612698093158-e07ac200d44e?w=720&q=80&auto=format&fit=crop',
  ),
  array(
    'location' => 'Cape Town, South Africa',
    'distance' => '9,908 miles away',
    'dates'    => 'Nov 25 - 30',
    'price'    => '$275',
    'rating'   => '4.91',
    'badge'    => '',
    'image'    => 'https://images.unsplash.com/photo-1580060839134-75a5edca2e99?w=720&q=80&auto=format&fit=crop',
  ),
);
?>

<section
  class="airbnb-listings"
  aria-label="<?php esc_attr_e( 'Available properties', 'inf' ); ?>"
>
  <div class="airbnb-listings__heading">
    <h2 class="airbnb-listings__title"><?php esc_html_e( 'Popular stays near you', 'inf' ); ?></h2>
    <div class="airbnb-listings__nav">
      <button class="airbnb-listings__nav-btn" type="button" aria-label="<?php esc_attr_e( 'Previous', 'inf' ); ?>">
        <svg viewBox="0 0 12 12" aria-hidden="true" focusable="false">
          <path d="M8 1L3 6l5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        </svg>
      </button>
      <button class="airbnb-listings__nav-btn" type="button" aria-label="<?php esc_attr_e( 'Next', 'inf' ); ?>">
        <svg viewBox="0 0 12 12" aria-hidden="true" focusable="false">
          <path d="M4 1l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        </svg>
      </button>
    </div>
  </div>

  <div class="airbnb-listings__grid">
    <?php foreach ( $listings as $listing ) : ?>
      <article class="airbnb-card">

        <div class="airbnb-card__media">
          <?php if ( ! empty( $listing['badge'] ) ) : ?>
            <span class="airbnb-card__badge">
              <?php echo esc_html( $listing['badge'] ); ?>
            </span>
          <?php endif; ?>

          <img
            class="airbnb-card__image"
            src="<?php echo esc_url( $listing['image'] ); ?>"
            alt="<?php echo esc_attr( $listing['location'] ); ?>"
            loading="lazy"
            width="720"
            height="480"
          >

          <button
            class="airbnb-card__wishlist"
            type="button"
            aria-label="<?php printf( esc_attr__( 'Save %s to wishlist', 'inf' ), esc_attr( $listing['location'] ) ); ?>"
            aria-pressed="false"
          >
            <svg viewBox="0 0 32 32" aria-hidden="true" focusable="false">
              <path d="M16 28c7-4.73 14-10 14-17a6.98 6.98 0 00-7-7c-1.8 0-3.58.68-4.95 2.05L16 8.1l-2.05-2.05a6.98 6.98 0 00-9.9 9.9C5.2 18 16 28 16 28z" stroke="currentColor" stroke-width="2" fill="none"/>
            </svg>
          </button>
        </div>

        <div class="airbnb-card__body">
          <div class="airbnb-card__row">
            <h3 class="airbnb-card__location"><?php echo esc_html( $listing['location'] ); ?></h3>
            <div
              class="airbnb-card__rating"
              aria-label="<?php printf( esc_attr__( 'Rated %s', 'inf' ), esc_attr( $listing['rating'] ) ); ?>"
            >
              <svg class="airbnb-card__star" viewBox="0 0 32 32" aria-hidden="true" focusable="false">
                <path d="M15.094 1.579l-4.124 8.885-9.86 1.27a1 1 0 00-.542 1.736l7.293 6.565-1.965 9.852a1 1 0 001.483 1.061L16 25.951l8.625 4.997a1 1 0 001.483-1.06l-1.965-9.853 7.292-6.565a1 1 0 00-.541-1.735l-9.86-1.271-4.127-8.885a1 1 0 00-1.813 0z" fill="currentColor"/>
              </svg>
              <span><?php echo esc_html( $listing['rating'] ); ?></span>
            </div>
          </div>

          <p class="airbnb-card__distance"><?php echo esc_html( $listing['distance'] ); ?></p>
          <p class="airbnb-card__dates"><?php echo esc_html( $listing['dates'] ); ?></p>
          <p class="airbnb-card__price">
            <strong><?php echo esc_html( $listing['price'] ); ?></strong>
            <span><?php esc_html_e( 'night', 'inf' ); ?></span>
          </p>
        </div>

      </article>
    <?php endforeach; ?>
  </div>
</section>