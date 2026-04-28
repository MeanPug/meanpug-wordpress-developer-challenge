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

<header class="w-full">
    <!-- COVID banner -->
    <div class="bg-airbnb-soft border-airbnb-border text-center text-sm text-airbnb-text py-3.5">
        <div class="max-w-3xl mx-auto">
            <span>Get the latest on our pandemic response and pug-friendly cancellation policies.</span>
            <a href="#" target="_blank" class="font-bold underline hover:text-airbnb-pink">Learn more</a>
        </div>
    </div>
    <!-- End COVID banner -->

    <!-- Main nav -->
    <nav class="sticky top-0 z-50 bg-white">
        <div class="max-w-screen-3xl mx-auto flex items-center justify-between gap-6 px-6 lg:px-10 py-4 lg:py-5">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
               class="flex items-center gap-1 text-airbnb-pink font-extrabold text-3xl"
               aria-label="Pugbnb home">
                <svg class="w-10 h-10 lg:w-9 lg:h-9" viewBox="0 0 50 50" aria-hidden="true">
                    <path fill="currentColor" d="M25 1c-1.7 0-3.4 1-4.7 3.2-2.7 4.1-5.4 9.7-7.9 14.7-2.5 5-4.7 9.5-6.4 13.2-1.6 3.9-2.6 6.9-3 9.4-.4 2.4-.2 4.4 1 5.8 1.2 1.4 3.1 2.1 5.6 1.6 2.5-.5 5.6-2.1 9.3-4.9 1.7-1.3 3.4-2.8 5.1-4.5l1-1 1 1c1.7 1.7 3.4 3.2 5.1 4.5 3.7 2.8 6.8 4.4 9.3 4.9 2.5.5 4.4-.2 5.6-1.6 1.2-1.4 1.4-3.4 1-5.8-.4-2.4-1.4-5.4-3-9.4-1.7-3.7-3.9-8.2-6.4-13.2-2.5-5-5.2-10.6-7.9-14.7C28.4 2.1 26.7 1 25 1zm0 4.4c.4 0 .9.5 1.5 1.4.6.9 1.5 2.5 2.5 4.4 1.5 2.9 3.1 6.1 4.7 9.4-3 1.5-5.6 3.7-7.7 6.5-.4.5-.7 1-1 1.5-.3-.5-.6-1-1-1.5-2.1-2.8-4.7-5-7.7-6.5 1.6-3.3 3.2-6.5 4.7-9.4 1-1.9 1.9-3.5 2.5-4.4.6-.9 1.1-1.4 1.5-1.4z"/>
                </svg>
                <span>pugbnb</span>
            </a>

            <ul class="flex items-center gap-1">
                <li>
                    <button
                            class="inline-flex items-center gap-1 px-3 py-3 rounded-full text-sm font-semibold hover:bg-airbnb-soft transition-colors"
                            aria-label="Choose a language">
                        <svg viewBox="0 0 16 16" class="w-4 h-4" aria-hidden="true">
                            <path fill="currentColor" d="M8 0a8 8 0 100 16A8 8 0 008 0zm6 7h-2.6c-.1-1.7-.4-3.3-.9-4.5C12.4 3.4 13.7 5 14 7zM8 14c-.5 0-1.5-1.4-2-4h4c-.5 2.6-1.5 4-2 4zM5.8 9c-.1-.6-.1-1.3-.1-2s0-1.4.1-2h4.4c.1.6.1 1.3.1 2s0 1.4-.1 2H5.8zM2 8c0-.3 0-.7.1-1H5C4.9 7.7 4.9 8.3 5 9H2.1C2 8.7 2 8.3 2 8zm6-6c.5 0 1.5 1.4 2 4H6c.5-2.6 1.5-4 2-4zM5.5 2.5C5 3.7 4.7 5.3 4.6 7H2C2.3 5 3.6 3.4 5.5 2.5zM2 9h2.6c.1 1.7.4 3.3.9 4.5C3.6 12.6 2.3 11 2 9zm8.5 4.5c.5-1.2.8-2.8.9-4.5H14c-.3 2-1.6 3.6-3.5 4.5z"/>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 1024 1024" class="icon" version="1.1"><path d="M903.232 256l56.768 50.432L512 768 64 306.432 120.768 256 512 659.072z" fill="currentColor" stroke="currentColor" stroke-width="80" stroke-linejoin="round"/></svg>
                    </button>
                </li>
                <li>
                    <a href="#" class="px-4 py-3 rounded-full text-sm font-semibold hover:bg-airbnb-soft transition-colors">Host your pug</a>
                </li>
                <li>
                    <a href="#" class="px-4 py-3 rounded-full text-sm font-semibold hover:bg-airbnb-soft transition-colors">Host an experience</a>
                </li>
                <li class="hidden lg:block">
                    <a href="#" class="px-4 py-3 rounded-full text-sm font-semibold hover:bg-airbnb-soft transition-colors">Help</a>
                </li>
                <li>
                    <button
                            class="flex items-center gap-3 ml-2 pl-3.5 pr-1.5 py-1 shadow-md rounded-full text-sm font-medium bg-white hover:shadow-md transition-shadow"
                            aria-label="User menu, 2 unread notifications">
                        <span class="hidden sm:inline">Bobby</span>
                        <span class="relative inline-block w-8 h-8 rounded-full bg-cover bg-center bg-gray-300"
                              style="background-image:url('https://media.prod.meanpug.net/wp-content/uploads/sites/9/2020/01/24060038/MeanPug-Best-In-Show-Icon.png');"
                              aria-hidden="true">
                            <span class="absolute -top-2 -right-2 w-[21px] h-[21px] rounded-full bg-airbnb-pink text-white text-xs flex items-center justify-center border-2 border-white">2</span>
                        </span>
                    </button>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Main nav -->
</header>
