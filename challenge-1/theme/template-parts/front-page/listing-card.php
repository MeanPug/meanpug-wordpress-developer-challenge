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
    <div class="relative rounded-xl overflow-hidden bg-gray-200 aspect-[3/2]">

        <img src="<?php echo esc_url( $card['image_url'] ); ?>"
             alt="<?php echo esc_attr( $card['image_alt'] ); ?>"
             class="w-full h-full object-cover block transition-transform duration-300 group-hover:scale-105"
             width="300" height="200" loading="lazy">

        <?php if ( $card['is_favorite'] ) : ?>
            <span class="absolute top-3 left-3 bg-white text-gray-900 text-xs font-semibold px-2.5 py-1 rounded-full shadow-sm whitespace-nowrap">
                <?php echo esc_html( $card['badge_label'] ); ?>
            </span>
        <?php endif; ?>

        <button class="absolute top-3 right-3 bg-transparent border-0 cursor-pointer p-1 text-white drop-shadow-md flex items-center justify-center hover:scale-110 transition-transform"
                aria-label="<?php esc_attr_e( 'Add to wishlist', 'inf' ); ?>">
            <svg viewBox="0 0 32 32" width="18" height="18" class="fill-current" aria-hidden="true" focusable="false">
                <path d="M16 28c-.3 0-.6-.1-.8-.3C4.3 18.4 1 14.8 1 10.5 1 6.4 4.3 3 8.3 3c2.3 0 4.4 1.1 5.7 2.9C15.3 4.1 17.4 3 19.7 3 23.7 3 27 6.4 27 10.5c0 4.3-3.3 7.9-14.2 17.2-.2.2-.5.3-.8.3z"/>
            </svg>
        </button>

    </div>

    <!-- Card Body -->
    <div class="flex flex-col gap-0.5">

        <div class="flex items-start justify-between gap-2">
            <h3 class="text-sm font-semibold text-gray-900 m-0 leading-tight line-clamp-2 flex-1">
                <?php echo esc_html( $card['title'] ); ?>
            </h3>
            <?php if ( $card['rating'] ) : ?>
                <span class="flex items-center gap-1 text-xs font-medium text-gray-900 whitespace-nowrap flex-shrink-0"
                      aria-label="<?php echo esc_attr( sprintf( __( 'Rating: %s stars', 'inf' ), $card['rating'] ) ); ?>">
                    <svg viewBox="0 0 32 32" width="10" height="10" class="fill-current" aria-hidden="true" focusable="false">
                        <path d="M15.094 1.579l-4.124 8.885-9.86 1.27a1 1 0 00-.542 1.736l7.293 6.565-1.965 9.852a1 1 0 001.483 1.061L16 25.951l8.625 4.997a1 1 0 001.482-1.06l-1.965-9.853 7.293-6.565a1 1 0 00-.541-1.735l-9.86-1.271-4.127-8.885a1 1 0 00-1.813 0z" fill-rule="evenodd"/>
                    </svg>
                    <?php echo esc_html( $card['rating'] ); ?>
                </span>
            <?php endif; ?>
        </div>

        <p class="text-xs text-gray-500 m-0 leading-snug">
            <?php echo esc_html( $card['subtitle'] ); ?>
        </p>

    </div>

</article>
