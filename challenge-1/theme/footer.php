<?php
/**
 * The template for displaying the footer
 *
 * @package infra
 */
?>
    </div><footer class="bg-[#F7F7F7] border-t border-gray-200 mt-12 font-sans">
        
        <div class="container mx-auto px-4 md:px-8 py-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-sm">
                
                <div>
                    <h4 class="font-semibold text-gray-900 mb-4">Support</h4>
                    <ul class="space-y-3 text-gray-600">
                        <li><a href="#" class="hover:underline">Help Center</a></li>
                        <li><a href="#" class="hover:underline">Safety information</a></li>
                        <li><a href="#" class="hover:underline">Cancellation options</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold text-gray-900 mb-4">Hosting</h4>
                    <ul class="space-y-3 text-gray-600">
                        <li><a href="#" class="hover:underline">Try hosting</a></li>
                        <li><a href="#" class="hover:underline">AirCover for Hosts</a></li>
                        <li><a href="#" class="hover:underline">Explore hosting resources</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold text-gray-900 mb-4">Airbnb</h4>
                    <ul class="space-y-3 text-gray-600">
                        <li><a href="#" class="hover:underline">Newsroom</a></li>
                        <li><a href="#" class="hover:underline">Learn about new features</a></li>
                        <li><a href="#" class="hover:underline">Careers</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200">
            <div class="container mx-auto px-4 md:px-8 py-6 flex flex-col md:flex-row items-center justify-between gap-4">
                
                <div class="flex flex-wrap items-center gap-2 text-sm text-gray-600">
                    <span>© <?php echo date('Y'); ?> Airbnb Clone Challenge.</span>
                    <span class="hidden md:inline">·</span>
                    <a href="#" class="hover:underline">Privacy</a>
                    <span class="hidden md:inline">·</span>
                    <a href="#" class="hover:underline">Terms</a>
                    <span class="hidden md:inline">·</span>
                    <a href="#" class="hover:underline">Sitemap</a>
                </div>

                <div class="flex flex-wrap items-center gap-6">
                    
                    <div class="flex items-center gap-3 pl-4 md:pl-6 border-l border-gray-300">
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Challenge by</span>
                        <a href="https://meanpug.com" target="_blank" rel="noopener noreferrer">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/meanpub.webp'); ?>" 
                                 alt="MeanPug" 
                                 class="h-6 w-auto grayscale opacity-70 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>

</body>
</html>