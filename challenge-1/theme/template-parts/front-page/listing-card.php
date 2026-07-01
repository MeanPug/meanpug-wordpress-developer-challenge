<?php
/**
 * Template part: Listing Card
 *
 * Reusable card consumed by both listings sections (homes & hotels).
 * Receives data via $args. Styled entirely with Tailwind utility classes.
 *
 * Expected $args keys:
 *   string  image_url    Absolute URL to listing photo.
 *   string  image_alt    Accessible alt text.
 *   string  title        Listing title.
 *   string  subtitle     Short descriptor (price / nights).
 *   string  rating       Star rating value e.g. "4.94".
 *   bool    is_favorite  Whether to show the badge.
 *   string  badge_label  Override label for the badge.
 *
 * @package infra
 */

$card = wp_parse_args( $args, array(
    'image_url'   => '',
    'image_alt'   => '',
    'title'       => '',
    'subtitle'    => '',
    'rating'      => '',
    'is_favorite' => false,
    'badge_label' => __( 'Guest favorite', 'inf' ),
) );
?>
<article class="flex flex-col gap-2 group cursor-pointer">

    <!-- Image + Overlays -->
    <div class="relative rounded-xl overflow-hidden bg-gray-100 aspect-square">

        <img src="<?php echo esc_url( $card['image_url'] ); ?>"
             alt="<?php echo esc_attr( $card['image_alt'] ); ?>"
             class="w-full h-full object-cover block transition-transform duration-300 group-hover:scale-102"
             width="300" height="300" loading="lazy">

        <?php if ( $card['is_favorite'] ) : ?>
            <span class="absolute top-3 left-3 bg-white text-[#222222] text-[12px] font-bold px-3 py-1 rounded-full shadow-[0_2px_4px_rgba(0,0,0,0.1)] border border-gray-100 whitespace-nowrap select-none">
                <?php echo esc_html( $card['badge_label'] ); ?>
            </span>
        <?php endif; ?>

        <!-- Wishlist Button -->
        <button class="absolute top-3 right-3 bg-transparent border-0 cursor-pointer p-1 text-white hover:scale-105 transition-transform flex items-center justify-center filter drop-shadow-[0_2px_4px_rgba(0,0,0,0.5)]"
                aria-label="<?php esc_attr_e( 'Add to wishlist', 'inf' ); ?>">
            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" class="h-6 w-6 stroke-white stroke-2 fill-black/50 hover:fill-[#FF385C] hover:stroke-[#FF385C] transition-all">
                <path d="m16 28c7-4.733 14-10 14-17 0-4.417-3.583-8-8-8-2.6 0-4.883 1.25-6 3.167-1.117-1.917-3.4-3.167-6-3.167-4.417 0-8 3.583-8 8 0 7 7 12.267 14 17z"></path>
            </svg>
        </button>

    </div>

    <!-- Card Body -->
    <div class="flex flex-col gap-0.5 mt-1">

        <h3 class="text-sm font-semibold text-[#222222] m-0 leading-tight line-clamp-1">
            <?php echo esc_html( $card['title'] ); ?>
        </h3>

        <p class="text-sm text-[#717171] m-0 leading-snug">
            <?php echo esc_html( $card['subtitle'] ); ?>
            <?php if ( $card['rating'] ) : ?>
                <span class="text-xs font-semibold text-[#222222] ml-0.5"
                      aria-label="<?php echo esc_attr( sprintf( __( 'Rating: %s stars', 'inf' ), $card['rating'] ) ); ?>">
                    • ★ <?php echo esc_html( $card['rating'] ); ?>
                </span>
            <?php endif; ?>
        </p>

    </div>

</article>
