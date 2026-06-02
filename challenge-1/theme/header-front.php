<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-white text-neutral-800 antialiased'); ?>>

<!-- COVID-19 Announcement Banner -->
<div class="bg-[#F2F2F2] border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-3 text-center text-sm font-medium text-neutral-600">
        Get the latest on our COVID-19 response and cancellation policies. <a href="#" class="underline hover:text-black font-semibold">Learn more</a>
    </div>
</div>

<!-- Header / Navigation Bar -->
<header class="sticky top-0 bg-white z-50 pt-3 pb-6">
    <div class="max-w-7xl mx-auto px-6 flex flex-col gap-8">
        <!-- FIRST ROW: Logo (left) and Secondary Controls (right) -->
        <div class="flex items-center justify-between">
            <!-- Logo (Airbnb Coral styling + MeanPug Pug integration) -->
            <div class="flex items-center gap-2 cursor-pointer">
                <img src="https://media.prod.meanpug.net/wp-content/uploads/sites/9/2020/01/24060038/MeanPug-Best-In-Show-Icon.png" alt="MeanPug Best In Show Pug Icon" class="h-10 w-auto" style="filter: drop-shadow(0px 1px 1px rgba(0,0,0,0.1));">
                <span class="text-2xl font-extrabold tracking-tight text-[#FF385C]">airpnp</span>
            </div>

            <!-- Host Controls & User Profile (Right) -->
            <div class="flex items-center gap-2">
                <!-- Language Selector (World Icon + small Arrow down) -->
                <button class="text-neutral-800 hover:bg-gray-100 px-3 py-2 rounded-full transition flex items-center gap-1.5">
                    <!-- Clean minimal Globe SVG matching Airbnb -->
                    <svg class="w-4 h-4 text-neutral-800" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3a18.3 18.3 0 0 0 0 18M12 3a18.3 18.3 0 0 1 0 18M3 12h18"/>
                    </svg>
                    <!-- Small chevron down arrow (Heroicons v2) -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-2.5 h-2.5 text-neutral-800">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>

                <a href="#" class="hidden sm:inline-block text-sm font-semibold text-neutral-800 hover:bg-gray-100 px-3.5 py-2 rounded-full transition">Host your home</a>
                <a href="#" class="hidden sm:inline-block text-sm font-semibold text-neutral-800 hover:bg-gray-100 px-3.5 py-2 rounded-full transition">Host an experience</a>
                <a href="#" class="hidden sm:inline-block text-sm font-semibold text-neutral-800 hover:bg-gray-100 px-3.5 py-2 rounded-full transition">Help</a>

                <!-- User Pill Button (No burger icon, just Bobby + Avatar) -->
                <div class="border border-gray-200 rounded-full py-1.5 pl-4 pr-1.5 flex items-center gap-3 hover:shadow-md cursor-pointer transition bg-white relative ml-1">
                    <span class="text-sm font-semibold text-neutral-800 select-none">Bobby</span>
                    <!-- Avatar with notification bubble -->
                    <div class="relative">
                        <img src="https://media.prod.meanpug.net/wp-content/uploads/sites/9/2020/01/24060038/MeanPug-Best-In-Show-Icon.png" alt="Bobby the Pug Avatar" class="h-8 w-8 rounded-full border border-gray-100 bg-gray-50 object-cover">
                        <span class="absolute -top-1.5 -right-1.5 bg-[#FF385C] text-white text-[9px] font-bold h-4 w-4 rounded-full flex items-center justify-center border border-white">2</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECOND ROW: Navigation Categories (Aligned to Left) -->
        <div class="flex items-center gap-6 mt-1">
            <a href="#" class="text-sm font-normal text-black border-b-2 border-black pb-2 transition">Places to stay</a>
            <a href="#" class="text-sm font-normal text-neutral-500 hover:text-black pb-2 transition">Monthly stays</a>
            <a href="#" class="text-sm font-normal text-neutral-500 hover:text-black pb-2 transition">Experiences</a>
            <div class="flex items-center gap-1 pb-2">
                <a href="#" class="text-sm font-normal text-neutral-500 hover:text-black transition">Online Experiences</a>
                <span class="bg-black text-white text-[9px] font-bold px-1.5 py-0.5 rounded uppercase tracking-wider">NEW</span>
            </div>
        </div>
    </div>
</header>

<div id="page" class="site">
	<div id="content" class="site-content">
