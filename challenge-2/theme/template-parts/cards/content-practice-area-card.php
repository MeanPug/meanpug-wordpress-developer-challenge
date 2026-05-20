<?php
/**
 * Card template part for the `practice-area` CPT.
 *
 * Reads the post from `card_post` query var if provided, otherwise falls back
 * to the global $post (for use inside the_loop()).
 *
 * @package infra
 */

$card_post = get_query_var( 'card_post' );
if ( ! $card_post ) {
    global $post;
    $card_post = $post;
}

if ( ! $card_post instanceof WP_Post ) {
    return;
}

$post_id   = (int) $card_post->ID;
$title     = get_the_title( $post_id );
$permalink = get_permalink( $post_id );
$thumbnail = get_the_post_thumbnail_url( $post_id, 'medium_large' );
$excerpt   = get_the_excerpt( $card_post );
?>
<article class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
    <a
        href="<?php echo esc_url( $permalink ); ?>"
        class="block group"
        aria-label="<?php echo esc_attr( sprintf( __( 'Learn more about %s', 'inf' ), $title ) ); ?>"
    >
        <?php if ( $thumbnail ) : ?>
            <div class="aspect-w-16 aspect-h-9 overflow-hidden">
                <img
                    src="<?php echo esc_url( $thumbnail ); ?>"
                    alt="<?php echo esc_attr( $title ); ?>"
                    class="w-full h-48 object-cover rounded-t-lg"
                    loading="lazy"
                />
            </div>
        <?php endif; ?>

        <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-900 group-hover:text-blue-700 transition">
                <?php echo esc_html( $title ); ?>
            </h3>

            <?php if ( $excerpt ) : ?>
                <p class="mt-3 text-gray-600 leading-relaxed">
                    <?php echo esc_html( $excerpt ); ?>
                </p>
            <?php endif; ?>

            <span class="inline-block mt-4 text-sm font-semibold text-blue-700 group-hover:underline">
                <?php esc_html_e( 'Learn More', 'inf' ); ?> &rarr;
            </span>
        </div>
    </a>
</article>
