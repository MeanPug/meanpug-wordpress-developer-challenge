/**
 * Mobile menu toggle functionality.
 * Opens/closes the full-screen mobile navigation with focus trap support.
 */
document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('mobile-menu-toggle');
    const closeBtn = document.getElementById('mobile-menu-close');
    const menu = document.getElementById('mobile-menu');
    const openIcon = document.getElementById('menu-icon-open');
    const closeIcon = document.getElementById('menu-icon-close');

    if (!toggle || !closeBtn || !menu) {
        console.warn('Mobile menu elements not found: toggle, closeBtn, or menu element is missing');
        return;
    }

    // Get all focusable elements within the menu for focus trap
    function getFocusableElements() {
        return menu.querySelectorAll(
            'a, button, [href], [tabindex]:not([tabindex="-1"])'
        );
    }

    function openMenu() {
        menu.classList.remove('translate-x-full');
        toggle.setAttribute('aria-expanded', 'true');
        openIcon.classList.add('hidden');
        closeIcon.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

        // Set focus to first focusable element in menu
        setTimeout(() => {
            const focusableElements = getFocusableElements();
            if (focusableElements.length > 0) {
                focusableElements[0].focus();
            }
        }, 100);
    }

    function closeMenu() {
        menu.classList.add('translate-x-full');
        toggle.setAttribute('aria-expanded', 'false');
        openIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');

        // Return focus to toggle button
        toggle.focus();
    }

    // Focus trap: prevent tabbing outside the menu when open
    function handleTabKey(e) {
        if (menu.classList.contains('translate-x-full')) return; // Menu is closed

        const focusableElements = getFocusableElements();
        if (focusableElements.length === 0) return;

        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];

        if (e.shiftKey) {
            // Shift + Tab
            if (document.activeElement === firstElement) {
                e.preventDefault();
                lastElement.focus();
            }
        } else {
            // Tab
            if (document.activeElement === lastElement) {
                e.preventDefault();
                firstElement.focus();
            }
        }
    }

    toggle.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', closeMenu);

    // Close on ESC key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !menu.classList.contains('translate-x-full')) {
            closeMenu();
        }
        // Handle focus trap
        if (e.key === 'Tab') {
            handleTabKey(e);
        }
    });

    // Apply Tailwind classes to mobile menu links
    const mobileLinks = document.querySelectorAll('#mobile-menu .menu-item a');
    mobileLinks.forEach(function (link) {
        link.classList.add('block', 'text-lg', 'font-medium', 'text-gray-900', 'hover:text-airbnb-pink', 'transition-colors', 'py-1');
    });
});