<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Meanpug_Test
 */

get_header();
?>

<main id="primary" class="site-main container mx-auto">

    <header class="bg-white py-4 ">

        <div class="container mx-auto ">
            <div class="flex items-center justify-between">

                <div class="w-7/12">
                    <a href="#" class="block">
                        <a href="#" class="text-red-500 text-3xl font-bold font-sans">pugbnpug</a>
                    </a>
                </div>

                <nav class="w-5/12 flex justify-end items-center space-x-6">
                    <a href="#" class="text-gray-600 hover:text-gray-800 text-sm">Host your home</a>
                    <a href="#" class="text-gray-600 hover:text-gray-800 text-sm">Host an experience</a>

                    <a href="#" class="flex items-center space-x-2 rounded-full py-2 px-4 hover:shadow-md shadow">
                        <span class="text-sm text-gray-800 mr-auto">Pug Pugerson</span>
                        <div class="relative">
                            <div class="h-6 w-6 rounded-full flex items-center justify-center">
                                <img src="/wp-content/uploads/2024/11/pug.png" alt="User Icon" class="h-full w-full rounded-full">
                            </div>
                            <span class="absolute top-0 right-0 block h-3 w-3 bg-red-600 rounded-full border-2 border-white"></span>
                        </div>
                    </a>

                </nav>
            </div>
        </div>

    </header>


    <div class="bg-white">
        <div class="container mx-auto py-2">
            <nav class="flex space-x-4">
                <a href="#" class="text-gray-800 hover:underline hover:underline-black hover:underline-offset-2">Places to stay</a>
                <a href="#" class="text-gray-800 hover:underline hover:underline-black hover:underline-offset-2">Monthly stays</a>
                <a href="#" class="text-gray-800 hover:underline hover:underline-black hover:underline-offset-2">Experiences</a>
                <a href="#" class="text-gray-800 hover:underline hover:underline-black hover:underline-offset-2">Online Experiences</a>

                <span class="ml-2 bg-black text-white text-xs font-semibold rounded-lg px-2 py-0.5">NEW</span>

                </a>
            </nav>
        </div>
    </div>


    <div class="master-search bg-white flex items-center rounded-lg shadow-md my-7 py-2 px-3">

        <div class="flex-1 p-1 ">
            <label for="location" class="block ml-1 text-xs font-medium text-gray-700 uppercase font-bold">Location</label>

            <input type="text" id="location" placeholder="Where are you going?" class="mt-0 block w-full bg-transparent text-gray-900 placeholder-gray-400 focus:ring-0 border-none">
        </div>

        <div class="h-10  mr-3 w-px bg-gray-300"></div>

        <div class="flex-1 p-1 ">
            <label for="location" class="block ml-1 text-xs font-medium text-gray-700 uppercase font-bold">Check in / Check out</label>

            <input type="text" id="location" placeholder="Add dates" class="mt-0 block w-full bg-transparent text-gray-900 placeholder-gray-400 focus:ring-0 border-none">
        </div>



        <div class="h-10 mr-3 w-px bg-gray-300"></div>

        <div class="flex-1 p-1 ">
            <label for="location" class="block ml-1 text-xs font-medium text-gray-700 uppercase font-bold">Guests</label>

            <input type="text" id="location" placeholder="Add guests" class="mt-0 block w-full bg-transparent text-gray-900 placeholder-gray-400 focus:ring-0 border-none">
        </div>

        <div class="pl-10">
            <button type="submit" class="flex items-center justify-center text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-md text-sm px-5 py-2.5 text-center">
                <i class="fas fa-search mr-2"></i>
                Search
            </button>


        </div>
    </div>

    <div class="bg-black text-white text-left rounded-lg px-10 py-20">
        <div class="container mr-auto max-w-xs pl-4 pt-20">

            <h2 class="text-3xl font-bold">We stand with #BlackLivesMatter</h2>
            <p class="mt-4">Now more than ever, it’s important that you know how we’re fighting discrimination on Airbnb. We’d like to share our newest initiative with you, Project Lighthouse.</p>

            <a href="#" class="mt-4 inline-block text-white font-bold py-2 no-underline flex items-center hover:text-white hover:underline">
                Learn more <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 01-1.414-1.414L9.586 10 5.879 6.293a1 1 0 111.414-1.414l4.707 4.707a1 1 0 010 1.414l-4.707 4.707a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>



</main><!-- #main -->