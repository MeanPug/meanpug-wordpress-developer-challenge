/**
 * AirPnP user-pill dropdown behavior.
 *
 * Toggles the menu visibility, flips `aria-expanded`, closes on click-outside
 * or Escape, and returns focus to the trigger button on close (a11y).
 */

function initUserPill() {
    const trigger = document.getElementById('airpnp-user-pill-toggle');
    const menu = document.getElementById('airpnp-user-pill-menu');
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
        if (e.target.closest('a[role="menuitem"]')) {
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
    document.addEventListener('DOMContentLoaded', initUserPill);
} else {
    initUserPill();
}
