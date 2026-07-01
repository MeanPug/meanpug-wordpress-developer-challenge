<?php
/**
 * The header for our theme
 *
 * Renders the <head> section and Airbnb-style site navigation.
 * Layout and styling via Tailwind utilities — compiled into critical.css by Webpack/PostCSS.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
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

<body <?php body_class( 'bg-white' ); ?>>

<header class="sticky top-0 z-50 bg-white border-b border-gray-200 h-20" role="banner">
    <div class="max-w-7xl mx-auto px-6 h-full flex items-center justify-between gap-6">

        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
           class="flex items-center gap-1.5 flex-shrink-0 no-underline"
           aria-label="<?php esc_attr_e( 'AirPnP — Go to homepage', 'inf' ); ?>">
            <svg viewBox="0 0 32 32" width="28" height="28" class="text-airbnb fill-current" aria-hidden="true" focusable="false">
                <path d="M16 1C10.477 1 6 5.477 6 11c0 3.526 1.88 6.614 4.697 8.368l-3.63 7.104A1 1 0 008 28h16a1 1 0 00.933-1.362l-3.63-7.27A10.001 10.001 0 0026 11c0-5.523-4.477-10-10-10zm0 2a8 8 0 110 16A8 8 0 0116 3zm0 3a5 5 0 100 10A5 5 0 0016 6zm7.08 17H8.92l2.82-5.516A9.956 9.956 0 0016 19c1.49 0 2.906-.327 4.175-.9L23.08 23z"/>
            </svg>
            <span class="text-airbnb font-bold text-xl tracking-tight leading-none">airpnp</span>
        </a>

        <!-- Category Navigation — hidden on small screens -->
        <nav class="flex-1 overflow-hidden hidden md:block" aria-label="<?php esc_attr_e( 'Property categories', 'inf' ); ?>">
            <ul class="flex items-end justify-center list-none m-0 p-0 gap-1" role="list">

                <li>
                    <a href="#" class="flex flex-col items-center gap-1 px-4 pb-4 pt-2 text-xs font-semibold text-gray-900 border-b-2 border-gray-900 no-underline whitespace-nowrap" aria-current="page">
                        <span aria-hidden="true" class="text-lg">🌐</span>
                        <?php esc_html_e( 'All', 'inf' ); ?>
                    </a>
                </li>

                <li>
                    <a href="#" class="flex flex-col items-center gap-1 px-4 pb-4 pt-2 text-xs font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-900 hover:border-gray-900 no-underline whitespace-nowrap transition-colors">
                        <span aria-hidden="true" class="text-lg">🏠</span>
                        <?php esc_html_e( 'Homes', 'inf' ); ?>
                    </a>
                </li>

                <li>
                    <a href="#" class="flex flex-col items-center gap-1 px-4 pb-4 pt-2 text-xs font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-900 hover:border-gray-900 no-underline whitespace-nowrap transition-colors">
                        <span aria-hidden="true" class="text-lg">🎈</span>
                        <?php esc_html_e( 'Experiences', 'inf' ); ?>
                    </a>
                </li>

                <li>
                    <a href="#" class="flex flex-col items-center gap-1 px-4 pb-4 pt-2 text-xs font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-900 hover:border-gray-900 no-underline whitespace-nowrap transition-colors">
                        <span aria-hidden="true" class="text-lg">🍽️</span>
                        <?php esc_html_e( 'Services', 'inf' ); ?>
                    </a>
                </li>

            </ul>
        </nav>

        <!-- Right Actions -->
        <div class="flex items-center gap-2 flex-shrink-0">
            <a href="#" class="hidden sm:block text-sm font-semibold text-gray-900 no-underline px-3 py-2.5 rounded-full hover:bg-gray-100 transition-colors whitespace-nowrap">
                <?php esc_html_e( 'Become a host', 'inf' ); ?>
            </a>
            <button class="flex items-center justify-center bg-transparent border border-gray-300 rounded-full p-2.5 cursor-pointer hover:shadow-md transition-shadow text-gray-900"
                    aria-label="<?php esc_attr_e( 'Select language', 'inf' ); ?>">
                <svg viewBox="0 0 16 16" width="16" height="16" class="fill-current" aria-hidden="true" focusable="false">
                    <path d="M8 1a7 7 0 100 14A7 7 0 008 1zm0 1.5a5.5 5.5 0 110 11 5.5 5.5 0 010-11zm-.75 2v1.5H5.5v1.5h1.75V10h1.5V7.5h1.75V6H8.75V4.5h-1.5z"/>
                </svg>
            </button>
            <button class="flex items-center gap-2 bg-transparent border border-gray-300 rounded-full px-3 py-2 cursor-pointer hover:shadow-md transition-shadow text-gray-900"
                    aria-label="<?php esc_attr_e( 'Open menu', 'inf' ); ?>">
                <svg viewBox="0 0 32 32" width="16" height="16" class="fill-current" aria-hidden="true" focusable="false">
                    <path d="M2 7h28v2H2zm0 8h28v2H2zm0 8h28v2H2z"/>
                </svg>
                <svg viewBox="0 0 32 32" width="28" height="28" class="fill-gray-400" aria-hidden="true" focusable="false">
                    <path d="M16 .7C7.56.7.7 7.56.7 16S7.56 31.3 16 31.3 31.3 24.44 31.3 16 24.44.7 16 .7zm0 28C8.67 28.7 3.3 23.33 3.3 16S8.67 3.3 16 3.3 28.7 8.67 28.7 16 23.33 28.7 16 28.7zm0-14.3a3.5 3.5 0 100-7 3.5 3.5 0 000 7zm7.5 6.6c0-3.19-3.36-5.8-7.5-5.8s-7.5 2.61-7.5 5.8c0 .28.02.56.07.83h14.86c.05-.27.07-.55.07-.83z"/>
                </svg>
            </button>
        </div>

    </div>
</header>

<div id="page" class="site">
    <div id="content" class="site-content">
