## Getting Started
We've tried to make it _super easy_ to get up and running on this [challenge](https://github.com/MeanPug/meanpug-wordpress-developer-challenge). Simply `cd` to the directory, and run the `docker compose up -d` to bring up a fully functional Wordpress environment at `localhost:8000`, complete with a Gulp build system and Tailwind + PostCSS CSS integration.

# MeanPug WordPress Developer Challenge – Challenge 1

**Author:** Gabriel Pacheco 
**Repository:** (https://github.com/gabrielgpacheco/)

---

## 📋 Challenge Description

This project implements **Challenge 1** proposed by MeanPug, following the instructions in the original repository. The goal was to create a front page in the Airbnb style, using the base `infra` theme and making all content dynamically manageable through WordPress, without relying on hardcoded values.

The entire environment was set up with **Docker**, ensuring reproducibility and professionalism.

---

🎨 Implemented Features
All sections of the front page were created fully dynamically, using the Advanced Custom Fields (ACF) free version, without relying on repeater fields or options pages (unavailable in the free version). The fields are registered directly in the WordPress dashboard or via PHP code.

1. Header
File: theme/header.php

COVID Banner: text and link managed via ACF (fields: banner_text, banner_link, banner_link_text).

Main menu: uses the native WordPress menu in the nav location, registered in inc/menus/all.php. Links receive Tailwind classes (pill style) via a filter in functions.php.

Logo: uses the WordPress Custom Logo (supported by the theme). Fallback to SVG/text “airpug” if not defined.

Language selector (PT‑BR / EN / ESP): dropdown with CSS (hover) and dynamic change via ?lang= parameter in the URL, preserving other query parameters.

User data: if logged in, shows the WordPress user's name and avatar; otherwise, shows “Puggy” and a default image located in the theme.

Notification count: ACF number field (notification_count) with a visual badge.

Responsive: hamburger menu (mobile-menu) that occupies the entire screen on tablets/phones, controlled by a JavaScript script (mobile-menu.js).

2. Search Section
Located in front-page.php

Tabs: managed via up to 5 text fields (tab_1_label … tab_5_label) and true/false fields to show a “NEW” badge. The first tab appears active by default. Border switching behavior implemented with JavaScript (tabs.js).

Form labels and placeholders: location_label, dates_label, guests_label and their respective placeholders come from ACF.

Search button: dynamic text and magnifying glass icon.

Styling: Tailwind CSS with custom colors (airbnb-pink, airbnb-soft, etc.) defined in tailwind.config.js.

3. Hero Section
Inserted in front-page.php

ACF fields: hero_title (supports basic HTML for line breaks), hero_description, hero_button_text, hero_button_url, hero_background_image (image upload).

Gradient overlay applied via inline CSS.

Responsive and with fallbacks for empty fields.

4. Featured Destinations
Grid with 3 cards.

ACF fields: featured_title (section title), dest_1_name, dest_1_image, dest_2_name, … up to dest_3_image.

Only displays destinations whose name has been filled in. Placeholder image if not defined.

Smooth hover effect with transform scale.

5. Footer
Includes the mandatory MeanPug Pug with image and “Powered by MeanPug” text, as specified in the challenge.

🔧 Technologies Used
Docker (WordPress + MySQL)

WordPress (latest stable version)

PHP (templates, functions, ACF)

Tailwind CSS (utility framework, customized in tailwind.config.js)

JavaScript (vanilla) for interactions (mobile menu, tabs)

Webpack (JS/CSS asset build)

Advanced Custom Fields (Free) – without repeater, without options page

✅ Highlights for the Reviewer
Nothing hardcoded: every text, link, image, and button can be changed via the WordPress panel.

Free ACF: bypassed the limitations of ACF Free by using individual fields and simple PHP logic, without relying on repeaters or options pages.

Native filters and actions: usage of register_nav_menus, add_theme_support for custom logo, nav_menu_link_attributes for menu classes, etc.

Responsiveness: layout adapted for mobile with off‑canvas menu, variable column grid, and appropriate margins.

Modular and unobtrusive JavaScript: scripts separated by functionality, loaded only where needed.

Customized Tailwind: colors and spacings configured to follow the requested visual identity.

📝 How the Admin manages content
Go to Theme Options (page with Theme Options template) to configure:

COVID Banner

User notifications

Tabs and search texts

Front page (front-page.php template):

Hero Section

Featured Destinations

Appearance → Menus: manage the main menu links (location “Nav”).

Appearance → Customize → Site Identity: upload the logo.

All changes are reflected instantly on the front‑end.

🧠 Final Considerations
This project was developed following best practices for WordPress development, with an emphasis on clean code, dynamicity, separation of concerns, and fidelity to the proposed design. 

Thank you for the opportunity to participate in the challenge! 🐾