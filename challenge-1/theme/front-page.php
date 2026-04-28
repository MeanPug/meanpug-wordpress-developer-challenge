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
                    class="flex gap-7 overflow-x-auto whitespace-nowrap text-sm font-semibold text-airbnb-muted pt-4 pb-2 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                    <li role="tab" aria-selected="true"
                        class="cursor-pointer inline-flex items-center gap-2 pb-2 text-airbnb-text border-b-2 border-airbnb-text">
                        Places to stay
                    </li>
                    <li role="tab"
                        class="cursor-pointer inline-flex items-center gap-2 pb-2 border-b-2 border-transparent hover:text-airbnb-text transition-colors">
                        Monthly stays
                    </li>
                    <li role="tab"
                        class="cursor-pointer inline-flex items-center gap-2 pb-2 border-b-2 border-transparent hover:text-airbnb-text transition-colors">
                        Experiences
                    </li>
                    <li role="tab"
                        class="cursor-pointer inline-flex items-center gap-2 pb-2 border-b-2 border-transparent hover:text-airbnb-text transition-colors">
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

                <span class="hidden md:block w-px bg-airbnb-border my-2.5" aria-hidden="true"></span>

                <label class="flex-1 flex flex-col justify-center px-5 py-2.5 rounded-md hover:bg-airbnb-soft transition-colors cursor-pointer">
                    <span class="text-xs font-extrabold uppercase tracking-wide text-airbnb-text">Check in / Check out</span>
                    <input type="text" name="dates" placeholder="Add dates"
                           class="bg-transparent border-0 p-0 mt-0.5 text-sm text-airbnb-muted placeholder:text-airbnb-muted focus:outline-none focus:ring-0 w-full">
                </label>

                <span class="hidden md:block w-px bg-airbnb-border my-2.5" aria-hidden="true"></span>

                <label class="flex-1 flex flex-col justify-center px-5 py-2.5 rounded-md hover:bg-airbnb-soft transition-colors cursor-pointer">
                    <span class="text-xs font-extrabold uppercase tracking-wide text-airbnb-text">Guests</span>
                    <input type="text" name="guests" placeholder="Add pugs"
                           class="bg-transparent border-0 p-0 mt-0.5 text-sm text-airbnb-muted placeholder:text-airbnb-muted focus:outline-none focus:ring-0 w-full">
                </label>

                <button type="submit"
                        class="mt-2 md:mt-0 md:ml-1.5 inline-flex items-center justify-center gap-2 bg-airbnb-pink hover:bg-airbnb-pink-dark text-white font-bold text-base rounded-md px-6 py-3.5 md:py-0 transition-colors">
                    <svg viewBox="0 0 24 24" class="w-4 h-4" aria-hidden="true">
                        <path fill="currentColor" d="M22.7 19.3l-5.4-5.4c1-1.5 1.5-3.2 1.5-5.1C18.7 4 14.7 0 9.8 0S.9 4 .9 8.9c0 4.9 4 8.9 8.9 8.9 1.9 0 3.6-.6 5.1-1.5l5.4 5.4c.4.4 1.1.4 1.5 0l.9-.9c.4-.4.4-1.1 0-1.5zM2.7 8.9c0-3.9 3.2-7.1 7.1-7.1s7.1 3.2 7.1 7.1S13.7 16 9.8 16 2.7 12.8 2.7 8.9z"/>
                    </svg>
                    <span>Search</span>
                </button>
            </form>
        </div>
    </section>
		<!-- End Tabs + Search -->
</main>

<?php
get_footer();
