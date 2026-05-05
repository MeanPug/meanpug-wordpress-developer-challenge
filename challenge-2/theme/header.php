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

<body <?php body_class('overflow-x-hidden'); ?>>

<header class="sticky top-0 z-50 w-full h-[80px] bg-[#0b1120] border-b border-white/5 flex items-center">
    <div class="max-w-[1400px] mx-auto px-6 w-full flex items-center justify-between gap-6">
        <div class="flex-shrink-0">
            <a href="<?php echo home_url(); ?>" class="text-white text-xl font-black tracking-tight hover:text-[#d4af37] transition-colors uppercase">
                MeanPug
            </a>
        </div>

        <nav class="hidden xl:block">
            <?php wp_nav_menu(array(
                'theme_location' => 'nav',
                'container' => false,
                'menu_class' => 'flex items-center space-x-10 text-[11px] font-bold uppercase tracking-[0.2em] text-white/70',
                'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                'fallback_cb' => false,
            )); ?>
        </nav>

        <div class="hidden lg:flex items-center">
            <a href="tel:1-800-PUG-FIRM" class="text-white font-black text-lg tracking-widest hover:text-[#d4af37] transition-colors">
                1-800-PUG-FIRM
            </a>
        </div>

        <div class="lg:hidden">
            <button id="mobile-menu-toggle" class="text-white p-2" aria-expanded="false" aria-controls="mobile-menu" aria-label="Toggle mobile menu">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
            </button>
        </div>
    </div>
    <nav id="mobile-menu" class="hidden lg:hidden bg-[#0b1120] border-t border-white/10 px-6 py-6" aria-hidden="true">
        <?php wp_nav_menu(array(
            'theme_location' => 'nav',
            'container' => false,
            'menu_class' => 'flex flex-col gap-5 text-[11px] font-bold uppercase tracking-[0.2em] text-white/70',
            'items_wrap' => '<ul class="%2$s">%3$s</ul>',
            'fallback_cb' => false,
        )); ?>
        <a href="tel:1-800-PUG-FIRM" class="inline-block mt-4 text-[#d4af37] font-black tracking-widest">1-800-PUG-FIRM</a>
    </nav>
</header>

<div id="page" class="site bg-white min-h-screen flex flex-col">

	<div id="content" class="site-content flex-grow">
