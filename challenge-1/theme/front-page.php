<?php
/**
 * Front page template for Challenge 1.
 *
 * This template recreates the above-the-fold AirPnP reference
 * for the MeanPug WordPress Developer Challenge.
 *
 * @package infra
 */

get_header( 'airpnp' );

$pug_image = get_template_directory_uri() . '/assets/images/meanpug-pug.png';
?>

<main class="min-h-screen bg-white text-[#222222] antialiased">
	<div class="bg-[#f7f7f7] px-6 py-4 text-center text-sm text-[#222222]">
		Get the latest on our COVID-19 response and cancellation policies.
		<a href="#" class="font-semibold underline">Learn more</a>
	</div>

	<section class="mx-auto max-w-[1480px] px-6 py-8 lg:px-10">
		<header class="flex items-center justify-between">
			<a href="#" class="flex items-center gap-2 text-[#ff385c]" aria-label="AirPnP home">
				<span class="flex h-9 w-9 items-center justify-center rounded-full border-2 border-[#ff385c] text-lg font-bold">
					A
				</span>
				<span class="text-2xl font-bold tracking-tight">airpnp</span>
			</a>

			<nav class="hidden items-center gap-8 text-sm font-medium text-[#222222] lg:flex" aria-label="Primary navigation">
				<a href="#" class="hover:text-black">🌐</a>
				<a href="#" class="hover:text-black">Host your home</a>
				<a href="#" class="hover:text-black">Host an experience</a>
				<a href="#" class="hover:text-black">Help</a>

				<a href="#" class="flex items-center gap-3 rounded-full border border-neutral-200 px-4 py-2 shadow-sm">
					<span>Bobby</span>
					<span class="relative">
						<img
							src="<?php echo esc_url( $pug_image ); ?>"
							alt="MeanPug pug avatar"
							class="h-9 w-9 rounded-full object-cover"
						>
						<span class="absolute -right-1 -top-1 flex h-5 w-5 items-center justify-center rounded-full bg-[#ff385c] text-[11px] font-bold text-white">
							2
						</span>
					</span>
				</a>
			</nav>
		</header>

		<nav class="mt-12 flex items-center gap-8 overflow-x-auto text-base text-[#222222]" aria-label="Stay categories">
			<a href="#" class="border-b-2 border-[#222222] pb-2 font-medium whitespace-nowrap">Places to stay</a>
			<a href="#" class="pb-2 whitespace-nowrap">Monthly stays</a>
			<a href="#" class="pb-2 whitespace-nowrap">Experiences</a>
			<a href="#" class="flex items-center gap-2 pb-2 whitespace-nowrap">
				Online Experiences
				<span class="rounded bg-[#222222] px-1.5 py-0.5 text-[10px] font-bold uppercase text-white">New</span>
			</a>
		</nav>

		<form class="mt-4 flex flex-col overflow-hidden rounded-2xl border border-neutral-200 bg-white shadow-lg lg:flex-row" action="#" method="get">
			<label class="flex-1 px-6 py-5 lg:border-r lg:border-neutral-200">
				<span class="block text-xs font-bold uppercase tracking-wide">Location</span>
				<span class="mt-1 block text-base text-neutral-500">Where are you going?</span>
			</label>

			<label class="flex-1 px-6 py-5 lg:border-r lg:border-neutral-200">
				<span class="block text-xs font-bold uppercase tracking-wide">Check in / Check out</span>
				<span class="mt-1 block text-base text-neutral-500">Add dates</span>
			</label>

			<label class="flex-1 px-6 py-5">
				<span class="block text-xs font-bold uppercase tracking-wide">Guests</span>
				<span class="mt-1 block text-base text-neutral-500">Add guests</span>
			</label>

			<div class="flex items-center px-4 pb-4 lg:pb-0">
				<button type="button" class="flex w-full items-center justify-center gap-2 rounded-xl bg-[#e31c5f] px-7 py-4 font-bold text-white lg:w-auto">
					<span>⌕</span>
					<span>Search</span>
				</button>
			</div>
		</form>

		<section class="relative mt-10 overflow-hidden rounded-2xl bg-black px-8 py-16 text-white lg:px-16 lg:py-28">
			<div class="relative z-10 max-w-md">
				<h1 class="text-4xl font-bold leading-tight tracking-tight lg:text-5xl">
	We’ve got the perfect room<br>
	for your pug
</h1>

<p class="mt-5 max-w-md text-lg leading-7 text-white/90">
	Explore charming stays with cozy beds, great hosts, and plenty of space for paws, naps, and adventures.
</p>

<a href="#" class="mt-7 inline-flex items-center gap-3 text-lg font-bold">
	Explore stays
	<span aria-hidden="true">›</span>
</a>
			</div>

			<img
				src="<?php echo esc_url( $pug_image ); ?>"
				alt="MeanPug pug"
				class="absolute bottom-8 right-10 hidden w-56 rounded-full border-8 border-white/10 bg-white/5 p-4 opacity-90 lg:block"
			>
		</section>

		<section class="mt-10 grid gap-6 lg:grid-cols-3" aria-label="Featured stays">
			<article class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-neutral-200">
				<div class="h-52 bg-gradient-to-br from-orange-100 via-amber-50 to-neutral-100"></div>
				<div class="p-5">
					<span class="rounded bg-white px-2 py-1 text-xs font-bold uppercase shadow-sm">New</span>
					<h2 class="mt-3 text-lg font-bold">Pug-friendly stays</h2>
					<p class="mt-1 text-sm text-neutral-500">Homes approved by MeanPug’s finest.</p>
				</div>
			</article>

			<article class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-neutral-200">
				<div class="h-52 bg-gradient-to-br from-sky-100 via-neutral-100 to-stone-200"></div>
				<div class="p-5">
					<h2 class="text-lg font-bold">Online experiences</h2>
					<p class="mt-1 text-sm text-neutral-500">Meet hosts, teams, and tiny coworkers.</p>
				</div>
			</article>

			<article class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-neutral-200">
				<div class="h-52 bg-gradient-to-br from-lime-100 via-stone-100 to-sky-100"></div>
				<div class="p-5">
					<h2 class="text-lg font-bold">Unique homes</h2>
					<p class="mt-1 text-sm text-neutral-500">Find a place with room for every paw.</p>
				</div>
			</article>
		</section>
	</section>
</main>

<?php
get_footer( 'airpnp' );