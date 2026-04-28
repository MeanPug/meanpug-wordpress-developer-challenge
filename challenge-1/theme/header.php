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
    <nav class="sticky top-0 z-50 bg-white px-10">
        <div class="max-w-screen-3xl mx-auto flex items-center justify-between gap-6 px-6 lg:px-0 py-4 lg:py-5">
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
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#000000" width="20" height="20" viewBox="0 0 32 32" version="1.1">
                            <path d="M22.658 10.988h5.172c0.693 1.541 1.107 3.229 1.178 5.012h-5.934c-0.025-1.884-0.181-3.544-0.416-5.012zM20.398 3.896c2.967 1.153 5.402 3.335 6.928 6.090h-4.836c-0.549-2.805-1.383-4.799-2.092-6.090zM16.068 9.986v-6.996c1.066 0.047 2.102 0.216 3.092 0.493 0.75 1.263 1.719 3.372 2.33 6.503h-5.422zM9.489 22.014c-0.234-1.469-0.396-3.119-0.421-5.012h5.998v5.012h-5.577zM9.479 10.988h5.587v5.012h-6.004c0.025-1.886 0.183-3.543 0.417-5.012zM11.988 3.461c0.987-0.266 2.015-0.435 3.078-0.469v6.994h-5.422c0.615-3.148 1.591-5.265 2.344-6.525zM3.661 9.986c1.551-2.8 4.062-4.993 7.096-6.131-0.715 1.29-1.559 3.295-2.114 6.131h-4.982zM8.060 16h-6.060c0.066-1.781 0.467-3.474 1.158-5.012h5.316c-0.233 1.469-0.39 3.128-0.414 5.012zM8.487 22.014h-5.29c-0.694-1.543-1.139-3.224-1.204-5.012h6.071c0.024 1.893 0.188 3.541 0.423 5.012zM8.651 23.016c0.559 2.864 1.416 4.867 2.134 6.142-3.045-1.133-5.557-3.335-7.11-6.142h4.976zM15.066 23.016v6.994c-1.052-0.033-2.067-0.199-3.045-0.46-0.755-1.236-1.736-3.363-2.356-6.534h5.401zM21.471 23.016c-0.617 3.152-1.592 5.271-2.344 6.512-0.979 0.271-2.006 0.418-3.059 0.465v-6.977h5.403zM16.068 17.002h5.998c-0.023 1.893-0.188 3.542-0.422 5.012h-5.576v-5.012zM22.072 16h-6.004v-5.012h5.586c0.235 1.469 0.393 3.126 0.418 5.012zM23.070 17.002h5.926c-0.066 1.787-0.506 3.468-1.197 5.012h-5.152c0.234-1.471 0.398-3.119 0.423-5.012zM27.318 23.016c-1.521 2.766-3.967 4.949-6.947 6.1 0.715-1.276 1.561-3.266 2.113-6.1h4.834z"/>
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
