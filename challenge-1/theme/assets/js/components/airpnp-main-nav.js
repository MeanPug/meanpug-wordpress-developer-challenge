/**
 * AirPnP mobile main-nav dropdown behavior.
 *
 * Mirrors the user-pill and lang-pill pattern: the toggle button is only
 * visible below md, and clicking it toggles the `hidden` attribute on the
 * host-nav UL. On desktop the UL is forced visible via a CSS override on
 * `.airpnp-host-nav[hidden]`, so this script effectively no-ops at md+.
 */

function initMainNav() {
    const trigger = document.getElementById('airpnp-main-nav-toggle');
    const menu = document.getElementById('airpnp-main-nav-menu');
    if (!trigger || !menu) return;

    function close() {
        if (menu.hidden) return;
        menu.hidden = true;
        trigger.setAttribute('aria-expanded', 'false');
    }

    function open() {
        menu.hidden = false;
        trigger.setAttribute('aria-expanded', 'true');
    }

    trigger.addEventListener('click', (e) => {
        e.stopPropagation();
        if (menu.hidden) {
            open();
        } else {
            close();
        }
    });

    document.addEventListener('click', (e) => {
        if (menu.hidden) return;
        if (!menu.contains(e.target) && e.target !== trigger) {
            close();
        }
    });

    menu.addEventListener('click', (e) => {
        if (e.target.closest('a')) {
            close();
        }
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !menu.hidden) {
            close();
            trigger.focus();
        }
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMainNav);
} else {
    initMainNav();
}
