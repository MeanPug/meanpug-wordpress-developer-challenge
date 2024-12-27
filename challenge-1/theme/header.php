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

<nav class="sticky bg-green inf-site-header z-20">
    <div class="nofication-banner text-center bg-zinc-100 py-4 text-sm">
        <p>
            <?php 
            echo esc_html('Get the latest on our COVID-19 response and cancellation policies. ');
            echo '<a class="font-semibold underline" href=" ' . esc_url('/learn-more') . '" target="_blank">' . esc_html('Learn More') . '</a>';
            ?>
        </p>
    </div>
    <div class="container flex items-center justify-between pt-8 pb-6 mx-auto">
        <div class="w-24">
            <?php echo get_custom_logo() ?>
        </div>

        <!-- Desktop Nav -->
        <div class="pl-12 items-center justify-end hidden lg:flex font-semibold text-sm gap-2">
            <?php wp_nav_menu(array(
                'theme_location' => 'nav',
                'menu_class' => 'inf-menu inf-menu--nav',
                'container' => 'ul',
            )); ?>

            <div class="items-center lg:flex font-semibold text-sm gap-2 py-2 px-3 shadow-md rounded-full">
                <?php display_user_meta() ?>
            </div>
        </div>

        <!-- Mobile Nav -->
        <div class="xl:hidden">
              <div class="flex items-center">
                  <a href="<?php echo $contact_phone['url'] ?>">
                        <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/icons/ic-phone.svg' ?>" alt="<?php _e('Phone Icon', 'inf') ?>" class="w-7 mr-6"/>
                  </a>

                  <div class="xl:hidden relative">
                      <?php wp_nav_menu(array(
                        'theme_location' => 'mobile-nav',
                        'menu_class' => "header-menu", // (string) CSS class to use for the ul element which forms the menu. Default 'menu'.
                      )); ?>
                  </div>
            </div>
        </div>
    </div>
</nav>

<div id="page" class="site">

	<div id="content" class="site-content">
