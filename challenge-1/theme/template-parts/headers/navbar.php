<div class="flex items-center justify-between h-20">

    <div class="flex-1">
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/airbnblogo.webp" alt="Airbnb"
                class="h-8 w-auto">
        </a>
    </div>


    <div class="flex-1 flex items-center justify-end space-x-1 md:space-x-2">

        <button class="flex items-center space-x-1 p-2 rounded-full hover:bg-gray-100 transition-colors text-gray-800">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/globe.svg" alt="Idioma" class="h-4 w-4">
            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                </path>
            </svg>
        </button>

        <a href="#"
            class="hidden xl:block text-sm font-semibold text-gray-800 hover:bg-gray-100 py-2 px-3 rounded-full transition-colors">Host
            your home</a>
        <a href="#"
            class="hidden xl:block text-sm font-semibold text-gray-800 hover:bg-gray-100 py-2 px-3 rounded-full transition-colors">Host
            an experience</a>
        <a href="#"
            class="text-sm font-semibold text-gray-800 hover:bg-gray-100 py-2 px-3 rounded-full transition-colors">Help</a>

        <div
            class="flex items-center border border-gray-300 rounded-full py-1 pl-4 pr-1 ml-2 space-x-3 hover:shadow-md transition-shadow cursor-pointer bg-white">
            <span class="text-sm font-semibold text-gray-800">Hey, Pug!</span>

            <div class="relative">
                <div
                    class="h-8 w-8 bg-gray-200 rounded-full flex items-center justify-center text-white overflow-hidden">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/meanpub.webp"
                       alt="MeanPug Avatar"
                        class="h-full w-full object-cover">
                </div>

                <span
                    class="absolute -top-1 -right-1 bg-[#FF385C] text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full border-2 border-white font-bold leading-none">2</span>
            </div>
        </div>

    </div>
</div>