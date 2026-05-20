<?php
/**
 * Hero Banner render template.
 *
 * @package PugPuggle
 *
 * @var array $attributes
 */

if ( class_exists( '\\PugPuggle\\Assets' ) ) {
	\PugPuggle\Assets::enqueue_block( 'hero-banner' );
}

$heading              = isset( $attributes['heading'] ) ? (string) $attributes['heading'] : '';
$subheading           = isset( $attributes['subheading'] ) ? (string) $attributes['subheading'] : '';
$primary_cta_url      = isset( $attributes['primaryCtaUrl'] ) ? (string) $attributes['primaryCtaUrl'] : '';
$primary_cta_title    = isset( $attributes['primaryCtaTitle'] ) ? (string) $attributes['primaryCtaTitle'] : '';
$primary_cta_newtab   = ! empty( $attributes['primaryCtaNewTab'] );
$secondary_cta_url    = isset( $attributes['secondaryCtaUrl'] ) ? (string) $attributes['secondaryCtaUrl'] : '';
$secondary_cta_title  = isset( $attributes['secondaryCtaTitle'] ) ? (string) $attributes['secondaryCtaTitle'] : '';
$secondary_cta_newtab = ! empty( $attributes['secondaryCtaNewTab'] );
$bg_url               = isset( $attributes['backgroundImageUrl'] ) ? (string) $attributes['backgroundImageUrl'] : '';

$style_attr = '';
if ( '' !== $bg_url ) {
	$style_attr = ' style="background-image: url(\'' . esc_url( $bg_url ) . '\'); background-size: cover; background-position: center;"';
}

$has_primary   = '' !== $primary_cta_url;
$has_secondary = '' !== $secondary_cta_url;
?>
<section class="inf-block inf-hero-banner bg-stone-900 text-white py-24 px-6 text-center relative"<?php echo $style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- preformed escaped string. ?>>
	<?php if ( '' !== $bg_url ) : ?>
		<div class="absolute inset-0 bg-stone-900/60" aria-hidden="true"></div>
	<?php endif; ?>
	<div class="relative z-10">
		<?php if ( '' !== $heading ) : ?>
			<h2 class="text-4xl md:text-5xl font-bold"><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>

		<?php if ( '' !== $subheading ) : ?>
			<p class="text-lg md:text-xl mt-4 max-w-2xl mx-auto"><?php echo esc_html( $subheading ); ?></p>
		<?php endif; ?>

		<?php if ( $has_primary || $has_secondary ) : ?>
			<div class="mt-8 flex justify-center gap-4 flex-wrap">
				<?php if ( $has_primary ) : ?>
					<a
						href="<?php echo esc_url( $primary_cta_url ); ?>"
						class="bg-white text-stone-900 px-6 py-3 rounded font-semibold"
						<?php echo $primary_cta_newtab ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
					>
						<?php echo esc_html( '' !== $primary_cta_title ? $primary_cta_title : __( 'Learn More', 'inf' ) ); ?>
					</a>
				<?php endif; ?>

				<?php if ( $has_secondary ) : ?>
					<a
						href="<?php echo esc_url( $secondary_cta_url ); ?>"
						class="border border-white px-6 py-3 rounded"
						<?php echo $secondary_cta_newtab ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
					>
						<?php echo esc_html( '' !== $secondary_cta_title ? $secondary_cta_title : __( 'Contact Us', 'inf' ) ); ?>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
