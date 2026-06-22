<?php
/**
 * Front page partial: the hero card.
 *
 * The Airbnb reference fills this slot with a solid black card carrying a
 * "#BlackLivesMatter" message. We deliberately do NOT co-opt that movement's
 * messaging for a pug pun. Instead we ship an on-brand, good-citizen hero: a
 * tasteful adoption nudge that also satisfies the challenge's one hard
 * requirement — featuring a MeanPug pug — front and centre.
 *
 * All copy is editable from the Customizer via theme mods.
 *
 * @package infra
 */

defined( 'ABSPATH' ) || exit;

$doghouse_pug         = get_stylesheet_directory_uri() . '/assets/images/meanpug-best-in-show.png';
$doghouse_hero_title  = get_theme_mod( 'doghouse_hero_title', __( 'Every good dog deserves a great stay.', 'inf' ) );
$doghouse_hero_body   = get_theme_mod( 'doghouse_hero_body', __( 'Book a Dog House and a portion of every stay helps a shelter pup find their forever home. Best in show, best in heart.', 'inf' ) );
$doghouse_hero_cta    = get_theme_mod( 'doghouse_hero_cta_text', __( 'Learn more', 'inf' ) );
$doghouse_hero_cta_to = get_theme_mod( 'doghouse_hero_cta_url', '#' );
?>
<section class="doghouse-hero" aria-labelledby="doghouse-hero-heading">
	<div class="container mx-auto px-6 pt-8 pb-4">
		<div class="relative overflow-hidden rounded-3xl bg-doghouse-ink text-white">
			<div class="flex flex-col items-center gap-6 px-8 py-10 md:flex-row md:gap-10 md:px-14 md:py-14">
				<div class="order-2 max-w-xl text-center md:order-1 md:text-left">
					<h1 id="doghouse-hero-heading" class="font-brand text-3xl font-extrabold leading-tight sm:text-4xl md:text-5xl">
						<?php echo esc_html( $doghouse_hero_title ); ?>
					</h1>
					<p class="mt-4 text-base text-white/80 sm:text-lg">
						<?php echo esc_html( $doghouse_hero_body ); ?>
					</p>
					<a class="mt-7 inline-flex items-center justify-center rounded-lg bg-white px-6 py-3 font-semibold text-doghouse-ink transition-colors hover:bg-doghouse hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-doghouse-ink" href="<?php echo esc_url( $doghouse_hero_cta_to ); ?>">
						<?php echo esc_html( $doghouse_hero_cta ); ?>
					</a>
				</div>
				<div class="order-1 shrink-0 md:order-2">
					<img
						src="<?php echo esc_url( $doghouse_pug ); ?>"
						alt="<?php esc_attr_e( 'MeanPug’s Best in Show pug', 'inf' ); ?>"
						width="220"
						height="220"
						class="h-36 w-36 drop-shadow-2xl sm:h-44 sm:w-44 md:h-56 md:w-56"
						decoding="async"
						fetchpriority="high"
					/>
				</div>
			</div>
		</div>
	</div>
</section>
