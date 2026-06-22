<?php
/**
 * Front page partial: the three-segment search bar.
 *
 * Visual fidelity to the Airbnb reference, but built as a genuine, accessible
 * <form>: every segment has an associated <label>, the control group is
 * keyboard-navigable, and the submit button has a real accessible name. Search
 * isn't wired to a handler (not required by this challenge); the form simply
 * GETs back to the home URL, so there is never any broken behaviour.
 *
 * @package infra
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="doghouse-search bg-white">
	<div class="container mx-auto px-6 pb-5 pt-1">
		<form
			class="mx-auto flex max-w-4xl flex-col overflow-hidden rounded-3xl border border-doghouse-line bg-white shadow-sm md:flex-row md:items-stretch md:rounded-full"
			role="search"
			aria-label="<?php esc_attr_e( 'Find a stay', 'inf' ); ?>"
			action="<?php echo esc_url( home_url( '/' ) ); ?>"
			method="get"
		>
			<div class="flex-1 px-6 py-3 hover:bg-doghouse-bg md:py-2 md:transition-colors">
				<label class="block text-xs font-bold uppercase tracking-wide text-doghouse-ink" for="doghouse-location"><?php esc_html_e( 'Location', 'inf' ); ?></label>
				<input class="w-full border-0 bg-transparent p-0 text-sm text-doghouse-ink placeholder-doghouse-muted focus:outline-none focus:ring-0" type="text" id="doghouse-location" name="location" placeholder="<?php esc_attr_e( 'Where are you fetching to?', 'inf' ); ?>" autocomplete="off" />
			</div>

			<div class="flex-1 border-t border-doghouse-line px-6 py-3 hover:bg-doghouse-bg md:border-l md:border-t-0 md:py-2 md:transition-colors">
				<label class="block text-xs font-bold uppercase tracking-wide text-doghouse-ink" for="doghouse-checkin"><?php esc_html_e( 'Check in', 'inf' ); ?></label>
				<input class="w-full border-0 bg-transparent p-0 text-sm text-doghouse-ink placeholder-doghouse-muted focus:outline-none focus:ring-0" type="text" id="doghouse-checkin" name="checkin" placeholder="<?php esc_attr_e( 'Add dates', 'inf' ); ?>" autocomplete="off" />
			</div>

			<div class="flex-1 border-t border-doghouse-line px-6 py-3 hover:bg-doghouse-bg md:border-l md:border-t-0 md:py-2 md:transition-colors">
				<label class="block text-xs font-bold uppercase tracking-wide text-doghouse-ink" for="doghouse-checkout"><?php esc_html_e( 'Check out', 'inf' ); ?></label>
				<input class="w-full border-0 bg-transparent p-0 text-sm text-doghouse-ink placeholder-doghouse-muted focus:outline-none focus:ring-0" type="text" id="doghouse-checkout" name="checkout" placeholder="<?php esc_attr_e( 'Add dates', 'inf' ); ?>" autocomplete="off" />
			</div>

			<div class="flex flex-1 items-end gap-3 border-t border-doghouse-line px-6 py-3 hover:bg-doghouse-bg md:border-l md:border-t-0 md:py-2 md:transition-colors">
				<div class="flex-1">
					<label class="block text-xs font-bold uppercase tracking-wide text-doghouse-ink" for="doghouse-guests"><?php esc_html_e( 'Guests', 'inf' ); ?></label>
					<input class="w-full border-0 bg-transparent p-0 text-sm text-doghouse-ink placeholder-doghouse-muted focus:outline-none focus:ring-0" type="text" id="doghouse-guests" name="guests" placeholder="<?php esc_attr_e( 'Add paws', 'inf' ); ?>" autocomplete="off" />
				</div>
				<button class="inline-flex items-center justify-center gap-2 rounded-full bg-doghouse px-5 py-3 font-semibold text-white transition-colors hover:bg-doghouse-dark focus:outline-none focus-visible:ring-2 focus-visible:ring-doghouse-dark focus-visible:ring-offset-2" type="submit">
					<svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true" focusable="false">
						<circle cx="11" cy="11" r="7" />
						<path d="m20 20-3.5-3.5" />
					</svg>
					<span><?php esc_html_e( 'Search', 'inf' ); ?></span>
				</button>
			</div>
		</form>
	</div>
</div>
