<?php
/**
 * The template for displaying the front page
 */

get_header(); ?>
<div class="bg-gray-900 py-8">
	<div
		class="max-w-4xl mx-auto py-12 overflow-hidden rounded-3xl border border-slate-800 bg-slate-950 p-8 shadow-2xl antialiased selection:bg-sky-500/30 text-slate-300">

		<header class="relative mb-12 border-b border-slate-800 pb-8">
			<div class="absolute -top-10 -left-10 h-32 w-32 rounded-full bg-sky-500/10 blur-3xl"></div>
			<span
				class="mb-4 inline-block rounded-full border border-sky-500/20 bg-sky-500/10 px-3 py-1 text-xs font-bold uppercase tracking-widest text-sky-400">
				Challenge 2
			</span>
			<h1 class="mb-4 text-4xl font-black tracking-tight text-white md:text-5xl">
				Nothing's sexier than a <span
					class="bg-gradient-to-r from-sky-400 to-blue-600 bg-clip-text text-transparent">solid schema</span>
			</h1>
			<p class="text-lg font-light text-slate-400">
				Backend Architecture and Relational Data Structure.
			</p>
		</header>
		<section class="relative mb-12 flex flex-col items-center justify-center pt-8">
			<div class="group relative">
				<div
					class="absolute -top-4 left-1/2 -translate-x-1/2 whitespace-nowrap rounded-xl bg-sky-500 px-4 py-2 text-xs font-bold text-white opacity-0 transition-all duration-300 group-hover:-top-12 group-hover:opacity-100">
					Hey! I hope you like my solution!
					<div class="absolute -bottom-1 left-1/2 h-2 w-2 -translate-x-1/2 rotate-45 bg-sky-500"></div>
				</div>

				<div
					class="relative h-24 w-24 overflow-hidden rounded-full border-4 border-slate-800 bg-slate-900 shadow-2xl transition-all duration-500 hover:scale-110 hover:border-sky-500 animate-bounce-slow">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/meanpub.webp" alt="MeanPug Mascot"
						class="h-full w-full object-cover grayscale transition-all duration-500 group-hover:grayscale-0">
				</div>
			</div>

			<style>
				@keyframes bounce-slow {

					0%,
					100% {
						transform: translateY(0);
					}

					50% {
						transform: translateY(-10px);
					}
				}

				.animate-bounce-slow {
					animation: bounce-slow 3s ease-in-out infinite;
				}
			</style>
		</section>
		<?php get_template_part('template-parts/content-front-grid'); ?>
		<section class="mb-12">
			<h2 class="mb-4 flex items-center gap-3 text-xl font-bold text-white">
				<span class="text-sky-500">01.</span> Overview
			</h2>
			<p class="text-base leading-relaxed text-slate-400">
				The focus was on delivering a pragmatic solution without overengineering. Instead of creating unnecessary layers of complexity, I leveraged native WordPress features combined with ACF to solve the problem! <br>
			
			</p>
		</section>

		<section class="mb-12">
			<h2 class="mb-4 flex items-center gap-3 text-xl font-bold text-white">
				<span class="text-sky-500">02.</span> Sane Project Structure
			</h2>
			<div
				class="rounded-xl border border-slate-800 bg-slate-900/50 p-6 font-mono text-sm leading-relaxed text-emerald-400">
				<div class="flex items-center gap-2 mb-1"><span class="text-slate-600">theme/</span></div>
				<div class="ml-4 flex items-center gap-2 mb-1"><span class="text-slate-600">└──</span> <span
						class="text-sky-400">inc/</span></div>
				<div class="ml-8 mb-1"><span class="text-slate-700">├──</span> cpt/all.php <span
						class="text-slate-500 ml-4">// Practice Areas and Attorneys</span></div>
				<div class="ml-8 mb-1"><span class="text-slate-700">├──</span> tax/all.php <span
						class="text-slate-500 ml-4">// Locations and Specialization</span></div>
				<div class="ml-4 flex items-center gap-2 mb-1 text-sky-400"><span class="text-slate-600">└──</span>
					template-parts/</div>
				<div class="ml-8 text-slate-400"><span class="text-slate-700">└──</span> content-front-grid.php
				</div>
			</div>
		</section>

		<section class="mb-12 grid grid-cols-1 gap-4 md:grid-cols-3">
			<div
				class="rounded-2xl border border-slate-800 bg-slate-900/30 p-5 transition-colors hover:border-sky-500/50">
				<h3 class="mb-2 text-sm font-bold uppercase tracking-wider text-sky-400">Practice Areas</h3>
				<p class="text-xs leading-relaxed text-slate-500 italic text-justify">
					The core services. Managed as a CPT that stores icons, descriptions, and manual
					ACF relationship links to the team.
				</p>
			</div>

			<div
				class="rounded-2xl border border-slate-800 bg-slate-900/30 p-5 transition-colors hover:border-sky-500/50">
				<h3 class="mb-2 text-sm font-bold uppercase tracking-wider text-sky-400">Attorneys</h3>
				<p class="text-xs leading-relaxed text-slate-500 italic text-justify">
					Detailed specialist profiles. These are dynamically pulled into cards based on
					their assigned practice area.
				</p>
			</div>

			<div
				class="rounded-2xl border border-slate-800 bg-slate-900/30 p-5 transition-colors hover:border-sky-500/50">
				<h3 class="mb-2 text-sm font-bold uppercase tracking-wider text-sky-400">Specializations</h3>
				<p class="text-xs leading-relaxed text-slate-500 italic text-justify">
					Niche expertise taxonomy. Allows admins to tag lawyers with specific roles like
					"Insurance" or "Car Accidents" for precise UI labeling.
				</p>
			</div>
		</section>

		<section class="mb-12">
			<h2 class="mb-4 flex items-center gap-3 text-xl font-bold text-white">
				<span class="text-sky-500">04.</span> Relational Logic
			</h2>
			<p class="mb-4 text-sm text-slate-400">Utilizing ACF <strong
					class="text-slate-100 italic font-medium">Relationship Fields</strong> to link Practice Areas to Attorneys. This allows for a flexible, manual connection between the two CPTs without needing complex custom queries or additional taxonomies. <br>
			</p>
			<div class="rounded-xl border border-slate-800 bg-black/40 p-5 shadow-inner">
				<pre class="overflow-x-auto text-xs text-sky-300">
// Registering the Specialist Taxonomy
register_taxonomy('specialization', ['attorney'], [
	'hierarchical' => true,
	'labels'       => ['name' => 'Specializations'],
	'show_in_rest' => true
]);

// Connecting the data architecture:
// 1. 'practice_area' holds the services.
// 2. 'attorney' holds the people.
// 3. 'specialization' tags the specific niche expertise.</pre>
			</div>
		</section>

	</div>
</div>
<?php get_footer(); ?>