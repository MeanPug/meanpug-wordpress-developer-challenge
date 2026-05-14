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
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div id="page" class="site">

        <?php get_template_part('template-parts/headers/announcement', 'bar'); ?>

        <header class="site-header bg-white z-50 font-sans">
            <div class="container mx-auto px-4 md:px-8">

                <?php get_template_part('template-parts/headers/navbar'); ?>

                <?php if (is_front_page()): ?>

                    <?php get_template_part('template-parts/headers/search', 'expanded'); ?>

                <?php endif; ?>

            </div>
        </header>

        <div id="content" class="site-content">