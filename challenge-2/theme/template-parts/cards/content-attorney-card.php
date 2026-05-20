<?php
/**
 * Card template part for the `attorney` CPT.
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

$position = '';
if ( function_exists( 'get_field' ) ) {
    $position = (string) get_field( 'position', $post_id );
}

$specialty_label = '';
$specialty_terms = get_the_terms( $post_id, 'attorney-specialty' );
if ( ! is_wp_error( $specialty_terms ) && ! empty( $specialty_terms ) ) {
    $specialty_label = $specialty_terms[0]->name;
}
?>
<article class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden flex flex-col">
    <a
        href="<?php echo esc_url( $permalink ); ?>"
        class="block"
        aria-label="<?php echo esc_attr( sprintf( __( 'View profile of %s', 'inf' ), $title ) ); ?>"
    >
        <?php if ( $thumbnail ) : ?>
            <img
                src="<?php echo esc_url( $thumbnail ); ?>"
                alt="<?php echo esc_attr( $title ); ?>"
                class="w-full aspect-square object-cover"
                loading="lazy"
            />
        <?php else : ?>
            <div class="w-full aspect-square bg-gray-200" aria-hidden="true"></div>
        <?php endif; ?>
    </a>

    <div class="p-6 flex flex-col flex-1">
        <h3 class="text-xl font-semibold text-gray-900">
            <a href="<?php echo esc_url( $permalink ); ?>" class="hover:text-blue-700 transition">
                <?php echo esc_html( $title ); ?>
            </a>
        </h3>

        <?php if ( $position ) : ?>
            <p class="text-sm text-gray-600 mt-1">
                <?php echo esc_html( $position ); ?>
            </p>
        <?php endif; ?>

        <?php if ( $specialty_label ) : ?>
            <span class="inline-block self-start mt-3 px-3 py-1 text-xs font-semibold uppercase tracking-wide bg-blue-100 text-blue-800 rounded-full">
                <?php echo esc_html( $specialty_label ); ?>
            </span>
        <?php endif; ?>

        <a
            href="<?php echo esc_url( $permalink ); ?>"
            class="mt-auto pt-4 text-sm font-semibold text-blue-700 hover:underline"
        >
            <?php esc_html_e( 'View Profile', 'inf' ); ?> &rarr;
        </a>
    </div>
</article>
