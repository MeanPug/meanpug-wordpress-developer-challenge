<?php
/**
 * Front page header template.
 *
 * Displays a custom header for the front page with COVID banner,
 * logo, navigation, and user controls.
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

<body <?php body_class('bg-white text-neutral-800 antialiased'); ?>>

<?php
$covid_message = get_theme_mod(
    'inf_covid_banner',
    __( 'Get the latest on our COVID-19 response and cancellation policies.', 'inf' )
);
$current_user  = wp_get_current_user();
$user_name     = $current_user->display_name ?: __( 'Guest', 'inf' );
?>

<!-- COVID-19 Announcement Banner -->
<div class="bg-banner-bg border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-3 text-center text-sm font-medium text-neutral-600">
        <?php echo esc_html( $covid_message ); ?>
        <a href="#" class="underline hover:text-black font-semibold"><?php esc_html_e( 'Learn more', 'inf' ); ?></a>
    </div>
</div>

<!-- Header / Navigation Bar -->
<header class="sticky top-0 bg-white z-50 pt-3 pb-6">
    <div class="max-w-7xl mx-auto px-6 flex flex-col gap-8">
        <!-- FIRST ROW: Logo (left) and Secondary Controls (right) -->
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center gap-2 cursor-pointer">
                <img
                    src="<?php echo esc_url( get_theme_file_uri( '/assets/images/meanpug-icon.png' ) ); ?>"
                    alt="<?php esc_attr_e( 'MeanPug Best In Show Pug Icon', 'inf' ); ?>"
                    class="h-10 w-auto drop-shadow-sm"
                >
                <span class="text-2xl font-extrabold tracking-tight text-airbnb">airpnp</span>
            </div>

            <!-- Host Controls & User Profile (Right) -->
            <div class="flex items-center gap-2">
                <!-- Language Selector -->
                <button class="text-neutral-800 hover:bg-gray-100 px-3 py-2 rounded-full transition flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-neutral-800" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3a18.3 18.3 0 0 0 0 18M12 3a18.3 18.3 0 0 1 0 18M3 12h18"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-2.5 h-2.5 text-neutral-800">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>

                <a href="#" class="hidden sm:inline-block text-sm font-semibold text-neutral-800 hover:bg-gray-100 px-3.5 py-2 rounded-full transition"><?php esc_html_e( 'Host your home', 'inf' ); ?></a>
                <a href="#" class="hidden sm:inline-block text-sm font-semibold text-neutral-800 hover:bg-gray-100 px-3.5 py-2 rounded-full transition"><?php esc_html_e( 'Host an experience', 'inf' ); ?></a>
                <a href="#" class="hidden sm:inline-block text-sm font-semibold text-neutral-800 hover:bg-gray-100 px-3.5 py-2 rounded-full transition"><?php esc_html_e( 'Help', 'inf' ); ?></a>

                <!-- User Pill Button -->
                <div class="border border-gray-200 rounded-full py-1.5 pl-4 pr-1.5 flex items-center gap-3 hover:shadow-md cursor-pointer transition bg-white relative ml-1">
                    <span class="text-sm font-semibold text-neutral-800 select-none"><?php echo esc_html( $user_name ); ?></span>
                    <div class="relative">
                        <img
                            src="<?php echo esc_url( get_theme_file_uri( '/assets/images/meanpug-icon.png' ) ); ?>"
                            alt="<?php esc_attr_e( 'User avatar', 'inf' ); ?>"
                            class="h-8 w-8 rounded-full border border-gray-100 bg-gray-50 object-cover"
                        >
                        <span class="absolute -top-1.5 -right-1.5 bg-airbnb text-white text-[9px] font-bold h-4 w-4 rounded-full flex items-center justify-center border border-white">0</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECOND ROW: Navigation Categories -->
        <div class="flex items-center gap-6 mt-1">
            <?php
            if ( has_nav_menu( 'front-header' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'front-header',
                    'container'      => false,
                    'menu_class'     => 'flex items-center gap-6',
                    'fallback_cb'    => false,
                ) );
            } else {
                ?>
                <a href="#" class="text-sm font-normal text-black border-b-2 border-black pb-2 transition"><?php esc_html_e( 'Places to stay', 'inf' ); ?></a>
                <a href="#" class="text-sm font-normal text-neutral-500 hover:text-black pb-2 transition"><?php esc_html_e( 'Monthly stays', 'inf' ); ?></a>
                <a href="#" class="text-sm font-normal text-neutral-500 hover:text-black pb-2 transition"><?php esc_html_e( 'Experiences', 'inf' ); ?></a>
                <div class="flex items-center gap-1 pb-2">
                    <a href="#" class="text-sm font-normal text-neutral-500 hover:text-black transition"><?php esc_html_e( 'Online Experiences', 'inf' ); ?></a>
                    <span class="bg-black text-white text-[9px] font-bold px-1.5 py-0.5 rounded uppercase tracking-wider"><?php esc_html_e( 'NEW', 'inf' ); ?></span>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</header>

<div id="page" class="site">
	<div id="content" class="site-content">
