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

<nav class="sticky bg-green inf-site-header z-20 mx-auto container-fluid top-0">
    <div class="container-fluid flex items-center justify-between pt-8 pb-6 columns-3">
        <div class="w-48 lg:w-96">
            <?php echo get_custom_logo() ?>
        </div>

        <!-- Desktop Nav -->
        <div class="pl-12 items-center justify-end hidden lg:flex">
            <div class="flex space-x-4 nav-links-styling">
                <?php wp_nav_menu(array(
                    'theme_location' => 'nav',
                    'menu_class' => 'inf-menu inf-menu--nav',
                )); ?>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" aria-hidden="true" role="presentation" focusable="false" style="display: block; height: 16px; width: 16px; fill: currentcolor;"><path d="M8 .25a7.77 7.77 0 0 1 7.75 7.78 7.75 7.75 0 0 1-7.52 7.72h-.25A7.75 7.75 0 0 1 .25 8.24v-.25A7.75 7.75 0 0 1 8 .25zm1.95 8.5h-3.9c.15 2.9 1.17 5.34 1.88 5.5H8c.68 0 1.72-2.37 1.93-5.23zm4.26 0h-2.76c-.09 1.96-.53 3.78-1.18 5.08A6.26 6.26 0 0 0 14.17 9zm-9.67 0H1.8a6.26 6.26 0 0 0 3.94 5.08 12.59 12.59 0 0 1-1.16-4.7l-.03-.38zm1.2-6.58-.12.05a6.26 6.26 0 0 0-3.83 5.03h2.75c.09-1.83.48-3.54 1.06-4.81zm2.25-.42c-.7 0-1.78 2.51-1.94 5.5h3.9c-.15-2.9-1.18-5.34-1.89-5.5h-.07zm2.28.43.03.05a12.95 12.95 0 0 1 1.15 5.02h2.75a6.28 6.28 0 0 0-3.93-5.07z"></path></svg>
            </div>

            
        </div>


    </div>
    <div class="container-fluid">
        <?php
        $categories = get_terms(array(
            'taxonomy'   => 'category', // Taxonomy name
            'hide_empty' => false,      // Include empty categories
            'object_type' => array('listing'), // Ensure it's tied to the 'listing' CPT
            'exclude'    => 1, // Exclude the 'Uncategorized' category (ID: 1 by default)
        ));
        ?>
        <div class="filter-navigation-form relative">
    <!-- Full Form for Larger Screens -->
    <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="filter-form hidden md:flex">
        <div class="filter-bar flex items-center rounded-full shadow-lg p-4 bg-white">
            <!-- Where Field -->
            <div class="filter-item flex-grow">
                <label for="destination" class="block text-sm font-medium text-gray-700">Where</label>
                <input type="text" id="destination" name="s" placeholder="Search destinations" class="border-none focus:ring-0 w-full bg-transparent">
            </div>

            <!-- Check-in Field -->
            <div class="filter-item flex-grow border-l pl-4">
                <label for="checkin" class="block text-sm font-medium text-gray-700">Check-in</label>
                <input type="date" id="checkin" name="checkin" class="border-none focus:ring-0 w-full bg-transparent">
            </div>

            <!-- Check-out Field -->
            <div class="filter-item flex-grow border-l pl-4">
                <label for="checkout" class="block text-sm font-medium text-gray-700">Check-out</label>
                <input type="date" id="checkout" name="checkout" class="border-none focus:ring-0 w-full bg-transparent">
            </div>

            <!-- Who Field -->
            <div class="filter-item flex-grow border-l pl-4">
                <label for="guests" class="block text-sm font-medium text-gray-700">Who</label>
                <input type="number" id="guests" name="guests" min="1" placeholder="Add guests" class="border-none focus:ring-0 w-full bg-transparent">
            </div>

            <!-- Search Button -->
            <button type="submit" class="ml-4 p-3 rounded-full text-white  hover:bg-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.39 4.39l4.24 4.24a1 1 0 01-1.42 1.42l-4.24-4.24A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </form>

    <!-- Search Button for Smaller Screens -->
    <button id="search-toggle"class="block md:hidden  hover:bg-blue-600 text-white px-6 py-3 rounded-full shadow-lg flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.39 4.39l4.24 4.24a1 1 0 01-1.42 1.42l-4.24-4.24A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
        <span>Search</span>
    </button>
</div>

<div class="categories-container flex justify-between items-center overflow-x-auto py-4 max-w-full space-x-4">
    <?php 
        $limited_categories = array_slice($categories, 0, 11); 
        foreach ($limited_categories as $category): 
        $image_url = z_taxonomy_image_url($category->term_id); 
    ?>
        <div class="category-item flex flex-col items-center text-center">
            <a href="<?php echo esc_url(get_term_link($category)); ?>" class="block">
                <?php if ($image_url): ?>
                    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>" class="object-contain w-10 h-10">
                <?php else: ?>
                    <div class="w-10 h-10 bg-gray-200 flex items-center justify-center rounded-full">
                        <span class="text-gray-600"><?php echo esc_html($category->name[0]); ?></span>
                    </div>
                <?php endif; ?>
            </a>
            <p class="text-xs mt-2 font-light"><?php echo esc_html($category->name); ?></p>
        </div>
    <?php endforeach; ?>

    <!-- Add a "View All" button to scroll or expand -->
    <button class="view-all-btn flex items-center space-x-2 px-4 py-2 bg-gray-100 shadow hover:bg-gray-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4l8 8-8 8" />
        </svg>
    </button>

    <!-- Filter Button -->
    <button class="flex items-center space-x-2 px-4 py-2 bg-gray-100 shadow hover:bg-gray-200">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" style="display:block;fill:none;height:16px;width:16px;stroke:currentColor;stroke-width:3;overflow:visible" aria-hidden="true" role="presentation" focusable="false">
                <path fill="none" d="M7 16H3m26 0H15M29 6h-4m-8 0H3m26 20h-4M7 16a4 4 0 1 0 8 0 4 4 0 0 0-8 0zM17 6a4 4 0 1 0 8 0 4 4 0 0 0-8 0zm0 20a4 4 0 1 0 8 0 4 4 0 0 0-8 0zm0 0H3"></path>
            </svg>
        </span>
        <span class="text-xs font-medium">Filters</span>
    </button>

    <div class="toggle-wrapper flex items-center gap-2 px-4 py-2 bg-gray-100 shadow-md rounded-full border border-gray-300 hover:bg-gray-200">
        <label for="toggle-display" class="toggle-label text-xs font-medium text-gray-700">
            Display total before taxes
        </label>
        <label class="toggle-switch relative inline-block w-10 h-6">
            <input id="toggle-display" type="checkbox" class="toggle-input hidden">
            <span class="toggle-slider absolute top-0 left-0 w-full h-full bg-gray-300 rounded-full transition duration-300 cursor-pointer"></span>
            <span class="toggle-knob absolute top-[3px] left-[3px] h-4 w-4 bg-white rounded-full shadow transition-transform duration-300 transform"></span>
        </label>
    </div>


</div>
    </div>
</nav>

<div id="page" class="site">

	<div id="content" class="site-content">

