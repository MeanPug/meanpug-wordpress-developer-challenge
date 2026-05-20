/**
 * AirPnP language-pill dropdown behavior.
 *
 * Mirrors airpnp-user-pill.js: toggles menu visibility, flips `aria-expanded`,
 * closes on outside click or Escape, restores focus to trigger on Escape (a11y).
 */

function initLangPill() {
    const trigger = document.getElementById('airpnp-lang-toggle');
    const menu = document.getElementById('airpnp-lang-menu');
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

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !menu.hidden) {
            close();
            trigger.focus();
        }
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initLangPill);
} else {
    initLangPill();
}
