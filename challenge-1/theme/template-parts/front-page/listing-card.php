<?php
/**
 * Front page partial: a single listing card.
 *
 * Receives one normalised listing array via get_template_part()'s $args (WP 5.5+)
 * from listing-grid.php — whether the source was the `property` CPT or the local
 * data file. Every dynamic value is late-escaped, the rating is exposed to
 * assistive tech as a full sentence, and the image lazy-loads with explicit
 * dimensions to avoid layout shift.
 *
 * @package infra
 */

defined( 'ABSPATH' ) || exit;

$doghouse_listing = wp_parse_args(
	isset( $args ) ? $args : array(),
	array(
		'location'     => '',
		'title'        => '',
		'distance'     => '',
		'dates'        => '',
		'price'        => '',
		'price_unit'   => __( 'night', 'inf' ),
		'rating'       => '',
		'review_count' => 0,
		'badge'        => '',
		'image'        => '',
		'url'          => '#',
	)
);

if ( '' === (string) $doghouse_listing['price_unit'] ) {
	$doghouse_listing['price_unit'] = __( 'night', 'inf' );
}
?>
<li class="doghouse-card">
	<a class="group block rounded-2xl focus:outline-none focus-visible:ring-2 focus-visible:ring-doghouse focus-visible:ring-offset-2" href="<?php echo esc_url( $doghouse_listing['url'] ); ?>">
		<div class="relative mb-3 aspect-listing overflow-hidden rounded-2xl bg-doghouse-bg">
			<?php if ( '' !== $doghouse_listing['image'] ) : ?>
				<img
					src="<?php echo esc_url( $doghouse_listing['image'] ); ?>"
					alt=""
					loading="lazy"
					decoding="async"
					width="400"
					height="380"
					class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
				/>
			<?php endif; ?>

			<?php if ( '' !== $doghouse_listing['badge'] ) : ?>
				<span class="absolute left-3 top-3 rounded-full bg-white/95 px-3 py-1 text-xs font-semibold text-doghouse-ink shadow-sm">
					<?php echo esc_html( $doghouse_listing['badge'] ); ?>
				</span>
			<?php endif; ?>

			<span class="absolute right-3 top-3 text-white/90" aria-hidden="true">
				<svg class="h-6 w-6 drop-shadow" viewBox="0 0 24 24" fill="currentColor" opacity="0.85" aria-hidden="true" focusable="false">
					<path d="M12 21s-7.5-4.6-10-9.2C.6 8.9 2 6 4.8 6c1.8 0 3 1 3.7 2.1C9.2 7 10.4 6 12.2 6 15 6 16.4 8.9 15 11.8 12.5 16.4 12 21 12 21z" fill="none" stroke="currentColor" stroke-width="2" />
				</svg>
			</span>
		</div>

		<div class="flex items-start justify-between gap-2">
			<div class="min-w-0">
				<h3 class="truncate font-semibold text-doghouse-ink"><?php echo esc_html( $doghouse_listing['location'] ); ?></h3>
				<?php if ( '' !== $doghouse_listing['title'] ) : ?>
					<p class="truncate text-sm text-doghouse-muted"><?php echo esc_html( $doghouse_listing['title'] ); ?></p>
				<?php endif; ?>
				<?php if ( '' !== $doghouse_listing['distance'] ) : ?>
					<p class="text-sm text-doghouse-muted"><?php echo esc_html( $doghouse_listing['distance'] ); ?></p>
				<?php endif; ?>
				<?php if ( '' !== $doghouse_listing['dates'] ) : ?>
					<p class="text-sm text-doghouse-muted"><?php echo esc_html( $doghouse_listing['dates'] ); ?></p>
				<?php endif; ?>
			</div>

			<?php if ( '' !== (string) $doghouse_listing['rating'] ) : ?>
				<div class="flex shrink-0 items-center gap-1 text-sm text-doghouse-ink">
					<svg class="h-4 w-4 text-doghouse-ink" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false">
						<path d="M12 2l2.9 6.3 6.9.7-5.1 4.6 1.4 6.8L12 17.8 5.9 20.4l1.4-6.8L2.2 9l6.9-.7L12 2z" />
					</svg>
					<span aria-hidden="true"><?php echo esc_html( $doghouse_listing['rating'] ); ?></span>
					<span class="sr-only">
						<?php
						printf(
							/* translators: 1: star rating out of 5, 2: number of reviews. */
							esc_html__( 'Rated %1$s out of 5 from %2$s reviews', 'inf' ),
							esc_html( $doghouse_listing['rating'] ),
							esc_html( number_format_i18n( (int) $doghouse_listing['review_count'] ) )
						);
						?>
					</span>
				</div>
			<?php endif; ?>
		</div>

		<?php if ( '' !== (string) $doghouse_listing['price'] ) : ?>
			<p class="mt-1 text-doghouse-ink">
				<span class="font-semibold">$<?php echo esc_html( $doghouse_listing['price'] ); ?></span>
				<span class="sr-only"><?php esc_html_e( 'per', 'inf' ); ?></span>
				<span><?php echo esc_html( $doghouse_listing['price_unit'] ); ?></span>
			</p>
		<?php endif; ?>
	</a>
</li>
