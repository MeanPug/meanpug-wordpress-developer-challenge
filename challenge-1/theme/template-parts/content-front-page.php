<article id="post-<?php the_ID(); ?>" <?php post_class('pb-12'); ?>>

    <!-- FLOATING SEARCH BAR CONTAINER -->
    <div class="container mx-auto px-6 max-w-7xl mt-0 pb-2 relative z-10">
        <!-- Mobile Compact Search Bar -->
        <div class="md:hidden bg-white rounded-full border border-gray-200 shadow-md p-3 flex items-center justify-between cursor-pointer w-full hover:shadow-lg transition">
            <div class="flex items-center gap-3 pl-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4 text-[#FF385C]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.602 10.602z" />
                </svg>
                <div class="text-left">
                    <span class="block text-xs font-bold text-neutral-800">Where are you going?</span>
                    <span class="block text-[10px] text-neutral-400">Anywhere • Any week • Add guests</span>
                </div>
            </div>
            <button class="border border-gray-200 rounded-full p-2 hover:bg-gray-50 text-neutral-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                </svg>
            </button>
        </div>

        <!-- Desktop Full Search Bar (Expanded to max-w-7xl, straight vertical separators) -->
        <div class="hidden md:flex bg-white rounded-2xl border border-gray-200 shadow-md hover:shadow-lg transition duration-300 items-center p-2.5 w-full">
            <!-- LOCATION -->
            <div class="flex-1 px-6 cursor-pointer py-1 hover:bg-gray-50 rounded-xl transition">
                <span class="block text-[10px] font-extrabold tracking-wider text-black">LOCATION</span>
                <input type="text" placeholder="Where are you going?" class="block w-full text-sm text-neutral-800 placeholder-neutral-400 bg-transparent focus:outline-none mt-0.5" readonly>
            </div>

            <!-- Straight Vertical Divider -->
            <div class="h-8 w-px bg-gray-200 self-center"></div>

            <!-- CHECK IN / CHECK OUT -->
            <div class="flex-1 px-6 cursor-pointer py-1 hover:bg-gray-50 rounded-xl transition">
                <span class="block text-[10px] font-extrabold tracking-wider text-black">CHECK IN / CHECK OUT</span>
                <span class="block text-sm text-neutral-400 mt-0.5">Add dates</span>
            </div>

            <!-- Straight Vertical Divider -->
            <div class="h-8 w-px bg-gray-200 self-center"></div>

            <!-- GUESTS -->
            <div class="flex-1 px-6 cursor-pointer py-1 hover:bg-gray-50 rounded-xl transition">
                <span class="block text-[10px] font-extrabold tracking-wider text-black">GUESTS</span>
                <span class="block text-sm text-neutral-400 mt-0.5">Add guests</span>
            </div>

            <!-- SEARCH BUTTON -->
            <button class="bg-[#DE1E4F] hover:bg-[#C1143F] text-white px-6 py-3.5 rounded-xl font-bold text-sm flex items-center gap-2 shadow transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.602 10.602z" />
                </svg>
                Search
            </button>
        </div>
    </div>

    <!-- CAMPAIGN HERO BANNER CARD -->
    <div class="container mx-auto px-6 max-w-7xl mt-12">
        <div class="relative bg-black rounded-[24px] overflow-hidden min-h-[380px] flex items-center shadow-md">
            <!-- Subtle overlay for text readability -->
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-black/10 z-10"></div>
            <div class="absolute inset-0 bg-neutral-900 object-cover w-full h-full"></div>

            <!-- Content Area -->
            <div class="relative z-20 px-8 py-10 md:px-16 max-w-md text-left">
                <h1 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight leading-[1.1]">
                    We stand with<br>#BlackLivesMatter
                </h1>
                <p class="text-white text-base md:text-lg opacity-90 leading-relaxed mt-4 font-normal text-left">
                    Now more than ever, it's important that you know how we're fighting discrimination on Airbnb. We'd like to share our newest initiative with you, Project Lighthouse.
                </p>
                <a href="#" class="mt-6 inline-flex items-center gap-1.5 bg-transparent text-white font-bold text-sm hover:underline transition group">
                    Learn more
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3.5 h-3.5 transform transition-transform group-hover:translate-x-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- GRID PROMOTIONAL CATEGORIES SECTION -->
    <div class="container mx-auto px-6 max-w-7xl mt-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1: Hammock -->
            <div class="relative rounded-2xl overflow-hidden aspect-[4/3] shadow hover:shadow-md transition duration-300 cursor-pointer group">
                <img src="https://images.unsplash.com/photo-1510312305653-8ed496efae75?auto=format&fit=crop&q=80&w=600" alt="Outdoor hammock retreat" class="object-cover w-full h-full transform transition duration-500 group-hover:scale-105">
                <!-- NEW Badge -->
                <span class="absolute top-4 left-4 bg-white text-black text-[10px] uppercase font-extrabold px-2.5 py-1 rounded shadow-sm z-10 tracking-wider">NEW</span>
            </div>

            <!-- Card 2: Tablet Call -->
            <div class="relative rounded-2xl overflow-hidden aspect-[4/3] shadow hover:shadow-md transition duration-300 cursor-pointer group">
                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=600" alt="Online experiences tablet" class="object-cover w-full h-full transform transition duration-500 group-hover:scale-105">
            </div>

            <!-- Card 3: Cabin -->
            <div class="relative rounded-2xl overflow-hidden aspect-[4/3] shadow hover:shadow-md transition duration-300 cursor-pointer group">
                <img src="https://images.unsplash.com/photo-1542718610-a1d656d1884c?auto=format&fit=crop&q=80&w=600" alt="Beautiful cabin escape" class="object-cover w-full h-full transform transition duration-500 group-hover:scale-105">
            </div>
        </div>
    </div>

</article>
