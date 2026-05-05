<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package infra
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- COVID-19 Top Banner -->
<div class="airpnp-banner" id="covid-banner">
    Get the latest on our Pug Adoption initiatives and foster policies.
    <a href="#">Learn more</a>
</div>

<!-- Main Site Header  -->
<header class="airpnp-header" id="site-header">
    <div class="airpnp-header__inner">

        <!-- Top Row: Logo + Actions -->
        <div class="airpnp-header__top">

            <!-- Logo -->
            <div class="airpnp-header__logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Pugs Sactuary — Home" class="airpnp-header__logo-link">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/meanpug-logo.png"
                         alt="Pugs Sactuary"
                         class="airpnp-header__logo-icon" />
                </a>
            </div>

            <!-- Right-side User Menu  -->
            <div class="airpnp-header__actions">
                <a href="#" class="airpnp-header__action-link">Host a pug home</a>
                <a href="#" class="airpnp-header__action-link">Foster a pug</a>
                <a href="#" class="airpnp-header__action-link">Help</a>

                <!-- Globe Icon -->
                <button class="airpnp-header__globe" aria-label="Choose a language">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm5.9 7h-2.2a12.6 12.6 0 0 0-1.1-4.7A6.5 6.5 0 0 1 13.9 7zM8 14.5c-.8 0-2-2-2.3-5.5h4.6c-.3 3.5-1.5 5.5-2.3 5.5zM5.7 7C6 3.5 7.2 1.5 8 1.5s2 2 2.3 5.5H5.7zM5.4 2.3A12.6 12.6 0 0 0 4.3 7H2.1a6.5 6.5 0 0 1 3.3-4.7zM2.1 9h2.2a12.6 12.6 0 0 0 1.1 4.7A6.5 6.5 0 0 1 2.1 9zm8.5 4.7A12.6 12.6 0 0 0 11.7 9h2.2a6.5 6.5 0 0 1-3.3 4.7z"/>
                    </svg>
                </button>

                <!-- User Menu Pill -->
                <button class="airpnp-header__user-menu" aria-label="User menu" id="user-menu-toggle">
                    <!-- Notification Badge -->
                    <span class="airpnp-header__badge">2</span>
                    <!-- Hamburger Icon -->
                    <div class="airpnp-header__hamburger" aria-hidden="true">
                        <span class="airpnp-header__hamburger-line"></span>
                        <span class="airpnp-header__hamburger-line"></span>
                        <span class="airpnp-header__hamburger-line"></span>
                    </div>
                    <!-- Avatar -->
                    <div class="airpnp-header__avatar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="currentColor">
                            <path d="M16 1a15 15 0 1 0 0 30 15 15 0 0 0 0-30zm0 5a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 22a12 12 0 0 1-9.4-4.6C9.4 20.3 13.5 19 16 19s6.6 1.3 9.4 4.4A12 12 0 0 1 16 28z"/>
                        </svg>
                    </div>
                </button>
            </div>

            <!-- Mobile Menu Toggle  -->
            <button class="airpnp-header__mobile-toggle" id="mobile-menu-toggle" aria-label="Open menu">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

        </div>

        <!-- Navigation Tabs -->
        <nav class="airpnp-nav" id="main-navigation" aria-label="Main navigation">
            <ul class="airpnp-nav__tabs">
                <li class="airpnp-nav__tab airpnp-nav__tab--active">Pug Stays</li>
                <li class="airpnp-nav__tab">Monthly Fosters</li>
                <li class="airpnp-nav__tab">Experiences</li>
                <li class="airpnp-nav__tab">
                    Online Meet & Greets
                    <span class="airpnp-nav__new-badge">NEW</span>
                </li>
            </ul>
        </nav>

    </div>
</header>

<!-- Mobile Navigation Overlay  -->
<div class="airpnp-mobile-nav" id="mobile-nav-overlay" aria-hidden="true">
    <div class="airpnp-mobile-nav__header">
        <div class="airpnp-header__logo">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/meanpug-logo.png"
                 alt="Pugs Sactuary"
                 class="airpnp-header__logo-icon" />
        </div>
        <button class="airpnp-mobile-nav__close" id="mobile-menu-close" aria-label="Close menu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <div class="airpnp-mobile-nav__links">
        <a href="#" class="airpnp-mobile-nav__link airpnp-mobile-nav__link--active">Pug Stays</a>
        <a href="#" class="airpnp-mobile-nav__link">Monthly Fosters</a>
        <a href="#" class="airpnp-mobile-nav__link">Experiences</a>
        <a href="#" class="airpnp-mobile-nav__link">Online Meet & Greets</a>
        <a href="#" class="airpnp-mobile-nav__link">Host a pug home</a>
        <a href="#" class="airpnp-mobile-nav__link">Foster a pug</a>
        <a href="#" class="airpnp-mobile-nav__link">Help</a>
    </div>
</div>

<script>
(function() {
    var toggle = document.getElementById('mobile-menu-toggle');
    var overlay = document.getElementById('mobile-nav-overlay');
    var close = document.getElementById('mobile-menu-close');

    if (toggle && overlay && close) {
        toggle.addEventListener('click', function() {
            overlay.classList.add('airpnp-mobile-nav--open');
            overlay.setAttribute('aria-hidden', 'false');
        });
        close.addEventListener('click', function() {
            overlay.classList.remove('airpnp-mobile-nav--open');
            overlay.setAttribute('aria-hidden', 'true');
        });
    }
})();
</script>

<div id="page" class="site">

	<div id="content" class="site-content">
