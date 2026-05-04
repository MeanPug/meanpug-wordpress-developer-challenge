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
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
// Determine current language from URL parameter
$allowed_languages = array('pt-br', 'en', 'es');
$current_lang = isset($_GET['lang']) && in_array($_GET['lang'], $allowed_languages) ? sanitize_text_field($_GET['lang']) : 'pt-br';
$lang_labels = array(
    'pt-br' => 'PT-BR',
    'en'    => 'EN',
    'es'    => 'ESP',
);
$current_lang_label = isset($lang_labels[$current_lang]) ? $lang_labels[$current_lang] : 'PT-BR';

/**
 * Helper to build a URL with the language parameter.
 * Only sets the lang parameter to prevent carrying forward unintended query args.
 */
function airpug_lang_url($lang_code) {
    return add_query_arg('lang', $lang_code, home_url('/'));
}

// ACF fields (theme options)
$options_id = airpug_get_options_page_id();
$banner_text      = $options_id ? get_field('banner_text', $options_id) : '';
$banner_link      = $options_id ? get_field('banner_link', $options_id) : '#';
$banner_link_text = $options_id ? get_field('banner_link_text', $options_id) : '';
$notif_count      = $options_id ? get_field('notification_count', $options_id) : 0;

// Banner fallbacks
if (! $banner_text) {
    $banner_text = 'Get the latest on our pandemic response and pug-friendly cancellation policies.';
}
if (! $banner_link) {
    $banner_link = '#';
}
if (! $banner_link_text) {
    $banner_link_text = 'Learn more';
}
if (! $notif_count) {
    $notif_count = 0;
}

// User data: logged in -> real name & avatar; otherwise -> Puggy and fallback image
if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $user_name    = $current_user->display_name;
    $avatar_url   = get_avatar_url($current_user->ID, array('size' => 32));
} else {
    $user_name  = 'Puggy';
    $avatar_url = get_stylesheet_directory_uri() . '/assets/img/MeanPug-Best-In-Show-Icon.png';
}
?>

