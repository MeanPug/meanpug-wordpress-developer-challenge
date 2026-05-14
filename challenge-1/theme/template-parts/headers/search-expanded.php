<?php
$nav_items = [
    [
        'label' => 'Places to stay',
        'url' => '#',
        'is_active' => true,
        'is_new' => false,
    ],
    [
        'label' => 'Monthly stays',
        'url' => '#',
        'is_active' => false,
        'is_new' => false,
    ],
    [
        'label' => 'Experiences',
        'url' => '#',
        'is_active' => false,
        'is_new' => false,
    ],
    [
        'label' => 'Online Experiences',
        'url' => '#',
        'is_active' => false,
        'is_new' => true,
    ],
];
?>

<div>
    <div class="hidden lg:flex items-center space-x-6">
        <?php
        foreach ($nav_items as $item):
            $base_classes = 'text-sm transition-colors';
            $state_classes = $item['is_active']
                ? 'font-semibold text-gray-900 border-b-2 border-black pb-1'
                : 'font-medium text-gray-500 hover:text-gray-900';

            $layout_classes = $item['is_new'] ? 'flex items-center gap-1' : '';
            $link_classes = trim("$base_classes $state_classes $layout_classes");
            ?>

            <a href="<?php echo esc_url($item['url']); ?>" class="<?php echo esc_attr($link_classes); ?>">
                <?php echo esc_html($item['label']); ?>

                <?php if ($item['is_new']): ?>
                    <span class="bg-gray-900 text-[10px] text-white px-1.5 rounded uppercase font-bold">New</span>
                <?php endif; ?>
            </a>

        <?php endforeach; ?>
    </div>
</div>
<section class="mt-6">
    <div
        class="bg-white border border-gray-200 shadow-md rounded-2xl flex flex-col lg:flex-row items-stretch lg:items-center relative">

        <button
            class="flex-1 text-left px-6 py-4 hover:bg-gray-100 rounded-t-2xl lg:rounded-t-none lg:rounded-l-2xl transition-colors">
            <div class="text-[10px] font-extrabold uppercase tracking-wide text-gray-800">Location</div>
            <div class="text-sm text-gray-400 mt-0.5 truncate">Where are you going?</div>
        </button>

        <div class="h-[1px] w-full lg:w-[1px] lg:h-10 bg-gray-200"></div>

        <button class="flex-1 text-left px-6 py-4 hover:bg-gray-100 transition-colors">
            <div class="text-[10px] font-extrabold uppercase tracking-wide text-gray-800">Check in / Check out</div>
            <div class="text-sm text-gray-400 mt-0.5 truncate">Add dates</div>
        </button>

        <div class="h-[1px] w-full lg:w-[1px] lg:h-10 bg-gray-200"></div>

        <button class="flex-1 text-left px-6 py-4 hover:bg-gray-100 transition-colors">
            <div class="text-[10px] font-extrabold uppercase tracking-wide text-gray-800">Guest</div>
            <div class="text-sm text-gray-400 mt-0.5 truncate">Add guests</div>
        </button>

        <div
            class="flex items-center justify-center lg:justify-end px-4 py-4 lg:py-2 lg:pl-6 lg:pr-2 rounded-b-2xl lg:rounded-b-none lg:rounded-r-2xl transition-colors cursor-pointer">

            <button aria-label="Search properties"
                class="bg-[#E31C5F] text-white px-6 py-3 rounded-xl flex items-center justify-center w-full lg:w-auto space-x-2 font-semibold transition-colors">
                <svg class="h-4 w-4 stroke-current stroke-[3px]" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <span>Search</span>
            </button>
        </div>

    </div>
</section>