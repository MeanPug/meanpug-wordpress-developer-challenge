<?php
/**
 * The template for displaying the front page
 *
 * Airbnb-style homepage with search bar, hero section, and category cards.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package infra
 */

get_header();
?>

<!-- Search Bar (SRC-01 through SRC-04) -->
<section class="airpnp-container py-6" id="search-section">
    <div class="airpnp-search" id="search-bar">
        <!-- Location Field -->
        <div class="airpnp-search__field" id="search-location">
            <span class="airpnp-search__label">Location</span>
            <span class="airpnp-search__placeholder">Where are you going?</span>
        </div>

        <div class="airpnp-search__divider" aria-hidden="true"></div>

        <!-- Check In / Check Out Field -->
        <div class="airpnp-search__field" id="search-dates">
            <span class="airpnp-search__label">Check in / Check out</span>
            <span class="airpnp-search__placeholder">Add dates</span>
        </div>

        <div class="airpnp-search__divider" aria-hidden="true"></div>

        <!-- Guests Field -->
        <div class="airpnp-search__field" id="search-guests">
            <span class="airpnp-search__label">Guests</span>
            <span class="airpnp-search__placeholder">Add guests</span>
        </div>

        <!-- Search Button -->
        <button class="airpnp-search__button" id="search-submit" type="button">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            Search
        </button>
    </div>
</section>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'front-page' );
			endwhile;
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

