## Getting Started
We've tried to make it _super easy_ to get up and running on this [challenge](https://github.com/MeanPug/meanpug-wordpress-developer-challenge). Simply `cd` to the directory, and run the `docker compose up -d` to bring up a fully functional Wordpress environment at `localhost:8000`, complete with a Gulp build system and Tailwind + PostCSS CSS integration.

## Implementation Notes

This implementation recreates the above-the-fold experience from the AirPnP reference as a custom WordPress front page.

### Approach

- Created a dedicated `front-page.php` template for the challenge.
- Added a minimal custom header and footer to keep the challenge page independent from the base theme header.
- Used Tailwind utility classes for layout, spacing, typography, responsive behavior, and visual styling.
- Included a MeanPug pug asset as part of the hero/avatar treatment.
- Kept the implementation focused on visual accuracy rather than search or booking functionality, as requested by the challenge.

### Technical Notes

The base theme references ACF option fields in its default header and schema output hooks. I added defensive checks for those optional dependencies so the challenge page can be reviewed in a clean WordPress install without requiring additional plugin setup.

I also added a local Webpack configuration file referenced by the existing Docker `static` service so the asset watcher can run correctly during local development.