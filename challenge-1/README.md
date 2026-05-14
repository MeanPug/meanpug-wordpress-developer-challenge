## Getting Started
We've tried to make it _super easy_ to get up and running on this [challenge](https://github.com/MeanPug/meanpug-wordpress-developer-challenge). Simply `cd` to the directory, and run the `docker compose up -d` to bring up a fully functional Wordpress environment at `localhost:8000`, complete with a Gulp build system and Tailwind + PostCSS CSS integration.

# About my changes during this challenge

### Architectural Refactoring
* **Decoupled Header:** Refactored `header.php` to load modular components from `template-parts/headers/`:
    * `navbar.php`: Branding and user navigation.
    * `search-expanded.php`: Responsive search interface.
    * `announcement-bar.php`: Global notifications.
* **Clean Front-Page:** Simplified `front-page.php` to orchestrate main sections: `hero-banner` and `properties-grid`.

### Data-Driven UI
* **Property Grid:** Used associative arrays to simulate a property database and drive the loop.
* **Defensive Programming:** Implemented fallbacks for all data points (price, location, rating, images) to ensure layout stability.
* **Security:** Applied standard WordPress sanitization (`esc_html`, `esc_url`, `esc_attr`) to all dynamic outputs.

### Mobile Optimization
* **Responsive Search:** Re-engineered the search component to stack vertically on mobile and expand horizontally on desktop.
* **Layout:** Utilized Tailwind breakpoints to ensure usability across all viewport sizes.