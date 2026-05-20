<?php
/**
 * Card template part for the `case-result` CPT.
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
$excerpt   = get_the_excerpt( $card_post );

$amount_display = '';
$result_type    = '';
$practice_area  = null;
if ( function_exists( 'get_field' ) ) {
    $amount_display = (string) get_field( 'amount_display', $post_id );
    $result_type    = (string) get_field( 'result_type', $post_id );
    $practice_area  = get_field( 'practice_area', $post_id );
}

$practice_area_title = '';
$practice_area_link  = '';
if ( $practice_area instanceof WP_Post ) {
    $practice_area_title = get_the_title( $practice_area->ID );
    $practice_area_link  = get_permalink( $practice_area->ID );
}
?>
<article class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col">
    <?php if ( $amount_display ) : ?>
        <div class="bg-blue-700 text-white px-6 py-6 text-center">
            <span class="block text-3xl md:text-4xl font-bold tracking-tight">
                <?php echo esc_html( $amount_display ); ?>
            </span>
            <?php if ( $result_type ) : ?>
                <span class="inline-block mt-2 px-3 py-1 text-xs font-semibold uppercase tracking-wide bg-white text-blue-800 rounded-full">
                    <?php echo esc_html( $result_type ); ?>
                </span>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="p-6 flex flex-col flex-1">
        <h3 class="text-xl font-semibold text-gray-900">
            <a href="<?php echo esc_url( $permalink ); ?>" class="hover:text-blue-700 transition">
                <?php echo esc_html( $title ); ?>
            </a>
        </h3>

        <?php if ( $practice_area_title ) : ?>
            <div class="mt-2">
                <a
                    href="<?php echo esc_url( $practice_area_link ); ?>"
                    class="inline-block px-3 py-1 text-xs font-semibold uppercase tracking-wide bg-gray-100 text-gray-800 rounded-full hover:bg-gray-200 transition"
                >
                    <?php echo esc_html( $practice_area_title ); ?>
                </a>
            </div>
        <?php endif; ?>

        <?php if ( $excerpt ) : ?>
            <p class="mt-3 text-gray-600 leading-relaxed">
                <?php echo esc_html( $excerpt ); ?>
            </p>
        <?php endif; ?>
    </div>
</article>
