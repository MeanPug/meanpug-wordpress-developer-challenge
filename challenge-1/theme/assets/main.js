import './main.css';
import './js/lib/scrollstyle';
import './js/components/go-to-top';
import './js/components/marquee';
import './js/components/carousel';
import './js/components/plugins/toc';
import './js/components/shared/attribution';
import './js/components/shared/height-limiter';
import './js/widgets/shared/location-navigator';
/** Optional Imports Depending on Requirements
 * import './components/optional/accordion.js';
 * import './components/optional/tabs.js';
 * import './js/components/shared/tabs';
 **/


document.addEventListener('DOMContentLoaded', () => {
    const nav = document.querySelector('nav'); 
    const stickyClass = 'is-sticky'; 

    window.addEventListener('scroll', () => {
        if (window.scrollY > 0) {
            nav.classList.add(stickyClass); 
        } else {
            nav.classList.remove(stickyClass); 
        }
    });
});


document.addEventListener("DOMContentLoaded", () => {
    const toggleInput = document.getElementById("toggle-display");
    const slider = document.querySelector(".toggle-slider");
    const knob = document.querySelector(".toggle-knob");

    toggleInput.addEventListener("change", () => {
        if (toggleInput.checked) {
            slider.classList.replace("bg-gray-300", "bg-blue-500");
            knob.classList.add("translate-x-4");
        } else {
            slider.classList.replace("bg-blue-500", "bg-gray-300");
            knob.classList.remove("translate-x-4");
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const viewAllBtn = document.querySelector(".view-all-btn");
    const categoriesContainer = document.querySelector(".categories-container");

    viewAllBtn.addEventListener("click", () => {
        categoriesContainer.scrollBy({
            left: 300, // Adjust scroll amount
            behavior: "smooth",
        });
    });
});

