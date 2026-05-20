/**
 * AirPnP nav-tabs active-state behavior.
 *
 * Tabs are decorative (no real filtering since the listings grid below the
 * fold lives outside this challenge's scope), so this just toggles the
 * underline indicator on click. No URL change, no page reload.
 */

function initNavTabs() {
    const tabs = document.querySelectorAll('[data-airpnp-tab]');
    if (tabs.length === 0) return;

    tabs.forEach((tab) => {
        tab.addEventListener('click', (e) => {
            e.preventDefault();
            tabs.forEach((t) => {
                t.classList.remove('airpnp-nav-tab--active', 'border-b-2', 'border-black');
                t.classList.add('text-stone-600', 'hover:text-black');
            });
            tab.classList.add('airpnp-nav-tab--active', 'border-b-2', 'border-black');
            tab.classList.remove('text-stone-600', 'hover:text-black');
        });
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initNavTabs);
} else {
    initNavTabs();
}
