<?php
/**
 * Front page partial: the info banner.
 *
 * A slim announcement bar echoing Airbnb's mid-2020 COVID notice, repurposed as
 * a friendly Dog House message. Copy is editable from the Customizer
 * ( Appearance → Customize ) via theme mods, with sensible defaults, so a
 * content editor never has to touch a template.
 *
 * @package infra
 */

defined( 'ABSPATH' ) || exit;

$doghouse_banner_text      = get_theme_mod(
	'doghouse_banner_text',
	__( 'Flexible cancellation on every stay — because plans change and tails wag.', 'inf' )
);
$doghouse_banner_link_text = get_theme_mod( 'doghouse_banner_link_text', __( 'Learn more', 'inf' ) );
$doghouse_banner_link_url  = get_theme_mod( 'doghouse_banner_link_url', '' );

// Nothing to announce? Don't render an empty bar.
if ( '' === trim( (string) $doghouse_banner_text ) ) {
	return;
}
?>
<div class="doghouse-banner bg-doghouse-bg border-b border-doghouse-line text-doghouse-ink">
	<div class="container mx-auto px-6 py-3 text-center text-sm">
		<span aria-hidden="true">🐾</span>
		<span><?php echo esc_html( $doghouse_banner_text ); ?></span>
		<?php if ( '' !== trim( (string) $doghouse_banner_link_url ) ) : ?>
			<a class="font-semibold underline underline-offset-2 hover:text-doghouse" href="<?php echo esc_url( $doghouse_banner_link_url ); ?>">
				<?php echo esc_html( $doghouse_banner_link_text ); ?>
			</a>
		<?php endif; ?>
	</div>
</div>
