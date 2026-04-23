<?php
/**
 * Front page template — "Pugbnb"
 *
 * A Tailwind-driven replica of the Airbnb home-page above-the-fold,
 * pug-ified per the MeanPug challenge brief. Intentionally self-contained:
 * uses Tailwind's Play CDN so no build step is required for the demo.
 *
 * @package infra
 */

$pug_icon = 'https://media.prod.meanpug.net/wp-content/uploads/sites/9/2020/01/24060038/MeanPug-Best-In-Show-Icon.png';
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="https://cdn.tailwindcss.com"></script>
	<script>
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						rausch: '#FF385C',
						babu:   '#00A699',
						arches: '#FC642D',
						hof:    '#484848',
						foggy:  '#767676',
					},
					fontFamily: {
						sans: ['"Circular"', '"Helvetica Neue"', 'Helvetica', 'Arial', 'sans-serif'],
					},
				},
			},
		};
	</script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<style>
		body { font-family: 'Nunito', 'Helvetica Neue', Arial, sans-serif; color: #222; }
		.new-badge { font-size: 10px; letter-spacing: 0.06em; }
		.search-divider { border-left: 1px solid #EBEBEB; }
	</style>
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-white text-hof' ); ?>>

<!-- Covid / announcement bar -->
<div class="bg-gray-50 border-b border-gray-200 text-center text-xs sm:text-sm text-hof py-3 px-4">
	<span>Get the latest on our pug-friendly stays and cancellation policies.</span>
	<a href="#" class="underline font-semibold ml-1">Learn more</a>
</div>

<!-- Primary header -->
<header class="border-b border-gray-200 sticky top-0 z-40 bg-white">
	<div class="max-w-7xl mx-auto px-6 lg:px-10 py-4 flex items-center justify-between">
		<!-- Logo -->
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2 text-rausch">
			<img src="<?php echo esc_url( $pug_icon ); ?>" alt="Pugbnb" class="h-8 w-8 object-contain" />
			<span class="text-2xl font-extrabold tracking-tight">pugbnb</span>
		</a>

		<!-- Nav -->
		<nav class="hidden md:flex items-center gap-2 text-sm font-semibold text-hof">
			<a href="#" class="px-3 py-2 rounded-full hover:bg-gray-50">Host your pug home</a>
			<a href="#" class="px-3 py-2 rounded-full hover:bg-gray-50">Host a pug experience</a>
			<a href="#" class="px-3 py-2 rounded-full hover:bg-gray-50">Help</a>

			<!-- Profile chip -->
			<div class="ml-2 flex items-center gap-3 border border-gray-200 rounded-full pl-3 pr-1 py-1 shadow-sm hover:shadow transition-shadow cursor-pointer">
				<span class="text-sm">Bobby</span>
				<span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-rausch text-white overflow-hidden">
					<img src="<?php echo esc_url( $pug_icon ); ?>" alt="Profile pug" class="h-8 w-8 object-cover" />
				</span>
			</div>
		</nav>
	</div>

	<!-- Category tabs -->
	<div class="max-w-7xl mx-auto px-6 lg:px-10">
		<div class="flex items-center gap-8 text-sm font-semibold border-b border-transparent">
			<a href="#" class="pb-4 -mb-px border-b-2 border-hof text-hof">Places to stay</a>
			<a href="#" class="pb-4 -mb-px text-foggy hover:text-hof">Monthly stays</a>
			<a href="#" class="pb-4 -mb-px text-foggy hover:text-hof">Experiences</a>
			<span class="pb-4 -mb-px text-foggy hover:text-hof flex items-center gap-2">
				<a href="#">Online Experiences</a>
				<span class="new-badge bg-hof text-white uppercase font-bold px-1.5 py-0.5 rounded-sm">New</span>
			</span>
		</div>
	</div>
</header>

<!-- Search bar -->
<section class="max-w-7xl mx-auto px-6 lg:px-10 pt-6">
	<div class="flex flex-col lg:flex-row items-stretch border border-gray-200 rounded-md overflow-hidden shadow-sm">
		<label class="flex-1 px-6 py-3">
			<span class="block text-[11px] font-bold uppercase tracking-wider text-hof">Location</span>
			<input type="text" placeholder="Where is your pug going?" class="mt-1 w-full border-0 p-0 text-sm text-foggy placeholder-foggy focus:outline-none focus:ring-0" />
		</label>
		<label class="flex-1 px-6 py-3 search-divider">
			<span class="block text-[11px] font-bold uppercase tracking-wider text-hof">Check In / Check Out</span>
			<input type="text" placeholder="Add dates" class="mt-1 w-full border-0 p-0 text-sm text-foggy placeholder-foggy focus:outline-none focus:ring-0" />
		</label>
		<label class="flex-1 px-6 py-3 search-divider">
			<span class="block text-[11px] font-bold uppercase tracking-wider text-hof">Guests</span>
			<input type="text" placeholder="Add guests (pugs welcome)" class="mt-1 w-full border-0 p-0 text-sm text-foggy placeholder-foggy focus:outline-none focus:ring-0" />
		</label>
		<button type="button" class="bg-rausch hover:bg-[#E0314F] text-white font-semibold px-8 flex items-center justify-center gap-2 min-h-[64px]">
			<!-- Search icon -->
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4" aria-hidden="true">
				<path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
			</svg>
			<span>Search</span>
		</button>
	</div>
</section>

<!-- Hero banner -->
<section class="max-w-7xl mx-auto px-6 lg:px-10 mt-8">
	<div class="relative bg-black text-white rounded-xl overflow-hidden p-10 md:p-14 min-h-[260px]">
		<!-- Decorative pug silhouette — required MeanPug mascot placement -->
		<img src="<?php echo esc_url( $pug_icon ); ?>" alt="" aria-hidden="true"
			class="absolute right-6 md:right-14 bottom-4 h-40 md:h-56 opacity-80 pointer-events-none select-none" />

		<div class="relative max-w-xl">
			<h1 class="text-3xl md:text-4xl font-extrabold leading-tight">We stand with<br />#PugsEverywhere</h1>
			<p class="mt-4 text-sm md:text-base text-gray-200 leading-relaxed">
				Now more than ever, it's important that your pug knows how we're fighting for
				snoot-friendly stays on Pugbnb. We'd like to share our newest initiative with you,
				<em>Project Lighthouse-at-the-end-of-the-dog-park</em>.
			</p>
			<a href="#" class="mt-5 inline-flex items-center gap-2 font-semibold underline-offset-2 hover:underline">
				Learn more
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4" aria-hidden="true">
					<path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
				</svg>
			</a>
		</div>
	</div>
</section>

<!-- Property preview row -->
<section class="max-w-7xl mx-auto px-6 lg:px-10 mt-8 pb-16">
	<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
		<?php
		$cards = array(
			array(
				'label'    => 'New',
				'title'    => 'Pup Treehouse Retreat',
				'location' => 'Portland, OR',
				'img'      => 'https://images.unsplash.com/photo-1507146426996-ef05306b995a?auto=format&fit=crop&w=900&q=60',
			),
			array(
				'label'    => '',
				'title'    => 'Cozy Pug-Friendly Loft',
				'location' => 'Brooklyn, NY',
				'img'      => 'https://images.unsplash.com/photo-1534351450181-ea9f78427fe8?auto=format&fit=crop&w=900&q=60',
			),
			array(
				'label'    => '',
				'title'    => 'Bark-Side A-Frame',
				'location' => 'Big Bear, CA',
				'img'      => 'https://images.unsplash.com/photo-1518780664697-55e3ad937233?auto=format&fit=crop&w=900&q=60',
			),
		);
		foreach ( $cards as $card ) :
		?>
			<article class="group cursor-pointer">
				<div class="relative overflow-hidden rounded-xl aspect-[4/3] bg-gray-100">
					<?php if ( ! empty( $card['label'] ) ) : ?>
						<span class="absolute top-3 left-3 z-10 bg-white text-hof text-[11px] font-bold uppercase tracking-wider px-2 py-1 rounded"><?php echo esc_html( $card['label'] ); ?></span>
					<?php endif; ?>
					<img src="<?php echo esc_url( $card['img'] ); ?>" alt="<?php echo esc_attr( $card['title'] ); ?>" loading="lazy"
						class="absolute inset-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-105" />
				</div>
				<h3 class="mt-3 text-sm font-semibold text-hof"><?php echo esc_html( $card['title'] ); ?></h3>
				<p class="text-sm text-foggy"><?php echo esc_html( $card['location'] ); ?></p>
			</article>
		<?php endforeach; ?>
	</div>
</section>

<?php wp_footer(); ?>
</body>
</html>
