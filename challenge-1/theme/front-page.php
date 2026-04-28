<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package infra
 */

get_header();
?>
	<main id="primary" class="site-main">

    <!-- Tabs + Search -->
    <section class="bg-white border-b border-airbnb-border px-6 lg:px-10 pt-2 pb-7" aria-label="Search stays">
        <div class="max-w-screen-3xl mx-auto">

            <!-- Tabs (with mobile right-edge fade) -->
            <div class="relative">
                <ul role="tablist"
                    class="flex gap-7 overflow-x-auto whitespace-nowrap text-sm font-medium text-airbnb-muted pt-4 pb-2 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                    <li role="tab" aria-selected="true"
                        class="cursor-pointer flex items-center gap-2 pb-1 text-airbnb-text border-b-2 border-airbnb-text">
                        Places to stay
                    </li>
                    <li role="tab"
                        class="cursor-pointer flex items-center gap-2 pb-2 border-transparent hover:text-airbnb-text transition-colors">
                        Monthly stays
                    </li>
                    <li role="tab"
                        class="cursor-pointer flex items-center gap-2 pb-2 border-transparent hover:text-airbnb-text transition-colors">
                        Experiences
                    </li>
                    <li role="tab"
                        class="cursor-pointer flex items-center gap-2 pb-2 border-transparent hover:text-airbnb-text transition-colors">
                        Online Experiences
                        <span class="bg-airbnb-text text-white text-xs font-extrabold tracking-wider px-1.5 py-0.5 rounded leading-none">NEW</span>
                    </li>
                </ul>
                <div class="md:hidden pointer-events-none absolute top-0 right-0 h-full w-12 bg-gradient-to-l from-white via-white/80 to-transparent" aria-hidden="true"></div>
            </div>

            <!-- Search bar -->
            <form action="#" method="get" role="search"
                  class="mt-2 flex flex-col md:flex-row md:items-stretch bg-white border border-airbnb-border rounded-lg shadow-sm hover:shadow-md transition-shadow p-2 md:pl-0">

                <label class="flex-1 flex flex-col justify-center px-5 py-2.5 rounded-md hover:bg-airbnb-soft transition-colors cursor-pointer">
                    <span class="text-xs font-extrabold uppercase tracking-wide text-airbnb-text">Location</span>
                    <input type="text" name="location" placeholder="Where are you going?"
                           class="bg-transparent border-0 p-0 mt-0.5 text-sm text-airbnb-muted placeholder:text-airbnb-muted focus:outline-none focus:ring-0 w-full">
                </label>

                <span class="hidden md:block w-px bg-airbnb-border my-1.5" aria-hidden="true"></span>

                <label class="flex-1 flex flex-col justify-center px-5 py-2.5 rounded-md hover:bg-airbnb-soft transition-colors cursor-pointer">
                    <span class="text-xs font-extrabold uppercase tracking-wide text-airbnb-text">Check in / Check out</span>
                    <input type="text" name="dates" placeholder="Add dates"
                           class="bg-transparent border-0 p-0 mt-0.5 text-sm text-airbnb-muted placeholder:text-airbnb-muted focus:outline-none focus:ring-0 w-full">
                </label>

                <span class="hidden md:block w-px bg-airbnb-border my-1.5" aria-hidden="true"></span>

                <label class="flex-1 flex flex-col justify-center px-5 py-2.5 rounded-md hover:bg-airbnb-soft transition-colors cursor-pointer">
                    <span class="text-xs font-extrabold uppercase tracking-wide text-airbnb-text">Guests</span>
                    <input type="text" name="guests" placeholder="Add pugs"
                           class="bg-transparent border-0 p-0 mt-0.5 text-sm text-airbnb-muted placeholder:text-airbnb-muted focus:outline-none focus:ring-0 w-full">
                </label>

                <button type="submit"
                        class="mt-2 md:mt-0 md:ml-1.5 flex items-center justify-center gap-2 bg-airbnb-pink hover:bg-airbnb-pink-dark text-white font-bold text-base rounded-md px-6 py-3.5 md:py-0 transition-colors">
                    <svg viewBox="0 0 24 24" class="w-4 h-4" aria-hidden="true">
                        <path fill="currentColor" d="M22.7 19.3l-5.4-5.4c1-1.5 1.5-3.2 1.5-5.1C18.7 4 14.7 0 9.8 0S.9 4 .9 8.9c0 4.9 4 8.9 8.9 8.9 1.9 0 3.6-.6 5.1-1.5l5.4 5.4c.4.4 1.1.4 1.5 0l.9-.9c.4-.4.4-1.1 0-1.5zM2.7 8.9c0-3.9 3.2-7.1 7.1-7.1s7.1 3.2 7.1 7.1S13.7 16 9.8 16 2.7 12.8 2.7 8.9z"/>
                    </svg>
                    <span>Search</span>
                </button>
            </form>
        </div>
    </section>
		<!-- End Tabs + Search -->

		<!-- #PugLivesMatter Hero -->
    <section class="max-w-screen-3xl mx-auto mt-6 mb-10 px-6 lg:px-0" aria-labelledby="hero-title">
        <article class="relative rounded-xl overflow-hidden text-white min-h-96 flex flex-col justify-center px-8 sm:px-12 lg:px-16 py-16 lg:py-20 bg-cover bg-center"
                 style="background-image: linear-gradient(90deg, rgba(0, 0, 0, 0.95) 0%, rgba(0, 0, 0, 0.95) 35%, rgba(0, 0, 0, 0.65) 70%, rgba(0, 0, 0, 0.35) 100%), url('https://images.pexels.com/photos/374906/pexels-photo-374906.jpeg?auto=compress&cs=tinysrgb&w=1200');">
            <div class="relative max-w-sm">
                <h1 id="hero-title" class="text-3xl md:text-4xl font-extrabold leading-[1.12] tracking-tight mb-4">
                    We stand with<br>#PugLivesMatter
                </h1>
                <p class="text-base leading-relaxed mb-6 opacity-95">
                    Now more than ever, it's important that you know how we're fighting
                    discrimination on Pugbnb. We'd like to share our newest initiative
                    with you, Project Lighthouse — Pug Edition.
                </p>
                <a href="#" class="flex items-center gap-2 text-base font-bold hover:underline">
                    Learn more
                    <svg viewBox="0 0 16 16" class="w-3.5 h-3.5" aria-hidden="true">
                        <path fill="currentColor" d="M5.5 1.5l1-1L13 7l-6.5 6.5-1-1L11 7.5H1v-1h10z"/>
                    </svg>
                </a>
            </div>
        </article>
    </section>
		<!-- End #PugLivesMatter Hero -->

		    <!-- Featured cards -->
    <section class="max-w-screen-3xl mx-auto px-6 lg:px-0 pb-20" aria-label="Featured destinations">
        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ( inf_get_featured_cards() as $card ) : ?>
                <?php get_template_part( 'template-parts/featured-card', null, $card ); ?>
            <?php endforeach; ?>
        </ul>
    </section>
		<!-- End Featured cards -->
</main>

<?php
get_footer();
