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

<body <?php body_class( 'bg-white antialiased' ); ?>>

<header class="sticky top-0 z-50 bg-white border-b border-gray-200" role="banner">
    <!-- Row 1: Logo, Categories, Actions -->
    <div class="max-w-[2520px] mx-auto px-6 md:px-10 lg:px-20 h-20 flex items-center justify-between gap-6">

        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
           class="flex items-center gap-1.5 flex-shrink-0 no-underline"
           aria-label="<?php esc_attr_e( 'AirPnP — Go to homepage', 'inf' ); ?>">
            <svg viewBox="0 0 32 32" width="32" height="32" class="text-airbnb fill-current" aria-hidden="true" focusable="false">
                <path d="M16 1C10.477 1 6 5.477 6 11c0 3.526 1.88 6.614 4.697 8.368l-3.63 7.104A1 1 0 008 28h16a1 1 0 00.933-1.362l-3.63-7.27A10.001 10.001 0 0026 11c0-5.523-4.477-10-10-10zm0 2a8 8 0 110 16A8 8 0 0116 3zm0 3a5 5 0 100 10A5 5 0 0016 6zm7.08 17H8.92l2.82-5.516A9.956 9.956 0 0016 19c1.49 0 2.906-.327 4.175-.9L23.08 23z"/>
            </svg>
            <span class="text-airbnb font-black text-xl tracking-tight leading-none hidden sm:inline-block">airpnp</span>
        </a>

        <!-- Category Navigation -->
        <nav class="flex-1 overflow-hidden hidden md:block" aria-label="<?php esc_attr_e( 'Property categories', 'inf' ); ?>">
            <ul class="flex items-end justify-center list-none m-0 p-0 gap-2 h-full" role="list">

                <!-- ALL (Globe illustration) -->
                <li>
                    <a href="#" class="flex flex-col items-center gap-1.5 px-4 pb-3.5 pt-2 text-xs font-semibold text-[#222222] border-b-2 border-[#222222] no-underline whitespace-nowrap" aria-current="page">
                        <svg viewBox="0 0 32 32" width="24" height="24" aria-hidden="true" class="h-6 w-6">
                            <!-- Blue Oceans -->
                            <circle cx="16" cy="16" r="14" fill="#E8F4F8" stroke="#8A9A86" stroke-width="1.5"/>
                            <!-- Landmasses (illustrated) -->
                            <path d="M12 6c-2 2-3 4-1 6s3 1 4 3 2 4 4 4 3-2 3-5-2-5-4-6-4-3-6-2z" fill="#DCE7D6" stroke="#8A9A86" stroke-width="1"/>
                            <path d="M6 16c0 3 3 5 5 4s3-4 1-6-4-1-6 2z" fill="#DCE7D6" stroke="#8A9A86" stroke-width="1"/>
                            <!-- Globe Grid Lines -->
                            <path d="M16 2a14 14 0 000 28M2 16h28" stroke="#8A9A86" stroke-width="1" fill="none" opacity="0.4"/>
                            <path d="M5.5 8.5c4 2 17 2 21 0M5.5 23.5c4-2 17-2 21 0" stroke="#8A9A86" stroke-width="1" fill="none" opacity="0.4"/>
                        </svg>
                        <?php esc_html_e( 'All', 'inf' ); ?>
                    </a>
                </li>

                <!-- HOMES (Log Cabin illustration) -->
                <li>
                    <a href="#" class="flex flex-col items-center gap-1.5 px-4 pb-3.5 pt-2 text-xs font-semibold text-[#717171] border-b-2 border-transparent hover:text-[#222222] hover:border-[#222222] no-underline whitespace-nowrap transition-all">
                        <svg viewBox="0 0 32 32" width="24" height="24" aria-hidden="true" class="h-6 w-6">
                            <!-- Background green tree silhouettes -->
                            <path d="M8 20l3-5 3 5z" fill="#88A07A"/>
                            <path d="M20 20l2.5-4 2.5 4z" fill="#88A07A"/>
                            <!-- Cabin base structure -->
                            <rect x="10" y="16" width="12" height="9" fill="#D5C5B5" stroke="#685848" stroke-width="1.5"/>
                            <!-- Log horizontal lines -->
                            <line x1="10" y1="19" x2="22" y2="19" stroke="#685848" stroke-width="1"/>
                            <line x1="10" y1="22" x2="22" y2="22" stroke="#685848" stroke-width="1"/>
                            <!-- Roof -->
                            <polygon points="9,16 16,10 23,16" fill="#A86858" stroke="#685848" stroke-width="1.5"/>
                            <!-- Door -->
                            <rect x="14" y="20" width="4" height="5" fill="#685848"/>
                        </svg>
                        <?php esc_html_e( 'Homes', 'inf' ); ?>
                    </a>
                </li>

                <!-- EXPERIENCES (Hot-air Balloon illustration) -->
                <li>
                    <a href="#" class="flex flex-col items-center gap-1.5 px-4 pb-3.5 pt-2 text-xs font-semibold text-[#717171] border-b-2 border-transparent hover:text-[#222222] hover:border-[#222222] no-underline whitespace-nowrap transition-all">
                        <svg viewBox="0 0 32 32" width="24" height="24" aria-hidden="true" class="h-6 w-6">
                            <!-- Balloon Basket -->
                            <rect x="14" y="23" width="4" height="3" fill="#D5C5B5" stroke="#685848" stroke-width="1"/>
                            <!-- Ropes -->
                            <line x1="14.5" y1="19" x2="14.5" y2="23" stroke="#685848" stroke-width="1"/>
                            <line x1="17.5" y1="19" x2="17.5" y2="23" stroke="#685848" stroke-width="1"/>
                            <!-- Balloon Envelope -->
                            <path d="M16 4C11.5 4 8 7.5 8 12c0 3.5 2.5 6 4.5 7.5l.5.5h6l.5-.5c2-1.5 4.5-4 4.5-7.5 0-4.4-3.5-8-8-8z" fill="#FF5A5F" stroke="#B03A3E" stroke-width="1.5"/>
                            <!-- Balloon Stripes -->
                            <path d="M16 4c-1.5 2.5-2.5 5.5-2 8 0.5 2.5 2 5 2 5s1.5-2.5 2-5c0.5-2.5-0.5-5.5-2-8z" fill="#FFA3A5"/>
                        </svg>
                        <?php esc_html_e( 'Experiences', 'inf' ); ?>
                    </a>
                </li>

                <!-- SERVICES (Serving Cloche illustration) -->
                <li>
                    <a href="#" class="flex flex-col items-center gap-1.5 px-4 pb-3.5 pt-2 text-xs font-semibold text-[#717171] border-b-2 border-transparent hover:text-[#222222] hover:border-[#222222] no-underline whitespace-nowrap transition-all">
                        <svg viewBox="0 0 32 32" width="24" height="24" aria-hidden="true" class="h-6 w-6">
                            <!-- Platter -->
                            <path d="M4 22h24v2H4z" fill="#90A4AE" stroke="#455A64" stroke-width="1.5"/>
                            <!-- Cloche Dome -->
                            <path d="M6 21.5A10 10 0 0116 11a10 10 0 0110 10.5z" fill="#CFD8DC" stroke="#455A64" stroke-width="1.5"/>
                            <!-- Handle Knob -->
                            <circle cx="16" cy="9.5" r="2" fill="#90A4AE" stroke="#455A64" stroke-width="1.5"/>
                            <!-- Cloche shine highlight -->
                            <path d="M8 20a8 8 0 014-6.5" stroke="#FFFFFF" stroke-width="1" fill="none" opacity="0.6"/>
                        </svg>
                        <?php esc_html_e( 'Services', 'inf' ); ?>
                    </a>
                </li>

            </ul>
        </nav>

        <!-- Right Actions -->
        <div class="flex items-center gap-2 flex-shrink-0">
            <a href="#" class="hidden sm:block text-sm font-semibold text-[#222222] no-underline px-3 py-2.5 rounded-full hover:bg-gray-100 transition-colors whitespace-nowrap">
                <?php esc_html_e( 'Become a host', 'inf' ); ?>
            </a>
            <button class="flex items-center justify-center bg-transparent border border-gray-200 rounded-full p-2.5 cursor-pointer hover:bg-gray-100 transition-colors text-[#222222]"
                    aria-label="<?php esc_attr_e( 'Select language', 'inf' ); ?>">
                <svg viewBox="0 0 16 16" width="16" height="16" class="fill-current" aria-hidden="true" focusable="false">
                    <path d="M8 0a8 8 0 100 16A8 8 0 008 0zm0 1.5c1.46 0 2.82.49 3.93 1.32L9.46 5.28c-.44-.3-.93-.53-1.46-.66V1.5zM1.5 8c0-1.46.49-2.82 1.32-3.93l2.46 2.47c-.3.44-.53.93-.66 1.46H1.5zm6.5 6.5c-1.46 0-2.82-.49-3.93-1.32l2.47-2.46c.44.3.93.53 1.46.66v3.12zm5-6.5h3.12c-.13-.53-.36-1.02-.66-1.46l-2.46 2.46c.13.53.21 1.07.21 1.46c0-.53-.08-1.07-.21-1.46zm-2.46 2.46l2.46 2.47A6.47 6.47 0 018 14.5v-3.12c.53-.13 1.02-.36 1.46-.66zm-5.96.66l-2.47 2.46c-.83-1.11-1.32-2.47-1.32-3.93h3.13c.13.53.36 1.02.66 1.47zm5.96-5.96l2.47-2.46c.83 1.11 1.32 2.47 1.32 3.93H9.46c-.13-.53-.36-1.02-.66-1.47zM3.97 3.97L6.44 6.44a3.48 3.48 0 00-.66 1.47H2.66A6.47 6.47 0 013.97 3.97zm4.03 7.41V8.25h3.13c-.13.53-.36 1.02-.66 1.46l-2.47-1.41v3.08zm0-4.8V2.66c.53.13 1.02.36 1.46.66L8 5.79v.79zm-1.56.65L3.97 3.97C4.78 3.16 5.8 2.66 6.94 2.53v3.13c-.53.13-1.02.36-1.46.66l-.04.66z"/>
                </svg>
            </button>
            <button class="flex items-center gap-3 bg-transparent border border-gray-200 rounded-full pl-3 pr-1.5 py-1.5 cursor-pointer hover:shadow-md transition-shadow text-[#222222]"
                    aria-label="<?php esc_attr_e( 'Open menu', 'inf' ); ?>">
                <svg viewBox="0 0 32 32" width="16" height="16" class="fill-current" aria-hidden="true" focusable="false">
                    <path d="M2 7h28v2H2zm0 8h28v2H2zm0 8h28v2H2z"/>
                </svg>
                <div class="w-8 h-8 rounded-full bg-gray-500 overflow-hidden flex items-center justify-center text-white font-bold text-xs select-none">
                    <svg viewBox="0 0 32 32" width="32" height="32" class="fill-current text-gray-300" aria-hidden="true" focusable="false">
                        <path d="M16 .7C7.56.7.7 7.56.7 16S7.56 31.3 16 31.3 31.3 24.44 31.3 16 24.44.7 16 .7zm0 28C8.67 28.7 3.3 23.33 3.3 16S8.67 3.3 16 3.3 28.7 8.67 28.7 16 23.33 28.7 16 28.7zm0-14.3a3.5 3.5 0 100-7 3.5 3.5 0 000 7zm7.5 6.6c0-3.19-3.36-5.8-7.5-5.8s-7.5 2.61-7.5 5.8c0 .28.02.56.07.83h14.86c.05-.27.07-.55.07-.83z"/>
                    </svg>
                </div>
            </button>
        </div>

    </div>

    <!-- Row 2: Centered Search Bar -->
    <div class="max-w-[2520px] mx-auto px-6 md:px-10 lg:px-20 pb-6 flex justify-center">
        <?php get_template_part( 'template-parts/front-page/search-bar' ); ?>
    </div>
</header>

<div id="page" class="site">
    <div id="content" class="site-content">
