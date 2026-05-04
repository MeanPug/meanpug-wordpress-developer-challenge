/**
 * Tabs behavior: switch active tab border on click and show/hide associated content.
 */
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('[role="tablist"] [role="tab"]');

    tabs.forEach((tab, index) => {
        tab.addEventListener('click', function () {
            // Remove active class and aria-selected from all tabs
            tabs.forEach(t => {
                t.classList.remove('border-airbnb-text');
                t.classList.add('border-transparent');
                t.setAttribute('aria-selected', 'false');
            });

            // Add active class to clicked tab
            this.classList.add('border-airbnb-text');
            this.classList.remove('border-transparent');
            this.setAttribute('aria-selected', 'true');

            // Show/hide associated tab panels
            const tabPanels = document.querySelectorAll('[role="tabpanel"]');
            tabPanels.forEach((panel, panelIndex) => {
                if (panelIndex === index) {
                    panel.classList.remove('hidden');
                    panel.setAttribute('aria-hidden', 'false');
                } else {
                    panel.classList.add('hidden');
                    panel.setAttribute('aria-hidden', 'true');
                }
            });
        });
    });
});