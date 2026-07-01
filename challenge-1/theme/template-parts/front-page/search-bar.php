<?php
/**
 * Template part: Front Page Search Bar
 *
 * Pill-shaped search bar, static presentation only (functionality out of scope).
 * Styled entirely with Tailwind utility classes.
 *
 * @package infra
 */
?>
<div class="flex items-stretch w-full max-w-3xl bg-white border border-gray-200 rounded-full shadow-[0_3px_12px_rgb(0,0,0,0.08)] hover:shadow-[0_3px_16px_rgb(0,0,0,0.12)] transition-shadow overflow-hidden">

    <!-- Where -->
    <div class="flex flex-col justify-center px-6 py-2.5 flex-1 min-w-0 hover:bg-gray-50 transition-colors cursor-not-allowed group">
        <label for="search-where" class="text-[9px] uppercase font-black tracking-wider text-[#222222] whitespace-nowrap cursor-not-allowed select-none">
            <?php esc_html_e( 'Where', 'inf' ); ?>
        </label>
        <input id="search-where" type="text"
               class="border-0 outline-none bg-transparent text-xs text-[#717171] placeholder-[#717171] w-full mt-0.5 p-0 cursor-not-allowed"
               placeholder="<?php esc_attr_e( 'Search destinations', 'inf' ); ?>"
               disabled aria-disabled="true">
    </div>

    <!-- Divider -->
    <div class="w-px bg-gray-200 my-3 flex-shrink-0" aria-hidden="true"></div>

    <!-- When -->
    <div class="flex flex-col justify-center px-6 py-2.5 flex-1 min-w-0 hover:bg-gray-50 transition-colors cursor-not-allowed group">
        <label for="search-when" class="text-[9px] uppercase font-black tracking-wider text-[#222222] whitespace-nowrap cursor-not-allowed select-none">
            <?php esc_html_e( 'When', 'inf' ); ?>
        </label>
        <input id="search-when" type="text"
               class="border-0 outline-none bg-transparent text-xs text-[#717171] placeholder-[#717171] w-full mt-0.5 p-0 cursor-not-allowed"
               placeholder="<?php esc_attr_e( 'Add dates', 'inf' ); ?>"
               disabled aria-disabled="true">
    </div>

    <!-- Divider -->
    <div class="w-px bg-gray-200 my-3 flex-shrink-0" aria-hidden="true"></div>

    <!-- Who + Search Button -->
    <div class="flex items-center gap-2 px-2 py-2 flex-1 min-w-0 pl-6 hover:bg-gray-50 transition-colors cursor-not-allowed group">
        <div class="flex flex-col justify-center flex-1 min-w-0">
            <label for="search-who" class="text-[9px] uppercase font-black tracking-wider text-[#222222] whitespace-nowrap cursor-not-allowed select-none">
                <?php esc_html_e( 'Who', 'inf' ); ?>
            </label>
            <input id="search-who" type="text"
                   class="border-0 outline-none bg-transparent text-xs text-[#717171] placeholder-[#717171] w-full mt-0.5 p-0 cursor-not-allowed"
                   placeholder="<?php esc_attr_e( 'Add guests', 'inf' ); ?>"
                   disabled aria-disabled="true">
        </div>
        <button class="flex items-center justify-center bg-airbnb hover:bg-[#E61E4D] text-white border-0 rounded-full w-10 h-10 flex-shrink-0 cursor-not-allowed transition-colors"
                aria-label="<?php esc_attr_e( 'Search', 'inf' ); ?>" disabled>
            <svg viewBox="0 0 32 32" width="14" height="14" class="fill-current" aria-hidden="true" focusable="false">
                <path d="M13 0C5.82 0 0 5.82 0 13s5.82 13 13 13c3.09 0 5.93-1.08 8.16-2.87l8.36 8.36 1.41-1.41-8.34-8.34A12.94 12.94 0 0026 13C26 5.82 20.18 0 13 0zm0 2c6.07 0 11 4.93 11 11S19.07 24 13 24 2 19.07 2 13 6.93 2 13 2z"/>
            </svg>
        </button>
    </div>

</div>
