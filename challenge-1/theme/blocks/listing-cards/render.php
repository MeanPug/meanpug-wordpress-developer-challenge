<?php
/**
 * Server-side render for the airpnp/listing-cards block.
 *
 * Reuses Airpnp\Front_Page::get_listing_cards() — the same transient-cached
 * query layer used everywhere on the front page — so cache hits and cache
 * busts are shared with the rest of the theme.
 *
 * @package Airpnp
 *
 * @var array $attributes Block attributes (see block.json for defaults).
 * @var string $content Inner block content (unused).
 * @var WP_Block $block Block instance.
 */

use Airpnp\Front_Page;

$limit = isset( $attributes['limit'] ) ? max( 1, min( 12, (int) $attributes['limit'] ) ) : 3;
$cards = Front_Page::get_listing_cards( $limit );

$fallback_palette = array( 'bg-amber-200', 'bg-emerald-300', 'bg-stone-300' );

$wrapper_attrs = get_block_wrapper_attributes(
	array(
		'class'      => 'airpnp-listings max-w-7xl mx-auto px-4 py-8',
		'aria-label' => esc_attr__( 'Featured stays', 'inf' ),
	)
);
?>
<section <?php echo $wrapper_attrs; ?>>
	<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
		<?php if ( ! empty( $cards ) ) : ?>
			<?php foreach ( $cards as $i => $card ) : ?>
				<article class="airpnp-card">
					<a href="#"
					   class="block group focus:outline-none focus-visible:ring-2 focus-visible:ring-[#FF385C] focus-visible:ring-offset-2 rounded-xl"
					   aria-label="<?php echo esc_attr( $card['title'] ); ?>">
						<div class="relative aspect-[4/3] rounded-xl overflow-hidden <?php echo esc_attr( $fallback_palette[ $i % count( $fallback_palette ) ] ); ?>">
							<?php if ( ! empty( $card['thumb'] ) ) : ?>
								<img src="<?php echo esc_url( $card['thumb'] ); ?>"
									 alt="<?php echo esc_attr( $card['title'] ); ?>"
									 loading="lazy"
									 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
							<?php endif; ?>
							<span aria-hidden="true"
								  class="absolute top-3 left-3 bg-white text-stone-900 text-xs font-bold uppercase tracking-wider px-2 py-1 rounded">
								<?php esc_html_e( 'New', 'inf' ); ?>
							</span>
						</div>
						<h3 class="mt-3 text-base font-semibold text-stone-900 group-hover:underline">
							<?php echo esc_html( $card['title'] ); ?>
						</h3>
					</a>
				</article>
			<?php endforeach; ?>
		<?php else : ?>
			<?php for ( $i = 1; $i <= $limit; $i++ ) : ?>
				<article class="airpnp-card">
					<div class="block" aria-hidden="true">
						<div class="relative aspect-[4/3] rounded-xl overflow-hidden <?php echo esc_attr( $fallback_palette[ ( $i - 1 ) % count( $fallback_palette ) ] ); ?>">
							<span class="absolute top-3 left-3 bg-white text-stone-900 text-xs font-bold uppercase tracking-wider px-2 py-1 rounded">
								<?php esc_html_e( 'New', 'inf' ); ?>
							</span>
						</div>
						<h3 class="mt-3 text-base font-semibold text-stone-500">
							<?php
							printf(
								/* translators: %d: card index */
								esc_html__( 'Demo Listing %d', 'inf' ),
								(int) $i
							);
							?>
						</h3>
					</div>
				</article>
			<?php endfor; ?>
		<?php endif; ?>
	</div>
</section>
