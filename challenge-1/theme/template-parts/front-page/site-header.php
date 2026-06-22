<?php
/**
 * Front page partial: the brand header bar.
 *
 * Logo lockup (featuring the required MeanPug "Best in Show" pug), the host
 * navigation, a language/region globe, and an account pill — mirroring the
 * Airbnb header from docs/AirPnP.png. Visual only: the controls are real,
 * labelled, keyboard-focusable buttons, but they intentionally don't open menus
 * (functionality isn't part of this challenge).
 *
 * @package infra
 */

defined( 'ABSPATH' ) || exit;

$doghouse_pug  = get_stylesheet_directory_uri() . '/assets/images/meanpug-best-in-show.png';
$doghouse_home = home_url( '/' );
$doghouse_name = get_bloginfo( 'name' ) ? get_bloginfo( 'name' ) : __( 'The Dog House', 'inf' );
?>
<div class="doghouse-bar bg-white">
	<div class="container mx-auto px-6 flex items-center justify-between gap-4 py-4">

		<!-- Brand -->
		<a href="<?php echo esc_url( $doghouse_home ); ?>" class="flex items-center gap-2 shrink-0" aria-label="<?php echo esc_attr( sprintf( /* translators: %s: site name. */ __( '%s — home', 'inf' ), $doghouse_name ) ); ?>">
			<img src="<?php echo esc_url( $doghouse_pug ); ?>" alt="" width="40" height="40" class="w-9 h-9 sm:w-10 sm:h-10" decoding="async" />
			<span class="font-brand text-doghouse text-xl sm:text-2xl font-extrabold tracking-tight"><?php esc_html_e( 'The Dog House', 'inf' ); ?></span>
		</a>

		<!-- Host navigation (hidden on small screens, like the reference) -->
		<nav class="hidden md:flex items-center gap-1 text-sm font-semibold text-doghouse-ink" aria-label="<?php esc_attr_e( 'Host navigation', 'inf' ); ?>">
			<a class="px-4 py-2 rounded-full hover:bg-doghouse-bg transition-colors" href="#"><?php esc_html_e( 'Host your den', 'inf' ); ?></a>
			<a class="px-4 py-2 rounded-full hover:bg-doghouse-bg transition-colors" href="#"><?php esc_html_e( 'Host an experience', 'inf' ); ?></a>
			<a class="px-4 py-2 rounded-full hover:bg-doghouse-bg transition-colors" href="#"><?php esc_html_e( 'Help', 'inf' ); ?></a>
		</nav>

		<!-- Account cluster -->
		<div class="flex items-center gap-1 shrink-0">
			<button type="button" class="hidden sm:inline-flex items-center justify-center w-10 h-10 rounded-full text-doghouse-ink hover:bg-doghouse-bg transition-colors" aria-label="<?php esc_attr_e( 'Choose a language and region', 'inf' ); ?>">
				<svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false">
					<circle cx="12" cy="12" r="9" />
					<path d="M3 12h18" />
					<path d="M12 3c2.5 2.5 3.8 5.7 3.8 9s-1.3 6.5-3.8 9c-2.5-2.5-3.8-5.7-3.8-9S9.5 5.5 12 3z" />
				</svg>
			</button>

			<button type="button" class="flex items-center gap-2 border border-doghouse-line rounded-full pl-3 pr-1 py-1 hover:shadow-md transition-shadow" aria-haspopup="true" aria-expanded="false" aria-label="<?php esc_attr_e( 'Main navigation and account menu', 'inf' ); ?>">
				<svg class="w-4 h-4 text-doghouse-ink" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false">
					<path d="M3 6h18M3 12h18M3 18h18" />
				</svg>
				<span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-doghouse-ink overflow-hidden">
					<img src="<?php echo esc_url( $doghouse_pug ); ?>" alt="" width="32" height="32" class="w-full h-full object-cover" decoding="async" />
				</span>
			</button>
		</div>
	</div>
</div>
