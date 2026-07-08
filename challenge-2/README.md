## Getting Started
We've tried to make it _super easy_ to get up and running on this [challenge](https://github.com/MeanPug/meanpug-wordpress-developer-challenge). Simply `cd` to the directory, and run the `docker compose up -d` to bring up a fully functional Wordpress environment at `localhost:8000`, complete with a Gulp build system and Tailwind + PostCSS CSS integration.

## The Project
Welcome to the Law Firm of Pug and Puggle, ESQ. In this challenge, you'll be implementing the backend for a law firm's website.
What are some things you'll want to include on a firm's site? Looking at the websites of [Morgan and Morgan](https://www.forthepeople.com/) and [Milberg](https://www.milberg.com) would be a great starting point! 

## Implementation Notes

This implementation defines a scalable backend content model for the Law Firm of Pug and Puggle, ESQ.

### Approach

- Created a must-use plugin to keep the law firm content model independent from the active theme.
- Registered custom post types for Attorneys, Practice Areas, Case Results, Testimonials, Locations, and FAQs.
- Registered custom taxonomies for Practice Area Types, Attorney Roles, Areas Served, and Case Result Types.
- Registered native WordPress post meta fields with sanitization, authorization callbacks, and REST API support.
- Added optional ACF local field groups to provide an editorial UI when ACF is available.
- Added helper functions for common relationships and structured data needs.

### Content Model

The content model is designed around common law firm website needs:

- Attorneys can be related to Practice Areas.
- Practice Areas can be related to Attorneys and FAQs.
- Case Results can be associated with Practice Areas.
- Testimonials can be connected to Practice Areas.
- Locations include structured address, phone, and coordinate data.
- FAQs can support Practice Area-specific content.

### Technical Notes

The core data model is registered with native WordPress APIs instead of depending entirely on ACF. ACF field groups are included as an optional enhancement and are only registered when ACF is active.

The base theme references ACF option fields in the header and schema output hooks, so I added defensive checks to avoid fatal errors in a clean WordPress install without requiring additional plugin setup.

The must-use plugin is mounted through Docker so the backend content model loads automatically during review without requiring manual plugin activation.

The custom post types are also exposed to the WordPress REST API through `show_in_rest`, allowing them to be queried through routes such as `?rest_route=/wp/v2/practice-area`.