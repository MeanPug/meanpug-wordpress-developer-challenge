<?php

$location = $args['location'] ?? 'Unknown Location';
$title      = $args['title']    ?? 'Property Title';
$image    = $args['image'] ?? 'placeholder.webp';
$host       = $args['host']     ?? 'Contact for details';
$dates      = $args['dates']    ?? 'Dates unavailable';
$is_new   = $args['is_new'] ?? false;
$price      = $args['price']    ?? '0';
$rating   = $args['rating'] ?? 'New';

$image_url = get_template_directory_uri() . '/assets/img/' . $image;
?>

<article class="flex flex-col group cursor-pointer">
    <div class="relative aspect-[4/3] w-full overflow-hidden rounded-xl mb-3">
        <img src="<?php echo esc_url($image_url); ?>" 
             alt="<?php echo esc_attr($args['title']); ?>" 
             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

        <?php if ( $is_new ) : ?>
            <div class="absolute top-3 left-3 bg-white px-2  rounded shadow-sm text-[10px] font-extrabold uppercase tracking-wider text-gray-900 z-10">
                New
            </div>
        <?php endif; ?>

        <button class="absolute top-3 right-3 text-white hover:scale-110 transition-transform z-10" aria-label="Add to favorites">
            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-black/40 stroke-white stroke-[2px]">
                <path d="m16 28c7-4.733 14-10 14-17 0-1.792-.683-3.583-2.05-4.95-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05l-2.051 2.051-2.05-2.051c-1.367-1.366-3.158-2.05-4.95-2.05-1.791 0-3.583.684-4.949 2.05-1.367 1.367-2.051 3.158-2.051 4.95 0 7 7 12.267 14 17z"></path>
            </svg>
        </button>
    </div>

    <div class="flex justify-between items-start">
        <div class="pr-4">
            <h3 class="font-semibold text-gray-900 text-base truncate"><?php echo esc_html($location); ?></h3>
            <p class="text-gray-500 text-sm mt-0.5 truncate" title="<?php echo esc_attr($args['title']); ?>"><?php echo esc_html($args['host']); ?></p>
            <p class="text-gray-500 text-sm"><?php echo esc_html($args['dates']); ?></p>
            
            <div class="mt-1.5 flex items-baseline gap-1">
                <span class="font-semibold text-gray-900">$<?php echo esc_html($args['price']); ?></span>
                <span class="text-gray-900 text-sm">night</span>
            </div>
        </div>
        
        <div class="flex items-center gap-1 text-sm font-light mt-0.5">
            <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-current"><path d="M15.094 1.579l-4.124 8.885-9.86 1.27a1 1 0 0 0-.542 1.736l7.293 6.565-1.965 9.852a1 1 0 0 0 1.483 1.061L16 25.951l8.625 4.997a1 1 0 0 0 1.482-1.06l-1.965-9.853 7.293-6.565a1 1 0 0 0-.541-1.735l-9.86-1.271-4.127-8.885a1 1 0 0 0-1.814 0z" fill-rule="evenodd"></path></svg>
            <span><?php echo esc_html($rating); ?></span>
        </div>
    </div>
</article>