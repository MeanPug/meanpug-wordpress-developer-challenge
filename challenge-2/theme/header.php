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

<nav class="sticky top-0 z-50 bg-slate-900 border-b border-slate-800">
    <div class="container mx-auto flex items-center justify-between py-4 px-6">
        
        <div class="w-48 lg:w-64">
            <?php echo get_custom_logo() ?>
        </div>

        <div class="hidden lg:flex items-center gap-10">
            
            <div class="flex items-center">
                <?php wp_nav_menu(array(
                    'theme_location' => 'nav',
                    'menu_class'     => 'flex gap-8 text-white font-medium text-sm uppercase tracking-widest',
                    'container'      => false,
                )); ?>
            </div>

            <div class="relative group py-2">
                <button class="flex items-center gap-2 text-white font-medium text-sm uppercase tracking-widest group-hover:text-sky-400 transition-colors">
                    Practice Areas
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div class="absolute right-0 lg:left-0 hidden group-hover:block pt-4 w-72 z-50">
                    <div class="bg-slate-800 border border-slate-700 rounded-xl shadow-2xl overflow-hidden">
                        <ul class="py-2">
                            <?php
                            $nav_areas = new WP_Query([
                                'post_type'      => 'practice_area',
                                'posts_per_page' => 6,
                                'orderby'        => 'title',
                                'order'          => 'ASC'
                            ]);

                            if ($nav_areas->have_posts()) :
                                while ($nav_areas->have_posts()) : $nav_areas->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" class="block px-6 py-3 text-sm text-slate-300 hover:bg-slate-700 hover:text-sky-400 transition-colors border-l-2 border-transparent hover:border-sky-500">
                                            <?php the_title(); ?>
                                        </a>
                                    </li>
                                <?php endwhile; wp_reset_postdata(); ?>
                            <?php else : ?>
                                <li class="px-6 py-3 text-xs text-slate-500 italic">No areas found</li>
                            <?php endif; ?>
                            
                            <li class="bg-slate-900/50 border-t border-slate-700 mt-2">
                                <a href="<?php echo get_post_type_archive_link('practice_area'); ?>" class="block px-6 py-4 text-xs font-black text-sky-500 uppercase tracking-tighter hover:text-sky-300">
                                    View All Practice Areas →
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <a href="/contact" class="bg-sky-600 hover:bg-sky-500 text-white text-xs font-black uppercase tracking-widest px-6 py-3 rounded-full transition-all">
                Free Case Review
            </a>
        </div>

        <div class="lg:hidden text-white">
             <button class="p-2 outline-none">
                 <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                 </svg>
             </button>
        </div>
    </div>
</nav>

<div id="page" class="site">

	<div id="content" class="site-content">
