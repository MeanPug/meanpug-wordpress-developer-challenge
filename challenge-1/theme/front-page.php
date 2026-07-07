<?php
/**
 * Front page template for Challenge 1.
 *
 * This template intentionally focuses on the above-the-fold
 * AirPnP landing page implementation for the MeanPug challenge.
 *
 * @package infra
 */

get_header( 'airpnp' );
?>

<main class="min-h-screen bg-white text-neutral-900">
	<section class="mx-auto max-w-7xl px-6 py-20">
		<p class="mb-4 text-sm font-semibold uppercase tracking-wide text-pink-600">
			MeanPug WordPress Challenge
		</p>

		<h1 class="max-w-3xl text-5xl font-bold tracking-tight">
			AirPnP homepage is loading.
		</h1>

		<p class="mt-6 max-w-2xl text-lg text-neutral-600">
			This confirms our custom front-page template is working without relying on the default theme header.
		</p>
	</section>
</main>

<?php
get_footer( 'airpnp' );