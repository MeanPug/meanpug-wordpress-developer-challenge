<?php
/**
 * Card template part for the `office` CPT.
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

$address       = array();
$contact_phone = array();
if ( function_exists( 'get_field' ) ) {
    $address       = (array) get_field( 'address', $post_id );
    $contact_phone = (array) get_field( 'contact_phone', $post_id );
}

$formatted_address = '';
if ( ! empty( $address ) && function_exists( 'inf_format_address' ) ) {
    $formatted_address = inf_format_address(
        isset( $address['postal_code'] ) ? $address['postal_code'] : '',
        isset( $address['state'] ) ? $address['state'] : '',
        isset( $address['city'] ) ? $address['city'] : '',
        isset( $address['street'] ) ? $address['street'] : '',
        isset( $address['street2'] ) ? $address['street2'] : ''
    );
}

$phone_url   = isset( $contact_phone['url'] ) ? $contact_phone['url'] : '';
$phone_title = isset( $contact_phone['title'] ) ? $contact_phone['title'] : '';
?>
<article class="bg-white rounded-lg shadow hover:shadow-lg transition p-6 flex flex-col h-full">
    <h3 class="text-xl font-semibold text-gray-900">
        <a href="<?php echo esc_url( $permalink ); ?>" class="hover:text-blue-700 transition">
            <?php echo esc_html( $title ); ?>
        </a>
    </h3>

    <?php if ( $formatted_address ) : ?>
        <address class="mt-3 not-italic text-gray-700 leading-relaxed">
            <?php echo wp_kses_post( $formatted_address ); ?>
        </address>
    <?php endif; ?>

    <?php if ( $phone_url && $phone_title ) : ?>
        <a
            href="<?php echo esc_url( $phone_url ); ?>"
            class="mt-4 inline-flex items-center text-sm font-semibold text-blue-700 hover:underline"
        >
            <?php echo esc_html( $phone_title ); ?>
        </a>
    <?php endif; ?>
</article>