<header class="w-full">
    <!-- COVID Banner -->
    <div class="w-full bg-gray-100 text-center text-sm text-airbnb-text py-3.5">
        <div class="max-w-3xl mx-auto px-4">
            <span><?php echo esc_html($banner_text); ?></span>
            <a href="<?php echo esc_url($banner_link); ?>" target="_blank" class="font-bold underline hover:text-airbnb-pink">
                <?php echo esc_html($banner_link_text); ?>
            </a>
        </div>
    </div>

    <!-- Main navigation -->
    <nav class="sticky top-0 z-50 bg-white px-4 lg:px-10">
        <div class="max-w-screen-3xl mx-auto flex items-center justify-between gap-6 py-4 lg:py-5">
            <!-- Logo (always visible) -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center max-w-[150px] flex-shrink-0" aria-label="Airpub home">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <!-- Fallback SVG logo -->
                    <div class="flex items-center gap-1 max-w-[150px]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 240" width="600" height="240" fill="none">
                            <defs>
                                <linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
                                    <stop offset="0%" stop-color="#FF5A5F" />
                                    <stop offset="100%" stop-color="#FF385C" />
                                </linearGradient>
                            </defs>
                            <g stroke="url(#g)" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" fill="none">
                                <path d="M120 40 C80 40,60 70,70 100 C55 90,45 105,55 120 C65 135,90 150,110 175 C120 188,125 200,125 210 C125 220,130 225,135 220 C140 225,145 220,145 210 C145 200,150 188,160 175 C180 150,205 135,215 120 C225 105,215 90,200 100 C210 70,190 40,150 40 C140 40,135 50,135 55 C135 50,130 40,120 40 Z" />
                                <path d="M105 95 Q135 80,165 95" />
                                <path d="M110 108 Q135 96,160 108" />
                                <circle cx="110" cy="130" r="5" fill="url(#g)" />
                                <circle cx="160" cy="130" r="5" fill="url(#g)" />
                                <path d="M120 150 Q135 160,150 150 Q155 165,135 170 Q115 165,120 150 Z" fill="url(#g)" fill-opacity="0.15" />
                                <ellipse cx="135" cy="155" rx="8" ry="5" fill="url(#g)" />
                                <path d="M135 162 Q125 178,118 175" />
                                <path d="M135 162 Q145 178,152 175" />
                            </g>
                            <text x="270" y="155" font-family="'Nunito','Quicksand','Avenir Next','Helvetica Neue',Arial,sans-serif" font-size="110" font-weight="800" fill="#222222" letter-spacing="-3">airpug</text>
                        </svg>
                    </div>
                <?php endif; ?>
            </a>

            <!-- Mobile hamburger button (hidden on desktop) -->
            <button id="mobile-menu-toggle" class="lg:hidden inline-flex items-center p-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none" aria-expanded="false" aria-controls="mobile-menu">
                <span class="sr-only">Open main menu</span>
                <!-- Hamburger icon -->
                <svg id="menu-icon-open" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <!-- Close icon (hidden by default) -->
                <svg id="menu-icon-close" class="h-6 w-6 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Desktop menu (hidden on mobile) -->
            <ul class="hidden lg:flex items-center gap-1 ml-auto">
                <!-- Language dropdown (desktop) -->
                <li class="relative group">
                    <button class="inline-flex items-center gap-1 px-3 py-3 rounded-full text-sm font-semibold hover:bg-airbnb-soft transition-colors"
                            aria-expanded="false"
                            aria-haspopup="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 32 32" fill="none" aria-hidden="true">
                            <path d="M22.658 10.988h5.172c0.693 1.541 1.107 3.229 1.178 5.012h-5.934c-0.025-1.884-0.181-3.544-0.416-5.012zM20.398 3.896c2.967 1.153 5.402 3.335 6.928 6.090h-4.836c-0.549-2.805-1.383-4.799-2.092-6.090zM16.068 9.986v-6.996c1.066 0.047 2.102 0.216 3.092 0.493 0.75 1.263 1.719 3.372 2.33 6.503h-5.422zM9.489 22.014c-0.234-1.469-0.396-3.119-0.421-5.012h5.998v5.012h-5.577zM9.479 10.988h5.587v5.012h-6.004c0.025-1.886 0.183-3.543 0.417-5.012zM11.988 3.461c0.987-0.266 2.015-0.435 3.078-0.469v6.994h-5.422c0.615-3.148 1.591-5.265 2.344-6.525zM3.661 9.986c1.551-2.8 4.062-4.993 7.096-6.131-0.715 1.29-1.559 3.295-2.114 6.131h-4.982zM8.060 16h-6.060c0.066-1.781 0.467-3.474 1.158-5.012h5.316c-0.233 1.469-0.39 3.128-0.414 5.012zM8.487 22.014h-5.29c-0.694-1.543-1.139-3.224-1.204-5.012h6.071c0.024 1.893 0.188 3.541 0.423 5.012zM8.651 23.016c0.559 2.864 1.416 4.867 2.134 6.142-3.045-1.133-5.557-3.335-7.11-6.142h4.976zM15.066 23.016v6.994c-1.052-0.033-2.067-0.199-3.045-0.46-0.755-1.236-1.736-3.363-2.356-6.534h5.401zM21.471 23.016c-0.617 3.152-1.592 5.271-2.344 6.512-0.979 0.271-2.006 0.418-3.059 0.465v-6.977h5.403zM16.068 17.002h5.998c-0.023 1.893-0.188 3.542-0.422 5.012h-5.576v-5.012zM22.072 16h-6.004v-5.012h5.586c0.235 1.469 0.393 3.126 0.418 5.012zM23.070 17.002h5.926c-0.066 1.787-0.506 3.468-1.197 5.012h-5.152c0.234-1.471 0.398-3.119 0.423-5.012zM27.318 23.016c-1.521 2.766-3.967 4.949-6.947 6.1 0.715-1.276 1.561-3.266 2.113-6.1h4.834z" fill="currentColor"/>
                        </svg>
                        <span class="hidden xl:inline text-sm"><?php echo esc_html($current_lang_label); ?></span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 1024 1024" class="ml-1" aria-hidden="true">
                            <path d="M903.232 256l56.768 50.432L512 768 64 306.432 120.768 256 512 659.072z" fill="currentColor"/>
                        </svg>
                    </button>

                    <div class="absolute right-0 mt-2 w-32 bg-white rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <a href="<?php echo esc_url(airpug_lang_url('en')); ?>" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-t-lg">EN</a>
                        <a href="<?php echo esc_url(airpug_lang_url('es')); ?>" class="block px-4 py-2 text-sm hover:bg-gray-100">ESP</a>
                        <a href="<?php echo esc_url(airpug_lang_url('pt-br')); ?>" class="block px-4 py-2 text-sm hover:bg-gray-100 rounded-b-lg">PT-BR</a>
                    </div>
                </li>

                <?php
                /**
                 * Native WordPress menu – theme location "nav".
                 * Link classes (rounded-full, etc.) are added via filter in functions.php.
                 */
                wp_nav_menu(array(
                    'theme_location' => 'nav',
                    'container'      => false,
                    'items_wrap'     => '%3$s',  // remove outer <ul>
                    'fallback_cb'    => false,
                ));
                ?>

                <!-- User block (desktop) -->
                <li>
                    <button class="flex items-center gap-3 ml-2 pl-3.5 pr-1.5 py-1 shadow-md rounded-full text-sm font-medium bg-white hover:shadow-md transition-shadow"
                            aria-label="User menu, <?php echo esc_attr($notif_count); ?> unread notifications">
                        <span class="hidden sm:inline"><?php echo esc_html($user_name); ?></span>
                        <span class="relative inline-block w-8 h-8 rounded-full bg-cover bg-center bg-gray-300"
                              style="background-image:url('<?php echo esc_url($avatar_url); ?>');" aria-hidden="true">
                            <?php if ($notif_count > 0) : ?>
                                <span class="absolute -top-2 -right-2 w-[21px] h-[21px] rounded-full bg-airbnb-pink text-white text-xs flex items-center justify-center border-2 border-white">
                                    <?php echo intval($notif_count); ?>
                                </span>
                            <?php endif; ?>
                        </span>
                    </button>
                </li>
            </ul>
        </div>

       <!-- Mobile full-screen overlay menu (hidden by default) -->
        <div id="mobile-menu" class="fixed inset-0 z-40 bg-white transform translate-x-full transition-transform duration-300 lg:hidden">
            <div class="flex flex-col h-full px-6 py-8">
                <!-- Header line: Language + close button -->
                <div class="flex items-center justify-between mb-4">
                    <span class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Language</span>
                    <button id="mobile-menu-close" class="inline-flex items-center p-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none">
                        <span class="sr-only">Close menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Mobile menu content -->
                <ul class="flex flex-col gap-6">
                    <!-- Language selector (now without the label, because it's already above) -->
                    <li>
                        <div class="flex gap-2 mt-2">
                            <a href="<?php echo esc_url(airpug_lang_url('en')); ?>" class="px-4 py-2 rounded-full text-sm font-medium <?php echo $current_lang === 'en' ? 'bg-airbnb-pink text-white' : 'bg-gray-100 text-gray-800'; ?>">EN</a>
                            <a href="<?php echo esc_url(airpug_lang_url('es')); ?>" class="px-4 py-2 rounded-full text-sm font-medium <?php echo $current_lang === 'es' ? 'bg-airbnb-pink text-white' : 'bg-gray-100 text-gray-800'; ?>">ESP</a>
                            <a href="<?php echo esc_url(airpug_lang_url('pt-br')); ?>" class="px-4 py-2 rounded-full text-sm font-medium <?php echo $current_lang === 'pt-br' ? 'bg-airbnb-pink text-white' : 'bg-gray-100 text-gray-800'; ?>">PT-BR</a>
                        </div>
                    </li>

                    <!-- WordPress nav menu (mobile) -->
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'nav',
                        'container'      => false,
                        'menu_class'     => 'flex flex-col gap-4',
                        'fallback_cb'    => false,
                        'depth'          => 1,
                    ));
                    ?>

                    <!-- User block (mobile) -->
                    <li class="border-t pt-4 mt-2">
                        <div class="flex items-center gap-3">
                            <span class="w-12 h-12 rounded-full bg-cover bg-center" style="background-image:url('<?php echo esc_url($avatar_url); ?>');"></span>
                            <div>
                                <span class="block text-lg font-medium"><?php echo esc_html($user_name); ?></span>
                                <?php if ($notif_count > 0) : ?>
                                    <span class="inline-block mt-1 bg-airbnb-pink text-white text-xs px-2 py-0.5 rounded-full">
                                        <?php echo intval($notif_count); ?> notifications
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
