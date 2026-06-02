<?php
/**
 * Property card template part.
 *
 * Renders a single property listing card with image, rating,
 * title, location, bedrooms, and price.
 *
 * @package infra
 * @var WP_Post $post The property post object.
 */

$price      = get_post_meta( $post->ID, '_inf_price',  true ) ?: '120';
$bedrooms   = get_post_meta( $post->ID, '_inf_bedrooms', true ) ?: '2';
$location   = get_post_meta( $post->ID, '_inf_location', true );
$rating     = get_post_meta( $post->ID, '_inf_rating', true );
$title      = get_the_title( $post->ID );

$fallback_img = get_theme_file_uri( '/assets/images/placeholder-property.svg' );
$image_url    = get_the_post_thumbnail_url( $post->ID, 'large' ) ?: $fallback_img;
?>
<article class="group cursor-pointer">
    <div class="relative aspect-[4/3] rounded-xl overflow-hidden shadow-sm">
        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" loading="lazy">
        
        <!-- Rating bubble (top-right overlay) -->
        <span class="absolute top-3 right-3 bg-white/95 backdrop-blur-sm px-2 py-1 rounded-lg text-xs font-bold text-gray-800 shadow-sm flex items-center gap-1">
            <svg class="w-3 h-3 text-airbnb fill-current" viewBox="0 0 24 24">
                <path d="M12 .587l3.668 7.431 8.2 1.192-5.934 5.787 1.4 8.168L12 18.896l-7.334 3.857 1.4-8.168L.132 9.21l8.2-1.192z"/>
            </svg>
            <?php echo esc_html( round(floatval($rating), 2) ); ?>
        </span>
    </div>
    
    <div class="mt-3">
        <div class="flex items-center justify-between">
            <h3 class="font-bold text-sm text-neutral-800 truncate pr-4"><?php echo esc_html( $title ); ?></h3>
        </div>
        <p class="text-xs text-neutral-500 mt-1"><?php echo esc_html( $location ); ?></p>
        <p class="text-xs text-neutral-500 mt-0.5"><?php echo esc_html( $bedrooms ); ?> bedrooms</p>
        <p class="text-sm font-bold text-neutral-800 mt-2">
            $<?php echo esc_html( number_format((int)$price) ); ?> <span class="font-normal text-xs text-neutral-500">night</span>
        </p>
    </div>
</article>