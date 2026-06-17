<?php
/**
 * Front page — "airPnP" (Challenge 1)
 *
 * A WordPress reproduction of the Airbnb home page (above the fold),
 * pugified for MeanPug. Built with the theme's Tailwind pipeline.
 *
 * @package infra
 */

get_header( 'airpnp' );

$airpnp_cards_dir = get_template_directory_uri() . '/assets/images/cards/';

/*
 * The category cards. Drop an image into theme/assets/images/cards/ and set its
 * filename as 'image' to use a real photo; otherwise the gradient tile renders
 * as a self-contained fallback.
 */
$airpnp_cards = array(
	array(
		'title' => __( 'Pug-friendly cabins', 'inf' ),
		'class' => 'bg-gradient-to-br from-[#FF385C] to-[#BD1E59]',
		'image' => 'cabin.jpg',
	),
	array(
		'title' => __( 'Beachfront kennels', 'inf' ),
		'class' => 'bg-gradient-to-br from-[#2A6F97] to-[#013A63]',
		'image' => 'beach.jpg',
	),
	array(
		'title' => __( 'Cozy city lofts', 'inf' ),
		'class' => 'bg-gradient-to-br from-[#E07A5F] to-[#9C3D54]',
		'image' => 'loft.jpg',
	),
	array(
		'title' => __( 'Countryside retreats', 'inf' ),
		'class' => 'bg-gradient-to-br from-[#3D405B] to-[#1A1B2E]',
		'image' => 'countryside.jpg',
	),
);

/*
 * Listings carousel — the Airbnb "homes near you" row.
 */
$airpnp_listings = array(
	array( 'image' => 'cabin.jpg',       'title' => __( 'Tiny home in Tepoztlán', 'inf' ),     'dates' => __( 'Jun 19 – 24', 'inf' ), 'price' => '74',  'rating' => '4.99' ),
	array( 'image' => 'loft.jpg',        'title' => __( 'Loft in Portland', 'inf' ),           'dates' => __( 'Jul 3 – 8', 'inf' ),   'price' => '96',  'rating' => '4.94' ),
	array( 'image' => 'beach.jpg',       'title' => __( 'Beach house in Cabo', 'inf' ),        'dates' => __( 'Jun 26 – 28', 'inf' ), 'price' => '182', 'rating' => '4.87' ),
	array( 'image' => 'countryside.jpg', 'title' => __( 'Cottage in the Cotswolds', 'inf' ),   'dates' => __( 'Jul 19 – 21', 'inf' ), 'price' => '120', 'rating' => '4.95' ),
	array( 'image' => 'cabin.jpg',       'title' => __( 'Cabin in Big Bear Lake', 'inf' ),     'dates' => __( 'Jun 19 – 21', 'inf' ), 'price' => '138', 'rating' => '4.87' ),
	array( 'image' => 'loft.jpg',        'title' => __( 'Studio in Charleston', 'inf' ),       'dates' => __( 'Aug 1 – 5', 'inf' ),   'price' => '88',  'rating' => '5.0' ),
	array( 'image' => 'countryside.jpg', 'title' => __( 'Farmhouse in Tuscany', 'inf' ),       'dates' => __( 'Sep 9 – 14', 'inf' ),  'price' => '210', 'rating' => '4.86' ),
);
?>

