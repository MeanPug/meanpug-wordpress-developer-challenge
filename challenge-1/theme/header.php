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
    <script src="https://kit.fontawesome.com/b2ab972afb.js" crossorigin="anonymous"></script>   
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<nav class="sticky bg-green inf-site-header z-20">
    <div  class="top-header-bar">Get the latest on our COVID-19 response and cancellation policies. <a href="#">Learn More</a></div>
    <div class="container flex items-center justify-between pt-8 pb-6">
        

        <!-- Desktop Nav -->
        <div class="pl-12 items-center justify-end hidden flex">
            <div class="nav-container">
                <div class="w-48 lg:w-96">
                    <?php echo get_custom_logo() ?>
                </div>
                <div style="display: flex; justify-content: center; align-items: center;">
                    <div>
                        <img width="20px" src="/wp-content/uploads/2026/05/globe-solid-full.svg" alt="">
                    </div>
                    <div class="flex-grow">
                        <?php wp_nav_menu(array(
                            'theme_location' => 'nav',
                            'menu_class' => 'inf-menu inf-menu--nav list-none',
                        )); ?>
                    </div>
                    <a href="#" class="user-profile">
                        <p>User</p>
                        <img width="30px" src="/wp-content/uploads/2026/05/MeanPug-Best-In-Show-Icon.png" alt="">
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</nav>

<div id="page" class="site">

	<div id="content" class="site-content">
