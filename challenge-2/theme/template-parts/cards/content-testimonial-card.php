<?php
/**
 * Card template part for the `testimonials` CPT.
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
$permalink = get_permalink( $post_id );

$rating        = 0;
$reviewer_name = '';
if ( function_exists( 'get_field' ) ) {
    $rating   = (int) get_field( 'rating', $post_id );
    $reviewer = get_field( 'reviewer', $post_id );
    if ( is_array( $reviewer ) && ! empty( $reviewer['name'] ) ) {
        $reviewer_name = (string) $reviewer['name'];
    }
}

if ( $rating < 0 ) {
    $rating = 0;
}
if ( $rating > 5 ) {
    $rating = 5;
}

$quote = get_the_excerpt( $card_post );
?>
<article class="bg-white rounded-lg shadow hover:shadow-lg transition p-6 flex flex-col h-full">
    <div
        class="flex items-center text-yellow-500 text-lg"
        aria-label="<?php echo esc_attr( sprintf( __( 'Rating: %d out of 5 stars', 'inf' ), $rating ) ); ?>"
    >
        <?php
        for ( $i = 1; $i <= 5; $i++ ) :
            $char = ( $i <= $rating ) ? '&#9733;' : '&#9734;';
            ?>
            <span aria-hidden="true"><?php echo $char; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
        <?php endfor; ?>
    </div>

    <?php if ( $quote ) : ?>
        <blockquote class="mt-4 text-gray-700 italic leading-relaxed line-clamp-3">
            <?php echo esc_html( $quote ); ?>
        </blockquote>
    <?php endif; ?>

    <?php if ( $reviewer_name ) : ?>
        <p class="mt-4 text-sm font-semibold text-gray-900">
            &mdash; <?php echo esc_html( $reviewer_name ); ?>
        </p>
    <?php endif; ?>

    <a
        href="<?php echo esc_url( $permalink ); ?>"
        class="sr-only"
    >
        <?php esc_html_e( 'Read full testimonial', 'inf' ); ?>
    </a>
</article>