<main id="main" class="site-main bg-white">
	<div class="max-w-[1280px] mx-auto px-6 lg:px-10">

		<!-- Hero card -->
		<section class="relative overflow-hidden rounded-xl bg-[#1A1A1A] text-white mt-2 mb-12 min-h-[420px] flex items-center">

			<!-- Background photo -->
			<img
				src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-bg.jpg' ); ?>"
				alt=""
				aria-hidden="true"
				class="absolute inset-0 w-full h-full object-cover"
			/>
			<!-- Dark overlay so the copy stays legible while the photo still shows through -->
			<div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-black/20"></div>

			<div class="relative z-10 max-w-xl px-8 py-14 lg:px-16 lg:py-20">
				<h1 class="text-3xl lg:text-4xl font-extrabold leading-tight mb-4">
					<?php esc_html_e( 'We stand with', 'inf' ); ?><br />
					<span class="text-[#FF385C]">#BestInShow</span>
				</h1>
				<p class="text-sm lg:text-base text-white/90 leading-relaxed mb-6">
					<?php esc_html_e( 'Now more than ever, every good pug deserves a place to stay. Discover homes where four-legged guests are always welcome, and meet our newest initiative — Project Lighthouse Kennels.', 'inf' ); ?>
				</p>
				<a href="#" class="inline-flex items-center gap-2 bg-white text-[#222222] text-sm font-semibold rounded-lg px-5 py-3 hover:bg-white/90 transition-colors">
					<?php esc_html_e( 'Learn more', 'inf' ); ?>
					<span aria-hidden="true">&rsaquo;</span>
				</a>
			</div>
		</section>

		<!-- Category cards -->
		<section class="pb-16">
			<h2 class="text-2xl font-bold text-[#222222] mb-6"><?php esc_html_e( 'Live like a pug, anywhere', 'inf' ); ?></h2>

			<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
				<?php foreach ( $airpnp_cards as $card ) : ?>
					<a href="#" class="group">
						<div class="relative h-80 rounded-xl overflow-hidden <?php echo esc_attr( $card['class'] ); ?>">
							<?php if ( ! empty( $card['image'] ) ) : ?>
								<img src="<?php echo esc_url( $airpnp_cards_dir . $card['image'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
							<?php endif; ?>
							<div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/60 to-transparent"></div>
							<h3 class="absolute left-5 bottom-5 text-white text-xl font-bold drop-shadow"><?php echo esc_html( $card['title'] ); ?></h3>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</section>

		<!-- Listings carousel -->
		<section class="pb-16">
			<a href="#" class="group inline-flex items-center gap-1 mb-6">
				<h2 class="text-2xl font-bold text-[#222222]"><?php esc_html_e( 'Stays loved by pugs', 'inf' ); ?></h2>
				<span class="text-2xl text-[#222222] group-hover:translate-x-1 transition-transform" aria-hidden="true">&rsaquo;</span>
			</a>

			<div class="flex gap-6 overflow-x-auto airpnp-no-scrollbar -mx-1 px-1 pb-2">
				<?php foreach ( $airpnp_listings as $listing ) : ?>
					<a href="#" class="group shrink-0 w-60">
						<div class="relative aspect-square rounded-xl overflow-hidden mb-3 bg-[#EEEEEE]">
							<img src="<?php echo esc_url( $airpnp_cards_dir . $listing['image'] ); ?>" alt="<?php echo esc_attr( $listing['title'] ); ?>" class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
							<span class="absolute top-3 left-3 bg-white/95 text-[#222222] text-xs font-semibold px-3 py-1 rounded-full shadow-sm"><?php esc_html_e( 'Guest favourite', 'inf' ); ?></span>
							<button type="button" class="absolute top-3 right-3 text-white text-xl leading-none drop-shadow-[0_1px_3px_rgba(0,0,0,0.45)] hover:scale-110 transition-transform" aria-label="<?php esc_attr_e( 'Save to wishlist', 'inf' ); ?>">
								<i class="fi fi-rr-heart" aria-hidden="true"></i>
							</button>
						</div>
						<div class="flex items-start justify-between gap-2">
							<h3 class="font-semibold text-[#222222] text-sm leading-snug"><?php echo esc_html( $listing['title'] ); ?></h3>
							<span class="flex items-center gap-1 text-sm text-[#222222] shrink-0">
								<i class="fi fi-sr-star text-[11px] leading-none" aria-hidden="true"></i>
								<?php echo esc_html( $listing['rating'] ); ?>
							</span>
						</div>
						<p class="text-sm text-[#717171]"><?php echo esc_html( $listing['dates'] ); ?></p>
						<p class="text-sm text-[#222222] mt-1"><span class="font-semibold">$<?php echo esc_html( $listing['price'] ); ?></span> <?php esc_html_e( 'night', 'inf' ); ?></p>
					</a>
				<?php endforeach; ?>
			</div>
		</section>

	</div>
</main>

<?php
get_footer( 'airpnp' );
