/**
 * AirPnP search-form behavior.
 *
 * Uses Flatpickr in range mode to pick check-in / check-out in one input;
 * mirrors the selected range into hidden `checkin` and `checkout` fields so
 * the submitted form payload is unchanged. On submit, runs native validation
 * and shows a screen-reader-friendly toast.
 *
 * i18n strings are injected by `wp_localize_script` as `window.AIRPNP_I18N`.
 */

import flatpickr from 'flatpickr';

function showToast(message) {
    const existing = document.querySelector('.airpnp-toast');
    if (existing) {
        existing.remove();
    }
    const toast = document.createElement('div');
    toast.className = 'airpnp-toast fixed bottom-6 right-6 bg-black text-white px-4 py-3 rounded-lg shadow-lg z-50 max-w-xs';
    toast.setAttribute('role', 'status');
    toast.setAttribute('aria-live', 'polite');
    toast.textContent = message;
    document.body.appendChild(toast);
    setTimeout(() => {
        toast.classList.add('opacity-0');
        toast.style.transition = 'opacity 200ms';
        toast.addEventListener('transitionend', () => toast.remove(), { once: true });
    }, 3000);
}

function initSearch() {
    const form = document.getElementById('airpnp-search-form');
    if (!form) return;

    const dateInput = form.querySelector('#airpnp-search-dates');
    const checkinHidden = form.querySelector('#airpnp-search-checkin');
    const checkoutHidden = form.querySelector('#airpnp-search-checkout');
    const i18n = window.AIRPNP_I18N || {};

    if (dateInput && checkinHidden && checkoutHidden) {
        flatpickr(dateInput, {
            mode: 'range',
            minDate: 'today',
            dateFormat: 'Y-m-d',
            onChange: (dates) => {
                checkinHidden.value = dates[0] ? flatpickr.formatDate(dates[0], 'Y-m-d') : '';
                checkoutHidden.value = dates[1] ? flatpickr.formatDate(dates[1], 'Y-m-d') : '';
                if (dates.length === 2) {
                    dateInput.setCustomValidity('');
                } else {
                    dateInput.setCustomValidity(i18n.invalidDates || 'Please pick check-in and check-out dates.');
                }
            },
        });
    }

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        if (!form.reportValidity()) return;
        showToast(i18n.searchComingSoon || 'Search coming soon 🐶');
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSearch);
} else {
    initSearch();
}
