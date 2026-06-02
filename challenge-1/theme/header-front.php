<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-white text-neutral-800 antialiased'); ?>>

<!-- COVID-19 Announcement Banner -->
<div class="bg-[#F7F7F7] border-b border-gray-200">
    <div class="container mx-auto px-6 py-3.5 text-center text-sm font-medium text-neutral-800">
        Get the latest on our COVID-19 response and cancellation policies. <a href="#" class="underline hover:text-black font-semibold">Learn more</a>
    </div>
</div>

<!-- Header / Navigation Bar -->
<header class="sticky top-0 bg-white z-50 border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <!-- Logo (Airbnb Coral styling + MeanPug Pug integration) -->
        <div class="flex items-center gap-2 cursor-pointer">
            <img src="https://media.prod.meanpug.net/wp-content/uploads/sites/9/2020/01/24060038/MeanPug-Best-In-Show-Icon.png" alt="MeanPug Best In Show Pug Icon" class="h-10 w-auto filter drop-shadow" style="filter: drop-shadow(0px 1px 1px rgba(0,0,0,0.1));">
            <span class="text-2xl font-extrabold tracking-tight text-[#FF385C] hidden sm:block">airpnp</span>
        </div>

        <!-- Navigation Categories (Center) -->
        <div class="hidden md:flex items-center gap-6">
            <a href="#" class="text-sm font-bold text-black border-b-2 border-black pb-2 transition">Places to stay</a>
            <a href="#" class="text-sm font-medium text-neutral-500 hover:text-black pb-2 transition">Monthly stays</a>
            <a href="#" class="text-sm font-medium text-neutral-500 hover:text-black pb-2 transition">Experiences</a>
            <div class="flex items-center gap-1 pb-2">
                <a href="#" class="text-sm font-medium text-neutral-500 hover:text-black transition">Online Experiences</a>
                <span class="bg-black text-white text-[9px] font-bold px-1.5 py-0.5 rounded uppercase tracking-wider">NEW</span>
            </div>
        </div>

        <!-- Host Controls & User Profile (Right) -->
        <div class="flex items-center gap-3">
            <a href="#" class="hidden lg:inline-block text-sm font-semibold text-neutral-800 hover:bg-gray-100 px-4 py-2.5 rounded-full transition">Host your home</a>
            <a href="#" class="hidden lg:inline-block text-sm font-semibold text-neutral-800 hover:bg-gray-100 px-4 py-2.5 rounded-full transition">Host an experience</a>
            <a href="#" class="hidden lg:inline-block text-sm font-semibold text-neutral-800 hover:bg-gray-100 px-4 py-2.5 rounded-full transition">Help</a>
            
            <!-- Language Selector -->
            <button class="text-neutral-800 hover:bg-gray-100 p-2.5 rounded-full transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9s2.015-9 4.5-9m0 0a9.015 9.015 0 015 1.52M12 3a9.015 9.015 0 00-5 1.52M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3.75M9 12.013a10.047 10.047 0 002.25 2.247m1.25-2.247a10.046 10.046 0 012.25 2.247M9.75 9.75c1.125-1.125 2.25-1.5 2.25-1.5s1.125.375 2.25 1.5M16.5 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>

            <!-- User Pill -->
            <div class="border border-gray-200 rounded-full py-1.5 pl-3 pr-1.5 flex items-center gap-3 hover:shadow-md cursor-pointer transition bg-white relative">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-neutral-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <span class="text-sm font-semibold text-neutral-800 pr-1 select-none">Bobby</span>
                <!-- Avatar with notification bubble -->
                <div class="relative">
                    <img src="https://media.prod.meanpug.net/wp-content/uploads/sites/9/2020/01/24060038/MeanPug-Best-In-Show-Icon.png" alt="Bobby the Pug Avatar" class="h-8 w-8 rounded-full border border-gray-100 bg-gray-50 object-cover">
                    <span class="absolute -top-1.5 -right-1.5 bg-[#FF385C] text-white text-[9px] font-bold h-4 w-4 rounded-full flex items-center justify-center border border-white">2</span>
                </div>
            </div>
        </div>
    </div>
</header>

<div id="page" class="site">
	<div id="content" class="site-content">