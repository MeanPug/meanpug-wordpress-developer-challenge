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

<!-- Search Bar  -->
<section class="airpnp-container py-6" id="search-section">
    <div class="airpnp-search" id="search-bar">
        <!-- Location Field -->
        <div class="airpnp-search__field" id="search-location">
            <span class="airpnp-search__label">Location</span>
            <span class="airpnp-search__placeholder">Where is your pug going?</span>
        </div>

        <div class="airpnp-search__divider" aria-hidden="true"></div>

        <!-- Check In / Check Out Field -->
        <div class="airpnp-search__field" id="search-dates">
            <span class="airpnp-search__label">Check in / Check out</span>
            <span class="airpnp-search__placeholder">Add sniff dates</span>
        </div>

        <div class="airpnp-search__divider" aria-hidden="true"></div>

        <!-- Guests Field -->
        <div class="airpnp-search__field" id="search-guests">
            <span class="airpnp-search__label">Pugs</span>
            <span class="airpnp-search__placeholder">How many pugs?</span>
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

<!-- Hero Banner  -->
<section class="airpnp-container py-4" id="hero-section">
    <div class="airpnp-hero" id="hero-banner">
        <div class="airpnp-hero__content">
            <h1 class="airpnp-hero__heading">
                We stand with<br>#BlackLivesMatter
            </h1>
            <p class="airpnp-hero__body">
                Now more than ever, it's important that you know how we're fighting discrimination on Airbnb. We'd like to share our newest initiative with you, Project Lighthouse.
            </p>
            <a href="#" class="airpnp-hero__cta" id="hero-cta">
                Learn more
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Category Cards  -->
<section class="airpnp-container py-6" id="cards-section">
    <div class="airpnp-grid">

        <!-- Card 1: Outdoor  -->
        <a href="#" class="airpnp-card" id="card-outdoor">
            <div class="airpnp-card__image">
                <span class="airpnp-card__badge">NEW</span>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/card-outdoor.png"
                     alt="Pug relaxing in a tropical hammock"
                     loading="lazy" />
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/MeanPug-Best-In-Show-Icon.png"
                     alt="Pug mascot"
                     class="airpnp-card__mascot" />
            </div>
        </a>

        <!-- Card 2: Workspace -->
        <a href="#" class="airpnp-card" id="card-workspace">
            <div class="airpnp-card__image">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/card-workspace.png"
                     alt="Pug at a cozy remote workspace"
                     loading="lazy" />
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/MeanPug-Best-In-Show-Icon.png"
                     alt="Pug mascot"
                     class="airpnp-card__mascot" />
            </div>
        </a>

        <!-- Card 3: Cabin -->
        <a href="#" class="airpnp-card" id="card-cabin">
            <div class="airpnp-card__image">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/card-cabin.png"
                     alt="Pug at a cozy forest cabin"
                     loading="lazy" />
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/MeanPug-Best-In-Show-Icon.png"
                     alt="Pug mascot"
                     class="airpnp-card__mascot" />
            </div>
        </a>

    </div>
</section>

<?php
get_footer();

