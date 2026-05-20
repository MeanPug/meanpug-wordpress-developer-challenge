<?php
/**
 * CTA Banner render template.
 *
 * @package PugPuggle
 *
 * @var array $attributes Block attributes (provided by WP_Block_Type render).
 */

if ( class_exists( '\\PugPuggle\\Assets' ) ) {
	\PugPuggle\Assets::enqueue_block( 'cta-banner' );
}

$heading    = isset( $attributes['heading'] ) ? (string) $attributes['heading'] : '';
$body       = isset( $attributes['body'] ) ? (string) $attributes['body'] : '';
$cta_url    = isset( $attributes['ctaUrl'] ) ? (string) $attributes['ctaUrl'] : '';
$cta_title  = isset( $attributes['ctaTitle'] ) ? (string) $attributes['ctaTitle'] : '';
$cta_newtab = ! empty( $attributes['ctaNewTab'] );

$has_cta = '' !== $cta_url;
?>
<section class="inf-block inf-cta-banner bg-stone-900 text-white py-16 px-6">
	<div class="max-w-4xl mx-auto text-center">
		<?php if ( '' !== $heading ) : ?>
			<h2 class="text-3xl md:text-4xl font-bold"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php if ( '' !== $body ) : ?>
			<p class="mt-4 text-lg"><?php echo esc_html( $body ); ?></p>
		<?php endif; ?>

		<?php if ( $has_cta ) : ?>
			<div class="mt-8">
				<a
					href="<?php echo esc_url( $cta_url ); ?>"
					class="bg-white text-stone-900 px-6 py-3 rounded font-semibold inline-block"
					<?php echo $cta_newtab ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
				>
					<?php echo esc_html( '' !== $cta_title ? $cta_title : __( 'Learn More', 'inf' ) ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>
